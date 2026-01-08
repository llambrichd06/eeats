<?php

class DB {
    public static function connect($host='localhost', $user='root', $pass='dev', $db='myeeatsdb', $port=3320) {
        $con = new mysqli($host, $user, $pass, $db, $port);

        if ($con == false) {
            die('Error al conectar a la base de datos');
        } else {
            return $con;
        }
    }
}
