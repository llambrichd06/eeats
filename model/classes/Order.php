<?php

class Order
{

    private $id;
    private $userId;
    private $createdAt;
    private $address;
    private $deliveryType;
    private $total;
    private $subtotal;
    private $deliveryDate;
    private $discountId;
    private $discountApplied;
    private $deleted;

    public function setData(
        $userId = null,
        $address = null,
        $deliveryType = null,
        $total = null,
        $subtotal = null,
        $deliveryDate = null,
        $discountId = null,
        $discountApplied = null,
        $createdAt = null,
        $deleted = null,
        $id = null
    ) {
        $this->userId = $userId;
        $this->createdAt = $createdAt;
        $this->address = $address;
        $this->deliveryType = $deliveryType;
        $this->total = $total;
        $this->subtotal = $subtotal;
        $this->deliveryDate = $deliveryDate;
        $this->discountId = $discountId;
        $this->discountApplied = $discountApplied;
        $this->deleted = $deleted;
        $this->id = $id;
    }

    public function getDiscountApplied(){
        return $this->discountApplied;
    }

    public function setDiscountApplied($discountApplied){
        $this->discountApplied = $discountApplied;
        return $this;
    }

    public function getDiscountId(){
        return $this->discountId;
    }

    public function setDiscountId($discountId){
        $this->discountId = $discountId;
        return $this;
    }

    public function getDeliveryDate(){
        return $this->deliveryDate;
    }

    public function setDeliveryDate($deliveryDate){
        $this->deliveryDate = $deliveryDate;
        return $this;
    }

    public function getSubtotal(){
        return $this->subtotal;
    }

    public function setSubtotal($subtotal){
        $this->subtotal = $subtotal;
        return $this;
    }

    public function getTotal(){
        return $this->total;
    }

    public function setTotal($total){
        $this->total = $total;
        return $this;
    }

    public function getDeliveryType(){
        return $this->deliveryType;
    }

    public function setDeliveryType($deliveryType){
        $this->deliveryType = $deliveryType;
        return $this;
    }

    public function getAddress(){
        return $this->address;
    }

    public function setAddress($address){
        $this->address = $address;
        return $this;
    }

    public function getCreatedAt(){
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt){
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUserId(){
        return $this->userId;
    }

    public function setUserId($userId){
        $this->userId = $userId;
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
    
    public function toArray() {
        return get_object_vars($this);
    }
}
