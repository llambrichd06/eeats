<?php
include_once 'database/DB.php';
include_once 'model/classes/OrderLines.php';
include_once 'model/DAO.php';

class OrderLinesDAO implements DAO {
    public static function insertObject($object, $types) { 
        $con = DB::connect();

        $columns = array_keys($object);
        $values = array_values($object);

        $placeholders = implode(', ', array_fill(0, count($columns), '?')); //prepare question marks so we dont have risk of sql injection
        $columnList = implode(', ', $columns);
        $stmt = $con->prepare("INSERT INTO order_lines ($columnList) VALUES ($placeholders)");
        $stmt->bind_param($types, ...$values); //three dots mean that we just put the array values like this: 'val1, val2, val3...'
        $stmt->execute();
        $insertedId = $con->insert_id;

        $con->close();
        return $insertedId;
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
        $stmt = $con->prepare("UPDATE order_lines SET $placeholders WHERE id = ".$array["id"]." AND line_num = ".$array["line_num"]); //users can't set the ids so we dont mind using them directly
        $stmt->bind_param($types, ...$valuesArray); //three dots mean that we just put the array values like this: 'val1, val2, val3...', only when the values dont have actual keys
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



    public static function getOrderLinesByOrderId($id){
        $con = DB::connect();
        $stmt = $con->prepare("SELECT * FROM order_lines where order_id = ?");
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $results = $stmt->get_result();

        $orderLineList = [];

        while ($orderLines = $results->fetch_object('OrderLines')) { //Recorre las filas de resultado, cuando se quede sin filas, da false i asi rompe el bucle, no es comparacion porque no es ==
            $orderLineList[]=$orderLines;
        }
        $con->close();

        return $orderLineList;
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
    public static function saveOrderLines(OrderLines $orderLines) {
        $insertedId = OrderLinesDAO::insertObject($orderLines->toArray(), 'iiiiiii');
        return $insertedId;
    }
    public static function editOrderLines(OrderLines $orderLines) {
        $result = OrderLinesDAO::UpdateObject($orderLines->toArray(), 'iiiiiii');
    }
}
    