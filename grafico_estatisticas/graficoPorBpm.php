<?php
    require_once('../conexao/conexao_01.php');

    class GraficoPorBPM {
        private $conexao;

        public function __construct() {
            $this->conexao = new Conexao();
        }

        public function buscarDados($bpm, $periodo) {
            $conn = $this->conexao->getConexao();

            $dataAtual = date('Y-m-d');
            $dataInicio = match ($periodo) {
                '7_dias' => date('Y-m-d', strtotime('-7 days', strtotime($dataAtual))),
                '15_dias' => date('Y-m-d', strtotime('-15 days', strtotime($dataAtual))),
                '1_mes' => date('Y-m-d', strtotime('-1 month', strtotime($dataAtual))),
                '6_meses' => date('Y-m-d', strtotime('-6 months', strtotime($dataAtual))),
                '1_ano' => date('Y-m-d', strtotime('-1 year', strtotime($dataAtual))),
                default => date('Y-m-d', strtotime('-7 days', strtotime($dataAtual))) // Padrão: últimos 7 dias
            };

            $sql = "SELECT qualificacao, COUNT(*) AS total
                    FROM ocorrencia
                    WHERE bpm = ?
                    AND dia_mes BETWEEN ? AND ?
                    GROUP BY qualificacao
                    ORDER BY total DESC
                    LIMIT 10";

            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                die(json_encode(['error' => 'Erro na preparação da consulta: ' . $conn->error]));
            }

            // Vincular parâmetros e executar a consulta
            $stmt->bind_param('sss', $bpm, $dataInicio, $dataAtual);
            $stmt->execute();
            $result = $stmt->get_result();

            // Processar os resultados da consulta
            $dados = [];
            while ($row = $result->fetch_assoc()) {
                $dados[] = [
                    'qualificacao' => $row['qualificacao'],
                    'total' => (int) $row['total']
                ];
            }

            // Fechar a consulta e a conexão
            $stmt->close();
            $conn->close();

            return $dados;
        }
    }

    // Capturar parâmetros da URL
    $bpm = $_GET['bpm'] ?? '';
    $periodo = $_GET['periodo'] ?? '7_dias';

    // Validar BPM
    if (empty($bpm)) {
        die(json_encode(['error' => 'O parâmetro BPM é obrigatório.']));
    }

    // Instanciar a classe e buscar os dados
    $grafico = new GraficoPorBPM();
    header('Content-Type: application/json');
    echo json_encode($grafico->buscarDados($bpm, $periodo));
?>