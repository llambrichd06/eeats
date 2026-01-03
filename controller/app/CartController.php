<?php

include_once "model/dao/ProductDAO.php";
include_once "model/dao/DiscountDAO.php";


class CartController {
    
    public function showShop() {
        $view = 'view/cart/shop.php';
        include_once 'view/main.php';
    }

    public function showCheckout() {
        $view = 'view/cart/checkout.php';
        include_once 'view/main.php';
    }
}