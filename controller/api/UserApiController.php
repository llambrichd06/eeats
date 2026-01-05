<?php
include_once 'model/dao/UserDAO.php';
include_once 'model/dao/LogDAO.php';

class UserApiController {

    // public function getUserByID() {
    //     if (isset($_GET['id'])) {
    //         $id = $_GET['id'];
    //         $user = UserDAO::getUserByID($id);  
    //         echo json_encode($user->toArray()); 
    //     }
    // }

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
            if (isset($data['name'], $data['email'], $data['profile_picture'], $data['password'], $data['role'], $data['premium'])) {
            $user = new User();
            $user->setData($data['name'], $data['email'], $data['profile_picture'], $data['password'], $data['role'], $data['premium']);
            UserDAO::saveUser($user);
            echo json_encode([
                'status' => 'Success',
                'data' => 'User Inserted correctly',
            ]);
            $log = new Log();
            $log->setData($_SESSION['lastAdminLoginId'], 'Saved new user');
            LogDAO::saveLog($log);
        }
        } catch (\Throwable $th) {
            http_response_code(409);
            echo json_encode([
                'status' => 'Error',
                'data' => 'Email already used by a user'
            ]);
        }

    }

    public function editUser($data) {
        try {
            if (isset($data['id'], $data['name'], $data['email'], $data['profile_picture'], $data['password'], $data['role'], $data['premium'])) {
                $user = new User();
                $user->setData($data['name'], $data['email'], $data['profile_picture'], $data['password'], $data['role'], $data['premium'], $data['id']);
                UserDAO::editUser($user);
                echo json_encode([
                    'status' => 'Success',
                    'data' => 'User edited correctly'
                ]);
                $log = new Log();
                $log->setData($_SESSION['lastAdminLoginId'], 'Edited user with id ' . $data['id']);
                LogDAO::saveLog($log);
            }
        } catch (\Throwable $th) {
            http_response_code(409);
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
            $log = new Log();
            $log->setData($_SESSION['lastAdminLoginId'], 'Deleted user with id ' . $data['id']);
            LogDAO::saveLog($log);
        }
    }
}