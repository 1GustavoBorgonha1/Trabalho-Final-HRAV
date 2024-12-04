<?php
// Definindo o array conforme o exemplo
$pastas = array(
    "bsn" => array(
        "3a Fase" => array(
            "desenvWeb",
            "bancoDados 1",
            "engSoft 1"
        ),
        "4a Fase" => array(
            "Intro Web",
            "bancoDados 2",
            "engSoft 2"
        )
    )
);

// Função recursiva para exibir a estrutura em árvore
function exibirArvore($itens, $nivel = 0) {
    foreach ($itens as $chave => $valor) {
        echo str_repeat("-", $nivel) . " ";
        
        // Verifica se é um índice associativo (chave como string) ou apenas um valor
        if (is_array($valor)) {
            echo $chave . "<br>";
            exibirArvore($valor, $nivel + 1); // Chamada recursiva
        } else {
            echo $valor . "<br>";
        }
    }
}

// Chamada da função para exibir a árvore
exibirArvore($pastas);
?>
