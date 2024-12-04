<?php 

    define("notas", array(8, 3, 5, 7));
    define("frequencia", array(0,0,1,0,1,0,0,0,1,1));

    function calculaMediaNotas() {
        $somaNotas = 0;
        for($i = 0;$i < count(notas); $i++) {
            $somaNotas += notas[$i];
        }
        return $somaNotas / count(notas);
    }

    function statusNota() {
        if(calculaMediaNotas() >= 7) {
            return "Aprovado";
        }
        return "Reprovado";
    }

    function calculaFrequencia() {
        $somaFaltas = 0;
        for($i = 0; $i < count(frequencia); $i++) {
            $somaFaltas += frequencia[$i];
        }
        $frequencia = 100 - (($somaFaltas * 100) / $i);
        return $frequencia;
    }

    function statusFrequencia() {
        if(calculaFrequencia() >= 70) {
            return "Aprovado";
        }
        return "Reprovado";
    }

    function exibeMensagem($mensagem) {
        echo $mensagem;
    }

    $mediaNotas = calculaMediaNotas();
    $statusNotas = statusNota();
    $frequencia = calculaFrequencia();
    $statusFrequencia = statusFrequencia();

    exibeMensagem("Média Notas: " . $mediaNotas . "<br>" . 
                  "Status Notas: " . $statusNotas . "<br>" .
                  "Frequencia: " . $frequencia . "<br>" .
                  "Status Frequencia: " . $statusFrequencia);

?>