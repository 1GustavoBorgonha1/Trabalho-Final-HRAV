<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercicio 6</title>
</head>
<body>
    <form action="ATIVIDADE6.PHP" method = 'POST'>
        <div>
            <h1>Compra de Joãozinho</h1>
            <label for="maca">Maçã:</label>
            <br>
            <input type="number" name="macavl" id="macavl" placeholder="Valor do KG">
            <input type="number" name="macakg" id="macakg" placeholder="Peso total em KG">
            <br>
            <label for="melancia">Melancia:</label>
            <br>
            <input type="number" name="melanciavl" id="melanciavl" placeholder="Valor do KG">
            <input type="number" name="melanciakg" id="melanciakg" placeholder="Peso total em KG">
            <br>
            <label for="laranja">Laranja:</label>
            <br>
            <input type="number" name="laranjavl" id="laranjavl" placeholder="Valor do KG">
            <input type="number" name="laranjakg" id="laranjakg" placeholder="Peso total em KG">
            <br>
            <label for="repolio">Repolio:</label>
            <br>
            <input type="number" name="repoliovl" id="repoliovl" placeholder="Valor do KG">
            <input type="number" name="repoliokg" id="repoliokg" placeholder="Peso total em KG">
            <br>
            <label for="cenoura">Cenoura:</label>
            <br>
            <input type="number" name="cenouravl" id="cenouravl" placeholder="Valor do KG">
            <input type="number" name="cenourakg" id="cenourakg" placeholder="Peso total em KG">
            <br>
            <label for="batata">Batatinha:</label>
            <br>
            <input type="number" name="batatavl" id="batatavl" placeholder="Valor do KG">
            <input type="number" name="batatakg" id="batatakg" placeholder="Peso total em KG">
            <br>
            <br>
            <label for="pag">Dinheiro para o Pagamento : </label>
            <input type="number" name="pag" id="pag" placeholder="Exemplo R$50">
            <br>

            <br>
        </div>
        <input id ='submit' type="submit">
    </form>
<!-- 6. Joãozinho recebeu R$ 50,00 reais de seu pai para ir à feira comprar frutas e verduras.
Ele comprou maçã, melancia, laranja, repolho, cenoura, batatinha.
Crie um programa que calcule o valor gasto com cada produto comprado, sendo o
resultado do valor individual do produto em Kg multiplicado pela quantidade em Kg
comprada por Joãozinho.
Ao final escrever uma frase com o valor da compra, e uma previsão se o dinheiro será
o suficiente para pagar a conta, caso falte dinheiro escrever uma frase em vermelho
com o valor que ficou acima do disponível por Joãozinho, e não, escrever uma fase em
azul e o valor que Joãozinho ainda poderia gastar.
Caso o valor da compra seja exatamente igual ao R$ 50,00 disponível, escreva uma
frase em verde afirmando que o saldo para compras foi esgotado. -->
<?php

        function calPreco($quantidades,$precos,$valorpago){
            $valorpagos = 0;
            foreach ($precos as $produto => $preco){
            $valorpago += $preco * $quantidades[$produto];
            } 
        return $valorpago;
        }

        function exibetotal($pag,$valorpago){
            echo "<h3>Você pagou $pag reais e o valor da conta é de $valorpago reais<h3>";
        }

        function mens($mensagen){
            echo $mensagen;
        }

        if (isset($_POST['pag'])){

            $pag= $_POST['pag']?:0;
            

            $precos = [
                "maçã" => $_POST['macavl']?:0,    
                "melancia" => $_POST['melanciavl']?:0, 
                "laranja" => $_POST['laranjavl']?:0,  
                "repolio" => $_POST['repoliovl']?:0,  
                "cenoura" => $_POST['cenouravl']?:0,  
                "batatinha" => $_POST['batatavl']?:0  
            ];
    
            $quantidades = [
                "maçã" => $_POST['macakg']?:0,    
                "melancia" => $_POST['melanciakg']?:0,  
                "laranja" => $_POST['laranjakg']?:0, 
                "repolio" => $_POST['repoliokg']?:0, 
                "cenoura" => $_POST['cenourakg']?:0,  
                "batatinha" => $_POST['batatakg']?:0  
            ];

            $valorpago = 0;

            $valorpago = calPreco($quantidades,$precos,$valorpago);

            $falta = $valorpago - $pag;
            $sobra = $pag - $valorpago;

            exibetotal($pag,$valorpago);
            
            if ($pag<$valorpago){
                mens("<span style='color: red;'>Dinheiro insuficiente, faltam R$ $falta para pagar a conta.</span>");
            }
            else if ($pag === $valorpago){
                mens("<span style='color: green;'>Saldo para as compras foi esgotado</span>");
            }
            else{
                mens("<span style='color: blue;'>Dinheiro sobrando, você tem R$ $sobra para gastar ainda.</span>");
            }
        } 
        ?>
</body>
</html>

