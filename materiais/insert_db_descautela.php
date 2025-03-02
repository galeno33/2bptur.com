<?php
     session_start();
     ob_start();
     $usuario = $_SESSION['matricula'];
     $id = $_SESSION['id_detalhes'];
     include('../conexao/conexao.php');

     $buscarToken = '';//inicializa o token
    if (isset($_SESSION['tokenDescautela'])) {
     
         // Selecionar o usuário
         $sql = "SELECT id, token_confirmacao, telefone_usuario FROM usuario WHERE id = ? LIMIT 1";
         $stmt = $conn->prepare($sql);
         $stmt->bind_param("i", $usuario);
         $stmt->execute();
         $result = $stmt->get_result();
         $row = $result->fetch_assoc();
         $buscarToken = $row['token_confirmacao'];
     // $_SERVER['REQUEST_METHOD'] === 'POST' && 
         if (isset($_POST['salvar'])) {
             $dataEntrega = $_POST['dataEntrega'];
             $chave = $_POST['inputchave'];
             $dataCautela = $_POST['dataCautela'];
             $cautela = $_POST['matricula'];
             //***********teste de retorna *********/
                //var_dump($cautela);
            //**************************************/
            $dataEntrega = date('Y-m-d', strtotime($dataEntrega));
            if ($chave == $buscarToken) {
                 //*****teste de depuração*******
                 var_dump($id);
                // Atualizar a tabela cautela
                $sql = "UPDATE cautela SET matricula_armeiro = ?, data_entrega = ? WHERE id_cautela = ? AND matricula_cautela = ? LIMIT 1";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("isii", $usuario, $dataEntrega, $id, $cautela);
                $stmt->execute();
     
                 // Atualizar o token no banco de dados
                 $chaveToken = NULL;
                 $sqlUpdate = "UPDATE usuario SET token_confirmacao = ? WHERE id = ? LIMIT 1";
                 $stmt = $conn->prepare($sqlUpdate);
                 $stmt->bind_param("ii", $chaveToken, $usuario);
                 $stmt->execute();
     
                 // Limpar o token após a utilização
                 //unset($buscarToken);
                 
                 //Implementar envio de resposta da devolução do material
     
                 echo "<script>alert('Devolução concluída com sucesso!'); window.location.href='https://2bptur.com/materiais/materiais_cautelados.php';</script>";
                 
            } else {
                    echo "<script>alert('Chave invalida ou expirada!'); window.location.href='https://2bptur.com/materiais/materiais_cautelados.php';</script>";
                 //echo "Token inválido ou expirado.";
            }
         }
    } else {
          echo "<script>alert('Chave invalida ou expirada!'); window.location.href='https://2bptur.com/materiais/materiais_cautelados.php';</script>";
         //echo "Token inválido ou expirado.";
    }
         
   


?>