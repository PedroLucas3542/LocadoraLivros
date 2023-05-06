<?php
include 'conexao.php';

// recebe o ID do usuário a ser excluído via GET
$id = $_GET['id'];

// cria a consulta SQL para excluir o usuário do banco de dados
$sql = "DELETE FROM usuarios WHERE id = $id";

// executa a consulta SQL e exibe mensagem de sucesso ou erro
if (mysqli_query($conn, $sql)) {
    header('Location: usuarios.php');
} else {
    echo "Erro ao excluir o usuário: " . mysqli_error($conn);
}

// fecha a conexão com o banco de dados
mysqli_close($conn);
?>