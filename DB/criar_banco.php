<div class="title">Criar Banco de Dados</div>


<?php

require_once 'connection.php';

$connection = newConnection(null);
$SQL = 'CREATE DATABASE IF NOT EXISTS cursos_php';


$results = $connection->query($SQL);

if($results){
    echo "Successfully created database!";
}else{
    echo "Database is not created correctly!";
}

$connection->close();



?>