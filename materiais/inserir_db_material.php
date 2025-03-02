<?php
    session_start();
    ob_start();
    include('../conexao/conexao.php');
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
           
            //$token = $_SESSION['token'];
            $mtr = $_SESSION['mtr'];
            if (isset($_SESSION['token'])) {
                // O token é válido e não expirou
                //var_dump($_SESSION['mtr']);
                //$token = $_SESSION['token'];
                
                //select do usuario
               $sql = "SELECT id, token_confirmacao, telefone_usuario  FROM usuario WHERE id = '$mtr' LIMIT 1";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                //$mtr = $row['id'];
                $buscarToken = $row['token_confirmacao'];
               
                if(isset($_POST['salvar'])){ 
                    //var_dump($_SESSION['mtr']);
                    $matricula = $mtr;
                    $material = $_POST['material'];
                    $dataCautela = $_POST['diaCautela'];
                    $quantidade = $_POST['quantidade'];
                    //--------------------------------armamento-----------------------------------------
                    if($material == 1){
                        
                        $material = "Armamento";
                        //var_dump($matricula, $material, $dataCautela, $quantidade);
                        //---------------------------------cadastro do Armamento---------------------------------
                        if(empty($_POST['tipoArmamento']) || empty($_POST['tipoCalibre'])
                            || empty($_POST['serie']) || empty($_POST['token'])
                        ){
                            echo "<script>alert('Preencha todos os campos!'); window.location.href='cautelarMaterial.php';</script>";
                            // Redirecionar para a página de validação com alerta SweetAlert2
                             
                            
                        }else {
                            $tipoMaterial = $_POST['tipoArmamento'];
                            $tamanho = $_POST['tipoCalibre'];
                            $serie = $_POST['serie'];
                            $chave = $_POST['token'];
                            switch($tipoMaterial){
                                case 1:
                                    $tipoMaterial = "Pistola";
                                    break;
                                case 2:
                                    $tipoMaterial = "Revolver";
                                    break;
                                case 3:
                                    $tipoMaterial = "Fuzil";
                                    break;
                                case 4:
                                    $tipoMaterial = "Carabina";
                                    
                            }
                            switch($tamanho){
                                case 1:
                                    $tamanho = ".40";
                                    break;
                                case 2:
                                    $tamanho = ".556";
                                    break;
                                case 3:
                                    $tamanho = ".762";
                                    break;
                                case 4:
                                    $tamanho = ".38";
                                    break;
                                case 5:
                                    $tamanho = ".22";
                                    break;
                                case 6:
                                    $tamanho = ".32";
                            }
                       
                            if($chave == $buscarToken){
                                // Prepare a query SQL
                                $sql = "INSERT INTO cautela (matricula_cautela, material, quantidade, tipo_material, tamanho_calibre, serie_material, data_cautela) 
                                VALUES (?, ?, ?, ?, ?, ?, ?)";
                        
                                if ($stmt = $conn->prepare($sql)) {
                                    $stmt->bind_param("isissss", $matricula, $material, $quantidade, $tipoMaterial, $tamanho, $serie, $dataCautela,);
                                    if ($stmt->execute()) {
                                        echo "<script>alert('Cautela concluida com sucesso!'); window.location.href='cautelarMaterial.php';</script>";
                                        //atualizar o token no banco de dados
                                        $chaveToken = NULL;
                                        $sqlUpdate = "UPDATE usuario SET token_confirmacao = ? WHERE id = ? LIMIT 1";
                
                                        //$result_up_usuario = $conn->prepare($sqlUpdate);
                                        $result_up_usuario = $conn->prepare($sqlUpdate);
                                        $result_up_usuario->bind_param('ii', $chaveToken, $mtr);
                                        $result_up_usuario->execute();

                                    } else {
                                        echo "Erro ao salvar os dados: " . $stmt->error;
                                    }
                                    $stmt->close();
                                } else {
                                    echo "Erro ao preparar a consulta: " . $conn->error;
                                }
                                
                                // Limpar o token após a utilização
                                unset($buscarToken);
                            }
                        }
                    }else
                    //---------------------------------calete balistico --------------------------------
                    if($material == 2){
                        $material = "Colete balistico";
                        //var_dump($matricula, $material, $dataCautela, $quantidade);
                        if(empty($_POST['tipoColete']) || empty($_POST['tamanhoColete'])
                            || empty($_POST['serie']) || empty($_POST['token'])
                        ){
                            echo "<script>alert('Preencha todos os campos!'); window.location.href='cautelarMaterial.php';</script>";
                            // Redirecionar para a página de validação com alerta SweetAlert2
                             
                            
                        }else {
                            $tipoMaterial = $_POST['tipoColete'];
                            $tamanho = $_POST['tamanhoColete'];
                            $serie = $_POST['serie'];
                            $chave = $_POST['token'];
                            switch($tipoMaterial){
                                case 1:
                                    $tipoMaterial = "Feminino";
                                    break;
                                case 2:
                                    $tipoMaterial = "Masculino";
                                  
                            }
                            switch($tamanho){
                                case 1:
                                    $tamanho = "P";
                                    break;
                                case 2:
                                    $tamanho = "M";
                                    break;
                                case 3:
                                    $tamanho = "G";
                                    break;
                                case 4:
                                    $tamanho = "GG";
                                    
                            }
                       
                            if($chave == $buscarToken){
                                // Prepare a query SQL
                                $sql = "INSERT INTO cautela (matricula_cautela, material, quantidade, tipo_material, tamanho_calibre, serie_material, data_cautela) 
                                VALUES (?, ?, ?, ?, ?, ?, ?)";
                        
                                if ($stmt = $conn->prepare($sql)) {
                                    $stmt->bind_param("isissss", $matricula, $material, $quantidade, $tipoMaterial, $tamanho, $serie, $dataCautela,);
                                    if ($stmt->execute()) {
                                        echo "<script>alert('Cautela concluida com Sucesso!'); window.location.href='cautelarMaterial.php';</script>";
                                        //atualizar o token no banco de dados
                                        $chaveToken = NULL;
                                        $sqlUpdate = "UPDATE usuario SET token_confirmacao = ? WHERE id = ? LIMIT 1";
                
                                        //$result_up_usuario = $conn->prepare($sqlUpdate);
                                        $result_up_usuario = $conn->prepare($sqlUpdate);
                                        $result_up_usuario->bind_param('ii', $chaveToken, $mtr);
                                        $result_up_usuario->execute();

                                    } else {
                                        echo "Erro ao salvar os dados: " . $stmt->error;
                                    }
                                    $stmt->close();
                                } else {
                                    echo "Erro ao preparar a consulta: " . $conn->error;
                                }
                                
                                // Limpar o token após a utilização
                                unset($buscarToken);
                            }
                        }
                    }else 
                    //-------------------------------------munição----------------------------------------
                    if($material == 3){
                        $material = "Munição";
                        $tipoMaterial = NULL;
                        $serie = NULL;
                        //var_dump($matricula, $material, $dataCautela, $quantidade);
                        if(empty($_POST['tipoCalibre']) || empty($_POST['token'])
                        ){
                            echo "<script>alert('Preencha todos os campos!'); window.location.href='cautelarMaterial.php';</script>";
                            // Redirecionar para a página de validação com alerta SweetAlert2
                             
                            
                        }else {
                            $tamanho = $_POST['tipoCalibre'];
                            $chave = $_POST['token'];
                            switch($tamanho){
                                case 1:
                                    $tamanho = ".40";
                                    break;
                                case 2:
                                    $tamanho = ".556";
                                    break;
                                case 3:
                                    $tamanho = ".762";
                                    break;
                                case 4:
                                    $tamanho = ".38";
                                    break;
                                case 5:
                                    $tamanho = ".22";
                                    break;
                                case 6:
                                    $tamanho = ".32";
                            }
                       
                            if($chave == $buscarToken){
                                // Prepare a query SQL
                                $sql = "INSERT INTO cautela (matricula_cautela, material, quantidade, tipo_material, tamanho_calibre, serie_material, data_cautela) 
                                VALUES (?, ?, ?, ?, ?, ?, ?)";
                        
                                if ($stmt = $conn->prepare($sql)) {
                                    $stmt->bind_param("isissss", $matricula, $material, $quantidade, $tipoMaterial, $tamanho, $serie, $dataCautela,);
                                    if ($stmt->execute()) {
                                        echo "<script>alert('Cautela concluida com Sucesso!'); window.location.href='cautelarMaterial.php';</script>";
                                        //atualizar o token no banco de dados
                                        $chaveToken = NULL;
                                        $sqlUpdate = "UPDATE usuario SET token_confirmacao = ? WHERE id = ? LIMIT 1";
                
                                        //$result_up_usuario = $conn->prepare($sqlUpdate);
                                        $result_up_usuario = $conn->prepare($sqlUpdate);
                                        $result_up_usuario->bind_param('ii', $chaveToken, $mtr);
                                        $result_up_usuario->execute();

                                    } else {
                                        echo "Erro ao salvar os dados: " . $stmt->error;
                                    }
                                    $stmt->close();
                                } else {
                                    echo "Erro ao preparar a consulta: " . $conn->error;
                                }
                                
                                // Limpar o token após a utilização
                                unset($buscarToken);
                            }
                        }
                    }else
                    //-------------------------------------tonfa----------------------------------------
                    if($material == 4){
                        $material = "Tonfa";
                        $tamanho = NULL;
                        $serie = NULL;
                        //var_dump($matricula, $material, $dataCautela, $quantidade);
                        if(empty($_POST['tipoTonfa']) || empty($_POST['token'])
                        ){
                            echo "<script>alert('Preencha todos os campos!'); window.location.href='https://2bptur.com/materiais/cautelarMaterial.php';</script>";
                            // Redirecionar para a página de validação com alerta SweetAlert2
                             
                            
                        }else {
                            $tipoMaterial = $_POST['tipoTonfa'];
                            $chave = $_POST['token'];
                            switch($tipoMaterial){
                                case 1:
                                    $tipoMaterial = "Madeira";
                                    break;
                                case 2:
                                    $tipoMaterial = "Polietileno";
                                   
                            }
                       
                            if($chave == $buscarToken){
                                // Prepare a query SQL
                                $sql = "INSERT INTO cautela (matricula_cautela, material, quantidade, tipo_material, tamanho_calibre, serie_material, data_cautela) 
                                VALUES (?, ?, ?, ?, ?, ?, ?)";
                        
                                if ($stmt = $conn->prepare($sql)) {
                                    $stmt->bind_param("isissss", $matricula, $material, $quantidade, $tipoMaterial, $tamanho, $serie, $dataCautela,);
                                    if ($stmt->execute()) {
                                        echo "<script>alert('Cautela concluida com Sucesso!'); window.location.href='https://2bptur.com/materiais/cautelarMaterial.php';</script>";
                                        //atualizar o token no banco de dados
                                        $chaveToken = NULL;
                                        $sqlUpdate = "UPDATE usuario SET token_confirmacao = ? WHERE id = ? LIMIT 1";
                
                                        //$result_up_usuario = $conn->prepare($sqlUpdate);
                                        $result_up_usuario = $conn->prepare($sqlUpdate);
                                        $result_up_usuario->bind_param('ii', $chaveToken, $mtr);
                                        $result_up_usuario->execute();

                                    } else {
                                        echo "Erro ao salvar os dados: " . $stmt->error;
                                    }
                                    $stmt->close();
                                } else {
                                    echo "Erro ao preparar a consulta: " . $conn->error;
                                }
                                
                                // Limpar o token após a utilização
                                unset($buscarToken);
                            }
                        }
                    }else
                    //-------------------------------------Espagidor----------------------------------------
                    if($material == 5){
                        $material = "Espagidor";
                        $tamanho = NULL;
                        $serie = NULL;
                        //var_dump($matricula, $material, $dataCautela, $quantidade);
                        if(empty($_POST['tipoEspagidor']) || empty($_POST['token'])
                        ){
                            echo "<script>alert('Preencha todos os campos!'); window.location.href='cautelarMaterial.php';</script>";
                            // Redirecionar para a página de validação com alerta SweetAlert2
                             
                            
                        }else {
                            $tipoMaterial = $_POST['tipoEspagidor'];
                            $chave = $_POST['token'];
                            switch($tipoMaterial){
                                case 1:
                                    $tipoMaterial = "PSI JATO DE NÉVOA";
                                    break;
                                case 2:
                                    $tipoMaterial = "GL 108 MAX CS";
                                    break;
                                case 3:
                                    $tipoMaterial = "GL 108 MINI";
                                    break;
                                case 4:
                                    $tipoMaterial = "GL 108 OC MAX";
                                    break;
                                case 5:
                                    $tipoMaterial = "STANDARD 108 MEDIO";
                                    break;   
                            }
                       
                            if($chave == $buscarToken){
                                // Prepare a query SQL
                                $sql = "INSERT INTO cautela (matricula_cautela, material, quantidade, tipo_material, tamanho_calibre, serie_material, data_cautela) 
                                VALUES (?, ?, ?, ?, ?, ?, ?)";
                        
                                if ($stmt = $conn->prepare($sql)) {
                                    $stmt->bind_param("isissss", $matricula, $material, $quantidade, $tipoMaterial, $tamanho, $serie, $dataCautela,);
                                    if ($stmt->execute()) {
                                        echo "<script>alert('Cautela concluida com Sucesso!'); window.location.href='cautelarMaterial.php';</script>";
                                        //atualizar o token no banco de dados
                                        $chaveToken = NULL;
                                        $sqlUpdate = "UPDATE usuario SET token_confirmacao = ? WHERE id = ? LIMIT 1";
                
                                        //$result_up_usuario = $conn->prepare($sqlUpdate);
                                        $result_up_usuario = $conn->prepare($sqlUpdate);
                                        $result_up_usuario->bind_param('ii', $chaveToken, $mtr);
                                        $result_up_usuario->execute();

                                    } else {
                                        echo "Erro ao salvar os dados: " . $stmt->error;
                                    }
                                    $stmt->close();
                                } else {
                                    echo "Erro ao preparar a consulta: " . $conn->error;
                                }
                                
                                // Limpar o token após a utilização
                                unset($buscarToken);
                            }
                        }
                    }else
                    //-------------------------------------Carregador-------------------------------------------
                    if($material == 6){
                        
                        $material = "Carregador";
                        //var_dump($matricula, $material, $dataCautela, $quantidade);
                        //---------------------------------cadastro do Armamento---------------------------------
                        if(empty($_POST['tipoCarregador']) || empty($_POST['calibreCarregador'])
                            || empty($_POST['serie']) || empty($_POST['token'])
                        ){
                            echo "<script>alert('Preencha todos os campos!'); window.location.href='cautelarMaterial.php';</script>";
                            // Redirecionar para a página de validação com alerta SweetAlert2
                             
                            
                        }else {
                            $tipoMaterial = $_POST['tipoCarregador'];
                            $tamanho = $_POST['calibreCarregador'];
                            $serie = $_POST['serie'];
                            $chave = $_POST['token'];
                            switch($tipoMaterial){
                                case 1:
                                    $tipoMaterial = "Pistola";
                                    break;
                                case 2:
                                    $tipoMaterial = "Fuzil";
                                    break;
                                case 3:
                                    $tipoMaterial = "Carabina";
                                    
                            }
                            switch($tamanho){
                                case 1:
                                    $tamanho = ".40";
                                    break;
                                case 2:
                                    $tamanho = ".556";
                                    break;
                                case 3:
                                    $tamanho = ".762";
                                    break;
                                case 4:
                                    $tamanho = ".22";
                            }
                       
                            if($chave == $buscarToken){
                                // Prepare a query SQL
                                $sql = "INSERT INTO cautela (matricula_cautela, material, quantidade, tipo_material, tamanho_calibre, serie_material, data_cautela) 
                                VALUES (?, ?, ?, ?, ?, ?, ?)";
                        
                                if ($stmt = $conn->prepare($sql)) {
                                    $stmt->bind_param("isissss", $matricula, $material, $quantidade, $tipoMaterial, $tamanho, $serie, $dataCautela,);
                                    if ($stmt->execute()) {
                                        echo "<script>alert('Cautela concluida com sucesso!'); window.location.href='cautelarMaterial.php';</script>";
                                        //atualizar o token no banco de dados
                                        $chaveToken = NULL;
                                        $sqlUpdate = "UPDATE usuario SET token_confirmacao = ? WHERE id = ? LIMIT 1";
                
                                        //$result_up_usuario = $conn->prepare($sqlUpdate);
                                        $result_up_usuario = $conn->prepare($sqlUpdate);
                                        $result_up_usuario->bind_param('ii', $chaveToken, $mtr);
                                        $result_up_usuario->execute();

                                    } else {
                                        echo "Erro ao salvar os dados: " . $stmt->error;
                                    }
                                    $stmt->close();
                                } else {
                                    echo "Erro ao preparar a consulta: " . $conn->error;
                                }
                                
                                // Limpar o token após a utilização
                                unset($buscarToken);
                            }
                        }
                    }else
                    //-------------------------------------Colete reflexivo------------------------------------
                    if($material == 7){
                        $material = "Colete reflexivo";
                        $tipoMaterial = NULL;
                        $tamanho = NULL;
                        $serie = NULL;
                        $chave = $_POST['token'];
                        
                            if($chave == $buscarToken){
                                // Prepare a query SQL
                                $sql = "INSERT INTO cautela (matricula_cautela, material, quantidade, tipo_material, tamanho_calibre, serie_material, data_cautela) 
                                VALUES (?, ?, ?, ?, ?, ?, ?)";
                        
                                if ($stmt = $conn->prepare($sql)) {
                                    $stmt->bind_param("isissss", $matricula, $material, $quantidade, $tipoMaterial, $tamanho, $serie, $dataCautela,);
                                    if ($stmt->execute()) {
                                        echo "<script>alert('Cautela concluida com Sucesso!'); window.location.href='cautelarMaterial.php';</script>";
                                        //atualizar o token no banco de dados
                                        $chaveToken = NULL;
                                        $sqlUpdate = "UPDATE usuario SET token_confirmacao = ? WHERE id = ? LIMIT 1";
                
                                        //$result_up_usuario = $conn->prepare($sqlUpdate);
                                        $result_up_usuario = $conn->prepare($sqlUpdate);
                                        $result_up_usuario->bind_param('ii', $chaveToken, $mtr);
                                        $result_up_usuario->execute();

                                    } else {
                                        echo "Erro ao salvar os dados: " . $stmt->error;
                                    }
                                    $stmt->close();
                                } else {
                                    echo "Erro ao preparar a consulta: " . $conn->error;
                                }
                                
                                // Limpar o token após a utilização
                                unset($buscarToken);
                            }
                    }else
                    //-------------------------------------Escudo balistico------------------------------------
                    if($material == 8){
                        $material = "Escudo balistico";
                        $tipoMaterial = NULL;
                        $tamanho = NULL;
                        $serie = NULL;
                        $chave = $_POST['token'];
                        
                            if($chave == $buscarToken){
                                // Prepare a query SQL
                                $sql = "INSERT INTO cautela (matricula_cautela, material, quantidade, tipo_material, tamanho_calibre, serie_material, data_cautela) 
                                VALUES (?, ?, ?, ?, ?, ?, ?)";
                        
                                if ($stmt = $conn->prepare($sql)) {
                                    $stmt->bind_param("isissss", $matricula, $material, $quantidade, $tipoMaterial, $tamanho, $serie, $dataCautela,);
                                    if ($stmt->execute()) {
                                        echo "<script>alert('Cautela concluida com Sucesso!'); window.location.href='cautelarMaterial.php';</script>";
                                        //atualizar o token no banco de dados
                                        $chaveToken = NULL;
                                        $sqlUpdate = "UPDATE usuario SET token_confirmacao = ? WHERE id = ? LIMIT 1";
                
                                        //$result_up_usuario = $conn->prepare($sqlUpdate);
                                        $result_up_usuario = $conn->prepare($sqlUpdate);
                                        $result_up_usuario->bind_param('ii', $chaveToken, $mtr);
                                        $result_up_usuario->execute();

                                    } else {
                                        echo "Erro ao salvar os dados: " . $stmt->error;
                                    }
                                    $stmt->close();
                                } else {
                                    echo "Erro ao preparar a consulta: " . $conn->error;
                                }
                                
                                // Limpar o token após a utilização
                                unset($buscarToken);
                            }
                    }else 
                    //-------------------------------------Escudo nivel III-------------------------------------
                    if($material == 9){
                        $material = "Escudo nivel III";
                        $tipoMaterial = NULL;
                        $tamanho = NULL;
                        $serie = NULL;
                        $chave = $_POST['token'];
                        
                            if($chave == $buscarToken){
                                // Prepare a query SQL
                                $sql = "INSERT INTO cautela (matricula_cautela, material, quantidade, tipo_material, tamanho_calibre, serie_material, data_cautela) 
                                VALUES (?, ?, ?, ?, ?, ?, ?)";
                        
                                if ($stmt = $conn->prepare($sql)) {
                                    $stmt->bind_param("isissss", $matricula, $material, $quantidade, $tipoMaterial, $tamanho, $serie, $dataCautela,);
                                    if ($stmt->execute()) {
                                        echo "<script>alert('Cautela concluida com Sucesso!'); window.location.href='cautelarMaterial.php';</script>";
                                        //atualizar o token no banco de dados
                                        $chaveToken = NULL;
                                        $sqlUpdate = "UPDATE usuario SET token_confirmacao = ? WHERE id = ? LIMIT 1";
                
                                        //$result_up_usuario = $conn->prepare($sqlUpdate);
                                        $result_up_usuario = $conn->prepare($sqlUpdate);
                                        $result_up_usuario->bind_param('ii', $chaveToken, $mtr);
                                        $result_up_usuario->execute();

                                    } else {
                                        echo "Erro ao salvar os dados: " . $stmt->error;
                                    }
                                    $stmt->close();
                                } else {
                                    echo "Erro ao preparar a consulta: " . $conn->error;
                                }
                                
                                // Limpar o token após a utilização
                                unset($buscarToken);
                            }
                    }else 
                    //-------------------------------------Capacete anti-tumulto------------------------------------
                    if($material == 10){
                        $material = "Capacete anti-tumulto";
                        $tipoMaterial = NULL;
                        $tamanho = NULL;
                        $serie = NULL;
                        $chave = $_POST['token'];
                        
                            if($chave == $buscarToken){
                                // Prepare a query SQL
                                $sql = "INSERT INTO cautela (matricula_cautela, material, quantidade, tipo_material, tamanho_calibre, serie_material, data_cautela) 
                                VALUES (?, ?, ?, ?, ?, ?, ?)";
                        
                                if ($stmt = $conn->prepare($sql)) {
                                    $stmt->bind_param("isissss", $matricula, $material, $quantidade, $tipoMaterial, $tamanho, $serie, $dataCautela,);
                                    if ($stmt->execute()) {
                                        echo "<script>alert('Cautela concluida com Sucesso!'); window.location.href='cautelarMaterial.php';</script>";
                                        //atualizar o token no banco de dados
                                        $chaveToken = NULL;
                                        $sqlUpdate = "UPDATE usuario SET token_confirmacao = ? WHERE id = ? LIMIT 1";
                
                                        //$result_up_usuario = $conn->prepare($sqlUpdate);
                                        $result_up_usuario = $conn->prepare($sqlUpdate);
                                        $result_up_usuario->bind_param('ii', $chaveToken, $mtr);
                                        $result_up_usuario->execute();

                                    } else {
                                        echo "Erro ao salvar os dados: " . $stmt->error;
                                    }
                                    $stmt->close();
                                } else {
                                    echo "Erro ao preparar a consulta: " . $conn->error;
                                }
                                
                                // Limpar o token após a utilização
                                unset($buscarToken);
                            }
                    }

                }
            } else {
                echo "Token inválido ou expirado.";
            }
        }
    

?>