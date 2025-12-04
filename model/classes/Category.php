<?php

class Category {

    private $id;
    private $name;


    public function setData( $name = null, $id = null) {
        $this->name = $name;
        $this->id = $id;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
        return $this;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
        return $this;
    }

    public function toArray() {
        return get_object_vars($this);
    }
}
