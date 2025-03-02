<?php
    require_once('../conexao/conexao_01.php');

    class DescautelaViatura
    {
        private $conexao;
        private $id1;
        private $guerraCautelante;
        private $guerraArmeiro;
        private $postoCautelante;
        private $postoArmeiro;
        private $mtrCautelante;
        private $mtrArmeiro;
        private $prefixo;
        private $modelo;
        private $placa;
        private $dataCautela;
        //private $dataEntrega;

        public function __construct()
        {
            $this->conexao = new Conexao();
        }

        public function detalhesCautelaViatura($id_detalhes)
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
                            usuario.id AS idUsuario,
                            usuario.nome_de_guerra AS guerra,
                            usuario.posto_usuario AS posto, 
                            cautela_viatura.idCautela,
                            cautela_viatura.cautela_prefixo,
                            cautela_viatura.matricula_motorista,
                            cautela_viatura.matricula_armeiro,
                            cautela_viatura.dia_cautela, 
                            cautela_viatura.dia_entrega,
                            viatura.id_prefixo,
                            viatura.modelo,
                            viatura.placa
                        FROM cautela_viatura
                        JOIN usuario AS usuario ON cautela_viatura.matricula_motorista = usuario.id
                        JOIN viatura ON cautela_viatura.cautela_prefixo = viatura.id_prefixo
                        WHERE cautela_viatura.idCautela = ?";
            
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
                    $this->id1 = $row['idCautela'];
                    $this->guerraCautelante = $row['guerra'];
                    $this->postoCautelante = $row['posto'];
                    $this->mtrCautelante = $row['matricula_motorista'];
                    $this->mtrArmeiro = $row['matricula_armeiro'];
                    $this->prefixo = $row['id_prefixo'];
                    $this->modelo = $row['modelo'];
                    $this->placa = $row['placa'];
                    $this->dataCautela = $row['dia_cautela'];//date('d-m-Y', strtotime($row['dia_cautela']));
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
        public function getId1() { return $this->id1; }
        public function getGuerraCautelante() { return $this->guerraCautelante; }
        public function getGuerraArmeiro() { return $this->guerraArmeiro; }
        public function getPostoCautelante() { return $this->postoCautelante; }
        public function getPostoArmeiro() { return $this->postoArmeiro; }
        public function getCautelante() { return $this->mtrCautelante; }
        public function getArmeiro() { return $this->mtrArmeiro; }
        public function getPrefixo() { return $this->prefixo; }
        public function getModelo() { return $this->modelo; }
        public function getPlaca() { return $this->placa; }
        public function getDataCautela() { return $this->dataCautela; }
    }
?>