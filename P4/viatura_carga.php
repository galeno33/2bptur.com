<?php
    
    class Vtrs
    {
        private $idPrefixo;
        private $modelo;
        private $placa;
        private $situacao;
        private $cautela;
        private $detalhes;

        public function __construct
        (
            $idPrefixo,
            $modelo,
            $placa,
            $situacao,
            $cautela,
            $detalhes
        )
        {
            $this->idPrefixo = $idPrefixo;
            $this->modelo = $modelo;
            $this->placa = $placa;
            $this->situacao = $situacao;
            $this->cautela = $cautela;
            $this->detalhes = $detalhes;
        }
        public function getIdVtr(){ return $this->idPrefixo;}
        public function getModelo(){ return $this->modelo;}
        public function getPlaca(){ return $this->placa;}
        public function getSituacao(){ return $this->situacao;}
        public function getCautela(){ return $this->cautela;}
        public function getDetalhes(){ return $this->detalhes;}
    }

?>