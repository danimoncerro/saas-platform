<?php

class StoreAuthController {
    private $userModel;

    public function __construct() {
        require_once '../app/models/StoreUserModel.php'; // Model separat pentru clienții magazinelor
        $this->userModel = new StoreUserModel();
        session_start();
    }

    public function showLoginForm() {
        require_once '../app/views/store/auth/login.php'; // Afișează pagina de login pentru clienți
    }

    public function login() {
        error_log("🔍 Request primit în login: " . print_r($_SERVER, true)); 
        error_log("📩 Date primite: " . print_r($_POST, true));
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['debug_test'])) {
                die("✅ POST funcționează, formularul trimite date!");
            }
    
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
    
            $user = $this->userModel->loginUser($email, $password);
    
            if ($user) {
                $_SESSION['store_user_id'] = $user['id'];
                $_SESSION['store_user_name'] = $user['name'];
                header("Location: /store/dashboard");
                exit;
            } else {
                echo "❌ Email sau parolă incorecte!";
            }
        } else {
            View::render('auth/login');
        }
    }
    
    

    public function logout() {
        session_start();
        session_destroy();
        header("Location: /store/auth/login");
        exit;
    }

    public function showRegisterForm() {
        require_once '../app/views/store/auth/register.php'; // Afișează formularul de înregistrare
    }

    public function register() {

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            require_once '../app/views/store/auth/register.php';
            exit;
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Aici vine logica de înregistrare
        } else {
            echo "❌ Metodă incorectă!";
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $store_id = intval($_POST['store_id']);
    
            // Verifică dacă toate câmpurile sunt completate
            if (empty($name) || empty($email) || empty($password) || empty($store_id)) {
                die("❌ Toate câmpurile sunt obligatorii!");
            }
    
            // Apelează modelul pentru a înregistra utilizatorul
            $result = $this->userModel->registerUser($name, $email, $password, $store_id);
    
            if ($result === true) {
                echo "✅ Înregistrare reușită! <a href='/store/auth/login'>Autentifică-te aici</a>";
            } else {
                echo $result; // Mesaj de eroare (de ex. email deja existent)
            }
        } else {
            die("❌ Metodă incorectă!");
        }
    }
    
    
    

}


