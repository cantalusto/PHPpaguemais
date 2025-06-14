<?php
require_once '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];

    $stmt = $pdo->prepare("INSERT INTO produtos (nome, preco, quantidade) VALUES (?, ?, ?)");
    $stmt->execute([$nome, $preco, $quantidade]);
    header("Location: read.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Adicionar Produto</title>
  <link href="../css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h3>Adicionar Produto</h3>
  <form method="post">
    <div class="mb-3">
      <label>Nome</label>
      <input type="text" name="nome" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Preço</label>
      <input type="number" name="preco" class="form-control" step="0.01" required>
    </div>
    <div class="mb-3">
      <label>Quantidade</label>
      <input type="number" name="quantidade" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Salvar</button>
    <a href="read.php" class="btn btn-secondary">Cancelar</a>
  </form>
</div>
</body>
</html>
