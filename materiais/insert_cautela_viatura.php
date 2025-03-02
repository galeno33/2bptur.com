<?php
    /*****codigo criado dia 10/11/2024*****/
    include_once('../conexao/conexao_01.php');
    
    if (isset($_POST['salvar'])) {
        try {
            // Inicializa a conexão
            $conexao = new Conexao();
            $conn = $conexao->getConexao();
    
            // Captura e valida os dados do formulário
            $motoristaId = filter_input(INPUT_POST, 'idMotorista', FILTER_VALIDATE_INT);
            $dataCautela = filter_input(INPUT_POST, 'dataCautela', FILTER_SANITIZE_STRING);
            $viatura = filter_input(INPUT_POST, 'viatura', FILTER_VALIDATE_INT);
            $tokenConfirme = filter_input(INPUT_POST, 'chaveConfirme', FILTER_SANITIZE_STRING);
            $cia = filter_input(INPUT_POST, 'inputCia', FILTER_VALIDATE_INT);
            $area = filter_input(INPUT_POST, 'areaAtuacao', FILTER_SANITIZE_STRING);
            $dataEntrega = null; // Data nula por padrão
            $armeiro = null; // Armeiro nulo por padrão
    
            // Verifica se os campos obrigatórios estão preenchidos
            if (!$motoristaId || !$dataCautela || !$viatura || !$tokenConfirme || !$cia || !$area) {
                throw new Exception("Dados inválidos ou incompletos.");
            }
    
            // Prepara a consulta para inserir os dados de cautela
            $sqlInserirCautela = "INSERT INTO cautela_viatura (cautela_prefixo, matricula_motorista, matricula_armeiro, dia_cautela, dia_entrega, area_de_atuacao, cia) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sqlInserirCautela);
    
            if (!$stmt) {
                throw new Exception("Erro ao preparar a consulta: " . $conn->error);
            }
    
            $stmt->bind_param('iiisssi', $viatura, $motoristaId, $armeiro, $dataCautela, $dataEntrega, $area, $cia);
    
            // Executa a inserção
            if (!$stmt->execute()) {
                throw new Exception("Erro ao salvar os dados: " . $stmt->error);
            }
    
            // Verifica a chave de confirmação na tabela usuario
            $sqlVerificarChave = "SELECT token_confirmacao FROM usuario WHERE id = ?";
            $stmtUsuario = $conn->prepare($sqlVerificarChave);
    
            if (!$stmtUsuario) {
                throw new Exception("Erro ao preparar a consulta: " . $conn->error);
            }
    
            $stmtUsuario->bind_param('i', $motoristaId);
            $stmtUsuario->execute();
            $resultUsuario = $stmtUsuario->get_result();
    
            if ($resultUsuario->num_rows === 0) {
                throw new Exception("Usuário não encontrado.");
            }
    
            $row = $resultUsuario->fetch_assoc();
            $chaveConfirmeDB = $row['token_confirmacao'];
    
            // Verifica a validade da chave de confirmação
            if ($tokenConfirme != $chaveConfirmeDB) {
                throw new Exception("Chave de confirmação inválida.");
            }
    
            // Limpa o token de confirmação após validação
            $sqlAtualizarToken = "UPDATE usuario SET token_confirmacao = NULL WHERE id = ?";
            $stmtToken = $conn->prepare($sqlAtualizarToken);
    
            if (!$stmtToken) {
                throw new Exception("Erro ao preparar a consulta: " . $conn->error);
            }
    
            $stmtToken->bind_param('i', $motoristaId);
    
            if (!$stmtToken->execute()) {
                throw new Exception("Erro ao atualizar o token: " . $stmtToken->error);
            }
    
            //echo "Dados salvos com sucesso e token verificado!";
            echo "<script>alert('Viatura cautelada com sucesso!'); window.location.href='cautela_vtr.php';</script>";
    
            // Fecha todas as conexões e libera recursos
            $stmt->close();
            $stmtUsuario->close();
            $stmtToken->close();
            $conn->close();
    
        } catch (Exception $e) {
            // Exibe a mensagem de erro
            echo "Erro: " . $e->getMessage();
        }
    }
    
?>