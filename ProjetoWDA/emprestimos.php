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
    <style>
        .table-success {
            background-color: #c3e6cb;
        }
        .table-warning {
            background-color: #ffeeba;
        }
        .table-danger {
            background-color: #f5c6cb;
        }

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

        @media (max-width: 700px) {
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
<center><h1>Lista de Empréstimos</h1></center>

    <center><a href="pesquisa.php"><button type="button" class="button-background-move">Pesquisar Empréstimo</button></a> <a href="emprestar.php"><button type="button" class="button-background-move">Efetuar Empréstimo</button></a></center>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Id Livro</th>
                <th>Livro</th>
                <th>Id Usuário</th>
                <th>Usuário</th>
                <th>Prazo</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
                include 'conexao.php';

                // Query SQL para selecionar os empréstimos
                $sql = "SELECT * FROM emprestimos WHERE status = '' ORDER BY usuario_nome ASC";

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
                        echo "<td>" .formatarData($row["prazo_entrega"]). "</td>";
                        
                        // Verifica o status do empréstimo
                        $dataAtual = date('Y-m-d');
                        $prazoEntrega = $row["prazo_entrega"];
                        $status = "";
                        
                        if ($prazoEntrega < $dataAtual) {
                            $status = "Atrasado";
                            echo "<td class='table-danger'>$status</td>";
                        } else {
                            $status = "Dentro do prazo";
                            echo "<td class='table-success'>$status</td>";
                        }
                        
                        echo "<td><a href='devolver.php?id=".$row["id"]."'><button type='button' class='btn btn-secondary'>Devolver</button></a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Nenhum empréstimo cadastrado.</td></tr>";
                }

                // Fecha a conexão com o banco de dados
                mysqli_close($conn);
            ?>
        </tbody>
    </table>
                <br>
    <center><h2>Empréstimos Devolvidos</h2></center>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Id Livro</th>
                <th>Livro</th>
                <th>Id Usuário</th>
                <th>Usuário</th>
                <th>Prazo</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
                include 'conexao.php';

                // Query SQL para selecionar os empréstimos devolvidos
                $devolvidosSql = "SELECT * FROM emprestimos WHERE status = 'Devolvido' ORDER BY usuario_nome ASC";

                $devolvidosResult = mysqli_query($conn, $devolvidosSql);

                // Verifica se existem empréstimos devolvidos cadastrados
                if (mysqli_num_rows($devolvidosResult) > 0) {
                    // Loop para imprimir cada empréstimo devolvido em uma linha da tabela
                    while($devolvidoRow = mysqli_fetch_assoc($devolvidosResult)) {
                        echo "<tr>";
                        echo "<td>" . $devolvidoRow["id"] . "</td>";
                        echo "<td>" . $devolvidoRow["livro_id"] . "</td>";
                        echo "<td>" . $devolvidoRow["livro_nome"] . "</td>";
                        echo "<td>" . $devolvidoRow["usuario_id"] . "</td>";
                        echo "<td>" . $devolvidoRow["usuario_nome"] . "</td>";
                        echo "<td>" .formatarData($devolvidoRow["prazo_entrega"]). "</td>";
                        
                        // Verifica se o empréstimo foi devolvido dentro ou fora do prazo
                        $prazoEntrega = $devolvidoRow["prazo_entrega"];
                        $dataDevolucao = $devolvidoRow["data_devolucao"];
                        $statusDevolvido = ($dataDevolucao <= $prazoEntrega) ? "Dentro do prazo" : "Fora do prazo";
                        echo "<td>$statusDevolvido</td>";
                        
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Nenhum empréstimo devolvido encontrado.</td></tr>";
                }

                // Fecha a conexão com o banco de dados
                mysqli_close($conn);

                
// Função para formatar a data no formato brasileiro
            function formatarData($data) {
                return date("d/m/Y", strtotime($data));
                }
            ?>
        </tbody>
    </table>
</div>
</div>
</body>
</html>
