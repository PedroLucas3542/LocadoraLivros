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

        .search-bar {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .search-bar form {
            display: flex;
            align-items: center;
        }

        .search-bar input[type="text"],
        .search-bar select {
            margin-right: 10px;
            padding: 5px;
        }

        .search-bar button[type="submit"] {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .search-bar button[type="submit"]:hover {
            background-color: #2980b9;
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
	  <br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Lista de Editoras</h1>
            </div>
            <div class="col-md-6 text-end">
                <a href="adicionareditora.php"><button class="button-background-move">Adicionar Editora</button></a>
            </div>
        </div>

        <div class="search-bar">
            <form method="GET">
                <input type="text" name="search" placeholder="Pesquisar...">
                <select name="filter">
                    <option value="id">ID</option>
                    <option value="nome">Nome</option>
                    <option value="email">Email</option>
                    <option value="telefone">Telefone</option>
                    <option value="site">Site</option>
                </select>
                <button type="submit">Pesquisar</button>
            </form>
        </div>

	<table class="table table-secondary table-striped">
		<tr>
			<th>ID</th>
			<th>Nome</th>
			<th>Email</th>
			<th>Telefone</th>
			<th>Site</th>
            <th>Ação</th>
		</tr>
		<?php
			include 'conexao.php'; 
			if (isset($_GET['search']) && isset($_GET['filter'])) {
                // Realizar pesquisa com base nos critérios fornecidos
                $search = $_GET['search'];
                $filter = $_GET['filter'];
                $sql = "SELECT * FROM editoras WHERE $filter LIKE '%$search%' ORDER BY nome ASC";
            } else {
                // Consultar usuários sem critérios de pesquisa
                $sql = "SELECT * FROM editoras ORDER BY nome ASC";
            }

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
					echo "<td><a href='editaeditora.php?id=".$row["id"]."' class='btn'><i class='fa fa-edit' style='font-size:48px;color:orange'></i></a> <a href='excluireditora.php?id=".$row["id"]."' class='btn'><i class='fa fa-trash-o' style='font-size:48px;color:red'></i></a></td>";
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
	</div>	
</body>
</html>