// Função para verificar os parâmetros da URL
function getUrlParameter(name) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
}

// Verifica se o parâmetro "erro" está presente e exibe o pop-up de erro
if (getUrlParameter('erro') === '1') {
    alert("Usuário ou senha incorretos!");
}
