<?php
/*
class Database {
    private static $host = "localhost";
    private static $dbname = "saas_platform";
    private static $username = "root";  // Schimbă dacă ai alt user în MySQL
    private static $password = "";  // Adaugă parola MySQL dacă e necesar
    private static $pdo = null;

    public static function connect() {
        if (self::$pdo === null) {
            try {
                self::$pdo = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$dbname, self::$username, self::$password);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Eroare la conectarea cu baza de date: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
} */
?>


<?php

class Database {
    private $host = "localhost";
    private $db_name = "saas_platform";
    private $username = "root";
    private $password = "";
    private $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            die("Eroare la conectarea la baza de date: " . $exception->getMessage());
        }
    }

    public function getConnection() {
        return $this->conn;
    }

}

?>
