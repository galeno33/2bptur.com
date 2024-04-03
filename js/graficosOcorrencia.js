    // Função para enviar os dados do formulário para o arquivo PHP e exibir os resultados em um gráfico de barras
    document.getElementById("formConsulta").addEventListener("submit", function(event) {
        event.preventDefault(); // Impede o envio padrão do formulário

        var formData = new FormData(this); // Obtém os dados do formulário

        fetch("../ocorrencias/graficosBairro.php", { // Envia uma requisição para o arquivo PHP
            method: "POST",
            body: formData
        })
        .then(response => response.json()) // Converte a resposta para JSON
        .then(data => {
            // Processa os resultados e cria os dados para o gráfico
            var labels = [];
            var valores = [];

            data.forEach(function(item) {
                labels.push(item.bairro_ocorrencia); // Use o nome do bairro como rótulo
                valores.push(item.total); // Use o total de ocorrências como valor
            });

            // Cria o gráfico de barras
            var ctx = document.getElementById("barChart").getContext("2d");
            var myChart = new Chart(ctx, {
                type: "bar",
                data: {
                    labels: labels,
                    datasets: [{
                        label: "Tipificações de Crime por Bairro",
                        data: valores,
                        backgroundColor: "rgba(54, 162, 235, 0.2)",
                        borderColor: "rgba(54, 162, 235, 1)",
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        })
        .catch(error => {
            console.error("Erro ao enviar requisição:", error);
        });
    });
