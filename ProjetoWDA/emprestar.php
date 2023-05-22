<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Empréstimo</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .loan-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .loan-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .loan-container label {
            font-weight: bold;
        }

        .loan-container select,
        .loan-container input[type="date"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        .loan-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .loan-container input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
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
        <br><br><br><br>
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
