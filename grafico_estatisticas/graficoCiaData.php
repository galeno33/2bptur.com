<?php
    // Conexão com o banco de dados
   /* require_once ('../conexao/conexao_01.php');

    $conexao = new Conexao();
    $conn = $conexao->getConexao();
    
    // Consulta para obter os dados de CVLI (Homicídios, Feminicídios, Infanticídios e Latrocínios)
    $sql = "SELECT cmd_regional, MONTH(dia_mes) AS mes, COUNT(*) AS total
            FROM ocorrencia
            WHERE tipificacao_crime IN ('Homicídio', 'Feminicídio', 'Infanticídio', 'Latrocínio')
            GROUP BY cmd_regional, mes
            ORDER BY cmd_regional, mes";

    $result = $conn->query($sql);

    $data = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cpam = $row['cmd_regional'];
            $mes = (int)$row['mes'];
            $total = (int)$row['total'];

            if (!isset($data[$cpam])) {
                $data[$cpam] = array_fill(1, 12, 0); // Inicializa os meses com 0
            }

            $data[$cpam][$mes] = $total;
        }
    }

    // Formatar os dados para envio em JSON
    $response = [];
    foreach ($data as $cpam => $totaisPorMes) {
        $response[] = [
            'cpam' => $cpam,
            'valores' => array_values($totaisPorMes)
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($response);*/
    //=========================================================================================

    /*require_once ('../conexao/conexao_01.php');

    $conexao = new Conexao();
    $conn = $conexao->getConexao();
    
    // Consulta para obter todas as ocorrências agrupadas por CIA e mês
    $sql = "SELECT u.cia AS cia, MONTH(r.dia_mes) AS mes, COUNT(*) AS total
            FROM ranking r
            JOIN usuario u ON r.matricula = u.id
            GROUP BY u.cia, mes
            ORDER BY u.cia, mes";
    
    $result = $conn->query($sql);
    
    $data = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cia = $row['cia'];
            $mes = (int)$row['mes'];
            $total = (int)$row['total'];
    
            if (!isset($data[$cia])) {
                $data[$cia] = array_fill(1, 12, 0); // Inicializa todos os meses com 0
            }
    
            $data[$cia][$mes] = $total;
        }
    }
    
    // Formatar os dados para JSON
    $response = [];
    foreach ($data as $cia => $valores) {
        $response[] = [
            'cia' => $cia,
            'valores' => array_values($valores)
        ];
    }
    
    header('Content-Type: application/json');
    echo json_encode($response, JSON_PRETTY_PRINT);*/

    //======================================================================================
    require_once('../conexao/conexao_01.php');

    $conexao = new Conexao();
    $conn = $conexao->getConexao();

    // Consulta SQL para obter todas as ocorrências agrupadas por CIA e mês
    $sql = "SELECT usuario.cia AS cia,
                MONTH(ranking.dia_mes) AS mes,
                COUNT(*) AS total
            FROM ranking
            JOIN usuario ON ranking.matricula = usuario.id
            GROUP BY usuario.cia, mes
            ORDER BY usuario.cia, mes";

    $result = $conn->query($sql);

    $data = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cia = $row['cia'];
            $mes = (int)$row['mes'];
            $total = (int)$row['total'];

            if (!isset($data[$cia])) {
                $data[$cia] = [];
            }

            $data[$cia][] = ['mes' => $mes, 'total' => $total];
        }
    }

    // Formatar os dados para JSON
    $response = [];
    foreach ($data as $cia => $valores) {
        $response[] = [
            'cia' => $cia,
            'valores' => $valores
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    exit;

    
?>