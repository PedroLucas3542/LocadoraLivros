<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        
        .login-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .login-container label {
            display: block;
            margin-bottom: 8px;
        }
        
        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 10px;
            border-radius: 3px;
            border: 1px solid #ccc;
        }
        
        .login-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        
        .login-container input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <br><br><br><br><br><br>
    <div class="login-container">
        <h2>Login</h2>
        <form action="autenticar.php" method="POST">
            <label for="username">Usuário:</label>
            <input type="text" id="username" name="username" required>
            <br><br>
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required>
            <br><br>
            <input type="submit" value="Entrar">
        </form>
    </div>
</body>
</html>
