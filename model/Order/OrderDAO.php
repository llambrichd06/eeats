<?php
include_once 'database/DB.php';
include_once 'model/Order/Order.php';
include_once 'model/DAO.php';

class OrderDAO implements DAO {
    public static function insertObject($object, $types) {
        $con = DB::connect();

        $columns = array_keys(get_object_vars($object));
        $values = array_values(get_object_vars($object));

        $placeholders = implode(', ', array_fill(0, count($columns), '?')); //prepare question marks so we dont have risk of sql injection
        $columnList = implode(', ', $columns);
        $stmt = $con->prepare("INSERT INTO orders ($columnList) VALUES ($placeholders)"); //inserting nulls on autonincrements is as if we didn't insert anything
        $stmt->bind_param($types, ...$values); //three dots mean that we just put the array values like this: 'val1, val2, val3...'
        $stmt->execute();
        $results = $stmt->get_result();

        $con->close();
        return $results;
    }

    public static function getOrderByID($id){
        $con = DB::connect();
        $stmt = $con->prepare("SELECT * FROM orders where id = ?");
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $results = $stmt->get_result();

        $order = $results->fetch_object('Order'); //"Order" es la classe que tenemos de order, esto nos transforma automaticamente a objeto
        $con->close();

        return $order;
    }

    public static function getOrders() {
        $con = DB::connect();
        $stmt = $con->prepare("SELECT * FROM orders");
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
        $result = OrderDAO::insertObject($order, 'iissiiisii');
    }
}
    