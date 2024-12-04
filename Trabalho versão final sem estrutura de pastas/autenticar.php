<?php
session_start();
require 'conexao.php'; // Inclui a função de conexão

// Conecta ao banco de dados
$conn = conectarBanco();

// Recebe os dados do formulário de login
$usuario = $_POST['username'];
$senha = $_POST['password'];

// Consulta para verificar o login usando pg_query_params
$query = "SELECT * FROM TB_USUARIO WHERE USUARIO = $1 AND SENHA = $2 AND STATUS = '1'";
$result = pg_query_params($conn, $query, [$usuario, $senha]);

if ($result && pg_num_rows($result) > 0) {
    // Login bem-sucedido - redireciona para o menu
    header("Location: menu.html");
    exit;
} else {
    // Falha no login - redireciona com o parâmetro de erro
    header("Location: login.html?erro=1");
    exit;
}

// Fecha a conexão com o banco de dados
pg_close($conn);
?>
