    let contador = 1; // Começa com 1 porque mtr1 já está visível
    const totalCampos = 4; // Total de campos disponíveis

    function adicionarMatricula() {
        if (contador < totalCampos) {
            contador++;
            document.getElementById(`mtr${contador}`).style.display = "block";
        }
    }

    function removerMatricula() {
        if (contador > 1) {
            document.getElementById(`inputMatricula${contador}`).value = ""; // Limpa o campo antes de ocultar
            document.getElementById(`mtr${contador}`).style.display = "none";
            contador--;
        }
    }
