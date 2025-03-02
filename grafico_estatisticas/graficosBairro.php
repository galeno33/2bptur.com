<?php
        // Conexão com o banco de dados (substitua as credenciais conforme necessário)
        //$conn = new mysqli("localhost", "usuario", "senha", "nome_banco");

        // Verifica a conexão
        /*if ($conn->connect_error) {
            die("Erro de conexão: " . $conn->connect_error);
        }*/
        include('../conexao/conexao.php');

        // Obtém os dados do formulário
        $data_inicio = $_POST["data_inicio"];
        $data_fim = $_POST["data_fim"];
        $filtro_tempo = $_POST["filtro_tempo"];

        var_dump($filtro_tempo);

        
        // Prepara a consulta SQL
        if ($filtro_tempo == "mensal") {
            $sql = "SELECT MONTH(dia_mes) AS mes, bairro_ocorrencia, tipificacao_crime, COUNT(*) AS total FROM ranking WHERE dia_mes BETWEEN ? AND ? GROUP BY mes, bairro_ocorrencia, tipificacao_crime";
        } else if ($filtro_tempo == "anual") {
            $sql = "SELECT YEAR(dia_mes) AS ano, bairro_ocorrencia, tipificacao_crime, COUNT(*) AS total FROM ranking WHERE dia_mes BETWEEN ? AND ? GROUP BY ano, bairro_ocorrencia, tipificacao_crime";
        }

        // Prepara a declaração
        $stmt = $conn->prepare($sql);

        // Verifica se a preparação da consulta foi bem-sucedida
        if ($stmt === false) {
            die("Erro na preparação da consulta: " . $conn->error);
        }

        // Vincula os parâmetros à declaração
        $stmt->bind_param("ss", $data_inicio, $data_fim);

        // Executa a consulta
        $stmt->execute();

        // Obtém o resultado da consulta
        $result = $stmt->get_result();

        // Verifica se foram encontradas ocorrências
        if ($result->num_rows > 0) {
            // Retorna os resultados como JSON
            $output = [];
            while ($row = $result->fetch_assoc()) {
                $output[] = $row;
            }
            echo json_encode($output);
        } else {
            echo "Nenhuma ocorrência encontrada para o intervalo de datas especificado.";
        }

        // Fecha a declaração e a conexão
        $stmt->close();
        $conn->close();
        
?>

