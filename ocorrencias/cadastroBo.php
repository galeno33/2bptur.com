
<?php
    /*****atualização dia 30/06/2024*****/
    require_once('../conexao/conexao_01.php');
    require_once('../usuario/restricaoUsuarios.php');
    session_start();

    $restringir = new RestricaoDeUsuario();
    $restringir->restricao();
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

    <title>Cadastro de Ocrrências</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c5282;
            --secondary-color: #edf2f7;
            --text-color: #2d3748;
            --success-color: #48bb78;
        }

        body {
            font-family: 'Roboto', sans-serif;
            color: var(--text-color);
            background-color: var(--secondary-color);
        }

        .sidebar {
            background: linear-gradient(180deg, var(--primary-color) 0%, #2a4365 100%);
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }

        .sidebar-brand-text {
            font-weight: 500;
            letter-spacing: 1px;
        }

        .nav-link {
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background-color: rgba(255,255,255,0.1);
        }

        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.2s ease;
        }

        .card:hover {
            transform: translateY(-2px);
        }

        .form-control {
            border-radius: 6px;
            border: 1px solid #e2e8f0;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(44, 82, 130, 0.1);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            border-radius: 6px;
            padding: 10px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #2a4365;
            transform: translateY(-1px);
        }

        .nav-tabs .nav-link {
            color: var(--text-color);
            padding: 12px 20px;
            border: none;
        }

        .nav-tabs .nav-link.active {
            color: var(--primary-color);
            border-bottom: 3px solid var(--primary-color);
            background-color: transparent;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../home.php">
                <div class="sidebar-brand-icon">
                    <img src="../img/2bptur.ico" alt="Logo" width="50" height="50">
                </div>
                <div class="sidebar-brand-text mx-3"><?php echo $bpm; ?></div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link" href="../home.php">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Início</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading text-light opacity-75">
                Interface
            </div>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo">
                    <i class="fas fa-fw fa-shield-alt"></i>
                    <span>Área Administrativa</span>
                </a>
                <div id="collapseTwo" class="collapse" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="ocorrencias.php">Ocorrências</a>
                        <a class="collapse-item" href="../usuario/verUsuarios.php">Usuários</a>
                    </div>
                </div>
            </li>
            <hr class="sidebar-divider d-none d-md-block">
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" data-toggle="dropdown">
                                <span class="mr-2 d-none d-lg-inline text-gray-600"><?php echo $nomeGuerra; ?></span>
                                <img class="img-profile rounded-circle" src="../img/undraw_profile.svg" width="30">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in">
                                <a class="dropdown-item" href="../perfil/perfil.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
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

                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800 font-weight-bold">Cadastrar Ocorrências</h1>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 bg-white">
                            <h6 class="m-0 font-weight-bold text-primary">Nova Ocorrência</h6>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-tabs" id="formTabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="matricula-tab" data-toggle="tab" href="#matricula" role="tab">Matrícula</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="ocorrencia-tab" data-toggle="tab" href="#ocorrencia" role="tab">Ocorrência</a>
                                </li>
                            </ul>

                            <form class="row g-3 mt-3" id="cadastroOcorrencia" action="intoOcorrencia.php" method="POST">
                                <div class="tab-content" id="formTabsContent">
                                    <!-- Aba Matrícula -->
                                    <div class="tab-pane fade show active" id="matricula" role="tabpanel">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label for="inputMiker" class="form-label">Miker/Número do BO</label>
                                                <input type="number" class="form-control" name="miker" id="inputMiker" placeholder="000000000" required>
                                            </div>
                                            <div class="col-md-6">
                                                <div id="matricula-container">
                                                    <div class="matricula-group mb-3" id="mtr1">
                                                        <label for="inputMatricula1" class="form-label">ID do CMD</label>
                                                        <input type="number" class="form-control" name="matricula[]" id="inputMatricula1" placeholder="Digite a Matrícula" required>
                                                    </div>
                                                    <div class="matricula-group mb-3" id="mtr2" style="display: none;">
                                                        <label for="inputMatricula2" class="form-label">ID do Motorista</label>
                                                        <input type="number" class="form-control" name="matricula[]" id="inputMatricula2" placeholder="Digite a Matrícula">
                                                    </div>
                                                    <div class="matricula-group mb-3" id="mtr3" style="display: none;">
                                                        <label for="inputMatricula3" class="form-label">ID do Patrulheiro</label>
                                                        <input type="number" class="form-control" name="matricula[]" id="inputMatricula3" placeholder="Digite a Matrícula">
                                                    </div>
                                                    <div class="matricula-group mb-3" id="mtr4" style="display: none;">
                                                        <label for="inputMatricula4" class="form-label">ID do Patrulheiro</label>
                                                        <input type="number" class="form-control" name="matricula[]" id="inputMatricula4" placeholder="Digite a Matrícula">
                                                    </div>
                                                    <div class="matricula-group mb-3" id="mtr5" style="display: none;">
                                                        <label for="inputMatricula5" class="form-label">ID do Patrulheiro</label>
                                                        <input type="number" class="form-control" name="matricula[]" id="inputMatricula5" placeholder="Digite a Matrícula">
                                                    </div>
                                                    <div class="matricula-group mb-3" id="mtr6" style="display: none;">
                                                        <label for="inputMatricula6" class="form-label">ID do Patrulheiro</label>
                                                        <input type="number" class="form-control" name="matricula[]" id="inputMatricula6" placeholder="Digite a Matrícula">
                                                    </div>
                                                </div>
                                                <div class="d-flex gap-2">
                                                    <button type="button" class="btn btn-outline-primary" onclick="adicionarMatricula()">+ Adicionar</button>
                                                    <button type="button" class="btn btn-outline-danger" onclick="removerMatricula()">- Remover</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Aba Ocorrência -->
                                    <div class="tab-pane fade" id="ocorrencia" role="tabpanel">
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label for="inputSigo" class="form-label">Sigo</label>
                                                <input type="text" class="form-control" name="sigo" id="inputSigo" placeholder="000000/2023">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="inputTipificacao" class="form-label">Tipificação de Crime</label>
                                                <select class="form-control" name="tipificacao" id="tipificar" required>
                                                    <option value="">Selecione a tipificação</option>
                                                    <option value="1">Furto</option>
                                                    <option value="2">Roubo</option>
                                                    <option value="3">Receptação</option>
                                                    <option value="4">Porte ilegal de arma de fogo</option>
                                                    <option value="5">Posse ilegal de arma de fogo</option>
                                                    <option value="6">Apreensão de entorpecentes</option>
                                                    <option value="7">Apreensão de arma de fogo</option>
                                                    <option value="8">Apreensão de simulacro</option>
                                                    <option value="9">Apreensão de veiculo</option>
                                                    <option value="10">Apreensão de kadron</option>
                                                    <option value="11">Veículo Recuperado</option>
                                                    <option value="12">Homicídio</option>
                                                    <option value="13">Feminicídio</option>
                                                    <option value="14">Latrocínio</option>
                                                    <option value="15">Infanticídio</option>
                                                    <option value="16">Sequestro relâmpago</option>
                                                    <option value="17">Sequestro com cárcere privado</option>
                                                    <option value="18">Lesão corporal por arma de fogo</option>
                                                    <option value="19">Lesão corporal por arma branca</option>
                                                    <option value="20">Lesão corporal por outros meios</option>
                                                    <option value="21">Cumprimento de mandado de prisão</option>
                                                    <option value="22">Trafico de entorpecentes</option>
                                                    <option value="23">Trafico humano</option>
                                                    <option value="24">Arrombamento residencial</option>
                                                    <option value="25">Arrombamento a estabelecimento</option>
                                                    <option value="26">Arrombamento de veiculo</option>
                                                    <option value="27">Violência sexual</option>
                                                    <option value="28">Achado de cadáver</option>
                                                    <option value="29">Tentativa de homicidio</option>
                                                    <option value="30">Tentativa de roubo</option>
                                                    <option value="31">Tentativa de sequestro</option>
                                                    <option value="32">Tentativa de furto</option>
                                                    <option value="33">Tentativa de estupro</option>
                                                    <option value="34">Violência domestica</option>
                                                </select>
                                            </div>
                                            <!---qualificação de furto-->
                                            <div class="col-md-4" id="tipoFurto" style="display: none;">
                                                <label for="inputfurto" class="form-label">Qualificação</label>
                                                <select class="form-control" name="furto">
                                                    <option value="">Qualificação de furto</option>
                                                    <option value="1">Pessoa</option>
                                                    <option value="2">Residência</option>
                                                    <option value="3">Estabelecimento</option>
                                                    <option value="4">Veiculo</option>
                                                    <option value="5">Objetos</option>
                                                </select>
                                            </div>
                                            <!---qualificação de roubo-->
                                            <div class="col-md-4" id="tipoRoubo" style="display: none;">
                                                <label for="inputRoubo" class="form-label">Qualificação</label>
                                                <select class="form-control" name="tipoRoubo">
                                                    <option value="">Qualificação de roubo</option>
                                                    <option value="1">Pessoa</option>
                                                    <option value="2">Residência</option>
                                                    <option value="3">Estabelecimento</option>
                                                    <option value="4">Veiculo</option>
                                                    <option value="5">Coletivo</option>
                                                </select>
                                            </div>
                                            <!---qualificação de receptação-->
                                            <div class="col-md-4" id="tipoReceptacao" style="display: none;">
                                                <label for="inputReceptacao" class="form-label">Qualificação</label>
                                                <select class="form-control" name="tipoReceptacao">
                                                    <option value="">Qualificação de receptação</option>
                                                    <option value="1">Produto roubado</option>
                                                    <option value="2">Produto furtado</option>
                                                </select>
                                            </div>
                                            <!---genero-->
                                            <div class="col-md-4" id="tipoGenero" style="display: none;">
                                                <label for="inputGenero" class="form-label">Tipo de genero</label>
                                                <select class="form-control" name="tipoGenero">
                                                    <option value="">Gereno</option>
                                                    <option value="1">masculino</option>
                                                    <option value="2">Feminino</option>
                                                </select>
                                            </div>
                                            <!-----faixa etaria----->
                                            <div class="col-md-4" id="tipoEtario" style="display: none;">
                                                <label for="inputEtario" class="form-label">Faixa etaria</label>
                                                <select class="form-control" name="tipoEtario">
                                                    <option value="">Faixa etaria</option>
                                                    <option value="1">Adulto</option>
                                                    <option value="2">Adolecente</option>
                                                    <option value="3">Criança</option>
                                                </select>
                                            </div>
                                            <!----------idade-------------->
                                            <div class="col-md-4" id="idade" style="display: none;">
                                                <label for="inputIdade" class="form-label">Idade</label>
                                                <input type="number" class="form-control" name="inputIdade">
                                            </div>
                                            <!---genero-->
                                            <div class="col-md-4" id="tipoArma" style="display: none;">
                                                <label for="inputArma" class="form-label">Tipo de arma</label>
                                                <select class="form-control" name="tipoArma">
                                                    <option value="">Arma</option>
                                                    <option value="1">Arma de fogo</option>
                                                    <option value="2">Arma branca</option>
                                                    <option value="3">Outros meios</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="inputData" class="form-label">Data da Ocorrência</label>
                                                <input type="date" class="form-control" name="inputdata" id="inputData" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="endereco" class="form-label">Endereço</label>
                                                <input type="text" class="form-control" name="endereco" id="endereco" placeholder="Rua do Matadouro-s/nº">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="bairro" class="form-label">Bairro</label>
                                                <input type="text" class="form-control" name="bairro" id="bairro" placeholder="Murici">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="cidade" class="form-label">Cidade</label>
                                                <input type="text" class="form-control" name="cidade" id="cidade" placeholder="Barreirinhas">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">Situação da Ocorrência</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="1" name="situacao" id="radio1" required>
                                                    <label class="form-check-label" for="radio1">Boletim Informativo</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="2" name="situacao" id="radio2">
                                                    <label class="form-check-label" for="radio2">Flagrante</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="3" name="situacao" id="radio3">
                                                    <label class="form-check-label" for="radio3">Termo Circunstancial</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-4">
                                    <button type="submit" name="salvar" class="btn btn-primary float-right">Salvar Ocorrência</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright © Fabio Galeno <?php echo date('Y'); ?></span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pronto para sair?</h5>
                    <button class="close" type="button" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">Selecione "Sair" para encerrar sua sessão.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="../index.html">Sair</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        let contador = 1;
        const totalCampos = 6;

        function adicionarMatricula() {
            if (contador < totalCampos) {
                contador++;
                document.getElementById(`mtr${contador}`).style.display = "block";
            }
        }

        function removerMatricula() {
            if (contador > 1) {
                document.getElementById(`inputMatricula${contador}`).value = "";
                document.getElementById(`mtr${contador}`).style.display = "none";
                contador--;
            }
        }

        // Validação do formulário
        document.getElementById('cadastroOcorrencia').addEventListener('submit', function(e) {
            let isValid = true;
            const requiredFields = this.querySelectorAll('[required]');
            
            requiredFields.forEach(field => {
                if (!field.value) {
                    isValid = false;
                    field.classList.add('border-danger');
                } else {
                    field.classList.remove('border-danger');
                }
            });

            if (!isValid) {
                e.preventDefault();
                alert('Por favor, preencha todos os campos obrigatórios.');
            }
        });
    </script>
    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    
    <script src="../js/tipificacao_campos.js"></script>
    
    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Page level plugins -->
    <!--<script src="../vendor/chart.js/Chart.min.js"></script>-->

    <!-- Page level custom scripts -->
    <!--<script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>
    <script src="../js/demo/chart-bar-demo.js"></script>-->

</body>
</html>
