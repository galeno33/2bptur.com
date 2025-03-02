<?php
    require_once('../conexao/conexao_01.php');

    class NegarAutorizacao
    {
        private $conexao;

        public function __construct()
        {
            $this->conexao = new Conexao();
        }

        public function negarAutorizacao()
        {
            $conn = $this->conexao->getConexao();

            // Verificar se o parâmetro GET 'negado' está presente e atualizar o valor da coluna 'autorizacao_permuta' para 'negado'
            if (isset($_GET['negado'])) {
                $id = $_GET['negado']; // Obtém o ID da permuta
                $autorizacao_permuta = "Negado"; // Define o valor para 'negado'

                // Executar a atualização no banco de dados
                $updPermuta = 
                    "UPDATE permutas 
                    SET autorizacao_permuta = ? 
                    WHERE id_permuta = ?";
                $stmt = mysqli_prepare($conn, $updPermuta);
                mysqli_stmt_bind_param($stmt, "si", $autorizacao_permuta, $id);
                $resAuto = mysqli_stmt_execute($stmt);

                // Verificar se a atualização foi bem-sucedida e redirecionar
                if ($resAuto) {
                    echo "<script>alert('Permuta desautorizada com sucesso!'); window.location.href='https://2bptur.com/autorizacao_permuta/permuta_a_autorizar.php';</script>";
                    exit(); // Encerrar o script para evitar a execução adicional
                } else {
                    echo "<script>alert('Erro ao desautorizar a permuta!'); window.location.href='https://2bptur.com/autorizacao_permuta/permuta_a_autorizar.php';</script>";
                    exit(); // Encerrar o script para evitar a execução adicional
                }
            }
        }
    }
    $negaAutorizacao = new NegarAutorizacao();
    $negaAutorizacao->negarAutorizacao();

?>