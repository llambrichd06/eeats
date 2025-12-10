<?php
include_once 'database/DB.php';
include_once 'model/classes/User.php';
include_once 'model/DAO.php';

class UserDAO implements DAO {
    static function insertObject($array, $types) {
        $con = DB::connect();

        $columns = array_keys($array);
        $values = array_values($array);
        
        $placeholders = implode(', ', array_fill(0, count($columns), '?')); //prepare question marks so we dont have risk of sql injection
        $columnList = implode(', ', $columns);
        $stmt = $con->prepare("INSERT INTO users ($columnList) VALUES ($placeholders)"); //inserting nulls on autonincrements is as if we didn't insert anything
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
        $stmt = $con->prepare("UPDATE users SET $placeholders WHERE id = ".$array["id"]);
        $stmt->bind_param($types, ...$valuesArray); //three dots mean that we just put the array values like this: 'val1, val2, val3...', only when the values dont have actual keys
        $stmt->execute();
        $results = $stmt->get_result();

        $con->close();
        return $results;
    }

    public static function getUserByID($id){
        $con = DB::connect();
        $stmt = $con->prepare("SELECT * FROM users where id = ? and deleted = 0");
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $results = $stmt->get_result();

        $user = $results->fetch_object('User'); //"User" es la classe que tenemos de user, esto nos transforma automaticamente a objeto
        $con->close();

        return $user;
    }

    public static function getUsers() {
        $con = DB::connect();
        $stmt = $con->prepare("SELECT * FROM users where deleted = 0");
        $stmt->execute();
        $results = $stmt->get_result();

        $userList = [];

        while ($user = $results->fetch_object('User')) { //Recorre las filas de resultado, cuando se quede sin filas, da false i asi rompe el bucle, no es comparacion porque no es ==
            $userList[]=$user;
        }
        $con->close();

        return $userList;
    }
    
    public static function saveUser(User $user) {
        $result = UserDAO::insertObject($user->toArray(), 'isssssii');
    }

    public static function editUser(User $user) {
        $result = UserDAO::UpdateObject($user->toArray(), 'isssssii');
    }
    public static function deleteUser($id) {
        $con = DB::connect();
        $stmt = $con->prepare("UPDATE users SET deleted = 1 WHERE id = ?");
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $results = $stmt->get_result();
        
        return $results;
    }
}
    