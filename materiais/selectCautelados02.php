<?php
    require_once('../usuario/restricaoUsuarios.php');
    require_once('../conexao/conexao_01.php');

    class MaterialCautelados
    {
        private $conexao;
        private $restringir;
        private $idCautelado;
        private $matriculaArmeiro;
        private $material;
        private $tipoMaterial;
        private $tamanhoCalibre;
        private $dataCautela;
        private $postoCautelante;
        private $cautelante;
        private $postoArmeiro;
        private $armeiro;
        private $dataEntrega;
        private $serieMaterial;

        public function __construct()
        {
            $this->conexao = new Conexao();
            $this->restringir = new RestricaoDeUsuario();
            
        }

        public function selectCautelados()
        {
            $conn = $this->conexao->getConexao();
            
            $this->restringir->restricao();
            $bpm = $this->restringir->getBpm();
            $cia = $this->restringir->getCiaRestrito();

            $sql = "SELECT usuario1.nome_de_guerra AS cautelante,
                            usuario2.nome_de_guerra AS armeiro,
                            usuario1.posto_usuario AS posto_cautelante,
                            usuario2.posto_usuario AS posto_armeiro,
                            usuario1.unidade_usuario AS uni_bpm1,
                            usuario2.unidade_usuario AS uni_bpm2,
                            cautela.id_cautela, 
                            cautela.matricula_cautela,
                            cautela.matricula_armeiro,
                            cautela.material,
                            cautela.tipo_material,
                            cautela.tamanho_calibre,
                            cautela.serie_material,
                            cautela.data_cautela, 
                            cautela.data_entrega 
                        FROM cautela
                        JOIN usuario AS usuario1 ON cautela.matricula_cautela = usuario1.id
                        JOIN usuario AS usuario2 ON cautela.matricula_armeiro = usuario2.id
                        WHERE usuario1.unidade_usuario = ?
                        AND usuario2.unidade_usuario = ?
                        AND usuario1.cia = ?
                        AND usuario2.cia = ?         
                        ORDER BY cautela.data_cautela DESC";

            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Erro na preparação da consulta: " . $conn->error);
            }

            $stmt->bind_param('ssii', $bpm, $bpm, $cia, $cia);
            $stmt->execute();
            $result = $stmt->get_result();

            while($row = mysqli_fetch_assoc($result)){
                $this->idCautelado = $row['id_cautela'];
                $this->matriculaArmeiro = $row['matricula_armeiro'];
                $this->material = $row['material'];
                $this->tipoMaterial = $row['tipo_material'];
                $this->tamanhoCalibre = $row['tamanho_calibre'];
                $this->dataCautela = $row['data_cautela'];
                $this->postoCautelante = $row['posto_cautelante'];
                $this->cautelante = $row['cautelante'];
                $this->postoArmeiro = $row['posto_armeiro'];
                $this->armeiro = $row['armeiro'];
                $this->dataEntrega = $row['data_entrega'];
                $this->serieMaterial = $row['serie_material'];
            }

        }
        public function getIdCautela(){ return $this->idCautelado;}
        public function getMtrArmeiro(){ return $this->matriculaArmeiro;}
        public function getMaterial(){ return $this->material;}
        public function getTipoMaterial(){ return $this->tipoMaterial;}
        public function getTamanhoCalibre(){ return $this->tamanhoCalibre;}
        public function getDataCautela(){ return $this->dataCautela;}
        public function getPostoCautelante(){ return $this->postoCautelante;}
        public function getCautelante(){ return $this->cautelante;}
        public function getPostoArmeiro(){ return $this->postoArmeiro;}
        public function getArmeiro(){ return $this->armeiro;}
        public function getDataEntrega(){ return $this->dataEntrega;}
        public function getSerieMaterial(){ return $this->serieMaterial;}


    }
    $materiaisCautelas = new MaterialCautelados();
    $materiaisCautelas->selectCautelados();
    $id = $materiaisCautelas->getIdCautela();
    //var_dump($id);
?>