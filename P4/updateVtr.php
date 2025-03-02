<?php
    /*****atualizado dia 30/06/2024*****/
    //include ('../conexao/conexao.php');
    require_once('../conexao/conexao_01.php');
    require_once('../usuario/restricaoUsuarios.php');
    require_once('updateControllerVtr.php');
    session_start();
    //instancia do arquivo usuario/restricaoUsuario.php
    $restringir = new RestricaoDeUsuario();
    $restringir->restricao();
    $nomeGuerra = $restringir->getNomeGuerra();
    $bpm = $restringir->getBpm();
    
    //instancia do arquivo P4/updateControllerVtr.php
    $udpDetalhe = new UpdateController();
    $udpDetalhe->detalhesUpdVtr();
    $prefixo = $udpDetalhe->getPrefixo();
    $modelo = $udpDetalhe->getModelo();
    $placa = $udpDetalhe->getPlaca();
    $situacao = $udpDetalhe->getSituacao();
    $detalhes = $udpDetalhe->getDetalhes();
    $unidade = $udpDetalhe->getUnidade();
    
    /*if($situacao == 'Inativa'){
       return $situacao;
    }else if($situacao == 'Ativo'){
        return $situacao;
    }*/
    //var_dump($situacao);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cadastro de usuario</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

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
                        <h6 class="collapse-header">Area do Administrativo</h6>
                        <!--<a class="collapse-item" href="cadastroBo.php">Cadastro Ocorrências</a>-->
                        <a class="collapse-item" href="../ocorrencias/ocorrencias.php">Ocorrência</a>
                        <a class="collapse-item" href="verUsuarios.php">Usuarios</a>
                        <!--<a class="collapse-item" href="#">Cadastrar Ranking's</a>-->
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

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
                    <h1 class="h3 mb-2 text-gray-800">Atualização de Usuarios</h1>
                    

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-auto col-lg-auto">

                            <!-- Area Chart -->
                            <div class="card shadow col-md-auto">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Atualizar usuarios</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area">
                                        <!--<canvas id="myAreaChart"></canvas>-->
                                        <form class="row g-3" id="cadastroUsuario" method="POST" action="../atualizacoes/update_carga_viatura.php" enctype="multipart/form-data">
                                            <div class="col-md-6">
                                                <label for="inputNome" class="form-label">Viatura</label>
                                                <input type="number" class="form-control" name="viatura" id="inputNome" value="<?php echo htmlspecialchars($prefixo, ENT_QUOTES, 'UTF-8'); ?>" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputMatricula" class="form-label">Modelo</label>
                                                <input type="text" class="form-control" name="modelo" id="inputMatricula" value="<?php echo htmlspecialchars($modelo, ENT_QUOTES, 'UTF-8'); ?>" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputGuerra" class="form-label">Placa</label>
                                                <input type="text" class="form-control" name="placa" id="inputGuerra" value="<?php echo htmlspecialchars($placa, ENT_QUOTES, 'UTF-8'); ?>" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputPosto" class="form-label">Situação</label>
                                                <input type="text" class="form-control" name="situacao" id="inputPosto" value="<?php echo htmlspecialchars($situacao, ENT_QUOTES, 'UTF-8'); ?>" style="text-transform: uppercase;">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputClasse" class="form-label">Detalhes</label>
                                                <input type="text" class="form-control" name="detalhes" id="inputClasse" value="<?php echo htmlspecialchars($detalhes, ENT_QUOTES, 'UTF-8'); ?>" style="text-transform: uppercase;">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputClasse" class="form-label">Unidade</label>
                                                <input type="text" class="form-control" name="unidade" id="inputClasse" value="<?php echo htmlspecialchars($unidade, ENT_QUOTES, 'UTF-8'); ?>">
                                            </div>
                                            <div class="col-md-12 text-center mt-4">
                                                <button type="submit" name="updateViatura" class="btn btn-primary">Atualizar</button>
                                            </div>
                                        </form>

                                    </div>
                                    <hr>
                                   
                                </div>
                            </div>

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