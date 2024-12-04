<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercicio 1</title>
</head>
<body>
    <form action="ATIVIDADE1.PHP" method = 'POST'>
        <div>
            <label for="valor1">Valor A</label>
            <input type="number" step = "any" name="valor1" id="valor1">
        </div>
        <div>
            <label for="valor2">Valor B</label>
            <input type="number" step = "any" name="valor2" id="valor2">
        </div>
        <div>
            <label for="valor3">Valor C</label>
            <input type="number" step = "any" name="valor3" id="valor3">
        </div>

        <input id ='submit' type="submit" value="Calcular">
    </form>

    <!-- 1. Criar um programa que execute a soma de três valores. 
Se a primeira variável for maior que 10, escrever o resultado da 
operação em azul Se a segunda variável for menor que a terceira, 
escrever o resultado em verde Se a terceira variável for menor que a primeira 
e a segunda variável escrever o  resultado em vermelho  -->


    <?php

        if (isset($_POST['valor1'])){
            $valor1 = $_POST['valor1'] ?: 0;
            $valor2 = $_POST['valor2'] ?: 0;
            $valor3 = $_POST['valor3'] ?: 0;

            $resultado= $valor1+ $valor2+ $valor3;

                if ($valor1 > 10) {
                    echo "<H1 style = 'color: blue'>$valor1 + $valor2 + $valor3 = $resultado</H1>";
                }
                else if ($valor2 < $valor3){
                    echo "<H1 style = 'color: green'>$valor1 + $valor2 + $valor3 = $resultado</H1>";
                }
                else if ($valor3 < $valor1 and $valor3 < $valor2){
                    echo "<H1 style = 'color: red'>$valor1 + $valor2 + $valor3 = $resultado</H1>";
                }
                else {
                    echo "<H1 style = 'color: pink'>$valor1 + $valor2 + $valor3 = $resultado</H1>";   
                }
        };
    ?>
</body>
</html>


