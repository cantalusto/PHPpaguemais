<?php
session_start();

// Redireciona para o dashboard se já estiver logado
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

// Inclua o arquivo de configuração do banco de dados
include 'includes/config.php'; 

$error = '';

// Verifica se a requisição é POST e se os campos email e password existem
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se as chaves 'email' e 'password' existem no array $_POST
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Prepara e executa a consulta para buscar o usuário
        $stmt = $pdo->prepare("SELECT id, nome, email, senha FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        // Verifica se o usuário existe e a senha está correta
        if ($user && password_verify($password, $user['senha'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nome'];
            $_SESSION['user_email'] = $user['email'];
            header("Location: dashboard.php"); // Redireciona para o dashboard
            exit();
        } else {
            $error = "Email ou senha incorretos.";
        }
    } else {
        // Se os campos não foram enviados, exibe um erro
        $error = "Por favor, preencha todos os campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paguemais - Login</title>
    <link href="bootstrap-5.3.6-dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilo para centralizar e estilizar o container de login */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f8f9fa; /* Cor de fundo suave do Bootstrap */
        }
        .login-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1); /* Sombra mais visível */
            width: 100%;
            max-width: 400px; /* Largura máxima do formulário de login */
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
    <div class="login-container">
        <h2 class="text-center mb-4">Login</h2>
        <?php if ($error): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        <form method="POST" action="login.php">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Entrar</button>
        </form>
        <p class="text-center mt-3">Não tem uma conta? <a href="usuarios/create.php">Cadastre-se</a></p>
    </div>

    <script src="bootstrap-5.3.6-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>