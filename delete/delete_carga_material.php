<?php
    /*****Desenvolvido por Fabio Galeno*****/
    require_once('../conexao/conexao_01.php');


    class DeleteMaterial 
    {
        private $conexao;

        public function __construct()
        {
            $this->conexao = new Conexao();
        }

        public function deletando()
        {
            $conn = $this->conexao->getConexao();
            if(isset($_GET['deletar'])){
                $idDelete = mysqli_real_escape_string($conn, $_GET['deletar']);
                //teste de requisição
                //var_dump($idDelete);
                //$conn = $this->conexao->getConexao();

                $sqlDeletMtr = "DELETE FROM material WHERE id_material = ?";

                if($stmt = $conn->prepare($sqlDeletMtr)){
                    $stmt->bind_param("i", $idDelete);
                    $stmt->execute();
                    
                }
                $res = mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                if($res){
                    echo "<script>alert('Item deletado com Sucesso!'); window.location.href='../P4/cargas_da_unidade.php';</script>";
                }else {
                    echo "<script>alert('Erro ao deletar Item!'); window.location.href='../P4/cargas_da_unidade.php';</script>";
                }
            }
        }

    }
    $deleteMtr = new DeleteMaterial();
    $deleteMtr->deletando();

?>