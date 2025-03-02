
/*document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('gerarTokenButton').addEventListener('click', function() {
        fetch('../token/token.php', {
            method: 'POST'
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro na solicitação ao servidor');
            }
            return response.json();
        })
        .then(data => {
            alert('Token gerado: ' + data.token); // Para teste, exiba o token
            // Pode enviar o token via SMS, email, etc.
        })
        .catch(error => console.error('Erro:', error));
    });

    /*document.getElementById('inputToken').addEventListener('input', function() {
        var tokenInput = document.getElementById('inputToken').value;
        var submitButton = document.getElementById('butaoVisivel');
        
        fetch('../token/validar_token.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ token: tokenInput })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro na solicitação ao servidor');
            }
            return response.json();
        })
        .then(data => {
            if (data.valid) {
                submitButton.style.display = 'block';
            } else {
                submitButton.style.display = 'none';
            }
        })
        .catch(error => console.error('Erro:', error));
    });*/
//});
document.addEventListener('DOMContentLoaded', function() {
    const gerarTokenButton = document.getElementById('gerarTokenButton');

    gerarTokenButton.addEventListener('click', function() {
        fetch('../token/token.php', {
            method: 'POST'
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro na solicitação ao servidor');
            }
            return response.json();
        })
        /*.then(data => {
            if (data.error) {
                alert('Erro: ' + data.error);
            } else {
                const tokenDisplay = document.querySelector('.token-display'); // Seleciona o elemento para exibir o token
                tokenDisplay.textContent = data.token;
            }
        })
        .catch(error => console.error('Erro:', error));*/
    });
});