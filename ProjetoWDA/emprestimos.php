<!DOCTYPE html>
<html>
<head>
	<title>Lista de Empréstimos</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.html">BiblioPedro</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
              <a class="nav-link" href="usuarios.php">Usuários</a>
			  <a class="nav-link" href="livros.php">Livros</a>
			  <a class="nav-link" href="emprestimos.php">Empréstimos</a>
			  <a class="nav-link" href="editoras.php">Editoras</a>
            </div>
          </div>
        </div>
      </nav>
	  <br><br>
	<center><h1>Lista de Empréstimos</h1></center><br><br>
    <div class="container">
	<a href="pesquisa.php" type="button" class="btn btn-success">Pesquisar Empréstimo</a><br><br>
	<table class="table">
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
                        echo "<td><a href='devolver.php?id=".$row["id"]."'>Devolução</a></td>";
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