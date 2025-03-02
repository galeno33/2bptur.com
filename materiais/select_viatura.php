<?php
    require_once('../conexao/conexao_01.php');
    require_once('../usuario/restricaoUsuarios.php');
    require_once('variaveisViatura.php');

    class Viatura
    {
        private $conexao;
        private $restringir;

        public function __construct()
        {
            $this->conexao = new Conexao();
            $this->restringir = new RestricaoDeUsuario();
        }
        //função que executa o select com relacionamento de viatura e usuario
        public function selecionarViatura()
        {
            $conn = $this->conexao->getConexao();
            $this->restringir->restricao();
            $bpm = $this->restringir->getBpm();

            $viatura = [];

            $sqlVtr = "SELECT
                        usuario.id,
                        usuario.unidade_usuario,
                        usuario.nome_completo,
                        usuario.nome_de_guerra,
                        usuario.posto_usuario,
                        usuario.cia,
                        viatura.id_prefixo,
                        viatura.modelo,
                        viatura.placa,
                        viatura.situacao,
                        viatura.cautela,
                        viatura.detalhes,
                        cautela_viatura.idCautela,
                        cautela_viatura.cautela_prefixo,
                        cautela_viatura.matricula_motorista,
                        cautela_viatura.matricula_armeiro,
                        cautela_viatura.dia_cautela,
                        cautela_viatura.dia_entrega,
                        cautela_viatura.area_de_atuacao
                    FROM viatura
                    JOIN cautela_viatura ON viatura.id_prefixo = cautela_viatura.cautela_prefixo
                    JOIN usuario ON cautela_viatura.matricula_motorista = usuario.id
                    WHERE usuario.unidade_usuario = ?";
            $stmt = $conn->prepare($sqlVtr);
            $stmt->bind_param("s", $bpm);
            $stmt->execute();
            $result = $stmt->get_result();
            while($row = $result->fetch_assoc())
            {
                $selecionarViaturas = new Viaturas
                (
                    $row['idCautela'],
                    //$row['id_prefixo'],
                    $row['cautela_prefixo'],
                    $row['placa'],
                    $row['nome_completo'],
                    $row['nome_de_guerra'],
                    $row['posto_usuario'],
                    $row['dia_cautela'],
                    $row['dia_entrega'],
                    $row['modelo'],
                    $row['matricula_motorista'],
                    $row['matricula_armeiro'],
                    $row['area_de_atuacao'],
                    $row['cia']
                );
                $viatura[] = $selecionarViaturas;
            }
            return $viatura;
        }
    }


?>