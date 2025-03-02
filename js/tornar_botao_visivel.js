
document.getElementById('inputToken').addEventListener('input', function () {
    var numberInput = document.getElementById('inputToken');
    var submitButton = document.getElementById('butaoVisivel');
    var submitToken = document.getElementById('butaoToken');

    // Verifica se o campo está preenchido com exatamente 6 dígitos
    if (numberInput.value.length === 6) {
        submitButton.style.display = 'block';
        submitToken.style.display = 'none';
    } else {
        submitButton.style.display = 'none';
        submitToken.style.display = 'block';
    }
});