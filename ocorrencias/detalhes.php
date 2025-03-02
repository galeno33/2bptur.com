<?php
    include('../conexao/conexao.php');

    function cadastrarOcorrencia($matricula, $miker, $sigoHash, $tipificacao, $diaOcorrencia, $pontosAcrescidos) {
        global $conn;

        $sqlOcorrencia = "INSERT INTO ranking (`matricula`, `miker_ocorrencia`, `sigo_ocorrencia`,`tipificacao_crime`, `data_ocorrencia`,`pontos_ranking`)
                        VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sqlOcorrencia);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'ississis',  $matricula, $miker, $sigoHash, $tipificacao, $diaOcorrencia, $pontosAcrescidos);
            $result = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            return $result;
        }

        return false;
    }
    if (isset($_POST['salvar'])) {
        if (empty($_POST['matricula']) || empty($_POST['miker']) ||
            empty($_POST['sigo']) || empty($_POST['tipificacao'])
        ) {
            echo "Preencha todos os dados";
            // Tratar o caso em que campos obrigatórios estão vazios
        } else {
            $matricula = $_POST['matricula'];
            $miker = $_POST['miker'];
            $sigo = $_POST['sigo'];
            $tipificacao = $_POST['tipificacao'];
            $diaOcorrencia = $_POST['inputdata'];
            $acrescimo = $_POST['flexRadioDefault'];

            //incremento de um switch() case para adicionar qual tificifação de criem vai ser salva no banco de dados
            switch($tipificacao){
                case 1:
                    $tipificacao = "furto";
                        if($tipificacao = "furto"){
                            $pontosAcrescidos = 50;
                        }
                    break;
                case 2:
                    $tipificacao = "roubo";
                        if($tipificacao = "roubo"){
                            $pontosAcrescidos = 50;
                        }
                    break;
                case 3:
                    $tipificacao = "Receptação";
                        if($tipificacao = "Receptação"){
                            $pontosAcrescidos = 50;
                        }
                    break;
                case 4:
                    $tipificacao = "Arma de fogo";
                        if($tipificacao = "Arma de fogo"){
                            $pontosAcrescidos = 100;
                        }
                    break;
                case 5:
                    $tipificacao = "Objeto Perfurocortante";
                        if($tipificacao = "Objeto Perfurocortante"){
                            $pontosAcrescidos = 10;
                        }
                    break;
                case 6:
                    $tipificacao = "Entorpecentes";
                        if($tipificacao = "Entorpecentes"){
                            $pontosAcrescidos = 85;
                        }
                    break;
                case 7:
                    $tipificacao = "Veiculo Recuperado";
                        if($tipificacao = "Veiculo Recuperado"){
                            $pontosAcrescidos = 50;
                        }
                    break;
                case 8:
                    $tipificacao = "Kadron Apreendido";
                        if($tipificacao = "Kadron Apreendido"){
                            $pontosAcrescidos = 10;
                        }
                    break;
                case 9:
                    $tipificacao = "Foragido";
                        if($tipificacao = "Foragido"){
                            $pontosAcrescidos = 80;
                        }
                    break;
                case 10:
                    $tipificacao = "Outras Tipificacoes";
                        if($tipificacao = "Outras Tipificacoes"){
                            $pontosAcrescidos = 25;
                        }
            }
            switch($acrescimo){
                case 1:
                    $pontosAcrescidos;
                    break;
                case 2:
                    $pontosAcrescidos += 75;
                    break;
                case 3:
                    $pontosAcrescidos += 30;
                    break;
            }

            // Cria um hash seguro da senha
            $sigoHash = password_hash($sigo, PASSWORD_DEFAULT);

            // Código que envia dados para o banco de dados
            if ($conn == false) {
                die("Erro ao se conectar" . mysqli_connect_error());
            }

            $result = cadastrarOcorrencia($matricula, $miker, $sigoHash, $tipificacao, $diaOcorrencia, $pontosAcrescidos);

            mysqli_close($conn);

            if ($result) {
                echo "<script>alert('Ocorrência cadastrado com sucesso!'); window.location.href='https://2bptur.com/ocorrencias/cadastroBo.php';</script>";
                //var_dump($situacaoAcesso);
            } else {
                echo "<script>alert('Erro ao cadastrar ocorrência!'); window.location.href='https://2bptur.com/ocorrencias/cadastroBo.php';</script>";
            }
        }
    }
    
?>