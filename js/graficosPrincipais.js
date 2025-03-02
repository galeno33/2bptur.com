$(document).ready(function () {
    // Configurações para dinamizar os campos por tipo de gráfico
    const configCpam = {
        '1': ['#inputBpmNorteSelect'], // CPAM-NORTE
        '2': ['#inputBpmSulSelect'],   // CPAM-SUL
        '3': ['#inputBpmLesteSelect'], // CPAM-LESTE
        '4': ['#inputBpmOesteSelect']  // CPAM-OESTE
    };

    // Resetar todos os campos e gráficos
    const resetCampos = () => {
        // Esconde todos os selects de BPMs e reseta os valores
        Object.values(configCpam).flat().forEach(selector => $(selector).parent().hide().find('select').val(''));
        $('#grupoCrimeSelect').val(''); // Reseta o select de grupos de crimes
    };

    const resetGraficos = () => {
        // Limpar gráficos em todos os canvas
        const ctxCpam = document.getElementById("cpamBarChart")?.getContext("2d");
        const ctxUnidade = document.getElementById("unidadeBarChart")?.getContext("2d");
        const ctxGrupo = document.getElementById("grupoBarChart")?.getContext("2d");

        if (window.chartInstanceCpam) {
            window.chartInstanceCpam.destroy();
        }
        if (window.chartInstanceUnidade) {
            window.chartInstanceUnidade.destroy();
        }
        if (window.chartInstanceGrupo) {
            window.chartInstanceGrupo.destroy();
        }

        [ctxCpam, ctxUnidade, ctxGrupo].forEach(ctx => {
            if (ctx) ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
        });
    };

    const resetCards = () => {
        // Esconde todos os cards de gráficos
        $('#graficoCardCpam, #graficoCardUnidade, #graficoCardGrupo').hide();
    };

    const resetAba = () => {
        resetCampos();
        resetGraficos();
        resetCards();
    };

    // Evento para mudança de aba
    $('.nav-link').on('click', function () {
        const tabId = $(this).attr('id');
        resetAba();

        if (tabId === 'porCpam-tab') {
            $('#graficoCardCpam').hide(); // Esconde inicialmente
        } else if (tabId === 'porUnidade-tab') {
            $('#graficoCardUnidade').show();
        } else if (tabId === 'porGrupoCrime-tab') {
            $('#graficoCardGrupo').hide(); // Esconde inicialmente
        }
    });

    // Evento para mudança no CPAM selecionado
    $('#cpamsSelect').on('change', function () {
        const selectedCpam = $(this).val();
        resetCampos(); // Reseta campos ao mudar de CPAM

        if (configCpam[selectedCpam]) {
            configCpam[selectedCpam].forEach(selector => $(selector).parent().show());
        }
    });

    // Evento para mudança no select de BPMs
    $('select[id^="inputBpm"]').on('change', function () {
        const bpm = $(this).val();
        const periodo = $('input[name="exampleRadios"]:checked').val();

        if (bpm) {
            // Atualizar gráfico CPAM
            $('#graficoCardCpam').show();
            atualizarGraficoCpam(bpm, periodo);
        }
    });

    // Evento para selecionar grupo de crimes
    $('#grupoCrimeSelect').on('change', function () {
        const grupo = $(this).val();
        const periodo = $('input[name="exampleRadios"]:checked').val();

        if (grupo) {
            // Atualizar gráfico do grupo
            $('#graficoCardGrupo').show();
            atualizarGraficoGrupo(grupo, periodo);
        }
    });

    // Evento para alterar o período
    $('input[name="exampleRadios"]').on('change', function () {
        const periodo = $(this).val();

        if ($('#porUnidade').hasClass('active')) {
            atualizarGraficoUnidade(periodo);
        } else if ($('#porGrupoCrime').hasClass('active')) {
            const grupo = $('#grupoCrimeSelect').val();
            atualizarGraficoGrupo(grupo, periodo);
        } else if ($('#porCpam').hasClass('active')) {
            const bpm = $('select[id^="inputBpm"]:visible').val();
            atualizarGraficoCpam(bpm, periodo);
        }
    });

    // Funções de atualização dos gráficos
    function atualizarGraficoCpam(bpm, periodo) {
        fetch(`../grafico_estatisticas/graficoPorBpm.php?bpm=${bpm}&periodo=${periodo}`)
            .then(response => response.json())
            .then(data => {
                const ctx = document.getElementById("cpamBarChart").getContext("2d");
                if (window.chartInstanceCpam) window.chartInstanceCpam.destroy();

                window.chartInstanceCpam = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: data.map(d => d.qualificacao),
                        datasets: [{
                            data: data.map(d => d.total),
                            backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e'],
                        }]
                    },
                    options: { responsive: true }
                });
            });
    }

    function atualizarGraficoUnidade(periodo) {
        fetch(`../grafico_estatisticas/graficosCrimesCpams.php?periodo=${periodo}`)
            .then(response => response.json())
            .then(data => {
                const ctx = document.getElementById("unidadeBarChart").getContext("2d");
                if (window.chartInstanceUnidade) window.chartInstanceUnidade.destroy();

                window.chartInstanceUnidade = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.map(d => d.bpm),
                        datasets: [{
                            data: data.map(d => d.total),
                            backgroundColor: ['#FF0000', '#FFA07A', '#00FF7F', '#4e73df', '#00FFFF'],
                        }]
                    },
                    options: { responsive: true }
                });
            });
    }

    function atualizarGraficoGrupo(grupo, periodo) {
        fetch(`../grafico_estatisticas/graficoPorGrupo.php?grupo=${grupo}&periodo=${periodo}`)
            .then(response => response.json())
            .then(data => {
                const ctx = document.getElementById("grupoBarChart").getContext("2d");
                if (window.chartInstanceGrupo) window.chartInstanceGrupo.destroy();

                window.chartInstanceGrupo = new Chart(ctx, {
                    type: 'polarArea',
                    data: {
                        labels: data.map(d => d.tipo),
                        datasets: [{
                            data: data.map(d => d.total),
                            backgroundColor: ['#DC143C', '#FFA07A', '#00FF7F', '#4e73df', '#2E8B57'],
                        }]
                    },
                    options: { responsive: true }
                });
            });
    }
});
