<?php
include_once 'controller/HomeController.php';
include_once 'controller/UserController.php';

$wrong = false;
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
        $wrong = true;
        $msg = 'class doesent exist';
    }
} else {
    $wrong = true;
    $msg =  'class not found as get parameter';
}
if ($wrong) {
    echo $msg;
}