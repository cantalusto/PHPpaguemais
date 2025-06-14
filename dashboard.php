<?php
session_start();

// Verifique se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - Pague Mais</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .container {
      margin-top: 100px;
    }
  </style>
</head>
<body>
<div class="container text-center">
  <h2 class="mb-4">Bem-vindo, <?= htmlspecialchars($_SESSION['usuario']) ?>!</h2>

  <div class="row justify-content-center mb-3">
    <div class="col-md-4">
      <a href="usuarios/read.php" class="btn btn-primary w-100 p-3">Gerenciar Usuários</a>
    </div>
    <div class="col-md-4">
      <a href="produtos/read.php" class="btn btn-success w-100 p-3">Gerenciar Produtos</a>
    </div>
  </div>

  <a href="logout.php" class="btn btn-danger">Sair</a>
</div>
</body>
</html>
