<?php
require_once '../includes/config.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = ?");
$stmt->execute([$id]);
$produto = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];

    $stmt = $pdo->prepare("UPDATE produtos SET nome = ?, preco = ?, quantidade = ? WHERE id = ?");
    $stmt->execute([$nome, $preco, $quantidade, $id]);
    header("Location: read.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Editar Produto</title>
  <link href="../css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h3>Editar Produto</h3>
  <form method="post">
    <div class="mb-3">
      <label>Nome</label>
      <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($produto['nome']) ?>" required>
    </div>
    <div class="mb-3">
      <label>Preço</label>
      <input type="number" name="preco" class="form-control" value="<?= htmlspecialchars($produto['preco']) ?>" step="0.01" required>
    </div>
    <div class="mb-3">
      <label>Quantidade</label>
      <input type="number" name="quantidade" class="form-control" value="<?= htmlspecialchars($produto['quantidade']) ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Atualizar</button>
    <a href="read.php" class="btn btn-secondary">Cancelar</a>
  </form>
</div>
</body>
</html>
