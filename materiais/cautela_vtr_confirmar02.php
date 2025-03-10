<?php
    include('../conexao/conexao_01.php');
    include('../php/variaveis.php');
    require_once('../usuario/restricaoUsuarios.php');

    $conexao = new Conexao();
    $conn = $conexao->getConexao();

    $restringir = new RestricaoDeUsuario();
    $restringir->restricao();
    $nomeGuerra = $restringir->getNomeGuerra();
    $bpm = $restringir->getBpm();
    $funcao = $restringir->getFuncao();
    $tokenConfirme = $restringir->getChave();
    $funcao = $restringir->getFuncao();
    //session_start();

    // Consulta para buscar os id_prefixo da tabela viatura
    /*$sql = "SELECT * FROM viatura";
    $result = mysqli_query($conn, $sql);*/

    if(isset($_POST['salvar'])){
        
        $viatura = $_POST['exampleRadios'];
        $idMotorista = $_POST['seuId'];
        $dataCautela = $_POST['dataCautela'];
        $cia = $_POST['inputCia'];
        $areaAtuacao = $_POST['areaAtuacao'];

        function gerarToken() {
            return bin2hex(random_bytes(8)); // Token alfanumérico de 16 caracteres
        }
        
        //if (isset($_POST['gerar'])) {
            // Coleta os dados do formulário
            //$idMotorista = $_POST['seuId'];
        
            // Gera o token
            $token = gerarToken();
        
            // Verifica a conexão
            if ($conn->connect_error) {
                die("Erro de conexão: " . $conn->connect_error);
            }
        
            // Atualiza o token no banco de dados
            $sqlUpdateToken = "UPDATE usuario SET token_confirmacao = ? WHERE id = ?";
            $stmt = $conn->prepare($sqlUpdateToken);
            $stmt->bind_param("si", $token, $idMotorista);
            $stmt->execute();
        
            // Verifica se o token foi atualizado com sucesso
            /*if ($stmt->affected_rows > 0) {
                echo "<script>alert('Chave gerada com sucesso!');</script>";
            } else {
                echo "<script>alert('Erro, na geração da chave!');</script>";
            }*/
        
            // Fecha a conexão
            //$stmt->close();
            //$conn->close();
        //}
        switch($cia){
            case 1:
                $cia = 1;
                break;
            case 2:
                $cia = 2;
                break;
            case 3:
                $cia = 3;
                break;
            case 4:
                $cia = 4;
        }

        
       
    }
    $timestampEntrega = strtotime($dataCautela);
    $diaCautela = date('d-m-Y', $timestampEntrega); 
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cautela de viatura</title>

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
                    <span>Inicio</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>
            <?php if($funcao == "Cmd do P4" || $funcao == "Gerente" || $funcao == "Armeiro"){ ?>
                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item active">
                    <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
                        aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>P4</span>
                    </a>
                    <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">P4:</h6>
                            <a class="collapse-item" href="cautelarMaterial.php">Cautelar Material</a>
                            <!--<a class="collapse-item" href="materiais/materiais_cautelados.php">Descautelar</a>-->
                            <a class="collapse-item" href="historico_de_cautela.php">Historico das Cautelas</a>
                            <a class="collapse-item" href="p4/materiais_cautelados.php">Materiais cautelados</a>
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

            <!-- Nav Item - Charts -->
            <!--<li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li>-->

            <!-- Nav Item - Tables -->
            <!--<li class="nav-item">
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
                    <!--<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>-->

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
                            </a>-->
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
                        <!--<li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>-->
                                <!-- Counter - Alerts -->
                                <!--<span class="badge badge-danger badge-counter">3+</span>
                            </a>-->
                            <!-- Dropdown - Alerts -->
                            <!--<div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>-->

                        <!-- Nav Item - Messages -->
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
                                <a class="dropdown-item" href="../perfil/perfil.php">
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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">CAUTELA DE VIATURA</h1>
                    </div>

                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <!--<div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Earnings (Monthly)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>-->

                        <!-- Earnings (Annual) Card Example -->
                        <!--<div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Earnings (Annual)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>-->

                        <!-- Tasks Card Example -->
                        <!--<div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>-->

                        <!-- Pending Requests Card Example -->
                        <!--<div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Pending Requests</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>-->

                    <div class="row">

                        <div class="col-lg-6">

                            <!-- Default Card Example -->
                            <!--<div class="card mb-4">
                                <div class="card-header">
                                    Default Card Example
                                </div>
                                <div class="card-body">
                                    This card uses Bootstrap's default styling with no utility classes added. Global
                                    styles are the only things modifying the look and feel of this default card example.
                                </div>
                            </div>-->

                            <!-- Basic Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">CAUTELA DE VIATURA</h6>
                                </div>
                                <div class="card-body">
                                    <form class="row g-6" id="formConsulta" action="insert_cautela_viatura.php" method="POST" enctype="multipart/form-data">
                                        <!--<strong><?php //echo $viatura; ?></strong>-->
                                        <div class="col-sm-12">
                                            <!--<label for="inputId" class="control-label">Viatura: <input type="text" name="viatura" value="<?php //echo $viatura; ?>" readonly></label>-->
                                            <p>Viatura: <input class="form-control" type="text" name="viatura" value="<?php echo $viatura; ?>" readonly></p>
                                        </div>
                                        <div class="col-sm-12">
                                            <!--<label for="idMotorista" class="control-label">Matricula do motorista: <input type="number" name="idMotorista" value="<?php //echo $idMotorista; ?>" readonly></label>-->
                                            <p> Matricula do motorista: <input class="form-control" type="number" name="idMotorista" value="<?php echo $idMotorista; ?>" readonly></p>
                                        </div>
                                        <div class="col-sm-12">
                                            <!--<label for="inputCia" class="control-label">Companhia: <input type="number" name="inputCia" value="<?php //echo $cia; ?>" readonly>ª</label>-->
                                            <p>Companhia: <input class="form-control" type="number" name="inputCia" value="<?php echo $cia; ?>" readonly></p>
                                        </div>
                                        <div class="col-sm-12">
                                            <!--<label for="areaAtuacao" class="control-label">Area de atuação: <input type="text" name="areaAtuacao" value="<?php //echo $areaAtuacao; ?>" readonly></label>-->
                                            <p>Area de atuação: <input class="form-control" type="text" name="areaAtuacao" value="<?php echo $areaAtuacao; ?>" readonly></p>
                                        </div>
                                        <div class="col-sm-12">
                                            <!--<label for="dataCautela" class="control-label">Data da cautela: <input type="date" name="dataCautela" value="<?php //echo $diaCautela; ?>" readonly></label>-->
                                            <p>Data de cautela: <input class="form-control" type="date" name="dataCautela" value="<?php echo $dataCautela; ?>" readonly></p>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="chave" class="control-label">Chave de confirmação</label>
                                            <input type="text" class="form-control" name="chaveConfirme" id="chave">
                                        </div>
                                        <div class="col-md-12">
                                            <input type="submit" name="salvar" class="btn btn-primary btn-block" value="Cautelar">
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>

                        <!--<div class="col-lg-6">-->

                            <!-- Dropdown Card Example -->
                            <!--<div class="card shadow mb-4">-->
                                <!-- Card Header - Dropdown -->
                                <!--<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Dropdown Card Example</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>-->
                                <!-- Card Body -->
                                <!--<div class="card-body">
                                    Dropdown menus can be placed in the card header in order to extend the functionality
                                    of a basic card. In this dropdown card example, the Font Awesome vertical ellipsis
                                    icon in the card header can be clicked on in order to toggle a dropdown menu.
                                </div>
                            </div>-->

                            <!-- Collapsable Card Example -->
                            <!--<div class="card shadow mb-4">-->
                                <!-- Card Header - Accordion -->
                                <!--<a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
                                    role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                    <h6 class="m-0 font-weight-bold text-primary">Collapsable Card Example</h6>
                                </a>-->
                                <!-- Card Content - Collapse -->
                                <!--<div class="collapse show" id="collapseCardExample">
                                    <div class="card-body">
                                        This is a collapsable card example using Bootstrap's built in collapse
                                        functionality. <strong>Click on the card header</strong> to see the card body
                                        collapse and expand!
                                    </div>
                                </div>
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
                    <a class="btn btn-primary" href="login.html">Sair</a>
                </div>
            </div>
        </div>
    </div>
    
    <script>
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

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

</body>

</html>