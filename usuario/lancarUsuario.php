<?php
    include('../conexao/conexao.php');

    function cadastrarUsuario($matricula, $nomeCompleto, $nomeGuerra, $posto, $telefone, $senhaHash, $compania, $situacaoAcesso) {
        global $conn;

        $sqlUsuario = "INSERT INTO usuario (`id`, `nome_completo`, `nome_de_guerra`, `posto_usuario`, `telefone_usuario`, `senha_usuario`, `cia`, `situacao`)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sqlUsuario);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'ississis', $matricula, $nomeCompleto, $nomeGuerra, $posto, $telefone, $senhaHash, $compania, $situacaoAcesso);
            $result = mysqli_stmt_execute($stmt);

            mysqli_stmt_close($stmt);

            return $result;
        }

        return false;
    }
    
    if (isset($_POST['salvar'])) {
        if (empty($_POST['inputNome']) || empty($_POST['inputMatricula']) ||
            empty($_POST['inputGuerra']) || empty($_POST['inputPosto']) ||
            empty($_POST['inputSenha']) || empty($_POST['inputCia'])
        ) {
            echo "Preencha todos os dados";
            // Tratar o caso em que campos obrigatórios estão vazios
        } else {
            $nomeCompleto = $_POST['inputNome'];
            $matricula = $_POST['inputMatricula'];
            $nomeGuerra = $_POST['inputGuerra'];
            $posto = $_POST['inputPosto'];
            $telefone = $_POST['inputTelefone'];
            $senha = $_POST['inputSenha'];
            $compania = $_POST['inputCia'];
            $situacaoAcesso = ($_POST['flexRadioDefault'] == 1) ? "habilitado" : "desabilitado";
            
            // Cria um hash seguro da senha
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

            // Código que envia dados para o banco de dados
            if ($conn == false) {
                die("Erro ao se conectar" . mysqli_connect_error());
            }

            $result = cadastrarUsuario($matricula, $nomeCompleto, $nomeGuerra, $posto, $telefone, $senhaHash, $compania, $situacaoAcesso);

            mysqli_close($conn);

            if ($result) {
                header('Location: http://localhost/projetos/1Bptur/confirCadastroUsuario.php');
                //echo "<div class='alert alert-success'>Cadastro realizado com sucesso!</div>";
                //var_dump($situacaoAcesso);
            } else {
                header('Location: http://localhost/projetos/1Bptur/erroCadastroUsuario.php');
                //echo "<div class='alert alert-danger'>Erro: Informações não cadastradas. </div>";
            }
        }
    }
?>
