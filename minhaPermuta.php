<?php
    include('conexao/conexao.php');
    //include('php/variaveis.php');
    session_start();
    $usuario = $_SESSION['matricula'];

    //$sqlPermutado = "SELECT * FROM usuario JOIN  WHERE "

    
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Minhas Permutas</title>

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
                    <i class="fas fa-laugh-wink"></i>
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
                    <!--<i class="fas fa-fw fa-cog"></i>--> <!--icone de configuração-->
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Sessões</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Sessões:</h6>
                        <a class="collapse-item" href="https://forms.gle/K8YfA3b4KX1GyZb9A">Relatorio de disparos</a>
                        <a class="collapse-item" href="https://forms.gle/fyZNtGv944nVugyx5">Boletim de ocorrêcnia</a>
                        <a class="collapse-item" href="https://forms.gle/veP7Vn8PN9kn3GiMA">Livro do CPU</a>
                        <a class="collapse-item" href="https://forms.gle/VMEXp9aiMwnipWu2A">Cmd de guarnição</a>
                        <a class="collapse-item" href="https://docs.google.com/forms/d/e/1FAIpQLScR13pjdKiim6uX4gtNVvCJB6Ql4Qe4pU8JFCLE4DjhAOXuwA/viewform?vc=0&c=0&w=1&flr=0">Check list</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <!--<li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTree"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-filter"></i>
                    <span>Fitros</span>
                </a>
                <div id="collapseTree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Ocorrências:</h6>
                        <a class="collapse-item" href="relatorioOcorrencias.php">Periodo/data</a>
                        <a class="collapse-item" href="graficoOcorrencia.php">Bairro/Grafico</a>
                        
                    </div>
                </div>
            </li>-->
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

                    <!-- Sidebar Toggle (Topbar) butão hamburguer quando está responsivo para mobile -->
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
                                <a class="dropdown-item" href="usuario/updatePerfil.php">
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
                    <h1 class="h3 mb-4 text-gray-800">Permutas</h1>

                    <div class="row">

                        <div class="col-lg-9">

                            <!-- Brand Buttons -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Permutas confirmadas</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Nome do Permutante</th>
                                                    <th>Nome do Pemutado</th>
                                                    <th>data do serviço</th>
                                                    <th>Sua confirmação</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Nome do Permutante</th>
                                                    <th>Nome do Pemutado</th>
                                                    <th>data do serviço</th>
                                                    <th>Sua confirmação</th>
                                                    
                                                </tr>
                                            </tfoot>
                                                <tbody>
                                                    <?php

                                                    //=================================================================================================================================================================================================================================================
                                                    //implementar o relacionamentos entre as tabelas usuario e agenda_permuta
                                                    $sqlResultadoPermuta = "SELECT
                                                                                usuario1.nome_de_guerra AS guerraPermutante,
                                                                                usuario2.nome_de_guerra AS guerraPermutado,
                                                                                permutas.matr_permutante,
                                                                                permutas.matr_permutado,
                                                                                permutas.dia_permuta,
                                                                                permutas.aceito_permuta
                                                                            FROM permutas
                                                                            JOIN usuario AS usuario1 ON permutas.matr_permutante = usuario1.id
                                                                            JOIN usuario AS usuario2 ON permutas.matr_permutado = usuario2.id
                                                                            WHERE permutas.matr_permutante = $usuario OR permutas.matr_permutado = $usuario";

                                                                                //WHERE usuario.id = $usuario
                                                    $resultado = mysqli_query($conn, $sqlResultadoPermuta) or die ("Erro oa tentar ver as permutas");
                                                    while($rowPermuta = mysqli_fetch_assoc($resultado)){
                                                        //$id = $rowPermuta['id'];
                                                        $matrPermutante = $rowPermuta['matr_permutante'];
                                                        $guerraPermutante= $rowPermuta['guerraPermutante'];
                                                        $guerraPermutado = $rowPermuta['guerraPermutado'];
                                                        $permutado = $rowPermuta['matr_permutado'];
                                                        $dataPermuta = $rowPermuta['dia_permuta'];
                                                        $confirmAgenda = $rowPermuta['aceito_permuta'];

                                                        //formatação do modelo de dia-mês-ano para o convencionado no brasil
                                                        $timestamp = strtotime($dataPermuta);
                                                        $dataFormatada = date('d-m-Y', $timestamp);

                                                            if($id = $usuario){
                                                                echo "<tr>";
                                                                echo "<td>".$guerraPermutante."</td>";
                                                                echo "<td>".$guerraPermutado."</td>";
                                                                echo "<td>".$dataFormatada."</td>";
                                                                echo "<td>".$confirmAgenda."</td>";
                                                            
                                                                echo "</tr>";
                                                            }
                                                        }
                                                    ?>
                                                
                                                </tbody>
                                        </table>
                                    </div>
                                    
                                </div>
                            </div>
                            <!------=====================================================================================================----------------------->
                            <!--inicia outro card-->

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Permutas pendentes</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Nome completo</th>
                                                    <th>Matricula/ID</th>
                                                    <th>data do serviço</th>
                                                    <th>Situação</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Nome completo</th>
                                                    <th>Matricula/ID</th>
                                                    <th>data do serviço</th>
                                                    <th>Situação</th>
                                                    
                                                </tr>
                                            </tfoot>
                                                <tbody>
                                                    <?php

                                                    //=================================================================================================================================================================================================================================================
                                                    //implementar o relacionamentos entre as tabelas usuario e agenda_permuta
                                                    $sqlResultadoPermutaAg = "SELECT 
                                                                                usuario.id,
                                                                                usuario.nome_completo,
                                                                                agenda_permuta.matr_permutante,
                                                                                agenda_permuta.dia_agenda,
                                                                                agenda_permuta.aceito_permuta
                                                                            FROM agenda_permuta
                                                                            JOIN usuario ON agenda_permuta.matr_permutante = usuario.id
                                                                            WHERE usuario.id = $usuario";

                                                                                //WHERE usuario.id = $usuario
                                                    $resultadoAg = mysqli_query($conn, $sqlResultadoPermutaAg) or die ("Erro oa tentar ver as permutas");
                                                    while($rowPermuta = mysqli_fetch_assoc($resultadoAg)){
                                                        //$id = $rowPermuta['id'];
                                                        $nomeCompletoAg = $rowPermuta['nome_completo'];
                                                        $matrPermutanteAg = $rowPermuta['matr_permutante'];
                                                        $dataPermutaAg = $rowPermuta['dia_agenda'];
                                                        $confirmAgendaAg = $rowPermuta['aceito_permuta'];
                                                        //fomratação da data vindo do banco de dados de ano-mês-dia para dia-mês-ano como é convencionado no brasil
                                                        $timestamp = strtotime($dataPermutaAg);
                                                        $dataFormatadaAg = date('d-m-Y', $timestamp);
                                                        //$_SESSION['nomedeguerra'] = $guerra;
                                                            if($confirmAgendaAg == "Não"){
                                                                echo "<tr>";
                                                                echo "<td>".$nomeCompletoAg."</td>";
                                                                echo "<td>".$matrPermutanteAg."</td>";
                                                                echo "<td>".$dataFormatadaAg."</td>";
                                                                echo "<td>".$confirmAgendaAg."</td>";
                                                            
                                                                echo "</tr>";
                                                            }
                                                        }
                                                    ?>
                                                
                                                </tbody>
                                        </table>
                                    </div>
                                    
                                </div>
                            </div>
                            <!---finaliza o card--->
                            <!--===============================================================================================================--------------->
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

    <!-- Modal de permuta-->

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>