<!DOCTYPE html>
<html>
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
            background-color: #4169E1;
            color: #ffffff;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0F52BA;
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

        .fa{
            float: right;
            color: #007bff;
        }
    </style>
</head>
<body><br><br><br><br>
    <div class="container">
    <a href="usuarios.php">
    <i class="fa fa-close" style="font-size:30px"></i>
    </a>
		<h2>Cadastro de Usuário</h2>
        <form action="add.php" method="post" accept-charset="utf-8" class="form-group" onsubmit="return validateForm()">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" class="form-control" >
            <span class="error-message"></span><br><br>	
            
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" >
            <span class="error-message"></span><br><br>
            
            <label for="celular">Celular:</label>
            <input type="text" id="celular" name="celular" class="form-control" >
            <span class="error-message"></span><br><br>
            
            <label for="endereco">Endereço:</label>
            <input type="text" name="endereco" class="form-control" >
            <span class="error-message"></span><br><br>
            
            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" class="form-control">
            <span class="error-message"></span><br><br>
            
            <input type="submit" name="btn" value="Cadastrar" class="btn">
            <script>
            $(document).ready(function() {
                    $('#cpf').mask('000.000.000-00');
                });
            </script>
            <script>
            $(document).ready(function() {
                    $('#celular').mask('(00) 00000-0000');
                });
            </script>
        </form>
        
        <script>
            function validateForm() {
                var nomeInput = document.getElementsByName('nome')[0];
                var emailInput = document.getElementsByName('email')[0];
                var celularInput = document.getElementsByName('celular')[0];
                var enderecoInput = document.getElementsByName('endereco')[0];
                var cpfInput = document.getElementsByName('cpf')[0];
                var hasEmptyFields = false;
                
                var inputs = [nomeInput, emailInput, celularInput, enderecoInput, cpfInput];
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
    
            function formatar(mascara, documento) {
                var i = documento.value.length;
                var saida = '#';
                var texto = mascara.substring(i);
                while (texto.substring(0, 1) != saida && texto.length) {
                    documento.value += texto.substring(0, 1);
                    i++;
                    texto = mascara.substring(i);
                }
            }
        </script>
    </div>
</body>
</html>
