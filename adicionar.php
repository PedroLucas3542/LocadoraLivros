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

        @media (max-width: 767px) {
            .container {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <br><br><br><br>
    <div class="container">
        <a href="usuarios.php">
            <i class="fa fa-close" style="font-size:30px"></i>
        </a>
        <h2>Cadastro de Usuário</h2>
        <form action="add.php" method="post" accept-charset="utf-8" class="form-group" onsubmit="return validateForm()">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" class="form-control">
            <span class="error-message"></span><br><br>	
            
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control">
            <span class="error-message"></span><br><br>
            
            <label for="celular">Celular:</label>
            <input type="text" id="celular" name="celular" class="form-control">
            <span class="error-message"></span><br><br>
            
            <label for="endereco">Endereço:</label>
            <input type="text" name="endereco" class="form-control">
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
                var isValidCPF = false;
                
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
    
                // Verifica o CPF
                var cpfValue = cpfInput.value.replace(/[^\d]+/g,'');
                if (cpfValue.length === 11) {
                    var sum = 0;
                    var firstDigit = parseInt(cpfValue.charAt(9));
                    var secondDigit = parseInt(cpfValue.charAt(10));
                    
                    for (var i = 0; i < 9; i++) {
                        sum += parseInt(cpfValue.charAt(i)) * (10 - i);
                    }
                    
                    var firstDigitResult = sum % 11 < 2 ? 0 : 11 - (sum % 11);
                    
                    if (firstDigit === firstDigitResult) {
                        sum = 0;
                        for (var i = 0; i < 10; i++) {
                            sum += parseInt(cpfValue.charAt(i)) * (11 - i);
                        }
                        
                        var secondDigitResult = sum % 11 < 2 ? 0 : 11 - (sum % 11);
                        
                        if (secondDigit === secondDigitResult) {
                            isValidCPF = true;
                        }
                    }
                }
                
                if (hasEmptyFields || !isValidCPF) {
                    var alertElement = document.createElement('div');
                    alertElement.classList.add('alert');
                    alertElement.innerText = 'Por favor, preencha todos os campos obrigatórios e verifique o CPF.';
    
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
