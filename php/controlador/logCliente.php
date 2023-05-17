<?php
    require_once "FuncoesUteis.php";
    require_once "../dao/conexaoBD.php";
    require_once "../dao/pessoaDAO.php";

    // PASSO 1 - Receber os campos
    $email = clearInjection($_POST["inputEmail"]);
    $senha = clearInjection($_POST["inputSenha"]);
    
    
    // VERIFICANDO INPUTS
    
      if(strlen($email)==0){
        echo "Preencha seu email";
      } else if(strlen($senha) == 0){
        echo "Preencha sua senha";
      }else{ //VERIFICANDO SE ALGUEM Jà TEM ESSE LOGIN
        
        // PEGANDO OS USERS
        $sqlCode = 'SELECT * FROM pessoa WHERE email = ' .  $email . ' AND cpf =' .  $senha;
        $query = mysql_query(conexaoBD(), $sqlCode);
        
        // VERIFICANDO BUSCAS
        if( $query->num_rows == 1){
          // FAZER LOGIN, INICIAR SESSÃO
          $_SESSION['email'] = $email;
          $_SESSION['senha'] = $senha;
          /// header('');
          
        }else{
          echo 'Senha incorreta';
          // header("Location:../visao/formulario.php?msg=Cadastro de $nome realizado com sucesso.");
        };
      };
?>

