<?php

class OrderLines
{
    private $id;
    private $lineNum;
    private $orderId;
    private $productId;
    private $price;
    private $quantity;

    public function setData(
        $lineNum = null,
        $orderId = null,
        $productId = null,
        $price = null,
        $quantity = null,
        $id = null
    ) {
        $this->lineNum = $lineNum;
        $this->orderId = $orderId;
        $this->productId = $productId;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getLineNum() {
        return $this->lineNum;
    }

    public function setLineNum($lineNum) {
        $this->lineNum = $lineNum;
        return $this;
    }

    public function getOrderId() {
        return $this->orderId;
    }

    public function setOrderId($orderId) {
        $this->orderId = $orderId;
        return $this;
    }

    public function getProductId() {
        return $this->productId;
    }

    public function setProductId($productId) {
        $this->productId = $productId;
        return $this;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
        return $this;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
        return $this;
    }
}
