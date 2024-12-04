document.addEventListener("DOMContentLoaded", () => {
    const formSetor = document.querySelector(".form-setor");
    const descricaoInput = document.getElementById("descricao");
    const setoresTable = document.getElementById("setoresTable").querySelector("tbody");

    // Função para carregar setores
    function carregarSetores() {
        fetch("setores.php?action=fetch")
            .then(response => response.json())
            .then(data => {
                setoresTable.innerHTML = "";
                data.forEach(setor => {
                    const row = setoresTable.insertRow();
                    row.innerHTML = `
                        <td>${setor.cd_setor}</td>
                        <td>${setor.desc_setor}</td>
                        <td>${setor.status === '1' ? 'Ativo' : 'Inativo'}</td>
                        <td class="action-buttons">
                            <button class="edit-btn" onclick="editarSetor(${setor.cd_setor}, '${setor.desc_setor}')">Editar</button>
                            <button class="deactivate-btn" onclick="alterarStatus(${setor.cd_setor}, '${setor.status === '1' ? '0' : '1'}')">
                                ${setor.status === '1' ? 'Desativar' : 'Ativar'}
                            </button>
                        </td>
                    `;
                });
            })
            .catch(error => console.error('Erro ao carregar setores:', error));
    }

    // Função para enviar o formulário
    document.getElementById("salvar").addEventListener("click", event => {
        event.preventDefault();
        const action = descricaoInput.dataset.id ? "edit" : "add";
        fetch(`setores.php?action=${action}`, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
                id: descricaoInput.dataset.id || null,
                descricao: descricaoInput.value,
            }),
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            carregarSetores(); // Atualiza a lista de setores após salvar
            descricaoInput.value = ""; // Limpa o campo de entrada
            descricaoInput.removeAttribute("data-id");
        })
        .catch(error => console.error('Erro ao salvar setor:', error));
    });

    // Função para editar o setor
    window.editarSetor = (id, descricao) => {
        descricaoInput.value = descricao;
        descricaoInput.dataset.id = id;
    };

    // Função para ativar/desativar o setor
    window.alterarStatus = (id, status) => {
        const actionText = status === '1' ? 'ativar' : 'desativar';
        if (confirm(`Deseja realmente ${actionText} este setor?`)) {
            fetch(`setores.php?action=toggleStatus`, {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ id, status }),
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                carregarSetores();
            })
            .catch(error => console.error('Erro ao alterar status do setor:', error));
        }
    };

    // Carregar setores ao carregar a página
    carregarSetores();
});
