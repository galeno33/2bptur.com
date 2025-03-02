<?php
    //include('../conexao/conexao.php');
    include('../conexao/conexao_01.php');
    include('Permuta.php');
    include('PermutaController.php');

    if (isset($_POST['salvar'])) {
        if (empty($_POST['suaMatricula']) || empty($_POST['matriculaPermutado']) || empty($_POST['data_fim'])) {
            echo "Preencha todos os dados";
        } else {
            $suaMatr = $_POST['suaMatricula'];
            $matrPermutado = $_POST['matriculaPermutado'];
            $dataFim = $_POST['data_fim'];
            $justificativa = $_POST['justificativa'];

            $conexao = new Conexao();
            $conn = $conexao->getConexao();

            $permuta = new Permuta($suaMatr, $matrPermutado, $dataFim, $justificativa);
            $permutaController = new PermutaController($conn);

            $permutaController->salvarPermuta($permuta);
        }
    }

?>