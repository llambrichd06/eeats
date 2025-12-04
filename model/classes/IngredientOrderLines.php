<?php

class IngredientOrderLines
{
    private $ingredientId;
    private $orderLineId;
    /**POSSIBLE STATUSES:
     *   added   -> An ingredient that wasn't originally in the product, but was added
     *   default -> An ingredient that is on the product by default.
     *   removed -> A default ingredient, that was removed from the product.
    */
    private $status;
    private $price;
    private $cookPointId;
    private $deleted;

    public function setData(
        $ingredientId = null,
        $orderLineId = null,
        $status = null,
        $price = null,
        $deleted = null,
        $cookPointId = null
    ) {
        $this->ingredientId = $ingredientId;
        $this->orderLineId = $orderLineId;
        $this->status = $status;
        $this->price = $price;
        $this->deleted = $deleted;
        $this->cookPointId = $cookPointId;
    }

    public function getIngredientId() {
        return $this->ingredientId;
    }

    public function setIngredientId($ingredientId) {
        $this->ingredientId = $ingredientId;
        return $this;
    }

    public function getOrderLineId() {
        return $this->orderLineId;
    }

    public function setOrderLineId($orderLineId) {
        $this->orderLineId = $orderLineId;
        return $this;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
        return $this;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
        return $this;
    }

    public function getCookPointId() {
        return $this->cookPointId;
    }

    public function setCookPointId($cookPointId) {
        $this->cookPointId = $cookPointId;
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
