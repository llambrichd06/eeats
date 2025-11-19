<?php 
include_once "model/User/UserDAO.php";

class SimpleApiController {
    private $model;

    public function __construct() {
        $this->model = new UserDAO(); //se conecta al dao
    }

    public function usuarios() {
        $data = $this->model->getUserByID(1); //recordar hacer json encode, mirar si se puede en un objeto de alguna forma 
        $encodedData = json_encode($data); //literalmente se puede hacer json encode a un objeto, hay compatibilidad (aun asi testear)
    }
}