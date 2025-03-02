<?php
    require_once('../conexao/conexao_01.php');
    require_once('../usuario/restricaoUsuarios.php');

    $conexao = new Conexao();
    $conn = $conexao->getConexao();

    $restringir = new RestricaoDeUsuario();
    $restringir->restricao();
    $tokenConfirm = $restringir->getChave();
    $nomeGuerra = $restringir->getNomeGuerra();
    $bpm = $restringir->getBpm();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Cautela de Materiais - 2º BPTUR">
    <meta name="author" content="Fabio Galeno">
    <title>Cautela de Materiais</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Bootstrap e Estilos Customizados -->
    <!--<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">--->
    <link rel="stylesheet" href="../css/permutas.css">

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">


    <style>
        :root {
            --primary-color: #2c5282; /* Azul corporativo */
            --secondary-color: #edf2f7; /* Fundo claro */
            --text-color: #2d3748; /* Texto escuro */
            --success-color: #48bb78; /* Verde sucesso */
            --danger-color: #dc3545; /* Vermelho erro */
            --info-color: #17a2b8; /* Azul claro */
            --warning-color: #ffc107; /* Amarelo alerta */
        }

        body {
            font-family: 'Roboto', sans-serif;
            color: var(--text-color);
            background-color: var(--secondary-color);
            overflow-x: hidden;
        }

        .sidebar {
            background: linear-gradient(180deg, var(--primary-color) 0%, #2a4365 100%);
            box-shadow: 2px 0 15px rgba(0,0,0,0.15);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            z-index: 1030;
        }

        .sidebar-brand-text {
            font-weight: 500;
            letter-spacing: 1px;
            color: #ffffff;
        }

        .nav-link {
            color: rgba(255,255,255,0.8);
            transition: all 0.3s ease;
            padding: 12px 15px;
        }

        .nav-link:hover, .nav-link.active {
            background-color: rgba(255,255,255,0.15);
            color: #ffffff;
        }

        #content-wrapper {
            margin-left: 250px;
            min-height: 100vh;
            padding: 20px;
            background-color: #ffffff;
            transition: margin-left 0.3s ease;
        }

        .topbar {
            background: var(--primary-color);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.15);
        }

        .card-header {
            background-color: #ffffff;
            border-bottom: 1px solid #e2e8f0;
        }

        .form-control {
            border-radius: 6px;
            border: 1px solid #e2e8f0;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(44, 82, 130, 0.2);
        }

        .btn-primary, .btn-success {
            border-radius: 6px;
            padding: 8px 16px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #2a4365;
            transform: translateY(-1px);
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .btn-success:hover {
            background-color: #388e3c;
            transform: translateY(-1px);
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            border-radius: 8px;
        }

        .dropdown-item {
            padding: 10px 15px;
            transition: background-color 0.3s ease;
        }

        .dropdown-item:hover {
            background-color: var(--secondary-color);
        }

        .sticky-footer {
            background: var(--primary-color);
            color: #ffffff;
            padding: 15px 0;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
        }

        .modal-content {
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .token-notification {
            position: relative;
        }

        .token-notification .badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: var(--danger-color);
        }

        .invalid-feedback {
            display: none;
            color: var(--danger-color);
            font-size: 0.875rem;
        }

        .form-control:invalid + .invalid-feedback {
            display: block;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            #content-wrapper {
                margin-left: 0;
                padding: 10px;
            }

            .card {
                max-width: 100%;
            }

            .topbar .navbar-nav {
                margin-left: auto;
            }
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <nav class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center py-3" href="../home.php">
                <div class="sidebar-brand-icon">
                    <img src="../img/2bptur.ico" alt="Logo 2º BPTUR" width="50" height="50">
                </div>
                <div class="sidebar-brand-text mx-3"><?php echo htmlspecialchars($bpm); ?></div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link" href="../home.php">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Início</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMaterials" aria-expanded="false" aria-controls="collapseMaterials">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Materiais</span>
                </a>
                <div id="collapseMaterials" class="collapse" aria-labelledby="headingMaterials" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Materiais:</h6>
                        <a class="collapse-item" href="materiais_cautelados.php">Materiais Cautelados</a>
                        <a class="collapse-item" href="historico_de_cautela.php">Histórico de Cautela</a>
                    </div>
                </div>
            </li>
            <div class="sidebar-heading text-light opacity-75">Interface</div>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSessions" aria-expanded="false" aria-controls="collapseSessions">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Sessões</span>
                </a>
                <div id="collapseSessions" class="collapse" aria-labelledby="headingSessions" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Sessões:</h6>
                    </div>
                </div>
            </li>
            <hr class="sidebar-divider d-none d-md-block">
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </nav>

        <!-- Main Content -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light topbar bg-gradient-primary mb-4 shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars text-white"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow mx-1 token-notification">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="far fa-hand-point-right"></i>
                                <span class="badge badge-danger badge-counter"><?php echo $tokenConfirm ? '!' : ''; ?></span>
                            </a>
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">Centro de Mensagens</h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">
                                            <strong>Chave:</strong> <span id="token-value"><?php echo htmlspecialchars($tokenConfirm ?: 'Nenhuma chave gerada'); ?></span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-white small"><strong><?php echo htmlspecialchars($nomeGuerra); ?></strong></span>
                                <img class="img-profile rounded-circle" src="../img/undraw_profile.svg" alt="Perfil" width="30" height="30">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
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
                    <h1 class="h3 mb-4 text-gray-800 font-weight-bold">Cautela de Materiais</h1>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Cautela de Materiais <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#generateTokenModal">Gerar Chave</button></h6>
                        </div>
                        <div class="card-body">
                            <form class="row g-3" id="cadastroOcorrencia" action="inserir_db_material.php" method="POST" novalidate>
                                <div class="col-md-2">
                                    <label for="inputDataCautela" class="form-label">Data da Cautela</label>
                                    <input type="date" class="form-control" name="diaCautela" id="inputDataCautela">
                                    <div class="invalid-feedback">Por favor, selecione a data da cautela.</div>
                                </div>
                                <div class="col-md-2">
                                    <label for="inputQuantidade" class="form-label">Quantidade</label>
                                    <input type="number" class="form-control" name="quantidade" id="inputQuantidade" placeholder="Quantidade">
                                    <div class="invalid-feedback">Por favor, informe a quantidade.</div>
                                </div>
                                <div class="col-md-3">
                                    <label for="materialSelect" class="form-label">Material</label>
                                    <select class="form-control" id="materialSelect" name="material">
                                        <option value="">Selecione o material</option>
                                        <option value="1">Armamento</option>
                                        <option value="2">Colete Balístico</option>
                                        <option value="3">Munição</option>
                                        <option value="4">Tonfa</option>
                                        <option value="5">Espargidor</option>
                                        <option value="6">Carregador</option>
                                        <option value="7">Colete Reflexivo</option>
                                        <option value="8">Escudo Balístico</option>
                                        <option value="9">Escudo Nível III</option>
                                        <option value="10">Capacete Anti-Tumulto</option>
                                    </select>
                                    <div class="invalid-feedback">Por favor, selecione um material.</div>
                                </div>
                                <div class="col-md-3" id="tipoArmamentoDiv" style="display: none;">
                                    <label for="tipoArmamento" class="form-label">Tipo de Armamento</label>
                                    <select class="form-control" name="tipoArmamento">
                                        <option value="">Selecione o tipo</option>
                                        <option value="1">Pistola</option>
                                        <option value="2">Revolver</option>
                <option value="3">Fuzil</option>
                <option value="4">Carabina</option>
                                    </select>
                                    <div class="invalid-feedback">Por favor, selecione o tipo de armamento.</div>
                                </div>
                                <div class="col-md-3" id="tipoCarregadorDiv" style="display: none;">
                                    <label for="tipoCarregador" class="form-label">Tipo de Carregador</label>
                                    <select class="form-control" name="tipoCarregador">
                                        <option value="">Selecione o tipo</option>
                                        <option value="1">Pistola</option>
                                        <option value="2">Fuzil</option>
                                        <option value="3">Carabina</option>
                                    </select>
                                    <div class="invalid-feedback">Por favor, selecione o tipo de carregador.</div>
                                </div>
                                <div class="col-md-2" id="tipoCalibre" style="display: none;">
                                    <label for="tipoCalibre" class="form-label">Calibre</label>
                                    <select class="form-control" name="tipoCalibre">
                                        <option value="">Selecione o calibre</option>
                                        <option value="1">.40</option>
                                        <option value="2">.556</option>
                                        <option value="3">.762</option>
                                        <option value="4">.38</option>
                                        <option value="5">.22</option>
                                        <option value="6">.32</option>
                                    </select>
                                    <div class="invalid-feedback">Por favor, selecione o calibre.</div>
                                </div>
                                <div class="col-md-2" id="calibreCarregador" style="display: none;">
                                    <label for="calibreCarregador" class="form-label">Calibre do Carregador</label>
                                    <select class="form-control" name="calibreCarregador">
                                        <option value="">Selecione o calibre</option>
                                        <option value="1">.40</option>
                                        <option value="2">.556</option>
                                        <option value="3">.762</option>
                                        <option value="4">.22</option>
                                    </select>
                                    <div class="invalid-feedback">Por favor, selecione o calibre do carregador.</div>
                                </div>
                                <div class="col-md-3" id="tipoColeteDiv" style="display: none;">
                                    <label for="tipoColete" class="form-label">Tipo de Colete</label>
                                    <select class="form-control" name="tipoColete">
                                        <option value="">Selecione o tipo</option>
                                        <option value="1">Feminino</option>
                                        <option value="2">Masculino</option>
                                    </select>
                                    <div class="invalid-feedback">Por favor, selecione o tipo de colete.</div>
                                </div>
                                <div class="col-md-3" id="tipoTonfaDiv" style="display: none;">
                                    <label for="tipoTonfa" class="form-label">Tipo de Tonfa</label>
                                    <select class="form-control" name="tipoTonfa">
                                        <option value="">Selecione o tipo</option>
                                        <option value="1">Madeira</option>
                                        <option value="2">Polietileno</option>
                                    </select>
                                    <div class="invalid-feedback">Por favor, selecione o tipo de tonfa.</div>
                                </div>
                                <div class="col-md-3" id="tipoEspagidorDiv" style="display: none;">
                                    <label for="tipoEspagidor" class="form-label">Tipo de Espargidor</label>
                                    <select class="form-control" name="tipoEspagidor">
                                        <option value="">Selecione o tipo</option>
                                        <option value="1">PSI Jato de Névoa</option>
                                        <option value="2">GL 108 Max CS</option>
                                        <option value="3">GL 108 Mini</option>
                                        <option value="4">GL 108 OC Max</option>
                                        <option value="5">Standard 108 Médio</option>
                                    </select>
                                    <div class="invalid-feedback">Por favor, selecione o tipo de espargidor.</div>
                                </div>
                                <div class="col-md-2" id="tipoTamanhoColeteDiv" style="display: none;">
                                    <label for="tamanhoColete" class="form-label">Tamanho do Colete</label>
                                    <select class="form-control" name="tamanhoColete">
                                        <option value="">Selecione o tamanho</option>
                                        <option value="1">P</option>
                                        <option value="2">M</option>
                                        <option value="3">G</option>
                                        <option value="4">GG</option>
                                    </select>
                                    <div class="invalid-feedback">Por favor, selecione o tamanho do colete.</div>
                                </div>
                                <div class="col-md-2" id="serieDiv" style="display: none;">
                                    <label for="inputSerie" class="form-label">Número de Série</label>
                                    <input type="text" class="form-control" name="serie" id="inputSerie" placeholder="Nº de série">
                                    <div class="invalid-feedback">Por favor, informe o número de série.</div>
                                </div>
                                <div class="col-md-2" id="chaveConfirmDiv" style="display: none;">
                                    <label for="inputToken" class="form-label">Confirmar Chave</label>
                                    <input type="text" class="form-control" name="token" id="inputToken" placeholder="Confirme a chave de cautela">
                                    <div class="invalid-feedback">Por favor, informe a chave de confirmação.</div>
                                </div>
                                <div class="col-12 mt-3">
                                    <button type="submit" id="submitButton" name="salvar" class="btn btn-primary" style="display: none;">Cautelar Material</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="sticky-footer bg-gradient-primary">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto text-white">
                        <span>Copyright © 2º BPTUR <?php echo date('Y'); ?></span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Pronto para sair?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Selecione "Sair" para encerrar sua sessão.</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="../index.html">Sair</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Geração de Chave -->
    <div class="modal fade" id="generateTokenModal" tabindex="-1" aria-labelledby="generateTokenModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="generateTokenModalLabel">Gerar Chave de Confirmação</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" action="../token/token.php" method="POST" novalidate>
                        <div class="col-12">
                            <label for="matriculaToken" class="form-label">Matrícula</label>
                            <input type="number" class="form-control" name="matricula" id="matriculaToken" placeholder="Digite a matrícula" required>
                            <div class="invalid-feedback">Por favor, informe a matrícula.</div>
                        </div>
                        <div class="col-12 mt-3">
                            <button type="submit" name="enviaToken" class="btn btn-primary">Enviar Chave</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../js/sb-admin-2.min.js"></script>
    <!--<script src="../js/script2.js"></script>-->
    <!--script src="../js/tornar_botao_visivel.js"></script>-->
    <!---<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>--->
    <script>
        // Função para mostrar/esconder campos com base no material selecionado
        document.getElementById('materialSelect').addEventListener('change', function() {
            const material = this.value;
            hideAllFields();

            if (material === '1') { // Armamento
                document.getElementById('tipoArmamentoDiv').style.display = 'block';
                document.getElementById('tipoCalibre').style.display = 'block';
                document.getElementById('serieDiv').style.display = 'block';
            } else if (material === '2') { // Colete Balístico
                document.getElementById('tipoColeteDiv').style.display = 'block';
                document.getElementById('tipoTamanhoColeteDiv').style.display = 'block';
            } else if (material === '3') { // Munição
                document.getElementById('tipoCalibre').style.display = 'block';
            } else if (material === '4') { // Tonfa
                document.getElementById('tipoTonfaDiv').style.display = 'block';
            } else if (material === '5') { // Espargidor
                document.getElementById('tipoEspagidorDiv').style.display = 'block';
            } else if (material === '6') { // Carregador
                document.getElementById('tipoCarregadorDiv').style.display = 'block';
                document.getElementById('calibreCarregador').style.display = 'block';
            } else if (material === '7' || material === '8' || material === '9' || material === '10') { // Outros materiais
                document.getElementById('serieDiv').style.display = 'block';
            }

            // Mostrar o campo de confirmação de token após selecionar o material
            document.getElementById('chaveConfirmDiv').style.display = 'block';
            document.getElementById('submitButton').style.display = 'block';
        });

        function hideAllFields() {
            const fields = ['tipoArmamentoDiv', 'tipoCarregadorDiv', 'tipoCalibre', 'calibreCarregador', 'tipoColeteDiv', 'tipoTonfaDiv', 'tipoEspagidorDiv', 'tipoTamanhoColeteDiv', 'serieDiv', 'chaveConfirmDiv'];
            fields.forEach(field => document.getElementById(field).style.display = 'none');
            document.getElementById('submitButton').style.display = 'none';
        }

        // Validação do formulário
        document.getElementById('cadastroOcorrencia').addEventListener('submit', function(e) {
            let isValid = true;
            const requiredFields = this.querySelectorAll('[required]');
            
            requiredFields.forEach(field => {
                if (!field.value || field.value === '') {
                    isValid = false;
                    field.classList.add('border-danger');
                    const feedback = field.nextElementSibling;
                    if (feedback && feedback.classList.contains('invalid-feedback')) {
                        feedback.style.display = 'block';
                    }
                } else {
                    field.classList.remove('border-danger');
                    const feedback = field.nextElementSibling;
                    if (feedback && feedback.classList.contains('invalid-feedback')) {
                        feedback.style.display = 'none';
                    }
                }
            });

            if (!isValid) {
                e.preventDefault();
                alert('Por favor, preencha todos os campos obrigatórios.');
            }
        });

        // Limpar feedback ao interagir com os campos
        document.querySelectorAll('.form-control').forEach(field => {
            field.addEventListener('input', function() {
                this.classList.remove('border-danger');
                const feedback = this.nextElementSibling;
                if (feedback && feedback.classList.contains('invalid-feedback')) {
                    feedback.style.display = 'none';
                }
            });
        });

        // Atualizar notificação de token na topbar
        const root = document.documentElement;
        const successColor = getComputedStyle(root).getPropertyValue('--success-color').trim();

        document.addEventListener('DOMContentLoaded', function() {
            const tokenValue = document.getElementById('token-value').textContent;
            const badge = document.querySelector('.badge-danger');
            if (tokenValue && tokenValue !== 'Nenhuma chave gerada') {
                badge.style.backgroundColor = successColor; // Usa o valor obtido da variável CSS
            }
        });
    </script>
</body>
</html>
