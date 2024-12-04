<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

// Atualiza a última requisição e calcula o tempo de sessão
$dataAtual = date("Y-m-d H:i:s");
$_SESSION['tempo_sessao'] = strtotime($dataAtual) - strtotime($_SESSION['inicio_sessao']);
$_SESSION['ultima_requisicao'] = $dataAtual;

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Bem-vindo, <?php echo $_SESSION['login']; ?>!</h1>

    <p><strong>Login:</strong> <?php echo $_SESSION['login']; ?></p>
    <p><strong>Senha:</strong> <?php echo $_SESSION['senha']; ?></p>
    <p><strong>Data/hora de início da sessão:</strong> <?php echo $_SESSION['inicio_sessao']; ?></p>
    <p><strong>Data/hora da última requisição:</strong> <?php echo $_SESSION['ultima_requisicao']; ?></p>
    <p><strong>Tempo de sessão (em segundos):</strong> <?php echo $_SESSION['tempo_sessao']; ?></p>

    <a href="logout.php">Sair</a>
</body>
</html>
