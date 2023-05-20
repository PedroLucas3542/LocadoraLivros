<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Se o usuário não estiver logado, redireciona para a página de login
    header('Location: login.php');
    exit();
}
?>

<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/bootstrap.bundle.min.js"></script>

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
</nav>
<br><br>

<?php
// Inclui o arquivo de conexão com o banco de dados
include 'conexao.php';

// Consultar a quantidade de empréstimos de cada usuário
$sql = "SELECT usuarios.nome, COUNT(emprestimos.id) AS quantidade
        FROM usuarios
        LEFT JOIN emprestimos ON usuarios.id = emprestimos.usuario_id
        GROUP BY usuarios.id";

$result = mysqli_query($conn, $sql);

// Verificar se há resultados
if (mysqli_num_rows($result) > 0) {
    $userData = array();
    $userData[] = ['Usuário', 'Quantidade de Empréstimos'];

    // Obter os dados do resultado da consulta
    while ($row = mysqli_fetch_assoc($result)) {
        $userName = $row['nome'];
        $loanQuantity = (int)$row['quantidade'];
        $userData[] = [$userName, $loanQuantity];
    }

    // Converter os dados para o formato esperado pelo gráfico
    $userDataJson = json_encode($userData);
} else {
    // Caso não haja empréstimos registrados, definir os dados como vazios
    $userDataJson = "[['Nenhum usuário', 0]]";
}

// Consultar a quantidade de empréstimos de cada livro
$sql = "SELECT livros.nome, COUNT(emprestimos.id) AS quantidade
        FROM livros
        LEFT JOIN emprestimos ON livros.id = emprestimos.livro_id
        GROUP BY livros.id";

$result = mysqli_query($conn, $sql);

// Verificar se há resultados
if (mysqli_num_rows($result) > 0) {
    $bookData = array();
    $bookData[] = ['Livro', 'Quantidade de Empréstimos'];

    // Obter os dados do resultado da consulta
    while ($row = mysqli_fetch_assoc($result)) {
        $bookName = $row['nome'];
        $loanQuantity = (int)$row['quantidade'];
        $bookData[] = [$bookName, $loanQuantity];
    }

    // Converter os dados para o formato esperado pelo gráfico
    $bookDataJson = json_encode($bookData);
} else {
    // Caso não haja empréstimos registrados, definir os dados como vazios
    $bookDataJson = "[['Nenhum livro', 0]]";
}

// Fechar conexão
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {packages: ['corechart']});
        google.charts.setOnLoadCallback(drawCharts);

        function drawCharts() {
            var userData = <?php echo $userDataJson; ?>;
            var bookData = <?php echo $bookDataJson; ?>;

            drawUserChart(userData);
            drawBookChart(bookData);
        }

        function drawUserChart(userData) {
    var data = google.visualization.arrayToDataTable(userData);

    var options = {
        title: 'Quantidade de Empréstimos por Usuário',
        hAxis: {title: 'Usuário', minValue: 0},
        vAxis: {title: 'Quantidade de Empréstimos', minValue: 0, format: '0'},
        chartArea: {width: '80%', height: '70%'},
        legend: 'none'
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('userChart'));
    chart.draw(data, options);
}
        function drawBookChart(bookData) {
            var data = google.visualization.arrayToDataTable(bookData);

            var options = {
                title: 'Livros Mais Emprestados',
                is3D: true,
                chartArea: {width: '80%', height: '70%'},
                legend: 'none'
            };

            var chart = new google.visualization.PieChart(document.getElementById('bookChart'));
            chart.draw(data, options);
        }
    </script>
    <style>
        .card {
            width: 550px;
            height: 500px;
            padding: 20px;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            border-radius: 8px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div id="userChart" style="width: 100%; height: 100%;"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div id="bookChart" style="width: 100%; height: 100%;"></div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>




