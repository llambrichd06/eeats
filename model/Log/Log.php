<?php

class Log
{
    private $id;
    private $userId;
    private $logDate;
    private $action;

    public function setData(
        $userId = null,
        $logDate = null,
        $action = null,
        $id = null
    ) {
        $this->userId = $userId;
        $this->logDate = $logDate;
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
        return $this->userId;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
        return $this;
    }

    public function getLogDate() {
        return $this->logDate;
    }

    public function setLogDate($logDate) {
        $this->logDate = $logDate;
        return $this;
    }

    public function getAction() {
        return $this->action;
    }

    public function setAction($action) {
        $this->action = $action;
        return $this;
    }
}
