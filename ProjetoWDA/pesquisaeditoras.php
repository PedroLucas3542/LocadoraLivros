<!DOCTYPE html>
<html>
<head>
  	<link rel="stylesheet" href="css/bootstrap.min.css">
	  <script src="js/bootstrap.bundle.min.js"></script>
    <meta charset="UTF-8">
    <title>Pesquisa de Usuários</title>
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

        body {
            font-family: Arial, sans-serif;
            margin: 0;
        }

        h1 {
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            max-width: 400px;
        }

        label {
            margin-bottom: 10px;
        }

        input[type="text"] {
            padding: 5px;
            font-size: 14px;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            padding: 10px 15px;
            background-color: #3498db;
            color: #fff;
            font-size: 14px;
            border: none;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
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
        <center>
    <h2>Pesquisa de Editoras</h2>
    <br>
    <form method="GET" action="">
        <input type="text" name="nome" placeholder="Digite o nome da editora">
        <input type="submit" value="Pesquisar">
    </form>
    </center><br>
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
    </div>
    </div>
</body>
</html>
