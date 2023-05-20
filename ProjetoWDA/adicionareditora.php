<!DOCTYPE html>
<html>
<head>
    <title>Formulário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border-radius: 4px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        .form-control.invalid {
            border-color: #ff0000;
        }

        .btn {
            padding: 10px 20px;
            font-size: 14px;
            border-radius: 4px;
            background-color: #4CAF50;
            color: #ffffff;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #45a049;
        }

        .alert {
            padding: 10px;
            background-color: #f44336;
            color: #ffffff;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .error-message {
            color: #ff0000;
            font-size: 12px;
        }
    </style>
</head>
<body><br><br><br><br>
    <div class="container">
		<center><h2>Cadastro de Editora</h2></center>
        <form action="addeditora.php" method="post" accept-charset="utf-8" class="form-group" onsubmit="return validateForm()">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" class="form-control">
            <span class="error-message"></span><br><br>
            
            <label for="email">Email:</label>
            <input type="text" name="email" class="form-control">
            <span class="error-message"></span><br><br>
            
            <label for="telefone">Telefone:</label>
            <input type="text" name="telefone" class="form-control">
            <span class="error-message"></span><br><br>
            
            <label for="site">Site:</label>
            <input type="text" name="site" class="form-control">
            <span class="error-message"></span><br><br>
            
            <input type="submit" name="btn" value="Cadastrar" class="btn">
        </form>
        
        <script>
            function validateForm() {
                var nomeInput = document.getElementsByName('nome')[0];
                var emailInput = document.getElementsByName('email')[0];
                var telefoneInput = document.getElementsByName('telefone')[0];
                var siteInput = document.getElementsByName('site')[0];
                var hasEmptyFields = false;
                
                var inputs = [nomeInput, emailInput, telefoneInput, siteInput];
                for (var i = 0; i < inputs.length; i++) {
                    if (inputs[i].value.trim() === '') {
                        inputs[i].classList.add('invalid');
                        inputs[i].nextElementSibling.innerText = 'Este campo é obrigatório.';
                        hasEmptyFields = true;
                    } else {
                        inputs[i].classList.remove('invalid');
                        inputs[i].nextElementSibling.innerText = '';
                    }
                }
    
                if (hasEmptyFields) {
                    var alertElement = document.createElement('div');
                    alertElement.classList.add('alert');
                    alertElement.innerText = 'Por favor, preencha todos os campos obrigatórios.';
    
                    var container = document.querySelector('.container');
                    container.insertBefore(alertElement, container.firstChild);
    
                    return false;
                }
    
                return true;
            }
        </script>
    </div>
</body>
</html>
