<?php
session_start();

// Pegando dados do formulário
$login = $_POST['login'];
$senha = $_POST['senha'];

// Autenticando (aqui é um exemplo simples, mas normalmente validaria contra um banco de dados)
if ($login === "usuario" && $senha === "senha123") {
    // Armazenando informações na sessão
    $_SESSION['login'] = $login;
    $_SESSION['senha'] = $senha;
    $_SESSION['inicio_sessao'] = date("Y-m-d H:i:s");
    $_SESSION['ultima_requisicao'] = $_SESSION['inicio_sessao'];
    $_SESSION['tempo_sessao'] = 0; // Em segundos, inicialmente 0

    header("Location: dashboard.php"); // Redireciona para o painel
} else {
    echo "Login ou senha incorretos.";
    echo '<a href="login.php">Tentar novamente</a>';
}
?>
