<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercicio 3</title>
</head>
<body>
    <form action="ATIVIDADE3.PHP" method = 'POST'>
        <div>
            <label for="lado">Tamanho de um lado do quadrado em metros:</label>
            <br>
            <input type="number" step = "any" name="lado" id="lado">
        </div>
        <input id ='submit' type="submit">
    </form>

<?php
        function calArea($lado) {
            $area = $lado * $lado;
            echo "A área do quadrado de lado de $lado metros é $area metro(s) quadrado(s)";
        }  

        if (isset($_POST['lado'])){

            $lado = $_POST['lado']?:0;

            calArea($lado);
        }
     
        ?>
</body>
</html>

