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
	<title>Livros</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
	<br><br>
		<div class="container">
	<center><h1>Lista de Livros</h1></center>

	<center><a href="adicionarlivro.php"><button type="button" class="button-background-move">Adicionar Livro</button></a> <a href="pesquisarlivros.php"><button type="button" class="button-background-move">Pesquisar Livro</button></a></center>
    <br>
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
				echo "<td><a href='editarlivros.php?id=".$row["id"]."' class='btn'><i class='fa fa-edit' style='font-size:48px;color:orange'></i></a><a href='excluirlivro.php?id=".$row["id"]."' class='btn'><i class='fa fa-trash-o' style='font-size:48px;color:red'></i></a></td>";
				echo "</tr>";
			}

			// Fecha a conexão com o banco de dados
			$conn->close();
		?>
	</table>
	</div>
	</div>
</body>
</html>