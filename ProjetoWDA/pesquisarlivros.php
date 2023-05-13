<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/bootstrap.bundle.min.js"></script>
    <meta charset="UTF-8">
    <title>Pesquisa de Livros</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        form {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"] {
            width: 300px;
            padding: 5px;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: #fff;
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
      <div class="container">
    <h1>Pesquisa de Livros</h1>
    <form method="GET" action="">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome">

        <label for="autor">Autor:</label>
        <input type="text" name="autor" id="autor">

        <label for="editora">Editora:</label>
        <input type="text" name="editora" id="editora">

        <label for="data_lancamento">Data de Lançamento:</label>
        <input type="text" name="data_lancamento" id="data_lancamento">

        <input type="submit" value="Pesquisar">
    </form>

    <?php
    // Verifica se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Obter os valores dos campos de pesquisa
        $nome = $_GET['nome'] ?? '';
        $autor = $_GET['autor'] ?? '';
        $editora = $_GET['editora'] ?? '';
        $dataLancamento = $_GET['data_lancamento'] ?? '';

        // Construir a consulta SQL com base nos filtros de pesquisa
        $query = "SELECT * FROM livros WHERE 1=1";

        if (!empty($nome)) {
            $query .= " AND nome LIKE '%$nome%'";
        }

        if (!empty($autor)) {
            $query .= " AND autor LIKE '%$autor%'";
        }

        if (!empty($editora)) {
            $query .= " AND editora LIKE '%$editora%'";
        }

        if (!empty($dataLancamento)) {
            $query .= " AND data_lancamento = '$dataLancamento'";
        }

        // Executar a consulta SQL
        // Substitua as informações de conexão com o banco de dados pelo seu próprio código de conexão
        include 'conexao.php';
        $result = mysqli_query($conn, $query);

        // Exibir os resultados em uma tabela
        if (mysqli_num_rows($result) > 0) {
            echo "<table>
                    <tr>
                        <th>Nome</th>
                        <th>Autor</th>
                        <th>Editora</th>
                        <th>Data de Lançamento</th>
                    </tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>" . $row['nome'] . "</td>
                        <td>" . $row['autor'] . "</td>
                        <td>" . $row['editora'] . "</td>
                        <td>" . $row['data_lancamento'] . "</td>
                    </tr>";
            }

            echo "</table>";
        } else {
            echo "Nenhum livro encontrado.";
        }

        // Fechar a conexão com o banco de dados
        mysqli_close($conn);
    }
    ?>
    </div>
</body>
</html>

