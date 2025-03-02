<?php
/****atualizado dia 30/06/2024*****/
require_once('conexao/conexao_01.php');
include('php/variaveis.php');
require_once('ocorrencias/contarTipificacao.php');
require_once('usuario/restricaoUsuarios.php');

// Instâncias e inicializações
$conexao = new Conexao();
$conn = $conexao->getConexao();
$restringir = new RestricaoDeUsuario();
$restringir->restricao();
$tokenCorfirme = $restringir->getChave();
$classe = $restringir->getClasse();
$situacao = $restringir->getSituacao();
$funcao = $restringir->getFuncao();
$ciaRestrito = $restringir->getCiaRestrito();
$nomeGuerra = $restringir->getNomeGuerra();
$bpm = $restringir->getBpm();

$contar = new Tipificacao();
$quantidadesPorTipo = $contar->contaCrimes();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema de Gestão da 2º BPTUR - Polícia Militar">
    <meta name="author" content="Fabio Galeno">
    <title>BPTUR-POLICE</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Bootstrap e Estilos Customizados -->
    <!--<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">-->
    <link rel="stylesheet" href="css/paginas.css">

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900&display=swap" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
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
        }

        .table th, .table td {
            border-color: #e2e8f0;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
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

        .btn-success, .btn-danger, .btn-outline-primary, .btn-outline-danger {
            border-radius: 6px;
            padding: 8px 16px;
            transition: all 0.3s ease;
        }

        .btn-success:hover, .btn-danger:hover, .btn-outline-primary:hover, .btn-outline-danger:hover {
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

        .badge {
            border-radius: 10px;
            font-size: 0.75rem;
        }

        .badge-danger {
            background-color: var(--danger-color);
        }

        .border-left-primary { border-left: 4px solid var(--primary-color); }
        .border-left-success { border-left: 4px solid var(--success-color); }
        .border-left-info { border-left: 4px solid var(--info-color); }

        .invalid-feedback {
            display: none;
            color: var(--danger-color);
            font-size: 0.875rem;
        }

        .form-control:invalid + .invalid-feedback {
            display: block;
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
            <a class="sidebar-brand d-flex align-items-center justify-content-center py-3" href="home.php">
                <div class="sidebar-brand-icon">
                    <img src="img/2bptur.ico" alt="Logo 2º BPTUR" width="50" height="50">
                </div>
                <div class="sidebar-brand-text mx-3"><?php echo htmlspecialchars($bpm); ?></div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="home.php">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Início</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <?php if ($situacao == "HABILITADO") { ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAdmin" aria-expanded="false" aria-controls="collapseAdmin">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Área Administrativa</span>
                    </a>
                    <div id="collapseAdmin" class="collapse" aria-labelledby="headingAdmin" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Administrativo:</h6>
                            <?php
                            $selectFiltro = "SELECT cia FROM usuario WHERE cia = $ciaRestrito";
                            $selectRes = mysqli_query($conn, $selectFiltro);
                            $selectRow = mysqli_fetch_assoc($selectRes);
                            $ciaFiltro = $selectRow['cia'];

                            if (in_array($funcao, ["Cmd. de Batalhão", "Sub. Cmd de Batalhão", "Cmd de Cia", "Sub Cmd de Cia", "Cmd do P1", "Cmd do P2", "Cmd do P3", "Cmd do P4", "Gerente"])) {
                                echo "<a class='collapse-item' href='autorizacao_permuta/permuta_a_autorizar.php'>Permuta a Autorizar</a>";
                            }

                            if ($situacao == "HABILITADO") {  
                                echo "<a class='collapse-item' href='autorizacao_permuta/permutas_autorizadas.php'>Permutas Autorizadas</a>";
                                echo "<a class='collapse-item' href='filtragem_pesquisas/relatorioOcorrencias.php'>Filtro de Ocorrências</a>";
                            }
                            ?>
                            <a class="collapse-item" href="ocorrencias/ocorrencias.php">Ocorrência</a>
                            <a class="collapse-item" href="usuario/verUsuarios.php">Usuários</a>
                        </div>
                    </div>
                </li>
            <?php } ?>

            <?php if ($funcao == "Armeiro" || $situacao == "HABILITADO") { ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMaterials" aria-expanded="false" aria-controls="collapseMaterials">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Materiais</span>
                    </a>
                    <div id="collapseMaterials" class="collapse" aria-labelledby="headingMaterials" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Materiais:</h6>
                            <a class="collapse-item" href="materiais/cautelarMaterial.php">Cautela</a>
                            <a class="collapse-item" href="materiais/materiais_cautelados.php">Materiais Cautelados</a>
                            <a class="collapse-item" href="materiais/historico_de_cautela.php">Histórico de Cautela</a>
                        </div>
                    </div>
                </li>
            <?php } ?>

            <div class="sidebar-heading text-light opacity-75">Interface</div>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSessions" aria-expanded="false" aria-controls="collapseSessions">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Sessões</span>
                </a>
                <div id="collapseSessions" class="collapse" aria-labelledby="headingSessions" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Sessões:</h6>
                        <a class="collapse-item" href="https://forms.gle/K8YfA3b4KX1GyZb9A" target="_blank">Relatório de Disparos</a>
                        <a class="collapse-item" href="https://forms.gle/fyZNtGv944nVugyx5" target="_blank">Boletim de Ocorrência</a>
                        <a class="collapse-item" href="https://forms.gle/veP7Vn8PN9kn3GiMA" target="_blank">Livro do CPU</a>
                        <a class="collapse-item" href="https://forms.gle/VMEXp9aiMwnipWu2A" target="_blank">Cmd de Guarnição</a>
                        <a class="collapse-item" href="https://forms.gle/hSvtJ9gZa49mCJmP6" target="_blank">Termo de Indiciamento</a>
                        <a class="collapse-item" href="https://forms.gle/kjUJ2o7kT9Sw65RQ6" target="_blank">Termo de Entrega</a>
                        <a class="collapse-item" href="https://forms.gle/PnDWBww13V76kmoc6" target="_blank">Termo de Confissão</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePermutas" aria-expanded="false" aria-controls="collapsePermutas">
                    <i class="fas fa-sync"></i>
                    <span>Permutas</span>
                </a>
                <div id="collapsePermutas" class="collapse" aria-labelledby="headingPermutas" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Permuta:</h6>
                        <a class="collapse-item" href="minha_permuta/minhaPermuta.php">Minhas Permutas</a>
                        <a class="collapse-item" href="permuta/pedirPermutas.php">Pedir Permutas</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="rankings/ranking.php">
                    <i class="fas fa-trophy"></i>
                    <span>Ranking Geral</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="rankings/rankingCia.php">
                    <i class="fas fa-trophy"></i>
                    <span>Ranking da Cia</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="perfil/perfil.php">
                    <i class="fas fa-user"></i>
                    <span>Perfil</span>
                </a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">
        </nav>

        <!-- Main Content -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light topbar bg-gradient-primary mb-4 shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars text-white"></i>
                    </button>

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw text-white"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Pesquisar..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="far fa-hand-point-right text-white"></i>
                                <?php if (!empty($tokenCorfirme)): ?>
                                    <span class="badge badge-success badge-counter">Ativo</span>
                                <?php else: ?>
                                    <span class="badge badge-danger badge-counter">Inativo</span>
                                <?php endif; ?>
                            </a>
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header text-primary">Centro de Mensagens</h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">
                                            <strong>Chave:</strong> <span><?php echo htmlspecialchars($tokenCorfirme); ?></span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </li>

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-white small"><strong><?php echo htmlspecialchars($nomeGuerra); ?></strong></span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg" alt="Perfil" width="30" height="30">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="perfil/perfil.php">
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
                    <h1 class="h3 mb-4 text-gray-800 font-weight-bold">Dashboard - 2º BPTUR</h1>

                    <!-- Estatísticas de Ocorrências -->
                    <div class="row">
                        <?php if ($classe == "OFICIAL" || strtolower($classe) == "oficial") { ?>
                            <div class="col-xl-2 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Arma de Fogo</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php echo isset($quantidadesPorTipo[4]) ? $quantidadesPorTipo[4] : 0; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-2 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Roubo</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php echo isset($quantidadesPorTipo[2]) ? $quantidadesPorTipo[2] : 0; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-2 col-md-6 mb-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Furto</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php echo isset($quantidadesPorTipo[1]) ? $quantidadesPorTipo[1] : 0; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-2 col-md-6 mb-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Entorpecentes</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php echo isset($quantidadesPorTipo[6]) ? $quantidadesPorTipo[6] : 0; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-2 col-md-6 mb-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Outras Tipificações</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php echo isset($quantidadesPorTipo[10]) ? $quantidadesPorTipo[10] : 0; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    
                    <!-- Gráficos e Tabelas -->
                    <div class="row">
                        <?php  if (in_array($funcao, ["Cmd. de Batalhão", "Sub. Cmd de Batalhão", "Cmd de Cia", "Sub Cmd de Cia", "Cmd do P1", "Cmd do P2", "Cmd do P3", "Cmd do P4", "Gerente"])) {
                        ?>
                        <div class="col-xl-8 col-lg-8">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Evolução por CIA durante o Ano</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-bar">
                                        <canvas id="ciaBarChart"></canvas>
                                    </div>
                                    <hr>
                                    <span class="text-muted">Fonte: CIOPS</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Porcentagem - Mês Anterior vs Atual</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="percentualTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>CIA</th>
                                                    <th>Mês Anterior</th>
                                                    <th>Mês Atual</th>
                                                </tr>
                                            </thead>
                                            <tbody id="percentualTableBody">
                                                <!-- Dados preenchidos via AJAX -->
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    <span class="text-muted">Fonte: CIOPS</span>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>

                    <!-- Tabela de Permutas Disponíveis -->
                    <div class="row">
                        <div class="col-lg-10 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Permutas Disponíveis</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Nome de Guerra</th>
                                                    <th>Data do Serviço</th>
                                                    <th>Situação</th>
                                                    <th>Companhia</th>
                                                    <th>Confirmação</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Nome de Guerra</th>
                                                    <th>Data do Serviço</th>
                                                    <th>Situação</th>
                                                    <th>Companhia</th>
                                                    <th>Confirmação</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php
                                                date_default_timezone_set('America/Sao_Paulo');
                                                $dataAtual = date('Y-m-d');

                                                $sqlResultadoPermuta = "SELECT usuario.nome_completo, usuario.nome_de_guerra, usuario.cia, agenda_permuta.id_agenda, agenda_permuta.matr_permutante, agenda_permuta.dia_agenda, agenda_permuta.aceito_permuta
                                                                        FROM agenda_permuta 
                                                                        JOIN usuario 
                                                                        ON agenda_permuta.matr_permutante = usuario.id";
                                                $resultado = mysqli_query($conn, $sqlResultadoPermuta) or die("Erro ao tentar ver as permutas");

                                                while ($rowPermuta = mysqli_fetch_assoc($resultado)) {
                                                    $idPermuta = $rowPermuta['id_agenda'];
                                                    $matrPermutante = $rowPermuta['matr_permutante'];
                                                    $nomeCompleto = $rowPermuta['nome_completo'];
                                                    $guerra = $rowPermuta['nome_de_guerra'];
                                                    $cia = $rowPermuta['cia'];
                                                    $dataPermuta = $rowPermuta['dia_agenda'];
                                                    $confirmAgenda = $rowPermuta['aceito_permuta'];

                                                    $dataFormatada = date('d-m-Y', strtotime($dataPermuta));

                                                    if ($dataPermuta == $dataAtual && $confirmAgenda == "a confirmar") {
                                                        $sqlDeletar = "DELETE FROM agenda_permuta WHERE dia_agenda = '$dataPermuta'";
                                                        mysqli_query($conn, $sqlDeletar);
                                                    } elseif ($confirmAgenda == "a confirmar") {
                                                        echo "<tr>";
                                                        echo "<td>" . htmlspecialchars($guerra) . "</td>";
                                                        echo "<td>" . $dataFormatada . "</td>";
                                                        echo "<td>" . htmlspecialchars($confirmAgenda) . "</td>";
                                                        echo "<td>" . htmlspecialchars($cia) . "ª</td>";
                                                        echo "<td><a href='atualizarPermuta.php?aceite=" . urlencode($idPermuta) . "' class='btn btn-primary btn-sm'>Aceitar</a></td>";
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
                    <a class="btn btn-primary" href="index.html">Sair</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="js/demo/datatables-demo.js"></script>

    <script>
        const ctx = document.getElementById('ciaBarChart').getContext('2d');

        const nomesMeses = {
            1: 'Janeiro', 2: 'Fevereiro', 3: 'Março', 4: 'Abril', 5: 'Maio', 6: 'Junho',
            7: 'Julho', 8: 'Agosto', 9: 'Setembro', 10: 'Outubro', 11: 'Novembro', 12: 'Dezembro'
        };

        fetch('grafico_estatisticas/graficoCiaData.php')
            .then(response => response.json())
            .then(data => {
                if (!data || data.length === 0) {
                    console.error('Nenhum dado encontrado.');
                    return;
                }

                const mesesRegistrados = [...new Set(data.flatMap(item => item.valores.map(v => v.mes)))].sort((a, b) => a - b);
                const mesesLabels = mesesRegistrados.map(m => nomesMeses[m]);

                const datasets = data.map((item, index) => {
                    const valores = mesesRegistrados.map(mes => {
                        const registroMes = item.valores.find(v => v.mes === mes);
                        return registroMes ? registroMes.total : 0;
                    });

                    return {
                        label: `${item.cia}ª CIA`,
                        data: valores,
                        borderColor: ['#FF5733', '#33FF57', '#3357FF', '#FFC300', '#8A2BE2', '#FF69B4'][index % 6],
                        borderWidth: 2,
                        fill: false,
                        tension: 0.3,
                    };
                });

                new Chart(ctx, {
                    type: 'line',
                    data: { labels: mesesLabels, datasets: datasets },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: true, position: 'left' },
                            tooltip: {
                                callbacks: { label: context => `${context.dataset.label}ª CIA: ${context.raw} ocorrências` },
                            },
                            title: { display: true, text: 'Número de Ocorrências por CIA e Mês' },
                        },
                        scales: {
                            x: { title: { display: true, text: 'Meses' }, ticks: { autoSkip: false }, beginAtZero: true },
                            y: { type: 'linear', beginAtZero: true, title: { display: true, text: 'Número de Ocorrências' }, grid: { drawBorder: false } },
                        },
                    },
                });
            })
            .catch(error => console.error('Erro ao carregar os dados:', error));

        // Inicializar DataTable
        /*$(document).ready(function () {
            $('#dataTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Portuguese-Brasil.json"
                },
                "pageLength": 5,
                "responsive": true,
                "order": [[0, "asc"]]
            });
        });*/
    </script>
</body>
</html>
