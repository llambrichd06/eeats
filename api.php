<?php
header("Access-Control-Allow-Origin: *"); //Los headers estos tienen que estar antes que cualquier tipo de output
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "model/dao/CategoryDAO.php";
include_once "model/dao/CookPointDAO.php";
include_once "model/dao/DiscountDAO.php";
include_once "model/dao/IngredientDAO.php";
include_once "model/dao/IngredientOrderLinesDAO.php";
include_once "model/dao/LogDAO.php";
include_once "model/dao/OrderDAO.php";
include_once "model/dao/OrderLinesDAO.php";
include_once "model/dao/ProductCategoryDAO.php";
include_once "model/dao/ProductDAO.php";
include_once "model/dao/ProductIngredientDAO.php";
include_once "model/dao/UserDAO.php";

include_once "model/classes/Category.php";
include_once "model/classes/CookPoint.php";
include_once "model/classes/Discount.php";
include_once "model/classes/Ingredient.php";
include_once "model/classes/IngredientOrderLines.php";
include_once "model/classes/Log.php";
include_once "model/classes/Order.php";
include_once "model/classes/OrderLines.php";
include_once "model/classes/ProductCategory.php";
include_once "model/classes/Product.php";
include_once "model/classes/ProductIngredient.php";
include_once "model/classes/User.php";

$method = $_SERVER['REQUEST_METHOD'];
$data = json_decode(file_get_contents("php://input"), true);

if ($method == 'GET' && isset($_GET['endpoint'])) {
    switch ($_GET['endpoint']) {
        case 'testing':
            echo json_encode([
                'message' => 'good test'
            ]);
        break;

        case 'getUserById':
            if (isset($_GET['id'])) {
                $user = UserDAO::getUserByID($_GET['id']);
                echo json_encode($user->toArray());
            }
        break;
        
        default:
            echo json_encode([
                'message' => 'endpoint not configured'
            ]);
        break;
    }
    
} elseif ($method == 'POST' && isset($data['endpoint'])) {
    switch ($data['endpoint']) {
        case 'saveUser':
            if (isset($data['name'], $data['email'], $data['profile_picture'], $data['password'], $data['role'], $data['premium'])) {
                $user = new User();
                $user->setData($data['name'], $data['email'], $data['profile_picture'], $data['password'], $data['role'], $data['premium'], $data['deleted']);
                UserDAO::saveUser($user);
            }
            echo json_encode([
                'estado' => 'Exito',
                'data' => 'Insertado correctamente'
            ]);
        break;
        
        default:
            echo json_encode([
                'message' => 'endpoint not configured'
            ]);
            break;
    }
} else {
    echo json_encode([
        'message' => 'endpoint or method not sent'
    ]);
}


