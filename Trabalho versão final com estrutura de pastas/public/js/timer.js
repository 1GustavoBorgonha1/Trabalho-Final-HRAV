let contador = 30;
const timerElement = document.getElementById("timer");

function iniciarContagem() {
    const interval = setInterval(() => {
        contador--;
        timerElement.innerText = `Você será redirecionado para a primeira pergunta em ${contador} segundos caso não responda algo.`;
        
        if (contador <= 0) {
            clearInterval(interval);
            window.location.href = "pergunta.html";
        }
    }, 1000);
}

function resetarContagem() {
    contador = 30;
}

// Reinicia o timer ao interagir com a página
document.addEventListener("click", resetarContagem);
document.addEventListener("keydown", resetarContagem);

// Inicia o timer de inatividade
iniciarContagem();
