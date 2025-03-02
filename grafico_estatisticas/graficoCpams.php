<?php
    require_once('../conexao/conexao_01.php');

    class GraficoData {
        private $conexao;
    
        public function __construct() {
            $this->conexao = new Conexao();
        }
    
        public function getDados() {
            $conn = $this->conexao->getConexao();
    
            $sql = "
                SELECT 
                    u.comando_regional AS comando,
                    COUNT(o.id_ranking) AS total_ocorrencias
                FROM usuario u
                LEFT JOIN ocorrencia o ON u.id = o.id_ranking
                GROUP BY u.comando_regional
            ";
    
            $result = $conn->query($sql);
    
            $dados = [];
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    if ((int)$row['total_ocorrencias'] > 0) { // Ignorar total igual a zero
                        $dados[] = [
                            'comando' => $row['comando'],
                            'total' => (int)$row['total_ocorrencias']
                        ];
                    }
                }
            }
    
            $conn->close();
            return $dados;
        }
    }
    
        
    // Instanciar a classe e gerar a resposta em JSON
    $grafico = new GraficoData();
    header('Content-Type: application/json');
    echo json_encode($grafico->getDados());
?>
