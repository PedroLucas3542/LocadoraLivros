<?php 
 
include_once 'conexao.php';

	$nome 	= isset($_POST['nome']) == true ?$_POST['nome']:"";
	$autor	= isset($_POST['autor']) == true ?$_POST['autor']:"";
	$editora  = isset($_POST['editora']) == true ?$_POST['editora']:"";
    $data_lancamento  = isset($_POST['data_lancamento']) == true ?$_POST['data_lancamento']:"";
    $estoque  = isset($_POST['estoque']) == true ?$_POST['estoque']:"";

	//inserir dados no banco de dados.

	$sql = "INSERT INTO livros (nome, autor, editora, data_lancamento, estoque) VALUES ('$nome', '$autor', '$editora', '$data_lancamento', '$estoque')";

		if ($conn->query($sql) == TRUE) {

			header('Location: livros.php');

		} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$conn->close();

?>