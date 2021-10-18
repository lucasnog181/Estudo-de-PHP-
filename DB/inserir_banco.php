 <div class="titulo">Inserir Registro</div>


 <?php
 
 require_once "connection.php";
 
 $SQL = "INSERT INTO cadastro (
      nome, 
      nascimento, 
      email, 
      site, 
      filhos,
      salario
      )
       VALUES 
      (
     'Lucca Felipe Aparício',
     '1984/05/03' , 'luccafelipeaparicio_@santander.com.br' , 
     'https://santander.com.br' , 2 , 6000.00
     )";


$connection = newConnection();
$results = $connection->query($SQL);

if($results){
    echo "Successfully created database!";
}else{
    echo "ERRO " . $connection->error;
}


$connection->close();
 
 ?>