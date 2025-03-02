<?php
    //include('../conexao/conexao.php');
    require_once('../conexao/conexao_01.php');

    $conexao = new Conexao();
    $conn = $conexao->getConexao();
    
    function cadastrarUsuario($matricula, $nomeCompleto, $nomeGuerra, $posto, $classe, $funcao, $telefone, $senhaHash, $cmdo, $bpm, $companhia, $chave, $situacaoAcesso) {
        global $conn;

        $sqlUsuario = "INSERT INTO usuario (`id`, `nome_completo`, `nome_de_guerra`, `posto_usuario`, `classe_usuario`, `funcao_usuario`,`telefone_usuario`, `senha_usuario`, `comando_area`, `unidade_usuario`, `cia`, `token_confirmacao`, `situacao`)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sqlUsuario);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'isssssssssiis', $matricula, $nomeCompleto, $nomeGuerra, $posto, $classe, $funcao, $telefone, $senhaHash, $cmdo, $bpm, $companhia, $chave, $situacaoAcesso);
            $result = mysqli_stmt_execute($stmt);

            mysqli_stmt_close($stmt);

            return $result;
        }

        return false;
    }
    
    if (isset($_POST['salvar'])) {
        if (empty($_POST['inputNome']) || empty($_POST['inputMatricula']) ||
            empty($_POST['inputGuerra']) || empty($_POST['inputPosto']) ||
            empty($_POST['inputClasse']) || empty($_POST['inputFuncao']) || 
            empty($_POST['inputSenha']) || empty($_POST['inputBpm']) ||empty($_POST['inputCia'])
        ) {
            echo "Preencha todos os dados";
            // Tratar o caso em que campos obrigatórios estão vazios
        } else {
            $nomeCompleto = $_POST['inputNome'];
            $matricula = $_POST['inputMatricula'];
            $nomeGuerra = $_POST['inputGuerra'];
            $posto = $_POST['inputPosto'];
            $classe = $_POST['inputClasse'];
            $funcao = $_POST['inputFuncao'];
            $telefone = $_POST['inputTelefone'];
            $senha = $_POST['inputSenha'];
            $cmdo = "CPE";
            $bpm = $_POST['inputBpm'];
            $companhia = $_POST['inputCia'];
            $chave = "NULL";
            $situacaoAcesso = ($_POST['flexRadioDefault'] == 1) ? "habilitado" : "desabilitado";

            //lançar o posto/patente
            switch($posto){
                case 1:
                    $posto = "SOLDADO";
                break;
                case 2:
                    $posto = "CABO";
                break;
                case 3:
                    $posto = "3º SARGENTO";
                break;
                case 4:
                    $posto = "2º SARGENTO";
                break;
                case 5:
                    $posto = "1º SARGENTO";
                break;
                case 6:
                    $posto = "SUB TENENTE";
                break;
                case 7:
                    $posto = "2º TENENTE";
                break;
                case 8:
                    $posto = "1º TENENTE";
                break;
                case 9:
                    $posto = "CAPITÃO";
                break;
                case 10:
                    $posto = "MAJOR";
                break;
                case 11:
                    $posto = "TENENTE CORONEL";
                break;
                case 12:
                    $posto = "CORONEL";
            }
            //lançar a classe
            switch($classe){
                case 1:
                    $classe = "OFICIAL";
                break;
                case 2:
                    $classe = "PRAÇA";
                
            }
            //lançar a função
            switch($funcao){
                case 1:
                    $funcao = "Cmd. de Batalhão";
                break;
                case 2:
                    $funcao = "Sub. Cmd de Batalhão";
                break;
                case 3:
                    $funcao = "Cmd de Cia";
                break;
                case 4:
                    $funcao = "Sub Cmd de Cia";
                break;
                case 5:
                    $funcao = "Cmd do P1";
                break;
                case 6:
                    $funcao = "Cmd do P2";
                break;
                case 7:
                    $funcao = "Cmd do P3";
                break;
                case 8:
                    $funcao = "Cmd do P4";
                break;
                case 9:
                    $funcao = "Combatente";
                break;
                case 10:
                    $funcao = "Armeiro";
                break;
                case 11:
                    $funcao = "Administrativo";
                
            }
            //lançar o Bpm
            switch($bpm){
                case 1:
                    $bpm = "1BPTUR";
                break;
                case 2:
                    $bpm = "2BPTUR";
                break;
                case 3:
                    $bpm = "1BMT";
                break;
                case 4:
                    $bpm = "BPA";
                break;
                case 5:
                    $bpm = "BPRV";
                
            }
            //lançar a companhia
            switch($companhia){
                case 1:
                    $companhia = 1;
                break;
                case 2:
                    $companhia = 2;
                break;
                case 3:
                    $companhia = 3;
                break;
                case 4:
                    $companhia = 4;
            }
            // Cria um hash seguro da senha
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

            // Código que envia dados para o banco de dados
            if ($conn == false) {
                die("Erro ao se conectar" . mysqli_connect_error());
            }

            $result = cadastrarUsuario($matricula, $nomeCompleto, $nomeGuerra, $posto, $classe, $funcao, $telefone, $senhaHash, $cmdo, $bpm, $companhia, $chave, $situacaoAcesso);

            mysqli_close($conn);

            if ($result) {
                echo "<script>alert('Cadastro concluída com sucesso!'); window.location.href='cadastroUsuario.php';</script>";
                //header('Location: https://2bptur.com/confirCadastroUsuario.php');
                //header('Location: http://localhost/projetos/1Bptur/confirCadastroUsuario.php');
                //echo "<div class='alert alert-success'>Cadastro realizado com sucesso!</div>";
                //var_dump($situacaoAcesso);
            } else {
                echo "<script>alert('Erro! ao concluir o cadastro, entre em contato com o Administrador do sistema.'); window.location.href='cadastroUsuario.php';</script>";
                //header('Location: https://2bptur.com/erroCadastroUsuario.php');
                //header('Location: http://localhost/projetos/1Bptur/erroCadastroUsuario.php');
                //echo "<div class='alert alert-danger'>Erro: Informações não cadastradas. </div>";
            }
        }
    }
?>
