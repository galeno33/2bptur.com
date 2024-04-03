<?php
    include('conexao/conexao.php');
    include('php/variaveis.php');
    //session_start();
        $usuario = $_SESSION['matricula'];
        $sqlRestricao = "SELECT id, nome_completo, classe_usuario, situacao FROM usuario WHERE id = $usuario";
        
        $resRestricao = mysqli_query($conn, $sqlRestricao);
        $rowRestricao = mysqli_fetch_assoc($resRestricao);
        $nomecompleto = $rowRestricao['nome_completo'];
        $situacao = $rowRestricao['situacao'];
        $classe = $rowRestricao['classe_usuario'];
         //var_dump($situacao);

        // Lista de todos os valores possíveis para tipificacao_crime
        $valoresPossiveis = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10"];

        // Construa a consulta SQL dinamicamente
        $sqlHome = "SELECT tipificacao_crime, COUNT(*) as quantidade FROM ranking WHERE tipificacao_crime
        IN ('" . implode("', '", $valoresPossiveis) . "') GROUP BY tipificacao_crime";

        // Execute a consulta SQL
        $result = mysqli_query($conn, $sqlHome);

        // Verifique se a consulta foi bem-sucedida
        if ($result) {
            // Inicialize um array para armazenar as quantidades por tipo
            $quantidadesPorTipo = [];

            // Itere sobre os resultados e armazene as quantidades em um array associativo
            while ($row = mysqli_fetch_assoc($result)) {
                $tipificacaoCrime = $row['tipificacao_crime'];
                $quantidade = $row['quantidade'];
                $quantidadesPorTipo[$tipificacaoCrime] = $quantidade;
            }

            // Exiba ou use as quantidades conforme necessário
            foreach ($valoresPossiveis as $valor) {
                $quantidade = isset($quantidadesPorTipo[$valor]) ? $quantidadesPorTipo[$valor] : 0;
                
                //echo "Tipificação: $valor, Quantidade: $quantidade <br>";
            }

            // Libere o resultado da consulta
            mysqli_free_result($result);
        } else {
            // Trate o caso em que a consulta falha
            echo "Erro na consulta: " . mysqli_error($conn);
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

    <title>BPTUR-POLICE</title>

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
            <li class="nav-item active">
                <a class="nav-link" href="home.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Inicio</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <?php
                 if($situacao == "HABILITADO"){
            ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <!--<i class="fas fa-fw fa-cog"></i>--> <!--icone de configuração-->
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Area do Administrativo</span>
                </a>
                <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Administrativo:</h6>
                        <a class="collapse-item" href="ocorrencias.php">Ocorrência</a>
                        <a class="collapse-item" href="usuario.php"> Usuarios</a>
                    </div>
                </div>
            </li>
            <?php
                }
            ?>
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
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Nav Item - Pages Collapse Menu -->
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
            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fa fa-sync"></i>
                    <span>Permultas</span>
                </a>
                <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Permuta:</h6>
                        <a class="collapse-item" href="minhaPermuta.php">Minha permutas</a>
                        <a class="collapse-item" href="pedirPermutas.php">Pedir permutas</a>
                        <!--<a class="collapse-item" href="#">Cadastrar Ranking's</a>-->
                    </div>
                </div>
            </li>
            <!--<li class="nav-item">
                <a class="nav-link" href="relatorioOcorrencias.php">
                    <i class="fas fa-filter"></i>
                    <span>Filtrar Ocorrências</span></a>
            </li>-->
            <!-- Divider -->
            <hr class="sidebar-divider">
            

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

             <!-- Nav Item - Ranking Geral -->
             <li class="nav-item">
                <a class="nav-link" href="ranking.php">
                    <i class="fas fa-trophy"></i>
                    <span>Ranking Geral</span></a>
            </li>
            <!-- Nav Item - Ranking Da Cia-->
            <li class="nav-item">
                <a class="nav-link" href="rankingCia.php">
                    <i class="fas fa-trophy"></i>
                    <span>Ranking da Cia</span></a>
            </li>

            <!-- Nav Item - Charts -->
            <!--<li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Estatisticas</span></a>
            </li>-->

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        
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
                                <a class="dropdown-item" href="usuario/updatePerfil.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <!--<a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    
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

                    
                        
                    <!-- Content Row -->
                    <div class="row">
                        <?php
                            //adicionar a condicional par afiltrar o acesso para oficiais e praças
                            if($classe == "OFICIAL" || $classe == "oficial"){
                        ?>

                        <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                        Arma de fogo</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php
                                                            if($tipificacaoCrime = 4){
                                                                echo $quantidadesPorTipo[$tipificacaoCrime];
                                                                }
                                                        ?>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Roubo
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                     if($tipificacaoCrime = 2){
                                                           echo $quantidadesPorTipo[$tipificacaoCrime];
                                                        }
                                                ?>
                                            </div>
                                        </div>
                                        <!--<div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>-->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Furto
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                        <?php
                                                            if($tipificacaoCrime = 1){
                                                                echo $quantidadesPorTipo[$tipificacaoCrime];
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                                <!--<div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>-->
                                            </div>
                                        </div>
                                        <!--<div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>-->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                       <!--<div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                ENTORPECENTES</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">005</div>
                                        </div>-->
                                        <!--<div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>-->
                                   <!-- </div>
                                </div>
                            </div>
                        </div>-->
                        <?php
                            }
                        ?>
                    </div>

                  
                    <!-- Content Row -->
                    <div class="row">
                            
                            
                        <!-- Content Column -->
                        <!--<div class="col-lg-6 mb-4">-->

                            <!-- Project Card Example -->
                           <!-- <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Projeção</h6>
                                </div>
                                <div class="card-body">
                                    <h4 class="small font-weight-bold">Roubo <span
                                            class="float-right">0%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 20%"
                                            aria-valuenow="5" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Furto <span
                                            class="float-right">0%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 40%"
                                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Maria da penha <span
                                            class="float-right">0%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar" role="progressbar" style="width: 60%"
                                            aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Acidente <span
                                            class="float-right">0%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 80%"
                                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    
                                </div>
                            </div>

                        </div>-->

                        <div class="col-lg-9 mb-4">

                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Permutas disponiveis</h6>
                                </div>
                                <div class="card-body">
                                <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name de Guerra</th>
                                            <th>data do serviço</th>
                                            <th>Situação</th>
                                            <th>Companhia</th>
                                            <th>Confirmação</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name de Guerra</th>
                                            <th>data do serviço</th>
                                            <th>Situação</th>
                                            <th>Companhia</th>
                                            <th>Confirmação</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php

                                            //=================================================================================================================================================================================================================================================
                                            //implementar o relacionamentos entre as tabelas usuario e agenda_permuta
                                            $sqlResultadoPermuta = "SELECT usuario.nome_completo, usuario.nome_de_guerra, usuario.cia, agenda_permuta.id_agenda, agenda_permuta.matr_permutante, agenda_permuta.dia_agenda, agenda_permuta.aceito_permuta
                                                                    FROM agenda_permuta 
                                                                    JOIN usuario 
                                                                    ON agenda_permuta.matr_permutante = usuario.id";

                                            $resultado = mysqli_query($conn, $sqlResultadoPermuta) or die ("Erro oa tentar ver as permutas");
                                            while($rowPermuta = mysqli_fetch_assoc($resultado)){
                                                $idPermuta = $rowPermuta['id_agenda'];
                                                $matrPermutante = $rowPermuta['matr_permutante'];
                                                $nomeCompleto = $rowPermuta['nome_completo'];
                                                $guerra = $rowPermuta['nome_de_guerra'];
                                                $cia = $rowPermuta['cia'];
                                                $dataPermuta = $rowPermuta['dia_agenda'];
                                                $confirmAgenda = $rowPermuta['aceito_permuta'];
                                                //formatação da data vindo do banco de dados para o formato convencionado no brasil
                                                $timestamp = strtotime($dataPermuta);
                                                $dataformatada = date('d-m-Y', $timestamp);
                                                //$_SESSION['nomedeguerra'] = $guerra;
                                                if($confirmAgenda == "Não" || $confirmAgenda == "não"){
                                                    echo "<tr>";
                                                    echo "<td>".$guerra."</td>";
                                                    echo "<td>".$dataformatada."</td>";
                                                    echo "<td>".$confirmAgenda."</td>";
                                                    echo "<td>".$cia."ª</td>";
                                                   
                                                    
                                                   // echo "<a href='home.php?aceite=".$idPermuta."' type='button' class='btn btn-success btn-block' data-toggle='modal' data-target='#myModal'>Aceitar</a>";
                                        ?>
                                            <th>
                                                <a href="atualizarPermuta.php?aceite=<?php echo $idPermuta;?>" class="btn btn-primary ">Aceitar</a>
                                            </th>
                                        <?php 
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
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
        
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">Confirme seu interesse na permuta.</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                
                </div>
                <div class="modal-body">
                    
                <!--<p>Clique em <strong> CONFIRMAR </strong> para aceitar a permuta, e fique atento(a) para a devida autorização do oficial responsavel.</p>-->
                <form class="row g-6" id="formConsulta" action="permuta/atualizacaoPermuta.php" method="POST" enctype="multipart/form-data">
                        
                    <div class="col-sm-6">
                        <label for="inputMatricula" class="control-label">Seu nome</label>
                        <input type="text" class="form-control" name="nomeCompleto" id="inputGuerra" value="<?php echo $nomecompleto;?>">
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
                        <input type="number" class="form-control" name="matrPermutante" id="inputGuerra" value="<?php echo $matrPermutante;?>">
                    </div>
                    <div class="col-md-6" ><!--style="display :none;"-->
                        <label for="inputSituacao" class="form-label">Você aceita a permuta?</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="1" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Sim
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="0" name="flexRadioDefault" id="flexRadioDefault2" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Não
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <!--<span id="msgAlerta1"></span>--->
                        <label for="dataFinal" class="form-label">Data da permuta</label>
                        <input type="text" class="form-control" name="nomeCompleto" id="inputGuerra" value="<?php echo $dataPermuta;?>">
                        <!--<input type="date" class="form-control" name="dataPermuta" id="dataFinal">-->
                    </div>
                    
                    <div class="modal-footer">
                        <input type="submit" name="confirmar" class="btn btn-primary" value="CONFIRMAR">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
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

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>