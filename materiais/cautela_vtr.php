<?php
    /*****Desenvolvido por Fabio Galeno*****/
    /*****atualizado dia 10/11/2024*****/
    /*****codigo auterado linha 345, 427, 452 à 455 *****/
    /*****codigo implementado dia 26/11/2024 linha 304 e 306*****/
    
    require_once('../conexao/conexao_01.php');
    require_once('../php/variaveis.php');
    require_once('../usuario/restricaoUsuarios.php');

    $conexao = new Conexao();
    $conn = $conexao->getConexao();

    $restringir = new RestricaoDeUsuario();
    $restringir->restricao();
    $nomeGuerra = $restringir->getNomeGuerra();
    $bpm = $restringir->getBpm();
    $funcao = $restringir->getFuncao();
    $situacao = $restringir->getSituacao();
    //session_start();

    // Consulta para buscar os id_prefixo da tabela viatura
    $sql = "SELECT * FROM viatura";
    $result = mysqli_query($conn, $sql);


        // Geração do token
        /*function gerarToken() {
            return bin2hex(random_bytes(8)); // Token alfanumérico de 16 caracteres
        }
        
        if (isset($_POST['gerar'])) {
            // Coleta os dados do formulário
            $idMotorista = $_POST['seuId'];
        
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
            if ($stmt->affected_rows > 0) {
                echo "<script>alert('Chave gerada com sucesso!');</script>";
            } else {
                echo "<script>alert('Erro, na geração da chave!');</script>";
            }
        
            // Fecha a conexão
            $stmt->close();
            $conn->close();
        }
        */


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
                    <i><img src="../img/2bptur.ico" alt="" width="50" height="50" srcset=""></i>
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

            <!-- Conditional Materials Section -->
            <?php if ($funcao == "Armeiro" || $funcao == "Gerente") { ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
                        aria-expanded="true" aria-controls="collapseOne">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>P4</span>
                    </a>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingFive" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">P4:</h6>
                            <a class="collapse-item" href="cautelarMaterial.php">Cautelar Material</a>
                            <a class="collapse-item" href="../P4/materiais_cautelados.php">Materiais Cautelados</a>
                            <a class="collapse-item" href="historico_de_cautela.php">Histórico das Cautelas</a>
                        </div>
                    </div>
                </li>
            <?php } ?>

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

                    <!-- Sidebar Toggle (Topbar) butão hamburguer quando está responsivo para mobile -->
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
                        

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $nomeGuerra; ?></span>
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
                    <h1 class="h3 mb-4 text-gray-800">Cautela de viatura</h1>

                    <div class="row">

                        <div class="col-lg-6">
                            <!-- Brand Buttons -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Cautela de viatura</h6>
                                </div>
                                <div class="card-body">
                                    <form class="row g-6" id="formConsulta" action="cautela_vtr_confirmar02.php" method="POST" enctype="multipart/form-data">
                                        <div class="col-sm-4">
                                            <label for="inputMatricula" class="control-label">Viatura:</label>
                                            <!--<input type="Number" class="form-control" name="suaMatricula" id="inputAddress" placeholder="Viatura">-->
                                                <?php
                                            
                                                    if ($result && mysqli_num_rows($result) > 0) {
                                                        // Variável para controlar o número do input radio
                                                        $radioIndex = 1;

                                                        // Percorre cada registro da consulta
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            $viatura = $row['id_prefixo']; // Recebe o valor do id_prefixo
                                                            $situação = $row['situacao'];
                                                            if($situação == "Ativo"){
                                                                // Exibe o código HTML para cada radio button
                                                                echo '
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios'.$radioIndex.'" value="'.$viatura.'" '.($radioIndex === 1 ? 'checked' : '').'>
                                                                    <label class="form-check-label" for="exampleRadios'.$radioIndex.'">
                                                                        '.$viatura.'
                                                                    </label>
                                                                </div>';

                                                                // Incrementa o índice para os IDs dos radio buttons
                                                                $radioIndex++;
                                                            }
                                                        }
                                                    } else {
                                                        echo 'Nenhum prefixo encontrado na tabela de viaturas.';
                                                    }
                                                    // Fechar conexão
                                                    //mysqli_close($conn);

                                                    // biblioteca de definição de fuso horário para Brasília
                                                    date_default_timezone_set('America/Sao_Paulo');
                                                    // Obter a data atual através do date() da biblioteca implementada
                                                    $dataCautela = date('Y-m-d'); // Formato: Ano-Mês-Dia (YYYY-MM-DD)
                                                ?>   
                                        </div>
                                        <hr class="sidebar-divider">
                                        <div class="content -row">
                                            <div class="col-md-auto">
                                                <label for="inputId" class="form-label">ID do motorista:</label>    
                                                <input type="Number" class="form-control" name="seuId" id="IdMotorista">
                                            </div>
                                            <div class="col-md-auto" style="display: none;" id="companhia">
                                                <label for="inputCia" class="form-label">Companhia</label>
                                                <select class="form-control"  name="inputCia" id="inputCia" aria-label="Default select example">
                                                    <option selected disabled>Cia</option>
                                                    <option value="1">1ª</option>
                                                    <option value="2">2ª</option>
                                                    <option value="3">3ª</option>
                                                    <option value="4">4ª</option>
                                                </select>
                                            </div>
                                            <div class="col-md-auto" style="display: none;" id="areaAtualiza">
                                                <!--<span id="msgAlerta1"></span>--->
                                                <label for="areaAtuacao" class="form-label">Area de atuação:</label>
                                                <input type="text" class="form-control" name="areaAtuacao" id="areaAtuacao">
                                            </div>
                                            <div class="col-md-auto" style="display: none;" id="dataCautela">
                                                <!--<span id="msgAlerta1"></span>--->
                                                <label for="dataCautela" class="form-label">Data da cautela:</label>
                                                <input type="date" class="form-control" name="dataCautela" id="dataCautela" value="<?php echo $dataCautela; ?>" readonly>
                                            </div>
                                            
                                            
                                        </div>
                                        <div class="col-sm-12">
                                            
                                        
                                            <!--<input  id="gerarChave" type="submit" name="gerar" class="btn btn-primary btn-block" value="Cautelar viatura">-->
                                            <!-- Divider --> 
                                            <input  id="inserirChave" type="submit" name="salvar" class="btn btn-primary btn-block" value="Gerar Cautela">
                                            <hr class="sidebar-divider">
                                        </div>
                                        
                                    </form>
                                    <!--<form action="#" method="POST" enctype="multipart/form-data">
                                        <input  id="gerarChave" type="submit" name="gerar" class="btn btn-primary btn-block" value="Gerar chave">-->
                                        <!--<button id="abrirModal" class="btn btn-success btn-block"  data-toggle="modal" data-target="#myModal">Gerar Chave</button>
                                    </form>-->
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

   <!-- Modal -->
   <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mx-auto" id="myModalLabel">Chave de Confirmação</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <form class="row justify-content-center" id="formModal" action="#" method="POST">
                        <div class="col-sm-6">
                            <label for="modalMotorista" class="control-label">Matricula:</label>
                            <input type="number" class="form-control" name="seuId" id="modalMotorista" readonly>
                        </div>
                        <div class="modal-footer d-flex justify-content-center w-100">
                            <input type="submit" name="gerar" id="gerarChave" class="btn btn-primary" value="Gerar chave">
                            <button type="button" class="btn btn-danger ml-2" data-dismiss="modal">Fechar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript para transferir os dados -->
    <script>
        /*document.querySelector('button[data-target="#myModal"]').addEventListener('click', function() {
            // Obter valores dos campos do formulário principal
            
            var motorista = document.getElementById('IdMotorista').value;
            document.getElementById('modalMotorista').value = motorista;
        });*/

        //função para exibir butão de gerar chave
        document.getElementById('gerarChave').addEventListener('click', function(event){
            //event.preventDefault();
            document.getElementById('abrirModal').style.display = 'none';
            document.getElementById('inserirChave').style.display = 'inline-block';

        });
        document.querySelector('#abrirModal').addEventListener('click', function () {
            // Obter o valor do ID do motorista
            var motorista = document.getElementById('IdMotorista').value;

            // Preencher o campo da modal
            document.getElementById('modalMotorista').value = motorista;
        });

        // Opcional: Adicionar evento para envio do formulário (caso necessário)
        document.querySelector('#formModal').addEventListener('submit', function (e) {
            // Evitar recarregar a página
            e.preventDefault();

            // Enviar o formulário manualmente
            this.submit();
        });


       
    </script>

    
    <script src="../js/visualizar_campo_cautelaVtr.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!--<script src="../js/botao_visivel.js"></script>-->
    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

</body>

</html>