<?php
require_once('../select_insert_usuario/select_insert.php');

class Inserir {
    private $inserirUsuario;

    public function __construct() {
        $this->inserirUsuario = new SelectUsuario();
    }

    public function inserirUsuarios() {
        if(isset($_POST['salvar'])) {
            // Validar se todos os campos estão preenchidos
            $campos = ['inputMatricula', 'inputNome', 'inputGuerra', 'inputPosto', 'inputClasse', 'inputFuncao', 'inputTelefone', 'inputSenha', 'inputCia'];
            foreach ($campos as $campo) {
                if (empty($_POST[$campo])) {
                    echo "Preencha todos os dados";
                    return false;
                }
            }

            // Sanitizar e coletar dados do formulário
            $nome = filter_var($_POST['inputNome'], FILTER_SANITIZE_STRING);
            $matricula = filter_var($_POST['inputMatricula'], FILTER_SANITIZE_STRING);
            $nomeGuerra = filter_var($_POST['inputGuerra'], FILTER_SANITIZE_STRING);
            $posto = $_POST['inputPosto']; // Não é necessário sanitizar
            $classe = $_POST['inputClasse']; // Não é necessário sanitizar
            $funcao = $_POST['inputFuncao']; // Não é necessário sanitizar
            $telefone = $_POST['inputTelefone']; // Não é necessário sanitizar
            $senha = $_POST['inputSenha']; // Não é necessário sanitizar
            $companhia = $_POST['inputCia']; // Não é necessário sanitizar
            $situacao = ($_POST['flexRadioDefault'] == 1) ? "habilitado" : "desabilitado";

            // Lançar o posto/patente, classe e função (conforme necessário)
            //lançar o posto/patente
            switch($posto){
                case 1:
                    $posto = "SOLDADO";
                break;
                case 2:
                    $posto = "CABO";
                break;
                case 3:
                    $posto = "3º SARGENTO";
                break;
                case 4:
                    $posto = "2º SARGENTO";
                break;
                case 5:
                    $posto = "1º SARGENTO";
                break;
                case 6:
                    $posto = "SUB TENENTE";
                break;
                case 7:
                    $posto = "2º TENENTE";
                break;
                case 8:
                    $posto = "1º TENENTE";
                break;
                case 9:
                    $posto = "CAPITÃO";
                break;
                case 10:
                    $posto = "MAJOR";
                break;
                case 11:
                    $posto = "TENENTE CORONEL";
                break;
                case 12:
                    $posto = "CORONEL";
            }
            //lançar a classe
            switch($classe){
                case 1:
                    $classe = "OFICIAL";
                break;
                case 2:
                    $classe = "PRAÇA";
                
            }
            //lançar a função
            switch($funcao){
                case 1:
                    $funcao = "Cmd. de Batalhão";
                break;
                case 2:
                    $funcao = "Sub. Cmd de Batalhão";
                break;
                case 3:
                    $funcao = "Cmd de Cia";
                break;
                case 4:
                    $funcao = "Sub. Cmd de Cia";
                break;
                case 5:
                    $funcao = "Cmd do P1";
                break;
                case 6:
                    $funcao = "Cmd do P2";
                break;
                case 7:
                    $funcao = "Cmd do P3";
                break;
                case 8:
                    $funcao = "Cmd do P4";
                break;
                case 9:
                    $funcao = "Combatente";
                
            }
            //lançar a companhia
            switch($companhia){
                case 1:
                    $companhia = 1;
                break;
                case 2:
                    $companhia = 2;
                break;
                case 3:
                    $companhia = 3;
                break;
                case 4:
                    $companhia = 4;
            }
            // Tentar inserir o usuário no banco de dados
            if($this->inserirUsuario->insertUsuario($matricula, $nome, $nomeGuerra, $posto, $classe, $funcao, $telefone, $senha, $companhia, $situacao,)){
                // Sucesso: redireciona para a página de confirmação de cadastro
                header("Location: http://localhost/projetos/1Bptur/confirCadastroUsuario.php");
                exit();
            } else {
                // Falha ao inserir usuário
                echo "Erro ao inserir usuário";
                return false;
            }
        } else {
            // Se o formulário não foi enviado, retorna false
            return false;
        }
    }
}

// Instanciando a classe Login
$inserir = new Inserir();

// Verificando se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Chamando o método fazerLogin para realizar a autenticação
    $resultado = $inserir->inserirUsuarios();

    if ($resultado === false) {
        // Se o login falhar, você pode exibir uma mensagem de erro, redirecionar para uma página de erro ou fazer qualquer outra ação necessária.
        echo "Credenciais inválidas. Por favor, tente novamente.";
    }
}

?>