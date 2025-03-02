<?php

    require_once('../conexao/conexao_01.php');
    require_once('../usuario/usuario.php');

    class SelectUsuario{
        private $conexao;

        public function __construct() {
            $this->conexao = new Conexao();
        }
        
        public function selectUsuario($matricula, $senha) {
            $conn = $this->conexao->getConexao();
           
            // Aqui você precisa escrever a lógica de consulta para verificar as credenciais no banco de dados
            // Substitua este espaço reservado pelo seu código real de consulta
            // Lembre-se de proteger contra injeção de SQL usando prepared statements
    
            // Exemplo hipotético de código de consulta:
            $query = "SELECT * FROM usuario WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $matricula);
            $stmt->execute();
            $resultado = $stmt->get_result();
    
            // Verifica se encontrou algum usuário com as credenciais fornecidas
            if ($resultado->num_rows > 0) {
                //encotrar o usuario
                $usuario = $resultado->fetch_assoc();
                
                //verifica se a senha fornecida corresponde à senha criptografada no banco de dados
                if(password_verify($senha, $usuario['senha_usuario'])){
                    // Credenciais válidas
                    return true;
                } else{
                    return false; //senha incorreta
                }
            } else {
                // Credenciais inválidas
                return false;
            }
            
        }

        public function insertUsuario($matricula, $nome, $nomeGuerra, $posto, $classe, $funcao, $telefone, $senha, $cia, $situacao) {
            $conn = $this->conexao->getConexao();
            
            // Cria um hash seguro da senha
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
            
            // Consulta SQL para inserir um novo usuário
            $sqlInsert = "INSERT INTO usuario (`id`, `nome_completo`, `nome_de_guerra`, `posto_usuario`, `classe_usuario`, `funcao_usuario`, `telefone_usuario`, `senha_usuario`, `cia`, `situacao`)
                          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            // Prepara a declaração SQL
            $stmt = mysqli_prepare($conn, $sqlInsert);
            
            if ($stmt) {
                // Vincula os parâmetros à declaração preparada
                mysqli_stmt_bind_param($stmt, 'isssssssis', $matricula, $nome, $nomeGuerra, $posto, $classe, $funcao, $telefone, $senhaHash, $cia, $situacao);
                
                // Executa a declaração preparada
                $result = mysqli_stmt_execute($stmt);
                
                // Verifica se a execução foi bem-sucedida
                if ($result) {
                    // Sucesso: redireciona para a página de confirmação de cadastro
                    header('Location: http://localhost/projetos/1Bptur/confirCadastroUsuario.php');
                    exit();
                } else {
                    // Falha: redireciona para a página de erro de cadastro
                    header('Location: http://localhost/projetos/1Bptur/erroCadasttroUsuario.php');
                    exit();
                }
                
                // Fecha a declaração preparada
                mysqli_stmt_close($stmt);
            } else {
                // Erro na declaração preparada: retorna uma mensagem de erro
                echo "Erro na declaração preparada: " . mysqli_error($conn);
            }
            
            // Fecha a conexão com o banco de dados
            mysqli_close($conn);
        }
        
    }
    

?>