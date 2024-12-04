let perguntas = [];
let perguntaAtual = 0;
let dispositivoSelecionado = localStorage.getItem('dispositivoSelecionado');
let setorSelecionado = localStorage.getItem('setorSelecionado');

if (!dispositivoSelecionado || !setorSelecionado) {
    window.location.href = 'selecionar_dispositivo.html';
}

async function carregarPerguntas() {
    try {
        const response = await fetch('get_pergunta.php');
        const data = await response.json();

        if (data.error) {
            alert('Erro ao carregar perguntas: ' + data.error);
            console.error('Erro recebido da API:', data.error);
            return;
        }

        perguntas = data.perguntas || [];
        console.log('Perguntas carregadas:', perguntas);

        if (perguntas.length === 0) {
            alert('Nenhuma pergunta disponível.');
            redirecionarParaAgradecimento();
            return;
        }

        mostrarPergunta();
    } catch (error) {
        console.error('Erro ao carregar perguntas:', error);
        alert('Erro ao carregar perguntas. Verifique sua conexão.');
    }
}

function mostrarPergunta() {
    if (perguntaAtual >= perguntas.length) {
        redirecionarParaAgradecimento();
        return;
    }

    const pergunta = perguntas[perguntaAtual];
    if (!pergunta) {
        alert('Erro ao exibir pergunta. Dados inválidos.');
        console.error('Pergunta inválida:', pergunta);
        return;
    }

    console.log('Exibindo pergunta:', pergunta);
    document.getElementById('pergunta-container').innerHTML = `<p>${pergunta.desc_pergunta}</p>`;
    document.querySelectorAll('input[name="nota"]').forEach(input => input.checked = false);
    document.getElementById('feedback').value = '';
}

async function enviarResposta() {
    const nota = document.querySelector('input[name="nota"]:checked');
    const feedback = document.getElementById('feedback').value;

    if (!nota) {
        alert('Por favor, selecione uma nota antes de enviar.');
        return;
    }

    const cd_dispositivo = parseInt(dispositivoSelecionado);
    const cd_setor = parseInt(setorSelecionado);

    console.log('Enviando resposta:', {
        pergunta_id: perguntas[perguntaAtual].cd_pergunta,
        resposta: parseInt(nota.value),
        feedback,
        cd_dispositivo,
        cd_setor,
    });

    try {
        const response = await fetch('salvar_resposta.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                pergunta_id: perguntas[perguntaAtual].cd_pergunta,
                resposta: parseInt(nota.value),
                feedback,
                cd_dispositivo,
                cd_setor,
            }),
        });

        const result = await response.json();
        console.log('Resposta do servidor:', result);

        if (result.error) {
            alert('Erro ao salvar a resposta: ' + result.error);
            return;
        }

        perguntaAtual++;
        mostrarPergunta();
    } catch (error) {
        console.error('Erro ao enviar a resposta:', error);
        alert('Erro ao enviar a resposta. Tente novamente.');
    }
}

function redirecionarParaAgradecimento() {
    window.location.href = 'agradecimento.html';
}

document.getElementById('enviarResposta').addEventListener('click', enviarResposta);

carregarPerguntas();
