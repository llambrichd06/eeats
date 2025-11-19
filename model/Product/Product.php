<?php
class Product 
{

    private $id;
    private $name;
    private $description;
    private $price;
    private $createdAt;
    private $stock;
    private $img;
    private $premium;
    private $discountId;

    public function __construct(
        $name = null,
        $description = null,
        $price = null,
        $createdAt = null,
        $stock = null,
        $img = null,
        $premium = null,
        $discountId = null,
        $id = null
    ) {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->createdAt = $createdAt;
        $this->stock = $stock;
        $this->img = $img;
        $this->premium = $premium;
        $this->discountId = $discountId;
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
    return $this->createdAt;
}

public function setCreatedAt($createdAt){
    $this->createdAt = $createdAt;
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
    return $this->discountId;
}

public function setDiscountId($discountId){
    $this->discountId = $discountId;
    return $this;
}

public function getId(){
    return $this->id;
}

public function setId($id){
    $this->id = $id;
    return $this;
}

}
