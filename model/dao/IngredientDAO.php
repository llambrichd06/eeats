<?php
include_once 'database/DB.php';
include_once 'model/classes/Ingredient.php';
include_once 'model/DAO.php';

class IngredientDAO implements DAO {
    public static function insertObject($object, $types) {
        $con = DB::connect();

        $columns = array_keys(get_object_vars($object));
        $values = array_values(get_object_vars($object));

        $placeholders = implode(', ', array_fill(0, count($columns), '?')); //prepare question marks so we dont have risk of sql injection
        $columnList = implode(', ', $columns);
        $stmt = $con->prepare("INSERT INTO ingredients ($columnList) VALUES ($placeholders)"); //inserting nulls on autonincrements is as if we didn't insert anything
        $stmt->bind_param($types, ...$values); //three dots mean that we just put the array values like this: 'val1, val2, val3...'
        $stmt->execute();
        $results = $stmt->get_result();

        $con->close();
        return $results;
    }

    public static function getIngredientByID($id){
        $con = DB::connect();
        $stmt = $con->prepare("SELECT * FROM ingredients where id = ? and deleted = 0");
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $results = $stmt->get_result();

        $ingredient = $results->fetch_object('Ingredient'); //"Ingredient" es la classe que tenemos de ingredient, esto nos transforma automaticamente a objeto
        $con->close();

        return $ingredient;
    }

    public static function getIngredients() {
        $con = DB::connect();
        $stmt = $con->prepare("SELECT * FROM ingredients where deleted = 0");
        $stmt->execute();
        $results = $stmt->get_result();

        $ingredientList = [];

        while ($ingredient = $results->fetch_object('Ingredient')) { //Recorre las filas de resultado, cuando se quede sin filas, da false i asi rompe el bucle, no es comparacion porque no es ==
            $ingredientList[]=$ingredient;
        }
        $con->close();

        return $ingredientList;
    }
    
    public static function saveIngredient(Ingredient $ingredient) {
        $result = IngredientDAO::insertObject($ingredient, 'issi');
    }
}
    