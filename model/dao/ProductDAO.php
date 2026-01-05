<?php
include_once 'database/DB.php';
include_once 'model/classes/Product.php';
include_once 'model/DAO.php';

class ProductDAO implements DAO {
    public static function insertObject($array, $types) { 
        $con = DB::connect();

        $columns = array_keys($array);
        $values = array_values($array);

        $placeholders = implode(', ', array_fill(0, count($columns), '?')); //prepare question marks so we dont have risk of sql injection
        $columnList = implode(', ', $columns);
        var_dump($values);

        $stmt = $con->prepare("INSERT INTO products ($columnList) VALUES ($placeholders)"); //inserting nulls on autonincrements is as if we didn't insert anything
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
        $stmt = $con->prepare("UPDATE products SET $placeholders WHERE id = ".$array["id"]); //users can't set the ids so we dont mind using them directly
        $stmt->bind_param($types, ...$valuesArray); //three dots mean that we just put the array values like this: 'val1, val2, val3...', only when the values dont have actual keys
        $stmt->execute();
        $results = $stmt->get_result();

        $con->close();
        return $results;
    }

    public static function getProductByID($id){
        $con = DB::connect();
        $stmt = $con->prepare("SELECT * FROM products where id = ? and deleted = 0");
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $results = $stmt->get_result();

        $product = $results->fetch_object('Product'); //"Product" es la classe que tenemos de product, esto nos transforma automaticamente a objeto
        $con->close();

        return $product;
    }

    public static function getProducts() {
        $con = DB::connect();
        $stmt = $con->prepare("SELECT * FROM products where deleted = 0");
        $stmt->execute();
        $results = $stmt->get_result();

        $productList = [];

        while ($product = $results->fetch_object('Product')) { //Recorre las filas de resultado, cuando se quede sin filas, da false i asi rompe el bucle, no es comparacion porque no es ==
            $productList[]=$product;
        }
        $con->close();

        return $productList;
    }

    public static function getFeaturedProducts() {
        $con = DB::connect();
        $stmt = $con->prepare("
            select p.id AS id, p.name AS name, p.description AS description, p.price AS price, p.created_at AS created_at, p.stock AS stock, p.img AS img, p.premium AS premium, p.discount_id AS discount_id
            from products p 
            left join order_lines ol on(p.id = ol.product_id)
            left join orders o on(ol.order_id = o.id)
            where p.deleted = 0
            and o.deleted = 0
            group by p.id
            order by COUNT(ol.id) desc
            limit 6");
        $stmt->execute();
        $results = $stmt->get_result();

        $productList = [];

        while ($product = $results->fetch_object('Product')) { //Recorre las filas de resultado, cuando se quede sin filas, da false i asi rompe el bucle, no es comparacion porque no es ==
            $productList[]=$product;
        }
        $con->close();

        return $productList;
    }
    
    public static function saveProduct(Product $product) {
        $product->setCreatedAt(date('Y-m-d H:i:s'));
        $result = ProductDAO::insertObject($product->toArray(), 'issisisiii');
    }
    public static function editProduct(Product $product) {
        $result = ProductDAO::UpdateObject($product->toArray(), 'issisisiii');
    }
    public static function deleteProduct($id) {
        $con = DB::connect();
        $stmt = $con->prepare("UPDATE products SET deleted = 1 WHERE id = ?");
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $results = $stmt->get_result();
        
        return $results;
    }
}
    