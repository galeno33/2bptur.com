<?php
    require_once('../conexao/conexao_01.php');

    class CauteladasDeMateriais
    {
        private $conexao;
        private $idUsuario;
        private $nomeCompleto;
        private $guerraCautelante;
        private $postoCautelante;
        private $material;
        private $quantidade;
        private $tipoMateriais;
        private $tamanhoCalibre;
        private $serie;
        private $diaCautela;

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
                    cautela.id_cautela,
                    cautela.matricula_cautela,
                    cautela.material,
                    cautela.quantidade,
                    cautela.tipo_material,
                    cautela.tamanho_calibre,
                    cautela.serie_material,
                    cautela.data_cautela
                FROM cautela
                JOIN usuario ON cautela.matricula_cautela = usuario.id
                WHERE cautela.id_cautela = ?";
                        
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
                        $this->material = $rowCautelados['material'];
                        $this->quantidade = $rowCautelados['quantidade'];
                        $this->tipoMateriais = $rowCautelados['tipo_material'];
                        $this->tamanhoCalibre = $rowCautelados['tamanho_calibre'];
                        $this->serie = $rowCautelados['serie_material'];
                        $this->diaCautela = $rowCautelados['data_cautela'];
                    }
                }
            //}   
        }

        public function getIdUsuario(){ return $this->idUsuario;}
        public function getNomeCompleto(){ return $this->nomeCompleto;}
        public function getGuerraCautelante(){ return $this->guerraCautelante;}
        public function getPostoCautelante(){ return $this->postoCautelante;}
        public function getMaterial(){ return $this->material;}
        public function getQuantidade(){ return $this->quantidade;}
        public function getTipoMaterial(){ return $this->tipoMateriais;}
        public function getTamanhoCalibre(){ return $this->tamanhoCalibre;}
        public function getSerie(){ return $this->serie;}
        public function getDiaCautela(){ return $this->diaCautela;}
    }

?>