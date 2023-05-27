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
    <meta charset="UTF-8">
    <title>Usuários</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
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
            font-size: 1.5rem;
            padding: 0.25rem 0.5rem;
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
            padding: 5px;
        }

        td a.btn-warning {
            background-color: #f39c12;
            font-size: 1.5rem;
        }

        td a.btn-danger {
            background-color: #e74c3c;
            font-size: 1.5rem;
        }

        @media (max-width: 767px) {
            .container {
                width: 90%;
                max-width: 100%;
                padding: 10px;
            }

            .table {
                width: 100%;
                overflow-x: auto;
            }

            .table td {
                padding: 5px;
            }
        }
    </style>
    <script src="js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-light navbar-custom">
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
        <center><h1>Lista de Usuários</h1></center>
		<center>
        <a href="adicionar.php"><button type="button" class="button-background-move">Adicionar Usuário</button></a> 
        <a href="pesquisarusuario.php"><button type="button" class="button-background-move">Pesquisar Usuário</button></a><br>
		</center>
        <br>
        <table class="table table-primary table-striped">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Celular</th>
                <th>Endereço</th>
                <th>CPF</th>
                <th>Ação</th>
            </tr>
            <?php
            include 'conexao.php';
            // Consultar usuários
            $sql = "SELECT * FROM usuarios ORDER BY nome ASC";
            $result = mysqli_query($conn, $sql);
            // Exibir resultados
            //Se tiver mais de um registro
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["nome"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["celular"] . "</td>";
                    echo "<td>" . $row["endereco"] . "</td>";
                    echo "<td>" . $row["cpf"] . "</td>";

                    echo "<td><a href='editar.php?id=" . $row["id"] . "' class='btn'><i class='fa fa-edit' style='font-size:48px;color:orange'></i></a> <a href='excluir.php?id=" . $row["id"] . "' class='btn'><i class='fa fa-trash-o' style='font-size:48px;color:red'></i></a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Nenhum usuário encontrado.</td></tr>";
            }
            // Fechar conexão
            mysqli_close($conn);

            ?>
        </table>
    </div>
</div>
</body>
</html>