<?php
    /****Desenvolvido por Fabio Galeno****/
    require_once('../conexao/conexao_01.php');

    class UpdateController
    {
        private $conexao;
        private $prefixo;
        private $modelo;
        private $placa;
        private $situacao;
        private $detalhes;
        private $unidade;

        public function __construct()
        {
            $this->conexao = new Conexao();
        }

        public function detalhesUpdVtr()
        {
            $conn = $this->conexao->getConexao();

            if(isset($_GET['updateVtr'])){
                $id_prefixo = mysqli_real_escape_string($conn, $_GET['updateVtr']);

                $sqlDetalhesUpd = "SELECT id_prefixo, modelo, placa, situacao, detalhes, unidade FROM viatura WHERE id_prefixo = ?";

                $stmt = $conn->prepare($sqlDetalhesUpd);
                $stmt->bind_param("i", $id_prefixo);
                $stmt->execute();
                $rest = $stmt->get_result();
                if($rest->num_rows > 0)
                {
                    $row = $rest->fetch_assoc();
                    $this->prefixo = $row['id_prefixo'];
                    $this->modelo = $row['modelo'];
                    $this->placa = $row['placa'];
                    $this->situacao = $row['situacao'];
                    $this->detalhes = $row['detalhes'];
                    $this->unidade = $row['unidade'];
                }
            }
        }
        public function getPrefixo(){ return $this->prefixo;}
        public function getModelo(){ return $this->modelo;}
        public function getPlaca(){ return $this->placa;}
        public function getSituacao(){ return $this->situacao;}
        public function getDetalhes(){ return $this->detalhes;}
        public function getUnidade(){ return $this->unidade;}
    }

?>