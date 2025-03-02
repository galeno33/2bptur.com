<?php
    require_once('../conexao/conexao_01.php');
    require_once('../usuario/restricaoUsuarios.php');
    require_once('graficoData.php'); // Classe adaptada para buscar os dados
    //require_once('graficoCpams.php');

    $crimeData = new CrimeData();
    $crimeCounts = $crimeData->getCrimeCounts(); // Obtenha os dados do banco

    $conexao = new Conexao();
    $conn = $conexao->getConexao();

    $restringir = new RestricaoDeUsuario();
    $restringir->restricao();
    $tokenConfirme = $restringir->getChave();
    $classe = $restringir->getClasse();
    $situacao = $restringir->getSituacao();
    $funcao = $restringir->getFuncao();
    //$ciaRestrito = $restringir->getCiaRestrito();
    $nomeGuerra = $restringir->getNomeGuerra(); 
    $bpm = $restringir->getBpm(); 

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Estatisticas</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        #dia {
            margin-right: 30px;
        }
        .chart-container {
            position: relative;
            width: 100%; /* Sempre ocupar 100% da largura disponível */
            height: auto; /* Ajustar a altura proporcionalmente */
            min-height: 300px; /* Altura mínima para evitar gráficos muito pequenos */
        }

        #cpamBarChart {
            width: 100% !important; /* Garantir ajuste ao tamanho do contêiner */
            height: auto !important; /* Altura proporcional */
        }
    </style>


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../home.php">
                <div class="sidebar-brand-icon rotate-n-20">
                    <img src="../img/brasao_cpm.ico" alt="" width="50" height="50">
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

            <!-- Conditional Administrative Section -->
            <?php if ($situacao == "HABILITADO") { ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
                        aria-expanded="true" aria-controls="collapseOne">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Área do Administrativo</span>
                    </a>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Administrativo:</h6>
                            <?php
                            /*$selectFiltro = "SELECT cia FROM usuario WHERE cia = $ciaRestrito";
                            $selectRes = mysqli_query($conn, $selectFiltro);
                            $selectRow = mysqli_fetch_assoc($selectRes);
                            $ciaFiltro = $selectRow['cia'];*/

                            if ($funcao == "Cmd. de Batalhão" || $funcao == "Sub. Cmd de Batalhão" || $funcao == "Cmd de Cia" ||
                                $funcao == "Sub Cmd de Cia" || $funcao == "Cmd do P1" || $funcao == "Cmd do P2" ||
                                $funcao == "Cmd do P3" || $funcao == "Cmd do P4" || $funcao == "Gerente") {
                                echo "<a class='collapse-item' href='autorizacao_permuta/permuta_a_autorizar.php'>Permuta a Autorizar</a>";
                            }

                            if ($situacao == "HABILITADO") {
                                echo "<a class='collapse-item' href='filtragem_pesquisas/relatorioOcorrencias.php'>Filtro de ocorrências</a>";
                                echo "<a class='collapse-item' href='autorizacao_permuta/permutas_autorizadas.php'>Permutas Autorizadas</a>";
                            }
                            ?>
                            <a class="collapse-item" href="grafico_estatisticas/estatisticas.php">Estatisticas</a>
                            <a class="collapse-item" href="ocorrencias/ocorrencias.php">Ocorrência</a>
                            <a class="collapse-item" href="usuario/verUsuarios.php">Usuários</a>
                        </div>
                    </div>
                </li>
            <?php } ?>

            <!-- Interface Section -->
            <!--<div class="sidebar-heading">Interface</div>-->

            <?php if($funcao == "Cmd do P4" || $funcao == "Gerente"){ ?>
                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
                        aria-expanded="true" aria-controls="collapseThree">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>P4</span>
                    </a>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">P4:</h6>
                        
                            <a class="collapse-item" href="p4/cargas_da_unidade.php">Cargas da unidade</a>
                             
                        </div>
                    </div>
                </li>
            <?php } ?>

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
                           <!-- <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
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
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-solid fa-key"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter"><!--adicionar cor quando tiver token --></span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="font-weight-bold">
                                        <div class="text-truncate" id="token-notification">
                                            <strong>Chave:</strong> <span id="token-value"><?php echo $tokenConfirme; ?></span>
                                        </div>
                                    </div>
                                </a>

                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <!--<li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>-->
                                <!-- Counter - Messages -->
                                <!--<span class="badge badge-danger badge-counter">7</span>
                            </a>-->
                            <!-- Dropdown - Messages -->
                            <!--<div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>

                            </div>
                        </li>-->

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php  echo $nomeGuerra; ?></span>
                                <img class="img-profile rounded-circle"
                                    src="../img/undraw_profile.svg">
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
                                    Configurações
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
                
                <div class="container-fluid">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="porCpam-tab" data-toggle="tab" href="#porCpam" role="tab" aria-controls="porCpam" aria-selected="true">Por CPAM</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="porUnidade-tab" data-toggle="tab" href="#porUnidade" role="tab" aria-controls="porUnidade" aria-selected="false">Todas as Unidades</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="porGrupoCrime-tab" data-toggle="tab" href="#porGrupoCrime" role="tab" aria-controls="porGrupoCrime" aria-selected="false">Grupos de Crimes</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <!-- Aba Por CPAM -->
                        <div class="tab-pane fade show active" id="porCpam" role="tabpanel" aria-labelledby="porCpam-tab">
                            <div class="col-12 col-md-6 col-lg-6">
                                <label for="cpamsSelect" class="form-label">Por CPAMS</label>
                                <select class="form-control form-control-lg" id="cpamsSelect">
                                    <option selected disabled>Selecione o CPAM</option>
                                    <option value="1">CPAM-NORTE</option>
                                    <option value="2">CPAM-SUL</option>
                                    <option value="3">CPAM-LESTE</option>
                                    <option value="4">CPAM-OESTE</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-3" id="inputBpmNorte" style="display:none;">
                                    <label for="inputBpmNorteSelect" class="form-label">Unidade</label>
                                    <select class="form-control" id="inputBpmNorteSelect" name="inputBpmNorte">
                                        <option selected disabled>Selecione a unidade</option>
                                        <option value="8º BPM">8º BPM</option>
                                        <option value="20º BPM">20º BPM</option>
                                        <option value="40º BPM">40º BPM</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3" id="inputBpmSul" style="display:none;">
                                    <label for="inputBpmSulSelect" class="form-label">Unidade</label>
                                    <select class="form-control" id="inputBpmSulSelect" name="inputBpmSul">
                                        <option selected disabled>Selecione a unidade</option>
                                        <option value="1º BPM">1º BPM</option>
                                        <option value="21º BPM">21º BPM</option>
                                        <option value="42º BPM">42º BPM</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3" id="inputBpmLeste" style="display:none;">
                                    <label for="inputBpmLesteSelect" class="form-label">Unidade</label>
                                    <select class="form-control" id="inputBpmLesteSelect" name="inputBpmLeste">
                                        <option selected disabled>Selecione a unidade</option>
                                        <option value="6º BPM">6º BPM</option>
                                        <option value="13º BPM">13º BPM</option>
                                        <option value="43º BPM">43º BPM</option>
                                        <option value="22º BPM">22º BPM</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3" id="inputBpmOeste" style="display:none;">
                                    <label for="inputBpmOesteSelect" class="form-label">Unidade</label>
                                    <select class="form-control" id="inputBpmOesteSelect" name="inputBpmOeste">
                                        <option selected disabled>Selecione a unidade</option>
                                        <option value="9º BPM">9º BPM</option>
                                        <option value="38º BPM">38º BPM</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-check d-flex justify-content-around flex-wrap py-2">
                                <div>
                                    <input class="form-check-input" type="radio" name="exampleRadios" value="7_dias" checked>
                                    <label class="form-check-label">7 Dias</label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="radio" name="exampleRadios" value="15_dias">
                                    <label class="form-check-label">15 Dias</label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="radio" name="exampleRadios" value="1_mes">
                                    <label class="form-check-label">1 Mês</label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="radio" name="exampleRadios" value="6_meses">
                                    <label class="form-check-label">6 Meses</label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="radio" name="exampleRadios" value="1_ano">
                                    <label class="form-check-label">1 Ano</label>
                                </div>
                            </div>
                            <div class="card shadow mb-4" id="graficoCardCpam" style="display:none;">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Gráfico Estatístico - Por CPAM</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-container">
                                        <canvas id="cpamBarChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Aba Todas as Unidades -->
                        <div class="tab-pane fade" id="porUnidade" role="tabpanel" aria-labelledby="porUnidade-tab">
                            <div class="form-check d-flex justify-content-around flex-wrap py-2">
                                <div>
                                    <input class="form-check-input" type="radio" name="exampleRadios" value="7_dias" checked>
                                    <label class="form-check-label">7 Dias</label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="radio" name="exampleRadios" value="15_dias">
                                    <label class="form-check-label">15 Dias</label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="radio" name="exampleRadios" value="1_mes">
                                    <label class="form-check-label">1 Mês</label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="radio" name="exampleRadios" value="6_meses">
                                    <label class="form-check-label">6 Meses</label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="radio" name="exampleRadios" value="1_ano">
                                    <label class="form-check-label">1 Ano</label>
                                </div>
                            </div>
                            <div class="card shadow mb-4" id="graficoCardUnidade" style="display:none;">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Gráfico Estatístico - Todas as Unidades</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-container">
                                        <canvas id="unidadeBarChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Aba Grupos de Crimes -->
                        <div class="tab-pane fade" id="porGrupoCrime" role="tabpanel" aria-labelledby="porGrupoCrime-tab">
                            <div class="col-12 col-md-6 col-lg-6">
                                <label for="grupoCrimeSelect" class="form-label">Por Grupos de Crimes</label>
                                <select class="form-control" id="grupoCrimeSelect">
                                    <option selected disabled>Selecione o Grupo</option>
                                    <option value="1">Crimes Violentos</option>
                                    <option value="2">Crimes Comuns</option>
                                    <option value="3">Cvli</option>
                                </select>
                            </div>
                            <div class="form-check d-flex justify-content-around flex-wrap py-2">
                                <div>
                                    <input class="form-check-input" type="radio" name="exampleRadios" value="7_dias" checked>
                                    <label class="form-check-label">7 Dias</label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="radio" name="exampleRadios" value="15_dias">
                                    <label class="form-check-label">15 Dias</label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="radio" name="exampleRadios" value="1_mes">
                                    <label class="form-check-label">1 Mês</label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="radio" name="exampleRadios" value="6_meses">
                                    <label class="form-check-label">6 Meses</label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="radio" name="exampleRadios" value="1_ano">
                                    <label class="form-check-label">1 Ano</label>
                                </div>
                            </div>
                            <div class="card shadow mb-4" id="graficoCardGrupo" style="display:none;">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Gráfico Estatístico - Grupos de Crimes</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-container">
                                        <canvas id="grupoBarChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- /.container-fluid -->
                
                <!--<div class="container-fluid">-->

                    <!--<ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="porCpam-tab" data-toggle="tab" href="#porCpam" role="tab" aria-controls="porCpam" aria-selected="true">Por Cpam</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="porUnidade-tab" data-toggle="tab" href="#porUnidade" role="tab" aria-controls="porUnidade" aria-selected="false">Todas as Unidade</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="porGrupoCrime-tab" data-toggle="tab" href="#porGrupoCrime" role="tab" aria-controls="porGrupoCrime" aria-selected="false">Grupos de crimes</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="porCpam" role="tabpanel" aria-labelledby="porCpam-tab">
                         CPAM -->
                         <!--<div class="card-body">-->
                        <!--<div class="col-12 col-md-6 col-lg-6" id="porCpam">
                            <label for="tipoDeGrafico" class="form-label">Por CPAMS</label>
                            <select class="form-control form-control-lg" id="cpamsSelect">
                                <option selected disabled>Selecione o CPAM</option>
                                <option value="1">CPAM-NORTE</option>
                                <option value="2">CPAM-SUL</option>
                                <option value="3">CPAM-LESTE</option>
                                <option value="4">CPAM-OESTE</option>
                            </select>
                        </div>-->
                        <!-- Unidade região norte-->
                       <!-- <div class="col-12 col-md-6 col-lg-3" id="inputBpmNorte" style= "display:none;">
                            <label for="inputBpm" class="form-label">Unidade</label>
                            <select class="form-control" name="inputBpmNorte">
                                <option selected disabled>Selecione a unidade</option>
                                <option value="8º BPM">8º BPM</option>
                                <option value="20º BPM">20º BPM</option>
                                <option value="40º BPM">40º BPM</option>
                            </select>
                        </div>-->

                        <!-- Unidade região sul-->
                        <!--<div class="col-12 col-md-6 col-lg-3" id="inputBpmSul" style= "display:none;">
                            <label for="inputBpm" class="form-label">Unidade</label>
                            <select class="form-control" name="inputBpmSul">
                                <option selected disabled>Selecione a unidade</option>
                                <option value="1º BPM">1º BPM</option>
                                <option value="21º BPM">21º BPM</option>
                                <option value="42º BPM">42º BPM</option>
                            </select>
                        </div>-->

                                        <!-- Unidade região leste-->
                      <!--  <div class="col-12 col-md-6 col-lg-3" id="inputBpmLeste" style= "display:none;">
                            <label for="inputBpm" class="form-label">Unidade</label>
                            <select class="form-control" name="inputBpmLeste">
                                <option selected disabled>Selecione a unidade</option>
                                <option value="6º BPM">6º BPM</option>
                                <option value="13º BPM">13º BPM</option>
                                <option value="43º BPM">43º BPM</option>
                                <option value="22º BPM">22º BPM</option>
                            </select>
                        </div>-->

                        <!-- Unidade região Oeste-->
                        <!--<div class="col-12 col-md-6 col-lg-3" id="inputBpmOeste" style= "display:none;">
                            <label for="inputBpm" class="form-label">Unidade</label>
                            <select class="form-control" name="inputBpmOeste">
                                <option selected disabled>Selecione a unidade</option>
                                <option value="9º BPM">9º BPM</option>
                                <option value="38º BPM">38º BPM</option>
                            </select>
                        </div>-->
                    
                        <!-- Card para o Gráfico -->
                        <!--<div class="card shadow mb-4" style="display: none;" id="graficoCard">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary text-center">GRÁFICO ESTATÍSTICO</h6>
                            </div>
                            <div class="form-check d-flex justify-content-around flex-wrap py-2">
                                <div>
                                    <input class="form-check-input" type="radio" name="exampleRadios" value="7_dias" checked>
                                    <label class="form-check-label">7 Dias</label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="radio" name="exampleRadios" value="15_dias">
                                    <label class="form-check-label">15 Dias</label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="radio" name="exampleRadios" value="1_mes">
                                    <label class="form-check-label">1 Mês</label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="radio" name="exampleRadios" value="6_meses">
                                    <label class="form-check-label">6 Meses</label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="radio" name="exampleRadios" value="1_ano">
                                    <label class="form-check-label">1 Ano</label>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="cpamBarChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>-->
                    <!------------------------Por unidades---------------------->
                   <!-- <div class="tab-pane fade" id="porUnidade" role="tabpanel" aria-labelledby="porUnidade-tab">
                        UNIDADE
                            
                        <div class="card shadow mb-4" id="graficoCard">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary text-center">GRÁFICO ESTATÍSTICO</h6>
                            </div>
                            <div class="form-check d-flex justify-content-around flex-wrap py-2">
                                <div>
                                    <input class="form-check-input" type="radio" name="exampleRadios" value="7_dias" checked>
                                    <label class="form-check-label">7 Dias</label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="radio" name="exampleRadios" value="15_dias">
                                    <label class="form-check-label">15 Dias</label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="radio" name="exampleRadios" value="1_mes">
                                    <label class="form-check-label">1 Mês</label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="radio" name="exampleRadios" value="6_meses">
                                    <label class="form-check-label">6 Meses</label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="radio" name="exampleRadios" value="1_ano">
                                    <label class="form-check-label">1 Ano</label>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="cpamBarChart"></canvas>
                                </div>
                            </div>
                        </div>-->
                        <!--------------------por Grupo de crimes--------------->
                    <!--</div>
                    <div class="tab-pane fade" id="porGrupoCrime" role="tabpanel" aria-labelledby="porGrupoCrime-tab">
                        GRUPO
                        <div class="col-12 col-md-6 col-lg-6" id="grupoCrime">
                            <label for="tipoDeGrafico" class="form-label">Por Grupos de crimes</label>
                            <select class="form-control form-control-lg" >
                                <option selected disabled>Selecione o Grupos</option>
                                <option value="1">Crimes Violentos</option>
                                <option value="2">Crimes Comuns</option>
                                <option value="3">Cvli</option>
                            </select>
                        </div>
                    
                            <div class="card shadow mb-4" id="graficoCard" style="display:none;">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary text-center">GRÁFICO ESTATÍSTICO</h6>
                                </div>
                                <div class="form-check d-flex justify-content-around flex-wrap py-2">
                                    <div>
                                        <input class="form-check-input" type="radio" name="exampleRadios" value="7_dias" checked>
                                        <label class="form-check-label">7 Dias</label>
                                    </div>
                                    <div>
                                        <input class="form-check-input" type="radio" name="exampleRadios" value="15_dias">
                                        <label class="form-check-label">15 Dias</label>
                                    </div>
                                    <div>
                                        <input class="form-check-input" type="radio" name="exampleRadios" value="1_mes">
                                        <label class="form-check-label">1 Mês</label>
                                    </div>
                                    <div>
                                        <input class="form-check-input" type="radio" name="exampleRadios" value="6_meses">
                                        <label class="form-check-label">6 Meses</label>
                                    </div>
                                    <div>
                                        <input class="form-check-input" type="radio" name="exampleRadios" value="1_ano">
                                        <label class="form-check-label">1 Ano</label>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart-container">
                                        <canvas id="cpamBarChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>--->
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
                    <a class="btn btn-primary" href="index.html">Sair</a>
                </div>
            </div>
        </div>
    </div>

    <!---código js para dinâmizar as opções de historicos acima--->
    <script>
       
    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <!--<script src="../js/tipoGraficoEstatistica.js"></script>-->
    <!--<script src="../js/unidadeCpam.js"></script>-->
    <!--<script src="../js/graficosOcorrencia.js"></script>
    <script src="../js/graficoPorBpm.js"></script>-->
    <script src="../js/graficosPrincipais.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <!--<script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>
    <script src="../js/demo/chart-bar-demo.js"></script>-->

</body>

</html>