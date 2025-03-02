<?php
/*****algoritimo implementado dia 26/10/2024*****/
/*****algoritimo atualizado dia 03/11/2024*****/
/*****Autor: Fabio Galeno*****/
    require_once('../conexao/conexao_01.php');


    $conexao = new Conexao();
    $conn = $conexao->getConexao();

    
    //função para inserir materiais no banco de dados
    function insertMateriais($id_serie, $material, $tipo, $modelo, $quantidade, $tam_calib, $marca, $bpm){
        global $conn;

        $sqlMaterial = "INSERT INTO material(`serie`, `material`, `tipo`, `modelo`, `quantidade`, `tam_cal`, `marca`, `unidade`)VALUE(?, ?, ?, ?, ?, ?, ? ,?)";
        $stmt = mysqli_prepare($conn, $sqlMaterial);
        if($stmt){
            mysqli_stmt_bind_param($stmt, 'ssssisss', $id_serie, $material, $tipo, $modelo, $quantidade, $tam_calib, $marca, $bpm);
            $result = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            return $result;
        }
        return false;

    }

    
    if(isset($_POST['salvarMaterial'])){
        $bpm = $_POST['inputUnidade'];
        //teste de chamada de variavel
        //var_dump($bpm);
        $material = $_POST['inputMaterial'];
        $quantidade = $_POST['inputQtd'];
        $id_serie = $_POST['inputSerie'];
        
        if($material == 1){
            $material = "Armamento";
            if(empty($_POST['tipoArmamento']) || empty($_POST['tipoCalibre']) || empty($_POST['inputQtd'])){
                echo "<script>alert('Preencha todos os campos!'); window.location.href='cadastrar_cargas.php';</script>";
            }else {
                $tipo = $_POST['tipoArmamento'];
                $tam_calib = $_POST['tipoCalibre'];
                $marca = "NULL";
                if($tipo == 1){
                    $tipo = "Pistola";
                    $modelo = $_POST['modeloPistola'];
                    switch($modelo){
                        case 1:
                            $modelo = "PT-100";
                            break;
                        case 2:
                            $modelo = "PT-840";
                    }
                }else if($tipo == 2){
                    $tipo = "Revolver"; 
                }else if($tipo == 3){
                    $tipo = "Fuzil";
                    $modelo = $_POST['modeloFuzil'];
                    switch($modelo){
                        case 1:
                            $modelo = "PARAFAL";
                            break;
                        case 2:
                            $modelo = "MOSQUEFAL";
                            break;
                        case 3:
                            $modelo = "IA-2";
                            break;
                        case 4:
                            $modelo = "T4";
                    }
                }else if($tipo == 4){
                    $tipo = "Carabina";
                    $modelo = $_POST['modeloCarabina'];
                    switch($modelo){
                        case 1:
                            $modelo = "SMT-40";
                            break;
                        case 2:
                            $modelo = "MAGAL";
                    }
                }
                /*switch($tipo){
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
                }*/
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
                $result = insertMateriais($id_serie, $material, $tipo, $modelo, $quantidade, $tam_calib, $marca, $bpm);
                mysqli_close($conn);
                if($result){
                    echo "<script>alert('Cadastro concluída com sucesso!'); window.location.href='cadastrar_cargas.php';</script>";
                }else {
                    echo "<script>alert('Erro, ao cadastrar material carga!'); window.location.href='cadastrar_cargas.php';</script>";
                }
            }
        }
        if($material == 2){
            $material = "Colete balistico";
            if(empty($_POST['tipoColete']) || empty($_POST['tamanhoColete']) || empty($_POST['inputQtd'])){
                echo "<script>alert('Preencha todos os campos!'); window.location.href='cadastrar_cargas.php';</script>";
            }else {
                $tipo = $_POST['tipoColete'];
                $tam_calib = $_POST['tamanhoColete'];
                $marca = $_POST['inputMarca'];
                $modelo = "NULL";
                switch($tipo){
                    case 1:
                        $tipo = "Feminino";
                        break;
                    case 2:
                        $tipo = "Masculino";
                }
                switch($tam_calib){
                    case 1:
                        $tam_calib = "P";
                        break;
                    case 2:
                        $tam_calib = "M";
                        break;
                    case 3:
                        $tam_calib = "G";
                        break;
                    case 4:
                        $tam_calib = "GG";
                }
                $result = insertMateriais($id_serie, $material, $tipo, $modelo, $quantidade, $tam_calib, $marca, $bpm);
                mysqli_close($conn);
                if($result){
                    echo "<script>alert('Cadastro concluída com sucesso!'); window.location.href='cadastrar_cargas.php';</script>";
                }else {
                    echo "<script>alert('Erro, ao cadastrar material carga!'); window.location.href='cadastrar_cargas.php';</script>";
                }
            }
        }
        if($material == 3){
            $material = "Munição";
            $modelo = "NULL";
            $marca = "NULL";
            $tipo = "NULL";
            if(empty($_POST['tipoCalibre']) || empty($_POST['inputQtd'])){
                echo "<script>alert('Preencha todos os campos!'); window.location.href='cadastrar_cargas.php';</script>";
            }else {
                $tam_calib = $_POST['tipoCalibre'];
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
                $result = insertMateriais($id_serie, $material, $tipo, $modelo, $quantidade, $tam_calib, $marca, $bpm);
                mysqli_close($conn);
                if($result){
                    echo "<script>alert('Cadastro concluída com sucesso!'); window.location.href='cadastrar_cargas.php';</script>";
                }else {
                    echo "<script>alert('Erro, ao cadastrar material carga!'); window.location.href='cadastrar_cargas.php';</script>";
                }
            }
        }
        if($material == 4){
            $material = "Tonfa";
            $tam_calib = "NULL";
            $marca = "NULL";
            $modelo = "NULL";
            
            if(empty($_POST['tipoTonfa']) || empty($_POST['inputQtd'])){
                echo "<script>alert('Preencha todos os campos!'); window.location.href='cadastrar_cargas.php';</script>";
            }else {
                $tipo = $_POST['tipoTonfa'];
                switch($tipo){
                    case 1:
                        $tipo = "Madeira";
                        break;
                    case 2:
                        $tipo = "Polietileno";
                }
                $result = insertMateriais($id_serie, $material, $tipo, $modelo, $quantidade, $tam_calib, $marca, $bpm);
                mysqli_close($conn);
                if($result){
                    echo "<script>alert('Cadastro concluída com sucesso!'); window.location.href='cadastrar_cargas.php';</script>";
                }else {
                    echo "<script>alert('Erro, ao cadastrar material carga!'); window.location.href='cadastrar_cargas.php';</script>";
                }
            }
        }
        if($material == 5){
            $material = "Espagidor";
            $tam_calib = "NULL";
            $marca = "NULL";
            $modelo = "NULL";
            if(empty($_POST['tipoEspagidor']) || empty($_POST['inputQtd'])){
                echo "<script>alert('Preencha todos os campos!'); window.location.href='cadastrar_cargas.php';</script>";
            }else {
                $tipo = $_POST['tipoEspagidor'];
                switch($tipo){
                    case 1:
                        $tipo = "PSI JATO DE NÉVOA";
                        break;
                    case 2:
                        $tipo = "GL 108 MAX CS";
                        break;
                    case 3:
                        $tipo = "GL 108 MINI";
                        break;
                    case 4:
                        $tipo = "GL 108 OC MAX";
                        break;
                    case 5:
                        $tipo = "STANDARD 108 MEDIO";
                        
                }
                $result = insertMateriais($id_serie, $material, $tipo, $modelo, $quantidade, $tam_calib, $marca, $bpm);
                mysqli_close($conn);
                if($result){
                    echo "<script>alert('Cadastro concluída com sucesso!'); window.location.href='cadastrar_cargas.php';</script>";
                }else {
                    echo "<script>alert('Erro, ao cadastrar material carga!'); window.location.href='cadastrar_cargas.php';</script>";
                }
            }
        }
        if($material == 6){
            $material = "Carregador";
          
            if(empty($_POST['modeloCarregador']) || empty($_POST['calibreCarregador']) || empty($_POST['inputQtd'])){
                echo "<script>alert('Preencha todos os campos!'); window.location.href='cadastrar_cargas.php';</script>";
            }else {
                $tipo = "NULL";
                $modelo = $_POST['modeloCarregador'];
                $tam_calib = $_POST['calibreCarregador'];
                $marca = "NULL";
                switch($modelo){
                    case 1:
                        $modelo = "PARAFAL";
                        break;
                    case 2:
                        $modelo = "MOSQUEFAL";
                        break;
                    case 3:
                        $modelo = "IA-2";
                        break;
                    case 4:
                        $modelo = "T-4";
                        break;
                    case 5:
                        $modelo = "SMT-40";
                        break;
                    case 6:
                        $modelo = "MAGAL";
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
                        $tam_calib = ".22";
                }
                $result = insertMateriais($id_serie, $material, $tipo, $modelo, $quantidade, $tam_calib, $marca, $bpm);
                mysqli_close($conn);
                if($result){
                    echo "<script>alert('Cadastro concluída com sucesso!'); window.location.href='cadastrar_cargas.php';</script>";
                }else {
                    echo "<script>alert('Erro, ao cadastrar material carga!'); window.location.href='cadastrar_cargas.php';</script>";
                }
            }
        }
        if($material == 7){
            $material = "Colete reflexivo";
            
            if(empty($_POST['inputQtd'])){
                echo "<script>alert('Preencha todos os campos!'); window.location.href='cadastrar_cargas.php';</script>";
            }else {
                $marca = "NULL";
                $tam_calib = "NULL";
                $tipo = "NULL";
                $modelo = "NULL";
                $result = insertMateriais($id_serie, $material, $tipo, $modelo, $quantidade, $tam_calib, $marca, $bpm);
                mysqli_close($conn);
                if($result){
                    echo "<script>alert('Cadastro concluída com sucesso!'); window.location.href='cadastrar_cargas.php';</script>";
                }else {
                    echo "<script>alert('Erro, ao cadastrar material carga!'); window.location.href='cadastrar_cargas.php';</script>";
                }
            }
        }
        if($material == 8){
            $material = "Escudo balistico";
            if(empty($_POST['inputQtd'])){
                echo "<script>alert('Preencha todos os campos!'); window.location.href='cadastrar_cargas.php';</script>";
            }else {
                $marca = "NULL";
                $tam_calib = "NULL";
                $tipo = "NULL";
                $modelo = "NULL";
                $result = insertMateriais($id_serie, $material, $tipo, $modelo, $quantidade, $tam_calib, $marca, $bpm);
                mysqli_close($conn);
                if($result){
                    echo "<script>alert('Cadastro concluída com sucesso!'); window.location.href='cadastrar_cargas.php';</script>";
                }else {
                    echo "<script>alert('Erro, ao cadastrar material carga!'); window.location.href='cadastrar_cargas.php';</script>";
                }
            }
        }
        if($material == 9){
            $material = "Escudo nivel III";
            if(empty($_POST['inputQtd'])){
                echo "<script>alert('Preencha todos os campos!'); window.location.href='cadastrar_cargas.php';</script>";
            }else {
                $marca = "NULL";
                $tam_calib = "NULL";
                $tipo = "NULL";
                $modelo = "NULL";
                $result = insertMateriais($id_serie, $material, $tipo, $modelo, $quantidade, $tam_calib, $marca, $bpm);
                mysqli_close($conn);
                if($result){
                    echo "<script>alert('Cadastro concluída com sucesso!'); window.location.href='cadastrar_cargas.php';</script>";
                }else {
                    echo "<script>alert('Erro, ao cadastrar material carga!'); window.location.href='cadastrar_cargas.php';</script>";
                }
            }
        }
        if($material == 10){
            $material = "Capacete anti-tumulto";
            if(empty($_POST['inputQtd'])){
                echo "<script>alert('Preencha todos os campos!'); window.location.href='cadastrar_cargas.php';</script>";
            }else {
                $marca = "NULL";
                $tam_calib = "NULL";
                $tipo = "NULL";
                $modelo = "NULL";
                $result = insertMateriais($id_serie, $material, $tipo, $modelo, $quantidade, $tam_calib, $marca, $bpm);
                mysqli_close($conn);
                if($result){
                    echo "<script>alert('Cadastro concluída com sucesso!'); window.location.href='cadastrar_cargas.php';</script>";
                }else {
                    echo "<script>alert('Erro, ao cadastrar material carga!'); window.location.href='cadastrar_cargas.php';</script>";
                }
            }
        }

    }


?>