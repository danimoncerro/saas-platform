<?php

if (!class_exists('App')) {
    class App {
        protected $controller = 'HomeController'; // Controller implicit
        protected $method = 'index'; // Metodă implicită
        protected $params = [];

        public function __construct() {
            $url = $this->parseUrl();

            if (!is_array($url) || empty($url[0])) {
                $url[0] = 'home'; // Setăm un controller implicit
            }

            // Generăm numele corect al controllerului
            $controllerName = str_replace('-', '', ucwords($url[0], '-')) . 'Controller';
            $controllerPath = '../app/controllers/' . $controllerName . '.php';

            // Verificăm existența fișierului controllerului
            if (!file_exists($controllerPath)) {
                die("❌ Controllerul nu există: " . $controllerPath);
            }

            require_once $controllerPath;

            // Verificăm existența clasei controllerului
            if (!class_exists($controllerName)) {
                die("❌ Clasa controllerului nu a fost găsită în fișier!");
            }

            // Instanțiem controllerul
            $this->controller = new $controllerName();

            // Verificăm existența metodei în controller
            if (isset($url[1]) && method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }

            // Setăm parametrii
            $this->params = $url ? array_values($url) : [];

            // Apelăm metoda controllerului
            call_user_func_array([$this->controller, $this->method], $this->params);
        }

        private function parseUrl() {
            if (isset($_GET['url']) && !empty($_GET['url'])) {
                return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
            }
            return ['home']; // Pagina implicită
        }
    }
}
?>



