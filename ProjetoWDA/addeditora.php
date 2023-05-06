<?php 
 
include_once 'conexao.php';

	$nome 	= isset($_POST['nome']) == true ?$_POST['nome']:"";
	$email	= isset($_POST['email']) == true ?$_POST['email']:"";
	$telefone  = isset($_POST['telefone']) == true ?$_POST['telefone']:"";
    $site  = isset($_POST['site']) == true ?$_POST['data_lancamento']:"";

	//inserir dados no banco de dados.

	$sql = "INSERT INTO editoras (nome, email, telefone, site) VALUES ('$nome', '$email', '$telefone', '$site')";

		if ($conn->query($sql) == TRUE) {

			header('Location: editoras.php');

		} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$conn->close();

?>