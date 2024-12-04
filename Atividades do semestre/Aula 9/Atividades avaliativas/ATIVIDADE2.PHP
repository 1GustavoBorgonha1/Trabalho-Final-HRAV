<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercicio 1</title>
</head>
<body>
    <form action="ATIVIDADE2.PHP" method = 'POST'>
        <div>
            <label for="numero">Valor A</label>
            <input type="number" step = "any" name="numero" id="numero">
        </div>

        <input id ='submit' type="submit" value="Calcular">
    </form>



    <!-- 2. Crie um programa para testar se um número é divisível por 2. 
Caso for verdade escrever a frase “Valor divisível por 2” 
Caso for falso escrever a frase “O valor não é divisível por 2”  -->

<?php
        function verificador($numero) {
            if ($numero % 2 == 0 and $numero <> 0) {
                echo "Valor divisível por 2";
            } else {
                echo "O valor não é divisível por 2";
            }
        }

        if (isset($_POST['numero'])){

            $numero = $_POST['numero']?:0;

            verificador($numero);
        }


        
        ?>
</body>
</html>

