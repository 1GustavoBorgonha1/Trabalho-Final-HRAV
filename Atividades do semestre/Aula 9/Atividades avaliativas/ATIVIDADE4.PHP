<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercicio 4</title>
</head>
<body>
    <form action="ATIVIDADE4.PHP" method = 'POST'>
        <div>
            <h1>Area do retangulo</h1>
            <label for="ladoa">Tamanho de dois lados do retangulo em metros:</label>
            <br>
            <input type="number" step = "any" name="ladoa" id="ladoa">
            <br>
            <label for="ladob">Tamanho dos dois outros lados do retangulo em metros:</label>
            <br>
            <input type="number" step = "any" name="ladob" id="ladob">
        </div>
        <input id ='submit' type="submit">
    </form>

<?php
        function calArea($ladoa,$ladob) {
            $area = $ladoa * $ladob;
            if($area > 10){
                echo "<h1>A área do retângulo de lados $ladoa e $ladob metros é $area metros quadrados.</h1>";
            }
            else{
                echo "<h3>A área do retângulo de lados $ladoa e $ladob metros é $area metros quadrados.</h3>";
            }
        }  

        if (isset($_POST['ladoa'])){

            $ladoa = $_POST['ladoa']?:0;
            $ladob = $_POST['ladob']?:0;
            calArea($ladoa,$ladob);
        }
     
        ?>
</body>
</html>

