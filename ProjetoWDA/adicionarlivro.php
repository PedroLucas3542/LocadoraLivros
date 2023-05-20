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
	<br><br><br><br>
<div class="container">
<form action="addlivro.php" method="post" accept-charset="utf-8" class="form-group" onsubmit="return validateForm()">

    <label for="nome">Nome:</label>
    <input type="text" name="nome" id="nome" class="form-control" >
    <div id="nomeError" class="error-message"></div>
    <br>
    <label for="num">Autor:</label>
    <input type="text" name="autor" id="autor" class="form-control" >
    <div id="autorError" class="error-message"></div>
    <br>
    <label for="editora">Editora:</label>
    <select name="editora" id="editora" class="form-control" >
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
    </select>
    <div id="editoraError" class="error-message"></div>
    <br><br>
    <label for="data_lancamento">Data de Lançamento:</label>
    <input type="date" name="data_lancamento" id="data_lancamento" class="form-control">
    <div id="dataLancamentoError" class="error-message"></div>
    <br>
    <label for="estoque">Quantidade em Estoque:</label>
    <input type="text" name="estoque" id="estoque" class="form-control">
    <div id="estoqueError" class="error-message"></div>
    <br>
    <input type="submit" name="btn" value="Cadastrar" class="btn btn-success">
</form>
</div>
<script>
    function validateForm() {
        var nome = document.getElementById('nome').value;
        var autor = document.getElementById('autor').value;
        var editora = document.getElementById('editora').value;
        var dataLancamento = document.getElementById('data_lancamento').value;

        var isValid = true;

        if (nome === '') {
            document.getElementById('nomeError').innerHTML = 'O campo Nome é obrigatório.';
            isValid = false;
        }
        if (autor === '') {
            document.getElementById('autorError').innerHTML = 'O campo Autor é obrigatório.';
            isValid = false;
        }
        if (editora === '') {
            document.getElementById('editoraError').innerHTML = 'O campo Editora é obrigatório.';
            isValid = false;
        }
        if (dataLancamento === '') {
            document.getElementById('dataLancamentoError').innerHTML = 'O campo Data de Lançamento é obrigatório.';
            isValid = false;
        }

        return isValid;
    }
</script>
