<?php
include_once 'database/DB.php';

interface DAO {
    static function insertObject($object, $types); 
}
