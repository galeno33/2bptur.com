<?php
    //include('../conexao/conexao.php');
    require_once('../conexao/conexao_01.php');
    
    $conexao = new Conexao();
    $conn = $conexao->getConexao();
    
    if(isset($_POST['salvar'])){
        if(empty($_POST['suaMatricula']) || empty($_POST['matriculaPermutado']) || empty($_POST['data_fim'])){
            echo "Preencha todos os dados";
        }else {
            $suaMatr = $_POST['suaMatricula'];
            $matrPermutado = $_POST['matriculaPermutado'];
            $dia_permuta = $_POST['data_fim'];
            //$confirme = ($_POST['flexRadioDefault'] == 1) ? "Sim" : "Não";
            $confirme = "Não confirmado";
            //$autorizacao = ($_POST['flexRadioDefault1'] == 1) ? "Sim" : "Não";
            $autorizacao = "Em análise";
            $justificativa = $_POST['justificativa'];

            $stmt = $conn->prepare("INSERT INTO permutas (matr_permutante, matr_permutado, dia_permuta, aceito_permuta, autorizacao_permuta, justificativa)
                                    VALUE (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("iissss", $suaMatr, $matrPermutado, $dia_permuta, $confirme, $autorizacao, $justificativa);

            if($stmt->execute()){
               //echo "permuta feita!";
               echo "<script>alert('Pedido de Permuta Concluida com Sucesso!'); window.location.href='pedirPermutas.php';</script>";
               //header('Location: https://2bptur.com/confirmPermuta.php');
            }else{
                echo "Erro ao executar a permuta: " .$stmt->error;
                //header('Location: https://2bptur.com/home.php/');
            }
            $stmt->close();
        }
    
    }

?>