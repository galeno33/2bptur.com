<?php
    require_once('../conexao/conexao_01.php');

    class Negacao
    {
        private $conexao;

        public function __construct()
        {
            $this->conexao = new Conexao();
        }

        public function negar()
        {
            $conn = $this->conexao->getConexao();

            // Verificar se o parâmetro GET 'negado' está presente e atualizar o valor da coluna 'autorizacao_permuta' para 'negado'
            if (isset($_GET['negar'])) {
                $id = $_GET['negar']; // Obtém o ID da permuta
                $confirmar = "Negado"; // Define o valor para 'negado'

                // Executar a atualização no banco de dados
                $updPermuta = 
                    "UPDATE permutas 
                    SET aceito_permuta = ? 
                    WHERE id_permuta = ?";
                $stmt = mysqli_prepare($conn, $updPermuta);
                mysqli_stmt_bind_param($stmt, "si", $confirmar, $id);
                $resAuto = mysqli_stmt_execute($stmt);

                // Verificar se a atualização foi bem-sucedida e redirecionar
                if ($resAuto) {
                    echo "<script>alert('Você negou a permuta.'); window.location.href='https://2bptur.com/minha_permuta/minhaPermuta.php';</script>";
                    //header('Location: http://localhost/projetos/1Bptur/permuta/minhaPermuta.php');
                    exit(); // Encerrar o script para evitar a execução adicional
                } else {
                    echo "<script>alert('Erro ao negar a permuta!'); window.location.href='https://2bptur.com/minha_permuta/minhaPermuta.php';</script>";
                    //header('Location: http://localhost/projetos/1Bptur/erroUpdAutorizacao.php');
                    exit(); // Encerrar o script para evitar a execução adicional
                }
            }
        }
    }
    $negacao = new Negacao();
    $negacao->negar();

?>