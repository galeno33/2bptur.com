<?php
require_once('../conexao/conexao_01.php');

// Ativar exibição de erros para depuração
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$conexao = new Conexao();
$conn = $conexao->getConexao();

if (!$conn) {
    die("Erro de conexão: " . mysqli_connect_error());
}

// Função para cadastrar ocorrência na tabela 'ocorrencias'
function cadastrarOcorrencia($conn, $miker, $sigo, $tipificacao, $qualificacao, $genero, $faixaEtaria, $arma, $idade, $diaOcorrencia, $endereco, $bairro, $cidade) {
    // Validação e sanitização dos dados
    $miker = filter_var($miker, FILTER_VALIDATE_INT) ?: NULL;
    $sigo = substr((string)($sigo ?? ''), 0, 30) ?: NULL;
    $tipificacao = substr((string)($tipificacao ?? ''), 0, 3) ?: NULL;
    $qualificacao = substr((string)($qualificacao ?? ''), 0, 3) ?: NULL;
    $genero = substr((string)($genero ?? ''), 0, 3) ?: NULL;
    $faixaEtaria = substr((string)($faixaEtaria ?? ''), 0, 3) ?: NULL;
    $arma = substr((string)($arma ?? ''), 0, 3) ?: NULL;
    $idade = substr((string)($idade ?? ''), 0, 3) ?: NULL;
    $diaOcorrencia = $diaOcorrencia ? date('Y-m-d', strtotime($diaOcorrencia)) : NULL;
    $endereco = substr((string)($endereco ?? ''), 0, 30) ?: NULL;
    $bairro = substr((string)($bairro ?? ''), 0, 30) ?: NULL;
    $cidade = substr((string)($cidade ?? ''), 0, 30) ?: NULL;

    if (!$miker || !$tipificacao) {
        return false;
    }

    $sqlOcorrencia = "INSERT INTO ocorrencias (`id_miker`, `sigo_ocorrencia`, `tipificacao_crime`, `qualificacao`, `genero`, `faixa_etaria`, `arma`, `idade`, `dia_mes`, `endereco_ocorrencia`, `bairro_ocorrencia`, `cidade_ocorrencia`)
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sqlOcorrencia);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'iisssssissss', $miker, $sigo, $tipificacao, $qualificacao, $genero, $faixaEtaria, $arma, $idade, $diaOcorrencia, $endereco, $bairro, $cidade);
        $result = mysqli_stmt_execute($stmt);
        if (!$result) {
            error_log("Erro ao inserir em ocorrencias: " . mysqli_stmt_error($stmt));
        }
        mysqli_stmt_close($stmt);
        return $result;
    }
    error_log("Erro ao preparar statement para ocorrencias: " . mysqli_error($conn));
    return false;
}

// Função para adicionar pontos na tabela 'pontos'
function adicionarPontos($conn, $matricula, $pontos) {
    $matricula = filter_var($matricula, FILTER_VALIDATE_INT) ?: NULL;
    $pontos = filter_var($pontos, FILTER_VALIDATE_INT) ?: 0;

    if (!$matricula) {
        return false;
    }

    $sqlPontos = "INSERT INTO pontos (`matricula`, `ponto_ranking`) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sqlPontos);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ii', $matricula, $pontos);
        $result = mysqli_stmt_execute($stmt);
        if (!$result) {
            error_log("Erro ao inserir em pontos: " . mysqli_stmt_error($stmt));
        }
        mysqli_stmt_close($stmt);
        return $result;
    }
    error_log("Erro ao preparar statement para pontos: " . mysqli_error($conn));
    return false;
}

// Função para adicionar matrículas na tabela 'guarnicao'
function adicionarMatricula($conn, $miker, $mtr_cmd, $mtr_moto, $mtr_patr1, $mtr_patr2, $mtr_patr3, $mtr_patr4) {
    $miker = filter_var($miker, FILTER_VALIDATE_INT) ?: NULL;
    $mtr_cmd = filter_var($mtr_cmd, FILTER_VALIDATE_INT) ?: NULL;
    $mtr_moto = filter_var($mtr_moto, FILTER_VALIDATE_INT) ?: NULL;
    $mtr_patr1 = filter_var($mtr_patr1, FILTER_VALIDATE_INT) ?: NULL;
    $mtr_patr2 = filter_var($mtr_patr2, FILTER_VALIDATE_INT) ?: NULL;
    $mtr_patr3 = filter_var($mtr_patr3, FILTER_VALIDATE_INT) ?: NULL;
    $mtr_patr4 = filter_var($mtr_patr4, FILTER_VALIDATE_INT) ?: NULL;

    if (!$miker || !$mtr_cmd) {
        return false;
    }

    $sqlMtr = "INSERT INTO guarnicao (`miker_Bo`, `mtr_cmd`, `mtr_mot`, `mtr_patr1`, `mtr_patr2`, `mtr_patr3`, `mtr_patr4`) 
               VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sqlMtr);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'iiiiiii', $miker, $mtr_cmd, $mtr_moto, $mtr_patr1, $mtr_patr2, $mtr_patr3, $mtr_patr4);
        $result = mysqli_stmt_execute($stmt);
        if (!$result) {
            error_log("Erro ao inserir em guarnicao: " . mysqli_stmt_error($stmt));
        }
        mysqli_stmt_close($stmt);
        return $result;
    }
    error_log("Erro ao preparar statement para guarnicao: " . mysqli_error($conn));
    return false;
}

if (isset($_POST['salvar'])) {
    // Depuração: verificar se os dados estão chegando (opcional, pode ser comentado em produção)
    // echo "<pre>POST Data: "; print_r($_POST); echo "</pre>";

    // Dados básicos do formulário
    $miker = $_POST['miker'] ?? null;
    $sigo = $_POST['sigo'] ?? null;
    $tipificacao = $_POST['tipificacao'] ?? null;
    $diaOcorrencia = $_POST['inputdata'] ?? null;
    $endereco = $_POST['endereco'] ?? null;
    $bairro = $_POST['bairro'] ?? null;
    $cidade = $_POST['cidade'] ?? null;
    $situacao = $_POST['situacao'] ?? null;
    $matriculas = $_POST['matricula'] ?? [];

    // Dados condicionais
    $qualificacao = null;
    $genero = null;
    $faixaEtaria = null;
    $arma = null;
    $idade = null;

    // Mapeamento de tipificações e qualificações (ajustado para valores numéricos)
    switch ($tipificacao) {
        case '1': // Furto
            $tipificacao = '1';
            $qualificacao = match ($_POST['furto'] ?? '') {
                '1' => '3', // Pessoa
                '2' => '4', // Residência
                '3' => '5', // Estabelecimento
                '4' => '7', // Veículo
                '5' => '8', // Objetos
                default => null,
            };
            break;
        case '2': // Roubo
            $tipificacao = '2';
            $qualificacao = match ($_POST['tipoRoubo'] ?? '') {
                '1' => '3', // Pessoa
                '2' => '4', // Residência
                '3' => '5', // Estabelecimento
                '4' => '7', // Veículo
                '5' => '6', // Coletivo
                default => null,
            };
            break;
        case '3': // Receptação
            $tipificacao = '3';
            $qualificacao = match ($_POST['tipoReceptacao'] ?? '') {
                '1' => '1', // Produto roubado
                '2' => '2', // Produto furtado
                default => null,
            };
            break;
        case '4': // Porte ilegal de arma de fogo
            $tipificacao = '4';
            break;
        case '5': // Posse ilegal de arma de fogo
            $tipificacao = '5';
            break;
        case '6': // Apreensão de entorpecentes
            $tipificacao = '6';
            break;
        case '7': // Apreensão de arma de fogo
            $tipificacao = '7';
            break;
        case '8': // Apreensão de simulacro
            $tipificacao = '8';
            break;
        case '9': // Apreensão de veículo
            $tipificacao = '9';
            break;
        case '10': // Apreensão de kadron
            $tipificacao = '10';
            break;
        case '11': // Veículo Recuperado
            $tipificacao = '11';
            break;
        case '12': // Homicídio
            $tipificacao = '12';
            $genero = $_POST['tipoGenero'] == '1' ? '1' : ($_POST['tipoGenero'] == '2' ? '2' : null);
            $idade = $_POST['inputIdade'] ?? null;
            $arma = match ($_POST['tipoArma'] ?? '') {
                '1' => '1', // Arma de fogo
                '2' => '2', // Arma branca
                '3' => '3', // Outros meios
                default => null,
            };
            break;
        case '13': // Feminicídio
            $tipificacao = '13';
            $genero = $_POST['tipoGenero'] == '2' ? '2' : null; // Apenas feminino
            $idade = $_POST['inputIdade'] ?? null;
            $arma = match ($_POST['tipoArma'] ?? '') {
                '1' => '1', // Arma de fogo
                '2' => '2', // Arma branca
                '3' => '3', // Outros meios
                default => null,
            };
            break;
        case '14': // Latrocínio
            $tipificacao = '14';
            $genero = $_POST['tipoGenero'] == '1' ? '1' : ($_POST['tipoGenero'] == '2' ? '2' : null);
            $idade = $_POST['inputIdade'] ?? null;
            $arma = match ($_POST['tipoArma'] ?? '') {
                '1' => '1', // Arma de fogo
                '2' => '2', // Arma branca
                '3' => '3', // Outros meios
                default => null,
            };
            break;
        case '15': // Infanticídio
            $tipificacao = '15';
            $genero = $_POST['tipoGenero'] == '1' ? '1' : ($_POST['tipoGenero'] == '2' ? '2' : null);
            $idade = $_POST['inputIdade'] ?? null;
            $arma = match ($_POST['tipoArma'] ?? '') {
                '1' => '1', // Arma de fogo
                '2' => '2', // Arma branca
                '3' => '3', // Outros meios
                default => null,
            };
            break;
        case '16': // Sequestro relâmpago
            $tipificacao = '16';
            break;
        case '17': // Sequestro com cárcere privado
            $tipificacao = '17';
            break;
        case '18': // Lesão corporal por arma de fogo
            $tipificacao = '18';
            break;
        case '19': // Lesão corporal por arma branca
            $tipificacao = '19';
            break;
        case '20': // Lesão corporal por outros meios
            $tipificacao = '20';
            break;
        case '21': // Cumprimento de mandado de prisão
            $tipificacao = '21';
            break;
        case '22': // Tráfico de entorpecentes
            $tipificacao = '22';
            break;
        case '23': // Tráfico humano
            $tipificacao = '23';
            $genero = $_POST['tipoGenero'] == '1' ? '1' : ($_POST['tipoGenero'] == '2' ? '2' : null);
            $faixaEtaria = match ($_POST['tipoEtario'] ?? '') {
                '1' => '1', // Adulto
                '2' => '2', // Adolescente
                '3' => '3', // Criança
                default => null,
            };
            $idade = $_POST['inputIdade'] ?? null;
            break;
        case '24': // Arrombamento residencial
            $tipificacao = '24';
            break;
        case '25': // Arrombamento a estabelecimento
            $tipificacao = '25';
            break;
        case '26': // Arrombamento de veículo
            $tipificacao = '26';
            break;
        case '27': // Violência sexual
            $tipificacao = '27';
            $genero = $_POST['tipoGenero'] == '1' ? '1' : ($_POST['tipoGenero'] == '2' ? '2' : null);
            $faixaEtaria = match ($_POST['tipoEtario'] ?? '') {
                '1' => '1', // Adulto
                '2' => '2', // Adolescente
                '3' => '3', // Criança
                default => null,
            };
            $idade = $_POST['inputIdade'] ?? null;
            break;
        case '28': // Achado de cadáver
            $tipificacao = '28';
            break;
        case '29': // Tentativa de homicídio
            $tipificacao = '29';
            break;
        case '30': // Tentativa de roubo
            $tipificacao = '30';
            break;
        case '31': // Tentativa de sequestro
            $tipificacao = '31';
            break;
        case '32': // Tentativa de furto
            $tipificacao = '32';
            break;
        case '33': // Tentativa de estupro
            $tipificacao = '33';
            break;
        case '34': // Violência doméstica
            $tipificacao = '34';
            break;
        default:
            $tipificacao = null;
            break;
    }

    // Mapeamento de pontos por tipificação
    $pontosTipificacao = [
        1 => 50, 2 => 50, 3 => 50, 4 => 100, 5 => 100, 6 => 85, 7 => 100, 8 => 50,
        9 => 50, 10 => 10, 11 => 50, 12 => 100, 13 => 100, 14 => 100, 15 => 100,
        16 => 100, 17 => 100, 18 => 85, 19 => 50, 20 => 30, 21 => 80, 22 => 85,
        23 => 100, 24 => 25, 25 => 25, 26 => 25, 27 => 100, 28 => 10, 29 => 25,
        30 => 25, 31 => 25, 32 => 25, 33 => 25, 34 => 25
    ];

    $pontosBase = $pontosTipificacao[$tipificacao] ?? 0;
    $pontosAcrescidos = $pontosBase;

    // Acréscimo de pontos por situação
    switch ($situacao) {
        case '2': // Flagrante
            $pontosAcrescidos += 75;
            break;
        case '3': // Termo Circunstancial
            $pontosAcrescidos += 30;
            break;
    }

    // Preparar matrículas para guarnicao
    $mtr_cmd = $matriculas[0] ?? null;
    $mtr_moto = $matriculas[1] ?? null;
    $mtr_patr1 = $matriculas[2] ?? null;
    $mtr_patr2 = $matriculas[3] ?? null;
    $mtr_patr3 = $matriculas[4] ?? null;
    $mtr_patr4 = $matriculas[5] ?? null;

    // Validação básica
    if (!$miker || !$tipificacao || !$mtr_cmd || !$diaOcorrencia || !$situacao) {
        echo json_encode(['success' => false, 'message' => 'Erro: Campos obrigatórios não preenchidos!']);
        exit;
    }

    // Inserir dados nas tabelas
    $resultOcorrencia = cadastrarOcorrencia($conn, $miker, $sigo, $tipificacao, $qualificacao, $genero, $faixaEtaria, $arma, $idade, $diaOcorrencia, $endereco, $bairro, $cidade);
    $resultGuarnicao = adicionarMatricula($conn, $miker, $mtr_cmd, $mtr_moto, $mtr_patr1, $mtr_patr2, $mtr_patr3, $mtr_patr4);

    // Inserir pontos para cada matrícula preenchida
    $resultPontos = true;
    foreach ($matriculas as $matricula) {
        if ($matricula) {
            $resultPontos &= adicionarPontos($conn, $matricula, $pontosAcrescidos);
        }
    }

    // Fechar conexão
    mysqli_close($conn);

    // Feedback ao usuário
    if ($resultOcorrencia && $resultGuarnicao && $resultPontos) {
        //echo json_encode(['success' => true, 'message' => 'Ocorrência cadastrada com sucesso!']);
        echo "<script>alert('Ocorrência cadastrada com sucesso!'); window.location.href='cadastroBo.php';</script>";//
    } else {
        //echo json_encode(['success' => false, 'message' => 'Erro ao cadastrar ocorrência!']);
        echo "<script>alert('Erro ao cadastras ocorrência!'); window.location.href='cadastroBo.php';</script>";//
    }
    exit;
} else {
    //echo json_encode(['success' => false, 'message' => 'Nenhum formulário enviado.']);
    echo "<script>alert('Nenhum formulário enviado.'); window.location.href='cadastroBo.php';</script>";//
    exit;
}