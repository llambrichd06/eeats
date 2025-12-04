<?php
include_once 'model/dao/UserDAO.php';


class UserApiController {

    public function getUserByID() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $user = UserDAO::getUserByID($id);  
            echo json_encode($user->toArray()); 
        }
    }

    public function getUsers() {
        $users = UserDAO::getUsers();
        $usersArray = [];
        foreach ($users as $user) {
            array_push($usersArray, $user->toArray());
        }
        echo json_encode($usersArray); 
    }

    public function saveUser($data) {
        if (isset($data['name'], $data['email'], $data['profile_picture'], $data['password'], $data['role'], $data['premium'])) {
            $user = new User();
            $user->setData($data['name'], $data['email'], $data['profile_picture'], $data['password'], $data['role'], $data['premium'], $data['deleted']);
            UserDAO::saveUser($user);
            echo json_encode([
                'estado' => 'Exito',
                'data' => 'Usuario Insertado correctamente'
            ]);
        }
    }

}