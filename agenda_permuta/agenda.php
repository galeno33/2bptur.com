<?php
    class Agenda
    {
        private $matriculaPermuta;
        private $dataPermuta;
        private $aceito;

        public function __construct($matriculaPermuta, $dataPermuta)
        {
            $this->matriculaPermuta = $matriculaPermuta;
            $this->dataPermuta = $dataPermuta;
            $this->aceito = "a confirmar"; // Valor padrão
        }

        public function getMatriculaPermuta()
        {
            return $this->matriculaPermuta;
        }

        public function getDataPermuta()
        {
            return $this->dataPermuta;
        }

        public function getAceito()
        {
            return $this->aceito;
        }
    }
?>
