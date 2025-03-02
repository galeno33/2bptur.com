<?php
    
    require_once('conexao/conexao_01.php');
    require_once('usuario/restricaoUsuarios.php');
    
    class Tipificacao {
        private $conexao;
        private $restringir;
        public function __construct()
        {
            $this->conexao = new Conexao();
            $this->restringir = new RestricaoDeUsuario();
        }
    
        public function contaCrimes()
        {
            $conn = $this->conexao->getConexao();
            $this->restringir->restricao();
            $bpm = $this->restringir->getBpm();
    
            // Lista de todos os valores possíveis para tipificacao_crime
            //$valoresPossiveis = range(1, 10);
            // Obter mês atual
            $dataAtual = date('Y-m-d');
            $mesAtual = substr($dataAtual, 5, 2);
            // Construa a consulta SQL dinamicamente
            /*$sqlHome = "SELECT tipificacao_crime,
                            COUNT(*) as quantidade 
                        FROM ranking 
                        WHERE tipificacao_crime IN (" . implode(", ", $valoresPossiveis) . ") 
                        GROUP BY tipificacao_crime";*/
                        $sqlHome = "SELECT r.matricula, r.tipificacao_crime, COUNT(*) AS quantidade, u.id, u.unidade_usuario
                        FROM ranking r
                        JOIN usuario u ON r.matricula = u.id
                        WHERE DATE_FORMAT(r.dia_mes, '%m') = $mesAtual
                        AND u.unidade_usuario = '$bpm'
                        GROUP BY r.tipificacao_crime";
    
            // Execute a consulta SQL
            $result = mysqli_query($conn, $sqlHome);
    
            // Verifique se a consulta foi bem-sucedida
            if ($result) {
                // Inicialize um array para armazenar as quantidades por tipo
                $quantidadesPorTipo = [];
    
                // Itere sobre os resultados e armazene as quantidades em um array associativo
                while ($row = mysqli_fetch_assoc($result)) {
                    $tipificacaoCrime = $row['tipificacao_crime'];
                    $quantidade = $row['quantidade'];
                    $quantidadesPorTipo[$tipificacaoCrime] = $quantidade;
                }
    
                // Libere o resultado da consulta
                mysqli_free_result($result);
    
                return $quantidadesPorTipo;
            } else {
                // Trate o caso em que a consulta falha
                echo "Erro na consulta: " . mysqli_error($conn);
                return null;
            }
        }
    }
    
?>