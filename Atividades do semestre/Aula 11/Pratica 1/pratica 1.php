<?php
// Conexão com o banco de dados
$dbconn = pg_connect("host=localhost port=5432 dbname=local user=postgres password=123456");
if (!$dbconn) {
    die("Erro na conexão com o banco de dados.");
}

// Consulta para buscar todas as pessoas cadastradas
$query = "SELECT PESNOME, PESSOBRENOME, PESEMAIL, PESCIDADE, PESESTADO FROM TBPESSOA";
$result = pg_query($dbconn, $query);

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
