<?php
include_once 'DB/DB.php';
include_once 'model/User.php';

class UserDAO extends DAO {
    public static function getUserByID($id){
        $con = DB::connect();
        $stmt = $con->prepare("SELECT * FROM users where id = ?");
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $results = $stmt->get_result();

        $user = $results->fetch_object('User'); //"User" es la classe que tenemos de user, esto nos transforma automaticamente a objeto
        $con->close();

        return $user;
    }

    public static function getUsers() {
        $con = DB::connect();
        $stmt = $con->prepare("SELECT * FROM users");
        $stmt->execute();
        $results = $stmt->get_result();

        $listaUsers = [];

        while ($user = $results->fetch_object('User')) { //Recorre las filas de resultado, cuando se quede sin filas, da false i asi rompe el bucle, no es comparacion porque no es ==
            $listaUsers[]=$user;
        }
        $con->close();

        return $listaUsers;
    }
    public static function saveUser(User $user) {
        $name = $user->getName();
        $email = $user->getEmail();
        $profilePicture = $user->getProfilePicture();
        $pass = $user->getPassword();
        $role = $user->getRole();
        $premium = $user->getPremium();
        
        $con = DB::connect();
        $stmt = $con->prepare("INSERT INTO users (name, email, profilePicture, password, role, premium) VALUES (?, ?, ?, ?, ?, ?)"); //seguramente habria que cambiar a lo del formato seguro para que no me hagan sql injection
        $stmt->bind_param('sss', $name, $email, $profilePicture, $pass, $role, $premium);
        $stmt->execute();
        $results = $stmt->get_result();


        $con->close();
        
    }
}
    