<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Se o usuário não estiver logado, redireciona para a página de login
    header('Location: login.php');
    exit();
}

// Verifica se o ID do empréstimo foi passado via GET
if (isset($_GET['id'])) {
    $emprestimoId = $_GET['id'];

    // Inclua o arquivo de conexão com o banco de dados
    include 'conexao.php';

    // Query SQL para selecionar o empréstimo com base no ID
    $sql = "SELECT * FROM emprestimos WHERE id = $emprestimoId";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        // O empréstimo foi encontrado, obtenha os dados do empréstimo
        $emprestimo = mysqli_fetch_assoc($result);

        // Verifique se o empréstimo já foi devolvido
        if ($emprestimo['status'] === 'Devolvido') {
            // O empréstimo já foi devolvido, redirecione de volta para a página de empréstimos
            header('Location: emprestimos.php');
            exit();
        }

        // Atualize o status do empréstimo para 'Devolvido' e registre a data de devolução atual
        $dataDevolucao = date('Y-m-d');
        $sqlUpdate = "UPDATE emprestimos SET status = 'Devolvido', data_devolucao = '$dataDevolucao' WHERE id = $emprestimoId";
        $resultUpdate = mysqli_query($conn, $sqlUpdate);

        if ($resultUpdate) {
            // A atualização do empréstimo foi bem-sucedida

            // Obtenha o livro relacionado ao empréstimo
            $livroId = $emprestimo['livro_id'];

            // Incrementar o estoque do livro
            $adicionar = "UPDATE livros SET estoque = estoque + 1 WHERE id = $livroId";
            $resultIncremento = mysqli_query($conn, $adicionar);

            if ($resultIncremento) {
                // O estoque foi incrementado com sucesso
                header('Location: emprestimos.php');
                exit();
            } else {
                // Ocorreu um erro ao incrementar o estoque do livro
                echo "Erro ao incrementar o estoque do livro: " . mysqli_error($conn);
            }
        } else {
            // Ocorreu um erro ao atualizar o empréstimo
            echo "Erro ao registrar a devolução: " . mysqli_error($conn);
        }
    } else {
        // O empréstimo não foi encontrado, exiba uma mensagem de erro
        echo "Erro ao registrar a devolução: Empréstimo não encontrado.";
    }

    // Feche a conexão com o banco de dados
    mysqli_close($conn);
} else {
    // O ID do empréstimo não foi passado via GET, redirecione de volta para a página de empréstimos
    header('Location: emprestimos.php');
    exit();
}
?>
