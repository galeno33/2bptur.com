<?php
    require_once('../conexao/conexao_01.php');
    require_once('../usuario/restricaoUsuarios.php');
    require_once('variaveisRankings.php');

    class RankingCia
    {
        private $conexao;
        private $restringir;

        public function __construct()
        {
            $this->conexao = new Conexao();
            $this->restringir = new RestricaoDeUsuario();
        }

        public function rankingCia()
        {
            $conn = $this->conexao->getConexao();
            $this->restringir->restricao();
            $cia = $this->restringir->getCiaRestrito();
            $bpm = $this->restringir->getBpm();

            $sql = "SELECT 
                        usuario.id,
                        usuario.nome_de_guerra,
                        usuario.cia,
                        pontos.matricula,
                        SUM(pontos.ponto_ranking) as totalSoma
                    FROM pontos 
                    JOIN usuario ON pontos.matricula = usuario.id 
                    WHERE usuario.unidade_usuario = ? 
                    AND usuario.cia = ?
                    GROUP BY usuario.id, usuario.nome_de_guerra, usuario.cia, pontos.matricula
                    ORDER BY totalSoma DESC";
            
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                die('Prepare failed: ' . htmlspecialchars($conn->error));
            }

            $stmt->bind_param('si', $bpm, $cia);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result === false) {
                die('Execute failed: ' . htmlspecialchars($stmt->error));
            }

            $rankingCia = [];
            while ($row = $result->fetch_assoc()) {
                $selectRankingCia = new VariaveisRanking(
                    $row['id'],
                    $row['matricula'],
                    $row['totalSoma'],
                    $row['nome_de_guerra'],
                    $row['cia']
                );
                $rankingCia[] = $selectRankingCia;
            }

            $stmt->close();
            return $rankingCia;
        }
    }
    $ranking = new RankingCia();
    $ranking->rankingCia();
    //var_dump($cia);
?>