<?php
    session_start();
    ob_start();
    require_once('../conexao/conexao_01.php');
    require_once('../usuario/restricaoUsuarios.php');

    $usuario = $_SESSION['matricula'];
    $conexao = new Conexao();
    $conn = $conexao->getConexao();

    $restringir = new RestricaoDeUsuario($conn);
    $restringir->restricao();
    $bpm = $restringir->getBpm();
    $nomeGuerra = $restringir->getNomeGuerra();

    if (isset($_GET['descautelar'])) {
        $id_detalhes = filter_input(INPUT_GET, 'descautelar', FILTER_SANITIZE_NUMBER_INT);

        if ($id_detalhes === false || $id_detalhes === null) {
            throw new InvalidArgumentException("ID de descautela inválido.");
        }

        $sqlAtual = "SELECT usuario.id, 
                            usuario.nome_de_guerra, 
                            usuario.posto_usuario, 
                            cautela.matricula_cautela, 
                            cautela.material, 
                            cautela.quantidade, 
                            cautela.tipo_material, 
                            cautela.data_cautela,
                            cautela.serie_material
                        FROM cautela
                        JOIN usuario ON cautela.matricula_cautela = usuario.id
                        WHERE cautela.id_cautela = ?";

        $_SESSION['id_detalhes'] = $id_detalhes;

        $stmt = $conn->prepare($sqlAtual);
        $stmt->bind_param("i", $id_detalhes);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($rowDescautelar = $result->fetch_assoc()) {
            $id = $rowDescautelar['id']; // matrícula
            $nomeGuerraCautelante = $rowDescautelar['nome_de_guerra']; // nome de guerra
            $posto = $rowDescautelar['posto_usuario']; // posto ou patente
            $matriculaCautela = $rowDescautelar['matricula_cautela'];
            $material = $rowDescautelar['material'];
            $quantidade = $rowDescautelar['quantidade'];
            $tipoMaterial = $rowDescautelar['tipo_material'];
            $dataCautela = $rowDescautelar['data_cautela'];
            $serie = $rowDescautelar['serie_material'];

            // Formatar datas para o padrão brasileiro
            $dataCautelaFormatada = date('d-m-Y', strtotime($dataCautela));
            $data_hoje = date("Y-m-d");
        }

        $sqlToken = "SELECT token_confirmacao FROM usuario WHERE id = ? LIMIT 1";
        $stmtToken = $conn->prepare($sqlToken);
        $stmtToken->bind_param("i", $usuario);
        $stmtToken->execute();
        $resultToken = $stmtToken->get_result();
        $rowToken = $resultToken->fetch_assoc();
        $tokenConfirm = $rowToken['token_confirmacao'];

        $stmt->close();
        $stmtToken->close();
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Descautela de Materiais - 2º BPTUR">
    <meta name="author" content="Fabio Galeno">
    <title>Descautela de Materiais</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Bootstrap e Estilos Customizados -->
    <!--<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">-->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/permutas.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
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

        .form-control:disabled {
            background-color: #e9ecef;
            opacity: 0.7;
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

        .token-notification {
            position: relative;
        }

        .token-notification .badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: var(--danger-color);
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
                        <a class="collapse-item" href="cautelarMaterial.php">Cautela</a>
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
                        <a class="collapse-item" href="ocorrencias.php">Ocorrências</a>
                        <a class="collapse-item" href="usuario.php">Usuários</a>
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
                    <h1 class="h3 mb-4 text-gray-800 font-weight-bold">Descautela de Materiais</h1>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Detalhes da Cautela</h6>
                            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#descautelaModal">
                                Realizar Descautela
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <p><strong>Matrícula/ID:</strong> <?php echo htmlspecialchars($matriculaCautela); ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Nome de Guerra (Cautelante):</strong> <?php echo htmlspecialchars($nomeGuerraCautelante); ?> (<?php echo htmlspecialchars($posto); ?>)</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Material:</strong> <?php echo htmlspecialchars($material); ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Tipo:</strong> <?php echo htmlspecialchars($tipoMaterial); ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Série:</strong> <?php echo htmlspecialchars($serie); ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Quantidade:</strong> <?php echo htmlspecialchars($quantidade); ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Data da Cautela:</strong> <?php echo htmlspecialchars($dataCautelaFormatada); ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Data da Devolução:</strong> <?php echo date('d-m-Y', strtotime($data_hoje)); ?></p>
                                </div>
                            </div>
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

    <!-- Modal de Descautela -->
    <div class="modal fade" id="descautelaModal" tabindex="-1" aria-labelledby="descautelaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="descautelaModalLabel">Realizar Descautela</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" id="descautelaForm" action="insert_db_descautela.php" method="POST" novalidate>
                        <input type="hidden" name="id_detalhes" value="<?php echo htmlspecialchars($id_detalhes); ?>">
                        <div class="col-md-2">
                            <label for="inputPosto" class="form-label">Posto/Patente</label>
                            <input type="text" class="form-control" name="posto" id="inputPosto" value="<?php echo htmlspecialchars($posto); ?>" disabled>
                        </div>
                        <div class="col-md-3">
                            <label for="inputNomeGuerra" class="form-label">Nome de Guerra</label>
                            <input type="text" class="form-control" name="nomeGuerra" id="inputNomeGuerra" value="<?php echo htmlspecialchars($nomeGuerraCautelante); ?>" disabled>
                        </div>
                        <div class="col-md-2">
                            <label for="inputMatricula" class="form-label">Matrícula</label>
                            <input type="text" class="form-control" name="matricula" id="inputMatricula" value="<?php echo htmlspecialchars($matriculaCautela); ?>" disabled>
                        </div>
                        <div class="col-md-2">
                            <label for="inputQuantidade" class="form-label">Quantidade</label>
                            <input type="text" class="form-control" name="quantidade" id="inputQuantidade" value="<?php echo htmlspecialchars($quantidade); ?>" disabled>
                        </div>
                        <div class="col-md-3">
                            <label for="inputMaterial" class="form-label">Material</label>
                            <input type="text" class="form-control" name="material" id="inputMaterial" value="<?php echo htmlspecialchars($material); ?>" disabled>
                        </div>
                        <div class="col-md-3">
                            <label for="inputTipoMaterial" class="form-label">Tipo do Material</label>
                            <input type="text" class="form-control" name="tipoMaterial" id="inputTipoMaterial" value="<?php echo htmlspecialchars($tipoMaterial); ?>" disabled>
                        </div>
                        <div class="col-md-2">
                            <label for="inputSerie" class="form-label">Série/Nº</label>
                            <input type="text" class="form-control" name="serie" id="inputSerie" value="<?php echo htmlspecialchars($serie); ?>" disabled>
                        </div>
                        <div class="col-md-2">
                            <label for="inputDataCautela" class="form-label">Data da Cautela</label>
                            <input type="date" class="form-control" name="dataCautela" id="inputDataCautela" value="<?php echo htmlspecialchars($dataCautela); ?>" disabled>
                        </div>
                        <div class="col-md-2">
                            <label for="inputDataEntrega" class="form-label">Data da Devolução</label>
                            <input type="date" class="form-control" name="dataEntrega" id="inputDataEntrega" value="<?php echo htmlspecialchars($data_hoje); ?>" disabled>
                        </div>
                        <div class="col-md-2">
                            <label for="inputToken" class="form-label">Chave</label>
                            <input type="text" class="form-control" name="inputchave" id="inputToken" required>
                            <div class="invalid-feedback">Por favor, informe a chave de confirmação.</div>
                        </div>
                        <div class="col-12 mt-3">
                            <button type="submit" name="salvar" class="btn btn-primary">Salvar Descautela</button>
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
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="../js/demo/datatables-demo.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script>
        // Atualizar notificação de token na topbar
        const root = document.documentElement;
        const successColor = getComputedStyle(root).getPropertyValue('--success-color').trim();

        document.addEventListener('DOMContentLoaded', function() {
            const tokenValue = document.getElementById('token-value').textContent;
            const badge = document.querySelector('.badge-danger');
            if (tokenValue && tokenValue !== 'Nenhuma chave gerada') {
                badge.style.backgroundColor = successColor; // Muda para verde se houver token
            }
        });

        // Validação do formulário de descautela
        document.getElementById('descautelaForm').addEventListener('submit', function(e) {
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

        // Limpar feedback ao interagir com os campos no modal
        document.querySelectorAll('.form-control').forEach(field => {
            field.addEventListener('input', function() {
                this.classList.remove('border-danger');
                const feedback = this.nextElementSibling;
                if (feedback && feedback.classList.contains('invalid-feedback')) {
                    feedback.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>

