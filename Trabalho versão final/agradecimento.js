// Função para redirecionar para a primeira pergunta
function voltarParaPrimeiraPergunta() {
    window.location.href = "pergunta.html?id=1"; // Redireciona para a primeira pergunta
}

// Variáveis para o tempo de inatividade e o contador
const tempoInatividade = 10; // Tempo de inatividade em segundos
let tempoRestante = tempoInatividade; // Tempo restante que será exibido no contador
let timerInterval; // Variável para o intervalo do timer

// Função para atualizar o contador na tela e verificar o redirecionamento
function atualizarContador() {
    const contadorElemento = document.getElementById("contador");
    contadorElemento.textContent = `Você será redirecionado em ${tempoRestante} segundos...`;

    // Decrementa o tempo restante
    tempoRestante--;

    // Se o tempo acabar, redireciona para a primeira pergunta
    if (tempoRestante < 0) {
        voltarParaPrimeiraPergunta();
    }
}

// Função para resetar o timer de inatividade
function resetarTimer() {
    // Reseta o tempo restante
    tempoRestante = tempoInatividade;

    // Reinicia o contador imediatamente
    atualizarContador();

    // Limpa qualquer intervalo existente e inicia um novo
    clearInterval(timerInterval);
    timerInterval = setInterval(atualizarContador, 1000); // Atualiza o contador a cada segundo
}

// Inicializa o timer ao carregar a página
resetarTimer();

// Eventos de interação para resetar o timer
document.addEventListener('click', resetarTimer);
document.addEventListener('mousemove', resetarTimer);
document.addEventListener('keypress', resetarTimer);
