<?php

class HomeController {
    public function index() {
        echo "<h1>Pagina home functioneaza</h1>";
    }

    public function about() {
        echo "<h1>Acesta este pagina Despre</h1>";
    }

   /* public function store() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Debugging: Afișează conținutul $_POST
            echo "<pre>";
            var_dump($_POST);
            echo "</pre>";
            exit; // Oprește execuția pentru a vedea rezultatul
        }
    }
    */

    // public function store() {
    //    echo "<h1>Aceasta este pagina Store</h1>";
    //}

    public function store() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = trim($_POST["name"] ?? '');
            $email = trim($_POST["email"] ?? '');
            $password = $_POST["password"] ?? '';
    
            // 1️⃣ Validare simplă a datelor
            if (empty($name) || empty($email) || empty($password)) {
                die("Toate câmpurile sunt obligatorii!");
            }
    
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                die("Email invalid!");
            }
    
            // 2️⃣ Criptăm parola
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
            // 3️⃣ Conectare la baza de date
            require_once "../config/database.php"; // Asigură-te că ai un fișier database.php!
            $db = new Database();
            $conn = $db->connect();
    
            // 4️⃣ Inserare în baza de date
            $stmt = $conn->prepare("INSERT INTO saas_users (name, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $hashedPassword);
    
            if ($stmt->execute()) {
                // 5️⃣ Redirecționare la pagina principală
                header("Location: /public/home/index");
                exit;
            } else {
                die("Eroare la adăugarea utilizatorului!");
            }
        }
    }

    public function register() {
        View::render('register');
    }
    
    
    
}
