<?php
    /**** Desenvolvido por Fabio Galeno ****/
    require_once('../conexao/conexao_01.php');

    class UpdateViatura
    {
        private $conexao;

        public function __construct()
        {
            $this->conexao = new Conexao();
        }

        public function updateDadosVtr()
        {
            $conn = $this->conexao->getConexao();

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateViatura'])) {
                // Validar os campos obrigatórios
                $idUpdate = filter_input(INPUT_POST, 'viatura', FILTER_VALIDATE_INT);
                $situacao = filter_input(INPUT_POST, 'situacao', FILTER_SANITIZE_STRING);
                $detalhes = filter_input(INPUT_POST, 'detalhes', FILTER_SANITIZE_STRING);

                if (!$idUpdate || !$situacao) {
                    echo "<script>alert('Erro: Preencha todos os campos obrigatórios corretamente.'); window.location.href='http://localhost/projetos/1Bptur/P4/cargas_da_unidade.php';</script>";
                    exit;
                }

                // Prepara a consulta SQL para atualizar os dados da viatura
                $sqlUpdate = "UPDATE viatura SET situacao = ?, detalhes = ? WHERE id_prefixo = ? LIMIT 1";
                $stmt = $conn->prepare($sqlUpdate);
                if (!$stmt) {
                    echo "<script>alert('Erro ao preparar a consulta SQL.'); window.location.href='http://localhost/projetos/1Bptur/P4/cargas_da_unidade.php';</script>";
                    exit;
                }

                $stmt->bind_param("ssi", $situacao, $detalhes, $idUpdate);

                if ($stmt->execute() && $stmt->affected_rows > 0) {
                    echo "<script>alert('Dados da viatura atualizados com sucesso!'); window.location.href='http://localhost/projetos/1Bptur/P4/cargas_da_unidade.php';</script>";
                } else {
                    echo "<script>alert('Nenhuma alteração feita ou erro na atualização.'); window.location.href='http://localhost/projetos/1Bptur/P4/cargas_da_unidade.php';</script>";
                }

                $stmt->close();
            }
        }
    }

    $updateVtr = new UpdateViatura();
    $updateVtr->updateDadosVtr();
?>