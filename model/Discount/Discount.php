<?php

class Discount
{

    private $id;
    private $code;
    /*POSSIBLE TYPES:
        0   -> A discount that is assigned to a code that can be applied on checkout
        1   -> A discount that is applied by itself on a product.
        
    */
    private $type;
    private $percent;
    private $uses;
    private $endsAt;
    private $beginsAt;

    public function setData(
        $code = null,
        $type = null,
        $percent = null,
        $uses = null,
        $beginsAt = null,
        $endsAt = null,
        $id = null
    ) {
        $this->code = $code;
        $this->type = $type;
        $this->percent = $percent;
        $this->uses = $uses;
        $this->beginsAt = $beginsAt;
        $this->endsAt = $endsAt;
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
        return $this;
    }

    public function getCode(){
        return $this->code;
    }

    public function setCode($code){
        $this->code = $code;
        return $this;
    }

    public function getType(){
        return $this->type;
    }

    public function setType($type){
        $this->type = $type;
        return $this;
    }

    public function getPercent(){
        return $this->percent;
    }

    public function setPercent($percent){
        $this->percent = $percent;
        return $this;
    }

    public function getUses(){
        return $this->uses;
    }

    public function setUses($uses){
        $this->uses = $uses;
        return $this;
    }

    public function getBeginsAt(){
        return $this->beginsAt;
    }

    public function setBeginsAt($beginsAt){
        $this->beginsAt = $beginsAt;
        return $this;
    }

    public function getEndsAt(){
        return $this->endsAt;
    }

    public function setEndsAt($endsAt){
        $this->endsAt = $endsAt;
        return $this;
    }

}
