<?php
    //include('../conexao/conexao.php');
    require_once('../conexao/conexao_01.php');

    class PermutaController
    {
        private $conexao;

        public function __construct()
        {
            $this->conexao = new Conexao();
            //$this->conn = $conn;
        }

        public function salvarPermuta(Agenda $agenda)
        {
            $conn = $this->conexao->getConexao();
            $stmt = $conn->prepare("INSERT INTO agenda_permuta (matr_permutante, dia_agenda, aceito_permuta) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", 
                $agenda->getMatriculaPermuta(), 
                $agenda->getDataPermuta(), 
                $agenda->getAceito()
            );

            if ($stmt->execute()) {
                echo "<script>alert('Seu Agendamento de Permuta foi Concluida com Sucesso!'); window.location.href='https://2bptur.com/permuta/pedirPermutas.php';</script>";
                //header('Location: http://localhost/projetos/1Bptur/pedirPermutas.php');
                exit;
            } else {
                echo "Erro ao executar a permuta: " . $stmt->error;
            }

            $stmt->close();
        }
    }
?>
