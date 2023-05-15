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
        echo 'Não há estoque disponível para o livro selecionado.<br>';
        echo '<a href="emprestar.php">Emprestar outro livro</a>';
    }

    // Fechar a conexão com o banco de dados
    mysqli_close($conn);
} else {
    // Se o formulário não foi enviado, redireciona para a página de empréstimos
    header('Location: emprestimos.php');
    exit();
}
