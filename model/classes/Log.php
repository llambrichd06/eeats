<?php

class Log
{
    private $id;
    private $user_id;
    private $log_date;
    private $action;

    public function setData(
        $user_id = null,
        $action = null,
        $log_date = null,
        $id = null
    ) {
        $this->user_id = $user_id;
        $this->log_date = $log_date;
        $this->action = $action;
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
        return $this;
    }

    public function getLogDate() {
        return $this->log_date;
    }

    public function setLogDate($log_date) {
        $this->log_date = $log_date;
        return $this;
    }

    public function getAction() {
        return $this->action;
    }

    public function setAction($action) {
        $this->action = $action;
        return $this;
    }
    
    public function toArray() {
        return get_object_vars($this);
    }
}
