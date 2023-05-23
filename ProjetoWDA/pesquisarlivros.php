<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/bootstrap.bundle.min.js"></script>
    <meta charset="UTF-8">
    <title>Pesquisa de Livros</title>
    <style>
        html{
            background-color: #f0f5f9;
        }

        .navbar {
            background-color: #fff;
            border-bottom: 1px solid #ccc;
        }

        .navbar-brand {
            margin-right: 10px;
            font-weight: bold;
        }

        .navbar-toggler {
            border: none;
        }

        .navbar-nav .nav-link {
            color: #333;
        }

        .navbar-nav .nav-link:hover {
            color: #888;
        }

        .navbar-nav .nav-item:last-child .nav-link {
            padding-right: 0;
        }

        .nav-link i {
            font-size: 25px;
        }

        .fundo {
            background-color: #f0f5f9;
            padding-top: 30px;
            padding-bottom: 30px;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #010101;
            margin-bottom: 30px;
        }

        input[type="submit"]{
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
            margin-right: 10px;
        }

        .button-background-move {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
            margin-right: 10px;
        }

        .button-background-move:hover {
            background-color: #2980b9;
        }

        .table {
            margin-top: 20px;
        }

        th {
            background-color: #3498db;
            color: #fff;
        }

        td a {
            color: #fff;
            margin-right: 5px;
        }

        td a.btn-warning {
            background-color: #f39c12;
        }

        td a.btn-danger {
            background-color: #e74c3c;
        }

        @media (max-width: 768px) {
            .navbar-brand img {
                width: 80px;
                height: 60px;
            }

            .button-background-move {
                font-size: 14px;
            }

			.container {
				width: 110px;
                height: 90px;
			}
        }

        @media (max-width: 576px) {
            .navbar-brand img {
                width: 60px;
                height: 40px;
            }

            .button-background-move {
                font-size: 12px;
                padding: 8px 16px;
            }
        }
    </style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="logo.png" width="80" height="60">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="usuarios.php">Usuários</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="livros.php">Livros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="emprestimos.php">Empréstimos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="editoras.php">Editoras</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">
                        <i class="fa fa-sign-out"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
        <div class="fundo">
      <div class="container">
    <center><h1>Pesquisa de Livros</h1></center>
    <form method="GET" action="">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome">

        <label for="autor">Autor:</label>
        <input type="text" name="autor" id="autor">

        <label for="editora">Editora:</label>
        <input type="text" name="editora" id="editora">

        <label for="data_lancamento">Data de Lançamento:</label>
        <input type="text" name="data_lancamento" id="data_lancamento"><br><br>

        <center><input type="submit" value="Pesquisar"></center>
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
            echo "<table class='table table-primary table-striped'>
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
    </div>
</body>
</html>

