<?php
    require_once('../conexao/conexao_01.php');
    require_once('../usuario/usuario.php');
    require_once('../ocorrencias/controllerOcorrencias.php');

    class DetalhesOcorrencia
    {
        private $conexao;
        private $id;
        private $nomeGuerra;
        private $posto;
        private $miker;
        private $sigo;
        private $tipificacao;
        private $dia;
        private $pontos;

        public function __construct()
        {
            $this->conexao = new Conexao();//instacia do arquivo conexao/conexao_o1.php
        }

        public function getDetalhesOcorrencia()
        {
            $id_detalhes = $_GET['detalheOcorrencia'];
            $conn = $this->conexao->getConexao();

            $sqlAtual = 
                "SELECT usuario.id,
                    usuario.nome_de_guerra, 
                    usuario.posto_usuario,
                    ranking.matricula,
                    ranking.miker_Bo,
                    ranking.sigo_ocorrencia,
                    ranking.tipificacao_crime,
                    ranking.dia_mes,
                    pontos.ponto_ranking
                FROM ranking
                JOIN usuario ON ranking.matricula = usuario.id
                JOIN pontos ON pontos.matricula = usuario.id
                WHERE ranking.id_ranking = ?";

                $stmt = $conn->prepare($sqlAtual);
                $stmt->bind_param("i", $id_detalhes);
                $stmt->execute();
                $result = $stmt->get_result();
            if($result->num_rows > 0)
            {
                $row = $result->fetch_assoc();
                $this->id = $row['id'];
                $this->nomeGuerra = $row['nome_de_guerra'];
                $this->posto = $row['posto_usuario'];
                $this->miker = $row['miker_Bo'];
                $this->sigo = $row['sigo_ocorrencia'];
                $this->tipificacao = $row['tipificacao_crime'];
                $this->dia = $row['dia_mes'];
                $this->pontos = $row['ponto_ranking'];

            }
            switch($this->tipificacao){
                case 1: 
                    $this->tipificacao = "Furto";
                    break;
                case 2:
                    $this->tipificacao = "Roubo";
                    break;
                case 3:
                    $this->tipificacao = "Receptação";
                    break;
                case 4:
                    $this->tipificacao = "Arma de Fogo";
                    break;
                case 5:
                    $this->tipificacao = "Objeto Perfurante";
                    break;
                case 6:
                    $this->tipificacao = "Entorpecentes";
                    break;
                case 7:
                    $this->tipificacao = "Veiculo Recuperdo";
                    break;
                case 8:
                    $this->tipificacao = "Kadron Apreendido";
                    break;
                case 9:
                    $this->tipificacao = "Foragido";
                    break;
                case 10:
                    $this->tipificacao = "Outras Tipificações";
            }

        }

        public function getIdDetalhes()
        {
            return $this->id;
        }

        public function getnomeGuerraDetahes()
        {
            return $this->nomeGuerra;
        }
        public function getPostoDetalhes()
        {
            return $this->posto;
        }

        public function getMikerDetalhes()
        {
            return $this->miker;
        }

        public function getSigoDetalhes()
        {
            return $this->sigo;
        }

        public function getTipificacaoDetalhes()
        {
            return $this->tipificacao;
        }

        public function getDiaDetalhes()
        {
            return $this->dia;
        }

        public function getPontosDetalhes()
        {
            return $this->pontos;
        }
    }
    
?>