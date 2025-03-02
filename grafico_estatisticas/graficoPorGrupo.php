<?php
    require_once('../conexao/conexao_01.php');

    class GraficoPorGrupo {
        private $conexao;

        public function __construct() {
            $this->conexao = new Conexao();
        }

        public function buscarDados($grupo, $periodo) {
            $conn = $this->conexao->getConexao();

            $dataAtual = date('Y-m-d');
            $dataInicio = match ($periodo) {
                '7_dias' => date('Y-m-d', strtotime('-7 days')),
                '15_dias' => date('Y-m-d', strtotime('-15 days')),
                '1_mes' => date('Y-m-d', strtotime('-1 month')),
                '6_meses' => date('Y-m-d', strtotime('-6 months')),
                '1_ano' => date('Y-m-d', strtotime('-1 year')),
                default => date('Y-m-d', strtotime('-7 days'))
            };

            $grupos = [
                '1' => ['Roubo', 'Lesão corporal', 'Sequestro'],
                '2' => ['Furto', 'Apreensão', 'Receptação', 'Tráfico', 'Posse/Porte', 'Arrombamento'],
                '3' => ['Homicídio', 'Latrocínio', 'Feminicídio', 'Infanticídio']
            ];

            if (!isset($grupos[$grupo])) {
                return [];
            }

            $tipos = implode("','", $grupos[$grupo]);
            $sql = "SELECT tipificacao_crime AS tipo, COUNT(*) AS total
                    FROM ocorrencia
                    WHERE tipificacao_crime IN ('$tipos') 
                    AND dia_mes BETWEEN ? AND ?
                    GROUP BY tipificacao_crime";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ss', $dataInicio, $dataAtual);
            $stmt->execute();
            $result = $stmt->get_result();

            $dados = [];
            while ($row = $result->fetch_assoc()) {
                $dados[] = ['tipo' => $row['tipo'], 'total' => $row['total']];
            }

            return $dados;
        }
    }

    $grupo = $_GET['grupo'] ?? '1';
    $periodo = $_GET['periodo'] ?? '7_dias';

    $grafico = new GraficoPorGrupo();
    header('Content-Type: application/json');
    echo json_encode($grafico->buscarDados($grupo, $periodo));
?>