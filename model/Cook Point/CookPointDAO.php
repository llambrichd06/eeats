<?php
include_once 'database/DB.php';
include_once 'model/CookPoint/CookPoint.php';

class CookPointDAO implements DAO {
    public static function insertObject($object, $types) {
        $con = DB::connect();

        $columns = array_keys(get_object_vars($object));
        $values = array_values(get_object_vars($object));

        $placeholders = implode(', ', array_fill(0, count($columns), '?')); //prepare question marks so we dont have risk of sql injection
        $columnList = implode(', ', $columns);
        $stmt = $con->prepare("INSERT INTO cook_points ($columnList) VALUES ($placeholders)"); //inserting nulls on autonincrements is as if we didn't insert anything
        $stmt->bind_param($types, ...$values); //three dots mean that we just put the array values like this: 'val1, val2, val3...'
        $stmt->execute();
        $results = $stmt->get_result();

        $con->close();
        return $results;
    }

    public static function getCookPointByID($id){
        $con = DB::connect();
        $stmt = $con->prepare("SELECT * FROM cook_points where id = ?");
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $results = $stmt->get_result();

        $cookPoint = $results->fetch_object('CookPoint'); //"CookPoint" es la classe que tenemos de cookPoint, esto nos transforma automaticamente a objeto
        $con->close();

        return $cookPoint;
    }

    public static function getCookPoints() {
        $con = DB::connect();
        $stmt = $con->prepare("SELECT * FROM cook_points");
        $stmt->execute();
        $results = $stmt->get_result();

        $cookPointList = [];

        while ($cookPoint = $results->fetch_object('CookPoint')) { //Recorre las filas de resultado, cuando se quede sin filas, da false i asi rompe el bucle, no es comparacion porque no es ==
            $cookPointList[]=$cookPoint;
        }
        $con->close();

        return $cookPointList;
    }
    
    public static function saveCookPoint(CookPoint $cookPoint) {
        $result = CookPointDAO::insertObject($cookPoint, 'is');
    }
}
    