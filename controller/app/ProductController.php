<?php
include_once "model/dao/ProductDAO.php";
include_once "model/dao/DiscountDAO.php";



class ProductController {
    
    public function showProduct() {
        $view = 'view/products/individualProduct.php';
        $idProduct = $_GET['idProduct'];
        $product = ProductDAO::getProductByID($idProduct);
        include_once 'view/main.php';
    }

    public function showProductPage() {
        $view = 'view/products/productsPage.php';
        $products = ProductDAO::getProducts();
        include_once 'view/main.php';
    }
}