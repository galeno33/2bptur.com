<?php
    include('../conexao/conexao.php');

    if (isset($_POST['salvar'])) {
        if (empty($_POST['suaMatricula']) || empty($_POST['dataPermuta'])) {
            echo "Preencha todos os dados!";
        } else {
            $matriculaPermuta = $_POST['suaMatricula'];
            $dataPermuta = $_POST['dataPermuta'];
            $aceito = ($_POST['flexRadioDefault'] == 1) ? "Sim" : "Não";
            //$aceito = isset($_POST['flexRadioDefault']) ? $_POST['flexRadioDefault'] : 2; // Valor padrão para "Não"
    
            // Defina constantes para "Sim" e "Não"
           /* define('SIM', 'Sim');
            define('NAO', 'Não');*/
    
            // Use prepared statements para evitar injeção de SQL
            $stmt = $conn->prepare("INSERT INTO agenda_permuta (matr_permutante, dia_agenda, aceito_permuta) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $matriculaPermuta, $dataPermuta, $aceito);
    
            // Verifique se a execução da consulta foi bem-sucedida
            if ($stmt->execute()) {
                //echo "Permuta feita!";
                header('Location: https://2bptur.com/home.php/pedirPermutas.php');
            } else {
                echo "Erro ao executar a permuta: " . $stmt->error;
            }
    
            // Feche a declaração
            $stmt->close();
        }
    }

?>