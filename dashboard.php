<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
include 'includes/config.php';
include 'includes/navbar.php'; // Incluído aqui para ser parte do layout Bootstrap
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Paguemais</title>
    <link href="bootstrap-5.3.6-dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php // A navbar já foi incluída acima, se você quiser que ela esteja dentro do container, mova o include.
          // Por enquanto, vamos manter ela fora do container principal. ?>

    <div class="container mt-4">
        <h1 class="mb-4">Bem-vindo, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h1>
        <p>Esta é a sua página inicial após o login. Use o menu de navegação para gerenciar os produtos e usuários.</p>

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Gerenciar Produtos</h5>
                        <p class="card-text">Adicione, visualize, edite ou exclua produtos do sistema.</p>
                        <a href="produtos/read.php" class="btn btn-primary">Ver Produtos</a>
                        <a href="produtos/create.php" class="btn btn-success">Adicionar Produto</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Gerenciar Usuários</h5>
                        <p class="card-text">Visualize, edite ou exclua usuários cadastrados.</p>
                        <a href="usuarios/read.php" class="btn btn-primary">Ver Usuários</a>
                        <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'): // Exemplo: se houver um sistema de roles ?>
                            <a href="usuarios/create.php" class="btn btn-success">Adicionar Usuário</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="bootstrap-5.3.6-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>