<?php 


class Router {
    protected $routes = [];

    public function add($route, $controller, $method = 'index') {
        $this->routes[$route] = ['controller' => $controller, 'method' => $method];
        $this->routes['store/dashboard'] = ['controller' => 'StoreDashboardController', 'method' => 'index'];

    }

    private $controller = 'HomeController'; // Controller implicit
    private $method = 'index'; // Metoda implicită
    private $params = [];

    public function __construct() {
        $this->parseUrl();
    }

    private function parseUrl() {
        if (isset($_GET['url'])) {
            $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
    
            // Gestionăm rutele personalizate pentru autentificarea magazinelor
            if ($url[0] === 'store' && isset($url[1]) && $url[1] === 'auth') {
                $this->controller = 'StoreAuthController';
                $this->method = $url[2] ?? 'showLoginForm'; // Implicit mergem pe login
                $this->params = array_slice($url, 3);
                return;
            }
    
            // Convertim URL-ul în numele corect al controllerului
            $controllerName = str_replace('-', '', ucwords($url[0], '-')) . 'Controller';
    
            // Gestionăm cazul special pentru StoresController
            if ($controllerName === 'StoreController') {
                $controllerName = 'StoresController';
            }
    
            $this->controller = !empty($url[0]) ? $controllerName : 'HomeController';
            $this->method = $url[1] ?? 'index';
            $this->params = array_slice($url, 2);
        }
    }
    

    public function dispatch() {
        echo "Router a ajuns în dispatch!<br>";
    
        $controllerFile = '../app/controllers/' . $this->controller . '.php';
    
        if (file_exists($controllerFile)) {
            echo "Controllerul există: $controllerFile <br>";
            require_once $controllerFile;
    
            if (class_exists($this->controller)) {
                echo "Clasa controllerului există!<br>";
                $controllerObject = new $this->controller();
    
                if (method_exists($controllerObject, $this->method)) {
                    echo "Metoda {$this->method} există!<br>";
                    call_user_func_array([$controllerObject, $this->method], $this->params);
                    echo "Execuție terminată!<br>";
                } else {
                    die("❌ Eroare: Metoda <strong>{$this->method}</strong> nu există în <strong>{$this->controller}</strong>");
                }
            } else {
                die("❌ Eroare: Clasa <strong>{$this->controller}</strong> nu există.");
            }
        } else {
            die("❌ Eroare: Fișierul controller <strong>$controllerFile</strong> nu a fost găsit.");
        }
    }
}    


    
    
    
    
    

