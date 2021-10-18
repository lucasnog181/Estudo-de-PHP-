<?php

function newConnection(){
   
    $database= "asetecseguranca";
    $server="127.0.0.1";
    $user="root";
    $password="";

    try {
        $connection = new PDO("mysql:host=$server;dbname=$database",$user,$password);
        return $connection;

    } catch (PDOException $e) {
       die('ERRO '. $e->getMessage());
    }
}


?>