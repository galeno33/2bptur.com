<?php
    require_once('../conexao/conexao_01.php');
    require_once('../ocorrencias/selectOcorrencia.php');

    class cvliPercentual {
        private $conexao;
        private $ocorrencias;

        public function __construct() {
            $this->conexao = new Conexao();
        }

        public function getPercentualCvliCpam() {
            $conn = $this->conexao->getConexao();
            $this->ocorrencias = new SelectOcorrencia($conn);
            $ocorrencias = $this->ocorrencias->getOcorrencias();

            // Obtendo o mês atual e o mês anterior
            $mesAtual = date('m'); 
            $mesAnterior = ($mesAtual == 1) ? 12 : $mesAtual - 1; // Se for janeiro, o mês anterior é dezembro

            $dadosAgrupados = [];

            // Agrupar ocorrências por CPAM e mês
            foreach ($ocorrencias as $ocorrencia) {
                $cpam = $ocorrencia->getCmdRegional();
                $mes = date('m', strtotime($ocorrencia->getDiaOcorrencia())); // Obtém o mês da ocorrência

                if (!isset($dadosAgrupados[$cpam])) {
                    $dadosAgrupados[$cpam] = ['atual' => 0, 'anterior' => 0];
                }

                if ($mes == $mesAtual) {
                    $dadosAgrupados[$cpam]['atual']++;
                } elseif ($mes == $mesAnterior) {
                    $dadosAgrupados[$cpam]['anterior']++;
                }
            }

            // Calcular o percentual de variação
            $resultadosPercentuais = [];
            foreach ($dadosAgrupados as $cpam => $valores) {
                $totalAtual = $valores['atual'];
                $totalAnterior = $valores['anterior'];

                if ($totalAnterior > 0) {
                    $percentual = round((($totalAtual - $totalAnterior) / $totalAnterior) * 100, 2);
                } else {
                    $percentual = 0;
                }

                $resultadosPercentuais[] = [
                    'cpam' => $cpam,
                    'percentualAtual' => $percentual,
                    'percentualAnterior' => $totalAnterior // Índice do mês anterior
                ];
            }

            return $resultadosPercentuais;
        }
    }

    // Retornar JSON para o JavaScript
    header('Content-Type: application/json');
    $cvli = new cvliPercentual();
    echo json_encode($cvli->getPercentualCvliCpam(), JSON_PRETTY_PRINT);
    exit;
?>
