<?php

class SaasUserController {
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index() {
        echo "✅ SaasUserController funcționează!";
        //exit;
    }

    public function edit($id = null) {
        echo "🔧 Editare utilizator cu ID: " . ($id ?? "Nespecificat");
        exit;
    }
    
}
