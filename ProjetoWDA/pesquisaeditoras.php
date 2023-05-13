<!DOCTYPE html>
<html>
<head>
  	<link rel="stylesheet" href="css/bootstrap.min.css">
	  <script src="js/bootstrap.bundle.min.js"></script>
    <meta charset="UTF-8">
    <title>Pesquisa de Usuários</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h2 {
            margin-top: 30px;
            text-align: center;
        }
        form {
            margin: 30px auto;
            width: 300px;
            text-align: center;
        }
        input[type="text"] {
            padding: 8px;
            width: 100%;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            padding: 8px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        table {
            width: 60%;
            margin: 30px auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
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
      </nav><br><br>
    <h2>Pesquisa de Editoras</h2>
    <form method="GET" action="">
        <input type="text" name="nome" placeholder="Digite o nome da editora">
        <input type="submit" value="Pesquisar">
    </form>

    <?php
    // Verifica se o formulário foi submetido
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Obtém o nome digitado no formulário
        @$nome = $_GET['nome'];

        include 'conexao.php';

        // Constrói a consulta SQL
        $query = "SELECT * FROM editoras WHERE nome LIKE '%$nome%'";

        // Executa a consulta
        $result = mysqli_query($conn, $query);

        // Verifica se a consulta retornou resultados
        if (mysqli_num_rows($result) > 0) {
            echo "<table>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Telefone</th>
                        <th>Site</th>
                    </tr>";

            // Exibe os resultados
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>" . $row['nome'] . "</td>
                        <td>" . $row['email'] . "</td>
                        <td>" . $row['telefone'] . "</td>
                        <td>" . $row['site'] . "</td>
                    </tr>";
            }

            echo "</table>";
        } else {
            echo "Nenhuma editora encontrada.";
        }

        // Fecha a conexão com o banco de dados
        mysqli_close($conn);
    }
    ?>
</body>
</html>
