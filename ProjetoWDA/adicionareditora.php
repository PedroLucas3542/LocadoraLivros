<?php 
	include_once 'conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <br><br>
	<title>Cadastro de Editoras</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
	<div class="row">
		<div class="container col-sm-6">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="panel-heading display-4 text-center">Cadastro de Editoras</div><br><br>
    					<form action="addeditora.php" method="post" accept-charset="utf-8" class="form-group">

    						<label for="nome">Nome:</label>
    						<input type="text" name="nome" class="form-control" required>
    						<br>
    						<label for="email">Email:</label>
    						<input type="text" name="email" class="form-control" required>
                            <br>
    						<label for="telefone">Telefone:</label>
    						<input type="text" name="telefone" class="form-control" required>
                            <br>
                            <label for="site">Site:</label>
    						<input type="text" name="site" class="form-control" required>
                            <br>

    						<br>
    						<input type="submit" name="btn" value="Cadastrar" class="btn btn-success">
   						</form>
				</div>
			</div>
		</div>			
	</div>
</body>
</html>