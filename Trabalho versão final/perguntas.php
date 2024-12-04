    <?php
    header('Content-Type: application/json'); // Define que o retorno será JSON
    ini_set('display_errors', 1); // Exibe erros para debug
    error_reporting(E_ALL); // Relata todos os erros

    require 'conexao.php';
    $conn = conectarBanco();

    $action = $_GET['action'] ?? 'fetch'; // Ação padrão é "fetch"

    // Função para enviar resposta JSON
    function sendResponse($data) {
        echo json_encode($data);
        exit;
    }

    // Caso padrão: buscar perguntas
    if ($action === 'fetch') {
        $query = "SELECT cd_pergunta, desc_pergunta, status FROM TB_PERGUNTA order by 1";
        $result = pg_query($conn, $query);

        if (!$result) {
            sendResponse(['error' => 'Erro ao buscar perguntas: ' . pg_last_error($conn)]);
        }

        $perguntas = pg_fetch_all($result) ?: []; // Garante array vazio se não houver resultados
        sendResponse(['perguntas' => $perguntas]);
    }

    // Adicionar nova pergunta
    if ($action === 'add') {
        $input = json_decode(file_get_contents('php://input'), true);
        if (empty($input['descricao'])) {
            sendResponse(['error' => 'Descrição da pergunta é obrigatória.']);
        }

        $query = "INSERT INTO TB_PERGUNTA (desc_pergunta, status) VALUES ($1, '1')";
        $params = [$input['descricao']];
        $result = pg_query_params($conn, $query, $params);

        if (!$result) {
            sendResponse(['error' => 'Erro ao adicionar pergunta: ' . pg_last_error($conn)]);
        }

        sendResponse(['message' => 'Pergunta adicionada com sucesso.']);
    }

    // Atualizar pergunta existente
    // Atualizar pergunta existente
    if ($action === 'edit') {
        $input = json_decode(file_get_contents('php://input'), true);
        if (empty($input['id']) || empty($input['descricao'])) {
            sendResponse(['error' => 'ID e descrição são obrigatórios.']);
        }

        $query = "UPDATE TB_PERGUNTA SET desc_pergunta = $1 WHERE cd_pergunta = $2";
        $params = [$input['descricao'], $input['id']];
        $result = pg_query_params($conn, $query, $params);

        if (!$result) {
            sendResponse(['error' => 'Erro ao editar pergunta: ' . pg_last_error($conn)]);
        }

        sendResponse(['message' => 'Pergunta atualizada com sucesso.']);
    }

    // Alterar status da pergunta
    if ($action === 'toggleStatus') {
        $input = json_decode(file_get_contents('php://input'), true);
        if (empty($input['id']) || !isset($input['status'])) {
            sendResponse(['error' => 'ID e status são obrigatórios.']);
        }

        $query = "UPDATE TB_PERGUNTA SET status = $1 WHERE cd_pergunta = $2";
        $params = [$input['status'], $input['id']];
        $result = pg_query_params($conn, $query, $params);

        if (!$result) {
            sendResponse(['error' => 'Erro ao alterar status: ' . pg_last_error($conn)]);
        }

        sendResponse(['message' => 'Status atualizado com sucesso.']);
    }
    // Atualizar pergunta existente
    if ($action === 'edit') {
        $input = json_decode(file_get_contents('php://input'), true);
        if (empty($input['id']) || empty($input['descricao'])) {
            sendResponse(['error' => 'ID e descrição são obrigatórios.']);
        }

        $query = "UPDATE TB_PERGUNTA SET desc_pergunta = $1 WHERE cd_pergunta = $2";
        $params = [$input['descricao'], $input['id']];
        $result = pg_query_params($conn, $query, $params);

        if (!$result) {
            sendResponse(['error' => 'Erro ao editar pergunta: ' . pg_last_error($conn)]);
        }

        sendResponse(['message' => 'Pergunta atualizada com sucesso.']);
    }


    // Caso nenhuma ação seja correspondente
    sendResponse(['error' => 'Ação não reconhecida.']);
