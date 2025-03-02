<?php
//include('../conexao/conexao.php');
require_once('../conexao/conexao_01.php');
class PermutaController
{
    //private $conn;
    private $conexao;
    //faz referencia a classe conexao
    public function __construct()
    {
        $this->conexao = new Conexao();
        //$this->conn = $conn;
    }
    //faz referencia a classe permuta do arquivo permuta/permuta.php
    //instancia dados da class Permuta 
    public function salvarPermuta(Permuta $permuta)
    {
        $conn = $this->conexao->getConexao();
        $stmt = $conn->prepare("INSERT INTO permutas (matr_permutante, matr_permutado, dia_permuta, aceito_permuta, autorizacao_permuta, justificativa)
                                    VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iissss", 
            $permuta->getSuaMatricula(), 
            $permuta->getMatriculaPermutado(), 
            $permuta->getDataFim(), 
            $permuta->getConfirme(), 
            $permuta->getAutorizacao(), 
            $permuta->getJustificativa()
        );

        if($stmt->execute()){
            echo "<script>alert('Pedido de Permuta Concluida com Sucesso!'); window.location.href='pedirPermutas.php';</script>";
            //header('Location:http://localhost/projetos/1Bptur/confirmPermuta.php');
            exit;
        } else {
            echo "Erro ao executar a permuta: " . $stmt->error;
        }

        $stmt->close();
    }
}
?>
