<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
   
    ;
</head>
<body >
    <div style="background-color: #f8f9fa;
        padding: 20px; 
        border-radius: 8px; 
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1)" 
        class="container my-5">
        
        <h2 class="title" style= "text-align: center;">Lista de Produtos</h2>
        <br>
        <a class="btn btn-primary" href="/crud/create.php" role="button" style="background-color: #000000; color: #ffffff; border: 1px solid #000000;">Novo Produto</a>

        <br>
        <br>
        <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Quantidade</th>
                    <th>Preço</th>
                    <th>Descrição</th>
                    <th>Data de Cadastro</th>
                    <th>Hora de Cadastro</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "teste";

                // Conexão
                $connection = new mysqli($servername, $username, $password, $database);
                // check
                if ($connection->connect_error) {
                    die("Connection Failed: " . $connection->connect_error);
                }

                
                $sql = "SELECT * FROM produtos";
                $result = $connection->query($sql);
                
                if (!$result) {
                    die("Invalid query: " . $connection->error);
                }

                // ler os dados de cada linha
                while ($row = $result->fetch_assoc()) {
                    
                    echo "

                        <tr>
                            <td>$row[id]</td>
                            <td>$row[nome]</td>
                            <td style='text-align: center'>$row[quantidade]</td>
                            <td>R$ $row[preco]</td>
                            <td>$row[descricao]</td>
                            <td>" . date("d/m/Y" , strtotime($row['cadastrado_as'])) . "</td> 
                            <td>" . date("H:i:s", strtotime($row['cadastrado_as'])) . "</td>
                            <td>
                                <a class='btn btn-primary btn-sm' href='/crud/edit.php?id=$row[id]'>Editar</a>
                                <a class='btn btn-danger btn-sm' href='/crud/delete.php?id=$row[id]'>Deletar</a>
                            </td>
                        </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
        </div>
    </div>
</body>
</html>
