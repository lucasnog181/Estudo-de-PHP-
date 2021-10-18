<?php

function newConnection($database = 'cursos_php'){
    $server = '127.0.0.1';
    $username = 'root';
    $password = '';
    
    $connection = new mysqli($server, $username, $password, $database);
    
    if($connection->connect_error){
        die('ERRO CONNECTION'.$connection->error);
    }
    
    return $connection; 
}

?>