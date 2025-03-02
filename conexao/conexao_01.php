<?php

    class Conexao {
        private $host = "localhost";
        private $usuario = "root";
        private $senha = "";
        private $banco = "bptur_data";
        private $conn; 
        //private $instancia;
       /* private $host = "localhost";
        private $usuario = "u219083092_bptur";
        private $senha = "Viana@viana2";
        private $banco = "u219083092_bptur_data";
        private $conn;*/

        public function __construct() {
            $this->conn = new mysqli($this->host, $this->usuario, $this->senha, $this->banco);
            if ($this->conn->connect_error) {
                die("Erro de conexão: " . $this->conn->connect_error);
            }
        }

        /*public static function getInstance() {
            if (self::$instancia === null) {
                self::$instancia = new Conexao();
            }
            return self::$instancia;
        }*/

        public function getConexao() {
            return $this->conn;
        }
    }
    
?>
