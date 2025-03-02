<?php
    require_once('../conexao/conexao_01.php');
    require_once('variaveisRankings.php');
    require_once('../usuario/restricaoUsuarios.php');

    class RankingTotal
    {
        private $conexao;
        private $restringir;

        public function __construct()
        {
            $this->conexao = new Conexao();
            $this->restringir = new RestricaoDeUsuario();
        }

        public function rankingTotal()
        {
            $conn = $this->conexao->getConexao();
            $this->restringir->restricao();
            //$cia = $this->restringir->getCiaRestrito();
            $bpm = $this->restringir->getBpm();

            //usuario.unidade_usuario,
            $sql = "SELECT usuario.nome_de_guerra,
                        usuario.cia,
                        pontos.matricula,
                        SUM(ponto_ranking) as totalSoma
                    FROM pontos 
                    JOIN usuario 
                    ON pontos.matricula = usuario.id
                    WHERE usuario.unidade_usuario = ?
                    GROUP BY pontos.matricula
                    ORDER BY totalSoma DESC";  
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $bpm);
            $stmt->execute();
            $result = $stmt->get_result();      

            //$result = mysqli_query($conn, $sql) or die ("Erro ao tentar consultar Ranking!!!");

            $ranking = [];
            //while($row = mysqli_fetch_assoc($result))
            while($row = $result->fetch_assoc())
            {
                
                $selectRanking = new VariaveisRanking
                (
                    $row['matricula'],
                    $row['matricula'],
                    $row['totalSoma'], 
                    $row['nome_de_guerra'],
                    $row['cia']
                );
                $ranking[] = $selectRanking;
            }
            return $ranking;
    
        }
    }

?>