<?php
include_once 'database/DB.php';

interface DAO {
    static function insertObject($object, $types); //{ //Might be better to make this abstract and link it to every DAO
    //     $con = DB::connect();
    //     $objectValues = get_object_vars($object);
        
    //     $columns = array_keys(get_object_vars($object));
    //     $values = array_values(get_object_vars($object));

    //     $placeholders = implode(', ', array_fill(0, count($objectValues), '?')); //prepare question marks so we dont have risk of sql injection
    //     $columnList = implode(', ', $columns);

    //     $stmt = $con->prepare("INSERT INTO $table ($columnList) VALUES ($placeholders)");
    //     $stmt->bind_param($types, ...$values); //three dots mean that we just put the array values
    //     $stmt->execute();

    // }
}
