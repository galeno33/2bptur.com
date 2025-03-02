<?php
    class Usuario{
        private $id;
        private $nome;
        private $nomeGuerra;
        private $funcao;
        private $classe;
        private $posto;
        private $senha;
        private $matricula;
        private $telefone;
        private $situacao;

        public function __construct($id, $nome, $nomeGuerra, $funcao, $classe, $posto, $senha, $matricula, $telefone, $situacao)
        {
            $this->id = $id;
            $this->nome = $nome;
            $this->nomeGuerra = $nomeGuerra;
            $this->funcao = $funcao;
            $this->classe = $classe;
            $this->posto = $posto;
            $this->senha = $senha;
            $this->matricula = $matricula;
            $this->telefone = $telefone;
            $this->situacao = $situacao;
        }
        //metodo get
        public function getId(){
            return $this->id;
        }
        
        public function getNome(){
            return $this->nome;
        }
        public function getNomeGuerra(){
            return $this->nomeGuerra;
        }
        public function getFuncao(){
            return $this->funcao;
        }
        public function getClasse(){
            return $this->classe;
        }
        public function getPosto(){
            return $this->posto;
        }
        public function getSenha(){
            return $this->senha;
        }
        public function getMatricula(){
            return $this->matricula;
        }
        public function getTelefone(){
            return $this->telefone;
        }
        public function getSituacao(){
            return $this->situacao;
        }
        //metodos set 
        //parametro $s representa passar o valor $senha para $s
        public function setNome($n){
            $this->nome = $n;
        }
        //parametro $m representa passar o valor $matricula para $m
        public function setNomeGuerra($ng){
            $this->nomeGuerra = $ng;
        }
        public function setFuncao($f){
            $this->funcao = $f;
        }
        public function setClasse($c){
            $this->classe = $c;
        }
        public function setPosto($p){
            $this->posto = $p;
        }
        public function setSenha($s){
            $this->senha = $s;
        }
        public function setMatricula($m){
            $this->matricula = $m;
        }
        public function setTelefone($t){
            $this->telefone = $t;
        }
        public function setSituacao($st){
            $this->situacao = $st;
        }
        

    }



?>