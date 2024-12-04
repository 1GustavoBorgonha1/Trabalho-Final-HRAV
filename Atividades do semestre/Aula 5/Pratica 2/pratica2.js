function adicionarLinhaTotalizadora() {
    const tabela = document.getElementById('tabelaNotas');
    const tbody = tabela.querySelector('tbody');
    
    // Verifica se a linha totalizadora já existe
    if (tbody.querySelector('.total-row')) {
        alert('Linha totalizadora já foi adicionada.');
        return;
    }

    const linhas = Array.from(tbody.getElementsByTagName('tr'));
    const totalNotas = Array(9).fill(0); // Array para somar as notas
    
    linhas.forEach(linha => {
        const celulas = linha.getElementsByTagName('td');
        for (let i = 1; i < celulas.length; i++) {
            const valor = parseFloat(celulas[i].innerText.replace(',', '.')) || 0;
            totalNotas[i - 1] = (totalNotas[i - 1] || 0) + valor;
        }
    });

    const numAlunos = linhas.length;

    // Calcula a média
    const mediaNotas = totalNotas.map(total => (total / numAlunos).toFixed(2));

    // Cria a nova linha totalizadora
    const novaLinha = document.createElement('tr');
    novaLinha.classList.add('total-row');
    novaLinha.innerHTML = '<td>Média</td>' +
        mediaNotas.map(media => `<td>${media}</td>`).join('');

    tbody.appendChild(novaLinha);
}

function adicionarColunaTotalizadora() {
    const tabela = document.getElementById('tabelaNotas');
    const thead = tabela.querySelector('thead');
    const tbody = tabela.querySelector('tbody');
    const numSemestres = 3; // Número de semestres
    const numNotasPorSemestre = 3; // Número de notas por semestre
    const numTotalNotas = numSemestres * numNotasPorSemestre;

    // Adiciona o cabeçalho da coluna totalizadora
    const cabecalho = thead.querySelector('tr:last-of-type');
    const novaCelula = document.createElement('th');
    novaCelula.innerText = 'Média';
    cabecalho.appendChild(novaCelula);

    // Adiciona a nova coluna a cada linha do corpo da tabela
    const linhas = Array.from(tbody.getElementsByTagName('tr'));

    linhas.forEach(linha => {
        const celulas = linha.getElementsByTagName('td');
        const somaNotas = Array(numTotalNotas).fill(0);
        let contadorNotas = 0;
        for (let i = 1; i < celulas.length; i++) {
            const valor = parseFloat(celulas[i].innerText.replace(',', '.')) || 0;
            somaNotas[i - 1] = (somaNotas[i - 1] || 0) + valor;
            contadorNotas++;
        }
        const mediaAluno = contadorNotas > 0 ? (somaNotas.reduce((a, b) => a + b, 0) / contadorNotas).toFixed(2) : 'N/A';
        const novaCelula = document.createElement('td');
        novaCelula.innerText = mediaAluno;
        linha.appendChild(novaCelula);
    });
}
