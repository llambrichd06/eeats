<?php

class OrderLines
{
    private $id;
    private $line_num;
    private $order_id;
    private $product_id;
    private $price;
    private $quantity;

    public function __construct(
        $line_num = null,
        $order_id = null,
        $product_id = null,
        $price = null,
        $quantity = null,
        $id = null
    ) {
        $this->line_num = $line_num;
        $this->order_id = $order_id;
        $this->product_id = $product_id;
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
        return $this->line_num;
    }

    public function setLineNum($line_num) {
        $this->line_num = $line_num;
        return $this;
    }

    public function getOrderId() {
        return $this->order_id;
    }

    public function setOrderId($order_id) {
        $this->order_id = $order_id;
        return $this;
    }

    public function getProductId() {
        return $this->product_id;
    }

    public function setProductId($product_id) {
        $this->product_id = $product_id;
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
