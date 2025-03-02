<?php
    require_once('../conexao/conexao_01.php');
    require_once('../usuario/restricaoUsuarios.php');
    session_start();

    $restringir = new RestricaoDeUsuario();
    $restringir->restricao();
    $nomeGuerra = $restringir->getNomeGuerra();
    $bpm = $restringir->getBpm();
    $cia = $restringir->getCiaRestrito();
    $funcao = $restringir->getFuncao();
    $situacao = $restringir->getSituacao();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cadastro de viaturas</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

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

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Area do Administrativo</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Administrativo:</h6>
                        <!--<a class="collapse-item" href="cadastroBo.php">Cadastro Ocorrências</a>-->
                        <a class="collapse-item" href="verUsuarios.php">Usuarios</a>
                        <!--<a class="collapse-item" href="#">Cadastrar Ranking's</a>-->
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <?php if($funcao == "Cmd do P4" || $situacao == "HABILITADO"){ ?>
                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
                        aria-expanded="true" aria-controls="collapseOne">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>P4</span>
                    </a>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">P4:</h6>
                            <a class="collapse-item" href="cargas_da_unidade.php">Cargas da unidades</a>
                            <!--<a class="collapse-item" href="#">Viaturas</a>-->
                        </div>
                    </div>
                </li>
            <?php } ?>

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $nomeGuerra; ?></span>
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
                               <!-- <a class="dropdown-item" href="#">
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
                    <h1 class="h3 mb-2 text-gray-800">Cadastro de Viatura</h1>
                    

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-11 col-lg-12">

                            <!-- Area Chart -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Cadastrar viatura</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area">
                                        <!--<canvas id="myAreaChart"></canvas>-->

                                        <form class="row g-3" id="cadastroUsuario" action="controllerCadastroVtr.php" method="POST" enctype="multipart/form-data">
                                            <div class="col-md-6">
                                                <label for="inputUnidade" class="form-label">Unidade Policial</label>
                                                <input type="text" class="form-control" name="inputUnidade" id="inputUnidade" value="<?php echo $bpm; ?>" disabled>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputPrefixo" class="form-label">Prefixo</label>
                                                <input type="number" class="form-control" name="inputPrefixo" id="inputPrefixo" placeholder="Ex: 19330">
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <label for="inputModelo" class="form-label">Modelo</label>
                                                <input type="text" class="form-control" name="inputModelo" id="inputModelo" placeholder="Ex: Ranger/S10">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputPlaca" class="form-label">Placa</label>
                                                <input type="text" class="form-control" name="inputPlaca" id="inputPlaca" placeholder="Ex: NDA5645">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputCondicao" class="form-label">Condição</label>
                                                <select class="form-control" name="inputCondicao" aria-label="Default select example">
                                                    <option selected disabled>Condição</option>
                                                    <option value="1">ATIVA</option>
                                                    <option value="2">INATIVA</option>
                                                </select>
                                            </div>
                                           
                                                <br>
                                                <div class="col-md-12 text-center mt-4">
                                                    <input type="submit" name="salvarVtr" class="btn btn-primary" value="Salvar cadastro">
                                                </div>
                                            
                                        </form>

                                    </div>
                                    <hr>

                                </div>
                            </div>

                            <!-- Bar Chart -->
                            <!--<div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Bar Chart</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-bar">
                                        <canvas id="myBarChart"></canvas>
                                    </div>
                                    <hr>
                                    Styling for the bar chart can be found in the
                                    <code>/js/demo/chart-bar-demo.js</code> file.
                                </div>
                            </div>-->

                        </div>

                        <!-- Donut Chart -->
                        <!--<div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">-->
                                <!-- Card Header - Dropdown -->
                                <!--<div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Donut Chart</h6>
                                </div>-->
                                <!-- Card Body -->
                                <!--<div class="card-body">
                                    <div class="chart-pie pt-4">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    <hr>
                                    Styling for the donut chart can be found in the
                                    <code>/js/demo/chart-pie-demo.js</code> file.
                                </div>
                            </div>
                        </div>-->
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Fabio Galeno</span>
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

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../js/vizualizarSenha.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>
    <script src="../js/demo/chart-bar-demo.js"></script>

</body>

</html>