<?php

    class Mtrl
    {
        private $idMaterial;
        private $serie;
        private $material;
        private $tipo;
        private $modelo;
        private $quantidade;
        private $tam_cal;
        private $marca;
        private $unidade;

        public function __construct
        (
            $idMaterial,
            $serie,
            $material,
            $tipo,
            $modelo,
            $quantidade,
            $tam_cal,
            $marca,
            $unidade
        )
        {
            $this->idMaterial = $idMaterial;
            $this->serie = $serie;
            $this->material = $material;
            $this->tipo = $tipo;
            $this->modelo = $modelo;
            $this->quantidade = $quantidade;
            $this->tam_cal = $tam_cal;
            $this->marca = $marca;
            $this->unidade = $unidade;
        }
        public function getIdMaterial(){ return $this->idMaterial;}
        public function getIdCargaMaterial(){ return $this->serie;}
        public function getMaterial(){ return $this->material;}
        public function getTipoMaterial(){ return $this->tipo;}
        public function getModelo(){ return $this->modelo;}
        public function getQuantidMaterial(){ return $this->quantidade;}
        public function getTamCal(){ return $this->tam_cal;}
        public function getMarca(){ return $this->marca;}
        public function getUnidade(){ return $this->unidade;}
    }

?>