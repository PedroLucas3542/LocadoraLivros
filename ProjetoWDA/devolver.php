<?php
include_once('conexao.php');

// Recebe o ID do empréstimo a ser devolvido
$emprestimo_id = $_GET['id'];

// Consulta o empréstimo pelo ID
$query_emprestimo = "SELECT * FROM emprestimos WHERE id = $emprestimo_id";
$resultado_emprestimo = mysqli_query($conn, $query_emprestimo);

if (mysqli_num_rows($resultado_emprestimo) > 0) {
    $emprestimo = mysqli_fetch_assoc($resultado_emprestimo);
    
    // Recupera o ID do livro do empréstimo
    $livro_id = $emprestimo['livro_id'];
    
    // Atualiza a tabela de empréstimos para marcar como devolvido
    $update_emprestimo_query = "UPDATE emprestimos SET devolvido = 1 WHERE id = $emprestimo_id";
    mysqli_query($conn, $update_emprestimo_query);
    
    // Atualiza a tabela de livros para incrementar o estoque
    $update_livro_query = "UPDATE livros SET estoque = estoque + 1 WHERE id = $livro_id";
    mysqli_query($conn, $update_livro_query);
    
    // Apaga o registro do empréstimo
    $delete_emprestimo_query = "DELETE FROM emprestimos WHERE id = $emprestimo_id";
    mysqli_query($conn, $delete_emprestimo_query);
    
    echo "Devolução realizada com sucesso!";
} else {
    echo "Empréstimo não encontrado.";
}

// Redireciona para a página de empréstimos
header('Location: emprestimos.php');
exit();
?>
