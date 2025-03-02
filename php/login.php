<?php
    //require_once('../usuario/usuario.php');
    require_once('../select_insert_usuario/select_insert.php');
    
    class Login{
        private $selectUsuarios;
        //private $matricula;
        
        //metodo 
        public function __construct()
        {
            $this->selectUsuarios = new SelectUsuario();     
        }
        //adicionar metodo para chamar classe usuario e instaciar nome de guerra
        

        public function fazerLogin(){
            //logica do login
            if(isset($_POST['Matricula']) && isset($_POST['password']) ){
                $matricula = $_POST['Matricula'];
                $senha = $_POST['password'];
                
                //var_dump($matricula, $senha);
                //Tentar fazer o login com os dados 
                if($this->selectUsuarios->selectUsuario($matricula, $senha)){
                    session_start();
                    $_SESSION['matricula'] = $matricula;
                    
                    //Credenciais válidas, redireciona  para home.php
                    header("Location: https://2bptur.com/home.php");
                    //header("Location: http://localhost/projetos/1Bptur/home.php");
                    exit();
                }else{
                    return false;
                }
            }else{
                //se os campos não foram enviados, retorna false
                return false;
            }

        }

        /*public function mtr(){
            return $this->matricula;
        }*/
  
    }
    
    // Instanciando a classe Login
    $login = new Login();
    
    // Verificando se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Chamando o método fazerLogin para realizar a autenticação
        $resultado = $login->fazerLogin();

        if ($resultado === false) {
            // Se o login falhar, você pode exibir uma mensagem de erro, redirecionar para uma página de erro ou fazer qualquer outra ação necessária.
            //echo "<script>alert('Matricula/ID ou senha invalida!'); window.location.href='https://localhost/projetos/1Bptur/index.html';</script>";
            echo "<script>alert('Matricula/ID ou senha invalida!'); window.location.href='https://2bptur.com/index.html';</script>";
            //echo "Credenciais inválidas. Por favor, tente novamente.";
        }
    }
?>