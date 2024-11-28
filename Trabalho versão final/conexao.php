<?php
// Arquivo de conexão com o PostgreSQL

function conectarBanco() {
    $host = "localhost";
    $port = "5432";
    $dbname = "hospital";
    $user = "postgres";
    $password = "123456";

    // Conectar ao PostgreSQL
    $conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

    // Verificar se a conexão foi bem-sucedida
    if (!$conn) {
        die("Erro ao conectar ao banco de dados: " . pg_last_error());
    }

    return $conn;
}
?>
