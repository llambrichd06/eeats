<?php

include_once "model/dao/ProductDAO.php";
include_once "model/dao/DiscountDAO.php";
include_once "model/dao/OrderDAO.php";
include_once "model/dao/OrderLinesDAO.php";
include_once "model/dao/IngredientOrderLinesDAO.php";

class PurchaseController
{

    public function processPurchase()
    {
        include_once 'view/startSession.php';
        include_once 'view/authenticator.php';
        $discount_id = null;
        if (isset($_SESSION['promoCode'])) {
            $discount = DiscountDAO::getDiscountByCode($_SESSION['promoCode']);
            if ($discount) {
                $discount_id = $discount->getId();
                unset($_SESSION['promoCode']);
            }
        }
        $order = new Order;
        $order->setData(
            $_SESSION['user']['id'],
            $_POST['subtotal'],
            $_POST['total'],
            $_POST['deliveryType'] ?? null,
            $_POST['address'] ?? null,
            $_POST['deliveryDate'] ?? null,
            $discount_id,
            $_POST['discountApplied'] ?? null,
        );
        echo '<br>';
        $orderId = OrderDAO::saveOrder($order);
        $orderLineId = 0;
        foreach ($_SESSION['cart'] as $key => $item) {
            $product = ProductDAO::getProductById($item['product_id']);
            $orderLine = new OrderLines;
            $orderLine->setData(
                $key + 1,
                $orderId,
                $product->getId(),
                $product->getPrice(),
                $item['quantity'],
                $orderLineId != 0 ? $orderLineId : null
            );
            $orderLineId = OrderLinesDAO::saveOrderLines($orderLine);
        }
        unset($_SESSION['cart']); //clear cart after purchase

        $purchaseGetParams = http_build_query([ //turn an object into get parameters
            'controller' => 'Purchase',
            'action' => 'showPurchase',
            'orderId' => $orderId
        ]);
        header("Location: $currentUrl?$purchaseGetParams");
    }

    public function showPurchase()
    {
        include_once 'view/startSession.php';
        $view = 'view/purchase/completedPurchase.php';
        include_once 'view/main.php';
    }
}
