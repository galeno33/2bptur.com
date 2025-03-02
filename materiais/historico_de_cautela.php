
<?php
    require_once('../conexao/conexao_01.php');
    require_once('../usuario/restricaoUsuarios.php');
    require_once('selectHistoricos.php');

    $conexao = new Conexao();
    $conn = $conexao->getConexao();

    $restringir = new RestricaoDeUsuario();
    $restringir->restricao();
    $tokenConfirm = $restringir->getChave();
    $bpm = $restringir->getBpm();
    $nomeGuerra = $restringir->getNomeGuerra();

    $historicos = new Historicos();
    $historicoMaterial = $historicos->selectHistorico();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Histórico de Cautelas - 2º BPTUR">
    <meta name="author" content="Fabio Galeno">
    <title>Histórico de Cautelas</title>

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

        .table-responsive {
            border-radius: 8px;
            overflow: hidden;
        }

        .table {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            overflow: hidden;
        }

        .table th, .table td {
            border-color: #e2e8f0;
        }

        .btn-primary {
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
                    <h1 class="h3 mb-4 text-gray-800 font-weight-bold">Histórico de Cautelas</h1>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Histórico de Cautelas</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Material</th>
                                        <th>Tipo</th>
                                        <th>Série</th>
                                        <th>Data de Cautela</th>
                                        <th>Situação</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Material</th>
                                        <th>Tipo</th>
                                        <th>Série</th>
                                        <th>Data de Cautela</th>
                                        <th>Situação</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach ($historicoMaterial as $selecionar): ?>
                                        <?php
                                        $id = $selecionar->getIdCautela();
                                        $mtrArmeiro = $selecionar->getMtrArmeiro();
                                        $material = $selecionar->getMaterial();
                                        $tipoMaterial = $selecionar->getTipoMaterial();
                                        $serie = $selecionar->getSeries();
                                        $tamanhoCalibre = $selecionar->getTamanhoCalibre();
                                        $diaCautela = $selecionar->getDiaCautela();
                                        $cautelante = $selecionar->getCautelante();
                                        $pArmeiro = $selecionar->getPostoArmeiro();
                                        $armeiro = $selecionar->getArmeiro();
                                        $diaEntrega = $selecionar->getDiaEntrega();

                                        // Formatar data para o padrão brasileiro
                                        $dataCautela = date('d-m-Y', strtotime($diaCautela));
                                        $dataEntrega = $diaEntrega ? date('d-m-Y', strtotime($diaEntrega)) : 'Não devolvido';

                                        if ($diaEntrega !== null && $mtrArmeiro !== null) {
                                            echo "<tr>";
                                            echo "<td>" . htmlspecialchars($cautelante) . "</td>";
                                            echo "<td>" . htmlspecialchars($material) . "</td>";
                                            echo "<td>" . htmlspecialchars($tipoMaterial) . "</td>";
                                            echo "<td>" . htmlspecialchars($serie) . "</td>"; // Corrigido: agora usa getSeries() para a coluna "Série"
                                            echo "<td><strong>" . htmlspecialchars($dataCautela) . "</strong></td>"; // Corrigido: agora usa getDiaCautela() para a coluna "Data de Cautela"
                                            echo "<td>"; // Coluna "Situação" agora contém o botão "Detalhes"
                                            echo "<a href='detalhes_da_cautela.php?detalhes=" . urlencode($id) . "' class='btn btn-primary btn-sm'>Detalhes</a>";
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    <?php endforeach; ?>
                                </tbody>
                                </table>
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

    <!-- Scripts -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../js/sb-admin-2.min.js"></script>
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="../js/demo/datatables-demo.js"></script>
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

        // Configurar DataTable
        $(document).ready(function () {
            /*$('#dataTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Portuguese-Brasil.json"
                },
                "pageLength": 10,
                "responsive": true,
                "order": [[4, "desc"]] // Ordenar por "Data de Cautela" em ordem decrescente por padrão
            });*/
        });
    </script>
</body>
</html>
