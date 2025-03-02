<?php
    include('conexao/conexao.php');
    include('php/variaveis.php');
    //session_start();
    $usuario = $_SESSION['matricula'];

    $id = $_GET['aceite'];
    $sqlId = "SELECT usuario.id, usuario.nome_completo, usuario.nome_de_guerra, agenda_permuta.id_agenda, agenda_permuta.matr_permutante, agenda_permuta.dia_agenda
    FROM agenda_permuta JOIN usuario ON agenda_permuta.matr_permutante = usuario.id WHERE agenda_permuta.id_agenda = $id";
    //======================================================================================================================================================================
    $sqlUsuario = "SELECT * FROM usuario WHERE id = $usuario";
    $resUsuario = mysqli_query($conn, $sqlUsuario);
    $rowUsuario = mysqli_fetch_assoc($resUsuario);
    $meuNome = $rowUsuario['nome_completo'];

    //======================================================================================================================================================================
    $res = mysqli_query($conn, $sqlId);
    $rowId = mysqli_fetch_assoc($res);
        $idPermu = $rowId['id_agenda'];
        $matrPermuta = $rowId['matr_permutante'];
        $nomeCompleto = $rowId['nome_completo'];
        $nomeGuerra = $rowId['nome_de_guerra'];
        $diaPermuta = $rowId['dia_agenda'];

        if(isset($_POST['confirmar'])){
            //$aceite = ($_POST['flexRadioDefault'] == 1) ? "Sim" : "Não";
            $aceite = "Confirmado";
            $updAgenda = "UPDATE `agenda_permuta`
                        SET aceito_permuta='$aceite' WHERE id_agenda=$id";
            $resUpdAgenda = mysqli_query($conn, $updAgenda);

            $matricula_permutante = $_POST['matrPermutante'];
            $matricula_permutado = $_POST['suaMatricula'];
            $dia_Permuta = $_POST['diaPermuta'];
           // $autorizacao = ($_POST['flexRadioDefault1'] == 1) ? "Sim" : "Não";
            $justificativa = "Motivos pessoais!";//$_POST['justificativa'];
            $autorizacao = "Em análise";
            $addPermuta = "INSERT INTO permutas (`matr_permutante`, `matr_permutado`, `dia_permuta`, `aceito_permuta`, `autorizacao_permuta`, `justificativa`) VALUE (?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $addPermuta);

           
                mysqli_stmt_bind_param($stmt, 'iissss', $matricula_permutante, $matricula_permutado, $dia_Permuta, $aceite, $autorizacao, $justificativa);
                $resultado = mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
                if($resUpdAgenda && $resultado){
                    //echo "Atualizado com sucesso!";
                    //header('Location:http://localhost/projetos/1Bptur/confirUpgrade.php');
                    //header('Location:https://2bptur.com/home.php');
                }else{
                    header('Location:http://localhost/projetos/1Bptur/erroUpgrade.php');
                    //header('Location:https://2bptur.com/erroUpgrade.php');
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

    <title>SB Admin 2 - Permuta</title>

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
                    <!--<i class="fas fa-fw fa-cog"></i>--> <!--icone de configuração-->
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Sessões</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Sessões:</h6>
                        <a class="collapse-item" href="ocorrencias.php">
                            <!--<?php
                                if($situacao == "HABILITADO"){
                                    $ocorrencia = "Ocorrência";
                                    echo $ocorrencia;
                                }
                            ?>-->
                        </a>
                        <a class="collapse-item" href="usuario.php">
                            <!--<?php 
                                if($situacao == "HABILITADO"){
                                    $verUsuario = "Usuarios";
                                    echo $verUsuario;
                                }
                            ?>-->
                        </a>
                        <a class="collapse-item" href="https://forms.gle/K8YfA3b4KX1GyZb9A">Relatorio de disparos</a>
                        <a class="collapse-item" href="https://forms.gle/fyZNtGv944nVugyx5">Boletim de ocorrêcnia</a>
                        <a class="collapse-item" href="https://forms.gle/veP7Vn8PN9kn3GiMA">Livro do CPU</a>
                        <a class="collapse-item" href="https://forms.gle/VMEXp9aiMwnipWu2A">Cmd de guarnição</a>
                        <a class="collapse-item" href="https://docs.google.com/forms/d/e/1FAIpQLScR13pjdKiim6uX4gtNVvCJB6Ql4Qe4pU8JFCLE4DjhAOXuwA/viewform?vc=0&c=0&w=1&flr=0">Check list</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
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
                        <!--<a class="collapse-item" href="#">Cadastrar Ranking's</a>-->
                    </div>
                </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
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

                        <div class="col-lg-10">

                            <!-- Brand Buttons -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Permutas</h6>
                                </div>
                                <div class="card-body">
                                    <form class="row g-6" id="formConsulta" method="POST" enctype="multipart/form-data">
                                        <div class="col-sm-6">
                                            <label for="inputMatricula" class="control-label">Seu nome</label>
                                            <input type="text" class="form-control" name="nomeCompleto" id="inputGuerra" value="<?php echo $meuNome;?>">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="inputMatricula" class="control-label">Sua matricula</label>
                                            <input type="number" class="form-control" name="suaMatricula" id="inputGuerra" value="<?php echo $usuario;?>">
                                        </div>
                                        <div class="col-sm-6">
                                            <br>
                                            <label for="inputMatricula" class="control-label">Nome do permutante</label>
                                            <input type="text" class="form-control" name="nomePermutante" id="inputGuerra" value="<?php echo $nomeCompleto;?>">
                                        </div>
                                        <div class="col-sm-6">
                                            <br>
                                            <label for="inputMatricula" class="control-label">Matricula do permutante</label>
                                            <input type="number" class="form-control" name="matrPermutante" id="inputGuerra" value="<?php echo $matrPermuta;?>">
                                        </div>
                                        <!--<div class="col-md-6" >
                                            <label for="inputSituacao" class="form-label">Você aceita a permuta?</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="1" name="flexRadioDefault" id="flexRadioDefault1" checked>
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Sim
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="0" name="flexRadioDefault" id="flexRadioDefault2" >
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                    Não
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6" style="display :none;">
                                            <label for="inputSituacao" class="form-label">Autorização de permuta</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="1" name="flexRadioDefault1" id="flexRadioDefault1">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Sim
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="0" name="flexRadioDefault1" id="flexRadioDefault2" checked>
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                    Não
                                                </label>
                                            </div>
                                        </div>-->
                                        <div class="col-sm-3">
                                            <!--<span id="msgAlerta1"></span>--->
                                            <label for="dataFinal" class="form-label">Data da permuta</label>
                                            <input type="text" class="form-control" name="diaPermuta" id="inputGuerra" value="<?php echo $diaPermuta;?>">
                                            <!--<input type="date" class="form-control" name="dataPermuta" id="dataFinal">-->
                                        </div>
                                        <!--<div class="col-sm-12" style="display: none;">
                                            <br>
                                            <label for="Justificativa" class="control-label">Justificativa</label>
                                            <textarea class="form-control" id="Justificativa" name="justificativa" rows="3"></textarea>
                                        </div>-->
                                        <div class="modal-footer">
                                            <input type="submit" name="confirmar" class="btn btn-primary" value="CONFIRMAR">
                                            <a href="home.php" class="btn btn-danger">NÃO CONFIRMO</a>
                                            <!--<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>-->
                                        </div>
                                    </form>
                                    
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
                    <a class="btn btn-primary" href="index.html">Sair</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>