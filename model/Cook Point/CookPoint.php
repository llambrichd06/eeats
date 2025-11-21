<?php

class CookPoint
{

    private $id;
    private $cookPoint;

    public function setData($cookPoint = null, $id = null) {
        $this->cookPoint = $cookPoint;
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
        return $this;
    }

    public function getCookPoint(){
        return $this->cookPoint;
    }

    public function setCookPoint($cookPoint){
        $this->cookPoint = $cookPoint;
        return $this;
    }

}
