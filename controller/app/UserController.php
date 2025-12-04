<?php
include_once 'model/dao/UserDAO.php';


class UserController {
    public function show() {
        
        $view = 'view/user/show.php';
        $idUser = $_GET['iduser'];
        $user = UserDAO::getUserByID($idUser);
        include_once 'view/main.php'; //Usamos esto para incluir el show al main, asi poder usarlo en main
    }
    public function index() {
        $view = 'view/user/index.php';
        $users = UserDAO::getUsers();
        include_once 'view/main.php';
    }
    public function create() {
        $edit = false;
        $view = 'view/user/createEdit.php';
        include_once 'view/main.php'; 
    }
    public function edit() {
        $edit = true;
        $view = 'view/user/createEdit.php';
        include_once 'view/main.php'; 
    }
    public function delete() {
        $view = 'view/user/create.php';
        include_once 'view/main.php'; 
    }
    

}