<?php
    require_once('../minha_permuta/permuta_e_usuario.php');
    require_once('../usuario/restricaoUsuarios.php');
    class AutorizarPermuta
    {
        private $conn;
        private $restringir;
        //private $bpm;

        public function __construct($conn)
        {
            $this->conn = $conn;
            $this->restringir = new RestricaoDeUsuario();
            $this->restringir->restricao();
            
        }

        public function getPermutasEmAnalise()
        {
            
            $bpm = $this->restringir->getBpm();
            $cia = $this->restringir->getCiaRestrito();
            $autorizar = [];
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
                    WHERE permutas.autorizacao_permuta = 'Em análise'
                    AND usuario1.unidade_usuario = ?
                    AND usuario2.unidade_usuario = ?";

                    $stmt = $this->conn->prepare($sql);
                    $stmt->bind_param("ss", $bpm, $bpm);
                    $stmt->execute();

                    $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                $permuta = new PermutaUsuario(
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
                $autorizar[] = $permuta;
            }
            return $autorizar;
        }
    }
?>
