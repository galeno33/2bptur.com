<?php
    require_once('../conexao/conexao_01.php');
    require_once('../usuario/restricaoUsuarios.php');

    try {
        // Instanciar a classe de restrição de usuários
        $restringir = new RestricaoDeUsuario();
        $restringir->restricao();
        $matricula = $restringir->getIdUsuario();

        // Conexão com o banco de dados
        $conexao = new Conexao();
        $conn = $conexao->getConexao();

        // Consulta ao banco de dados
        $sql = "SELECT token_confirmacao FROM usuario WHERE id = ? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $matricula);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            echo json_encode(['token' => $row['token_confirmacao']]);
        } else {
            echo json_encode(['error' => 'Token não encontrado.']);
        }
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    } finally {
        if (isset($stmt)) $stmt->close();
        if (isset($conn)) $conn->close();
    }
?>