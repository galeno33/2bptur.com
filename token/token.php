<?php
    require_once('../conexao/conexao_01.php');

    $conexao = new Conexao();
    $conn = $conexao->getConexao();
    
    session_start();//iniciar sessão
    //ob_start();//limpar o buffer de saida
    include_once('../conexao/conexao.php'); // Conexão com o banco de dados
   // $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
    
        // Verificar se o botão "Cautelar material" foi pressionado
        if (isset($_POST['enviaToken'])) {
        
            // Gerar token aleatório de 6 dígitos
            $token = rand(100000, 999999);
        
            // Armazenar token e timestamp em variáveis de sessão
            $_SESSION['token'] = $token;
            $_SESSION['timestamp'] = time();
        
            // Obter número de telefone do usuário
            $matricula = $_POST['matricula'];
            /* teste de depuração */
            //var_dump($token, $matricula);
            
            /*  fim da depuração*/
            
            //atualizar a chave no banco de dados
            $sqlUpdate = "UPDATE usuario SET token_confirmacao = ? WHERE id = ? LIMIT 1";
            
            //$result_up_usuario = $conn->prepare($sqlUpdate);
            $result_up_usuario = $conn->prepare($sqlUpdate);
            $result_up_usuario->bind_param('ii', $token, $matricula);
            $result_up_usuario->execute();
            //$result_up_usuario->execute();
            
            //select do usuario
            $sql = "SELECT id, token_confirmacao, telefone_usuario, unidade_usuario  
                    FROM usuario 
                    WHERE id = '$matricula' LIMIT 1";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $_SESSION['mtr'] = $matricula; 
            /*
            //dados para envio de sms
            
            $telefone = $row['telefone_usuario'];
            $bpm = $row['unidade_usuario'];
            $_SESSION['mtr'] = $matricula;
            $senha = "vs@UViZY26?5LG";//$_SESSION['senha'];
            //var_dump($telefone);
            
            //Api de envio por sms
            
            $sms = urlencode("[$bpm] Codigo: $token");
            $url_api = "https://api.iagentesms.com.br/webservices/http.php?metodo=envio&usuario=fabiogaleno033@gmail.com&senha=$senha&celular=$telefone&mensagem=$sms&codigosms=203";

            $retorno_api = file_get_contents($url_api);
            //fim da api de envio

            if($retorno_api == "OK"){
                echo "<script>alert('SMS Token enviado com sucesso!'); window.location.href='../materiais/cautelarMaterial.php';</script>";
                exit();
            }else {
                echo "<script>alert('SMS Erro ao enviar Token!'); window.location.href='../materiais/cautelarMaterial.php';</script>";
            } 
            */
            echo "<script>alert('SMS Token enviado com sucesso!'); window.location.href='https://2bptur.com/materiais/cautelarMaterial.php';</script>";//https://2bptur.com/materiais/
        }

?>