<?php
include("conexao/conexao.php");

    if (isset($_POST['salvar'])) {
        if (
            empty($_POST['inputNome']) || empty($_POST['inputMatricula']) ||
            empty($_POST['inputGuerra']) || empty($_POST['inputTelefone']) ||
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
            $situacaoAcesso = $_POST['flexRadioDefault'];

            switch ($situacaoAcesso) {
                case 1:
                    $situacaoAcesso = "habilitado";
                    break;
                case 2:
                    $situacaoAcesso = "desabilitado";
                    //break;
            }

            // Cria um hash seguro da senha
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

            // Código que envia dados para o banco de dados
            if ($conn == false) {
                die("Erro ao se conectar" . mysqli_connect_error());
            }

            $sqlUsuario = "INSERT INTO usuario (`id`, `nome_completo`, `nome_de_guerra`, `posto_usuario`, `telefone_usuario`, `senha_usuario`, `cia`, `situacao`)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = mysqli_prepare($conn, $sqlUsuario);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, 'isssssis', $matricula, $nomeCompleto, $nomeGuerra, $posto, $telefone, $senhaHash, $compania, $situacaoAcesso);
                $result = mysqli_stmt_execute($stmt);

                if ($result) {
                    header('Location: http://localhost/projetos/1Bptur/cadastroUsuario.php');
                    exit();
                } else {
                    header('Location: http://localhost/projetos/1Bptur/erroCadasttroUsuario.php');
                    //echo "<div class='alert alert-danger'>Erro: Informações não cadastradas. </div>";
                }

                mysqli_stmt_close($stmt);
            } else {
                header('Location: http://localhost/projetos/1Bptur/erro.php');
                //echo "<div class='alert alert-danger'>Erro na declaração preparada: " . mysqli_error($conn) . "</div>";
            }

            mysqli_close($conn);
        }
    }
?>
