<?php
include_once "model/dao/UserDAO.php";


class AdminController {
    
    public function showLogin() {
        $view = 'view/adminPanel/adminLogin.php';
        include_once 'view/main.php';
    }

    public function showPanel() {
        include_once 'view/adminPanel/mainAdmin.php';
    }
}