<?php
// Verifica se o ID da editora foi fornecido
if (isset($_GET['id'])) {
    // Obtém o ID da editora a ser excluída
    $editoraId = $_GET['id'];
    
    // Chama a função para excluir a editora
    excluirEditora($editoraId);
}

// Função para excluir uma editora por ID
function excluirEditora($id) {
    include 'conexao.php';
    
    // Consulta SQL para excluir a editora pelo ID
    $sql = "DELETE FROM editoras WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        header('Location: editoras.php');
    } else {
        echo "Erro ao excluir editora: " . $conn->error;
    }
    
    $conn->close();
}
?>