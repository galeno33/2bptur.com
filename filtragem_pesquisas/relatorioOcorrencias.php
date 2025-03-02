<?php
//include('conexao/conexao.php');
require_once('../conexao/conexao_01.php');
require_once('../usuario/restricaoUsuarios.php');
session_start();

$restringir = new RestricaoDeUsuario();
$restringir->restricao();
$nomGuerra = $restringir->getNomeGuerra();
$situacao = $restringir->getSituacao();
$funcao = $restringir->getFuncao();
$ciaRestrito = $restringir->getCiaRestrito();
$bpm = $restringir->getBpm();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Relatório de Ocorrências - 2º BPTUR">
    <meta name="author" content="Fabio Galeno">
    <title>Quantitativo de Ocorrências</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Bootstrap e Estilos Customizados -->
    <!--<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">-->
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

        .table {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            overflow: hidden;
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

        .form-control {
            border-radius: 6px;
            border: 1px solid #e2e8f0;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(44, 82, 130, 0.2);
        }

        .invalid-feedback {
            display: none;
            color: var(--danger-color);
            font-size: 0.875rem;
        }

        .form-control:invalid + .invalid-feedback {
            display: block;
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
            <?php if ($situacao == "HABILITADO") { ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAdmin" aria-expanded="false" aria-controls="collapseAdmin">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Área do Administrativo</span>
                    </a>
                    <div id="collapseAdmin" class="collapse" aria-labelledby="headingAdmin" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Administrativo:</h6>
                            <?php if ($situacao == "HABILITADO") { ?>
                                <a class="collapse-item" href="../autorizacao_permuta/permuta_a_autorizar.php">Permuta a Autorizar</a>
                                <a class="collapse-item" href="../autorizacao_permuta/permutas_autorizadas.php">Permutas Autorizadas</a>
                            <?php } ?>
                            <a class="collapse-item" href="../ocorrencias/ocorrencias.php">Ocorrência</a>
                            <a class="collapse-item" href="../usuario/verUsuarios.php">Usuários</a>
                        </div>
                    </div>
                </li>
            <?php } ?>
            <hr class="sidebar-divider">
            <div class="sidebar-heading text-light opacity-75">Complemento</div>
            <li class="nav-item">
                <a class="nav-link" href="../ranking.php">
                    <i class="fas fa-trophy"></i>
                    <span>Ranking Geral</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../rankingCia.php">
                    <i class="fas fa-trophy"></i>
                    <span>Ranking da Cia</span>
                </a>
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
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-white small"><strong><?php echo htmlspecialchars($nomGuerra); ?></strong></span>
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
                    <h1 class="h3 mb-4 text-gray-800 font-weight-bold">Relatório de Ocorrências</h1>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Ocorrências por Período - 2º BPTUR</h6>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title mb-4">Ocorrências por Período em Toda a Área do 2º BPTUR</h5>
                            <button id="gerarPdf" class="btn btn-primary mb-3">Gerar PDF</button>
                            <form class="row g-3 justify-content-center" id="formConsulta" method="POST" novalidate>
                                <div class="col-md-5 mb-3">
                                    <label for="dataInicial" class="form-label">Data Inicial</label>
                                    <input type="date" class="form-control" name="data_inicio" id="dataInicial" required>
                                    <div class="invalid-feedback">Por favor, informe a data inicial.</div>
                                </div>
                                <div class="col-md-5 mb-3">
                                    <label for="dataFinal" class="form-label">Data Final</label>
                                    <input type="date" class="form-control" name="data_fim" id="dataFinal" required>
                                    <div class="invalid-feedback">Por favor, informe a data final.</div>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <input type="submit" name="salvar" class="btn btn-primary mt-4" value="Pesquisar">
                                </div>
                            </form>
                            <div class="table-responsive mt-4">
                                <table id="tabelaResultados" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Tipificação do Crime</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="corpoTabela">
                                        <!-- Os resultados serão inseridos aqui -->
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="../vendor/chart.js/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.13/jspdf.plugin.autotable.min.js"></script>
    
    <script src="../js/campo.js"></script>
    <script>
        document.getElementById("formConsulta").addEventListener("submit", function(event) {
            event.preventDefault();

            var formData = new FormData(this);

            fetch("filtroOcorrencias.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                var corpoTabela = document.getElementById("corpoTabela");
                corpoTabela.innerHTML = "";

                data.forEach(function(item) {
                    var row = document.createElement("tr");
                    row.innerHTML = `
                        <td>${item.tipificacao_crime}</td>
                        <td>${item.total}</td>
                    `;
                    corpoTabela.appendChild(row);
                });
            })
            .catch(error => console.error("Erro ao enviar requisição:", error));
        });

        document.getElementById("gerarPdf").addEventListener("click", function() {
            var { jsPDF } = window.jspdf;

            var doc = new jsPDF();

            var dataInicial = document.getElementById("dataInicial").value;
            var dataFinal = document.getElementById("dataFinal").value;
            var dataTexto = "";

            if (dataInicial && dataFinal) {
                var dataInicialObj = new Date(dataInicial);
                var dataFinalObj = new Date(dataFinal);
                dataTexto = `de ${dataInicialObj.toLocaleDateString('pt-BR')} até ${dataFinalObj.toLocaleDateString('pt-BR')}`;
            } else if (dataInicial) {
                var dataInicialObj = new Date(dataInicial);
                dataTexto = `a partir de ${dataInicialObj.toLocaleDateString('pt-BR')}`;
            } else if (dataFinal) {
                var dataFinalObj = new Date(dataFinal);
                dataTexto = `até ${dataFinalObj.toLocaleDateString('pt-BR')}`;
            }

            doc.text(`Relatório de Tipificação de Crimes ${dataTexto}`, 14, 16);

            doc.autoTable({
                html: '#tabelaResultados',
                startY: 20,
                theme: 'grid'
            });

            doc.save('relatorio_ocorrencias.pdf');
        });

        // Validação do formulário com feedback visual
        document.getElementById('formConsulta').addEventListener('submit', function(e) {
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
    </script>
</body>
</html>
