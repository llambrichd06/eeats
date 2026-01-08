<?php
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
            $product->getDiscountId() ? $product->getDiscountId() : null,
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
?>