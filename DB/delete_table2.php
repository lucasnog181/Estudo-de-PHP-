<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


<div class="titulo">Deletando Dados #02</div>


<?php

require_once 'connection.php';
$connection = newConnection();

$registro = [];

if(isset($_GET["excluir"])){
    
    $deleteSQL = "DELETE FROM cadastro WHERE id= ?";
    $stmt = $connection->prepare($deleteSQL);
    $stmt->bind_param("i", $_GET['excluir']);
    $stmt->execute();

}

$SQL = 'SELECT id, nome, nascimento, email, salario FROM cadastro';
$result = $connection->query($SQL);

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
        <th>Delete</th>
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
            <td>
                <a href="/Aulas%20de%20PHP/exercicio.php?dir=DB&file=delete_table2&excluir=<?=$registros['id']?>"
                    class="btn btn-danger">Excluir
                </a>

                <a href="/Aulas%20de%20PHP/exercicio.php?dir=DB&file=altera_table&codigo=<?=$registros['id']?>"
                    class="btn btn-warning">Editar
                </a>
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