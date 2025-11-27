<?php
include_once 'database/DB.php';
include_once 'model/classes/IngredientOrderLines.php';
include_once 'model/DAO.php';

class IngredientOrderLinesDAO implements DAO {
    public static function insertObject($object, $types) {
        $con = DB::connect();

        $columns = array_keys(get_object_vars($object));
        $values = array_values(get_object_vars($object));

        $placeholders = implode(', ', array_fill(0, count($columns), '?')); //prepare question marks so we dont have risk of sql injection
        $columnList = implode(', ', $columns);
        $stmt = $con->prepare("INSERT INTO order_line_ingredients ($columnList) VALUES ($placeholders)"); //inserting nulls on autonincrements is as if we didn't insert anything
        $stmt->bind_param($types, ...$values); //three dots mean that we just put the array values like this: 'val1, val2, val3...'
        $stmt->execute();
        $results = $stmt->get_result();

        $con->close();
        return $results;
    }

    public static function getIngredientOrderLinesByID($id){ //TODO: Remove or change, since this class has no ID attribute
        $con = DB::connect();
        $stmt = $con->prepare("SELECT * FROM order_line_ingredients where id = ?");
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $results = $stmt->get_result();

        $iOrderLines = $results->fetch_object('IngredientOrderLines'); //"IngredientOrderLines" es la classe que tenemos de order, esto nos transforma automaticamente a objeto
        $con->close();

        return $iOrderLines;
    }

    public static function getIngredientOrderLines() {
        $con = DB::connect();
        $stmt = $con->prepare("SELECT * FROM order_line_ingredients");
        $stmt->execute();
        $results = $stmt->get_result();

        $iOrderLineList = [];

        while ($iOrderLines = $results->fetch_object('IngredientOrderLines')) { //Recorre las filas de resultado, cuando se quede sin filas, da false i asi rompe el bucle, no es comparacion porque no es ==
            $iOrderLineList[]=$iOrderLines;
        }
        $con->close();

        return $iOrderLineList;
    }
    
    public static function saveIngredientOrderLines(IngredientOrderLines $iOrderLines) {
        $result = IngredientOrderLinesDAO::insertObject($iOrderLines, 'iissi');
    }
}
    