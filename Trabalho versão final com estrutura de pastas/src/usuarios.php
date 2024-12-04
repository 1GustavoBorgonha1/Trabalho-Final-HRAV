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
    $result = pg_query($conn, "SELECT cd_usuario, usuario, status FROM TB_USUARIO");
    if (!$result) {
        echo json_encode(['error' => pg_last_error($conn)]);
        exit;
    }
    $usuarios = pg_fetch_all($result);
    echo json_encode($usuarios ?: []);
} elseif ($action === 'add') {
    $data = json_decode(file_get_contents("php://input"), true);
    $usuario = $data['usuario'];
    $senha = $data['senha'];
    $status = '1';
    $query = "INSERT INTO TB_USUARIO (usuario, senha, status) VALUES ($1, $2, $3)";
    $result = pg_query_params($conn, $query, [$usuario, $senha, $status]);
    if (!$result) {
        echo json_encode(['error' => pg_last_error($conn)]);
        exit;
    }
    echo json_encode(['message' => 'Usuário adicionado com sucesso']);
} elseif ($action === 'edit') {
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data['id'];
    $usuario = $data['usuario'];
    $senha = $data['senha'];
    $query = "UPDATE TB_USUARIO SET usuario = $1, senha = $2 WHERE cd_usuario = $3";
    $result = pg_query_params($conn, $query, [$usuario, $senha, $id]);
    if (!$result) {
        echo json_encode(['error' => pg_last_error($conn)]);
        exit;
    }
    echo json_encode(['message' => 'Usuário atualizado com sucesso']);
} elseif ($action === 'toggleStatus') {
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data['id'];
    $status = $data['status'];
    $query = "UPDATE TB_USUARIO SET status = $1 WHERE cd_usuario = $2";
    $result = pg_query_params($conn, $query, [$status, $id]);
    if (!$result) {
        echo json_encode(['error' => pg_last_error($conn)]);
        exit;
    }
    echo json_encode(['message' => 'Status atualizado com sucesso']);
}

pg_close($conn);
