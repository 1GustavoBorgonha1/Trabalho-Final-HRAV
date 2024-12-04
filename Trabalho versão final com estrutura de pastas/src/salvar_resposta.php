<?php
header('Content-Type: application/json');
ini_set('display_errors', 0);
error_reporting(0);

require 'conexao.php';
$conn = conectarBanco();

$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !isset($data['pergunta_id']) || !isset($data['resposta']) || !isset($data['cd_dispositivo']) || !isset($data['cd_setor'])) {
    echo json_encode(['error' => 'Dados obrigatórios ausentes.']);
    exit;
}

$pergunta_id = (int)$data['pergunta_id'];
$resposta = (int)$data['resposta'];
$feedback = $data['feedback'] ?? '';
$cd_dispositivo = (int)$data['cd_dispositivo'];
$cd_setor = (int)$data['cd_setor'];

$query = "INSERT INTO TB_AVALIACAO (cd_pergunta, cd_dispositivo, resposta, feedback, cd_setor, data_res) VALUES ($1, $2, $3, $4, $5, NOW())";
$result = pg_query_params($conn, $query, [$pergunta_id, $cd_dispositivo, $resposta, $feedback, $cd_setor]);

if (!$result) {
    echo json_encode(['error' => 'Erro ao salvar a resposta: ' . pg_last_error($conn)]);
    exit;
}

echo json_encode(['message' => 'Resposta salva com sucesso']);
pg_close($conn);
?>
