<?php
require_once __DIR__ . '/../core/Model.php';

class User extends Model {

    public function getUserByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM saas_users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getUsers() {
        $result = $this->db->query("SELECT * FROM saas_users");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    
    


    public function addUser($name, $email, $password) {
        $stmt = $this->db->prepare("INSERT INTO saas_users (name, email, password) VALUES (?, ?, ?)");
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("sss", $name, $email, $hashedPassword);
        return $stmt->execute();
    }
}
