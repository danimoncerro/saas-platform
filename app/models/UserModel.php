<?php

class UserModel {
    private $db;

    public function __construct() {
        $this->db = new mysqli("localhost", "root", "", "saas_platform");

        if ($this->db->connect_error) {
            die("❌ Eroare conexiune!");
        }
    }

    public function registerUser($name, $email, $password) {
        // Criptăm parola înainte de a o salva în baza de date
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Verifică dacă email-ul există deja
        $checkStmt = $this->db->prepare("SELECT id FROM saas_users WHERE email = ?");
        $checkStmt->bind_param("s", $email);
        $checkStmt->execute();
        $result = $checkStmt->get_result();

        if ($result->num_rows > 0) {
            return "❌ Acest email este deja folosit!";
        }

        // Dacă email-ul nu există, continuă înregistrarea
        $stmt = $this->db->prepare("INSERT INTO saas_users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashedPassword);

        return $stmt->execute();
    }

    public function verifyLogin($email, $password) {
        $stmt = $this->db->prepare("SELECT id, name, password FROM saas_users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }

        return false;
    }

    public function getUserByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM saas_users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // Returnează utilizatorul dacă există
    }

    public function loginUser($email, $password) {
        $stmt = $this->db->prepare("SELECT id, name, password FROM saas_users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            
            // Verificăm parola
            if (password_verify($password, $user['password'])) {
                return $user;
            } else {
                echo "❌ Parola este incorectă!";
                return false;
            }
        } else {
            echo "❌ Nu există utilizator cu acest email!";
            return false;
        }
    }
    
    
}

?>


