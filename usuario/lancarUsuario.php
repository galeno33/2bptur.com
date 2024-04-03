<?php
    include('../conexao/conexao.php');

    function cadastrarUsuario($matricula, $nomeCompleto, $nomeGuerra, $posto, $classe, $telefone, $senhaHash, $companhia, $situacaoAcesso) {
        global $conn;

        $sqlUsuario = "INSERT INTO usuario (`id`, `nome_completo`, `nome_de_guerra`, `posto_usuario`, `classe_usuario`, `telefone_usuario`, `senha_usuario`, `cia`, `situacao`)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sqlUsuario);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'issssssis', $matricula, $nomeCompleto, $nomeGuerra, $posto, $classe, $telefone, $senhaHash, $companhia, $situacaoAcesso);
            $result = mysqli_stmt_execute($stmt);

            mysqli_stmt_close($stmt);

            return $result;
        }

        return false;
    }
    
    if (isset($_POST['salvar'])) {
        if (empty($_POST['inputNome']) || empty($_POST['inputMatricula']) ||
            empty($_POST['inputGuerra']) || empty($_POST['inputPosto']) ||
            empty($_POST['inputClasse']) || empty($_POST['inputSenha']) || empty($_POST['inputCia'])
        ) {
            echo "Preencha todos os dados";
            // Tratar o caso em que campos obrigatórios estão vazios
        } else {
            $nomeCompleto = $_POST['inputNome'];
            $matricula = $_POST['inputMatricula'];
            $nomeGuerra = $_POST['inputGuerra'];
            $posto = $_POST['inputPosto'];
            $classe = $_POST['inputClasse'];
            $telefone = $_POST['inputTelefone'];
            $senha = $_POST['inputSenha'];
            $companhia = $_POST['inputCia'];
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

            $result = cadastrarUsuario($matricula, $nomeCompleto, $nomeGuerra, $posto, $classe, $telefone, $senhaHash, $companhia, $situacaoAcesso);

            mysqli_close($conn);

            if ($result) {
                header('Location: https://2bptur.com/confirCadastroUsuario.php');
                //header('Location: http://localhost/projetos/1Bptur/confirCadastroUsuario.php');
                //echo "<div class='alert alert-success'>Cadastro realizado com sucesso!</div>";
                //var_dump($situacaoAcesso);
            } else {
                header('Location: https://2bptur.com/erroCadastroUsuario.php');
                //header('Location: http://localhost/projetos/1Bptur/erroCadastroUsuario.php');
                //echo "<div class='alert alert-danger'>Erro: Informações não cadastradas. </div>";
            }
        }
    }
?>
