<?php
include_once 'database/DB.php';
include_once 'model/ProductIngredient/ProductIngredient.php';
include_once 'model/DAO.php';

class ProductIngredientDAO implements DAO {
    public static function insertObject($object, $types) {
        $con = DB::connect();

        $columns = array_keys(get_object_vars($object));
        $values = array_values(get_object_vars($object));

        $placeholders = implode(', ', array_fill(0, count($columns), '?')); //prepare question marks so we dont have risk of sql injection
        $columnList = implode(', ', $columns);
        $stmt = $con->prepare("INSERT INTO product_ingredients ($columnList) VALUES ($placeholders)"); //inserting nulls on autonincrements is as if we didn't insert anything
        $stmt->bind_param($types, ...$values); //three dots mean that we just put the array values like this: 'val1, val2, val3...'
        $stmt->execute();
        $results = $stmt->get_result();

        $con->close();
        return $results;
    }

    public static function getProductIngredientByID($id){ //TODO: Remove or change, like the other classes without single ID
        $con = DB::connect();
        $stmt = $con->prepare("SELECT * FROM product_ingredients where id = ?");
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $results = $stmt->get_result();

        $productIngredient = $results->fetch_object('ProductIngredient'); //"ProductIngredient" es la classe que tenemos de product, esto nos transforma automaticamente a objeto
        $con->close();

        return $productIngredient;
    }

    public static function getProductIngredients() {
        $con = DB::connect();
        $stmt = $con->prepare("SELECT * FROM product_ingredients");
        $stmt->execute();
        $results = $stmt->get_result();

        $productIngredientList = [];

        while ($productIngredient = $results->fetch_object('ProductIngredient')) { //Recorre las filas de resultado, cuando se quede sin filas, da false i asi rompe el bucle, no es comparacion porque no es ==
            $productIngredientList[]=$productIngredient;
        }
        $con->close();

        return $productIngredientList;
    }
    
    public static function saveProductIngredient(ProductIngredient $productIngredient) {
        $result = ProductIngredientDAO::insertObject($productIngredient, 'issisisii');
    }
}
    