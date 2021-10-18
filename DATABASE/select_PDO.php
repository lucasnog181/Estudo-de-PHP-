<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<div class="titulo">SELECT Dados PDO</div>


<?php

require_once 'connection.php';


$connection = newConnection();
$SQL = "SELECT * FROM produto";

//PDO::FETCH_NUM
//PDO::FETCH_ASSOC
//PDO::FETCH_CLASS

$results = $connection->query($SQL)->fetchAll(PDO::FETCH_ASSOC);


print_r($results);
echo "<br>";
echo "<br>";

echo "<hr>";




?>



<table class="table ">
    <thead class="thead-dark">
        <th>ID</th>
        <th>Produto</th>
        <th>Data inclusão em estoque</th>
        <th>Quantidade em estoque</th>
        <th>Valor do produto</th>
    </thead>

    <tbody>
        <?php foreach ($results as $result):?>
        <tr>
            <td>
                <?= $result['id'] ?>
            </td>
            <td>
                <?= $result['produto'] ?>
            </td>
            <td>
                <?= date('d/m/Y' , strtotime($result['dataEstoque'])) ?>
            </td>
            <td>
                <?= $result['quantidade'] ?>
            </td>
            <td>
                <?= "R$ ".$result['valor']. ",00" ?>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>

<style>
table>* {
    font-size: 1.3rem;
}
</style>