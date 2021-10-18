<div class="titulo">Criar Tabela</div>


<?php

require_once 'connection.php';


$SQL = "CREATE TABLE IF NOT EXISTS cadastro (
    id INT(6) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    nascimento DATE,
    email VARCHAR(100) NOT NULL,
    site VARCHAR(100) NOT NULL,
    filhos INT,
    salario FLOAT
)";


$connection = newConnection();
$results = $connection->query($SQL);

if($results){
    echo "Successfully created database!";
}else{
    echo "ERRO" . $connection->error;
}

$connection->close();

?>