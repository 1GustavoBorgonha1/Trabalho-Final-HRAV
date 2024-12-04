// Função para carregar perguntas
async function carregarPerguntas() {
    try {
        const response = await fetch('perguntas.php?action=fetch');
        const data = await response.json();

        if (data.error) {
            console.error('Erro ao carregar perguntas:', data.error);
            alert('Erro ao carregar perguntas: ' + data.error);
            return;
        }

        console.log('Perguntas carregadas:', data.perguntas);

        const tabelaPerguntas = document.getElementById('tabela-perguntas');
        if (!tabelaPerguntas) {
            console.error('Elemento com ID "tabela-perguntas" não encontrado no DOM.');
            return;
        }

        // Limpa a tabela antes de adicionar novas perguntas
        tabelaPerguntas.innerHTML = '';

        // Popula a tabela com perguntas
        data.perguntas.forEach(pergunta => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${pergunta.cd_pergunta}</td>
                <td>${pergunta.desc_pergunta}</td>
                <td>${pergunta.status === '1' ? 'Ativa' : 'Inativa'}</td>
                <td>
                    <button onclick="ativarPergunta(${pergunta.cd_pergunta})" ${pergunta.status === '1' ? 'disabled' : ''}>Ativar</button>
                    <button onclick="desativarPergunta(${pergunta.cd_pergunta})" ${pergunta.status === '0' ? 'disabled' : ''}>Desativar</button>
                    <button onclick="editarPergunta(${pergunta.cd_pergunta}, '${pergunta.desc_pergunta}')">Editar</button>
                </td>
            `;
            tabelaPerguntas.appendChild(row);
        });
    } catch (error) {
        console.error('Erro ao carregar perguntas:', error);
        alert('Erro ao carregar perguntas. Tente novamente.');
    }
}

// Função para ativar pergunta
async function ativarPergunta(id) {
    try {
        const response = await fetch('perguntas.php?action=toggleStatus', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id, status: 1 }),
        });

        const result = await response.json();

        if (result.error) {
            console.error('Erro ao ativar pergunta:', result.error);
            alert('Erro ao ativar pergunta: ' + result.error);
            return;
        }

        alert('Pergunta ativada com sucesso!');
        carregarPerguntas(); // Chamada global
    } catch (error) {
        console.error('Erro ao ativar pergunta:', error);
        alert('Erro ao ativar pergunta. Tente novamente.');
    }
}

// Função para salvar uma nova pergunta
async function salvarPergunta() {
    const descricaoInput = document.getElementById('descricao-pergunta');
    const descricao = descricaoInput ? descricaoInput.value.trim() : '';

    if (!descricao) {
        alert('Descrição da pergunta não pode estar vazia.');
        return;
    }

    try {
        const response = await fetch('perguntas.php?action=add', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ descricao }),
        });

        const result = await response.json();

        if (result.error) {
            console.error('Erro ao salvar pergunta:', result.error);
            alert('Erro ao salvar pergunta: ' + result.error);
            return;
        }

        alert('Pergunta salva com sucesso!');
        descricaoInput.value = ''; // Limpar campo de entrada
        carregarPerguntas();
    } catch (error) {
        console.error('Erro ao salvar pergunta:', error);
        alert('Erro ao salvar pergunta. Tente novamente.');
    }
}


// Inicializar ao carregar a página
document.addEventListener('DOMContentLoaded', () => {
    carregarPerguntas();
});

// Função para carregar perguntas
async function carregarPerguntas() {
    try {
        const response = await fetch('perguntas.php?action=fetch');
        const data = await response.json();

        if (data.error) {
            console.error('Erro ao carregar perguntas:', data.error);
            alert('Erro ao carregar perguntas: ' + data.error);
            return;
        }

        console.log('Perguntas carregadas:', data.perguntas);

        const tabelaPerguntas = document.getElementById('tabela-perguntas');
        if (!tabelaPerguntas) {
            console.error('Elemento com ID "tabela-perguntas" não encontrado no DOM.');
            return;
        }

        // Limpa a tabela antes de adicionar novas perguntas
        tabelaPerguntas.innerHTML = '';

        // Popula a tabela com perguntas
        data.perguntas.forEach(pergunta => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${pergunta.cd_pergunta}</td>
                <td>${pergunta.desc_pergunta}</td>
                <td>${pergunta.status === '1' ? 'Ativa' : 'Inativa'}</td>
                <td class="action-buttons"></td>
            `;

            const actionButtons = row.querySelector('.action-buttons');

            // Botão de ativar
            const ativarBtn = document.createElement('button');
            ativarBtn.textContent = 'Ativar';
            ativarBtn.disabled = pergunta.status === '1';
            ativarBtn.classList.add('action-button');
            ativarBtn.onclick = () => ativarPergunta(pergunta.cd_pergunta);

            // Botão de desativar
            const desativarBtn = document.createElement('button');
            desativarBtn.textContent = 'Desativar';
            desativarBtn.disabled = pergunta.status === '0';
            desativarBtn.classList.add('action-button');
            desativarBtn.onclick = () => desativarPergunta(pergunta.cd_pergunta);

            // Botão de editar
            const editarBtn = document.createElement('button');
            editarBtn.textContent = 'Editar';
            editarBtn.classList.add('action-button');
            editarBtn.onclick = () => editarPergunta(pergunta.cd_pergunta, pergunta.desc_pergunta);

            // Adiciona os botões à célula
            actionButtons.appendChild(ativarBtn);
            actionButtons.appendChild(desativarBtn);
            actionButtons.appendChild(editarBtn);

            tabelaPerguntas.appendChild(row);
        });
    } catch (error) {
        console.error('Erro ao carregar perguntas:', error);
        alert('Erro ao carregar perguntas. Tente novamente.');
    }
}


// Função para ativar pergunta
async function ativarPergunta(id) {
    try {
        const response = await fetch('perguntas.php?action=toggleStatus', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id, status: 1 }),
        });

        const result = await response.json();

        if (result.error) {
            console.error('Erro ao ativar pergunta:', result.error);
            alert('Erro ao ativar pergunta: ' + result.error);
            return;
        }

        alert('Pergunta ativada com sucesso!');
        carregarPerguntas(); // Chamada global
    } catch (error) {
        console.error('Erro ao ativar pergunta:', error);
        alert('Erro ao ativar pergunta. Tente novamente.');
    }
}

// Função para desativar pergunta
async function desativarPergunta(id) {
    try {
        const response = await fetch('perguntas.php?action=toggleStatus', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id, status: 0 }),
        });

        const result = await response.json();

        if (result.error) {
            console.error('Erro ao desativar pergunta:', result.error);
            alert('Erro ao desativar pergunta: ' + result.error);
            return;
        }

        alert('Pergunta desativada com sucesso!');
        carregarPerguntas(); // Chamada global
    } catch (error) {
        console.error('Erro ao desativar pergunta:', error);
        alert('Erro ao desativar pergunta. Tente novamente.');
    }
}

async function salvarPergunta() {
    const descricaoInput = document.getElementById('descricao-pergunta');
    const descricao = descricaoInput.value.trim();

    if (!descricao) {
        alert('Descrição da pergunta não pode estar vazia.');
        return;
    }

    try {
        const response = await fetch('perguntas.php?action=add', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ descricao }),
        });

        const result = await response.json();

        if (result.error) {
            console.error('Erro ao salvar pergunta:', result.error);
            alert('Erro ao salvar pergunta: ' + result.error);
            return;
        }

        alert('Pergunta salva com sucesso!');
        descricaoInput.value = ''; // Limpar o campo após salvar
        carregarPerguntas(); // Recarregar a tabela de perguntas
    } catch (error) {
        console.error('Erro ao salvar pergunta:', error);
        alert('Erro ao salvar pergunta. Tente novamente.');
    }
}

// Função para editar pergunta
function editarPergunta(id, descricaoAtual) {
    const descricaoInput = document.getElementById('descricao-pergunta');
    descricaoInput.value = descricaoAtual;

    const salvarButton = document.getElementById('salvar-pergunta');
    if (salvarButton) {
        salvarButton.classList.add('action-button'); // Adiciona classe de estilo ao botão
        salvarButton.addEventListener('click', salvarPergunta);
    }

    botaoSalvar.onclick = async function () {
        const novaDescricao = descricaoInput.value.trim();

        if (!novaDescricao) {
            alert('Descrição não pode estar vazia.');
            return;
        }

        try {
            const response = await fetch('perguntas.php?action=edit', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id, descricao: novaDescricao }),
            });

            const result = await response.json();

            if (result.error) {
                console.error('Erro ao atualizar pergunta:', result.error);
                alert('Erro ao atualizar pergunta: ' + result.error);
                return;
            }

            alert('Pergunta atualizada com sucesso!');
            descricaoInput.value = '';
            botaoSalvar.textContent = 'Salvar';
            botaoSalvar.onclick = salvarPergunta;
            carregarPerguntas();
        } catch (error) {
            console.error('Erro ao atualizar pergunta:', error);
            alert('Erro ao atualizar pergunta. Tente novamente.');
        }
    };
}



async function editarPergunta(id) {
    const novaDescricao = prompt('Digite a nova descrição da pergunta:');
    if (!novaDescricao || !novaDescricao.trim()) {
        alert('Descrição não pode estar vazia.');
        return;
    }

    try {
        const response = await fetch('perguntas.php?action=edit', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id, descricao: novaDescricao.trim() }),
        });

        const result = await response.json();

        if (result.error) {
            console.error('Erro ao editar pergunta:', result.error);
            alert('Erro ao editar pergunta: ' + result.error);
            return;
        }

        alert('Pergunta editada com sucesso!');
        carregarPerguntas(); // Atualiza a tabela
    } catch (error) {
        console.error('Erro ao editar pergunta:', error);
        alert('Erro ao editar pergunta. Tente novamente.');
    }
}

// Inicializar ao carregar a página
document.addEventListener('DOMContentLoaded', carregarPerguntas);
document.getElementById('salvar-pergunta').addEventListener('click', salvarPergunta);
