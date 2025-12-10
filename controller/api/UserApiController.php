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
        try {
            if (isset($data['name'], $data['email'], $data['profile_picture'], $data['password'], $data['role'], $data['premium'], $data['deleted'])) {
            $user = new User();
            $user->setData($data['name'], $data['email'], $data['profile_picture'], $data['password'], $data['role'], $data['premium'], $data['deleted']);
            UserDAO::saveUser($user);
            echo json_encode([
                'status' => 'Success',
                'data' => 'User Inserted correctly',
            ]);
        }
        } catch (\Throwable $th) {
            //http_status_code(409); //i dont know why, but it says its undefined
            echo json_encode([
                'status' => 'Error',
                'data' => 'Email already used by a user'
            ]);
        }

    }

    public function editUser($data) {
        try {
            if (isset($data['id'], $data['name'], $data['email'], $data['profile_picture'], $data['password'], $data['role'], $data['premium'], $data['deleted'])) {
                $user = new User();
                $user->setData($data['name'], $data['email'], $data['profile_picture'], $data['password'], $data['role'], $data['premium'], $data['deleted'], $data['id']);
                UserDAO::editUser($user);
                echo json_encode([
                    'status' => 'Success',
                    'data' => 'User edited correctly'
                ]);
            }
        } catch (\Throwable $th) {
            http_response_code(409); //i dont know why, but it says its undefined
            echo json_encode([
                'status' => 'Error',
                'data' => 'Email already used by a user'
            ]);
        }

    }

    function deleteUser($data) {
        if (isset($data['id'])) {
            UserDAO::deleteUser($data['id']);
            echo json_encode([
                'status' => 'Success',
                'data' => 'User deleted successfully'
            ]);
        }
    }

    public function testing() {
        $testArray = ["first" => 1, "second" => 2, "third" => 3 ];
        $thing = [];
        foreach ($testArray as $key => $value) {
            array_push($thing, "$key = $value");
        }
        echo implode(", ",$thing);
    }

}