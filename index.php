<?php
include_once 'controller/app/HomeController.php';
include_once 'controller/app/UserController.php';

$home = false;
$msg = "";
if (isset($_GET['controller'])) {
    $nombreController = $_GET['controller'].'Controller';
    if (class_exists($nombreController)) {
        $controller = new $nombreController();
        $action = $_GET['action'];
        if (isset($action) && method_exists($controller,$action)) {
            $controller->$action();
        } else {
            header('Location: view/404.php');
        }
    } else {
        $home = true;
    }
} else {
    $home = true;
}
if ($home) {
    $homeCon = new HomeController();
    $homeCon->index();
}