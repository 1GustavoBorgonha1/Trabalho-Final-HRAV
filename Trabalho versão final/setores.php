<?php
require 'conexao.php';
$conn = conectarBanco();

$action = $_GET['action'] ?? '';

if ($action === 'fetch') {
    $result = pg_query($conn, "SELECT * FROM tb_setor");
    $setores = pg_fetch_all($result);
    echo json_encode($setores);
}
elseif ($action === 'add') {
    $data = json_decode(file_get_contents("php://input"), true);
    $descricao = $data['descricao'];
    $status = '1';
    pg_query_params($conn, "INSERT INTO tb_setor (desc_setor, status) VALUES ($1, $2)", [$descricao, $status]);
    echo json_encode(['message' => 'Setor adicionado com sucesso']);
}
elseif ($action === 'edit') {
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data['id'];
    $descricao = $data['descricao'];
    pg_query_params($conn, "UPDATE tb_setor SET desc_setor = $1 WHERE cd_setor = $2", [$descricao, $id]);
    echo json_encode(['message' => 'Setor atualizado com sucesso']);
}
elseif ($action === 'toggleStatus') {
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data['id'];
    $status = $data['status'];
    pg_query_params($conn, "UPDATE tb_setor SET status = $1 WHERE cd_setor = $2", [$status, $id]);
    echo json_encode(['message' => 'Status atualizado com sucesso']);
}

pg_close($conn);
?>
