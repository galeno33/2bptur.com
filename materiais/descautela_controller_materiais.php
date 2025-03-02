<?php
    require_once('../conexao/conexao_01.php');

    class DescautelarMaterial
    {
        private $conexao;
        private $id; //matricula
        private $guerra; //nome de guerra
        private $posto; //posto ou patente
        private $mtrCautelante;
        private $material;
        private $tipoMaterial;
        private $quantidade;
        private $tam_cal;
        private $serie;
        private $dataCautela;


        public function __construct()
        {
            $this->conexao = new Conexao();
        }

        public function descautelaCautelaMateriais($id_detalhes)
        {
            
            try {
                $conn = $this->conexao->getConexao();
            
                if (!$conn) {
                    throw new Exception("Falha na conexão: " . mysqli_connect_error());
                }
            
                if (!is_numeric($id_detalhes)) {
                    throw new Exception("ID inválido: " . $id_detalhes);
                }
            
                $sql = "SELECT 
                            usuario.id,
                            usuario.nome_de_guerra,
                            usuario.posto_usuario,
                            cautela.id_cautela,
                            cautela.matricula_cautela,
                            cautela.material,
                            cautela.quantidade,
                            cautela.tipo_material,
                            cautela.tamanho_calibre,
                            cautela.serie_material,
                            cautela.data_cautela,
                            cautela.data_entrega
                        FROM cautela
                        JOIN usuario AS usuario ON cautela.matricula_cautela = usuario.id
                        WHERE cautela.id_cautela = ?";
            
                if (!$stmt = $conn->prepare($sql)) {
                    throw new Exception("Erro ao preparar a consulta: " . $conn->error);
                }
            
                $stmt->bind_param("i", $id_detalhes);
                if (!$stmt->execute()) {
                    throw new Exception("Erro ao executar a consulta: " . $stmt->error);
                }
            
                $result = $stmt->get_result();
            
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    //var_dump($row); // Depuração: Verificar os dados retornados
                    $this->id = $row['id_cautela'];
                    $this->guerra = $row['nome_de_guerra'];
                    $this->posto = $row['posto_usuario'];
                    $this->mtrCautelante = $row['matricula_cautela'];
                    $this->material = $row['material'];
                    $this->quantidade = $row['quantidade'];
                    $this->tipoMaterial = $row['tipo_material'];
                    $this->tam_cal = $row['tamanho_calibre'];
                    $this->serie = $row['serie_material'];
                    $this->dataCautela = $row['data_cautela'];
                } else {
                    throw new Exception("Nenhum registro encontrado para o ID: $id_detalhes.");
                }
            
                $stmt->close();
                $conn->close();
            } catch (Exception $e) {
                error_log($e->getMessage()); // Log do erro
                echo $e->getMessage(); // Exibe o erro no navegador para depuração
            }
        }

        // Getters
        public function getId() { return $this->id; }
        public function getGuerraCautelante() { return $this->guerra; }
        public function getPostoCautelante() { return $this->posto; }
        public function getCautelante() { return $this->mtrCautelante; }
        public function getMaterial(){ return $this->material; }
        public function getQuantidade(){ return $this->quantidade; }
        public function getTipoMaterial(){ return $this->tipoMaterial; }
        public function getTamanhoCalibre(){ return $this->tam_cal; }
        public function getSerie(){ return $this->serie; }
        public function getDataCautela(){ return $this->dataCautela; }
    }
?>