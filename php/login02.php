<?php
        session_start();
        include_once("../conexao/conexao.php");
      
        $usuario = filter_input(INPUT_POST, 'Matricula', FILTER_SANITIZE_STRING);
        $senha = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        if (!empty($usuario) && !empty($senha)) {
            $result_usuario = "SELECT id,nome_de_guerra, senha_usuario FROM usuario WHERE id='$usuario'";
          /* $result_usuario = "SELECT usuario.id, usuario.nome_de_guerra, usuario.posto_usuario, usuario.senha_usuario, ranking.miker_Bo, ranking.sigo_ocorrencia, ranking.tipificacao_crime, ranking.dia_mes
                                FROM ranking JOIN usuario ON ranking.matricula = usuario.id WHERE usuario.id = $usuario";*/

            $resultado_usuario = mysqli_query($conn, $result_usuario);

            $_SESSION['matricula'] = $usuario;

            if ($resultado_usuario) {
                $row_usuario = mysqli_fetch_assoc($resultado_usuario);

                if ($row_usuario && password_verify($senha, $row_usuario['senha_usuario'])) {
                   // $_SESSION['id'] = $row_usuario['id'];//matricula
                    $_SESSION['guerra'] = $row_usuario['nome_de_guerra'];//nome de guerra
                   /* $_SESSION['posto'] = $row_usuario['posto_usuario'];//posto ou patente
                    $_SESSION['miker'] = $row_usuario['miker_Bo'];
                    $_SESSION['sigo'] = $row_usuario['sigo_ocorrencia'];
                    $_SESSION['tipificacao'] = $row_usuario['tipificacao_crime'];
                    $_SESSION['data'] = $row_usuario['dia_mes'];*/
                   // $_SESSION['pontos'] = $row_usuario['pontos_ranking'];

                   /* switch($_SESSION['tipificacao']){
                        case 1:
                            $_SESSION['tipificacao'] = "Furto";
                            break;
                        case 2:
                            $_SESSION['tipificacao'] = "Roubo";
                            break;
                        case 3:
                            $_SESSION['tipificacao'] = "Receptação";
                            break;
                        case 4:
                            $_SESSION['tipificacao'] = "Arma de Fogo";
                            break;
                        case 5:
                            $_SESSION['tipificacao'] = "Objeto Perfurocortante";
                            break;
                        case 6:
                            $_SESSION['tipificacao'] = "Entorpecentes";
                            break;
                        case 7:
                            $_SESSION['tipificacao'] = "Veiculo Recuperado";
                            break;
                        case 8:
                            $_SESSION['tipificacao'] = "Kadron Apreendido";
                            break;
                        case 9:
                            $_SESSION['tipificacao'] = "Foragido";
                            break;
                        case 10:
                            $_SESSION['tipificacao'] = "Outras Tipificações";
                    }*/

                    header("Location: http://localhost/projetos/1Bptur/home.php");
                } else {
                    echo "Login e senha incorretos!";
                    //header("Location: http://localhost/projetos/1Bptur/404.html");
                    var_dump($senha);
                }
            } else {
                $_SESSION['msg'] = "Erro ao consultar o banco de dados.";
                header("Location: http://localhost/projetos/1Bptur/404.html");
            }
        } else {
            $_SESSION['msg'] = "Login e senha incorretos!";
            header("Location: http://localhost/projetos/1Bptur/404.html");
        }
?>

