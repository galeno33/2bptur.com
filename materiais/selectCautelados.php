<?php
    // Definir o caminho absoluto para o diretório raiz do projeto
    //define('ROOT_DIR', dirname(__DIR__));

    require_once('../usuario/restricaoUsuarios.php');
    require_once('variaveisMateriais.php');
    //require_once(ROOT_DIR . '/conexao/conexao_01.php');

    class Cautelados
    {
        //private $conexao;
        private $conn;
        private $restringir;

        public function __construct($conn)
        {
            $this->conn = $conn;
            //$this->conexao = new Conexao();
            $this->restringir = new RestricaoDeUsuario();
            $this->restringir->restricao();
        }

        public function selectCautelados()
        {
            //$conn = $this->conexao->getConexao();

            
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
                        ";
            //ORDER BY cautela.data_cautela DESC
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Erro na preparação da consulta: " . $this->conn->error);
            }

            $stmt->bind_param("ssii", $bpm, $bpm, $cia, $cia);
            $stmt->execute();
            $result = $stmt->get_result();

            $cautelas = [];
            while ($row = $result->fetch_assoc()) {
                $selectCautelas = new Materiais(
                    $row['id_cautela'],
                    $row['matricula_armeiro'],
                    $row['material'],
                    $row['tipo_material'],
                    $row['tamanho_calibre'],
                    $row['data_cautela'],
                    $row['posto_cautelante'],
                    $row['cautelante'],
                    $row['posto_armeiro'],
                    $row['armeiro'],
                    $row['data_entrega'],
                    $row['serie_material']
                );
                $cautelas[] = $selectCautelas;
            }
            $stmt->close();
            return $cautelas;
        }
    }
    
?>
