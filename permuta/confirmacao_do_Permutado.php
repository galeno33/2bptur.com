<?php
    include('conexao/conexao.php');
    require_once('../conexao/conexao_01.php');

    $conexao = new Conexao();
    $conn = $conexao->getConexao();

    //---------------teste de retorno--------------------
    /*if(isset($_GET['confirmar'])){
        $id = $_GET['confirmar'];
        var_dump($id. "confirmado");
    }
    
    if(isset($_GET['negar'])){
        $id = $_GET['negar'];
        
        var_dump($id. "negado");
    }*/
    //----------------fim do testo de etorno----------------

// Verificar se o parâmetro GET 'autorizado' está presente e atualizar o valor da coluna 'autorizacao_permuta' para 'autorizado'
if (isset($_GET['confirmar'])) {
    $id = $_GET['confirmar']; // Obtém o ID da permuta
    $confirmar = "Confirmado"; // Define o valor para 'autorizado'

    // Executar a atualização no banco de dados
    $updPermuta = "UPDATE permutas SET aceito_permuta = ? WHERE id_permuta = ?";
    $stmt = mysqli_prepare($conn, $updPermuta);
    mysqli_stmt_bind_param($stmt, "si", $confirmar, $id);
    $resAuto = mysqli_stmt_execute($stmt);

    // Verificar se a atualização foi bem-sucedida e redirecionar
    if ($resAuto) {
        echo "<script>alert('Sua permuta foi confirmada, aguarde a autorização!'); window.location.href='../minha_permuta/minhaPermuta.php';</script>";
        //header('Location: http://localhost/projetos/1Bptur/permuta/minhaPermuta.php');
        exit(); // Encerrar o script para evitar a execução adicional
    } else {
        echo "Erro ao confirmar a permuta, VOLTE A PEGINA ANTERIOR!";
        //header('Location: http://localhost/projetos/1Bptur/erroUpdAutorizacao.php');
        exit(); // Encerrar o script para evitar a execução adicional
    }
}

// Verificar se o parâmetro GET 'negado' está presente e atualizar o valor da coluna 'autorizacao_permuta' para 'negado'
if (isset($_GET['negar'])) {
    $id = $_GET['negar']; // Obtém o ID da permuta
    $confirmar = "Negado"; // Define o valor para 'negado'

    // Executar a atualização no banco de dados
    $updPermuta = "UPDATE permutas SET aceito_permuta = ? WHERE id_permuta = ?";
    $stmt = mysqli_prepare($conn, $updPermuta);
    mysqli_stmt_bind_param($stmt, "si", $confirmar, $id);
    $resAuto = mysqli_stmt_execute($stmt);

    // Verificar se a atualização foi bem-sucedida e redirecionar
    if ($resAuto) {
        echo "<script>alert('Você negou a permuta.'); window.location.href='../minha_permuta/minhaPermuta.php';</script>";
        //header('Location: http://localhost/projetos/1Bptur/permuta/minhaPermuta.php');
        exit(); // Encerrar o script para evitar a execução adicional
    } else {
        echo "Erro ao confirmar a permuta, VOLTE A PAGINA ANTERIOR!";
        //header('Location: http://localhost/projetos/1Bptur/erroUpdAutorizacao.php');
        exit(); // Encerrar o script para evitar a execução adicional
    }
}

?>