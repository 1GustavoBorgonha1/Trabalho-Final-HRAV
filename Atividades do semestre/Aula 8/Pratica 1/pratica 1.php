<?php
    // Declaração de constantes com nome e sobrenome
    define("NOME", "SeuNome");
    define("SOBRENOME", "SeuSobrenome");

    // Declaração da variável que concatena as constantes
    $nomeCompleto = NOME . " " . SOBRENOME;

    // Produz saída com o conteúdo
    echo "Meu nome completo é: " . $nomeCompleto;
?>
