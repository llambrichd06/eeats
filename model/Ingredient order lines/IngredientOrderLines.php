<?php

class IngredientOrderLines
{
    private $ingredientId;
    private $orderLineId;
    private $status;
    private $price;
    private $cookPointId;

    public function __construct(
        $ingredientId = null,
        $orderLineId = null,
        $status = null,
        $price = null,
        $cookPointId = null
    ) {
        $this->ingredientId = $ingredientId;
        $this->orderLineId = $orderLineId;
        $this->status = $status;
        $this->price = $price;
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
}
