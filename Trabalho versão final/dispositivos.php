<?php
header('Content-Type: application/json');
require 'conexao.php';
$conn = conectarBanco();

if (!$conn) {
    echo json_encode(['error' => 'Erro ao conectar ao banco de dados']);
    exit;
}

$action = $_GET['action'] ?? '';

if ($action === 'fetch') {
    $result = pg_query($conn, "SELECT d.cd_dispositivo, d.nome, d.status, s.desc_setor AS setor, s.cd_setor
    FROM TB_DISPOSITIVO d
    LEFT JOIN TB_SETOR s ON d.cd_setor = s.cd_setor
    ORDER BY d.cd_dispositivo");
    if (!$result) {
        echo json_encode(['error' => pg_last_error($conn)]);
        exit;
    }
    $dispositivos = pg_fetch_all($result);
    echo json_encode($dispositivos ?: []);
} elseif ($action === 'fetch_setores') {
    $result = pg_query($conn, "SELECT cd_setor, desc_setor FROM TB_SETOR WHERE status = '1'");
    if (!$result) {
        echo json_encode(['error' => pg_last_error($conn)]);
        exit;
    }
    $setores = pg_fetch_all($result);
    echo json_encode($setores ?: []);
} elseif ($action === 'add') {
    $data = json_decode(file_get_contents("php://input"), true);
    $nome = $data['nome'];
    $setor = $data['setor'];
    $status = '1';
    $query = "INSERT INTO TB_DISPOSITIVO (nome, cd_setor, status) VALUES ($1, $2, $3)";
    $result = pg_query_params($conn, $query, [$nome, $setor, $status]);
    if (!$result) {
        echo json_encode(['error' => pg_last_error($conn)]);
        exit;
    }
    echo json_encode(['message' => 'Dispositivo adicionado com sucesso']);
} elseif ($action === 'edit') {
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data['id'];
    $nome = $data['nome'];
    $setor = $data['setor'];
    $query = "UPDATE TB_DISPOSITIVO SET nome = $1, cd_setor = $2 WHERE cd_dispositivo = $3";
    $result = pg_query_params($conn, $query, [$nome, $setor, $id]);
    if (!$result) {
        echo json_encode(['error' => pg_last_error($conn)]);
        exit;
    }
    echo json_encode(['message' => 'Dispositivo atualizado com sucesso']);
} elseif ($action === 'toggleStatus') {
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data['id'];
    $status = $data['status'];
    $query = "UPDATE TB_DISPOSITIVO SET status = $1 WHERE cd_dispositivo = $2";
    $result = pg_query_params($conn, $query, [$status, $id]);
    if (!$result) {
        echo json_encode(['error' => pg_last_error($conn)]);
        exit;
    }
    echo json_encode(['message' => 'Status atualizado com sucesso']);
}

pg_close($conn);
?>
