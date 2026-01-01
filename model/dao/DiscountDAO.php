<?php
include_once 'database/DB.php';
include_once 'model/classes/Discount.php';
include_once 'model/DAO.php';

class DiscountDAO implements DAO {
    public static function insertObject($object, $types) {
        $con = DB::connect();

        $columns = array_keys(get_object_vars($object));
        $values = array_values(get_object_vars($object));

        $placeholders = implode(', ', array_fill(0, count($columns), '?')); //prepare question marks so we dont have risk of sql injection
        $columnList = implode(', ', $columns);
        $stmt = $con->prepare("INSERT INTO discounts ($columnList) VALUES ($placeholders)"); //inserting nulls on autonincrements is as if we didn't insert anything
        $stmt->bind_param($types, ...$values); //three dots mean that we just put the array values like this: 'val1, val2, val3...'
        $stmt->execute();
        $results = $stmt->get_result();

        $con->close();
        return $results;
    }

    public static function getDiscountByID($id){
        $con = DB::connect();
        $stmt = $con->prepare("SELECT * FROM discounts where id = ? and deleted = 0");
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $results = $stmt->get_result();

        $discount = $results->fetch_object('Discount'); //"Discount" es la classe que tenemos de discount, esto nos transforma automaticamente a objeto
        $con->close();

        return $discount;
    }

    public static function getDiscounts() {
        $con = DB::connect();
        $stmt = $con->prepare("SELECT * FROM discounts where deleted = 0");
        $stmt->execute();
        $results = $stmt->get_result();

        $discountList = [];

        while ($discount = $results->fetch_object('Discount')) { //Recorre las filas de resultado, cuando se quede sin filas, da false i asi rompe el bucle, no es comparacion porque no es ==
            $discountList[]=$discount;
        }
        $con->close();

        return $discountList;
    }

    public static function getLastDiscounts() {
        $con = DB::connect();
        $stmt = $con->prepare("SELECT d.id as discount_id, p.id as product_id, p.name as name, p.img as img, d.percent as percent, d.ends_at as ends_at
        from discounts d join products p on(d.id = p.discount_id)
        where d.begins_at < sysdate()
        and d.ends_at > sysdate()
        and d.`type` = 1
        and d.deleted != 1
        order by d.begins_at desc
        limit 3");
        $stmt->execute();
        $results = $stmt->get_result();
        $discountList = [];

        while ($discount = $results->fetch_assoc()) { //Recorre las filas de resultado, cuando se quede sin filas, da false i asi rompe el bucle, no es comparacion porque no es ==
            $discountList[]=$discount;
        }
        $con->close();

        return $discountList;
    }
    
    public static function saveDiscount(Discount $discount) {
        $result = DiscountDAO::insertObject($discount, 'iissiiisii');
    }
}
    