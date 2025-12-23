<?php
include_once "model/dao/UserDAO.php";

 //La ruta real sera view/home/index.php


class SessionController {
    
    public function showLogin() {
        include_once "model/dao/UserDAO.php";
        $view = 'view/userSession/userLogin.php';
        include_once 'view/main.php';
    }

    public function showSignUp() {
        include_once "model/dao/UserDAO.php";
        $view = 'view/userSession/userSignUp.php';
        include_once 'view/main.php';
    }
}