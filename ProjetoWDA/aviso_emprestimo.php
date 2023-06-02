<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Aviso - Usuário com Empréstimo</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
            background-color: #ffffff;
            border-radius: 5px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        h1 {
            color: #333333;
            margin-bottom: 20px;
        }

        p {
            color: #666666;
            margin-bottom: 30px;
        }

        .button {
            display: inline-block;
            background-color: #3498db;
            color: #ffffff;
            text-align: center;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Aviso - Usuário com Empréstimo</h1>
        <p>O usuário possui empréstimos e não pode ser excluído.</p>
        <a href="usuarios.php" class="button">Voltar à Tela de Usuários</a>
    </div>
</body>
</html>
