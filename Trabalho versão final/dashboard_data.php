<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

require 'conexao.php';
$conn = conectarBanco();

if (!$conn) {
    echo json_encode(['error' => 'Erro ao conectar ao banco de dados']);
    exit;
}

// Consultar métricas gerais
$metricsQuery = "
    SELECT 
        COALESCE(ROUND(AVG(CAST(resposta AS NUMERIC)), 1), 0) AS averageScore, 
        COUNT(resposta) AS totalResponses, 
        COUNT(feedback) AS feedbackCount 
    FROM TB_AVALIACAO 
    WHERE resposta ~ '^[0-9]+$';
";

$metricsResult = pg_query($conn, $metricsQuery);

if (!$metricsResult) {
    echo json_encode(['error' => 'Erro na consulta de métricas: ' . pg_last_error($conn)]);
    exit;
}

$metrics = pg_fetch_assoc($metricsResult);

// Consultar distribuição de notas
$distributionQuery = "
    SELECT 
        resposta AS score, 
        COUNT(*) AS count 
    FROM TB_AVALIACAO 
    WHERE resposta ~ '^[0-9]+$'
    GROUP BY resposta
    ORDER BY resposta
";

$distributionResult = pg_query($conn, $distributionQuery);

if (!$distributionResult) {
    echo json_encode(['error' => 'Erro na consulta de distribuição de notas: ' . pg_last_error($conn)]);
    exit;
}

$scoreDistribution = [];
while ($row = pg_fetch_assoc($distributionResult)) {
    $scoreDistribution[] = $row;
}

// Gerar arrays para o gráfico
$scoreLabels = array_column($scoreDistribution, 'score');
$scoreValues = array_column($scoreDistribution, 'count');

// Retornar resposta em JSON
echo json_encode([
    'metrics' => [
        'averageScore' => $metrics['averagescore'] ?? '0.00',
        'totalResponses' => $metrics['totalresponses'] ?? '0',
        'feedbackCount' => $metrics['feedbackcount'] ?? '0',
    ],
    'chartsData' => [
        'scoreLabels' => $scoreLabels,
        'scoreDistribution' => $scoreValues,
    ]
]);

pg_close($conn);
?>
