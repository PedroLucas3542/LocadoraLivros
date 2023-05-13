<?php
include 'conexao.php';

// Recebe o ID do usuário a ser excluído via GET
$id = $_GET['id'];

// Verifica se o usuário possui empréstimo
$query_verifica_emprestimo = "SELECT COUNT(*) as total FROM emprestimos WHERE usuario_id = $id";
$resultado = mysqli_query($conn, $query_verifica_emprestimo);
$row = mysqli_fetch_assoc($resultado);
$total_emprestimos = $row['total'];

// Verifica se o usuário possui empréstimos
if ($total_emprestimos > 0) {
    echo "O usuário possui empréstimos e não pode ser excluído.";
} else {
    // Cria a consulta SQL para excluir o usuário do banco de dados
    $sql = "DELETE FROM usuarios WHERE id = $id";

    // Executa a consulta SQL e exibe mensagem de sucesso ou erro
    if (mysqli_query($conn, $sql)) {
        header('Location: usuarios.php');
    } else {
        echo "Erro ao excluir o usuário: " . mysqli_error($conn);
    }
}

// Fecha a conexão com o banco de dados
mysqli_close($conn);
?>