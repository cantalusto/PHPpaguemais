<?php
session_start();

// Inclua o arquivo de configuração do banco de dados, se necessário para outras verificações futuras
include 'includes/config.php'; 

// Verifica se o usuário já está logado
if (isset($_SESSION['user_id'])) {
    // Se estiver logado, redireciona para o dashboard
    header("Location: dashboard.php");
    exit();
} else {
    // Se não estiver logado, redireciona para a página de login
    header("Location: login.php");
    exit();
}
?>