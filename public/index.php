<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../app/core/View.php';
require_once '../app/core/App.php';
require_once '../app/core/Controller.php';
require_once '../app/core/Router.php';

// Inițializează Routerul și apelează dispatch()
$router = new Router();
$router->dispatch($_SERVER['REQUEST_URI']);

//$app = new App();
?>







