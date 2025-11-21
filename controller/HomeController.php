<?php
include_once "model/Product/ProductDAO.php";
 //La ruta real sera view/home/index.php


class HomeController {
    public function index() {
        $view = 'view/home/home.php';
        $featuredProds = ProductDAO::getFeaturedProducts();
        include_once 'view/main.php';
    }
    

}