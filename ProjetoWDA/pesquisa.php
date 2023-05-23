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
    <title>Pesquisar Empréstimos</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/bootstrap.bundle.min.js"></script>
    <head>
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
    <h1>Pesquisar Empréstimos</h1>
    <form action="" method="GET">
        <label for="variavel">Pesquisar por:</label>
        <select name="variavel" id="variavel">
            <option value="usuario_nome">Nome do Usuário</option>
            <option value="cpf">CPF do Usuário</option>
            <option value="livro_nome">Nome do Livro</option>
        </select>
        <br>
        <label for="valor">Valor:</label>
        <input type="text" name="valor" id="valor" required>

        <input type="submit" value="Pesquisar">
    </form><br>
    </center>
    <?php
    // Verifica se o formulário foi enviado
    if (isset($_GET['variavel']) && isset($_GET['valor'])) {
        $variavel = $_GET['variavel'];
        $valor = $_GET['valor'];

        // Realiza a conexão com o banco de dados
        include('conexao.php');

        // Monta a query SQL com base na variável selecionada
        if ($variavel === 'cpf') {
            $query_emprestimos = "SELECT * FROM emprestimos INNER JOIN usuarios ON emprestimos.usuario_id = usuarios.id WHERE usuarios.cpf = '$valor'";
        } else {
            $query_emprestimos = "SELECT * FROM emprestimos WHERE $variavel LIKE '%$valor%'";
        }

        $resultado_emprestimos = mysqli_query($conn, $query_emprestimos);

        // Verifica se foram encontrados empréstimos
        if (mysqli_num_rows($resultado_emprestimos) > 0) {
            echo "<center><h2>Empréstimos encontrados:</h2></center><br>";
            echo "<table>";
            echo "<tr><th>ID</th><th>Livro</th><th>Usuário</th><th>Data de Empréstimo</th></tr>";

            // Exibe os dados dos empréstimos encontrados
            while ($row = mysqli_fetch_assoc($resultado_emprestimos)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['livro_nome'] . "</td>";
                echo "<td>" . $row['usuario_nome'] . "</td>";
                echo "<td>" . $row['data_emprestimo'] . "</td>";
                echo "<td><a href='devolver.php?id=".$row["id"]."'>Devolução</a></td>";
                echo "</tr>";
            }

            echo "</table></div>";
        } else {
            echo "<p>Nenhum empréstimo encontrado para a variável selecionada.</p>";
        }
    }
    ?>
    </div>
    </div>