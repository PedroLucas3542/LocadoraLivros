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
<html lang="en">
<head>
	<title>Lista de Editoras</title>
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
	  <div class="container">
      <center><h1>Lista de Editoras</h1></center>
	  <br>
	  <a href="adicionareditora.php"><button type="button" class="button-background-move">Adicionar Editora</button></a> - <a href="pesquisaeditoras.php"><button type="button" class="button-background-move">Pesquisar Editoras</button></a><br><br>
	<table class="table table-secondary table-striped">
		<tr>
			<th>ID</th>
			<th>Nome</th>
			<th>Email</th>
			<th>Telefone</th>
			<th>Site</th>
		</tr>
		<?php
			include 'conexao.php'; 
			// Consultar usuários
			$sql = "SELECT * FROM editoras";
			$result = mysqli_query($conn, $sql);
			// Exibir resultados
			//Se tiver mais de um registro
			if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>".$row["id"]."</td>";
					echo "<td>".$row["nome"]."</td>";
					echo "<td>".$row["email"]."</td>";
					echo "<td>".$row["telefone"]."</td>";
					echo "<td>".$row["site"]."</td>";
					echo "<td><a href='editaeditora.php?id=".$row["id"]."' class='btn btn-warning'>Editar</a> | <a href='excluireditora.php?id=".$row["id"]."' class='btn btn-danger'>Excluir</a></td>";
					echo "</tr>";
				}
			} else {
				echo "<tr><td colspan='4'>Nenhuma editora encontrada.</td></tr>";
			}
			// Fechar conexão
			mysqli_close($conn);
		?>
	</table>
	</div>		
</body>
</html>