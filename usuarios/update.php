<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}
include '../includes/config.php';
include '../includes/navbar.php';

$usuario = null;
$error = '';
$success = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $stmt = $pdo->prepare("SELECT id, nome, email FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        $usuario = $stmt->fetch();

        if (!$usuario) {
            $error = "Usuário não encontrado.";
        }
    } catch (PDOException $e) {
        $error = "Erro ao buscar usuário: " . $e->getMessage();
    }
} else {
    $error = "ID do usuário não fornecido.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $usuario) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Pode ser vazio se a senha não for alterada

    try {
        if (!empty($password)) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE usuarios SET nome = ?, email = ?, senha = ? WHERE id = ?");
            $stmt->execute([$nome, $email, $hashed_password, $id]);
        } else {
            $stmt = $pdo->prepare("UPDATE usuarios SET nome = ?, email = ? WHERE id = ?");
            $stmt->execute([$nome, $email, $id]);
        }
        $success = "Usuário atualizado com sucesso!";
        // Atualiza os dados do usuário para refletir as alterações no formulário
        $usuario['nome'] = $nome;
        $usuario['email'] = $email;
    } catch (PDOException $e) {
        $error = "Erro ao atualizar usuário: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário - Paguemais</title>
    <link href="../bootstrap-5.3.6-dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Editar Usuário</h1>
        <a href="read.php" class="btn btn-secondary mb-3">Voltar para a Lista de Usuários</a>

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

        <?php if ($usuario): ?>
            <form method="POST" action="update.php">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($usuario['id']); ?>">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Nova Senha (deixe em branco para não alterar)</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            </form>
        <?php endif; ?>
    </div>

    <script src="../bootstrap-5.3.6-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>