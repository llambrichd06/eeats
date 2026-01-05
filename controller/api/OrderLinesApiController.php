<?php
include_once 'model/dao/OrderLinesDAO.php';

class OrderLinesApiController {

    // public function getOrderLinesByID() {
    //     if (isset($_GET['id'])) {
    //         $id = $_GET['id'];
    //         $orderLine = OrderLinesDAO::getOrderLinesByID($id);  
    //         echo json_encode($orderLine->toArray()); 
    //     }
    // }

    public function getOrderLinesByOrderId() {
        $order_id = $_GET['order_id'];
        $orderLines = OrderLinesDAO::getOrderLinesByOrderId($order_id);
        $orderLinesArray = [];
        foreach ($orderLines as $line) {
            array_push($orderLinesArray, $line->toArray());
        }
        echo json_encode($orderLinesArray);
    }

    public function saveOrderLine($data) {
        if (isset($data['id'], $data['line_num'], $data['order_id'], $data['product_id'], $data['price'], $data['quantity'])) {
            $orderLine = new OrderLines();
            $orderLine->setData(
                $data['line_num'],
                $data['order_id'],
                $data['product_id'],
                $data['price'],
                $data['quantity'],
                $data['id']
            );
            try {
                OrderLinesDAO::saveOrderLines($orderLine);
                echo json_encode([
                    'status' => 'Success',
                    'data' => 'Order line inserted correctly',
                ]);
            } catch (\Throwable $th) {
                http_response_code(409);
                echo json_encode([
                    'status' => 'Error',
                    'data' => 'Already existing order line'
                ]);
            }
            
        }
    }

    public function editOrderLine($data) {
        if (isset($data['id'], $data['line_num'], $data['order_id'], $data['product_id'], $data['price'], $data['quantity'])) {
            $orderLine = new OrderLines();
            $orderLine->setData(
                $data['line_num'],
                $data['order_id'],
                $data['product_id'],
                $data['price'],
                $data['quantity'],
                $data['id']
            );
            OrderLinesDAO::editOrderLines($orderLine);
            echo json_encode([
                'status' => 'Success',
                'data' => 'Order line edited correctly'
            ]);
        }
    }
}
