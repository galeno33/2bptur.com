<?php

    class Ocorrencias
    {
        private $id_ranking;
        private $matricula_ranking;
        private $miker_Bo;
        private $sigo_ocorrencia;
        private $tipificacao_crime;
        private $dia_mes;
        private $endereco_ocorrencia;
        private $bairro_ocorrencia;
        private $cidade_ocorrencia;

        public function __construct($id_ranking, $matricula_ranking, $miker_Bo, $sigo_ocorrencia, $tipificacao_crime, $dia_mes, $endereco_ocorrencia, $bairro_ocorrencia, $cidade_ocorrencia)
        {
            $this->id_ranking = $id_ranking;
            $this->matricula_ranking = $matricula_ranking;
            $this->miker_Bo = $miker_Bo;
            $this->sigo_ocorrencia = $sigo_ocorrencia;
            $this->tipificacao_crime = $tipificacao_crime;
            $this->dia_mes = $dia_mes;
            $this->endereco_ocorrencia = $endereco_ocorrencia;
            $this->bairro_ocorrencia = $bairro_ocorrencia;
            $this->cidade_ocorrencia = $cidade_ocorrencia;
        }

        public function getIdOcorrencia()
        {
            return $this->id_ranking;
        }

        public function getMatriculaOcorrencia()
        {
            return $this->matricula_ranking;
        }

        public function getMikerOcorrencia()
        {
            return $this->miker_Bo;
        }

        public function getSigoOcorrencia()
        {
            return $this->sigo_ocorrencia;
        }

        public function getTipificacaoOcorrencia()
        {
            return $this->tipificacao_crime;
        }

        public function getDiaOcorrencia()
        {
            return $this->dia_mes;
        }

        public function getEnderecoOcorrencia()
        {
            return $this->endereco_ocorrencia;
        }

        public function getBairroOcorrencia()
        {
            return $this->bairro_ocorrencia;
        }

        public function getCidadeOcorrencia()
        {
            return $this->cidade_ocorrencia;
        }
    }

?>