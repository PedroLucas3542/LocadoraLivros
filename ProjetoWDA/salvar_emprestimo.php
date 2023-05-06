<?php
include_once('conexao.php');

// Recebe os dados do formulário
$livro_id = $_POST['livro_id'];
$usuario_id = $_POST['usuario_id'];
$prazo_entrega = $_POST['prazo_entrega'];

// Recupera o nome do livro correspondente ao ID
$livro_query = "SELECT nome FROM livros WHERE id = $livro_id";
$livro_result = mysqli_query($conn, $livro_query);
$livro_nome = mysqli_fetch_array($livro_result)['nome'];

// Recupera o nome do usuário correspondente ao ID
$usuario_query = "SELECT nome, cpf FROM usuarios WHERE id = $usuario_id";
$usuario_result = mysqli_query($conn, $usuario_query);
$usuario_data = mysqli_fetch_array($usuario_result);
$usuario_nome = $usuario_data['nome'];
$cpf_usuario = $usuario_data['cpf'];

// Insere os dados na tabela de empréstimos
$insert_query = "INSERT INTO emprestimos (livro_id, livro_nome, usuario_id, usuario_nome, data_emprestimo, cpf_usuario, prazo_entrega) VALUES ($livro_id, '$livro_nome', $usuario_id, '$usuario_nome', CURDATE(), '$cpf_usuario', '$prazo_entrega')";
mysqli_query($conn, $insert_query);

// Atualiza a quantidade em estoque do livro
$update_query = "UPDATE livros SET estoque = estoque - 1 WHERE id = $livro_id";
mysqli_query($conn, $update_query);

// Redireciona para a página de empréstimos
header('Location: livros.php');
exit();
?>
