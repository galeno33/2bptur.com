<?php
    include('conexao/conexao.php');

// Verificar se o parâmetro GET 'autorizado' está presente e atualizar o valor da coluna 'autorizacao_permuta' para 'autorizado'
if (isset($_GET['autorizado'])) {
    $id = $_GET['autorizado']; // Obtém o ID da permuta
    $autorizacao_permuta = "Autorizado"; // Define o valor para 'autorizado'

    // Executar a atualização no banco de dados
    $updPermuta = "UPDATE permutas SET autorizacao_permuta = ? WHERE id_permuta = ?";
    $stmt = mysqli_prepare($conn, $updPermuta);
    mysqli_stmt_bind_param($stmt, "si", $autorizacao_permuta, $id);
    $resAuto = mysqli_stmt_execute($stmt);

    // Verificar se a atualização foi bem-sucedida e redirecionar
    if ($resAuto) {
        header('Location: http://localhost/projetos/1Bptur/confirmUpdAutorizacao.php');
        exit(); // Encerrar o script para evitar a execução adicional
    } else {
        header('Location: http://localhost/projetos/1Bptur/erroUpdAutorizacao.php');
        exit(); // Encerrar o script para evitar a execução adicional
    }
}

// Verificar se o parâmetro GET 'negado' está presente e atualizar o valor da coluna 'autorizacao_permuta' para 'negado'
if (isset($_GET['negado'])) {
    $id = $_GET['negado']; // Obtém o ID da permuta
    $autorizacao_permuta = "Negado"; // Define o valor para 'negado'

    // Executar a atualização no banco de dados
    $updPermuta = "UPDATE permutas SET autorizacao_permuta = ? WHERE id_permuta = ?";
    $stmt = mysqli_prepare($conn, $updPermuta);
    mysqli_stmt_bind_param($stmt, "si", $autorizacao_permuta, $id);
    $resAuto = mysqli_stmt_execute($stmt);

    // Verificar se a atualização foi bem-sucedida e redirecionar
    if ($resAuto) {
        header('Location: http://localhost/projetos/1Bptur/confirmUpdAutorizacao.php');
        exit(); // Encerrar o script para evitar a execução adicional
    } else {
        header('Location: http://localhost/projetos/1Bptur/erroUpdAutorizacao.php');
        exit(); // Encerrar o script para evitar a execução adicional
    }
}

    /*if($id = $_GET['autorizado']){
        var_dump($id);
        echo "Autorizado";
    }
    if($idn = $_GET['negado']){
        var_dump($idn);
        echo "Nayara";
    }*/
    
    /*
    if($id = $_GET['autorizo'] || $id = $_GET['negado']){
        //teste de retorno
        //var_dump($id);
        
        $sqlAutorizacao = "SELECT * FROM permutas WHERE id_permuta = $id";
        $resAutorizacao = mysqli_query($conn, $sqlAutorizacao);
        $rowAutorizacao = mysqli_fetch_assoc($resAutorizacao);

        $idPermuta = $rowAutorizacao['id_permuta'];
        $matr_permutante = $rowAutorizacao['matr_permutante'];
        $matr_permutado = $rowAutorizacao['matr_permutado'];
        $dia_permuta = $rowAutorizacao['dia_permuta'];
        $aceito_permuta = $rowAutorizacao['aceito_permuta'];
        $autorizacao_permuta = $rowAutorizacao['autorizacao_permuta'];
        $justificativa = $rowAutorizacao['justificativa'];

        if($id = $_GET['autorizado']){
            $autorizacao_permuta = "Sim";
        }else if($id = $_GET['negado']){
            $autorizacao_permuta = "Sim";
        }
        
        $updPermuta = "UPDATE `permutas`
                        SET autorizacao_permuta = '$autorizacao_permuta'
                        WHERE id_permuta = $id";
        $resAuto = mysqli_query($conn, $updPermuta);

        if($resAuto){
            header('Location: http://localhost/projetos/1Bptur/confirmUpdAutorizacao.php');
        }else {
            header('Location: http://localhost/projetos/1Bptur/erroUpdAutorizacao.php');
        }
    }*/
    
?>