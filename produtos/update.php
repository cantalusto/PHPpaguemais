<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}
include '../includes/config.php';
include '../includes/navbar.php';

$produto = null;
$error = '';
$success = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $stmt = $pdo->prepare("SELECT id, nome, preco, quantidade, data_fabricacao FROM produtos WHERE id = ?");
        $stmt->execute([$id]);
        $produto = $stmt->fetch();

        if (!$produto) {
            $error = "Produto não encontrado.";
        }
    } catch (PDOException $e) {
        $error = "Erro ao buscar produto: " . $e->getMessage();
    }
} else {
    $error = "ID do produto não fornecido.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $produto) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];
    $data_fabricacao = $_POST['data_fabricacao'];

    try {
        $stmt = $pdo->prepare("UPDATE produtos SET nome = ?, preco = ?, quantidade = ?, data_fabricacao = ? WHERE id = ?");
        $stmt->execute([$nome, $preco, $quantidade, $data_fabricacao, $id]);
        $success = "Produto atualizado com sucesso!";
        // Atualiza os dados do produto para refletir as alterações no formulário
        $produto['nome'] = $nome;
        $produto['preco'] = $preco;
        $produto['quantidade'] = $quantidade;
        $produto['data_fabricacao'] = $data_fabricacao;
    } catch (PDOException $e) {
        $error = "Erro ao atualizar produto: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto - Paguemais</title>
    <link href="../bootstrap-5.3.6-dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Editar Produto</h1>
        <a href="read.php" class="btn btn-secondary mb-3">Voltar para a Lista de Produtos</a>

        <?php if ($success): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <?php if ($produto): ?>
            <form method="POST" action="update.php">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($produto['id']); ?>">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome do Produto</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($produto['nome']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="preco" class="form-label">Preço</label>
                    <input type="number" step="0.01" class="form-control" id="preco" name="preco" value="<?php echo htmlspecialchars($produto['preco']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="quantidade" class="form-label">Quantidade</label>
                    <input type="number" class="form-control" id="quantidade" name="quantidade" value="<?php echo htmlspecialchars($produto['quantidade']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="data_fabricacao" class="form-label">Data de Fabricação</label>
                    <input type="date" class="form-control" id="data_fabricacao" name="data_fabricacao" value="<?php echo htmlspecialchars($produto['data_fabricacao']); ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            </form>
        <?php endif; ?>
    </div>

    <script src="../bootstrap-5.3.6-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>