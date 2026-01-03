<?php

include_once "model/dao/ProductDAO.php";
include_once "model/dao/DiscountDAO.php";
include_once "model/dao/OrderDAO.php";
include_once "model/dao/OrderLinesDAO.php";
include_once "model/dao/IngredientOrderLinesDAO.php";

class PurchaseController {
    
    public function processPurchase() {
        $view = 'view/purchase/purchase.php';
        include_once 'view/main.php';
    }

    public function showPurchase() {
        $view = 'view/purchase/completedPurchase.php';
        include_once 'view/main.php';
    }
}