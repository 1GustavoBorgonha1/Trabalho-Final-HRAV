document.addEventListener("DOMContentLoaded", () => {
    const usuariosTable = document.getElementById("usuariosTable").querySelector("tbody");
    const usuarioInput = document.getElementById("usuario");
    const senhaInput = document.getElementById("senha");
    const usuarioIdInput = document.createElement("input");
    usuarioIdInput.type = "hidden";
    document.body.appendChild(usuarioIdInput);

    function carregarUsuarios() {
        fetch("usuarios.php?action=fetch")
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    console.error("Erro ao carregar usuários:", data.error);
                    return;
                }
                usuariosTable.innerHTML = "";
                data.forEach(usuario => {
                    const row = usuariosTable.insertRow();
                    row.innerHTML = `
                        <td>${usuario.cd_usuario}</td>
                        <td>${usuario.usuario}</td>
                        <td>${usuario.status === '1' ? 'Ativo' : 'Inativo'}</td>
                        <td class="action-buttons">
                            <button class="edit-btn" onclick="editarUsuario(${usuario.cd_usuario}, '${usuario.usuario}')">Editar</button>
                            <button class="deactivate-btn" onclick="alterarStatus(${usuario.cd_usuario}, '${usuario.status === '1' ? '0' : '1'}')">${usuario.status === '1' ? 'Desativar' : 'Ativar'}</button>
                        </td>
                    `;
                });
            })
            .catch(error => console.error("Erro ao carregar usuários:", error));
    }

    function salvarUsuario() {
        const usuario = usuarioInput.value.trim();
        let senha = senhaInput.value.trim();

        // Limite a senha a 8 caracteres
        if (senha.length > 8) {
            alert("A senha deve ter no máximo 8 caracteres.");
            return;
        }

        const id = usuarioIdInput.value || null;

        if (!usuario || !senha) {
            alert("Por favor, preencha o nome de usuário e a senha.");
            return;
        }

        const action = id ? "edit" : "add";
        fetch(`usuarios.php?action=${action}`, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ id, usuario, senha })
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error("Erro ao salvar usuário:", data.error);
                alert("Erro ao salvar usuário: " + data.error);
                return;
            }
            alert(data.message);
            carregarUsuarios();
            usuarioInput.value = "";
            senhaInput.value = "";
            usuarioIdInput.value = "";
        })
        .catch(error => console.error("Erro ao salvar usuário:", error));
    }

    window.editarUsuario = (id, usuario) => {
        usuarioInput.value = usuario;
        senhaInput.value = "";
        usuarioIdInput.value = id;
    };

    window.alterarStatus = (id, status) => {
        fetch("usuarios.php?action=toggleStatus", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ id, status })
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error("Erro ao alterar status do usuário:", data.error);
                alert("Erro ao alterar status do usuário: " + data.error);
                return;
            }
            alert(data.message);
            carregarUsuarios();
        })
        .catch(error => console.error("Erro ao alterar status do usuário:", error));
    };

    carregarUsuarios();
    document.getElementById("salvar").addEventListener("click", salvarUsuario);
});
