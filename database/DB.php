<?php

class DB {
    public static function connect($host='localhost', $user='root', $pass='', $db='eeats') {
        $con = new mysqli($host, $user, $pass, $db);

        if ($con == false) {
            die('Error al conectar a la base de datos');
        } else {
            return $con;
        }
    }
}
