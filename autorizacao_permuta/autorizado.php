<?php
    require_once('../minha_permuta/permuta_e_usuario.php');
    require_once('../usuario/restricaoUsuarios.php');

    class Autorizado
    {
        private $conn;
        private $restringir;

        public function __construct($conn)
        {
            $this->conn = $conn;
            
        }
        //função que executa o codigo sql e que vai ser instaciado no arquivo permuta_autorizadas.php
        public function getPermutasAutorizadas()
        {
            $this->restringir = new RestricaoDeUsuario();
            $this->restringir->restricao();
            $bpm = $this->restringir->getBpm();
            $cia = $this->restringir->getCiaRestrito();
            $autorizado = [];
            
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
                    JOIN usuario AS usuario1 ON permutas.matr_permutante = usuario1.id AND usuario1.unidade_usuario = ?
                    JOIN usuario AS usuario2 ON permutas.matr_permutado = usuario2.id AND usuario2.unidade_usuario = ?
                    
                    AND usuario1.cia = ?
                    AND usuario2.cia = ?
                    WHERE permutas.autorizacao_permuta = 'Autorizado' OR permutas.autorizacao_permuta = 'Negado'
                    ";

                    $stmt = $this->conn->prepare($sql);
                    $stmt->bind_param("ssii", $bpm, $bpm, $cia, $cia);
                    $stmt->execute();

                    $result = $stmt->get_result();
            while($row = $result->fetch_assoc())
            {
                $permutaAutorizada = new PermutaUsuario
                (
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
                $autorizado[] = $permutaAutorizada;
            }
             return $autorizado;

        }
    }
?>