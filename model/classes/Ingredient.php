<?php

class Ingredient {
    private $id;
    private $name;
    private $img;
    private $cookPointId;
    private $deleted;

    public function setData(
        $name = null, 
        $img = null, 
        $cookPointId = null, 
        $deleted = null,
        $id = null
    ) {
        $this->name = $name;
        $this->img = $img;
        $this->cookPointId = $cookPointId;
        $this->deleted = $deleted;
        $this->id = $id;
    }

    public function getId() {
        return $this->id; 
    }
    public function setId($id) {
        $this->id = $id; 
        return $this; 
    }

    public function getName() {
        return $this->name; 
    }
    public function setName($name) {
        $this->name = $name; 
        return $this; 
    }

    public function getImg() {
        return $this->img; 
    }
    public function setImg($img) {
        $this->img = $img; 
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
}
