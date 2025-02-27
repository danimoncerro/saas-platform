<?php
/*
class View {
    public static function render($view, $data = []) {
        $viewFile = '../app/views/' . $view . '.php';

        if (file_exists($viewFile)) {
            extract($data);
            require_once $viewFile;
        } else {
            die("View-ul <b>$view</b> nu există.");
        }
    }
}*/

?>


<?php

require_once __DIR__ . '/../core/View.php';

class View {
    public static function render($view, $data = []) {
        $viewFile = __DIR__ . '/../views/' . $view . '.php';

        if (file_exists($viewFile)) {
            extract($data);
            require $viewFile;
        } else {
            die("View-ul {$view} nu există!");
        }
    }
}
