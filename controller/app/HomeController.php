<?php
include_once "model/dao/ProductDAO.php";
include_once "model/dao/DiscountDAO.php";


class HomeController {
    
    public function index() {
        include_once 'view/startSession.php';
        $view = 'view/home/home.php';
        $featuredProds = ProductDAO::getFeaturedProducts();
        $latestDiscount = DiscountDAO::getLastDiscounts();
        include_once 'view/main.php';
    }
}