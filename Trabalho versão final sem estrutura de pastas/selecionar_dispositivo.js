async function carregarDispositivos() {
    try {
        const response = await fetch('get_dispositivos.php');
        const data = await response.json();

        if (data.error) {
            console.error('Erro recebido da API:', data.error);
            alert('Erro ao carregar dispositivos: ' + data.error);
            return;
        }

        console.log('Dispositivos carregados:', data);
        const dispositivoSelect = document.getElementById('dispositivo');
        dispositivoSelect.innerHTML = ''; // Limpa as opções iniciais

        data.dispositivos.forEach(dispositivo => {
            const option = document.createElement('option');
            option.value = JSON.stringify({
                cd_dispositivo: dispositivo.cd_dispositivo,
                cd_setor: dispositivo.cd_setor,
            });
            option.textContent = dispositivo.nome;
            dispositivoSelect.appendChild(option);
        });
    } catch (error) {
        console.error('Erro ao carregar dispositivos:', error);
        alert('Erro ao carregar dispositivos. Verifique sua conexão.');
    }
}

document.getElementById('enviarDispositivo').addEventListener('click', () => {
    const selectedValue = document.getElementById('dispositivo').value;
    if (!selectedValue) {
        alert('Selecione um dispositivo antes de continuar.');
        return;
    }

    const { cd_dispositivo, cd_setor } = JSON.parse(selectedValue);

    localStorage.setItem('dispositivoSelecionado', cd_dispositivo);
    localStorage.setItem('setorSelecionado', cd_setor);

    window.location.href = 'pergunta.html';
});

// Inicia o carregamento dos dispositivos ao carregar a página
carregarDispositivos();
