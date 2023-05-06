<!DOCTYPE html>
<html>
<head>
	<title>Empréstimo de Livro</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>

	<br><br><center><h1>Empréstimo de Livro</h1></center><br><br>

	<?php
		// Verifica se foi enviado um ID válido via GET
		if (isset($_GET['id']) && !empty($_GET['id'])) {
			$id = $_GET['id'];

			// Conecta ao banco de dados
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "wda";

			$conn = new mysqli($servername, $username, $password, $dbname);

			// Verifica se a conexão foi estabelecida corretamente
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}

			// Seleciona o livro com o ID correspondente
			$sql = "SELECT * FROM livros WHERE id = " . $id;
			$result = $conn->query($sql);

			// Verifica se encontrou algum resultado
			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();

				// Exibe as informações do livro
				echo "<center><p><strong>Nome:</strong> " . $row["nome"] . "</p>";
				echo "<p><strong>Autor:</strong> " . $row["autor"] . "</p>";
				echo "<p><strong>Editora:</strong> " . $row["editora"] . "</p>";
				echo "<p><strong>Data de Lançamento:</strong> " . $row["data_lancamento"] . "</p>";
				echo "<p><strong>Quantidade em Estoque:</strong> " . $row["estoque"] . "</p>";

				// Cria o formulário para empréstimo
				echo '<center><form method="POST" action="salvar_emprestimo.php">';
				echo '<input type="hidden" name="livro_id" value="' . $id . '">';
				echo '<label for="usuario_id">Usuário:</label>';
				echo '<select name="usuario_id" id="usuario_id">';

				// Seleciona todos os usuários cadastrados
				$sql = "SELECT * FROM usuarios";
				$result = $conn->query($sql);

				// Exibe cada usuário em uma opção do select
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						echo '<option value="' . $row["id"] . '">' . $row["nome"] . '</option>';
					}
				}

				echo '</select><br>';
				echo '<br>';
				echo '<label for="prazo_entrega">Prazo de Entrega:</label>';
				echo '<input type="date" name="prazo_entrega" id="prazo_entrega"><br>';
				echo '<br>';
				echo '<input type="submit" value="Emprestar"><br><a href="livros.php">Cancelar</a>';
				echo '</form></center>';
			} else {
				echo "<p>Livro não encontrado.</p>";
			}

			// Fecha a conexão com o banco de dados
			$conn->close();
		} else {
			echo "<p>ID inválido.</p>";
		}
	?>

</body>
</html>