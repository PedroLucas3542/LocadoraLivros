<?php

include 'conexao.php';

// Consulta SQL para buscar os livros
$livros_query = "SELECT id, nome FROM livros";
$livros_result = mysqli_query($conn, $livros_query);

// Consulta SQL para buscar os usuários
$usuarios_query = "SELECT id, nome FROM usuarios";
$usuarios_result = mysqli_query($conn, $usuarios_query);

// Consulta SQL para buscar os prazos
$prazos_query = "SELECT id, dias FROM prazos";
$prazos_result = mysqli_query($conn, $prazos_query);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Empréstimo</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        /* Estilos CSS restantes ... */
    </style>
</head>
<body>
    <!-- Resto do conteúdo HTML ... -->

    <div class="loan-container">
        <h2>Empréstimo</h2>
        <form id="loan-form" action="realizar_emprestimo.php" method="POST">
            <label for="livro">Livro:</label>
            <select id="livro" name="livro">
                <?php while ($livro = mysqli_fetch_assoc($livros_result)) : ?>
                    <option value="<?php echo $livro['id']; ?>"><?php echo $livro['nome']; ?></option>
                <?php endwhile; ?>
            </select>
            <br><br>
            <label for="usuario">Usuário:</label>
            <select id="usuario" name="usuario">
                <?php while ($usuario = mysqli_fetch_assoc($usuarios_result)) : ?>
                    <option value="<?php echo $usuario['id']; ?>"><?php echo $usuario['nome']; ?></option>
                <?php endwhile; ?>
            </select>
            <br><br>
            <label for="prazo">Prazo:</label>
			<input type="date" id="prazo" name="prazo" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime('+30 days')); ?>">
            <br><br>
            <input type="submit" value="Realizar Empréstimo">
        </form>
    </div>

    <?php
    // Fechar as consultas e a conexão com o banco de dados
    mysqli_free_result($livros_result);
    mysqli_free_result($usuarios_result);
    @mysqli_free_result($prazos_result);
    mysqli_close($conn);
    ?>
</body>
</html>