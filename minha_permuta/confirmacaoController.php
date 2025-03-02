<?php
    
    require_once('../conexao/conexao_01.php');
    include('permuta_e_usuario.php');
    
    //include('../php/login.php');
        session_start();
        $usuario =  $_SESSION['matricula'];
    class PermutaRepository
    {
        
        private $conexao;

        public function __construct()
        {
            $this->conexao = new Conexao();
            //$this->conn = $conn;
        }

        public function getPermutasByUsuario($usuario)
        {
            $conn = $this->conexao->getConexao();
            $sql = "SELECT
                        usuario1.nome_de_guerra AS guerraPermutante,
                        usuario2.nome_de_guerra AS guerraPermutado,
                        usuario1.cia AS cia1,
                        usuario2.cia AS cia2,
                        permutas.id_permuta,
                        permutas.matr_permutante,
                        permutas.matr_permutado,
                        permutas.dia_permuta,
                        permutas.aceito_permuta,
                        permutas.autorizacao_permuta
                    FROM permutas
                    JOIN usuario AS usuario1 ON permutas.matr_permutante = usuario1.id
                    JOIN usuario AS usuario2 ON permutas.matr_permutado = usuario2.id
                    WHERE permutas.matr_permutante = ? OR permutas.matr_permutado = ?";
            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $usuario, $usuario);
            $stmt->execute();
            $result = $stmt->get_result();
            
            $permutas = [];
            while ($row = $result->fetch_assoc()) {
                //faz referencia a class PermutaUsuario do arquivo permuta_e_usuario
                $permutas[] = new PermutaUsuario(
                    $row['id_permuta'],
                    $row['matr_permutante'],
                    $row['guerraPermutante'],
                    $row['guerraPermutado'],
                    $row['matr_permutado'],
                    $row['dia_permuta'],
                    $row['aceito_permuta'],
                    $row['autorizacao_permuta'],
                    $row['cia1'],
                    $row['cia2']
                );
            }
            
            $stmt->close();
            return $permutas;
        }
    }
?>
