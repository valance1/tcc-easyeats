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
$conexao = conectarBD();
 	
$username_error = null; 
$email_error = null;   
$password_error = null; 
$password2_error = null; 
$CPF = null; 

if (strlen($email) == 0) {
  echo "Preencha seu email";
} else if (strlen($senha1) == 0 || strlen($senha2) == 0) {
  echo "Preencha sua senha";
} else if (strlen($cpf) == 0) {
  echo "Preencha seu CPF";
} else if (validaCPF($cpf) == false) {
  echo 'CPF Inválido';
} else { //VERIFICANDO SE ALGUEM Jà TEM ESSE LOGIN
  $email = filter_var($email, FILTER_SANITIZE_EMAIL);
  if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
    echo "EMAIL INVÁLIDO";
    exit();
  }
  if ($senha1 != $senha2) {
    echo 'As SENHAS não correspondem';
    exit();
  }
  // PEGANDO OS USERS
  $sqlCode = "SELECT * FROM pessoa WHERE email = '$email' OR cpf ='$cpf'";
  $query = mysqli_query($conexao, $sqlCode);
  // VERIFICANDO BUSCAS
  if (mysqli_num_rows($query) == 1) {
    echo "Esse usuário já existe";
  } else {
    // Verificar a possibilidade de haver uma empresa com o email
    $sqlCode = "SELECT * FROM empresa WHERE email = '$email'";
    $query = mysqli_query($conexao, $sqlCode);
    if (mysqli_num_rows($query) == 1) {
      echo "Esse usuário já existe";
    } else { //CASO NÃO EXISTA NINGUEM COM O EMAIL:
      inserirPessoa($conexao, $nome, md5($senha1), $email, $cpf);
      header("Location:../../index.php?msg=Cadastro de $nome realizado com sucesso.");
    }
  }
}
?>