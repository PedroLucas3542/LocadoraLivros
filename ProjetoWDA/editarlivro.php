<!DOCTYPE html>
<html>
<head>
  <title>Edição de Livro</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <script>
    function verificarEstoque(form) {
      var estoqueAtual = parseInt(form.estoque_atual.value);
      var novoEstoque = parseInt(form.novo_estoque.value);
      
      if (novoEstoque <= estoqueAtual) {
        alert("O novo estoque precisa ser maior que o estoque atual.");
        return false;
      }
    }
  </script>
</head>
<body>
  <h2>Edição de Livro</h2>
  <form action="atualizar_estoque.php" method="post" onsubmit="return verificarEstoque(this);">
    <label for="estoque_atual">Estoque Atual:</label>
    <input type="number" id="estoque_atual" name="estoque_atual" readonly><br><br>

    <label for="novo_estoque">Novo Estoque:</label>
    <input type="number" id="novo_estoque" name="novo_estoque" required><br><br>

    <input type="hidden" name="livro_id" value="<?php echo $livro_id; ?>">
    <input type="submit" value="Atualizar Estoque">
  </form>
</body>
</html>


<?php
// Conexão com o banco de dados e outras configurações...

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $livro_id = $_POST['livro_id'];
    $novo_estoque = $_POST['novo_estoque'];

    // Consulta o livro pelo ID no banco de dados para obter o estoque atual
    $query = "SELECT estoque FROM livros WHERE id = $livro_id";
    $result = mysqli_query($conn, $query);
    $livro = mysqli_fetch_assoc($result);
    $estoque_atual = $livro['estoque'];

    if ($novo_estoque > $estoque_atual) {
        // Atualiza o estoque do livro no banco de dados
        $update_query = "UPDATE livros SET estoque = $novo_estoque WHERE id = $livro_id";
        mysqli_query($conn, $update_query);

        echo "Estoque atualizado com sucesso!";
    } else {
        echo "O novo estoque precisa ser maior que o estoque atual.";
    }
}

// Outras operações e fechamento da conexão com o banco de dados...
?>
