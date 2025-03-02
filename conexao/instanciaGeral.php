<?php

    require_once('conexao_01.php');

    class InstanciaGeral {
        private $conexao;

        /*public function __construct() {
            $this->conexao = Conexao::getInstance();
        }*/

        public function getConexao() {
            return $this->conexao->getConexao();
        }
    }

?>