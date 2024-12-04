<?php
session_start();

// Verifica se o cookie "usuario" e "inicio_sessao" existem
if (!isset($_COOKIE['usuario']) || !isset($_COOKIE['inicio_sessao'])) {
    echo "<script>alert('Os dados da sessão foram perdidos.');</script>";
    echo '<a href="login.php">Voltar para o login</a>';
    exit();
}

// Se os cookies existem, exibe as informações
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Bem-vindo, <?php echo $_COOKIE['usuario']; ?>!</h1>

    <p><strong>Login:</strong> <?php echo $_COOKIE['usuario']; ?></p>
    <p><strong>Data/hora de início da sessão:</strong> <?php echo $_COOKIE['inicio_sessao']; ?></p>
    
    <a href="logout.php">Sair</a>
</body>
</html>
