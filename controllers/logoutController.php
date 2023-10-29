<?php
    require 'conexion.php';
    
    //unset sessions, cookies, close database connection and return to home page
    session_unset();
    session_destroy();
    setcookie('remember', null, -1, '/');
    $db->closeConnection();
    
    header('Location:home');

?>