<?php

require_once '../app/models/UserModel.php';  //

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            if ($this->userModel->getUserByEmail($email)) {
                echo "Email deja utilizat!";
                return;
            }

            if ($this->userModel->registerUser($name, $email, $password)) {
                header("Location: /ShopOnline/MagazinOnline/saas/saas-platform/public/auth/login");
                exit;
            } else {
                echo "Eroare la înregistrare!";
            }
        } else {
            View::render('auth/register');
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
    
            // Apelăm metoda din UserModel
            $user = $this->userModel->loginUser($email, $password);
    
            if ($user) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
    
                // Verificăm dacă sesiunea este setată corect
                if (isset($_SESSION['user_id'])) {
                    header("Location: /ShopOnline/MagazinOnline/saas/saas-platform/public/dashboard");
                    exit;
                } else {
                    echo "❌ Eroare sesiune: Nu s-a putut crea sesiunea.";
                }
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
        header("Location: /ShopOnline/MagazinOnline/saas/saas-platform/public/auth/login");
    }
}

?>
