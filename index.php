<?php
include_once 'controller/app/HomeController.php';
include_once 'controller/app/ProductController.php';
include_once 'controller/app/SessionController.php';
include_once 'controller/app/CartController.php';
include_once 'controller/app/PurchaseController.php';
include_once 'controller/app/AdminController.php';
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
            $home = true;
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