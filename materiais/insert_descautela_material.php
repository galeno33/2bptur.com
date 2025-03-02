<?php
     /******Desenvolvido por Fabio Galeno******/
     /******Atualização dia 19/11/2024******/
     /******Atualização dia 23/11/2024******/
     require_once('../conexao/conexao_01.php');
     require_once('../usuario/restricaoUsuarios.php');
     //instaciar conexao com BD MYSQL
     $conexao = new Conexao();
     $conn = $conexao->getConexao();
     $restringir = new RestricaoDeUsuario();
     $restringir->restricao();
     $matricula = $restringir->getIdUsuario();
     /*
     session_start();
     ob_start();
     $usuario = $_SESSION['matricula'];
     $id = $_SESSION['id_detalhes'];
     include('../conexao/conexao.php');*/

     $buscarToken = '';//inicializa o token
    if (isset($_POST['salvar'])) {

          $chave = $_POST['inserirChave'];
          $dataCautela = $_POST['dataCautela'];
          $cautelante = $_POST['matricula'];
          $material = $_POST['material'];

          // Definir o fuso horário para Brasília
          date_default_timezone_set('America/Sao_Paulo');
          // Obter a data atual no formato desejado
          $dataEntrega = date('Y-m-d'); // Formato: Ano-Mês-Dia (YYYY-MM-DD)

         // Selecionar o usuário
         $sql = "SELECT id, token_confirmacao FROM usuario WHERE id = ? LIMIT 1";
         $stmt = $conn->prepare($sql);
         $stmt->bind_param("i", $matricula);
         $stmt->execute();
         $result = $stmt->get_result();
         $row = $result->fetch_assoc();
         $buscarToken = $row['token_confirmacao'];
     // $_SERVER['REQUEST_METHOD'] === 'POST' && 
         //if (isset($_POST['salvar'])) {
             
             //***********teste de retorna *********/
                //var_dump($cautela);
            //**************************************/
            //$dataEntrega = date('Y-m-d', strtotime($dataEntrega));
            if ($chave === $buscarToken) {
                 //*****teste de depuração*******
                // var_dump($id);
                // Atualizar a tabela cautela
                $sql = "UPDATE cautela SET matricula_armeiro = ?, data_entrega = ? WHERE material = ? AND matricula_cautela = ? AND data_cautela = ? LIMIT 1";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("issis", $matricula, $dataEntrega, $material, $cautelante, $dataCautela);
                $stmt->execute();
     
                 // Atualizar o token no banco de dados
                 $chaveToken = NULL;
                 $sqlUpdate = "UPDATE usuario SET token_confirmacao = ? WHERE id = ? LIMIT 1";
                 $stmt = $conn->prepare($sqlUpdate);
                 $stmt->bind_param("si", $chaveToken, $matricula);
                 $stmt->execute();
     
                 // Limpar o token após a utilização
                 //unset($buscarToken);
                 
                 //Implementar envio de resposta da devolução do material
     
                 echo "<script>alert('Devolução concluída com sucesso!'); window.location.href='../p4/materiais_cautelados.php';</script>";
                 
            } else {
                    echo "<script>alert('Chave invalida ou expirada!'); window.location.href='../p4/materiais_cautelados.php';</script>";
                 //echo "Token inválido ou expirado.";
            }
         //}
    } else {
          echo "<script>alert('Chave invalida ou expirada!'); window.location.href='../p4/materiais_cautelados.php';</script>";
         //echo "Token inválido ou expirado.";
    }
         
   


?>