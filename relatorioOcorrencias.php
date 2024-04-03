<?php
    include('conexao/conexao.php');
    session_start();
    $usuario = $_SESSION['matricula'];
    $sqlRestricao = "SELECT id, situacao FROM usuario WHERE id = $usuario";
    
    $resRestricao = mysqli_query($conn, $sqlRestricao);
    $rowRestricao = mysqli_fetch_assoc($resRestricao);
    $situacao = $rowRestricao['situacao'];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Quantitativo de ocorrências</title>

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
                        <a class="collapse-item" href="ocorrencias.php">
                            <?php
                                if($situacao == "HABILITADO"){
                                    $ocorrencia = "Ocorrência";
                                    echo $ocorrencia;
                                }
                            ?>
                        </a>
                        <a class="collapse-item" href="usuario.php">
                            <?php 
                                if($situacao == "HABILITADO"){
                                    $verUsuario = "Usuarios";
                                    echo $verUsuario;
                                }
                            ?>
                        </a>
                        <a class="collapse-item" href="https://forms.gle/K8YfA3b4KX1GyZb9A">Relatorio de disparos</a>
                        <a class="collapse-item" href="https://forms.gle/fyZNtGv944nVugyx5">Boletim de ocorrêcnia</a>
                        <a class="collapse-item" href="https://forms.gle/veP7Vn8PN9kn3GiMA">Livro do CPU</a>
                        <a class="collapse-item" href="https://forms.gle/VMEXp9aiMwnipWu2A">Cmd de guarnição</a>
                        <a class="collapse-item" href="https://docs.google.com/forms/d/e/1FAIpQLScR13pjdKiim6uX4gtNVvCJB6Ql4Qe4pU8JFCLE4DjhAOXuwA/viewform?vc=0&c=0&w=1&flr=0">Check list</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="relatorioOcorrencias.php">
                    <i class="fas fa-filter"></i>
                    <span>Filtrar Ocorrências</span></a>
            </li>
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
                                <a class="dropdown-item" href="pagConstrucao.html">
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
                    <h1 class="h3 mb-2 text-gray-800">Pesquisa de periodo de ocorrências</h1>
                   
                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-11 col-lg-12">

                        <div class="card text-center">
                        
                            <div class="card-body">
                                <h5 class="card-title">Ocorrências por periodo</h5>
                    
                                <form class="row g-6" id="formConsulta" method="POST" enctype="multipart/form-data">
                                    <div class="col-sm-6">
                                        <label for="dataInicial" class="form-label">Inicial</label>
                                        <input type="date" class="form-control" name="data_inicio" id="dataInicial">
                                    </div>
                                    <div class="col-sm-6">
                                        <!--<span id="msgAlerta1"></span>--->
                                        <label for="dataFinal" class="form-label">Final</label>
                                        <input type="date" class="form-control" name="data_fim" id="dataFinal">
                                                            
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <input type="submit" name="salvar" class="btn btn-primary" value="Pesquisar">
                                    </div>
                                </form>
                                    <br>

                                    <div id="resultadoConsulta">
                                        <!-- Os resultados da consulta serão exibidos aqui -->
                                    </div>

                                    <script>
                                        // Função para enviar os dados do formulário para o arquivo PHP e exibir os resultados
                                        document.getElementById("formConsulta").addEventListener("submit", function(event) {
                                            event.preventDefault(); // Impede o envio padrão do formulário

                                            var formData = new FormData(this); // Obtém os dados do formulário

                                            fetch("ocorrencias/filtroOcorrencias.php", { // Envia uma requisição para o arquivo PHP
                                                method: "POST",
                                                body: formData
                                            })
                                            .then(response => response.json()) // Converte a resposta para JSON
                                            .then(data => {
                                                // Processa os resultados e os exibe como cards
                                                var resultadoConsulta = document.getElementById("resultadoConsulta");
                                                resultadoConsulta.innerHTML = ""; // Limpa o conteúdo anterior

                                                data.forEach(function(item) {
                                                    
                                                    // Cria um card para cada resultado
                                                    var card = document.createElement("div");
                                                    card.classList.add("card");
                                                    card.innerHTML = `
                                                        <div class="card-body">
                                                            <h5 class="card-title">${item.tipificacao_crime}</h5>
                                                            <h2 class="card-text">${item.total}</h2>
                                                        </div>
                                                    `;
                                                    resultadoConsulta.appendChild(card); // Adiciona o card à div de resultados
                                                });
                                            })
                                            .catch(error => {
                                                console.error("Erro ao enviar requisição:", error);
                                            });
                                        });
                                    </script>
                                

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
    <script src="js/campo.js"></script>
    
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
  

        

</body>

</html>