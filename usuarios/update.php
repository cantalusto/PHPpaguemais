<?php
require_once '../includes/config.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->execute([$id]);
$usuario = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    $stmt = $pdo->prepare("UPDATE usuarios SET nome = ?, email = ? WHERE id = ?");
    $stmt->execute([$nome, $email, $id]);

    if (!empty($_POST['senha'])) {
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE usuarios SET senha = ? WHERE id = ?");
        $stmt->execute([$senha, $id]);
    }

    header("Location: read.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Editar Usuário</title>
  <link href="../css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h3>Editar Usuário</h3>
  <form method="post">
    <div class="mb-3">
      <label>Nome</label>
      <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($usuario['nome']) ?>" required>
    </div>
    <div class="mb-3">
      <label>Email</label>
      <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($usuario['email']) ?>" required>
    </div>
    <div class="mb-3">
      <label>Nova Senha (opcional)</label>
      <input type="password" name="senha" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Atualizar</button>
    <a href="read.php" class="btn btn-secondary">Cancelar</a>
  </form>
</div>
</body>
</html>
