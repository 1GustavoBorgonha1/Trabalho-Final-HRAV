<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calcular Idade</title>
</head>
<body>
    <?php
        require_once("funcoes.php");

        // Data de nascimento de exemplo
        $dataNascimento = "1990-05-15";
        $idade = calcularIdade($dataNascimento);

        echo "A idade calculada é: " . $idade . " anos.";
    ?>
</body>
</html>
