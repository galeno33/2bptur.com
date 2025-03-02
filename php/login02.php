<?php
        session_start();
        include_once("../conexao/conexao.php");
                
        $usuario = filter_input(INPUT_POST, 'Matricula', FILTER_SANITIZE_STRING);
        $senha = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        if (!empty($usuario) && !empty($senha)) {
            //objeto a ser instaciado da classe SelectUsuario
            $result_usuario = "SELECT id, nome_de_guerra, senha_usuario FROM usuario WHERE id = ?";
            $stmt = mysqli_prepare($conn, $result_usuario);
            mysqli_stmt_bind_param($stmt, 's', $usuario);
            mysqli_stmt_execute($stmt);
            $resultado_usuario = mysqli_stmt_get_result($stmt);

            $_SESSION['matricula'] = $usuario;

            if ($resultado_usuario) {
                $row_usuario = mysqli_fetch_assoc($resultado_usuario);

                if ($row_usuario && password_verify($senha, $row_usuario['senha_usuario'])) {
                    $_SESSION['guerra'] = $row_usuario['nome_de_guerra']; //nome de guerra
                   
                    header("Location: https://2bptur.com/home.php");
                    //header("Location: http://localhost/projetos/1Bptur/home.php");
                    exit(); // Encerra o script após o redirecionamento
                } else {
                    echo "<script>alert('Login ou senha incorretas!'); window.location.href='https://2bptur.com/index.html';</script>";
                    //echo "Login e senha incorretos!";
                    //header("Location: http://localhost/projetos/1Bptur/404.html");
                    //var_dump($senha);
                }
            } else {
                echo "<script>alert('Erro ao consultar o banco de dados!'); window.location.href='https://2bptur.com/index.html';</script>";
                /*$_SESSION['msg'] = "Erro ao consultar o banco de dados.";
                header("Location: http://localhost/projetos/1Bptur/404.html");*/
                exit(); // Encerra o script após o redirecionamento
            }
        } else {
            echo "<script>alert('Login ou senha incorretas!'); window.location.href='https://2bptur.com/index.html';</script>";
            /*$_SESSION['msg'] = "Login e senha incorretos!";
            header("Location: http://localhost/projetos/1Bptur/404.html");*/
            exit(); // Encerra o script após o redirecionamento
        }

?>

