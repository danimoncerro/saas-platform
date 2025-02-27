<?php

require_once '../app/core/Database.php';

class Store {
    
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    // Metodă pentru crearea unui magazin nou
    public function createStore($userId, $name, $domain) {
        $query = "INSERT INTO stores (user_id, name, domain, created_at) VALUES (:user_id, :name, :domain, NOW())";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':domain', $domain);

        if ($stmt->execute()) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }

    // Metodă pentru obținerea tuturor magazinelor unui utilizator
    public function getStoresByUser($userId) {
        $query = "SELECT * FROM stores WHERE user_id = :user_id ORDER BY created_at DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Metodă pentru obținerea unui singur magazin după ID
    public function getStoreById($storeId) {
        $query = "SELECT * FROM stores WHERE id = :store_id LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':store_id', $storeId);
        $stmt->execute();
    
        $store = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Debugging
        echo "ID Căutat: " . htmlspecialchars($storeId) . "<br>";
        echo "Rezultatul interogării: ";
        var_dump($store);
        die(); // Oprire pentru a vedea output-ul
    
        return $store;
    }
    

    // Metodă pentru actualizarea unui magazin
    public function updateStore($storeId, $name, $domain) {
        $query = "UPDATE stores SET name = :name, domain = :domain WHERE id = :store_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':store_id', $storeId);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':domain', $domain);

        return $stmt->execute();
    }

    // Metodă pentru ștergerea unui magazin
    public function deleteStore($storeId) {
        $query = "DELETE FROM stores WHERE id = :store_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':store_id', $storeId);

        return $stmt->execute();
    }
}

?>

