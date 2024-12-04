<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercicio 6</title>
</head>
<body>
    <form action="ATIVIDADE7.PHP" method = 'POST'>
        <div>
            <h1>Calculo de juros</h1>
            <label for="avista">Digite o valor do carro a vista:</label>
            <br>
            <input type="number" name="avista" id="avista">
            <br>
            <label for="vezParc">Digite o total de parcelas:</label>
            <br>
            <input type="number"  step = "any" name="vezParc" id="vezParc">
            <br>
            <label for="vParc">Digite o valor das parcelas:</label>
            <br>
            <input type="number" name="vParc" id="vParc">
            <br>
        </div>
        <input id ='submit' type="submit">
    </form>
<!-- 7. Mariazinha foi comprar um carro novo esse carro custa R$ 22.500,00 a vista, mas como
ela não tem esse dinheiro para comprar a vista, resolveu fazer um financiamento, que
ficou em 60 parcelas de R$ 489,65.
Escreva um programa que calcule o valor gasto só dos juros que serão pagos por
Mariazinha em comparação ao valor a vista do carro. -->
<?php

    function calculaJuros($vezParc,$vlParc,$juros){
        $juros = $vezParc*$vlParc;
        return $juros;
    }
    function calculaDifJuros($avista,$vezParc,$vlParc,$difJuros){
        $juros = ($vezParc*$vlParc)-$avista;
        return $juros;
    }

    function mens($mensagen){
        echo $mensagen;
    }

    if (isset($_POST['avista'])){

        $avista= $_POST['avista']?:0;
        $vezParc= $_POST['vezParc']?:0;
        $vlParc= $_POST['vParc']?:0;
       
        $difJuros = 0;
        $difJuros = calculaDifJuros($avista,$vezParc,$vlParc,$difJuros);

        $juros = 0;
        $juros=calculaJuros($vezParc,$vlParc,$juros);

        mens("<h3>O valor pago no carro a vista é de R$$avista e com os juros é de R$$juros, 
        sendo uma diferença de R$$difJuros!</h3>"); 
    } 
    ?>
</body>
</html>

