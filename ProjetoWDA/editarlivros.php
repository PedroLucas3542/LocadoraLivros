<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Se o usuário não estiver logado, redireciona para a página de login
    header('Location: login.php');
    exit();
}

include_once('conexao.php');

// Verifica se foi enviado um ID válido para edição
if (isset($_GET['id'])) {
    $livro_id = $_GET['id'];

    // Verifica se o livro existe no banco de dados
    $query_verifica_livro = "SELECT * FROM livros WHERE id = $livro_id";
    $resultado_verifica_livro = mysqli_query($conn, $query_verifica_livro);
    if (mysqli_num_rows($resultado_verifica_livro) > 0) {
        // Livro encontrado, recupera as informações do estoque atual
        $livro = mysqli_fetch_assoc($resultado_verifica_livro);
        $estoque_atual = $livro['estoque'];
    } else {
        // Livro não encontrado, redireciona para a página de livros
        header('Location: livros.php');
        exit();
    }
} else {
    // ID inválido, redireciona para a página de livros
    header('Location: livros.php');
    exit();
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novo_estoque = intval($_POST['novo_estoque']);

    // Verifica se o novo estoque é maior ou igual ao estoque atual
    if ($novo_estoque >= $estoque_atual) {
        // Atualiza o estoque no banco de dados
        $query_atualiza_estoque = "UPDATE livros SET estoque = $novo_estoque, novo_estoque = $novo_estoque WHERE id = $livro_id";
        mysqli_query($conn, $query_atualiza_estoque);

        // Redireciona de volta para a página de livros
        header('Location: livros.php');
        exit();
    } else {
        // O novo estoque é menor que o estoque atual, exibe um alerta
        echo "<script>alert('O novo estoque não pode ser menor que o estoque atual.');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Livro</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
        }

        h2 {
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .btn {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Editar Livro</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="estoque">Estoque Atual:</label>
                <input type="number" class="form-control" id="estoque" name="estoque" value="<?php echo $estoque_atual; ?>" readonly>
            </div>
            <div class="form-group">
            <label for="novo_estoque">Novo Estoque:</label>
                <input type="number" class="form-control" id="novo_estoque" name="novo_estoque" required>
            </div>
            <button type="submit" class="btn btn-primary">Atualizar Estoque</button>
        </form>
    </div>
</body>

</html>

