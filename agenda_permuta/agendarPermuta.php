<?php

    //include('../conexao/conexao.php');
    include('../conexao/conexao_01.php');
    include('agenda.php');
    include('agendaController.php');

    if (isset($_POST['salvar'])) {
        if (empty($_POST['suaMatricula']) || empty($_POST['dataPermuta'])) {
            echo "Preencha todos os dados!";
        } else {
            $matriculaPermuta = $_POST['suaMatricula'];
            $dataPermuta = $_POST['dataPermuta'];

            $conexao = new Conexao();
            $conn = $conexao->getConexao();
            
            $agendar = new Agenda($matriculaPermuta, $dataPermuta);
            $permutaController = new PermutaController($conn);

            $permutaController->salvarPermuta($agendar);
        }
    }


?>