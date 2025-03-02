<?php
    class Permuta
    {
        private $suaMatricula;
        private $matriculaPermutado;
        private $dataFim;
        private $confirme;
        private $justificativa;
        private $autorizacao;

        public function __construct($suaMatricula, $matriculaPermutado, $dataFim, $justificativa)
        {
            $this->suaMatricula = $suaMatricula;
            $this->matriculaPermutado = $matriculaPermutado;
            $this->dataFim = $dataFim;
            $this->confirme = "Não confirmado";
            $this->justificativa = $justificativa;
            $this->autorizacao = "Em análise";
        }

        public function getSuaMatricula()
        {
            return $this->suaMatricula;
        }

        public function getMatriculaPermutado()
        {
            return $this->matriculaPermutado;
        }

        public function getDataFim()
        {
            return $this->dataFim;
        }

        public function getConfirme()
        {
            return $this->confirme;
        }

        public function getJustificativa()
        {
            return $this->justificativa;
        }

        public function getAutorizacao()
        {
            return $this->autorizacao;
        }
    }
?>
