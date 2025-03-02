<?php
require_once('../conexao/conexao_01.php');
require_once('../usuario/restricaoUsuarios.php');
require_once('variaveisMateriais.php');

class Historicos
{
    private $conexao;
    private $restringir;

    public function __construct()
    {
        $this->conexao = new Conexao();
        $this->restringir = new RestricaoDeUsuario();
    }

    public function selectHistorico()
    {
        $conn = $this->conexao->getConexao();
        $this->restringir->restricao();
        $bpm = $this->restringir->getBpm();

        $historicos = [];

        $sql = "SELECT usuario1.nome_de_guerra AS cautelante,
                        usuario2.nome_de_guerra AS armeiro,
                        usuario2.posto_usuario AS posto_armeiro,
                        usuario1.unidade_usuario AS uni_bpm1,
                        usuario2.unidade_usuario AS uni_bpm2,
                        cautela.id_cautela, 
                        cautela.matricula_cautela,
                        cautela.matricula_armeiro,
                        cautela.material,
                        cautela.tipo_material,
                        cautela.serie_material,
                        cautela.tamanho_calibre, 
                        cautela.data_cautela, 
                        cautela.data_entrega 
                FROM cautela
                JOIN usuario AS usuario1 ON cautela.matricula_cautela = usuario1.id
                JOIN usuario AS usuario2 ON cautela.matricula_armeiro = usuario2.id
                WHERE usuario1.unidade_usuario = ?
                AND usuario2.unidade_usuario = ?           
                ORDER BY cautela.data_cautela DESC";
                        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $bpm, $bpm);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $selectHistoricos = new Materiais(
                $row['id_cautela'],
                $row['matricula_armeiro'],
                $row['material'],
                $row['tipo_material'],
                $row['tamanho_calibre'],
                $row['data_cautela'],
                $row['cautelante'],
                $row['posto_armeiro'],
                $row['armeiro'],
                $row['data_entrega'],
                $row['serie_material'] // Certifique-se de que 'serie_material' está correto para getSeries()
            );
            $historicos[] = $selectHistoricos;
        }
        return $historicos;
    }
}
?>