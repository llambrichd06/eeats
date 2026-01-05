<?php
include_once 'model/dao/ProductDAO.php';


class ProductApiController {

    // public function getProductByID() {
    //     if (isset($_GET['id'])) {
    //         $id = $_GET['id'];
    //         $product = ProductDAO::getProductByID($id);  
    //         echo json_encode($product->toArray()); 
    //     }
    // }

    public function getProducts() {
        $products = ProductDAO::getProducts();
        $productsArray = [];
        foreach ($products as $product) {
            array_push($productsArray, $product->toArray());
        }
        echo json_encode($productsArray); 
    }

    public function saveProduct($data) {
        if (isset($data['name'], $data['description'], $data['price'], $data['stock'], $data['img'], $data['premium'], $data['deleted'])) {
            $product = new Product();
            $product->setData($data['name'], $data['description'], $data['price'], $data['created_at'], $data['stock'], $data['img'], $data['premium'], $data['discount_id'], $data['deleted']);
            ProductDAO::saveProduct($product);
            echo json_encode([
                'status' => 'Success',
                'data' => 'Product Inserted correctly',
            ]);
        }
    }

    public function editProduct($data) {
        if (isset($data['id'], $data['name'], $data['description'], $data['price'], $data['created_at'], $data['stock'], $data['img'], $data['premium'], $data['deleted'])) {
            $product = new Product();
            $product->setData($data['name'], $data['description'], $data['price'], $data['created_at'], $data['stock'], $data['img'], $data['premium'], $data['discount_id'], $data['deleted'], $data['id']);
            ProductDAO::editProduct($product);
            echo json_encode([
                'status' => 'Success',
                'data' => 'Product edited correctly'
            ]);
        }
    }

    function deleteProduct($data) {
        if (isset($data['id'])) {
            ProductDAO::deleteProduct($data['id']);
            echo json_encode([
                'status' => 'Success',
                'data' => 'Product deleted successfully'
            ]);
        }
    }

}