<?php
        // Conexão com o banco de dados (substitua as credenciais conforme necessário)
        include('../conexao/conexao.php');
        //session_start();
        // Verifica se o formulário foi enviado
       if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Conexão com o banco de dados (substitua as credenciais conforme necessário)
            // Obtém as datas do formulário
            $data_inicio = $_POST["data_inicio"];
            $data_fim = $_POST["data_fim"];
        
            // Prepara a consulta SQL para obter a quantidade de cada tipificação de crime no intervalo de datas
            $sql = "SELECT tipificacao_crime, COUNT(*) AS total FROM ranking WHERE dia_mes BETWEEN ? AND ? GROUP BY tipificacao_crime";
        
            // Prepara a declaração SQL
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
        
            // Inicializa um array para armazenar os resultados
            $results_array = [];
        
            // Verifica se foram encontradas ocorrências
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Adiciona os resultados ao array
                    switch($row["tipificacao_crime"]){
                        case 1:
                            $row["tipificacao_crime"] = "Furto";
                            break;
                        case 2:
                            $row["tipificacao_crime"] = "roubo";
                            break;
                        case 3:
                            $row["tipificacao_crime"] = "Receptação";
                            break;
                        case 4:
                            $row["tipificacao_crime"] = "Arma de fogo";
                            break;
                        case 5:
                            $row["tipificacao_crime"] = "Objeto Perfurocortante";
                            break;
                        case 6:
                            $row["tipificacao_crime"] = "Entorpecentes";
                            break;
                        case 7:
                            $row["tipificacao_crime"] = "Veiculo Recuperado";
                            break;
                        case 8:
                            $row["tipificacao_crime"] = "Kadron Recuperado";
                            break;
                        case 9:
                            $row["tipificacao_crime"] = "Foragido";
                            break;
                        case 10:
                            $row["tipificacao_crime"] = "Outras Tipificações";
                    }


                    $results_array[] = $row; //['tipificacao_crime'] . ":" . $row['total']; // analisar a linha de codigo
                }
            }
        
            // Fecha a declaração e a conexão
            $stmt->close();
            $conn->close();
        
            // Retorna os resultados como JSON
            echo json_encode($results_array);
        }
?>

