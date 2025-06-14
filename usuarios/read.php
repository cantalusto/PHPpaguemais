<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}
include '../includes/config.php';
include '../includes/navbar.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Usuários - Paguemais</title>
    <link href="../bootstrap-5.3.6-dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Usuários</h1>
        <a href="create.php" class="btn btn-success mb-3">Adicionar Novo Usuário</a>

        <?php
        try {
            $stmt = $pdo->query("SELECT id, nome, email FROM usuarios");
            $usuarios = $stmt->fetchAll();

            if ($usuarios) {
                echo '<div class="table-responsive">';
                echo '<table class="table table-striped table-bordered table-hover">';
                echo '<thead class="table-dark">';
                echo '<tr>';
                echo '<th>ID</th>';
                echo '<th>Nome</th>';
                echo '<th>Email</th>';
                echo '<th>Ações</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                foreach ($usuarios as $usuario) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($usuario['id']) . '</td>';
                    echo '<td>' . htmlspecialchars($usuario['nome']) . '</td>';
                    echo '<td>' . htmlspecialchars($usuario['email']) . '</td>';
                    echo '<td>';
                    echo '<a href="update.php?id=' . htmlspecialchars($usuario['id']) . '" class="btn btn-sm btn-warning me-2">Editar</a>';
                    echo '<a href="delete.php?id=' . htmlspecialchars($usuario['id']) . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Tem certeza que deseja excluir este usuário?\')">Excluir</a>';
                    echo '</td>';
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
                echo '</div>';
            } else {
                echo '<div class="alert alert-info" role="alert">Nenhum usuário encontrado.</div>';
            }
        } catch (PDOException $e) {
            echo '<div class="alert alert-danger" role="alert">Erro ao buscar usuários: ' . $e->getMessage() . '</div>';
        }
        ?>
    </div>

    <script src="../bootstrap-5.3.6-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>