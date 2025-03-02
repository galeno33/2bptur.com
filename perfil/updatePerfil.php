<?php
    require_once('../conexao/conexao_01.php');
    require_once('../usuario/restricaoUsuarios.php');

    class UpdatePerfil
    {
        private $conexao;
        private $restringir;

        public function __construct()
        {
            $this->conexao = new Conexao();
            $this->restringir = new RestricaoDeUsuario();
        }

        public function getAtualizarPerfil()
        {
            $conn = $this->conexao->getConexao();
            $id_usuario = $this->restringir->getIdUsuario();

            if(isset($_POST['updateUsuario'])){
                $guerra = $_POST['nomeGuerra'];
                $posto = $_POST['posto'];
                //$classe = $_POST['classe'];
                $telefone = $_POST['telefone'];
                $senha = $_POST['senha'];
        
                // Cria um hash seguro da senha
                $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
                
                //$situacao = ($_POST['flexRadioDefault'] == 1) ? "habilitado" : "desabilitado";
                $upg = "UPDATE `usuario` SET nome_de_guerra='$guerra',
                                             posto_usuario='$posto',
                                             telefone_usuario='$telefone',
                                             senha_usuario='$senhaHash'
                                             WHERE id=$id_usuario";
        
                //classe_usuario='$classe',
                $res=mysqli_query($conn, $upg);
                    if($res){
                        //echo "Atualizado com sucesso!";
                        echo "<script>alert('Perfil atualizada com sucesso!'); window.location.href='https://2bptur.com/perfil/perfil.php';</script>";
                        //header('Location:http://localhost/projetos/1Bptur/confirUpgrade.php');
                        //header('Location:https://2bptur.com/confirUpgrade.php');
                    }else{
                        echo "<script>alert('Erro na atualização do perfil!'); window.location.href='https://2bptur.com/perfil/perfil.php';</script>";
                        //header('Location:http://localhost/projetos/1Bptur/erroUpgrade.php');
                        //header('Location:https://2bptur.com/erroUpgrade.php');
                        //die(mysqli_error($conn));
                    }
            }
        }
    }

?>