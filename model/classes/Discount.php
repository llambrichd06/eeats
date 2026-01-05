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
    private $ends_at;
    private $begins_at;
    private $deleted;

    public function setData(
        $code = null,
        $type = null,
        $percent = null,
        $uses = null,
        $begins_at = null,
        $ends_at = null,
        $deleted = null,
        $id = null
    ) {
        $this->code = $code;
        $this->type = $type;
        $this->percent = $percent;
        $this->uses = $uses;
        $this->begins_at = $begins_at;
        $this->ends_at = $ends_at;
        $this->deleted = $deleted;
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

    public function getBegins_at(){
        return $this->begins_at;
    }

    public function setBegins_at($begins_at){
        $this->begins_at = $begins_at;
        return $this;
    }

    public function getEnds_at(){
        return $this->ends_at;
    }

    public function setEnds_at($ends_at){
        $this->ends_at = $ends_at;
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
