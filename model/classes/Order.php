<?php

class Order
{

    private $id;
    private $user_id;
    private $created_at;
    private $address;
    /**
     * This can have two values: pickup and delivery
     * pickup: signifies that the order is to pickup at the restaurant. when this is the case, there will be no delivery date AND address.
     * delivery: signifies that the order will be delivered to the client
     */
    private $delivery_type;
    private $subtotal;
    private $total;
    private $delivery_date;
    private $discount_id;
    private $discount_applied;
    private $deleted;

    public function setData(
        $user_id = null,
        $delivery_type = null,
        $subtotal = null,
        $total = null,
        $discount_id = null,
        $discount_applied = null,
        $delivery_date = null,
        $address = null,
        $created_at = null,
        $deleted = null,
        $id = null
    ) {
        $this->user_id = $user_id;
        $this->created_at = $created_at;
        $this->address = $address;
        $this->delivery_type = $delivery_type;
        $this->total = $total;
        $this->subtotal = $subtotal;
        $this->delivery_date = $delivery_date;
        $this->discount_id = $discount_id;
        $this->discount_applied = $discount_applied;
        $this->deleted = $deleted;
        $this->id = $id;
    }

    public function getDiscountApplied(){
        return $this->discount_applied;
    }

    public function setDiscountApplied($discount_applied){
        $this->discount_applied = $discount_applied;
        return $this;
    }

    public function getDiscountId(){
        return $this->discount_id;
    }

    public function setDiscountId($discount_id){
        $this->discount_id = $discount_id;
        return $this;
    }

    public function getDeliveryDate(){
        return $this->delivery_date;
    }

    public function setDeliveryDate($delivery_date){
        $this->delivery_date = $delivery_date;
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
        return $this->delivery_type;
    }

    public function setDeliveryType($delivery_type){
        $this->delivery_type = $delivery_type;
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
        return $this->created_at;
    }

    public function setCreatedAt($created_at){
        $this->created_at = $created_at;
        return $this;
    }

    public function getUserId(){
        return $this->user_id;
    }

    public function setUserId($user_id){
        $this->user_id = $user_id;
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
