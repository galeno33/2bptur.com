document.getElementById('token-link').addEventListener('click', function (event) {
    event.preventDefault(); // Evita o comportamento padrão do link

    // Captura o valor do token
    var tokenValue = document.getElementById('token-value').innerText;

    // Insere o valor no campo de entrada
    document.getElementById('chave').value = tokenValue;
});