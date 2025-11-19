<?php
include_once 'database/DB.php';
include_once 'model/ProductCategory/ProductCategory.php';
include_once 'model/DAO.php';

class ProductCategoryDAO implements DAO {
    public static function insertObject($object, $types) {
        $con = DB::connect();

        $columns = array_keys(get_object_vars($object));
        $values = array_values(get_object_vars($object));

        $placeholders = implode(', ', array_fill(0, count($columns), '?')); //prepare question marks so we dont have risk of sql injection
        $columnList = implode(', ', $columns);
        $stmt = $con->prepare("INSERT INTO product_categories ($columnList) VALUES ($placeholders)"); //inserting nulls on autonincrements is as if we didn't insert anything
        $stmt->bind_param($types, ...$values); //three dots mean that we just put the array values like this: 'val1, val2, val3...'
        $stmt->execute();
        $results = $stmt->get_result();

        $con->close();
        return $results;
    }

    public static function getProductCategoryByID($id){ //TODO: just like on ingredient order lines, a getbyid doesen't work here
        $con = DB::connect();
        $stmt = $con->prepare("SELECT * FROM product_categories where id = ?");
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $results = $stmt->get_result();

        $productCategory = $results->fetch_object('ProductCategory'); //"ProductCategory" es la classe que tenemos de product, esto nos transforma automaticamente a objeto
        $con->close();

        return $productCategory;
    }

    public static function getProductCategorys() {
        $con = DB::connect();
        $stmt = $con->prepare("SELECT * FROM product_categories");
        $stmt->execute();
        $results = $stmt->get_result();

        $productCategoryList = [];

        while ($productCategory = $results->fetch_object('ProductCategory')) { //Recorre las filas de resultado, cuando se quede sin filas, da false i asi rompe el bucle, no es comparacion porque no es ==
            $productCategoryList[]=$productCategory;
        }
        $con->close();

        return $productCategoryList;
    }
    
    public static function saveProductCategory(ProductCategory $productCategory) {
        $result = ProductCategoryDAO::insertObject($productCategory, 'issisisii');
    }
}
    