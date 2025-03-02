<?php
    require_once('../conexao/conexao_01.php');

    class Confirmacao
    {
        private $conexao;

        public function __construct()
        {
            $this->conexao = new Conexao();
        }

        public function confirmar()
        {
            $conn = $this->conexao->getConexao();
            
            // Verificar se o parâmetro GET 'autorizado' está presente e atualizar o valor da coluna 'autorizacao_permuta' para 'autorizado'
            if (isset($_GET['confirmar'])) {
                $id = $_GET['confirmar']; // Obtém o ID da permuta
                $confirmar = "Confirmado"; // Define o valor para 'autorizado'

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
                    echo "<script>alert('Sua permuta foi confirmada, aguarde a autorização!'); window.location.href='https://2bptur.com/minha_permuta/minhaPermuta.php';</script>";
                    //header('Location: http://localhost/projetos/1Bptur/permuta/minhaPermuta.php');
                    exit(); // Encerrar o script para evitar a execução adicional
                } else {
                    echo "<script>alert('Erro ao confirmar a permuta!'); window.location.href='https://2bptur.com/minha_permuta/minhaPermuta.php';</script>";
                    //header('Location: http://localhost/projetos/1Bptur/erroUpdAutorizacao.php');
                    exit(); // Encerrar o script para evitar a execução adicional
                }
            }

        }

    }
    $confirmacao = new Confirmacao();
    $confirmacao->confirmar();

?>