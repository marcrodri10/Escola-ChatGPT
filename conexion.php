<?php
//create database instance to avoid creating the instance in every file

require 'config.php';
require 'persistance/PDOAdapter.php';

try{
    //Create connection with config variables
    $db = new PDOAdapter($dsn, $dbuser, $dbpass);
    
} catch (PDOException $e){
    //throw exception
    throw new Exception("An unexpected error has occurred");
}


?>