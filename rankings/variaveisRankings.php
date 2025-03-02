<?php
    
    class VariaveisRanking
    {
        private $id_pontos;
        private $matricula_ranking;
        private $ponto_ranking;
        private $nome_guerra;
        private $cia;

        public function __construct($id_pontos, $matricula_ranking, $ponto_ranking, $nome_guerra, $cia)
        {
            $this->id_pontos = $id_pontos;
            $this->matricula_ranking = $matricula_ranking;
            $this->ponto_ranking = $ponto_ranking;
            $this->nome_guerra = $nome_guerra;
            $this->cia = $cia;
        }

        public function getIdPontos(){
            return $this->id_pontos;
        }

        public function getMatriculaRanking(){
            return $this->matricula_ranking;
        }

        public function getPontosRanking(){
            return $this->ponto_ranking;
        }

        public function getNomeGuerra(){
            return $this->nome_guerra;
        }

        public function getCiaRanking(){
            return $this->cia;
        }

    }


?>