<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercicio 5</title>
</head>
<body>
    <form action="ATIVIDADE5.PHP" method = 'POST'>
        <div>
            <h1>Area do triangulo retangulo</h1>
            <label for="base">Tamanho da base do triangulo retangulo em metros:</label>
            <br>
            <input type="number" step = "any" name="base" id="base">
            <br>
            <label for="altura">Tamanho da altura do triangulo retangulo em metros:</label>
            <br>
            <input type="number" step = "any" name="altura" id="altura">
        </div>
        <input id ='submit' type="submit">
    </form>
<!-- Crie um programa que calcule a área de um triângulo retângulo, cuja fórmula segue
abaixo. Crie as variáveis apropriadas para o cálculo em PHP e por fim exiba uma frase
com o valor da operação.

Fórmula -> Resultado = (Base * Altura) / 2 -->
<?php
        function calArea($base,$altura) {
            $area = ($base*$altura) / 2;
            echo "A area do triangulo retangulo é de $area";
        }  

        if (isset($_POST['altura'])){

            $base = $_POST['base']?:0;
            $altura = $_POST['altura']?:0;
            calArea($base,$altura);
        }
     
        ?>
</body>
</html>

