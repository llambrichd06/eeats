<?php
include_once 'database/DB.php';
include_once 'model/Log/Log.php';

class LogDAO implements DAO {
    public static function insertObject($object, $types) {
        $con = DB::connect();

        $columns = array_keys(get_object_vars($object));
        $values = array_values(get_object_vars($object));

        $placeholders = implode(', ', array_fill(0, count($columns), '?')); //prepare question marks so we dont have risk of sql injection
        $columnList = implode(', ', $columns);
        $stmt = $con->prepare("INSERT INTO logs ($columnList) VALUES ($placeholders)"); //inserting nulls on autonincrements is as if we didn't insert anything
        $stmt->bind_param($types, ...$values); //three dots mean that we just put the array values like this: 'val1, val2, val3...'
        $stmt->execute();
        $results = $stmt->get_result();

        $con->close();
        return $results;
    }

    public static function getLogByID($id){
        $con = DB::connect();
        $stmt = $con->prepare("SELECT * FROM logs where id = ?");
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $results = $stmt->get_result();

        $log = $results->fetch_object('Log'); //"Log" es la classe que tenemos de log, esto nos transforma automaticamente a objeto
        $con->close();

        return $log;
    }

    public static function getLogs() {
        $con = DB::connect();
        $stmt = $con->prepare("SELECT * FROM logs");
        $stmt->execute();
        $results = $stmt->get_result();

        $logList = [];

        while ($log = $results->fetch_object('Log')) { //Recorre las filas de resultado, cuando se quede sin filas, da false i asi rompe el bucle, no es comparacion porque no es ==
            $logList[]=$log;
        }
        $con->close();

        return $logList;
    }
    
    public static function saveLog(Log $log) {
        $result = LogDAO::insertObject($log, 'iiss');
    }
}
    