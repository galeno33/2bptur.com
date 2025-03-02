<?php
    require_once('../conexao/conexao_01.php');

    class GraficoCrimesUnidades {
        private $conexao;

        public function __construct() {
            $this->conexao = new Conexao();
        }

        public function buscarDados($periodo) {
            $conn = $this->conexao->getConexao();

            $dataAtual = date('Y-m-d');
            $dataInicio = match ($periodo) {
                '7_dias' => date('Y-m-d', strtotime('-7 days', strtotime($dataAtual))),
                '15_dias' => date('Y-m-d', strtotime('15_dias', strtotime($dataAtual))),
                '1_mes' => date('Y-m-d', strtotime('-1 month', strtotime($dataAtual))),
                '6_meses' => date('Y-m-d', strtotime('-6 months', strtotime($dataAtual))),
                '1_ano' => date('Y-m-d', strtotime('-1 year', strtotime($dataAtual))),
                default => date('Y-m-d', strtotime('-7 days', strtotime($dataAtual)))
            };

            // Consulta para somar crimes por batalhão e retornar os 10 maiores
            $sql = "SELECT bpm, COUNT(*) AS total 
                    FROM ocorrencia
                    WHERE dia_mes BETWEEN ? AND ?
                    GROUP BY bpm
                    ORDER BY total DESC
                    LIMIT 10";

            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                die(json_encode(['error' => 'Erro na preparação da consulta: ' . $conn->error]));
            }

            $stmt->bind_param('ss', $dataInicio, $dataAtual);
            $stmt->execute();
            $result = $stmt->get_result();

            $dados = [];
            while ($row = $result->fetch_assoc()) {
                $dados[] = [
                    'bpm' => $row['bpm'],
                    'total' => (int)$row['total']
                ];
            }

            $stmt->close();
            $conn->close();

            return $dados;
        }
    }

    $periodo = $_GET['periodo'] ?? '7_dias';
    $grafico = new GraficoCrimesUnidades();
    header('Content-Type: application/json');
    echo json_encode($grafico->buscarDados($periodo));
?>