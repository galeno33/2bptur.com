<?php
    /*****Desenvolvido por Fabio Galeno*****/
    /*****Atualizado dia 01/12/2024*****/
    require_once('../conexao/conexao_01.php');
    require_once('../usuario/restricaoUsuarios.php');
    require_once('../materiais/select_viatura.php');

    $conexao = new Conexao();
    $conn = $conexao->getConexao();

    $restringir = new RestricaoDeUsuario();
    $restringir->restricao();
    $bpm = $restringir->getBpm();
    //$cia = $restringir->getCiaRestrito();
    $tokenConfirme = $restringir->getChave();
    $situacao = $restringir->getSituacao();
    $funcao = $restringir->getFuncao();
    $nomeGuerra = $restringir->getNomeGuerra();

    $listarViatura = new Viatura();
    $listarViaturas = $listarViatura->selecionarViatura();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Mapa de Força</title>

    <!-- Custom fonts for this template -->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../home.php">
            <div class="sidebar-brand-icon rotate-n-20">
                    <img src="../img/2bptur.ico" alt="" width="50" height="50">
                </div>
                <div class="sidebar-brand-text mx-3"><?php echo $bpm; ?></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="../home.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Início</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <?php if($situacao == "HABILITADO"){ ?>
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
                            <?php 
                                if ($funcao == "Cmd. de Batalhão" || $funcao == "Sub. Cmd de Batalhão" || $funcao == "Cmd de Cia" ||
                                $funcao == "Sub Cmd de Cia" || $funcao == "Cmd do P1" || $funcao == "Cmd do P2" ||
                                $funcao == "Cmd do P3" || $funcao == "Cmd do P4" || $funcao == "Gerente") {
                                    echo "<a class='collapse-item' href='../autorizacao_permuta/permuta_a_autorizar.php'>Permuta a Autorizar</a>";
                                }

                            ?>
                                <a class='collapse-item' href='../filtragem_pesquisas/relatorioOcorrencias.php'>Filtro de ocorrências</a>
                                <a class='collapse-item' href='../autorizacao_permuta/permutas_autorizadas.php'>Permutas Autorizadas</a>
                                <a class="collapse-item" href="../ocorrencias/ocorrencias.php">Ocorrência</a>
                                <a class="collapse-item" href="../usuario/verUsuarios.php">Usuários</a>

                        
                        </div>
                    </div>
                </li>
            <?php } ?>

            <?php if($funcao == "Cmd do P4" || $funcao == "Gerente"){  ?>
                <!-- Nav Item - Utilities Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                        aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>P4</span>
                    </a>
                    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">P4:</h6>
                            <?php if($funcao == "Armeiro" || $funcao == "Gerente" || $funcao == "Cmd do P4"){ ?>
                                <a class="collapse-item" href="../materiais/cautelarMaterial.php">Cautelar Material</a>
                                <a class="collapse-item" href="../materiais/cautela_vtr.php">Cautelar Viatura</a>
                                <!--<a class="collapse-item" href="materiais/materiais_cautelados.php">Descautelar</a>-->
                                <a class="collapse-item" href="../materiais/historico_de_cautela.php">Historico das Cautelas</a>
                                <a class="collapse-item" href="../p4/materiais_cautelados.php">Materiais cautelados</a>
                            <?php } ?>
                                <a class="collapse-item" href="../p4/cargas_da_unidade.php">Cargas da unidade</a>
                            
                        </div>
                    </div>
                </li>
            <?php } ?>
            
            <!-- Profile Section -->
            <li class="nav-item">
                <a class="nav-link" href="../perfil/perfil.php">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Perfil</span>
                </a>
            </li>

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
                    <!--<form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>-->

                    <!-- Topbar Search -->
                    <!--<form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>-->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <!--<li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>--->
                            <!-- Dropdown - Messages -->
                            <!--<div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>-->

                        <!-- Nav Item - Alerts -->
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
                                <a class="dropdown-item" href="../perfil//perfil.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Configurações
                                </a>
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
                    <h1 class="h3 mb-2 text-gray-800">MAPA DE FORÇA</h1>
                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Mapa de Força</h6>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Ordem</th>
                                            <th>Viatura</th>
                                            <th>Motorista</th>
                                            <th>Area de Atuação</th>
                                            <th>Cia</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Ordem</th>
                                            <th>Viatura</th>
                                            <th>Motorista</th>
                                            <th>Area de Atuação</th>
                                            <th>Cia</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php 
                                            $i = 0;
                                            foreach($listarViaturas as $listar){
                                                $nome = $listar->getNomeGuerra();
                                                $viatura = $listar->getPrefixos();
                                                $area = $listar->getAreaAtuacao();
                                                $cia = $listar->getCia();
                                                $dataEntrega = $listar->getEntrega();

                                                if($dataEntrega == null){
                                                    $i++;
                                                    echo "<tr>";
                                                    echo "<td>".$i."</td>";
                                                    echo "<td>".$viatura."</td>";
                                                    echo "<td>".$nome."</td>";
                                                    echo "<td>".$area."</td>";
                                                    echo "<td>".$cia."ª</td>";
                                                    echo "</tr>";
                                                }
                                            }

                                        ?>
                                        
                                    </tbody>
                                </table>
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
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>

</body>

</html>