<?php

class DashboardController {
    
    public function __construct() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /ShopOnline/MagazinOnline/saas/saas-platform/public/auth/login");
            exit;
        }
    }

    
    public function index() {
        require_once '../app/views/dashboard.php';
    }
}
