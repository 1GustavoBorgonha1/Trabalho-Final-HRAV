<?php
// Função para calcular a idade a partir da data de nascimento
function calcularIdade($dataNascimento) {
    $dataAtual = new DateTime();
    $nascimento = new DateTime($dataNascimento);
    $idade = $dataAtual->diff($nascimento);
    return $idade->y;
}
?>
