<div class="title">Delete Table</div>


<?php

require_once 'connection.php';


$SQL = "DELETE FROM cadastro WHERE id =6";



$connection = newConnection();
$results = $connection->query($SQL);

if($results){
    echo "Successfully created database!";
}else{
    echo "ERRO " . $connection->error;
}


$connection->close();

?>