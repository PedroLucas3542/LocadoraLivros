<?php

function deleteLivro($livroId) {
    // Conexão com o banco de dados
    include 'conexao.php';

    // Verifica se o livro possui empréstimos
    $query_emprestimos = "SELECT COUNT(*) AS total_emprestimos FROM emprestimos WHERE livro_id = $livroId WHERE status = ''";
    $result_emprestimos = mysqli_query($conn, $query_emprestimos);
    $row_emprestimos = mysqli_fetch_assoc($result_emprestimos);
    $total_emprestimos = $row_emprestimos['total_emprestimos'];

    if ($total_emprestimos > 0) {
        // O livro possui empréstimos, não pode ser excluído
        mysqli_close($conn);
        return false;
    } else {
        // Deleta o livro do banco de dados
        $query_delete_livro = "DELETE FROM livros WHERE id = $livroId";
        mysqli_query($conn, $query_delete_livro);

        mysqli_close($conn);
        return true;
    }
}

// Verifica se o ID do livro foi fornecido via parâmetro
if (isset($_GET['id'])) {
    $livroId = $_GET['id'];

    if (deleteLivro($livroId)) {
        // Livro excluído com sucesso
        header('Location: livros.php');
        exit();
    } else {
        // O livro possui empréstimos, exibe uma mensagem de erro
        echo "Não é possível excluir o livro, pois existem empréstimos associados a ele.";
    }
}

?>