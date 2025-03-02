<?php
    /******Desenvolvido por Fabio Galeno******/
    /******atualização dia 19/11/2024******/
    require_once('../conexao/conexao_01.php');
    require_once('../usuario/restricaoUsuarios.php');
    require_once('descautela_controller_viatura.php');

    $conexao = new Conexao();
    $conn = $conexao->getConexao();

    // Inicializa a restrição e captura dados do usuário
    $restringir = new RestricaoDeUsuario();
    $restringir->restricao();
    $guerra = $restringir->getNomeGuerra();
    $bpm = $restringir->getBpm();
    $tokenConfirme = $restringir->getChave();
    $matricula = $restringir->getIdUsuario();

    // Inicializa a classe DetalhesViatura
    $detalhes = new DescautelaViatura();

    if (isset($_GET['detalhes'])) {
        $id_detalhes = $_GET['detalhes'];
        //var_dump($_GET['detalhes']);
        // Captura detalhes da cautela
        $detalhes->detalhesCautelaViatura($id_detalhes);

        // Variáveis de viatura
        $guerraCautelante = $detalhes->getGuerraCautelante();
        $matrMotorista = $detalhes->getCautelante();
        $guerraArmeiro = $detalhes->getGuerraArmeiro();
        $postoCautelante = $detalhes->getPostoCautelante();
        $postoArmeiro = $detalhes->getPostoArmeiro();
        $prefixo = $detalhes->getPrefixo();
        $modelo = $detalhes->getModelo();
        $placa = $detalhes->getPlaca();
        $dataCautela = $detalhes->getDataCautela();
        //$dataEntrega = $detalhes->getDataEntrega();
        /**
         * Função para gerar um token alfanumérico de 16 caracteres.
         * @return string Token gerado.
         */
        function gerarToken() {
            return bin2hex(random_bytes(8));
        }
        
        try {
            // Geração do token
            $token = gerarToken();
            // Prepara a consulta para atualizar o token no banco de dados
            $sqlUpdateToken = "UPDATE usuario SET token_confirmacao = ? WHERE id = ?";
            $stmt = $conn->prepare($sqlUpdateToken);

            if (!$stmt) {
                throw new Exception("Erro na preparação da query: " . $conn->error);
            }

            // Associa os parâmetros e executa a consulta
            $stmt->bind_param("si", $token, $matricula);
            $stmt->execute();

            // Verifica se o token foi atualizado com sucesso
            if ($stmt->affected_rows > 0) {
                echo "<script>alert('Chave gerada com sucesso!');</script>";
            } else {
                echo "<script>alert('Erro ao gerar a chave: verifique se o ID do motorista existe no banco de dados.');</script>";
            }
        } catch (Exception $e) {
            // Tratamento de erros
            echo "<script>alert('Erro: " . $e->getMessage() . "');</script>";
        } finally {
            // Fecha a conexão e libera recursos
            if (isset($stmt)) {
                $stmt->close();
            }
            if (isset($conn)) {
                $conn->close();
            }
        }
    } else {
        echo "ID de detalhes não encontrado.";
        exit;
    }
    
    
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Detalhes de Ocorrencia</title>

    <!-- Custom fonts for this template -->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/permutas.css">

    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script>
        /*$(document).ready(function(){
            function updateToken() {
                $.ajax({
                    url: 'descautelar_material.php',
                    success: function(data) {
                        $('#token-value').text(parseInt(data));
                    }
                });
            }

            // Update every second
            setInterval(updateToken, 50);
        });*/
    </script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../home.php">
                <div class="sidebar-brand-icon rotate-n-20">
                    <i><img src="../img/2bptur.ico" alt="" width="50" height="50" srcset=""></i>
                </div>
                <div class="sidebar-brand-text mx-3"><?php echo $bpm; ?></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="../home.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Inicio</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
                <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive"
                        aria-expanded="true" aria-controls="collapseFive">
                        <!--<i class="fas fa-fw fa-cog"></i>--> <!--icone de configuração-->
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Materias</span>
                </a>
                <div id="collapseFive" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Materiais:</h6>
                            <?php
                                
                               /* if($funcao == "Cmd. de Batalhão" || $funcao == "Sub. Cmd de Batalhão" || $funcao == "Cmd de Cia" ||
                                    $funcao == "Sub Cmd de Cia" || $funcao == "Cmd do P1" || $funcao == "Cmd do P2" ||
                                    $funcao == "Cmd do P3" || $funcao == "Cmd do P4"){
                                        
                                        echo "<a class='collapse-item' href='relatorioOcorrencias.php'>Filtro de ocorrências</a>";
                                        echo "<a class='collapse-item' href='permuta_a_autorizar.php'>Permuta a Autorizar</a>";
            
                                }
                                
                                if($situacao == "HABILITADO"){
                                    echo "<a class='collapse-item' href='permutas_autorizadas.php'>Permutas Autorizadas</a>";
                                }*/
                            ?>
                            
                            <a class="collapse-item" href="cautelarMaterial.php">cautela</a>
                            <!--<a class="collapse-item" href="materiais/materiais_cautelados.php">Materias cautelados</a>-->
                            <a class="collapse-item" href="historico_de_cautela.php">Historico de cautela</a>
                    </div>
                </div>
            </li>
            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Sessões</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Sessões:</h6>
                        <a class="collapse-item" href="ocorrencias.php">Ocorrências</a>
                        <a class="collapse-item" href="usuario.php">Usuarios</a>
                        <!--<a class="collapse-item" href="#">Cadastrar Ranking's</a>-->
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <!--<li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="utilities-color.html">Colors</a>
                        <a class="collapse-item" href="utilities-border.html">Borders</a>
                        <a class="collapse-item" href="utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a>
                    </div>
                </div>
            </li>-->

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <!--<li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.html">Login</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.html">Blank Page</a>
                    </div>
                </div>
            </li>-->

            <!-- Nav Item - Ranking -->
            <!--<li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-trophy"></i>
                    <span>Ranking</span></a>
            </li>-->

            <!-- Nav Item - Charts -->
            <!--<li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li>-->

            <!-- Nav Item - Tables -->
            <!--<li class="nav-item active">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li>-->

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow mx-1" id="token-atual">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-solid fa-key"></i>
                                <!-- Indicador de existência de token -->
                                <span class="badge badge-danger badge-counter"></span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#" id="token-link">
                                    <div class="font-weight-bold">
                                        <div class="text-truncate" id="token-notification">
                                            <strong>Chave:</strong> <span id="token-value"><?php echo $tokenConfirme; ?></span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </li>    
                       
                        
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $guerra; ?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="../perfil/perfil.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <!--<a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>-->
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Sair
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Descautela</h1>
                   

                    <!-- DataTales Example -->
                    <div class="card shadow col-md-11">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Descautelar viatura</h6>
                        </div>
                        <div class="card-body">
                        <!--<h4>Detalhes da Cautela</h4>-->
                            <!--<p>Nome de Guerra: <strong><?php //echo $guerraCautelante . "</strong>" . " (" . $postoCautelante . ")"; ?></p>
                            <p>Material: <?php //echo $prefixo; ?></p>
                            <p>Modelo: <?php //echo $modelo; ?></p>
                            <p>Placa: <?php //echo $placa; ?></p>
                            <p>Data da Cautela: <?php //echo $dataCautela; ?></p>-->
                            <!--<p>Data da Entrega: <?php //echo $dataEntrega ? $dataEntrega : "Ainda não entregue"; ?></p>-->
                            <form class="row g-3" method="POST" action="insert_db_descautela.php" enctype="multipart/form-data">
                                <div class="col-md-auto">
                                    <label for="inputMatricula" class="form-label">Matricula</label>
                                    <input type="text" class="form-control" name="matricula" id="inputMatricula" value="<?php echo $matrMotorista;//htmlspecialchars($posto); ?>" readonly>
                                </div>
                                <div class="col-md-auto">
                                    <label for="inputNome" class="form-label">Posto/Patente</label>
                                    <input type="text" class="form-control" name="posto" id="inputNome" value="<?php echo $postoCautelante;//htmlspecialchars($posto); ?>" readonly>
                                </div>
                                
                                <div class="col-md-auto">
                                    <label for="inputMatricula" class="form-label">Nome de Guerra</label>
                                    <input type="text" class="form-control" name="nomeGuerra" id="inputGuerra" value="<?php echo $guerraCautelante;//htmlspecialchars($guerra); ?>" readonly>
                                </div>
                                <div class="col-md-auto">
                                    <label for="inputGuerra" class="form-label">Prefixo</label>
                                    <input type="text" class="form-control" name="prefixo" id="inputPrefixo" value="<?php echo $prefixo;//htmlspecialchars($cautela); ?>" readonly>
                                </div>
                                <div class="col-md-auto">
                                    <label for="inputGuerra" class="form-label">Modelo</label>
                                    <input type="text" class="form-control" name="modelo" id="inputModelo" value="<?php echo $modelo;//htmlspecialchars($quantidade); ?>" readonly>
                                </div>
                                <div class="col-md-auto">
                                    <label for="inputPosto" class="form-label">Placa</label>
                                    <input type="text" class="form-control" name="placa" id="inputPlaca" value="<?php echo $placa;//htmlspecialchars($material); ?>" readonly>
                                </div>
                                <div class="col-md-auto">
                                    <label for="inputGuerra" class="form-label">Data da cautela</label>
                                    <input type="date" class="form-control" name="dataCautela" id="dataCautela" value="<?php echo $dataCautela;//htmlspecialchars($dataCautela); ?>" readonly>
                                </div>
                                <div class="col-md-auto" id="inserirChave">
                                    <label for="chaveConfirmacao" class="control-label">Chave:</label>
                                    <input type="text" class="form-control" name="inserirChave" id="chave" value="Chave gerada">
                                </div>

                                <div class="col-md-auto" id="confirmar">
                                    <button type="submit" name="salvar" class="btn btn-success">Confirmar Cautela</button>
                                </div>
                            </form>
                            <!--<form action="" method="POST">
                                <div class="col-md-auto" style="margin-top: 20px;">
                                    <input type="submit" name="salvar" class="btn btn-primary mb-2" id="gerarChave" value="Gerar">
                                </div>
                            </form>-->
                            <!--<div class="col-md-auto" style="margin-top: 20px;">
                                <button id="abrirModal" class="btn btn-success"  data-toggle="modal" data-target="#myModal">Gerar Chave</button>
                            </div>-->
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>frame utilizado e melhorado para o <?php echo $bpm; ?></span><br>
                        <a href="#">Desenvolvimento</a>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pronto para partir?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Selecione "Sair" abaixo se estiver pronto para encerrar sua sessão atual.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="../index.html">Sair</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Corfirme sua matricula!</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form class="form-inline" action="#" method='POST' enctype='multipart/form-data'>
                
                <div class="form-group mx-sm-3 mb-2">
                    <label for="inputPassword2" class="sr-only">Matricula</label>
                    <input type="number" class="form-control" name="matricula" id="inputPassword2" value="<?php echo $usuario; ?>" disabled>
                </div>
                <button type="submit" name="enviaToken" class="btn btn-primary mb-2" id="ativarFormulario">Enviar Token</button>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
            <!--<button type="button" class="btn btn-primary">Save changes</button>-->
        </div>
        </div>
    </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mx-auto" id="myModalLabel">Chave de Confirmação</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <form class="row justify-content-center" id="formModal" action="" method="POST">
                        <div class="col-sm-6">
                            <label for="modalMotorista" class="control-label">Matricula: </label>
                            <input type="number" class="form-control" name="seuId" id="modalMotorista" value="<?php echo $matricula; ?>" disabled>
                        </div>
                        <div class="modal-footer d-flex justify-content-center w-100">
                            <!--<input type="submit" name="gerar" id="gerarChave" class="btn btn-primary" value="Gerar chave">-->
                            <input type="submit" name="salvar" class="btn btn-primary mb-2" id="gerarChave" value="Gerar">
                            <button type="button" class="btn btn-danger ml-2" data-dismiss="modal">Fechar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
        /**
         * Função para gerar um token alfanumérico de 16 caracteres.
         * @return string Token gerado.
         */
        /*function gerarToken() {
            return bin2hex(random_bytes(8));
        }

        // Verifica se o formulário foi enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['salvar'])) {
            // Validação do ID do motorista
            //$matricula = filter_input(INPUT_POST, 'matricula', FILTER_VALIDATE_INT);

            if (!$matricula) {
                echo "<script>alert('Erro: ID do motorista inválido ou não enviado.');</script>";
                exit;
            }

            try {
                // Geração do token
                $token = gerarToken();
                // Prepara a consulta para atualizar o token no banco de dados
                $sqlUpdateToken = "UPDATE usuario SET token_confirmacao = ? WHERE id = ?";
                $stmt = $conn->prepare($sqlUpdateToken);

                if (!$stmt) {
                    throw new Exception("Erro na preparação da query: " . $conn->error);
                }

                // Associa os parâmetros e executa a consulta
                $stmt->bind_param("si", $token, $matricula);
                $stmt->execute();

                // Verifica se o token foi atualizado com sucesso
                if ($stmt->affected_rows > 0) {
                    echo "<script>alert('Chave gerada com sucesso!');</script>";
                } else {
                    echo "<script>alert('Erro ao gerar a chave: verifique se o ID do motorista existe no banco de dados.');</script>";
                }
            } catch (Exception $e) {
                // Tratamento de erros
                echo "<script>alert('Erro: " . $e->getMessage() . "');</script>";
            } finally {
                // Fecha a conexão e libera recursos
                if (isset($stmt)) {
                    $stmt->close();
                }
                if (isset($conn)) {
                    $conn->close();
                }
            }
        } else {
            echo "<script>alert('Requisição inválida.');</script>";
        }*/

    ?>
    
    <script>
        //função para exibir butão de gerar chave
        document.getElementById('gerarChave').addEventListener('click', function(event) {
            // Previne o envio do formulário
            event.preventDefault();

            // Fecha a modal
            const modal = document.getElementById('myModal');
            const modalBackdrop = document.querySelector('.modal-backdrop');
            
            if (modal) modal.classList.remove('show'); // Remove a classe que mantém a modal visível
            if (modalBackdrop) modalBackdrop.remove(); // Remove o fundo escuro da modal

            modal.setAttribute('aria-hidden', 'true');
            modal.style.display = 'none';

            document.getElementById('gerarChave').style.display = 'none';
            //document.getElementById('gerarChave').style.display = 'none';
            document.getElementById('inserirChave').style.display = 'block';
            document.getElementById('confirmar').style.display = 'block';
        });

        document.getElementById('token-atual').addEventListener('click', function () {
            // Faz uma requisição para obter o token atualizado
            fetch('../token/getToken.php')
                .then(response => response.json())
                .then(data => {
                    if (data.token) {
                        // Atualiza o valor do token na interface
                        document.getElementById('token-value').innerText = data.token;
                        //alert('Chave atualizada: ' + data.token);
                    } else {
                        alert('Erro ao atualizar chave: ' + data.error);
                    }
                })
                .catch(error => {
                    console.error('Erro ao buscar o token:', error);
                });
        });
    </script>
    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../js/preencher_dados_de_token_automatico.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>
    <script src="../js/botao_visivel.js"></script>
    <!--<script src="../js/atualizar_valor.js"></script>-->
    <!-- Page level plugins -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>

</body>

</html>