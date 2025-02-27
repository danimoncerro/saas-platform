<?php

require_once '../app/models/Store.php';



if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

class StoresController {

    public function index() {
        header("Location: /ShopOnline/MagazinOnline/saas/saas-platform/public/stores/list");
        exit;
    }
    
   /* public function create() {

        echo "Controllerul a fost accesat!<br>";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            echo "Datele au fost trimise prin POST!<br>";
            echo "<pre>";
            print_r($_POST);
            echo "</pre>";
            exit;
        } else {
            echo "Metoda nu este POST.";
        }

        View::render('store_create');
    }*/

    /*public function create() {

        echo "Pas 1: Metoda create() a început!<br>";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo "Pas 2: S-au primit date prin POST<br>";
            var_dump($_POST); // Verificăm ce date sunt primite
            die();
    }

         echo "Pas 3: Nicio dată nu a fost trimisă prin POST";
        die();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $domain = $_POST['domain'];

            // Conectare la baza de date
            $db = new Database();
            $conn = $db->getConnection();

            // Interogare pentru inserare
            $query = "INSERT INTO stores (user_id, name, domain, created_at) VALUES (1, :name, :domain, NOW())";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':domain', $domain);

            if ($stmt->execute()) {
                // ✅ Redirecționare după succes
                header("Location: /ShopOnline/MagazinOnline/saas/saas-platform/public/stores/list");
                exit;
            } else {
                echo "❌ Eroare la inserarea magazinului!";
            }
        }
    } */

    public function create() {
       // echo "Pas 1: Metoda create() a început!<br>";
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo "Pas 2: S-au primit date prin POST<br>";
            var_dump($_POST); // Verificăm ce date sunt primite
            // die(); // ✅ Scoate această linie pentru a permite inserarea în DB
    
            // Asigură-te că datele sunt primite corect
            if (!isset($_POST['name']) || !isset($_POST['domain'])) {
                die("Eroare: Câmpurile sunt goale!");
            }
    
            $name = trim($_POST['name']);
            $domain = trim($_POST['domain']);
    
            if (empty($name) || empty($domain)) {
                die("Eroare: Toate câmpurile sunt obligatorii.");
            }
    
            // Conectare la baza de date
            $db = new Database();
            $conn = $db->getConnection();
    
            // Interogare pentru inserare
            $query = "INSERT INTO stores (user_id, name, domain, created_at) VALUES (1, :name, :domain, NOW())";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':domain', $domain);
    
            if ($stmt->execute()) {
                // ✅ Redirecționare după succes
                header("Location: /ShopOnline/MagazinOnline/saas/saas-platform/public/stores/list");
                exit;
            } else {
                echo "❌ Eroare la inserarea magazinului!";
            }
        }
    
        // ✅ Se încarcă pagina doar dacă metoda NU este POST
        View::render('store_create');
    }
    

    public function store() {
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            echo "<pre>";
            print_r($_POST);
            echo "</pre>";
            exit;
        }


        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userId = $_SESSION['user_id'] ?? null; // Asigură-te că utilizatorul este autentificat
            $name = trim($_POST['name']);
            $domain = trim($_POST['domain']);

            if (!$userId) {
                die("Eroare: Utilizatorul nu este autentificat.");
            }

            if (empty($name) || empty($domain)) {
                die("Eroare: Toate câmpurile sunt obligatorii.");
            }

            $storeModel = new Store();
            $storeId = $storeModel->createStore($userId, $name, $domain);

            if ($storeId) {
                header("Location: /ShopOnline/MagazinOnline/saas/saas-platform/public/store/list");
                exit;
            } else {
                die("Eroare: Magazinul nu a putut fi creat.");
            }
        }
    }


    /*public function list() {
        if (!isset($_SESSION['user_id'])) {
            die("Eroare: Utilizatorul nu este autentificat.");
        }

        $db = new Database();
        $conn = $db->getConnection();

        $query = "SELECT * FROM stores WHERE user_id = :user_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':user_id', $_SESSION['user_id']);
        $stmt->execute();
        $stores = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include __DIR__ . '/../views/store_list.php';
    }*/

    public function list() {

        

        //session_start(); // Asigură-te că sesiunea este inițializată
    
        if (!isset($_SESSION['user_id'])) {
            die("Eroare: Utilizatorul nu este autentificat.");
        }

        //var_dump($_SESSION);
        //exit;
    
        $db = new Database();
        $conn = $db->getConnection();
    
        // ✅ Asigură-te că filtrezi doar magazinele utilizatorului logat
        $query = "SELECT * FROM stores WHERE user_id = :user_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':user_id', $_SESSION['user_id']);
        $stmt->execute();
        $stores = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        include __DIR__ . '/../views/store_list.php';
    }

    /*public function list() {
        $userId = $_SESSION['user_id'] ?? null;
        
        if (!$userId) {
            die("Eroare: Utilizatorul nu este autentificat.");
        }

        $storeModel = new Store();
        $stores = $storeModel->getStoresByUser($userId);

        View::render('store_list', ['stores' => $stores]);
    }*/

    /*public function edit($id) {
        echo "🔍 ID primit în edit(): ";
        var_dump($id);
        echo "<br>";
    
        if (!is_numeric($id)) {
            die("❌ Eroare: ID-ul magazinului nu este valid.");
        }
    
        $userId = $_SESSION['user_id'] ?? null;
    
        if (!$userId) {
            die("❌ Eroare: Utilizatorul nu este autentificat.");
        }
    
        $storeModel = new Store();
        $store = $storeModel->getStoreById($id);
    
        echo "🔎 Rezultatul interogării: ";
        var_dump($store);
        echo "<br>";
    
        if (!$store) {
            die("❌ Eroare: Magazinul nu există.");
        }
    
        if ($store['user_id'] != $userId) {
            die("❌ Eroare: Nu ai permisiunea să editezi acest magazin.");
        }
    
        View::render('store_edit', ['store' => $store]);
    }
*/
    
    public function edit($id) {
       
        // Verifică dacă $id este valid numeric
        if (!is_numeric($id)) {
            die("Eroare: ID-ul magazinului nu este valid.");
        }

        // Caută magazinul în baza de date
        $store = $this->storeModel->getStoreById($id);

        if (!$store) {
            die("Eroare: Magazinul nu există.");
        }

        // Afișează pagina de editare
        require_once '../app/views/stores/edit.php';
    }
    
    
    

    public function update() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userId = $_SESSION['user_id'] ?? null;
            $storeId = $_POST['store_id'] ?? null;
            $name = trim($_POST['name']);
            $domain = trim($_POST['domain']);
    
            if (!$userId) {
                die("Eroare: Utilizatorul nu este autentificat.");
            }
    
            if (empty($storeId) || empty($name) || empty($domain)) {
                die("Eroare: Toate câmpurile sunt obligatorii.");
            }
    
            $storeModel = new Store();
            $store = $storeModel->getStoreById($storeId);
    
            if (!$store || $store['user_id'] != $userId) {
                die("Eroare: Nu ai permisiunea să editezi acest magazin.");
            }
    
            $updated = $storeModel->updateStore($storeId, $name, $domain);
    
            if ($updated) {
                header("Location: /ShopOnline/MagazinOnline/saas/saas-platform/public/store/list");
                exit;
            } else {
                die("Eroare: Modificările nu au putut fi salvate.");
            }
        }
    }

    public function delete($id) {
        $userId = $_SESSION['user_id'] ?? null;
    
        if (!$userId) {
            die("Eroare: Utilizatorul nu este autentificat.");
        }
    
        $storeModel = new Store();
        $store = $storeModel->getStoreById($id);
    
        if (!$store || $store['user_id'] != $userId) {
            die("Eroare: Nu ai permisiunea să ștergi acest magazin.");
        }
    
        $deleted = $storeModel->deleteStore($id);
    
        if ($deleted) {
            header("Location: /ShopOnline/MagazinOnline/saas/saas-platform/public/store/list");
            exit;
        } else {
            die("Eroare: Magazinul nu a putut fi șters.");
        }
    }
}

?>
