<?php
    require_once('../conexao/conexao_01.php');
    require_once('../usuario/usuario.php');
    require_once('../usuario/restricaoUsuarios.php');
    require_once('../ocorrencias/controllerOcorrencias.php');

    class DetalhesPermuta
    {
        private $conexao;
        private $restringir;
        private $id_detalhes;
        private $nome_permutado;
        private $guerra_permutado;
        private $nome_permutante;
        private $guerra_permutante;
        private $data_permuta;
        private $servico;
        private $justificativa;
        private $cia1;
        private $cia2;
        private $posto1;
        private $posto2;
        

        public function __construct()
        {
            $this->conexao = new Conexao();//instacia do arquivo conexao/conexao_o1.php
            $this->restringir = new RestricaoDeUsuario();

        }

        public function getDetalhesPermuta()
        {
            //=====================================================
            $this->restringir->restricao();
            //=====================================================
            $id_detalhes = $_GET['detalhePermutas'];
            $conn = $this->conexao->getConexao();

            $sqlAtual = "SELECT
                            usuario1.nome_completo AS nomePermutante,
                            usuario2.nome_completo AS nomePermutado,
                            usuario1.nome_de_guerra AS guerraPermutante,
                            usuario2.nome_de_guerra AS guerraPermutado,
                            usuario1.cia AS cia1,
                            usuario2.cia AS cia2,
                            usuario1.posto_usuario AS posto1,
                            usuario2.posto_usuario AS posto2,
                            permutas.id_permuta,
                            permutas.matr_permutante,
                            permutas.matr_permutado,
                            permutas.dia_permuta,
                            permutas.servico,
                            permutas.aceito_permuta,
                            permutas.autorizacao_permuta,
                            permutas.justificativa
                    FROM permutas
                    JOIN usuario AS usuario1 ON permutas.matr_permutante = usuario1.id
                    JOIN usuario AS usuario2 ON permutas.matr_permutado = usuario2.id
                    
                    WHERE permutas.id_permuta = ?
                    ";

                $stmt = $conn->prepare($sqlAtual);
                $stmt->bind_param("i", $id_detalhes);
                $stmt->execute();
                $result = $stmt->get_result();
            if($result->num_rows > 0)
            {
                $row = $result->fetch_assoc();
                $this->id_detalhes = $row['id_permuta'];
                $this->nome_permutante = $row['nomePermutante'];
                $this->guerra_permutante = $row['guerraPermutante'];
                $this->nome_permutado = $row['nomePermutado'];
                $this->guerra_permutado = $row['guerraPermutado'];
                $this->data_permuta = $row['dia_permuta'];
                $this->servico = $row['servico'];
                $this->justificativa = $row['justificativa'];
                $this->cia1 = $row['cia1'];
                $this->cia2 = $row['cia2'];
                $this->posto1 = $row['posto1'];
                $this->posto2 = $row['posto2'];
                

            }
            /*switch($this->tipificacao){
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
            }*/

        }

        public function getIdDetalhes()
        {
            return $this->id_detalhes;
        }

        public function getNomePermutante()
        {
            return $this->nome_permutante;
        }

        public function getNomePermutado()
        {
            return $this->nome_permutado;
        }

        public function getnomeGuerraPermutado()
        {
            return $this->guerra_permutado;
        }
        public function getnomeGuerraPermutante()
        {
            return $this->guerra_permutante;
        }

        public function getDataPermuta()
        {
            return $this->data_permuta;
        }

        public function getServico()
        {
            return $this->servico;
        }
        public function getJustificativa()
        {
            return $this->justificativa;
        }

        public function getCiaPermutado()
        {
            return $this->cia1;
        }

        public function getCiaPermutante()
        {
            return $this->cia2;
        }

        public function getPostoPermutado()
        {
            return $this->posto1;
        }

        public function getPostoPermutante()
        {
            return $this->posto2;
        }
    
    }
    
?>