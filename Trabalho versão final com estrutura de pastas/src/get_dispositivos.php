<?php
header('Content-Type: application/json');
require 'conexao.php';

$conn = conectarBanco();

// Modificação no SQL: compara `status` como string
$query = "SELECT cd_dispositivo, nome, cd_setor FROM tb_dispositivo WHERE status = '1'";
$result = pg_query($conn, $query);

if (!$result) {
    echo json_encode(['error' => 'Erro ao carregar dispositivos: ' . pg_last_error($conn)]);
    exit;
}

$dispositivos = [];
while ($row = pg_fetch_assoc($result)) {
    $dispositivos[] = $row;
}

echo json_encode(['dispositivos' => $dispositivos]);
pg_close($conn);
?>
