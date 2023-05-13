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
<style>
.dashboard {
  width: 80%;
  margin: 0 auto;
  padding: 20px;
  background-color: #f5f5f5;
  border-radius: 8px;
}

/* Widget Container */
.widget {
  margin-bottom: 20px;
  padding: 20px;
  background-color: #ffffff;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
}

/* Widget Styles */
.widget p {
  margin: 0;
}

.widget h3 {
  margin-bottom: 10px;
}

/* Widget Colors */
.widget.primary {
  background-color: #3498db;
  color: #ffffff;
}

.widget.success {
  background-color: #2ecc71;
  color: #ffffff;
}

.widget.warning {
  background-color: #f1c40f;
  color: #ffffff;
}

.widget.utilitary {
  background-color: #a020f0;
  color: #ffffff;
}

.widget.error {
  background-color: #e74c3c;
  color: #ffffff;
}
</style>
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
$query_devolvidos_prazo = "SELECT COUNT(*) AS total_devolvidos_prazo FROM devolvidos WHERE prazo = 's'";
$resultado_devolvidos_prazo = mysqli_query($conn, $query_devolvidos_prazo);
$livros_devolvidos_prazo = mysqli_fetch_assoc($resultado_devolvidos_prazo)['total_devolvidos_prazo'];

// Quantidade de livros devolvidos fora do prazo
$query_devolvidos_fora_prazo = "SELECT COUNT(*) AS total_devolvidos_fora_prazo FROM devolvidos WHERE prazo = 'n'";
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
@$livro_mais_alugado_id = mysqli_fetch_assoc($resultado_livro_mais_alugado)['livro_id'];

// Recupera o nome do livro mais alugado
$query_nome_livro_mais_alugado = "SELECT nome FROM livros WHERE id = $livro_mais_alugado_id";
$resultado_nome_livro_mais_alugado = mysqli_query($conn, $query_nome_livro_mais_alugado);
$livro_mais_alugado_nome = '';
if ($resultado_nome_livro_mais_alugado) {
    $livro_mais_alugado_nome = mysqli_fetch_assoc($resultado_nome_livro_mais_alugado)['nome'];
}

// Quantidade de livros devolvidos
$query_devolvidos = "SELECT COUNT(*) AS total_devolvidos FROM devolvidos";
$resultado_devolvidos = mysqli_query($conn, $query_devolvidos);
$livros_devolvidos = mysqli_fetch_assoc($resultado_devolvidos)['total_devolvidos'];

// Exibir as informações no dashboard
echo "<br><div class='dashboard'>";
echo "<center><h2>Dashboard</h2><br>";

if (isset($livros_emprestados) && $livros_emprestados > 0) {
    echo "<div class='widget primary'>";
    echo "<p class='widget-title'>Quantidade de livros emprestados</p>";
    echo "<p class='widget-value'><strong>$livros_emprestados</strong></p>";
    echo "</div>";
} else {
    echo "<div class='widget'>";
    echo "<p class='widget-title'>Não há livros emprestados.</p>";
    echo "</div>";
}

if (isset($livros_atrasados) && $livros_atrasados > 0) {
    echo "<div class='widget warning'>";
    echo "<p class='widget-title'>Quantidade de livros atrasados</p>";
    echo "<p class='widget-value'><strong>$livros_atrasados</strong></p>";
    echo "</div>";
} else {
    echo "<div class='widget'>";
    echo "<p class='widget-title'>Não há livros atrasados.</p>";
    echo "</div>";
}

if (isset($livros_devolvidos_prazo) && $livros_devolvidos_prazo > 0) {
    echo "<div class='widget success'>";
    echo "<p class='widget-title'>Quantidade de livros devolvidos dentro do prazo</p>";
    echo "<p class='widget-value'><strong>$livros_devolvidos_prazo</strong></p>";
    echo "</div>";
} else {
    echo "<div class='widget'>";
    echo "<p class='widget-title'>Não há livros devolvidos no prazo</p>";
    echo "</div>";
}

if (isset($livros_devolvidos_fora_prazo) && $livros_devolvidos_fora_prazo > 0) {
    echo "<div class='widget error'>";
    echo "<p class='widget-title'>Quantidade de livros devolvidos fora do prazo</p>";
    echo "<p class='widget-value'><strong>$livros_devolvidos_fora_prazo</strong></p>";
    echo "</div>";
} else {
    echo "<div class='widget'>";
    echo "<p class='widget-title'>Não há livros devolvidos fora do prazo</p>";
    echo "</div>";
}

echo "<div class='widget'>";
echo "<h3 class='widget-subtitle'>Quantidade de aluguéis por usuário</h3>";
if (!empty($alugueis_por_usuario)) {
    foreach ($alugueis_por_usuario as $usuario_id => $total_alugueis) {
        echo "<p class='widget-item'>Usuário ID $usuario_id: <strong>$total_alugueis</strong> aluguéis</p>";
    }
} else {
    echo "<p class='widget-title'>Não há informações disponíveis.</p>";
}
echo "</div>";

echo "<div class='widget utilitary'>";
echo "<h3 class='widget-subtitle'>Livro mais alugado</h3>";
if (!empty($livro_mais_alugado_nome)) {
    echo "<p class='widget-value'><strong>$livro_mais_alugado_nome</strong></p>";
} else {
    echo "<p class='widget-title'>Não há informações disponíveis.</p>";
}
echo "</div>";

if (isset($livros_devolvidos) && $livros_devolvidos > 0) {
    echo "<div class='widget'>";
    echo "<h3 class='widget-title'>Quantidade de livros devolvidos</h3>";
    echo "<p class='widget-value'><strong>$livros_devolvidos</strong></p>";
    echo "</div>";
} else {
    echo "<div class='widget'>";
    echo "<p class='widget-title'>Não há livros devolvidos.</p>";
    echo "</div>";
}

echo "</center></div>";



