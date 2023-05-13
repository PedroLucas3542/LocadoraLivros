<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Se o usuário não estiver logado, redireciona para a página de login
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Editar Editora</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
	<br>
	<center><h1>Editar Editora</h1></center><br>
	<?php
		include 'conexao.php';
		// Verificar se o formulário foi submetido
		if (isset($_POST["submit"])) {
			// Atualizar usuário
			$id = $_POST["id"];
			$nome = $_POST["nome"];
			$email = $_POST["email"];
            $telefone = $_POST["telefone"];
            $site = $_POST["site"];
			$sql = "UPDATE editoras SET nome='$nome', email='$email', telefone='$telefone', site='$site' WHERE id='$id'";
			if (mysqli_query($conn, $sql)) {
				echo "<center><p>Editora atualizada com sucesso!</p><a href='editoras.php'>Retornar à lista de editoras.</a></center>";
			} else {
				echo "Erro ao atualizar editora: " . mysqli_error($conn);
			}
		}
		// Obter o ID do usuário a ser editado
		$id = $_GET["id"];
		$sql = "SELECT * FROM editoras WHERE id='$id'";
		$result = mysqli_query($conn, $sql);
		// Exibir formulário de edição
		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			?>
		<div class="container">
			<form method="post" action="">
				<input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
				<div class="mb-3">
				<label for="exampleInputEmail1" class="form-label">Nome:</label><br>
				<input type="text" class="form-control" name="nome" value="<?php echo $row["nome"]; ?>"><br>
				</div>
				<div class="mb-3">
				<label class="form-label">Email:</label><br>
				<input type="email" class="form-control" name="email" value="<?php echo $row["email"]; ?>"><br>
				</div>
				<div class="mb-3">
				<label class="form-label">Telefone:</label><br>
				<input type="text" class="form-control" name="telefone" value="<?php echo $row["telefone"]; ?>"><br>
				</div>
				<div class="mb-3">
				<label class="form-label">Site:</label><br>
				<input type="text" class="form-control" name="site" value="<?php echo $row["site"]; ?>"><br>

				<center><input type="submit" name="submit" class="btn btn-info" value="Atualizar"></center>
			</form>
		</div>
			<?php
		} else {
			echo "<p>Editora não encontrada.</p>";
		}
		// Fechar conexão
		mysqli_close($conn);
	?>
</body>

</html>

