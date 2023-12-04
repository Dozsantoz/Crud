<?php
 $servername = "localhost";
 $username = "root";
 $password = "";
 $database = "teste";

 // conexão
 $connection = new mysqli($servername, $username, $password, $database);


$nome = "";
$quantidade = "";
$preco = "";
$descricao = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST["nome"];
    $quantidade = $_POST["quantidade"];
    $preco = $_POST["preco"];
    $descricao = $_POST["descricao"];

    do {
        if (empty($nome) || empty($quantidade) || empty($preco) || empty($descricao)) {
            $errorMessage = "Todos os campos precisam estar preenchidos";
            break;
        }

        // Adicione o novo produto ao banco de dados aqui

        $sql = "INSERT INTO produtos (nome, quantidade, preco, descricao)" . 
               "VALUES ('$nome','$quantidade','$preco','$descricao')";
               $result = $connection->query($sql);
        if (!$result){
            $errorMessage = "Consulta inválida: " . $connection->error;
            break;
        }

        $nome = "";
        $quantidade = "";
        $preco = "";    
        $descricao = "";

        $successMessage = "Produto adicionado com sucesso";

        header("location:/crud/index.php");
        exit;

    } while (false);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
</head>
<body>
    <div style="background-color: #f8f9fa;
        padding: 20px; 
        border-radius: 8px; 
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1)" 
         class="container my-5">
        <h2 class="title" style="text-align: center;">Novo Produto</h2>
        <br>

        <?php
        if (!empty($errorMessage)) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>
<br>
        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label"><strong>Nome</strong></label>
                <div class="col-sm-6">
                    <input type="text" placeholder="nome do produto" class="form-control" name="nome" value="<?php echo $nome; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label"><strong>Quantidade </strong></label>
                <div class="col-sm-6">
                    <input type="text" placeholder="06" class="form-control" name="quantidade" value="<?php echo $quantidade; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label"><strong>Preço</strong></label>
                <div class="col-sm-6">
                    <input type="text" placeholder="350,00"class="form-control" name="preco" value="<?php echo $preco; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label"><strong>Descrição</strong></label>
                <div class="col-sm-6">
                    <input type="text" placeholder="cor x, marca y, usado " class="form-control" name="descricao" value="<?php echo $descricao; ?>">
                </div>
            </div>





            

            <?php
            if (!empty($successMessage)) {
                echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>
                ";
            }
            ?>

            <!-- Botões Enviar/Cancelar -->
            <div style="margin-top: 10px" class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary" style="background-color: #000000; color: #ffffff; border: 1px solid #000000;">Enviar</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-danger" href="/crud/index.php" role="button">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
