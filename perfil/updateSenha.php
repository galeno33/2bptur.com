<?php
    require_once('../conexao/conexao_01.php');
    require_once('../usuario/restricaoUsuarios.php');

    class UpdateSenha
    {
        private $conexao;
        private $restringir;

        public function __construct()
        {
            $this->conexao = new Conexao();
            $this->restringir = new RestricaoDeUsuario();
            session_start(); // Certifique-se de que a sessão foi iniciada no construtor
        }

        public function atualizarSenha()
        {
            $conn = $this->conexao->getConexao();
            $this->restringir->restricao(); // Carrega os dados do usuário
            $idUsuario = $_SESSION['matricula']; // Obtenha a matrícula do usuário da sessão

            if (isset($_POST['updateSenha'])) {
                $senha = trim($_POST['senha']);

                if (empty($senha)) {
                    echo "<script>alert('Por favor, insira uma senha.'); window.location.href='perfil.php';</script>";
                    return;
                }

                $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
                $sql = "UPDATE usuario SET senha_usuario = ? WHERE id = ?";

                if ($stmt = $conn->prepare($sql)) {
                    $stmt->bind_param("si", $senhaHash, $idUsuario);
                    $res = $stmt->execute();
                    if ($res) {
                        echo "<script>alert('Atualização de senha concluída com sucesso!'); window.location.href='https://2bptur.com/perfil/perfil.php';</script>";
                    } else {
                        echo "<script>alert('Erro ao atualizar sua senha.'); window.location.href='https://2bptur.com/perfil/perfil.php';</script>";
                    }
                    $stmt->close();
                } else {
                    echo "<script>alert('Erro ao preparar a declaração.'); window.location.href='https://2bptur.com/perfil/perfil.php';</script>";
                }
            }
        }
    }

    $updateSenha = new UpdateSenha();
    $updateSenha->atualizarSenha();
?>
