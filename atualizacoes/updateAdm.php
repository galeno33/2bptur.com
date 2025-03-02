<?php
/**
 * Classe para gerenciar a atualização de administradores
 * Atualizado em 30/06/2024
 */
require_once('../conexao/conexao_01.php');

class UpdateAdm
{
    private $conexao;
    private $id;
    private $nome;
    private $nomeGuerra;
    private $posto;
    private $classe;
    private $funcao;
    private $telefone;
    private $cia;
    private $situacao;
    private $senha;

    /**
     * Construtor da classe
     */
    public function __construct()
    {
        $this->conexao = new Conexao();
    }

    /**
     * Obtém e processa os dados de atualização do administrador
     * @return void
     */
    public function getUpdateAdm(): void
    {
        $conn = $this->conexao->getConexao();

        // Verifica se o parâmetro 'updAdministra' está definido na URL
        if (isset($_GET['updAdministra'])) {
            $idUsuario = filter_input(INPUT_GET, 'updAdministra', FILTER_SANITIZE_NUMBER_INT);

            if ($idUsuario === false || $idUsuario === null) {
                throw new InvalidArgumentException("ID de usuário inválido.");
            }

            // Consulta preparada para buscar os dados do usuário
            $sqlSelect = "SELECT id, nome_completo, nome_de_guerra, posto_usuario, classe_usuario, funcao_usuario, 
                          telefone_usuario, cia, situacao, senha_usuario 
                          FROM usuario 
                          WHERE id = ?";
            
            $stmt = $conn->prepare($sqlSelect);
            if ($stmt === false) {
                throw new RuntimeException("Erro ao preparar a consulta: " . $conn->error);
            }

            $stmt->bind_param("i", $idUsuario);
            $stmt->execute();
            $result = $stmt->get_result();

            // Verifica se encontrou o usuário
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $this->id = (int)$row['id'];
                $this->nome = $row['nome_completo'];
                $this->nomeGuerra = $row['nome_de_guerra'];
                $this->posto = $row['posto_usuario'];
                $this->classe = $row['classe_usuario'];
                $this->funcao = $row['funcao_usuario'];
                $this->telefone = $row['telefone_usuario'];
                $this->cia = $row['cia'];
                $this->situacao = $row['situacao'] === 'habilitado' ? 1 : 0;
                $this->senha = $row['senha_usuario']; // Armazena a senha hashada original
            } else {
                throw new RuntimeException("Usuário não encontrado.");
            }
            $stmt->close();

            // Processa a atualização dos dados, se houver POST
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateUsuario'])) {
                $this->processUpdate($conn, $idUsuario);
            }
        }
    }

    /**
     * Processa a atualização dos dados do usuário
     * @param mysqli $conn Conexão com o banco de dados
     * @param int $idUsuario ID do usuário a ser atualizado
     * @return void
     * @throws RuntimeException Se houver erro na atualização
     */
    private function processUpdate($conn, int $idUsuario): void
    {
        $posto = filter_input(INPUT_POST, 'posto', FILTER_SANITIZE_STRING) ?? $this->posto;
        $classe = filter_input(INPUT_POST, 'classe', FILTER_SANITIZE_STRING) ?? $this->classe;
        $funcao = filter_input(INPUT_POST, 'funcao', FILTER_SANITIZE_STRING) ?? $this->funcao;
        $situacao = filter_input(INPUT_POST, 'situacao', FILTER_SANITIZE_NUMBER_INT) ?? $this->situacao;
        $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING) ?? $this->telefone;
        $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

        // Preparar a senha hashada, se fornecida
        $senhaHash = $this->senha; // Mantém a senha original por padrão
        if (!empty($senha)) {
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        }

        // Query preparada para atualizar os dados
        $sqlUpdate = "UPDATE usuario 
                      SET posto_usuario = ?, 
                          classe_usuario = ?, 
                          funcao_usuario = ?, 
                          telefone_usuario = ?, 
                          senha_usuario = ?, 
                          situacao = ? 
                      WHERE id = ?";

        $stmt = $conn->prepare($sqlUpdate);
        if ($stmt === false) {
            throw new RuntimeException("Erro ao preparar a atualização: " . $conn->error);
        }

        $situacaoStr = $situacao == 1 ? 'habilitado' : 'desabilitado';
        $stmt->bind_param(
            "ssssssi",
            $posto,
            $classe,
            $funcao,
            $telefone,
            $senhaHash,
            $situacaoStr,
            $idUsuario
        );

        if ($stmt->execute()) {
            echo "<script>alert('Atualização concluída com sucesso!'); window.location.href='updateUsuario.php';</script>";
        } else {
            echo "<script>alert('Erro na atualização!'); window.location.href='updateUsuario.php';</script>";
        }

        $stmt->close();
    }

    // Getters
    public function getIdUpd() { return $this->id; }
    public function getNomeUpd() { return $this->nome; }
    public function getNomeGuerraUpd() { return $this->nomeGuerra; }
    public function getFuncaoUpd() { return $this->funcao; }
    public function getClasseUpd() { return $this->classe; }
    public function getPostoUpd() { return $this->posto; }
    public function getSenhaUpd() { return $this->senha; }
    public function getTelefoneUpd() { return $this->telefone; }
    public function getCiaUpd() { return $this->cia; }
    public function getSituacaoUpd()  { return $this->situacao;  }
}