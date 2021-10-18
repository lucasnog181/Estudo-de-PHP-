<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">




<?php 

require_once "connection.php";
$connection = newConnection();


if($_GET['codigo']){
    $SQL = "SELECT * FROM cadastro WHERE id = ?";
    $stmt = $connection->prepare($SQL);
    $stmt->bind_param("i", $_GET['codigo']);

    
    if($stmt->execute()) {
        $results = $stmt->get_result();
        if($results->num_rows > 0){
            $dados = $results->fetch_assoc();
            if(isset($dados['nascimento'])){
                $dt = new DateTime($dados['nascimento']);
                $dados['nascimento'] = $dt->format('d/m/Y');
            }
        }
    }
}


if(count($_POST) > 0) {

    $dados = $_POST;
    $erros = [];
  
    if(trim($dados['nome']) === "") {
        $erros['nome'] = 'Nome é obrigatório';
    }

    if(isset($dados["nascimento"])) {
        $data = DateTime::createFromFormat(
            'd/m/Y', $dados['nascimento']);
        if(!$data) {
            $erros['nascimento'] = 'Data deve estar no padrão dd/mm/aaaa';
        }
    }

    if(!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
        $erros['email'] = 'Email inválido';
    }

    if (!filter_var($dados['site'], FILTER_VALIDATE_URL)) {
        $erros['site'] = 'Site inválido';
    }

    $filhosConfig = [
        "options" => ["min_range" => 0, "max_range" => 20]
    ];
    if (!filter_var($dados['filhos'], FILTER_VALIDATE_INT,
        $filhosConfig) && $dados['filhos'] != 0) {
            $erros['filhos'] = 'Quantidade de filhos inválida (0-20).';    
    }

    $salarioConfig = ['options' => ['decimal' => ',']];
    if (!filter_var($dados['salario'],
        FILTER_VALIDATE_FLOAT, $salarioConfig)) {
            $erros['salario'] = 'Salário inválido';    
    }


    

    if(!count($erros)){
        
        $SQL = "UPDATE cadastro SET
            nome=?, 
            nascimento=?, 
            email=?, 
            site=?, 
            filhos=?,
            salario=?
             WHERE id=?";

        $stmt = $connection->prepare($SQL);

        $params = [
            $dados['nome'],
            $data ? $data->format('Y-m-d') : null,
            $dados['email'],
            $dados['site'],
            $dados['filhos'],
            $dados['salario'],
            $dados['id']
        ];

        $stmt->bind_param('ssssidi',...$params);

        if($stmt->execute()){
            unset($dados);
            header('Location:index.php');
        }
    }
}
?>

<?php if(isset($Successes) === true):?>
<div class="alert alert-success" role="alert">
    Successes
</div>
<?php endif; ?>


<div class="titulo">Inserindo Dados #02</div>


<form action="/Aulas%20de%20PHP/exercicio.php">
    <input type="hidden" name="dir" value="DB">
    <input type="hidden" name="file" value="altera_table">
    <div class="form-group row">
        <div class="col-sm-10">
            <input type="number" class="form-control" name="codigo" value="<?=$_GET['codigo']?>"
                placeholder="Informe o código para consulta">
        </div>

        <div class="form-group">
            <div class=" d-grid gap-2">
                <button class="btn btn-primary mb-4">Buscar</button>
            </div>
        </div>
    </div>
</form>


<form action="#" method="post">
    <input type="hidden" name="id" value="<?=$dados['id']?>">
    <div class=" form-row">
        <div class="form-group col-md-8">
            <label for="nome">Nome</label>
            <input type="text" class="form-control <?= isset($erros['nome']) ? 'is-invalid': '' ?>" id="nome"
                name="nome" placeholder="Nome" value="<?=$dados['nome']?>">
            <div class="invalid-feedback">
                <?= $erros['nome']?>
            </div>
        </div>
        <div class=" form-group col-md-4">
            <label for="nascimento">Nascimento</label>
            <input type="text" class="form-control <?= isset($erros['nascimento']) ? 'is-invalid': '' ?>"
                id=" nascimento" name="nascimento" placeholder="Nascimento" value="<?=$dados['nascimento']?>">
            <div class="invalid-feedback">
                <?= $erros['nascimento']?>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="email">E-mail</label>
            <input type="text" class="form-control <?= isset($erros['email']) ? 'is-invalid': '' ?> " id="email"
                name="email" placeholder="E-mail" value="<?=$dados['email']?>">
            <div class="invalid-feedback">
                <?= $erros['email']?>
            </div>
        </div>
        <div class=" form-group col-md-6">
            <label for="site">Site</label>
            <input type="text" class="form-control <?= isset($erros['site']) ? 'is-invalid': '' ?> " id="site"
                name="site" placeholder="Site" value="<?=$dados['site']?>">
            <div class="invalid-feedback">
                <?= $erros['site']?>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="filhos">Qtde de Filhos</label>
            <input type="number" class="form-control <?= isset($erros['site']) ? 'is-invalid': '' ?> " id="filhos"
                name="filhos" placeholder="Qtde de Filhos" value="<?=$dados['filhos']?>">
        </div>
        <div class="form-group col-md-6">
            <label for="salario">Salário</label>
            <input type="text" class="form-control <?= isset($erros['site']) ? 'is-invalid': '' ?>" id=" salario"
                name="salario" placeholder="Salário" value="<?=$dados['salario']?>">
            <div class="invalid-feedback">
                <?= $erros['salario']?>
            </div>
        </div>
    </div>
    <button class="btn btn-primary btn-lg">Enviar</button>
</form>