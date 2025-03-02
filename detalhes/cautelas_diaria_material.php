<?php
    require_once('../usuario/restricaoUsuarios.php');
    require_once('../materiais/controller_cautelas_diarias_materiais.php');

    $restringir = new RestricaoDeUsuario();
    $restringir->restricao();
    $guerra = $restringir->getNomeGuerra();
    $bpm = $restringir->getBpm();
    $situacao = $restringir->getSituacao();
    $funcao = $restringir->getFuncao();

    $detalhes = new CauteladasDeMateriais();
    $detalhes->Cauteladas();
    $matricula = $detalhes->getIdUsuario();
    $nomeCautelante = $detalhes->getNomeCompleto();
    $guerraCautelante = $detalhes->getGuerraCautelante();
    $postoCautelante = $detalhes->getPostoCautelante();
    $material = $detalhes->getMaterial();
    $quantidade = $detalhes->getQuantidade();
    $tipoMaterial = $detalhes->getTipoMaterial();
    $tamanhoCalibre = $detalhes->getTamanhoCalibre();
    $serie = $detalhes->getSerie();
    $dataCautela = $detalhes->getDiaCautela();
    
    $timestampCautela = strtotime($dataCautela);
    $diaCautela = date('d-m-Y', $timestampCautela);
       
    
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
        $(document).ready(function(){
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
        });
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
            <?php if($funcao == "Cmd do P4" || $situacao == "HABILITADO"){ ?>
                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
                        aria-expanded="One" aria-controls="collapseOne">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>P4</span>
                    </a>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">P4:</h6>
                            <a class="collapse-item" href="cargas_da_unidade.php">Cargas da unidade</a>
                            <a class="collapse-item" href="../P4/materiais_cautelados.php">Material na cautela</a>
                        </div>
                    </div>
                </li>
            <?php } ?>
                
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
                    <h1 class="h3 mb-2 text-gray-800">Viaturas Cauteladas</h1>
                   

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Datalhes da cautela</h6>
                        </div>
                        <div class="card-body">
                            <?php
                                echo "Nome Completo: $nomeCautelante <br>";
                                echo "Nome de Guerra: $guerraCautelante (<strong>$postoCautelante</strong>)<br>";
                                echo "Material cautelado: $material<br>";
                                echo "Tipo do material: $tipoMaterial<br>";
                                echo "Tamanho/Calibre: $tamanhoCalibre<br>";
                                echo "Serie: $serie<br>";
                                echo "Quantidade: $quantidade<br>";
                                echo "Data da Cautela: $diaCautela<br>";
                            ?>
                            <!-- <div class="table-responsive">
                                <form class="row g-3" method="POST" action="insert_db_descautela.php" enctype="multipart/form-data">
                                    <div class="col-md-2">
                                        <label for="inputNome" class="form-label">Posto/Patente</label>
                                        <input type="text" class="form-control" name="posto" id="inputNome" value="<?php echo $posto;//htmlspecialchars($posto); ?>" readonly>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="inputMatricula" class="form-label">Nome de Guerra</label>
                                        <input type="text" class="form-control" name="nomeGuerra" id="inputMatricula" value="<?php echo $guerraCautelante;//htmlspecialchars($guerra); ?>" readonly>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="inputGuerra" class="form-label">Matricula/ID</label>
                                        <input type="text" class="form-control" name="matricula" id="inputGuerra" value="<?php echo $cautela;//htmlspecialchars($cautela); ?>" readonly>
                                    </div>
                                    <div class="col-md-1">
                                        <label for="inputGuerra" class="form-label">Qtd</label>
                                        <input type="text" class="form-control" name="quantidade" id="inputGuerra" value="<?php echo $quantidade;//htmlspecialchars($quantidade); ?>" readonly>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="inputPosto" class="form-label">Material</label>
                                        <input type="text" class="form-control" name="material" id="inputPosto" value="<?php echo $material;//htmlspecialchars($material); ?>" readonly>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="inputGuerra" class="form-label">Tipo do material</label>
                                        <input type="text" class="form-control" name="tipoMaterial" id="inputGuerra" value="<?php echo $tipoMaterial;//htmlspecialchars($tipoMaterial); ?>" readonly>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="inputGuerra" class="form-label">Serie/Nº</label>
                                        <input type="text" class="form-control" name="serie" id="inputGuerra" value="<?php echo $serie;//htmlspecialchars($serie); ?>" readonly>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="inputGuerra" class="form-label">Data da cautela</label>
                                        <input type="date" class="form-control" name="dataCautela" id="dataCautela" value="<?php echo $dataCautela;//htmlspecialchars($dataCautela); ?>" readonly>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="inputGuerra" class="form-label">Data da devolução</label>
                                        <input type="text" class="form-control" name="dataEntrega" id="inputGuerra" value="<?php echo $diaEntrega;//htmlspecialchars($data_hoje); ?>" readonly>
                                    </div>
                                
                                    <div class="col-md-2">
                                        <label for="inputchave" class="form-label">Armeiro</label>
                                        <input type="number" class="form-control" name="inputchave" id="inputchave" value="<?php echo $guerraArmeiro;//htmlspecialchars($data_hoje); ?>" readonly>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <input type="submit" name="salvar" id="botao" class="btn btn-primary" value="Salvar descautela">
                                    </div>
                                </form>-->




                                <!--<div class="col-12">
                                    <a href="../usuario/updateUsuario.php?updUsuario=<?php //echo $id;?>" class="btn btn-primary w-100">Editar</a>
                                </div>-->


                            <!--</div>-->
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

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    
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