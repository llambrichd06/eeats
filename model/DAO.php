<?php
include_once 'database/DB.php';

interface DAO {
    static function insertObject($object, $types); //Might be better to make this abstract and link it to every DAO
    //TODO: LATER ON CHANGE THE FUNCTION ON EVERY DAO SO IT DOESEN'T MATTER WHAT DATABASE MANAGER WE ARE USING 
    //Cause we currently depending on the fact that, on mysql, if you insert a null on an autoIncrement, it ignores the null, but not all managers are like that
}
