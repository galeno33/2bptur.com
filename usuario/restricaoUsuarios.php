<?php
   
   
   // Definir o caminho absoluto para o diretório raiz do projeto
   define('ROOT_DIR', dirname(__DIR__));
   
   // Incluir o arquivo de conexão usando o caminho absoluto
   require_once(ROOT_DIR . '/conexao/conexao_01.php');
   
   class RestricaoDeUsuario {
       
       private $conn;
       private $idUsuario;
       private $conexao;
       private $nomecompleto;
       private $nome_de_guerra;
       private $situacao;
       private $classe;
       private $funcao;
       private $posto;
       private $telefone;
       private $senha;
       private $bpm;
       private $ciaRestrito;
       private $chave;
   
       public function __construct() {
           $this->conexao = new Conexao();
           $this->conn = $this->conexao->getConexao();
       }
   
       public function restricao() {
           // Iniciar sessão se ainda não foi iniciada
           if (session_status() == PHP_SESSION_NONE) {
               session_start();
           }
           // Verificar se a variável de sessão 'matricula' está definida
           if (!isset($_SESSION['matricula'])) {
               throw new Exception("Matrícula não definida na sessão.");
           }
   
           $usuario = $_SESSION['matricula'];
           
           // Use prepared statements para evitar injeção de SQL
           $stmt = $this->conn->prepare("SELECT id, nome_completo, nome_de_guerra, posto_usuario, classe_usuario, funcao_usuario, telefone_usuario, senha_usuario, unidade_usuario, cia, token_confirmacao, situacao FROM usuario WHERE id = ?");
           $stmt->bind_param("i", $usuario);
   
           if ($stmt->execute()) {
               $result = $stmt->get_result();
               if ($result->num_rows > 0) {
                   $rowRestricao = $result->fetch_assoc();
                   $this->idUsuario = $rowRestricao['id'];
                   $this->nomecompleto = $rowRestricao['nome_completo'];
                   $this->nome_de_guerra = $rowRestricao['nome_de_guerra'];
                   $this->situacao = $rowRestricao['situacao'];
                   $this->classe = $rowRestricao['classe_usuario'];
                   $this->funcao = $rowRestricao['funcao_usuario'];
                   $this->posto = $rowRestricao['posto_usuario'];
                   $this->telefone = $rowRestricao['telefone_usuario'];
                   $this->senha = $rowRestricao['senha_usuario'];
                   $this->bpm = $rowRestricao['unidade_usuario'];
                   $this->ciaRestrito = $rowRestricao['cia'];
                   $this->chave = $rowRestricao['token_confirmacao'];
               } else {
                   // Lidar com o caso em que nenhum resultado é encontrado
                   throw new Exception("Usuário não encontrado.");
               }
           } else {
               // Lidar com erros na execução da consulta
               throw new Exception("Erro ao executar a consulta: " . $stmt->error);
           }
   
           // Fechar a declaração
           $stmt->close();
       }
   
       public function getIdUsuario(){
           return $this->idUsuario;
       }
   
       public function getNomeCompleto() {
           return $this->nomecompleto;
       }
   
       public function getNomeGuerra() {
           return $this->nome_de_guerra;
       }
   
       public function getSituacao() {
           return $this->situacao;
       }
   
       public function getClasse() {
           return $this->classe;
       }
   
       public function getFuncao() {
           return $this->funcao;
       }
   
       public function getPosto(){
           return $this->posto;
       }
   
       public function getTelefone(){
           return $this->telefone;
       }
   
       public function getSenha(){
           return $this->senha;
       }
   
       public function getBpm(){
           return $this->bpm;
       }
   
       public function getCiaRestrito() {
           return $this->ciaRestrito;
       }
   
       public function getChave(){
           return $this->chave;
       }
   }
?>
