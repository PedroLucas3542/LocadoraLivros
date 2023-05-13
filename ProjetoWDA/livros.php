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
	<title>Lista de Livros</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
	<script src="js/bootstrap.bundle.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
		<a class="navbar-brand" href="#">
      		<img src="logo.png" alt="Bootstrap" width="90" height="72">
    	</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
              <a class="nav-link btn btn-light" href="usuarios.php">Usuários</a>
			  <a class="nav-link btn btn-light" href="livros.php">Livros</a>
			  <a class="nav-link btn btn-light" href="emprestimos.php">Empréstimos</a>
			  <a class="nav-link btn btn-light" href="editoras.php">Editoras</a>
			  <a class="nav-link btn btn-light" href="atrasos.php">Atrasos</a>
			  <a class="nav-link btn btn-light" href="dashboard.php" class="dashboard-button">Dashboard</a>
			  <a class="nav-link btn btn-light" href="logout.php">Sair</a>
            </div>
          </div>
        </div>
      </nav>
	  <br><br>
	<center><h1>Lista de Livros</h1></center><br><br>
	<div class="container">
	<a href="adicionarlivro.php"><button type="button" class="button-background-move">Adicionar Livro</button></a> - <a href="pesquisarlivros.php"><button type="button" class="button-background-move">Pesquisar Livro</button></a><br><br>
	<table class="table table-warning table-striped">
		<tr>
			<th>ID</th>
			<th>Nome</th>
			<th>Autor</th>
			<th>Editora</th>
			<th>Data de Lançamento</th>
			<th>Quantidade em Estoque</th>
			<th>Ação</th>
		</tr>
		<?php 
			include 'conexao.php';
            
			// Query para selecionar todos os livros
			$sql = "SELECT * FROM livros";

			// Executa a query e armazena o resultado
			$result = $conn->query($sql);

			// Loop para exibir cada registro na tabela
			while($row = $result->fetch_assoc()) {
				echo "<tr>";
				echo "<td>".$row["id"]."</td>";
				echo "<td>".$row["nome"]."</td>";
				echo "<td>".$row["autor"]."</td>";
				echo "<td>".$row["editora"]."</td>";
				echo "<td>".$row["data_lancamento"]."</td>";
				echo "<td>".$row["estoque"]."</td>";
				echo "<td><a href='emprestar.php?id=".$row["id"]."' class='btn btn-info'>Emprestar</a> | <a href='editarlivros.php?id=".$row["id"]."' class='btn btn-warning'>Editar</a> | <a href='excluirlivro.php?id=".$row["id"]."' class='btn btn-danger'>Excluir</a></td>";
				echo "</tr>";
			}

			// Fecha a conexão com o banco de dados
			$conn->close();
		?>
	</table>
	</div>
</body>
</html>