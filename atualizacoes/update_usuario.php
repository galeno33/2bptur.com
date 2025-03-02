<?php
require_once('../conexao/conexao_01.php');
require_once('updateAdm.php');

class UpdateUsuario
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = new Conexao();
    }

    public function getUpdateUsuario()
    {
        $conn = $this->conexao->getConexao();

        if (isset($_POST['updateUsuario'])) {
            $matricula = $_POST['matricula'];
            $posto = $_POST['posto'];
            $classe = $_POST['classe'];
            $funcao2 = $_POST['funcao2'];

            // Cria um hash seguro da senha, se uma nova senha foi fornecida
            if (!empty($_POST['senha'])) {
                $senha = $_POST['senha'];
                $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
            } else {
                // Busca a senha atual do banco de dados
                $sqlSenha = "SELECT senha_usuario FROM usuario WHERE id = ?";
                $stmtSenha = $conn->prepare($sqlSenha);
                $stmtSenha->bind_param("i", $matricula);
                $stmtSenha->execute();
                $resultSenha = $stmtSenha->get_result();
                if ($resultSenha->num_rows === 1) {
                    $rowSenha = $resultSenha->fetch_assoc();
                    $senhaHash = $rowSenha['senha_usuario'];
                } else {
                    echo "<script>alert('Erro ao buscar a senha atual.'); window.location.href='https://2bptur.com/usuario/updateUsuario.php';</script>";
                    return;
                }
                $stmtSenha->close();
            }

            $situacao = ($_POST['flexRadioDefault'] == 1) ? "habilitado" : "desabilitado";
            $upg = 
                "UPDATE usuario 
                 SET posto_usuario = ?, 
                     classe_usuario = ?, 
                     funcao_usuario = ?, 
                     senha_usuario = ?, 
                     situacao = ? 
                 WHERE id = ?";
            $stmt = $conn->prepare($upg);
            $stmt->bind_param("sssssi",
                                $posto,
                                $classe,
                                $funcao2,
                                $senhaHash,
                                $situacao,
                                $matricula
            );
            $res = $stmt->execute();
            $stmt->close();

            if ($res) {
                echo "<script>alert('Atualização concluída com Sucesso!'); window.location.href='https://2bptur.com/usuario/verUsuarios.php';</script>";
            } else {
                echo "<script>alert('Erro na Atualização!'); window.location.href='https://2bptur.com/usuario/verUsuarios.php';</script>";
            }
        }
    }
}

// Instanciar e chamar o método para atualização
$updateUsuario = new UpdateUsuario();
$updateUsuario->getUpdateUsuario();
?>
