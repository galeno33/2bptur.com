<?php
include('../conexao/conexao.php');
//adiciona dados na tabela ranking no banco de dados
function cadastrarOcorrencia($conn, $matricula, $miker, $sigo, $tipificacao, $diaOcorrencia, $endereco, $bairro, $cidade)
{
    $sqlOcorrencia = "INSERT INTO ranking (`matricula`, `miker_Bo`, `sigo_ocorrencia`,`tipificacao_crime`, `dia_mes`, `endereco_ocorrencia`, `bairro_ocorrencia`, `cidade_ocorrencia`)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sqlOcorrencia);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'isisssss', $matricula, $miker, $sigo, $tipificacao, $diaOcorrencia, $endereco, $bairro, $cidade);
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    }

    return false;
}
//adiciona dados na tabela pontos no banco de dados
function adicionarPontos($conn, $matricula, $pontos)
{
    $sqlPontos = "INSERT INTO pontos(`matricula`, `ponto_ranking`) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sqlPontos);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ii', $matricula, $pontos);
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    }

    return false;
}

if (isset($_POST['salvar'])) {
    if (empty($_POST['matricula']) || empty($_POST['miker'])) {
        echo "Preencha todos os dados";
        // Tratar o caso em que campos obrigatórios estão vazios
    } else {
        $matricula = $_POST['matricula'];
        $miker = $_POST['miker'];
        $sigo = $_POST['sigo'];
        $tipificacao = $_POST['tipificacao'];
        $diaOcorrencia = $_POST['inputdata'];
        $endereco = $_POST['endereco'];
        $bairro = $_POST['bairro'];
        $cidade = $_POST['cidade'];
        $acrescimo = $_POST['flexRadioDefault'];

        // Mapeamento de pontos por tipificação
        $pontosTipificacao = [
            1 => 50,
            2 => 50,
            3 => 50,
            4 => 100,
            5 => 10,
            6 => 85,
            7 => 50,
            8 => 10,
            9 => 80,
            10 => 25,
        ];

        $pontosAcrescidos = $pontosTipificacao[$tipificacao] ?? 0;

        // Adicionando pontos extras conforme o acrescimo
        switch ($acrescimo) {
            case 2:
                $pontosAcrescidos += 75;
                break;
            case 3:
                $pontosAcrescidos += 30;
                break;
        }

        //======================================================================================================
        //envio de alguns dados para a tabela pontos no banco de dados
        $resultPontos = adicionarPontos($conn, $matricula, $pontosAcrescidos);
        //fim de envio
        //=====================================================================================================

        // Cria um hash seguro da senha
        //$sigoHash = password_hash($sigo, PASSWORD_DEFAULT);

        // Código que envia dados para o banco de dados
        if ($conn == false) {
            die("Erro ao se conectar" . mysqli_connect_error());
        }

        $resultOcorrencia = cadastrarOcorrencia($conn, $matricula, $miker, $sigo, $tipificacao, $diaOcorrencia, $endereco, $bairro, $cidade);

        mysqli_close($conn);

        if ($resultOcorrencia && $resultPontos) {
            header('Location: http://localhost/projetos/1Bptur/confirCadastroOcorrencia.php');
            //header('Location: https://bptur2.000webhostapp.com/confirCadastroOcorrencia.php');
            //echo "<div class='alert alert-success'>Cadastro realizado com sucesso!</div>";
        } else {
            header('Location: http://localhost/projetos/1Bptur/erroCadastroOcorrencia.php');
            //header('Location: https://bptur2.000webhostapp.com/confirCadastroOcorrencia.php');
            //echo "<div class='alert alert-danger'>Erro: Informações não cadastradas. </div>";
        }
    }
}

?>
