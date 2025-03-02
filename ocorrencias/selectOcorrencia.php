<?php
    require_once('controllerOcorrencias.php');
    require_once('../usuario/restricaoUsuarios.php');

    class SelectOcorrencia
    {
        private $conn;
        private $restringir;

        public function __construct($conn)
        {
            $this->conn = $conn;
        }

        public function getOcorrencias()
        {
            $this->restringir = new RestricaoDeUsuario();
            $this->restringir->restricao();
            $bpm = $this->restringir->getBpm();
            $cia = $this->restringir->getCiaRestrito();

            $ocorrencia = [];

            $sql = "SELECT
                    usuario.id,
                    usuario.unidade_usuario,
                    usuario.cia,
                    ranking.id_ranking,
                    ranking.matricula,
                    ranking.miker_Bo,
                    ranking.sigo_ocorrencia,
                    ranking.tipificacao_crime,
                    ranking.dia_mes,
                    ranking.endereco_ocorrencia,
                    ranking.bairro_ocorrencia,
                    ranking.cidade_ocorrencia
                    FROM ranking
                    JOIN usuario ON ranking.matricula = usuario.id
                    WHERE usuario.unidade_usuario = ?
                    AND usuario.cia = ?";

                    $stmt = $this->conn->prepare($sql);
                    $stmt->bind_param("si", $bpm, $cia);
                    $stmt->execute();
                    $result = $stmt->get_result();
            
            while($row = $result->fetch_assoc())
            {
                $selectOcorrencia = new Ocorrencias
                (
                    $row['id_ranking'],
                    $row['matricula'],
                    $row['miker_Bo'],
                    $row['sigo_ocorrencia'],
                    $row['tipificacao_crime'],
                    $row['dia_mes'],
                    $row['endereco_ocorrencia'],
                    $row['bairro_ocorrencia'],
                    $row['cidade_ocorrencia']
                );
                
                $ocorrencia[] = $selectOcorrencia;
            }
                return $ocorrencia;

        }
    }

?>