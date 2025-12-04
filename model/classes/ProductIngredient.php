<?php
class ProductIngredient 
{

    private $productId;
    private $ingredientId;
    private $isDefault;
    private $price;

    public function setData(
        $productId = null,
        $ingredientId = null,
        $isDefault = null,
        $price = null
    ) {
        $this->productId = $productId;
        $this->ingredientId = $ingredientId;
        $this->isDefault = $isDefault;
        $this->price = $price;
    }

    public function getProductId(){
        return $this->productId;
    }
    
    public function setProductId($productId){
        $this->productId = $productId;
        return $this;
    }
    
    public function getIngredientId(){
        return $this->ingredientId;
    }
    
    public function setIngredientId($ingredientId){
        $this->ingredientId = $ingredientId;
        return $this;
    }
    
    public function getIsDefault(){
        return $this->isDefault;
    }
    
    public function setIsDefault($isDefault){
        $this->isDefault = $isDefault;
        return $this;
    }
    
    public function getPrice(){
        return $this->price;
    }
    
    public function setPrice($price){
        $this->price = $price;
        return $this;
    }

    public function toArray() {
        return get_object_vars($this);
    }
}
