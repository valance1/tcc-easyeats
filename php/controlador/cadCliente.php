<?php
    require_once "FuncoesUteis.php";
    require_once "../dao/conexaoBD.php";
    require_once "../dao/pessoaDAO.php";

    // PASSO 1 - Receber os campos
    $nome = cleanInjection($_POST["inputNome"]);
    $cpf = cleanInjection($_POST["inputCPF"]);
    $email = cleanInjection($_POST["inputEmail"]);
    $senha1 = cleanInjection($_POST["inputSenha1"]);
    $senha2 = cleanInjection($_POST["inputSenha2"]);
    
    
    // VERIFICANDO INPUTS
    
      if(strlen($email)==0){
        echo "Preencha seu email";
      } else if(strlen($senha) == 0){
        echo "Preencha sua senha";
      } else if(strlen($cpf) == 0){
        echo "Preencha seu CPF";
      }else{ //VERIFICANDO SE ALGUEM Jà TEM ESSE LOGIN
        
        // PEGANDO OS USERS
        $sqlCode = 'SELECT * FROM pessoa WHERE email = ' .  $email . ' OR cpf =' .$cpf;
        $query = mysql_query(conexaoBD(), $sqlCode);
        
        // VERIFICANDO BUSCAS
        if( $query->num_rows == 1){
          echo "Esse usuário já existe";
        }else{
          
            // Verificar a possibilidade de haver uma empresa com o email
            $sqlCode = 'SELECT * FROM empresa WHERE email = ' . $email;
            $query = mysql_query(conexaoBD(), $sqlCode);
            if($query->num_rows == 1){
              echo "Esse usuário já existe";
            }else{ //CASO NÃO EXISTA NINGUEM COM O EMAIL:
              
              $conexao = conectarBD();
              inserirPessoa($conexao, $nome, $senha1, $email, $cpf);
              // header("Location:../visao/formulario.php?msg=Cadastro de $nome realizado com sucesso.");
            }
        }
      }
    }
?>

