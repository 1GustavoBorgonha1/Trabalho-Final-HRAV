<?php
// Conexão com o banco de dados
$dbconn = pg_connect("host=localhost port=5432 dbname=local user=postgres password=123456");
if (!$dbconn) {
    die("Erro na conexão com o banco de dados.");
}

// Obtendo o termo de busca, se fornecido
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Consulta SQL com filtro de busca
if ($searchTerm) {
    $query = "SELECT PESNOME, PESSOBRENOME, PESEMAIL, PESCIDADE, PESESTADO 
              FROM TBPESSOA 
              WHERE PESNOME ILIKE $1";
    $result = pg_query_params($dbconn, $query, array('%' . $searchTerm . '%'));
} else {
    // Consulta padrão sem filtro de busca
    $query = "SELECT PESNOME, PESSOBRENOME, PESEMAIL, PESCIDADE, PESESTADO FROM TBPESSOA";
    $result = pg_query($dbconn, $query);
}

if (!$result) {
    die("Erro na consulta ao banco de dados.");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pessoas Cadastradas</title>
</head>
<body>
    <h1>Lista de Pessoas Cadastradas</h1>

    <!-- Campo de busca -->
    <form method="GET" action="listar_pessoas.php">
        <label for="search">Buscar pelo nome:</label>
        <input type="text" id="search" name="search" value="<?php echo htmlspecialchars($searchTerm); ?>">
        <button type="submit">Buscar</button>
    </form>

    <table border="1">
        <tr>
            <th>Nome</th>
            <th>Sobrenome</th>
            <th>Email</th>
            <th>Cidade</th>
            <th>Estado</th>
        </tr>
        <?php
        // Loop para exibir cada pessoa em uma linha da tabela
        while ($row = pg_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['pesnome']) . "</td>";
            echo "<td>" . htmlspecialchars($row['pessobrenome']) . "</td>";
            echo "<td>" . htmlspecialchars($row['pesemail']) . "</td>";
            echo "<td>" . htmlspecialchars($row['pescidade']) . "</td>";
            echo "<td>" . htmlspecialchars($row['pesestado']) . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
// Fechar a conexão com o banco de dados
pg_close($dbconn);
?>
