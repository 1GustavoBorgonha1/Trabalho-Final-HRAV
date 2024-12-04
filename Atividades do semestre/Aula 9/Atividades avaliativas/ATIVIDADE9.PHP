<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercicio 9</title>
</head>
<body>
    <form action="ATIVIDADE9.PHP" method = 'POST'>
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
<!-- 9. Juquinha seguindo o mesmo caminho que Paulinho foi comprar uma moto nova, 
 mas  pena que ele não sabia da mesma chance que Paulinho.  
A empresa que Juquinha foi comprar a moto utiliza juros compostos para calcular o  valor das parcelas. 
As opções de compras estudadas por ele são as mesmas de Paulinho, ou seja 24, 36,  48 e 60 
vezes o juro nesta empresa inicia em 2% para 24 vezes e aumenta 0,3% para  as opções de 
parcelamento seguintes.  
  
Utilizando então a fórmula de juros composto que segue abaixo, calcule o valor da  parcela para cada uma das opções a ser estudada por Juquinha. 
 M = C * (1 + i)t , onde: 
 M = Montante 
 C = Capital Inicial 
 i = Taxa de juros 
 t = Tempo  -->

<?php

    function juros($avista,$vezParc,$totJurosx){
        $taxa = 0;
        $totJuros = 0;
        if($vezParc = 24){
            $taxa = 0.02;
        }
        elseif($vezParc = 36){
            $taxa = 0.023;
        }
        elseif($vezParc = 48){  
            $taxa = 0.026;
        }
        elseif($vezParc = 60){
            $taxa = 0.029;
        }
        $totJuros = $avista * pow((1 + $taxa),$vezParc);
        return $totJurosx = round($totJuros,2);
    }

    function mens($mensagen){
        echo $mensagen;
    }


    if (isset($_POST['avista'])){

        $avista= $_POST['avista']?:0;
        $vezParc= $_POST['vezParc']?:0;
        $totJuros = 0;
        $totJuros = juros($avista,$vezParc,$totJuros) ;
        $parc = round($totJuros/$vezParc,2);

        mens("<h3>O valor total da moto com a taxa de juros da condição de pagamento de $vezParc vezes ficou R$$totJuros <h3>");
        mens("<h3>Sendo o valor das parcelas de R$$parc<h3>");
    } 
    ?>
</body>
</html>

