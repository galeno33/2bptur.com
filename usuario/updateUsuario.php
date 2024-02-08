<?php
    include ('../conexao/conexao.php');
    session_start();
    $id_usuario = $_GET['updAdministra'];
    $sqlUpd = "SELECT * FROM usuario WHERE id = $id_usuario";
    $rest = mysqli_query($conn, $sqlUpd);

    while($rowUpd = mysqli_fetch_assoc($rest)){
        $id = $rowUpd['id'];
        $nomeComplet = $rowUpd['nome_completo'];
        $guerra = $rowUpd['nome_de_guerra'];
        $posto = $rowUpd['posto_usuario'];
        $telefone = $rowUpd['telefone_usuario'];
        $senha = $rowUpd['senha_usuario'];
        $cia = $rowUpd['cia'];
        $situacao = $rowUpd['situacao'];
    }
    
    //retorna os dados que serão atualizados
    if(isset($_POST['updateUsuario'])){
        $situacao = $_POST['flexRadioDefault'];
        

        $upg = "UPDATE `usuario` SET id=$id_usuario,
                                   nome_completo= '$nomeComplet',
                                   nome_de_guerra= '$guerra',
                                   posto_usuario= '$posto',
                                   telefone_usuario=$telefone,
                                   senha_usuario='$senha',
                                   cia = $cia,
                                   situacao='$situacao'
                                   WHERE id=$id_usuario";
        $res=mysqli_query($conn, $upg);
            if($res){
                //echo "Atualizado com sucesso!";
                header('Location:https://sistemabptur.000webhostapp.com/usuario/listaUsuario.php');
            }else{
                header('Location:https://sistemabptur.000webhostapp.com/erro/atualizaUsuario.html');
                //die(mysqli_error($conn));
            }
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
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home.php">
                <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-shield-alt"></i>
                </div>
                <div class="sidebar-brand-text mx-3"><?php echo $_SESSION['batalhao']; ?><sup><?php echo $_SESSION['indice']; ?></sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="home.php">
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
                    <span>Sessões</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Sessões:</h6>
                        <!--<a class="collapse-item" href="cadastroBo.php">Cadastro Ocorrências</a>-->
                        <a class="collapse-item" href="usuario.php">Usuarios</a>
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['guerra']; ?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="pagConstrucao.html">
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
                    <h1 class="h3 mb-2 text-gray-800">Cadastro de Usuarios</h1>
                    

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-11 col-lg-12">

                            <!-- Area Chart -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Cadastrar usuarios</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area">
                                        <!--<canvas id="myAreaChart"></canvas>-->

                                        <form class="row g-3" id="cadastroUsuario" action="usuario/lancarUsuario.php" method="POST" enctype="multipart/form-data">
                                            <div class="col-9">
                                                <label for="inputNome" class="form-label">Nome completo</label>
                                                <input type="text" class="form-control" name="nomeCompleto" id="inputNome" value="<?php echo $nomeComplet;?>" disabled>
                                            </div>
                                            <div class="col-3">
                                                <label for="inputMatricula" class="form-label">Matricula</label>
                                                <input type="number" class="form-control" name="matricula" id="inputMatricula" value="<?php echo $id;?>" disabled>
                                            </div>
                                            <div class="col-6">
                                                <label for="inputGuerra" class="form-label">Nome de Guerra</label>
                                                <input type="text" class="form-control" name="nomeGuerra" id="inputGuerra" value="<?php echo $guerra;?>" disabled>
                                            </div>
                                            <div class="col-6">
                                                <label for="inputPosto" class="form-label">Posto/Patente</label>
                                                <input type="text" class="form-control" name="posto" id="inputPosto" value="<?php echo $posto;?>" disabled>
                                            </div>
                                            <div class="col-3">
                                                <label for="inputTelefone" class="form-label" >Telefone</label>
                                                <input type="tel" class="form-control" name="telefone" id="inputTelefone" value="<?php echo $telefone;?>" disabled>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputPassword4" class="form-label">Password</label>
                                                <input type="password" class="form-control" name="senha" id="senha" value="<?php echo $senha;?>" disabled>
                                                <!---<div class="form-check">
                                                    
                                                    <label class="form-check-label" for="gridCheck">
                                                        <input class="form-check-input" type="checkbox" id="gridCheck" onclick="mostrarSenha()">
                                                        Visualizar senha
                                                    </label>
                                                </div>--->
                                            </div>
                                            
                                            <div class="col-3">
                                                <label for="inputCia" class="form-label">Cia</label>
                                                <input type="text" class="form-control" name="cia" id="inputCia" value="<?php echo $cia;?>" disabled>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputSituacao" class="form-label">Situação de acesso</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="1" name="flexRadioDefault" id="flexRadioDefault1">
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        Habilitado
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="0" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                        Desabilitado
                                                    </label>
                                                </div>
                                            </div>
                                                <br>
                                                <div class="col-md-12">
                                                <button type="submit" name="updateUsuario" class="btn btn-primary">Atualizar</button>
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
                    <a class="btn btn-primary" href="login.html">Sair</a>
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