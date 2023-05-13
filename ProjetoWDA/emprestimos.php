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
	<title>Lista de Empréstimos</title>
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
	<center><h1>Lista de Empréstimos</h1></center><br><br>
    <div class="container">
	<a href="pesquisa.php"><button type="button" class="button-background-move">Pesquisar Empréstimo</button></a><br><br>
	<table class="table table-danger table-striped">
		<thead>
			<tr>
				<th>ID</th>
				<th>Id Livro</th>
                <th>Livro</th>
				<th>Id Usuário</th>
                <th>Usuário</th>
				<th>Prazo</th>
			</tr>
		</thead>
		<tbody>
			<?php
				include 'conexao.php';

				// Query SQL para selecionar os empréstimos
				$sql = "SELECT * FROM emprestimos";

				$result = mysqli_query($conn, $sql);

				// Verifica se existem empréstimos cadastrados
				if (mysqli_num_rows($result) > 0) {
				    // Loop para imprimir cada empréstimo em uma linha da tabela
				    while($row = mysqli_fetch_assoc($result)) {
				        echo "<tr>";
				        echo "<td>" . $row["id"] . "</td>";
				        echo "<td>" . $row["livro_id"] . "</td>";
				        echo "<td>" . $row["livro_nome"] . "</td>";
				        echo "<td>" . $row["usuario_id"] . "</td>";
                        echo "<td>" . $row["usuario_nome"] . "</td>";
				        echo "<td>" . $row["prazo_entrega"] . "</td>";
                        echo "<td><a href='devolver.php?id=".$row["id"]."'><button type='button' class='btn btn-secondary'>Devolver</button></a></td>";
				        echo "</tr>";
				    }
				} else {
				    echo "Nenhum empréstimo cadastrado.";
				}

				// Fecha a conexão com o banco de dados
				mysqli_close($conn);
			?>
		</tbody>
	</table>
    </div>
</body>
</html>