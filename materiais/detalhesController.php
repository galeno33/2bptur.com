<?php
    require_once('../conexao/conexao_01.php');

    class Detalhes
    {
        private $conexao;
        private $id1;
        private $guerraCautelante;
        private $guerraArmeiro;
        private $postoCautelante;
        private $postoArmeiro;
        private $cautela;
        private $material;
        private $quantidade;
        private $tipoMaterial;
        private $dataCautela;
        private $dataEntrega;
        private $serie;

        public function __construct()
        {
            $this->conexao = new Conexao();
        }

        public function detalhesCautela()
        {

            //if(isset($_GET['detalhes'])){
            $id_detalhes = $_GET['detalhes'];
            $conn = $this->conexao->getConexao();
        
            $sql = 
                "SELECT usuario1.id AS idUsuario1,
                    usuario2.id AS idUsuario2, 
                    usuario1.nome_de_guerra AS guerra1,
                    usuario2.nome_de_guerra AS guerra2, 
                    usuario1.posto_usuario AS posto1,
                    usuario2.posto_usuario AS posto2, 
                    cautela.id_cautela,
                    cautela.matricula_cautela,
                    cautela.matricula_armeiro,
                    cautela.material, 
                    cautela.quantidade, 
                    cautela.tipo_material, 
                    cautela.data_cautela,
                    cautela.data_entrega,
                    cautela.serie_material
                FROM cautela
                JOIN usuario AS usuario1 ON cautela.matricula_cautela = usuario1.id
                JOIN usuario AS usuario2 ON cautela.matricula_armeiro = usuario2.id
                WHERE cautela.id_cautela = ?";
                        
                //$_SESSION['id_detalhes'] = $id_detalhes;
        
                if ($stmt = $conn->prepare($sql)) {
                    $stmt->bind_param("i", $id_detalhes);
                    $stmt->execute();
                    $result = $stmt->get_result();
        
                    if ($rowDescautelar = $result->fetch_assoc()) {
                        $this->id1 = $rowDescautelar['idUsuario1']; // matricula
                        $this->guerraCautelante = $rowDescautelar['guerra1']; // nome de guerra do cautelante
                        $this->guerraArmeiro = $rowDescautelar['guerra2'];
                        $this->postoCautelante = $rowDescautelar['posto1']; // posto ou patente do cautelante
                        $this->postoArmeiro = $rowDescautelar['posto2']; // posto ou patente do armeiro
                        $this->cautela = $rowDescautelar['matricula_cautela'];
                        $this->material = $rowDescautelar['material'];
                        $this->quantidade = $rowDescautelar['quantidade'];
                        $this->tipoMaterial = $rowDescautelar['tipo_material'];
                        $this->dataCautela = $rowDescautelar['data_cautela'];
                        $this->dataEntrega = $rowDescautelar['data_entrega'];
                        $this->serie = $rowDescautelar['serie_material'];
                    }
                }
            //}   
        }

        public function getId1()
        {
            return $this->id1;
        }
        public function getGuerraCautelante()
        {
            return $this->guerraCautelante;
        }
        public function getGuerraArmeiro()
        {
            return $this->guerraArmeiro;
        }
        public function getPostoCautelante()
        {
            return $this->postoCautelante;
        }
        public function getPostoArmeiro()
        {
            return $this->postoArmeiro;
        }
        public function getCautela()
        {
            return $this->cautela;
        }
        public function getMaterial()
        {
            return $this->material;
        }
        public function getQuantidade()
        {
            return $this->quantidade;
        }
        public function getTipoMaterial()
        {
            return $this->tipoMaterial;
        }
        public function getDataCautela()
        {
            return $this->dataCautela;
        }
        public function getDataEntrega()
        {
            return $this->dataEntrega;
        }
        public function getSerie()
        {
            return $this->serie;
        }
    }

?>