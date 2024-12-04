document.addEventListener("DOMContentLoaded", () => {
    const dispositivosTable = document.getElementById("dispositivosTable").querySelector("tbody");
    const nomeInput = document.getElementById("nome");
    const setorSelect = document.getElementById("setor");
    const dispositivoIdInput = document.getElementById("dispositivoId"); // Adicione este campo hidden no HTML para armazenar o ID ao editar

    // Função para carregar setores no dropdown
    function carregarSetores() {
        fetch("dispositivos.php?action=fetch_setores")
            .then(response => response.json())
            .then(data => {
                setorSelect.innerHTML = '<option value="">Selecione um setor</option>';
                data.forEach(setor => {
                    const option = document.createElement("option");
                    option.value = setor.cd_setor;
                    option.textContent = setor.desc_setor;
                    setorSelect.appendChild(option);
                });
            })
            .catch(error => console.error("Erro ao carregar setores:", error));
    }

    // Função para carregar dispositivos
    function carregarDispositivos() {
        fetch("dispositivos.php?action=fetch")
            .then(response => {
                if (!response.ok) {
                    throw new Error("Erro na resposta do servidor");
                }
                return response.json();
            })
            .then(data => {
                if (data.error) {
                    console.error("Erro ao carregar dispositivos:", data.error);
                    return;
                }
                
                dispositivosTable.innerHTML = ""; // Limpa a tabela
                data.forEach(dispositivo => {
                    const row = dispositivosTable.insertRow();
                    row.innerHTML = `
                        <td>${dispositivo.cd_dispositivo}</td>
                        <td>${dispositivo.nome}</td>
                        <td>${dispositivo.setor || 'Sem setor'}</td>
                        <td>${dispositivo.status === '1' ? 'Ativo' : 'Inativo'}</td>
                        <td class="action-buttons">
                            <button class="edit-btn" onclick="editarDispositivo(${dispositivo.cd_dispositivo}, '${dispositivo.nome}', ${dispositivo.cd_setor || 'null'})">Editar</button>
                            <button class="deactivate-btn" onclick="alterarStatus(${dispositivo.cd_dispositivo}, '${dispositivo.status === '1' ? '0' : '1'}')">${dispositivo.status === '1' ? 'Desativar' : 'Ativar'}</button>
                        </td>
                    `;
                });
            })
            .catch(error => console.error("Erro ao carregar dispositivos:", error));
    }

    // Função para salvar o dispositivo
    function salvarDispositivo() {
        const nome = nomeInput.value.trim();
        const setor = setorSelect.value;
        const id = dispositivoIdInput ? dispositivoIdInput.value : null;

        // Verifique se o nome e setor estão preenchidos
        if (!nome || !setor) {
            alert("Por favor, preencha o nome e selecione um setor.");
            return;
        }

        const action = id ? "edit" : "add";
        fetch(`dispositivos.php?action=${action}`, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
                id: id || null,
                nome: nome,
                setor: setor,
            }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error("Erro ao salvar dispositivo:", data.error);
                alert("Erro ao salvar dispositivo: " + data.error);
                return;
            }
            alert(data.message);
            carregarDispositivos();
            nomeInput.value = "";
            setorSelect.value = "";
            if (dispositivoIdInput) {
                dispositivoIdInput.value = ""; // Limpa o campo hidden ao finalizar a edição
            }
        })
        .catch(error => console.error("Erro ao salvar dispositivo:", error));
    }

    // Função para editar o dispositivo
    window.editarDispositivo = (id, nome, setor) => {
        nomeInput.value = nome;
        setorSelect.value = setor;
        if (dispositivoIdInput) {
            dispositivoIdInput.value = id; // Armazena o ID no campo hidden para identificar a edição
        }
    };

    // Função para ativar/desativar o dispositivo
    window.alterarStatus = (id, status) => {
        fetch(`dispositivos.php?action=toggleStatus`, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ id, status }),
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            carregarDispositivos();
        })
        .catch(error => console.error("Erro ao alterar status do dispositivo:", error));
    };

    // Carregar setores e dispositivos ao carregar a página
    carregarSetores();
    carregarDispositivos();

    // Adicione o evento de clique ao botão "Salvar"
    document.getElementById("salvar").addEventListener("click", salvarDispositivo);
});
