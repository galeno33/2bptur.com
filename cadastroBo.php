<?php
    include('conexao/conexao.php');
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Charts</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">


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
                        <a class="collapse-item" href="ocorrencias.php">Ocorrências</a>
                        <a class="collapse-item" href="usuario.php">Usuarios</a>
                        <!--<a class="collapse-item" href="#">Cadastrar Ranking's</a>-->
                    </div>
                </div>
            </li>

           
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
                                <a class="dropdown-item" href="#">
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
                    <h1 class="h3 mb-2 text-gray-800">Cadastrar Ocorrências</h1>
                   
                    <!-- Content Row -->
                    <!--<div class="row">-->

                        <!--<div class="col-xl-11 col-lg-12">-->
                       
                        <!-- Button trigger modal -->
                        
                            <!-- Area Chart -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-4">
                                    <h6 class="m-0 font-weight-bold text-primary">Cadastrar Ocorrências</h6>
                                </div>
                                
                               <!-- Button trigger modal -->
                               <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                                    Adicionar Matricula
                                </button>       -->


                                <!-- Modal -->
                              <!--  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel"></h4>
                                    </div>
                                    <div class="modal-body">
                                        
                                        <button style="margin: 0 auto; text-align: center; position: relative;" type="button" class="btn btn-primary" onclick="adicionarMatricula()"> + </button>
                                        <form class="row g-6" action="ocorrencias/gravarMiker.php" method="POST" enctype="multipart/form-data">
                                            <div class="col-sm-6">
                                                <label for="inputMiker" class="form-label">Miker/numero do BO</label>
                                                <input type="text" class="form-control" name="miker" id="inputMiker" placeholder="M-0000000">
                                            </div>
                                            <div class="form-group">    -->
                                                    <!--<span id="msgAlerta1"></span>--->
                                                       <!-- <label for="inputMatricula" class="form-label">Matricula</label>
                                                        <input type="number" class="form-control" name="matricula[]" id="inputMatricula" placeholder="Digite a Matricula">
                                                        
                                                </div>-->
                                           <!-- <div id="exibirDados"></div>
                                            <div id="containerMatriculas" class="col-md-3" style="text-align: center; margin: 0 auto;"> -->
                                                <!-- Campos de matrícula serão adicionados aqui -->
                                                
                                          <!--  </div>
                                            
                                        </form>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" onclick="dadosAdicionados()">Salvar Matricula</button>
                                    </div>
                                    </div>
                                </div>
                                </div>-->

                                <div class="card-body">
                                    <div class="chart-area">
                                        <!--<canvas id="myAreaChart"></canvas>-->

                                        <form class="row g-3" id="cadastroOcorrencia" action="ocorrencias/intoOcorrencia.php" method="POST" enctype="multipart/form-data">
                                            
                                            <div id="adMatricula" class="col-sm-3">
                                                <div class="form-group">
                                                    <span id="msgAlerta1"></span>
                                                        <label for="inputMatricula" class="form-label">Matricula</label>
                                                        <input type="number" class="form-control" name="matricula" id="inputMatricula" placeholder="Digite a Matricula">
                                                        
                                                </div>
                                                <!--<div id="exibirDados"></div>-->
                                            </div>
                                            <div class="col-sm-3">
                                                <label for="inputMiker" class="form-label">Miker/numero do BO</label>
                                                <input type="number" class="form-control" name="miker" placeholder="000000000">
                                            </div>
                                            <div class="col-sm-3">
                                                <label for="inputSigo" class="form-label">Sigo</label>
                                                <input type="text" class="form-control" name="sigo" id="inputSigo" placeholder="000000/2023">
                                            </div>
                                            <div class="col-sm-3">
                                                <label for="inputTipificacao" class="form-label">Tipificação de crime</label>
                                                <select class="form-control" name="tipificacao" aria-label="Default select example">
                                                    <option selected>Digite a tipificação</option>
                                                    <option value="1">Furto</option>
                                                    <option value="2">Roubo</option>
                                                    <option value="3">Receptação</option>
                                                    <option value="4">Arma de Fogo</option>
                                                    <option value="5">Objeto Perfurocortante</option>
                                                    <option value="6">Entorpecentes</option>
                                                    <option value="7">Veiculo Recuperado</option>
                                                    <option value="8">Kadron Apreendido</option>
                                                    <option value="9">Foragidos</option>
                                                    <option value="10">Outras Tipificações</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-3">
                                                <label for="inputData" class="form-label">Data da Ocorrência</label>
                                                <input type="date" class="form-control" name="inputdata" id="inputData" placeholder="Digite a data">
                                            </div>

                                            <div class="col-sm-3">
                                                <label for="inputSigo" class="form-label">Endereço</label>
                                                <input type="text" class="form-control" name="endereco" id="endereco" placeholder="Rua do matadouro-s/nº">
                                            </div>

                                            <div class="col-sm-3">
                                                <label for="inputSigo" class="form-label">Bairro</label>
                                                <input type="text" class="form-control" name="bairro" id="bairro" placeholder="Murici">
                                            </div>

                                            <div class="col-sm-3">
                                                <label for="inputSigo" class="form-label">Cidade</label>
                                                <input type="text" class="form-control" name="cidade" id="cidade" placeholder="barreirinhas">
                                            </div>

                                            <div class="col-sm-4">
                                                <label for="inputData" class="form-label">Situação da Ocorrência</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="1" name="flexRadioDefault" id="flexRadioDefault1" checked>
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        Boletim informativo
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="2" name="flexRadioDefault" id="flexRadioDefault1">
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        Fragrante
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="3" name="flexRadioDefault" id="flexRadioDefault2" >
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                        Termo circuntancial de ocorrência
                                                    </label>
                                                </div>
                                            </div>
                                           
                                            <div class="col-sm-12">
                                                <button type="submit" name="salvar" class="btn btn-primary">Salvar Cadastro</button>
                                            </div>
                                        </form>

                                    </div>
                                    <hr>
                                   
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
                    <a class="btn btn-primary" href="index.html">Sair</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    
    <!--<script src="js/campo.js"></script>-->
    
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script src="js/demo/chart-bar-demo.js"></script>

        <!-----------------------------------------modal paa formulario------------------------------->
        <!-- Button trigger modal -->


        

        

</body>



</html>