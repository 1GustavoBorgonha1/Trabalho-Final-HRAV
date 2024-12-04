<?php
// Etapa 1 - Tentar iniciar uma sessão e validar se ela já está estabelecida
session_start();

/* Caso não exista o dado "usuario" na global $_SESSION então vamos criar */
if (!isset($_SESSION['usuario'])) {
    /* Caso tenha sido enviado do cliente pelo método POST o identificador do usuário */
    $_SESSION['usuario'] = 'user_name';

    echo "Sessão iniciada e usuário registrado.";
    echo '<a href="02_session_continua.php">Clique aqui para continuar</a>';
} else {
    echo "O seu identificador de sessão é: " . session_id() . "<br>";
    echo '<a href="02_session_continua.php">Acessar</a>';
}
?>
