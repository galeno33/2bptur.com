<?php
    require_once('variaveisMateriais.php');

    class SelecionarMateriais
    {
        private $conn;
        private $restringir;

        public function __construct($conn)
        {
            $this->conn = $conn;
            $this->restringir = new RestricaoDeUsuario();
            $this->restringir->restricao();           
        }

        public function selecionarMateriais()
        {
            $bpm = $this->restringir->getBpm();
            $cia = $this->restringir->getCiaRestrito();

            $sql = "SELECT ";
        }
    }


?>