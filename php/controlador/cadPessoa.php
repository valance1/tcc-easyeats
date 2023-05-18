<?php
require_once "FuncoesUteis.php";
require_once "../dao/conexaoBD.php";
require_once "../dao/pessoaDAO.php";

// PASSO 1 - Receber os campos
$nome = $_POST["inputNome"];
$cpf = $_POST["inputCPF"];
$email = $_POST["inputEmail"];
$senha1 = $_POST["inputSenha1"];
$senha2 = $_POST["inputSenha2"];
// PASSO 3 - Inserir/Alterar dados no banco
$conexao = conectarBD();
// INSERIR

// PASSO 4 - Resposta de SUCESSO       
// header("Location:../visao/formulario.php?msg=Cadastro de $nome realizado com sucesso.");
if(strlen($email)==0){
        echo "Preencha seu email";
      } else if(strlen($senha1) == 0 || strlen($senha2) == 0){
        echo "Preencha sua senha";
      } else if(strlen($cpf) == 0){
        echo "Preencha seu CPF";
      }else if(validaCPF($cpf) == false){
        echo 'CPF Inválido';
      }else{ //VERIFICANDO SE ALGUEM Jà TEM ESSE LOGIN
        
        // PEGANDO OS USERS
        $sqlCode = 'SELECT * FROM pessoa WHERE email = ' .  $email . ' OR cpf =' .$cpf;
        $query = mysqli_query($conexao, $sqlCode);
        // VERIFICANDO BUSCAS
        if($mysqli_num_rows($query) == 1){
          echo "Esse usuário já existe";
        }else{
            // Verificar a possibilidade de haver uma empresa com o email
            $sqlCode = 'SELECT * FROM empresa WHERE email = ' . $email;
            $query = mysqli_query($conexao, $sqlCode);
            if($mysqli_num_rows($query) == 1){
              echo "Esse usuário já existe";
            }else{ //CASO NÃO EXISTA NINGUEM COM O EMAIL:
              $conexao = conectarBD();
              inserirPessoa($conexao, $nome, $senha1, $email, $cpf);
              // header("Location:../visao/formulario.php?msg=Cadastro de $nome realizado com sucesso.");
            }
        }
      }
?>