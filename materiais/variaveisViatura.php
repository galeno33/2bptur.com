<?php

    class Viaturas
    {
        private $id;
        private $prefixos;
        private $placa;
        private $nomeCompleto;
        private $nomeGuerra;
        private $posto;
        private $diaCautela;
        private $diaEntrega;
        private $modelo;
        private $matricula;
        private $armeiro;
        private $areaAtuacao;
        private $cia;

        public function __construct($id, $prefixos, $placa, $nomeCompleto, $nomeGuerra, $posto, $diaCautela, $diaEntrega, $modelo, $matricula, $armeiro, $areaAtuacao, $cia)
        {
            $this->id = $id;
            $this->prefixos = $prefixos;
            $this->placa = $placa;
            $this->nomeCompleto = $nomeCompleto;
            $this->nomeGuerra = $nomeGuerra;
            $this->posto = $posto;
            $this->diaCautela = $diaCautela;
            $this->diaEntrega = $diaEntrega;
            $this->modelo = $modelo;
            $this->matricula = $matricula;
            $this->armeiro = $armeiro;
            $this->areaAtuacao = $areaAtuacao;
            $this->cia = $cia;

        }

        public function getIdViatura(){ return $this->id;}
        public function getPrefixos(){ return $this->prefixos;}
        public function getPlaca(){ return $this->placa;}
        public function getNomeCompleto(){ return $this->nomeCompleto;}
        public function getNomeGuerra(){ return $this->nomeGuerra;}
        public function getPosto(){ return $this->posto;}
        public function getDiaCautela(){ return $this->diaCautela;}
        public function getEntrega(){ return $this->diaEntrega;}
        public function getModelo(){ return $this->modelo;}
        public function getMatricula(){ return $this->matricula;}
        public function getArmeiro(){ return $this->armeiro;}
        public function getAreaAtuacao(){ return $this->areaAtuacao;}
        public function getCia(){ return $this->cia;}
    }


?>