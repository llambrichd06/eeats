<?php
include_once 'database/DB.php';
include_once 'model/classes/Product.php';
include_once 'model/DAO.php';

class ProductDAO implements DAO {
    public static function insertObject($object, $types) { //TODO/TOASK: make this not public somehow, ask teachers when avalible
        $con = DB::connect();

        $columns = array_keys(get_object_vars($object));
        $values = array_values(get_object_vars($object));

        $placeholders = implode(', ', array_fill(0, count($columns), '?')); //prepare question marks so we dont have risk of sql injection
        $columnList = implode(', ', $columns);
        $stmt = $con->prepare("INSERT INTO products ($columnList) VALUES ($placeholders)"); //inserting nulls on autonincrements is as if we didn't insert anything
        $stmt->bind_param($types, ...$values); //three dots mean that we just put the array values like this: 'val1, val2, val3...'
        $stmt->execute();
        $results = $stmt->get_result();

        $con->close();
        return $results;
    }

    public static function getProductByID($id){
        $con = DB::connect();
        $stmt = $con->prepare("SELECT * FROM products where id = ?");
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $results = $stmt->get_result();

        $product = $results->fetch_object('Product'); //"Product" es la classe que tenemos de product, esto nos transforma automaticamente a objeto
        $con->close();

        return $product;
    }

    public static function getProducts() {
        $con = DB::connect();
        $stmt = $con->prepare("SELECT * FROM products");
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
        $result = ProductDAO::insertObject($product, 'issisisii');
    }
}
    