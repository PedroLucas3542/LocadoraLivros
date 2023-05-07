<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Se o usuário não estiver logado, redireciona para a página de login
    header('Location: login.php');
    exit();
}
?>

<?php 
	include_once 'conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Página para adição de Livros</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
	<div class="row">
		<div class="container col-sm-6">
			<div class="panel panel-default">
				<div class="panel-body"><br><br>
					<div class="panel-heading display-4 text-center">Adicionar Livros</div><br><br>
    					<form action="addlivro.php" method="post" accept-charset="utf-8" class="form-group">

    						<label for="nome">Nome:</label>
    						<input type="text" name="nome" class="form-control" required>
    						<br>
    						<label for="num">Autor:</label>
    						<input type="text" name="autor" class="form-control" required>
                            <br>
    						<label for="editora">Editora:</label>
        					<select name="editora" id="editora" required>
            				<option value="">Selecione a Editora</option>
							<?php
							// Realiza a conexão com o banco de dados
							include('conexao.php');

							// Busca as editoras cadastradas
							$query = "SELECT * FROM editoras";
							$resultado = mysqli_query($conn, $query);

							// Exibe as opções do select com base nas editoras encontradas
							while ($editora = mysqli_fetch_assoc($resultado)) {
								echo '<option value="' . $editora['nome'] . '">' . $editora['nome'] . '</option>';
							}
							?>
							</select><br><br>
                            <label for="endereco">Data de Lançamento:</label>
    						<input type="date" name="data_lancamento" class="form-control" required>
                            <br>
                            <label for="cpf">Quantidade em Estoque:</label>
    						<input type="text" name="estoque" class="form-control">

    						<br>
    						<input type="submit" name="btn" value="Cadastrar" class="btn btn-success">

   						</form>
				</div>
			</div>
		</div>			
	</div>
</body>
</html>