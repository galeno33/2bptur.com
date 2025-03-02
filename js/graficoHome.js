const ctx = document.getElementById('cpamBarChart').getContext('2d');

        // Mapear os números dos meses para os nomes dos meses
        const nomesMeses = {
            1: 'Janeiro', 2: 'Fevereiro', 3: 'Março', 4: 'Abril', 5: 'Maio', 6: 'Junho',
            7: 'Julho', 8: 'Agosto', 9: 'Setembro', 10: 'Outubro', 11: 'Novembro', 12: 'Dezembro'
        };

        // Obter os dados do PHP
        fetch('../grafico_estatisticas/graficoCpamData.php')
            .then(response => response.json())
            .then(data => {
                if (!data || data.length === 0) {
                    console.error('Nenhum dado encontrado.');
                    return;
                }

                // Ordenar os meses registrados e mapear para os nomes
                const mesesRegistrados = [...new Set(data.flatMap(item => item.valores.map(v => v.mes)))].sort((a, b) => a - b);
                const mesesLabels = mesesRegistrados.map(m => nomesMeses[m]); // Substitui números pelos nomes dos meses

                // Criar datasets para cada CPAM
                const datasets = data.map((item, index) => {
                    const valores = mesesRegistrados.map(mes => {
                        const registroMes = item.valores.find(v => v.mes === mes);
                        return registroMes ? registroMes.total : 0; // Se não houver valor, retorna 0
                    });

                    return {
                        label: `CPAM-${item.cpam}`, // Nome do CPAM
                        data: valores, // Valores por mês
                        borderColor: ['#FF5733', '#33FF57', '#3357FF', '#FFC300'][index % 4], // Cores diferentes para cada CPAM
                        borderWidth: 2,
                        fill: false,
                        tension: 0.3, // Suaviza as linhas
                    };
                });

                // Configuração do gráfico
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: mesesLabels, // Meses no eixo X
                        datasets: datasets,
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'left',
                            },
                            tooltip: {
                                callbacks: {
                                    label: function (context) {
                                        return `CPAM-${context.dataset.label}: ${context.raw} mortes`;
                                    },
                                },
                            },
                            title: {
                                display: true,
                                text: 'Número de Mortes Intencionais por CPAM e Mês',
                            },
                        },
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Meses',
                                },
                                ticks: {
                                    autoSkip: false,
                                },
                                beginAtZero: true,
                            },
                            y: {
                                type: 'linear',
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Número de Mortes',
                                },
                                grid: {
                                    drawBorder: false,
                                },
                            },
                        },
                    },
                });
            })
            .catch(error => console.error('Erro ao carregar os dados:', error));