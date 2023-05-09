<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Se o usuário não estiver logado, redireciona para a página de login
    header('Location: login.php');
    exit();
}
?>
<style>
    /* Estilo geral */
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    /* Estilo do dashboard */
    .dashboard-container {
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .dashboard-title {
        font-size: 24px;
        margin-bottom: 20px;
    }

    .dashboard-section {
        margin-bottom: 30px;
    }

    .dashboard-section-title {
        font-size: 20px;
        margin-bottom: 10px;
    }

    .dashboard-card {
        background-color: #f5f5f5;
        border-radius: 5px;
        padding: 20px;
    }

    .dashboard-card-title {
        font-size: 18px;
        margin-bottom: 10px;
    }

    .dashboard-card-value {
        font-size: 24px;
    }
</style>

<link rel="stylesheet" href="css/bootstrap.min.css">
<nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.html">BiblioPedro</a>
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

<?php
include_once('conexao.php');

// Quantidade de livros emprestados
$query_emprestados = "SELECT COUNT(*) AS total_emprestados FROM emprestimos";
$resultado_emprestados = mysqli_query($conn, $query_emprestados);
$livros_emprestados = mysqli_fetch_assoc($resultado_emprestados)['total_emprestados'];

// Quantidade de livros atrasados
$query_atrasados = "SELECT COUNT(*) AS total_atrasados FROM emprestimos WHERE prazo_entrega < CURDATE()";
$resultado_atrasados = mysqli_query($conn, $query_atrasados);
$livros_atrasados = mysqli_fetch_assoc($resultado_atrasados)['total_atrasados'];

// Quantidade de livros devolvidos dentro do prazo
$query_devolvidos_prazo = "SELECT COUNT(*) AS total_devolvidos_prazo FROM devolvidos";
$resultado_devolvidos_prazo = mysqli_query($conn, $query_devolvidos_prazo);
$livros_devolvidos_prazo = mysqli_fetch_assoc($resultado_devolvidos_prazo)['total_devolvidos_prazo'];

// Quantidade de livros devolvidos fora do prazo
$query_devolvidos_fora_prazo = "SELECT COUNT(*) AS total_devolvidos_fora_prazo FROM devolvidos";
$resultado_devolvidos_fora_prazo = mysqli_query($conn, $query_devolvidos_fora_prazo);
$livros_devolvidos_fora_prazo = mysqli_fetch_assoc($resultado_devolvidos_fora_prazo)['total_devolvidos_fora_prazo'];

// Quantidade de aluguéis por usuário
$query_alugueis_por_usuario = "SELECT usuario_id, COUNT(*) AS total_alugueis FROM emprestimos GROUP BY usuario_id";
$resultado_alugueis_por_usuario = mysqli_query($conn, $query_alugueis_por_usuario);
$alugueis_por_usuario = array();
while ($row = mysqli_fetch_assoc($resultado_alugueis_por_usuario)) {
    $usuario_id = $row['usuario_id'];
    $total_alugueis = $row['total_alugueis'];
    $alugueis_por_usuario[$usuario_id] = $total_alugueis;
}

// Livro mais alugado
$query_livro_mais_alugado = "SELECT livro_id, COUNT(*) AS total_alugueis FROM emprestimos GROUP BY livro_id ORDER BY total_alugueis DESC LIMIT 1";
$resultado_livro_mais_alugado = mysqli_query($conn, $query_livro_mais_alugado);
$livro_mais_alugado_id = mysqli_fetch_assoc($resultado_livro_mais_alugado)['livro_id'];

// Recupera o nome do livro mais alugado
$query_nome_livro_mais_alugado = "SELECT nome FROM livros WHERE id = $livro_mais_alugado_id";
$resultado_nome_livro_mais_alugado = mysqli_query($conn, $query_nome_livro_mais_alugado);
$livro_mais_alugado_nome = mysqli_fetch_assoc($resultado_nome_livro_mais_alugado)['nome'];

// Quantidade de livros devolvidos
$query_devolvidos = "SELECT COUNT(*) AS total_devolvidos FROM emprestimos";
$resultado_devolvidos = mysqli_query($conn, $query_devolvidos);
$livros_devolvidos = mysqli_fetch_assoc($resultado_devolvidos)['total_devolvidos'];

// Exibir as informações no dashboard
echo "<div class='dashboard-container'>";
echo "<center><h2>Dashboard</h2>";
echo "<p>Quantidade de livros emprestados: $livros_emprestados</p>";
echo "<p>Quantidade de livros atrasados: $livros_atrasados</p>";
echo "<p>Quantidade de livros devolvidos dentro do prazo: $livros_devolvidos_prazo</p>";
echo "<p>Quantidade de livros devolvidos fora do prazo: $livros_devolvidos_fora_prazo</p>";
echo "<h3>Quantidade de aluguéis por usuário:</h3>";
foreach ($alugueis_por_usuario as $usuario_id => $total_alugueis) {
    echo "<p>Usuário ID $usuario_id: $total_alugueis aluguéis</p>";
}
echo "<p>Livro mais alugado: $livro_mais_alugado_nome</p>";
echo "<p>Quantidade de livros devolvidos: $livros_devolvidos</p></center>";
echo "</div>"
?>
