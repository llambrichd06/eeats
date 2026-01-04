<?php
include_once "model/dao/UserDAO.php";


class UserController {
    
    public function showUserPage() {
        $view = 'view/userPanel/userPage.php';
        include_once 'view/main.php';
    }

}