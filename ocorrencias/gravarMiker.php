<?php
    include('../conexao/conexao.php');
    
        if (isset($_POST['salvar'])) {
            $miker = $_POST['miker'];
            $matriculas = array(
                $_POST['matr1'],
                $_POST['matr2'],
                $_POST['matr3'],
                $_POST['matr4'],
                $_POST['matr5']
            );
        
            if (empty($miker)) {
                // Página de erro para campos em branco
            } else {
                // Conexão com o banco de dados
                
                if ($conn == false) {
                    die("Erro ao se conectar: " . mysqli_connect_error());
                }
        
                // Instrução preparada para evitar SQL injection
                $sqlRegistro = "INSERT INTO registrosbo (id_miker, mtr1, mtr2, mtr3, mtr4, mtr5)
                                VALUES (?, ?, ?, ?, ?, ?)";
        
                $stmt = mysqli_prepare($conn, $sqlRegistro);
        
                // Vincula as variáveis aos parâmetros da instrução SQL
                mysqli_stmt_bind_param($stmt, "iiiiii", $miker, ...$matriculas);
        
                // Executa a instrução preparada
                if (mysqli_stmt_execute($stmt)) {
                    echo "Dados inseridos com sucesso.";
                } else {
                    echo "Erro ao inserir dados: " . mysqli_error($conn);
                }
        
                // Fecha a instrução preparada
                mysqli_stmt_close($stmt);
        
                // Fecha a conexão com o banco de dados
                mysqli_close($conn);
            }
        }

    /*
    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }
    
    // Certifica-se de que as variáveis existem e não estão vazias
    if (isset($_POST['valorMatricula'], $_POST['valorMiker'])) { 
        // Preparação da instrução SQL
        $stmt = $conn->prepare("INSERT INTO registrosbo (id_miker, matricula) VALUES (?, ?)");
    
        // Verifica se a preparação da consulta foi bem-sucedida
        if ($stmt === false) {
            die("Erro na preparação da consulta: " . $conn->error);
        }
    
        // Vincula as variáveis aos parâmetros da instrução SQL
        $stmt->bind_param("ss", $miker, $matricula);
    
        // Obtém os valores do POST
        $miker = $_POST['valorMiker'];
        $matricula = $_POST['valorMatricula'];
    
        // Executa a consulta
        $result = $stmt->execute();
    
        // Verifica se a execução foi bem-sucedida
        if ($result === false) {
            die("Erro na execução da consulta: " . $stmt->error);
        }
    
        // Fecha a instrução preparada
        $stmt->close();
    } else {
        echo "Matrícula ou Miker não fornecidos.";
    }
    
    // Fecha a conexão com o banco de dados
    $conn->close();   */



    /*if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }
    
    // Certifique-se de que as variáveis existem e não estão vazias
    if (isset($_POST['valorMatricula'], $_POST['valorMiker']) && is_array($_POST['valorMatricula']) && is_array($_POST['valorMiker'])) {
        // Preparação da instrução SQL
        $stmt = $conn->prepare("INSERT INTO registrosbo (id_miker, matricula) VALUES (?, ?)");
    
        // Vincula as variáveis aos parâmetros da instrução SQL
        $stmt->bind_param("ss",  $miker, $matricula);
    
        // Itera sobre as matrículas e mikers e executa a instrução SQL para cada par
        foreach ($_POST['valorMatricula'] as $key => $matricula) {
            $miker = $_POST['valorMiker'][$key];
            $stmt->execute();
        }
    
        // Fecha a instrução preparada
        $stmt->close();
    } else {
        echo "Matrículas ou Mikers não fornecidos ou formato inválido.";
    }
    
    // Fecha a conexão com o banco de dados
    $conn->close();
    
*/

    /*function cadastrarRegistro($miker, $matricula)
    {
        global $conn;
    
        $sqlRegistro = "INSERT INTO registrosbo (`id_miker`, `matricula`) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $sqlRegistro);
    
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'issis', $miker, $matricula);
            $result = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            return $result;
        }
    
        return false;
    }
    
    if (isset($_POST['salvar'])) {
            $miker = $_POST['miker'];
            $matricula = $_POST['matricula'];

            if ($conn == false) {
                die("Erro ao se conectar" . mysqli_connect_error());
            }
    
            $result = cadastrarRegistro($miker, $matricula);
    
            mysqli_close($conn);
    
            if ($result) {
                echo "<div class='alert alert-success'>Cadastro realizado com sucesso!</div>";
            } else {
                echo "<div class='alert alert-danger'>Erro: Informações não cadastradas. </div>";
            }
        
    }*/



?>