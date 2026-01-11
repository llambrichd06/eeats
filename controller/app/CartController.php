<?php

include_once "model/dao/ProductDAO.php";
include_once "model/dao/DiscountDAO.php";


class CartController
{

    public function showShop()
    {
        include_once 'view/startSession.php';
        include_once 'view/authenticator.php';
        $view = 'view/cart/shop.php';
        
        foreach ($_SESSION['cart'] as $key => $value) {
            if (isset($_POST['deletePos' . $key])) {
                unset($_SESSION['cart'][$key]);
                $_SESSION['cart'] = array_values($_SESSION['cart']);
                unset($_POST['deletePos' . $key]);
            }
        }
        if (isset($_POST['unApplyCode'])) {
            unset($_POST['promoCode']);
            unset($_SESSION['promoCode']);
        }
        $totalPrice = 0;
        $discountPercent = 0;
        if (isset($_POST['promoCode']) || isset($_SESSION['promoCode'])) {
            $discount = DiscountDAO::getDiscountByCode($_POST['promoCode'] ?? $_SESSION['promoCode']);
            if ($discount) {
                $discountPercent = $discount->getPercent();
                $_SESSION['promoCode'] = $_POST['promoCode'] ?? $_SESSION['promoCode'];
                $_POST['promoCode'] = $_SESSION['promoCode'] ?? $_POST['promoCode'];
            } else {
                $_POST['promoCode'] = 'notFound';
            }
        }
        include_once 'view/main.php';
    }

    public function showCheckout()
    {
        include_once 'view/startSession.php';
        include_once 'view/authenticator.php';
        $view = 'view/cart/checkout.php';

        $totalPrice = $_POST['totalPrice'];
        $discountPercent = $_POST['discountPercent'] ?? null;
        if (isset($discountPercent)) {
            $discountedPrice = number_format(($totalPrice - ($totalPrice * $discountPercent / 100)), 2);
        }
        $promoCode = $_SESSION['promoCode'] ?? null;
        include_once 'view/main.php';
    }
}
