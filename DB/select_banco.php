<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


<div class="titulo">Select Dados</div>
<?php

require_once 'connection.php';


$SQL = 'SELECT id, nome, nascimento, email, salario FROM cadastro';

$connection = newConnection();
$result = $connection->query($SQL);


$registro = [];


if($result->num_rows > 0){
    while($row = $result->fetch_array()) {
        $registro[] = $row;
    }
}elseif($connection->error){
    echo "Error: " . $connection->error;
}


$connection->close();


?>

<table class="table ">
    <thead class="thead-dark">
        <th>ID</th>
        <th>Nome</th>
        <th>Nascimento</th>
        <th>E-mail</th>
        <th>Salário</th>
    </thead>
    <tbody>
        <?php foreach($registro as $registros):?>
        <tr>
            <td>
                <?= $registros['id'] ?>
            </td>
            <td>
                <?= $registros['nome'] ?>
            </td>
            <td>
                <?= date('d/m/Y' , strtotime($registros['nascimento'])) ?>
            </td>
            <td>
                <?= $registros['email'] ?>
            </td>
            <td>
                <?= 'R$ '. $registros['salario'] . '.00' ?>
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