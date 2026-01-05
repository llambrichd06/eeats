<?php
include_once 'model/dao/OrderDAO.php';


class OrderApiController {

    // public function getOrderByID() {
    //     if (isset($_GET['id'])) {
    //         $id = $_GET['id'];
    //         $order = OrderDAO::getOrderByID($id);  
    //         echo json_encode($order->toArray()); 
    //     }
    // }

    public function getOrders() {
        $orders = OrderDAO::getOrders();
        $ordersArray = [];
        foreach ($orders as $order) {
            array_push($ordersArray, $order->toArray());
        }
        echo json_encode($ordersArray); 
    }

    public function saveOrder($data) {
        if (isset($data['user_id'], $data['subtotal'], $data['total'], $data['delivery_type'],  $data['address'], $data['delivery_date'], $data['deleted'])) {
            $order = new Order();
            $order->setData($data['user_id'], $data['subtotal'], $data['total'], $data['delivery_type'], $data['address'], $data['delivery_date'], $data['discount_id'], $data['discount_applied'], $data['created_at'], $data['deleted']);
            OrderDAO::saveOrder($order);
            echo json_encode([
                'status' => 'Success',
                'data' => 'Order Inserted correctly',
            ]);
        }
    }

    public function editOrder($data) {
        if (isset($data['id'], $data['user_id'], $data['subtotal'], $data['total'], $data['delivery_type'], $data['address'], $data['delivery_date'], $data['created_at'], $data['deleted'])) {
            $order = new Order();
            $order->setData($data['user_id'], $data['subtotal'], $data['total'], $data['delivery_type'], $data['address'], $data['delivery_date'], $data['discount_id'], $data['discount_applied'], $data['created_at'], $data['deleted'], $data['id']);
            OrderDAO::editOrder($order);
            echo json_encode([
                'status' => 'Success',
                'data' => 'Order edited correctly'
            ]);
        }
    }

    function deleteOrder($data) {
        if (isset($data['id'])) {
            OrderDAO::deleteOrder($data['id']);
            echo json_encode([
                'status' => 'Success',
                'data' => 'Order deleted successfully'
            ]);
        }
    }

}