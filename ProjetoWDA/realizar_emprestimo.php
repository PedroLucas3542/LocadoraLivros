<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    text-align: center;
    padding-top: 50px;
  }

  .material-icons {
    font-size: 48px;
    color: red;
    margin-bottom: 20px;
  }

  a {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size: 15px;
    color: #333;
    text-decoration: none;
    margin-bottom: 10px;
    display: block;
  }

  .error-message {
    font-size: 24px;
    color: #555;
    margin-bottom: 20px;
  }

  .btn {
            padding: 10px 20px;
            font-size: 14px;
            border-radius: 4px;
            background-color: #4169E1;
            color: #ffffff;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0F52BA;
        }
</style>

<?php
// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os dados do formulário
    $livroId = $_POST['livro'];
    $usuarioId = $_POST['usuario'];
    $prazo = $_POST['prazo'];

    // TODO: Validar os dados recebidos, como verificar se os IDs existem no banco de dados

    // Conexão com o banco de dados
    include 'conexao.php';

    // Consulta para obter o nome do livro e quantidade disponível
    $livroQuery = "SELECT nome, estoque FROM livros WHERE id = '$livroId'";
    $livroResult = mysqli_query($conn, $livroQuery);
    $livroData = mysqli_fetch_assoc($livroResult);
    $livroNome = $livroData['nome'];
    $estoque = $livroData['estoque'];

    // Verifica se há estoque disponível
    if ($estoque > 0) {
        // Atualiza a quantidade de estoque do livro
        $estoqueAtualizado = $estoque - 1;
        $updateQuery = "UPDATE livros SET estoque = '$estoqueAtualizado' WHERE id = '$livroId'";
        mysqli_query($conn, $updateQuery);

        // Consulta para obter o nome do usuário
        $usuarioQuery = "SELECT nome FROM usuarios WHERE id = '$usuarioId'";
        $usuarioResult = mysqli_query($conn, $usuarioQuery);
        $usuarioNome = mysqli_fetch_assoc($usuarioResult)['nome'];

        // TODO: Realizar a lógica de empréstimo, como inserir os dados na tabela de empréstimos

        // Exemplo: Inserir os dados em uma tabela "emprestimos"
        $insertQuery = "INSERT INTO emprestimos (livro_id, livro_nome, usuario_id, usuario_nome, prazo_entrega) VALUES ('$livroId', '$livroNome', '$usuarioId', '$usuarioNome', '$prazo')";
        if (mysqli_query($conn, $insertQuery)) {
            header('Location: emprestimos.php');
        } else {
            echo 'Erro ao realizar o empréstimo: ' . mysqli_error($conn);
        }
    } else {
        echo '<br><br><br><br><div>';
        echo '<i class="material-icons">block</i>';
        echo '<p class="error-message">Oops... parece que este livro não está disponível!</p>';
        echo '<a href="emprestar.php"><button class="btn">Emprestar outro livro<button></a>';
        echo '<a href="emprestimos.php">Cancelar</a>';
        echo '</div>';
    }

    // Fechar a conexão com o banco de dados
    mysqli_close($conn);
} else {
    // Se o formulário não foi enviado, redireciona para a página de empréstimos
    header('Location: emprestimos.php');
    exit();
}
