<?php
    require_once('../conexao/conexao_01.php');

    class CauteladasDiaria
    {
        private $conexao;
        private $idUsuario;
        private $nomeCompleto;
        private $guerraCautelante;
        private $postoCautelante;
        private $prefixo;
        private $modelo;
        private $placa;
        private $situacao;
        private $detalhes;
        private $dataCautela;

        public function __construct()
        {
            $this->conexao = new Conexao();
        }

        public function Cauteladas()
        {

            //if(isset($_GET['detalhes'])){
            $id_detalhes = $_GET['detalhes'];
            $conn = $this->conexao->getConexao();
        
            $sql = 
                "SELECT usuario.id, 
                    usuario.nome_de_guerra,
                    usuario.nome_completo,
                    usuario.posto_usuario, 
                    cautela_viatura.idCautela,
                    cautela_viatura.cautela_prefixo,
                    cautela_viatura.matricula_motorista,
                    cautela_viatura.dia_cautela,
                    cautela_viatura.situacao_material,
                    viatura.modelo,
                    viatura.placa,
                    viatura.situacao,
                    viatura.detalhes
                FROM cautela_viatura
                JOIN usuario ON cautela_viatura.matricula_motorista = usuario.id
                JOIN viatura ON cautela_viatura.cautela_prefixo = viatura.id_prefixo
                WHERE cautela_viatura.idCautela = ?";
                        
                //$_SESSION['id_detalhes'] = $id_detalhes;
        
                if ($stmt = $conn->prepare($sql)) {
                    $stmt->bind_param("i", $id_detalhes);
                    $stmt->execute();
                    $result = $stmt->get_result();
        
                    if ($rowCautelados = $result->fetch_assoc()) {
                        $this->idUsuario = $rowCautelados['id']; // matricula
                        $this->nomeCompleto = $rowCautelados['nome_completo'];
                        $this->guerraCautelante = $rowCautelados['nome_de_guerra']; // nome de guerra do cautelante
                        $this->postoCautelante = $rowCautelados['posto_usuario']; // posto ou patente do cautelante
                        $this->prefixo = $rowCautelados['cautela_prefixo'];
                        $this->modelo = $rowCautelados['modelo'];
                        $this->placa = $rowCautelados['placa'];
                        $this->situacao = $rowCautelados['situacao'];
                        $this->detalhes = $rowCautelados['detalhes'];
                        $this->dataCautela = $rowCautelados['dia_cautela'];
                    }
                }
            //}   
        }

        public function getIdUsuario(){ return $this->idUsuario;}
        public function getNomeCompleto(){ return $this->nomeCompleto;}
        public function getGuerraCautelante(){ return $this->guerraCautelante;}
        public function getPostoCautelante(){ return $this->postoCautelante;}
        public function getPrefixo(){ return $this->prefixo;}
        public function getModelo(){ return $this->modelo;}
        public function getPlaca(){ return $this->placa;}
        public function getSituacao(){ return $this->situacao;}
        public function getDetalhes(){ return $this->detalhes;}
        public function getDataCautela(){ return $this->dataCautela;}
    }

?>