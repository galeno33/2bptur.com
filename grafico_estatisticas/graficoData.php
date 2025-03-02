<?php
    require_once('../conexao/conexao_01.php');

class CrimeData {
    private $conexao;

    public function __construct() {
        $this->conexao = new Conexao();
    }

    public function getCrimeCounts() {
        $conn = $this->conexao->getConexao();

        // Consulta SQL para contar as tipificações de crimes
        $sql = "SELECT tipificacao_crime, COUNT(*) AS quantidade 
                FROM ocorrencia 
                GROUP BY tipificacao_crime";
        
        $result = $conn->query($sql);
        $data = array_fill(1, 10, 0); // Inicializa com 0 para cada tipo de crime (1 a 10)

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $tipificacao = (int) $row['tipificacao_crime'];
                $quantidade = (int) $row['quantidade'];

                if (isset($data[$tipificacao])) {
                    $data[$tipificacao] = $quantidade;
                }
            }
            $result->free();
        }

        $conn->close();
        return $data;
    }
}

$crimeData = new CrimeData();
$crimeCounts = $crimeData->getCrimeCounts(); // Array com as quantidades por tipo de crime
?>
