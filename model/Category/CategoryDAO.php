<?php
include_once 'database/DB.php';
include_once 'model/Category/Category.php';
include_once 'model/DAO.php';

class CategoryDAO implements DAO {
    public static function insertObject($object, $types) {
        $con = DB::connect();

        $columns = array_keys(get_object_vars($object));
        $values = array_values(get_object_vars($object));

        $placeholders = implode(', ', array_fill(0, count($columns), '?')); //prepare question marks so we dont have risk of sql injection
        $columnList = implode(', ', $columns);
        $stmt = $con->prepare("INSERT INTO categories ($columnList) VALUES ($placeholders)"); //inserting nulls on autonincrements is as if we didn't insert anything
        $stmt->bind_param($types, ...$values); //three dots mean that we just put the array values like this: 'val1, val2, val3...'
        $stmt->execute();
        $results = $stmt->get_result();

        $con->close();
        return $results;
    }

    public static function getCategoryByID($id){
        $con = DB::connect();
        $stmt = $con->prepare("SELECT * FROM categories where id = ?");
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $results = $stmt->get_result();

        $category = $results->fetch_object('Category'); //"Category" es la classe que tenemos de category, esto nos transforma automaticamente a objeto
        $con->close();

        return $category;
    }

    public static function getCategories() {
        $con = DB::connect();
        $stmt = $con->prepare("SELECT * FROM categories");
        $stmt->execute();
        $results = $stmt->get_result();

        $categoryList = [];

        while ($category = $results->fetch_object('Category')) { //Recorre las filas de resultado, cuando se quede sin filas, da false i asi rompe el bucle, no es comparacion porque no es ==
            $categoryList[]=$category;
        }
        $con->close();

        return $categoryList;
    }
    
    public static function saveCategory(Category $category) {
        $result = CategoryDAO::insertObject($category, 'is');
    }
}
    