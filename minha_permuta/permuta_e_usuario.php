<?php
    
    class PermutaUsuario
    {
        private $id;
        private $matrPermutante;
        private $guerraPermutante;
        private $guerraPermutado;
        private $matrPermutado;
        private $dataPermuta;
        private $aceitoPermuta;
        private $autorizacaoPermuta;
        private $cia;

        public function __construct($id, $matrPermutante, $guerraPermutante, $guerraPermutado, $matrPermutado, $dataPermuta, $aceitoPermuta, $autorizacaoPermuta, $cia)
        {
            $this->id = $id;
            $this->matrPermutante = $matrPermutante;
            $this->guerraPermutante = $guerraPermutante;
            $this->guerraPermutado = $guerraPermutado;
            $this->matrPermutado = $matrPermutado;
            $this->dataPermuta = $dataPermuta;
            $this->aceitoPermuta = $aceitoPermuta;
            $this->autorizacaoPermuta = $autorizacaoPermuta;
            $this->cia = $cia;
        }

        public function getId()
        {
            return $this->id;
        }

        public function getMatrPermutante()
        {
            return $this->matrPermutante;
        }

        public function getGuerraPermutante()
        {
            return $this->guerraPermutante;
        }

        public function getGuerraPermutado()
        {
            return $this->guerraPermutado;
        }

        public function getMatrPermutado()
        {
            return $this->matrPermutado;
        }

        public function getDataPermuta()
        {
            return $this->dataPermuta;
        }

        public function getAceitoPermuta()
        {
            return $this->aceitoPermuta;
        }

        public function getAutorizacaoPermuta()
        {
            return $this->autorizacaoPermuta;
        }

        public function getCia()
        {
            return $this->cia;
        }
    }
?>
