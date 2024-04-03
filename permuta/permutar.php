<?php
    include('../conexao/conexao.php');

    if(isset($_POST['salvar'])){
        if(empty($_POST['suaMatricula']) || empty($_POST['matriculaPermutado']) || empty($_POST['data_fim'])){
            echo "Preencha todos os dados";
        }else {
            $suaMatr = $_POST['suaMatricula'];
            $matrPermutado = $_POST['matriculaPermutado'];
            $dia_permuta = $_POST['data_fim'];
            $confirme = ($_POST['flexRadioDefault'] == 1) ? "Sim" : "Não";
            $justificativa = $_POST['justificativa'];

            $stmt = $conn->prepare("INSERT INTO permutas (matr_permutante, matr_permutado, dia_permuta, aceito_permuta, justificativa)
                                    VALUE (?, ?, ?, ?, ?)");
            $stmt->bind_param("iisss", $suaMatr, $matrPermutado, $dia_permuta, $confirme, $justificativa);

            if($stmt->execute()){
               //echo "permuta feita!";
               header('Location: https://2bptur.com/home.php/confirmPermuta');
            }else{
                echo "Erro ao executar a permuta: " .$stmt->error;
                //header('Location: https://2bptur.com/home.php/');
            }
            $stmt->close();
        }
    
    }

?>