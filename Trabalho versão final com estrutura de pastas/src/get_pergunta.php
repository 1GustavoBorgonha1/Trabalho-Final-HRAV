<?php
header('Content-Type: application/json');
require 'conexao.php';

$conn = conectarBanco();

$query = "SELECT cd_pergunta, desc_pergunta FROM tb_pergunta WHERE status = 1";
$result = pg_query($conn, $query);

if (!$result) {
    echo json_encode(['error' => 'Erro ao buscar perguntas: ' . pg_last_error($conn)]);
    exit;
}

$perguntas = [];
while ($row = pg_fetch_assoc($result)) {
    $perguntas[] = $row;
}

echo json_encode(['perguntas' => $perguntas]);
pg_close($conn);
