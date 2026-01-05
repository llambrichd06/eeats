<?php
include_once 'model/dao/OrderDAO.php';
include_once 'model/dao/LogDAO.php';


class OrderApiController
{

    // public function getOrderByID() {
    //     if (isset($_GET['id'])) {
    //         $id = $_GET['id'];
    //         $order = OrderDAO::getOrderByID($id);  
    //         echo json_encode($order->toArray()); 
    //     }
    // }

    public function getOrders()
    {
        $orders = OrderDAO::getOrders();
        $ordersArray = [];
        foreach ($orders as $order) {
            array_push($ordersArray, $order->toArray());
        }
        echo json_encode($ordersArray);
    }

    public function saveOrder($data)
    {
        if (isset($data['user_id'], $data['subtotal'], $data['total'], $data['delivery_type'],  $data['address'], $data['delivery_date'], $data['deleted'])) {

            try {
                $order = new Order();
                $order->setData($data['user_id'], $data['subtotal'], $data['total'], $data['delivery_type'], $data['address'], $data['delivery_date'], $data['discount_id'], $data['discount_applied'], $data['created_at'], $data['deleted']);
                OrderDAO::saveOrder($order);
                echo json_encode([
                    'status' => 'Success',
                    'data' => 'Order Inserted correctly',
                ]);
                $log = new Log();
                $log->setData($_SESSION['lastAdminLoginId'], 'Saved new order');
                LogDAO::saveLog($log);
            } catch (\Throwable $th) {
                http_response_code(404);
                echo json_encode([
                    'status' => 'Error',
                    'data' => 'Either user id or discount id does not exist'
                ]);
            }
        }
    }

    public function editOrder($data)
    {
        if (isset($data['id'], $data['user_id'], $data['subtotal'], $data['total'], $data['delivery_type'], $data['address'], $data['delivery_date'], $data['created_at'], $data['deleted'])) {
            try {
                $order = new Order();
                $order->setData($data['user_id'], $data['subtotal'], $data['total'], $data['delivery_type'], $data['address'], $data['delivery_date'], $data['discount_id'], $data['discount_applied'], $data['created_at'], $data['deleted'], $data['id']);
                OrderDAO::editOrder($order);
                echo json_encode([
                    'status' => 'Success',
                    'data' => 'Order edited correctly'
                ]);
                $log = new Log();
                $log->setData($_SESSION['lastAdminLoginId'], 'Edited order with id ' . $data['id']);
                LogDAO::saveLog($log);
            } catch (\Throwable $th) {
                http_response_code(404);
                echo json_encode([
                    'status' => 'Error',
                    'data' => 'Either user id or discount id does not exist'
                ]);
            }
        }
    }

    function deleteOrder($data)
    {
        if (isset($data['id'])) {
            OrderDAO::deleteOrder($data['id']);
            echo json_encode([
                'status' => 'Success',
                'data' => 'Order deleted successfully'
            ]);
            $log = new Log();
            $log->setData($_SESSION['lastAdminLoginId'], 'Deleted order with id ' . $data['id']);
            LogDAO::saveLog($log);
        }
    }
}
