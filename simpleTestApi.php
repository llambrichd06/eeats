<?php 

error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once('controller/api/SimpleApiController.php');

if (isset($_GET['controller'], $_GET['action'])) {
    $controller = $_GET['controller'];
    $action =$_GET['action'];
    if ($methos == "api" && $action == "usuarios") {
        $apiController = new SimpleApiController();

    }
}