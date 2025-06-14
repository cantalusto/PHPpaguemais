<?php
session_start();
// Opcional: Se quiser que apenas administradores criem usuários, descomente as linhas abaixo
// if (!isset($_SESSION['user_id']) || (isset($_SESSION['user_role']) && $_SESSION['user_role'] != 'admin')) {
//     header("Location: ../index.php");
//     exit();
// }
include '../includes/config.php';
// A navbar pode ser incluída se esta página for acessível após o login e você quiser o menu.
// Se for para cadastro inicial, sem login, não precisa da navbar.
// include '../includes/navbar.php'; 

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se as chaves 'nome', 'email' e 'password' existem no array $_POST
    if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['password'])) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Criptografa a senha

        try {
            $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
            $stmt->execute([$nome, $email, $password]);
            $success = "Usuário cadastrado com sucesso!";
            // Opcional: Redirecionar para a página de login ou para a lista de usuários
            // header("Location: ../login.php"); // Redireciona para o login
            // exit();
        } catch (PDOException $e) {
            $error = "Erro ao cadastrar usuário: " . $e->getMessage();
        }
    } else {
        $error = "Por favor, preencha todos os campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuário - Paguemais</title>
    <link href="../bootstrap-5.3.6-dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f8f9fa; /* Cor de fundo suave */
        }
        .register-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px; /* Largura máxima do formulário de cadastro */
            animation: fadeIn 1s ease-in-out; /* Adiciona uma animação de fade-in */
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .btn-primary {
            background-color: #007bff; /* Cor primária do Bootstrap */
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3; /* Escurece no hover */
            border-color: #004085;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h1 class="text-center mb-4">Cadastrar Novo Usuário</h1>
        <a href="../login.php" class="btn btn-secondary mb-3">Voltar para o Login</a>

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

        <form method="POST" action="create.php">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome Completo</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
        </form>
    </div>

    <script src="../bootstrap-5.3.6-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>