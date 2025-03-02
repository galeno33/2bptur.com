<?php
    /*****desenvolvido por Fabio Galeno*****/
    require_once('../conexao/conexao_01.php');

    class DeleteVtr
    {
        private $conexao;

        public function __construct()
        {
            $this->conexao = new Conexao();
        }
        public function deletandoVtr()
        {
            $conn = $this->conexao->getConexao();
            if(isset($_GET['deletVtr'])){
                $idDelete = mysqli_real_escape_string($conn, $_GET['deletVtr']);
                //teste de Requisição
                //var_dump($idDelete);
                $sqlDeletVtr = "DELETE FROM viatura WHERE id_prefixo = ?";
                
                if($stmt = $conn->prepare($sqlDeletVtr)){
                    $stmt->bind_param("i", $idDelete);
                    $stmt->execute();
                }
                $res = mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                if($res)
                {
                    echo "<script>alert('Item deletado com Sucesso!'); window.location.href='../P4/cargas_da_unidade.php';</script>";
                }else {
                    echo "<script>alert('Erro ao deletar Item!'); window.location.href='../P4/cargas_da_unidade.php';</script>";
                }

            }
        }
    }
    $deleteVtr = new DeleteVtr();
    $deleteVtr->deletandoVtr();
?>