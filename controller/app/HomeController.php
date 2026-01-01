<?php
include_once "model/dao/ProductDAO.php";
include_once "model/dao/DiscountDAO.php";


class HomeController {
    
    public function index() {
        $view = 'view/home/home.php';
        $featuredProds = ProductDAO::getFeaturedProducts();
        $latestDiscount = DiscountDAO::getLastDiscounts();
        include_once 'view/main.php';
    }
}