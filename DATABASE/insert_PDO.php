<div class="titulo">Inserindo Dados PDO</div>


<?php


require_once 'connection.php';

$SQL = "INSERT INTO produto (produto,dataEstoque,descricao,quantidade,valor) VALUES ('Apple iPhone 13 512GB iOS 5G Wi-Fi Tela 6.1'' Câmera Dupla 12MP ' , '2021-10-15', 'Um grande salto em bateria. Projetado para durar. 5G ultrarrápido. E tela Super Retina XDR mais brilhante' , 20 , 9299.00)";


$connection = newConnection();

if($connection->exec($SQL)){
    $id = $connection->lastInsertId();
    echo "Novo produto cadastrado ".$id;

}else{
    echo $connection->errorCode() .'<br>';
    print_r($connection->errorInfo());
}

?>