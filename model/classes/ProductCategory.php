<?php
class ProductCategory 
{

    private $productId;
    private $categoryId;

    public function setData(
        $productId = null,
        $categoryId = null
    ) {
        $this->productId = $productId;
        $this->categoryId = $categoryId;
    }

    public function getProductId(){
        return $this->productId;
    }
    
    public function setProductId($productId){
        $this->productId = $productId;
        return $this;
    }
    
    public function getCategoryId(){
        return $this->categoryId;
    }
    
    public function setCategoryId($categoryId){
        $this->categoryId = $categoryId;
        return $this;
    }

}
