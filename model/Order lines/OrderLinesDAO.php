<?php
include_once 'DB/DB.php';
include_once 'model/OrderLines.php';

class OrderLinesDAO implements DAO {
    public static function insertObject($object, $types) { 
        $con = DB::connect();

        $columns = array_keys(get_object_vars($object));
        $values = array_values(get_object_vars($object));

        $placeholders = implode(', ', array_fill(0, count($columns), '?')); //prepare question marks so we dont have risk of sql injection
        $columnList = implode(', ', $columns);
        $stmt = $con->prepare("INSERT INTO order_lines ($columnList) VALUES ($placeholders)");
        $stmt->bind_param($types, ...$values); //three dots mean that we just put the array values like this: 'val1, val2, val3...'
        $stmt->execute();
        $results = $stmt->get_result();

        $con->close();
        return $results;
    }

    public static function getOrderLinesById($id){
        $con = DB::connect();
        $stmt = $con->prepare("SELECT * FROM order_lines where id = ?");
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $results = $stmt->get_result();

        $orderLines = $results->fetch_object('OrderLines'); //"OrderLines" es la classe que tenemos de order lines, esto nos transforma automaticamente a objeto
        $con->close();

        return $orderLines;
    }

    public static function getOrderLines() {
        $con = DB::connect();
        $stmt = $con->prepare("SELECT * FROM order_lines");
        $stmt->execute();
        $results = $stmt->get_result();

        $orderLineList = [];

        while ($orderLines = $results->fetch_object('OrderLines')) { //Recorre las filas de resultado, cuando se quede sin filas, da false i asi rompe el bucle, no es comparacion porque no es ==
            $orderLineList[]=$orderLines;
        }
        $con->close();

        return $orderLineList;
    }
    public static function saveUser(OrderLines $orderLines) {
        $result = UserDAO::insertObject($orderLines, 'iiiiii');
    }
}
    