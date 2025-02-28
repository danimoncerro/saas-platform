<?php

class StoreUserModel {
    private $db;

    public function __construct() {
        $this->db = new mysqli("localhost", "root", "", "saas_platform");

        if ($this->db->connect_error) {
            die("❌ Eroare conexiune!");
        }
    }

    public function registerUser($name, $email, $password, $store_id) {
        // Criptăm parola înainte de a o salva în baza de date
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        // Verifică dacă email-ul există deja pentru același magazin
        $checkStmt = $this->db->prepare("SELECT id FROM store_users WHERE email = ? AND store_id = ?");
        $checkStmt->bind_param("si", $email, $store_id);
        $checkStmt->execute();
        $result = $checkStmt->get_result();
    
        if ($result->num_rows > 0) {
            return "❌ Acest email este deja utilizat pentru acest magazin!";
        }
    
        // Dacă email-ul nu există, continuăm înregistrarea
        $stmt = $this->db->prepare("INSERT INTO store_users (name, email, password, store_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $name, $email, $hashedPassword, $store_id);
    
        if ($stmt->execute()) {
            return true;
        } else {
            return "❌ Eroare la înregistrare: " . $this->db->error;
        }
    }
    
    

    public function loginUser($email, $password) {
        $stmt = $this->db->prepare("SELECT id, name, password FROM store_users WHERE email = ?");
        
        if (!$stmt) {
            die("❌ Eroare SQL: " . $this->db->error);
        }
    
        $stmt->bind_param("s", $email);
        
        // Adaugă acest debug înainte de execute()
        var_dump("Se execută interogarea cu email: " . $email);
        
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            
            // Debug pentru parola
            if (password_verify($password, $user['password'])) {
                var_dump("✅ Parola este corectă!");
                exit;
                return $user;
            } else {
                var_dump("❌ Parola NU este corectă!");
                exit;
                return false;
            }
        }
    
        var_dump("❌ Nu există utilizator cu acest email!");
        exit;
        return false;
    }
    
}

?>
