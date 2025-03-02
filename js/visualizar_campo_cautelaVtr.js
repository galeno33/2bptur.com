document.getElementById("IdMotorista").addEventListener("input", function () {
    const motoristaInput = document.getElementById("IdMotorista");
    const companhiaDiv = document.getElementById("companhia");

    // Verifica se o campo motorista tem pelo menos 5 dígitos
    if (motoristaInput.value.length >= 5) {
        companhiaDiv.style.display = "block"; // Torna a div companhia visível
    } else {
        companhiaDiv.style.display = "none"; // Oculta a div companhia
    }
});

document.getElementById("inputCia").addEventListener("change", function () {
    const areaAtualizaDiv = document.getElementById("areaAtualiza");

    // Verifica se uma opção foi selecionada no select
    if (this.value !== "Cia") {
        areaAtualizaDiv.style.display = "block"; // Torna a div área de atuação visível
    } else {
        areaAtualizaDiv.style.display = "none"; // Oculta a div área de atuação
    }
});

document.getElementById("areaAtuacao").addEventListener("input", function () {
    const areaAtuacaoInput = document.getElementById("areaAtuacao");
    const dataCautelaDiv = document.getElementById("dataCautela");
    const abrirModalDiv = document.getElementById("abrirModal");

    // Verifica se o campo Área de atuação foi preenchido
    if (areaAtuacaoInput.value.trim().length > 0) {
        dataCautelaDiv.style.display = "block"; // Torna a div data de cautela visível
        abrirModalDiv.style.display = "block"; // Torna o botão Gerar Chave visível
    } else {
        dataCautelaDiv.style.display = "none"; // Oculta a div data de cautela
        abrirModalDiv.style.display = "none"; // Oculta o botão Gerar Chave
    }
});