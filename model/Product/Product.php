<?php
class Product 
{

    private $id;
    private $name;
    private $description;
    private $price;
    private $created_at;
    private $stock;
    private $img;
    private $premium;
    private $discount_id;
    private $deleted;

    public function setData(
        $name = null,
        $description = null,
        $price = null,
        $created_at = null,
        $stock = null,
        $img = null,
        $premium = null,
        $discount_id = null,
        $deleted = null,
        $id = null
    ) {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->created_at = $created_at;
        $this->stock = $stock;
        $this->img = $img;
        $this->premium = $premium;
        $this->discount_id = $discount_id;
        $this->deleted = $deleted;
        $this->id = $id;
    }

public function getName(){
    return $this->name;
}

public function setName($name){
    $this->name = $name;
    return $this;
}

public function getDescription(){
    return $this->description;
}

public function setDescription($description){
    $this->description = $description;
    return $this;
}

public function getPrice(){
    return $this->price;
}

public function setPrice($price){
    $this->price = $price;
    return $this;
}

public function getCreatedAt(){
    return $this->created_at;
}

public function setCreatedAt($created_at){
    $this->created_at = $created_at;
    return $this;
}

public function getStock(){
    return $this->stock;
}

public function setStock($stock){
    $this->stock = $stock;
    return $this;
}

public function getImg(){
    return $this->img;
}

public function setImg($img){
    $this->img = $img;
    return $this;
}

public function getPremium(){
    return $this->premium;
}

public function setPremium($premium){
    $this->premium = $premium;
    return $this;
}

public function getDiscountId(){
    return $this->discount_id;
}

public function setDiscountId($discount_id){
    $this->discount_id = $discount_id;
    return $this;
}

public function getId(){
    return $this->id;
}

public function setId($id){
    $this->id = $id;
    return $this;
}
 
public function getDeleted(){
    return $this->deleted;
}

public function setDeleted($deleted){
    $this->deleted = $deleted;
    return $this;
}
}
