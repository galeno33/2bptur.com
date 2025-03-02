<?php
    /*****Desenvolvido por Fabio Galeno******/
    require_once('../conexao/conexao_01.php');
    require_once('../usuario/restricaoUsuarios.php');
    require_once('../materiais/select_viatura.php');
    require_once('../materiais/selectCautelados.php');
   
    //conecta a classe de conexao com o banco de dados
    $conexao = new Conexao();
    $conn = $conexao->getConexao();

    //instacia dados vindos de select_viatura.php
    $listarViatura = new Viatura();
    $listViaturas = $listarViatura->selecionarViatura();

    //instacia dados vindo de cautelas
    $listaMateriais = new Cautelados();
    $listarMateriais = $listaMateriais->selectCautelados();
    /*$listaMateriais = new Historicos();
    $listarMateriais = $listaMateriais->selectHistorico();*/

    //instancia de usuarios e seus dados
    $restringir = new RestricaoDeUsuario();
    $restringir->restricao();
    $guerra = $restringir->getNomeGuerra();
    $cia = $restringir->getCiaRestrito();
    $bpm = $restringir->getBpm();
    $funcao = $restringir->getFuncao();
    $situacao = $restringir->getSituacao();
    $tokenConfirme = $restringir->getChave();


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Tables</title>

    <!-- Custom fonts for this template -->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/permutas.css">

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
            <li class="nav-item active">
                <a class="nav-link" href="../home.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Inicio</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <?php if($funcao == "Cmd do P4" || $situacao == "HABILITADO"){ ?>
                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                        aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>P4</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">P4:</h6>
                            <a class="collapse-item" href="../materiais/cautelarMaterial.php">Cautelar Material</a>
                            <a class="collapse-item" href="../materiais/cautela_vtr.php">Cautelar Viatura</a>
                            <a class="collapse-item" href="cargas_da_unidade.php">Cargas da unidade</a>
                            <a class="collapse-item" href="../materiais/historico_de_cautela.php">Historico das Cautelas</a>
                        </div>
                    </div>
                </li>
            <?php } ?>
            <!-- Nav Item - Utilities Collapse Menu -->
            <!--<li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="utilities-color.html">Colors</a>
                        <a class="collapse-item" href="utilities-border.html">Borders</a>
                        <a class="collapse-item" href="utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a>
                    </div>
                </div>
            </li>-->


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
            <!--<li class="nav-item active">
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
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>

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
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
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
                        </li>

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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $guerra; ?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Materias</h1>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="viatura" checked>
                        <label class="form-check-label" for="exampleRadios1">
                            Viaturas cauteladas
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="material_belico">
                        <label class="form-check-label" for="exampleRadios2">
                            Materiais cautelados
                        </label>
                    </div>
                    <!--<div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="materiais">
                        <label class="form-check-label" for="exampleRadios3">
                            Materiais Cautelados
                        </label>
                    </div>-->
                    <br>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Listas de cautelas</h6>
                        </div>
                        <div id="viaturaSection" class="section-content">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Ordem</th>
                                                <th>Cautelante</th>
                                                <th>Pré-fixo</th>
                                                <th>Placa</th>
                                                <th>Descautelar</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Ordem</th>
                                                <th>Cautelante</th>
                                                <th>Pré-fixo</th>
                                                <th>Placa</th>
                                                <th>Descautelar</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                                $i = 0;
                                                foreach($listViaturas as $listar){
                                                    $id = $listar->getIdViatura();
                                                    $nome = $listar->getNomeGuerra();
                                                    $prefixo = $listar->getPrefixos();
                                                    $placa = $listar->getPlaca();
                                                    $dataEntrega = $listar->getEntrega();
                                                    
                                                    if($dataEntrega == null){
                                                       $i++; 
                                                        echo "<tr>";
                                                        echo "<td>".$i."</td>";
                                                        echo "<td>".$nome."</td>";
                                                        echo "<td>".$prefixo."</td>";
                                                        echo "<td>".$placa."</td>";
                                                        echo "<th><a href='../materiais/descautela_viatura.php?detalhes=".$id."' name='gerar' class='btn btn-primary'>Descautelar</a></th>";
                                                        echo "</tr>";
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Seção para Material Bélico -->
                        <div id="materialBelicoSection" class="section-content">
                        <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Ordem</th>
                                                <th>Cautelante</th>
                                                <th>Material</th>
                                                <th>Dia da cautela</th>
                                                <th>Descautelar</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Ordem</th>
                                                <th>Cautelante</th>
                                                <th>Material</th>
                                                <th>Dia da cautela</th>
                                                <th>Descautelar</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                                $i = 0;
                                                //var_dump($listarMateriais);
                                                foreach($listarMateriais as $listando){
                                                    $id = $listando->getIdCautela();
                                                    $material = $listando->getMaterial();
                                                    $tipoMaterial = $listando->getTipoMaterial();
                                                    $serie = $listando->getSeries();
                                                    $tamanhoCalibre = $listando->getTamanhoCalibre();
                                                    $dataCautela = $listando->getDiaCautela();
                                                    $posto = $listando->getPostoCautelante();
                                                    $cautelante = $listando->getCautelante();
                                                    $dataEntrega = $listando->getDiaEntrega();
                                                    //formatação da data vindo do banco de dados para o formato convencionado no brasil
                                                    $timestamp = strtotime($dataCautela);
                                                    $diaformatada = date('d-m-Y', $timestamp);
                                                    
                                                    if($dataEntrega == null){
                                                       $i++; 
                                                        echo "<tr>";
                                                        echo "<td>".$i."</td>";
                                                        echo "<td>".$cautelante."</td>";
                                                        echo "<td>".$material."</td>";
                                                        echo "<td>".$diaformatada."</td>";
                                                        echo "<th><a href='../materiais/descautelar_material.php?detalhes=".$id."' class='btn btn-primary'>Detalhes</a></th>";
                                                        echo "</tr>";
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Seção para Materiais -->
                        <div id="materiaisSection" class="section-content">
                            <h3>Materiais</h3>
                            <p>Aqui você verá informações sobre os materiais registrados no banco de dados.</p>
                            <!-- Adicione a lógica para carregar os dados dos Materiais -->
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
                    <a class="btn btn-primary" href="../index.html">Sair</a>
                </div>
            </div>
        </div>
    </div>
           
    <script>
        // Função para exibir a seção correta com base no radio button selecionado
        function showSection() {
            // Obter o valor do radio button selecionado
            var selectedValue = document.querySelector('input[name="exampleRadios"]:checked').value;

            // Ocultar todas as seções
            document.getElementById('viaturaSection').style.display = 'none';
            document.getElementById('materialBelicoSection').style.display = 'none';
            document.getElementById('materiaisSection').style.display = 'none';

            // Exibir a seção correspondente à seleção
            if (selectedValue === 'viatura') {
                document.getElementById('viaturaSection').style.display = 'block';
            } else if (selectedValue === 'material_belico') {
                document.getElementById('materialBelicoSection').style.display = 'block';
            } else if (selectedValue === 'materiais') {
                document.getElementById('materiaisSection').style.display = 'block';
            }
        }

        // Adicionar evento de clique aos radio buttons para chamar a função showSection
        document.querySelectorAll('input[name="exampleRadios"]').forEach(function(radio) {
            radio.addEventListener('change', showSection);
        });

        // Exibir a seção correspondente ao valor inicial selecionado
        showSection();

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