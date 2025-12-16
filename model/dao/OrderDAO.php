<?php
include_once 'database/DB.php';
include_once 'model/classes/Order.php';
include_once 'model/DAO.php';

class OrderDAO implements DAO {
    public static function insertObject($array, $types) {
        $con = DB::connect();

        $columns = array_keys($array);
        $values = array_values($array);

        $placeholders = implode(', ', array_fill(0, count($columns), '?')); //prepare question marks so we dont have risk of sql injection
        $columnList = implode(', ', $columns);
        $stmt = $con->prepare("INSERT INTO orders ($columnList) VALUES ($placeholders)"); //inserting nulls on autonincrements is as if we didn't insert anything
        $stmt->bind_param($types, ...$values); //three dots mean that we just put the array values like this: 'val1, val2, val3...'
        $stmt->execute();
        $results = $stmt->get_result();

        $con->close();
        return $results;
    }

        static function UpdateObject($array, $types) {
        $con = DB::connect();

        $sqlArray = [];
        $valuesArray = [];
        foreach ($array as $key => $value) {
            array_push($sqlArray, "$key = ?");
            array_push($valuesArray, $value);
        }
        
        $placeholders = implode(", ", $sqlArray); //prepare question marks so we dont have risk of sql injection
        $stmt = $con->prepare("UPDATE orders SET $placeholders WHERE id = ".$array["id"]); //users can't set the ids so we dont mind using them directly
        $stmt->bind_param($types, ...$valuesArray); //three dots mean that we just put the array values like this: 'val1, val2, val3...', only when the values dont have actual keys
        $stmt->execute();
        $results = $stmt->get_result();

        $con->close();
        return $results;
    }

    public static function getOrderByID($id){
        $con = DB::connect();
        $stmt = $con->prepare("SELECT * FROM orders where id = ? and deleted = 0");
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $results = $stmt->get_result();

        $order = $results->fetch_object('Order'); //"Order" es la classe que tenemos de order, esto nos transforma automaticamente a objeto
        $con->close();

        return $order;
    }

    public static function getOrders() {
        $con = DB::connect();
        $stmt = $con->prepare("SELECT * FROM orders where deleted = 0");
        $stmt->execute();
        $results = $stmt->get_result();

        $orderList = [];

        while ($order = $results->fetch_object('Order')) { //Recorre las filas de resultado, cuando se quede sin filas, da false i asi rompe el bucle, no es comparacion porque no es ==
            $orderList[]=$order;
        }
        $con->close();

        return $orderList;
    }
    
    public static function saveOrder(Order $order) {
        $order->setCreatedAt(date('Y-m-d H:i:s'));
        $result = OrderDAO::insertObject($order->toArray(), 'iisssiisiii');
    }
    public static function editOrder(Order $order) {
        $result = OrderDAO::UpdateObject($order->toArray(), 'iisssiisiii');
    }
    public static function deleteOrder($id) {
        $con = DB::connect();
        $stmt = $con->prepare("UPDATE orders SET deleted = 1 WHERE id = ?");
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $results = $stmt->get_result();
        
        return $results;
    }
}
    