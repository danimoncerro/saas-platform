<?php
require_once __DIR__ . '/../models/User.php';

class UserController {
    
    public function __construct() {
        session_start();
    }

    public function store() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = trim($_POST["name"] ?? '');
            $email = trim($_POST["email"] ?? '');
            $password = $_POST["password"] ?? '';

            if (empty($name) || empty($email) || empty($password)) {
                die("❌ Toate câmpurile sunt obligatorii.");
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                die("❌ Email invalid.");
            }

            $userModel = new User();

            if ($userModel->getUserByEmail($email)) {
                die("❌ Email-ul este deja folosit.");
            }

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $result = $userModel->addUser($name, $email, $hashedPassword);

            if ($result) {
                header("Location: /ShopOnline/MagazinOnline/saas/saas-platform/public/user/register?success=1");
                exit;
            } else {
                die("❌ A apărut o eroare la crearea utilizatorului.");
            }
        } else {
            die("❌ Eroare: metodă incorectă.");
        }
    }

    public function register() {
        require_once '../app/models/UserModel.php';
        $userModel = new UserModel();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($name) || empty($email) || empty($password)) {
                echo "❌ Toate câmpurile sunt obligatorii!";
                return;
            }

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            if ($userModel->registerUser($name, $email, $hashedPassword)) {
                echo "✅ Utilizatorul $name a fost înregistrat cu succes!";
            } else {
                echo "❌ Eroare la înregistrare!";
            }
            return;
        }

        echo '
            <h2>Înregistrare</h2>
            <form method="POST" action="">
                <label for="name">Nume:</label>
                <input type="text" name="name" required>
                
                <label for="email">Email:</label>
                <input type="email" name="email" required>
                
                <label for="password">Parolă:</label>
                <input type="password" name="password" required>
                
                <button type="submit">Înregistrează-te</button>
            </form>
        ';
    }

    public function login() {
        require_once '../app/models/UserModel.php';
        $userModel = new UserModel();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                echo "❌ Toate câmpurile sunt obligatorii!";
                return;
            }

            $user = $userModel->loginUser($email, $password);
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                header("Location: /ShopOnline/MagazinOnline/saas/saas-platform/public/user/profile");
                exit();
            } else {
                echo "❌ Email sau parolă incorectă!";
            }
            return;
        }

        echo '
            <h2>Autentificare</h2>
            <form method="POST" action="">
                <label for="email">Email:</label>
                <input type="email" name="email" required>
                
                <label for="password">Parolă:</label>
                <input type="password" name="password" required>
                
                <button type="submit">Autentifică-te</button>
            </form>
        ';
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: /ShopOnline/MagazinOnline/saas/saas-platform/public/user/login");
        exit();
    }

    public function profile() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            header("Location: /ShopOnline/MagazinOnline/saas/saas-platform/public/user/login");
            exit();
        }

        echo "<h2>Profil Utilizator</h2>";
        echo "<p><strong>Nume:</strong> " . $_SESSION['user_name'] . "</p>";
        echo '<a href="/ShopOnline/MagazinOnline/saas/saas-platform/public/user/logout">Logout</a>';
    }
}
?>




