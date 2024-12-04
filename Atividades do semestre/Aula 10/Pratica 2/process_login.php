<?php
session_start();

// Pegando dados do formulário
$login = $_POST['login'];
$senha = $_POST['senha'];

// Autenticando (exemplo simples; normalmente validaria contra um banco de dados)
if ($login === "usuario" && $senha === "senha123") {
    // Armazenando informações na sessão
    $_SESSION['login'] = $login;
    $_SESSION['senha'] = $senha;
    $_SESSION['inicio_sessao'] = date("Y-m-d H:i:s");
    $_SESSION['ultima_requisicao'] = $_SESSION['inicio_sessao'];
    $_SESSION['tempo_sessao'] = 0; // Em segundos, inicialmente 0

    // Definindo cookies para o usuário e a data/hora de início da sessão
    setcookie("usuario", $login, time() + (60 * 5), "/");
    setcookie("inicio_sessao", $_SESSION['inicio_sessao'], time() + (60 * 5), "/");

    header("Location: dashboard.php"); // Redireciona para o painel
} else {
    echo "Login ou senha incorretos.";
    echo '<a href="login.php">Tentar novamente</a>';
}
?>
