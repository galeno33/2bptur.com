<?php
    require_once('../conexao/conexao_01.php');


    $conexao = new Conexao();
    $conn = $conexao->getConexao();

    function insertViatura(
        $prefixo, $modelo, $placa, $condicao, $cautela, $detalhes, $bpm
    ){
        global $conn;

        $sqlVtr = "INSERT INTO viatura(`id_prefixo`, `modelo`, `placa`, `situacao`, `cautela`, `detalhes`, `unidade`) VALUE (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sqlVtr);

        if($stmt){
            mysqli_stmt_bind_param($stmt, 'isssss', $prefixo, $modelo, $placa, $condicao, $cautela, $detalhes, $bpm);
            $result = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            return $result;
        }
        return false;
    }
    //função para inserir materiais no banco de dados
    function insertMateriais($id_serie, $material, $tipo, $quantidade, $tam_calib, $marca, $bpm){
        global $conn;

        $sqlMaterial = "INSERT INTO material(`serie`, `material`, `tipo`, `modelo`, `quantidade`, `tam_cal`, `marca`, `unidade`)VALUE(?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sqlMaterial);
        if($stmt){
            mysqli_stmt_bind_param($stmt, 'ssssisss', $id_serie, $material, $tipo, $modelo, $quantidade, $tam_calib, $marca, $bpm);
            $result = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            return $result;
        }
        return false;

    }

    if(isset($_POST['salvarVtr'])){
        if(empty($_POST['inputPrefixo']) || empty($_POST['inputModelo']) || empty($_POST['inputPlaca']) || empty($_POST['inputCondicao'])) {
            echo "<script>alert(Preencha todos os dados dos campos);</script>";
        }else {
            $prefixo = $_POST['inputPrefixo'];
            $modelo = $_POST['inputModelo'];
            $placa = $_POST['inputPlaca'];
            $condicao = $_POST['inputCondicao'];
            $cautela = "NULL";
            $detalhes = "NULL";
            $bpm = $_POST['inputUnidade'];

            if($conn == false){
                die("Erro ao conectar" . mysqli_connect_error());
            }
            $result = insertViatura($prefixo, $modelo, $placa, $condicao, $cautela, $detalhes, $bpm);
            mysqli_close($conn);
            if($result){
                echo "<script>alert('Cadastro concluída com sucesso!'); window.location.href='cadastrar_viatura.php';</script>";
            }else {
                echo "<script>alert('Erro! ao concluir o cadastro, entre em contato com o Administrados do sistema!'); window.location.href='cadastrar_viatura.php';</script>";
                
            }
        }
    }

    if(isset($_POST['salvarMaterial'])){
        $bpm = $_POST['inputUnidade'];
        $serie = $_POST['inputSerie'];
        $material = $_POST['inputMaterial'];
        $quantidade = $_POST['inputQtd'];
        $id_serie = $_POST['inputSerie'];

        $modelo = null;

        if($material == 1){
            $material = "Armamento";
            if(empty($_POST['tipoArmamento']) || empty($_POST['tipoCalibre'])){
                echo "<script>alert('Preencha todos os campos!'); window.location.href='cadastrar_cargas.php';</script>";
            }else {
                $tipo = $_POST['tipoArmamento'];
                $tam_calib = $_POST['tipoCalibre'];
                $marca = "NULL";

                switch($tipo){
                    case 1:
                        $tipo = "Pistola";
                        break;
                    case 2:
                        $tipo = "Revolver";
                        break;
                    case 3:
                        $tipo = "Fuzil";
                        break;
                    case 4:
                        $tipo = "Carabina";
                }
                switch($tam_calib){
                    case 1:
                        $tam_calib = ".40";
                        break;
                    case 2:
                        $tam_calib = ".556";
                        break;
                    case 3:
                        $tam_calib = ".762";
                        break;
                    case 4:
                        $tam_calib = ".38";
                        break;
                    case 5:
                        $tam_calib = ".22";
                        break;
                    case 6:
                        $tam_calib = ".32";
                }
                $result = insertMateriais($id_serie, $material, $tipo, $quantidade, $tam_calib, $marca, $bpm);
                mysqli_close($conn);
                if($result){
                    echo "<script>alert('Cadastro concluída com sucesso!'); window.location.href='cadastrar_cargas.php';</script>";
                }
            }
        }
    }


?>