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
    <title>Listar Produtos - Paguemais</title>
    <link href="../bootstrap-5.3.6-dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Produtos</h1>
        <a href="create.php" class="btn btn-success mb-3">Adicionar Novo Produto</a>

        <?php
        try {
            // Removido 'data_fabricacao' da seleção da consulta SQL
            $stmt = $pdo->query("SELECT id, nome, preco, quantidade FROM produtos");
            $produtos = $stmt->fetchAll();

            if ($produtos) {
                echo '<div class="table-responsive">';
                echo '<table class="table table-striped table-bordered table-hover">';
                echo '<thead class="table-dark">';
                echo '<tr>';
                echo '<th>ID</th>';
                echo '<th>Nome</th>';
                echo '<th>Preço</th>';
                echo '<th>Quantidade</th>';
                // Removido <th>Data de Fabricação</th>
                echo '<th>Ações</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                foreach ($produtos as $produto) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($produto['id']) . '</td>';
                    echo '<td>' . htmlspecialchars($produto['nome']) . '</td>';
                    echo '<td>R$ ' . htmlspecialchars(number_format($produto['preco'], 2, ',', '.')) . '</td>';
                    echo '<td>' . htmlspecialchars($produto['quantidade']) . '</td>';
                    // Removido <td><?php echo htmlspecialchars($produto['data_fabricacao']); ? ></td>
                    echo '<td>';
                    echo '<a href="update.php?id=' . htmlspecialchars($produto['id']) . '" class="btn btn-sm btn-warning me-2">Editar</a>';
                    echo '<a href="delete.php?id=' . htmlspecialchars($produto['id']) . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Tem certeza que deseja excluir este produto?\')">Excluir</a>';
                    echo '</td>';
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
                echo '</div>';
            } else {
                echo '<div class="alert alert-info" role="alert">Nenhum produto encontrado.</div>';
            }
        } catch (PDOException $e) {
            echo '<div class="alert alert-danger" role="alert">Erro ao buscar produtos: ' . $e->getMessage() . '</div>';
        }
        ?>
    </div>

    <script src="../bootstrap-5.3.6-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>