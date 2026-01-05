<?php
include_once 'controller/api/UserApiController.php';
include_once 'controller/api/ProductApiController.php';
include_once 'controller/api/OrderApiController.php';
include_once 'controller/api/DiscountApiController.php';
include_once 'controller/api/OrderLinesApiController.php';

header("Access-Control-Allow-Origin: *"); //These headers have to execute before any type of output
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$method = $_SERVER['REQUEST_METHOD'];
$data = json_decode(file_get_contents("php://input"), true);


if (isset($_GET['controller'], $_GET['action'])) {
    $controller = $_GET['controller'];
    $action = $_GET['action'];
    $nombreController = $_GET['controller'].'ApiController';
    if (class_exists($nombreController)) {
        $controller = new $nombreController();
        $action = $_GET['action'];
        if (isset($action) && method_exists($controller,$action)) {
            if ($method == 'GET') {
                $controller->$action(); 
            } else {
                $controller->$action($data); 
            }
            
        } else {
            echo json_encode([
                'message' => 'unidentified method'
            ]);
        }
    } else {
        echo json_encode([
            'message' => 'unidentified class'
        ]);
    }
} else {
    echo json_encode([
        'message' => 'Controller or action not recieved.'
    ]);
}
