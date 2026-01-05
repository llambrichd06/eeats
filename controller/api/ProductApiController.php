<?php
include_once 'model/dao/ProductDAO.php';
include_once 'model/dao/LogDAO.php';


class ProductApiController
{

    // public function getProductByID() {
    //     if (isset($_GET['id'])) {
    //         $id = $_GET['id'];
    //         $product = ProductDAO::getProductByID($id);  
    //         echo json_encode($product->toArray()); 
    //     }
    // }

    public function getProducts()
    {
        $products = ProductDAO::getProducts();
        $productsArray = [];
        foreach ($products as $product) {
            array_push($productsArray, $product->toArray());
        }
        echo json_encode($productsArray);
    }

    public function saveProduct($data)
    {
        if (isset($data['name'], $data['description'], $data['price'], $data['stock'], $data['img'], $data['premium'], $data['deleted'])) {

            try {
                $product = new Product();
                $product->setData($data['name'], $data['description'], $data['price'], $data['created_at'], $data['stock'], $data['img'], $data['premium'], $data['discount_id'], $data['deleted']);
                ProductDAO::saveProduct($product);
                echo json_encode([
                    'status' => 'Success',
                    'data' => 'Product Inserted correctly',
                ]);
                $log = new Log();
                $log->setData($_SESSION['lastAdminLoginId'], 'Saved new product');
                LogDAO::saveLog($log);
            } catch (\Throwable $th) {
                http_response_code(404);
                echo json_encode([
                    'status' => 'Error',
                    'data' => 'Discount id does not exist'
                ]);
            }
        }
    }

    public function editProduct($data)
    {
        if (isset($data['id'], $data['name'], $data['description'], $data['price'], $data['created_at'], $data['stock'], $data['img'], $data['premium'], $data['deleted'])) {
            try {
                $product = new Product();
                $product->setData($data['name'], $data['description'], $data['price'], $data['created_at'], $data['stock'], $data['img'], $data['premium'], $data['discount_id'], $data['deleted'], $data['id']);
                ProductDAO::editProduct($product);
                echo json_encode([
                    'status' => 'Success',
                    'data' => 'Product edited correctly'
                ]);
                $log = new Log();
                $log->setData($_SESSION['lastAdminLoginId'], 'Edited product with id ' . $data['id']);
                LogDAO::saveLog($log);
            } catch (\Throwable $th) {
                http_response_code(404);
                echo json_encode([
                    'status' => 'Error',
                    'data' => 'Discount id does not exist'
                ]);
            }
        }
    }

    function deleteProduct($data)
    {
        if (isset($data['id'])) {
            ProductDAO::deleteProduct($data['id']);
            echo json_encode([
                'status' => 'Success',
                'data' => 'Product deleted successfully'
            ]);
            $log = new Log();
            $log->setData($_SESSION['lastAdminLoginId'], 'Deleted product with id ' . $data['id']);
            LogDAO::saveLog($log);
        }
    }
}
