<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercicio 8</title>
</head>
<body>
    <form action="ATIVIDADE8.PHP" method = 'POST'>
        <div>
            <h1>Calculo de juros</h1>
            <label for="avista">Digite o valor da moto a vista:</label>
            <br>
            <input type="number" name="avista" id="avista" placeholder="Ex:8654.00">
            <br>
            <label for="vezParc">Selecione o total de parcelas:</label>
            <br>
            <select name="vezParc" id="vezParc">
                <option value="24" id="24" >24</option>
                <option value="36" id="36" >36</option>
                <option value="48" id="48" >48</option>
                <option value="60" id="60" >60</option>
            </select>
            <br>    
            <br>
        </div>
        <input id ='submit' type="submit">
    </form>
<!-- Paulinho foi comprar uma moto nova. A empresa vende motos muito baratas pois
utiliza Juros Simples para o cálculo das parcelas.
Sabendo então que o valor a vista do moto é R$ 8.654,00.
Crie um programa que calcule o valor das parcelas para as opções abaixo, sabendo que
a taxa de juros aumenta 0,5% em cada nível e inicia em 1,5% para 24 vezes:
24 ezes
36 vezes
48 vezes
60 vezes -->
<?php

    function juros($avista,$vezParc,$totJuros){
        $taxa = 0;
        $totJuros = 0;
        if($vezParc = 24){
            $taxa = 0.015;
        }
        elseif($vezParc = 36){
            $taxa = 0.02;
        }
        elseif($vezParc = 48){
            $taxa = 0.025;
        }
        elseif($vezParc = 60){
            $taxa = 0.03;
        }
        $totJuros = $avista * $taxa * $vezParc;
        return $totJuros;
    }

    function mens($mensagen){
        echo $mensagen;
    }


    if (isset($_POST['avista'])){

        $avista= $_POST['avista']?:0;
        $vezParc= $_POST['vezParc']?:0;
        $totJuros = 0;
        $totJuros = juros($avista,$vezParc,$totJuros) ;
        $tot = $totJuros + $avista;
        $parc = round(($tot/$vezParc),2);

        mens("<h3>O total de Juros para pagar vai ser R$$totJuros em cima do valor total de R$$avista, resulando num valor de R$$tot <h3>");
        mens("E as parcelas ficaram num valor de R$$parc");
    
    } 
    ?>
</body>
</html>

