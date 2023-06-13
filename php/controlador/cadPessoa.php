<?php
require_once "FuncoesUteis.php";
require_once "../dao/conexaoBD.php";
require_once "../dao/pessoaDAO.php";

session_start();

// PASSO 1 - Receber os campos
$nome = $_POST["inputNome"];
$cpf = $_POST["inputCPF"];
$email = $_POST["inputEmail"];
$senha1 = $_POST["inputSenha1"];
$senha2 = $_POST["inputSenha2"];
$conexao = conectarBD();

// Antes de enviarmos os dados para o BD, devemos verificar os possíveis erros
// O primeiro deles é verificar se os campos preenchidos estão vazios.
if (strlen($email) == 0) {
  echo "Preencha seu email";
} else if (strlen($senha1) == 0 || strlen($senha2) == 0) {
  echo "Preencha sua senha";
} else if (strlen($cpf) == 0) {
  echo "Preencha seu CPF";
  
  // Agora, vamos verificar se os dados são, de fato, válidos.
} else if (validaCPF($cpf) == false) {
  echo 'CPF Inválido';
} else {
  $email = filter_var($email, FILTER_SANITIZE_EMAIL);
  
  // Optei por utilizar o exit() para evitar os else else else else...
  // A função exit() para de  rodar o código. Talvez seja necessário mudar isso.
  if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
    echo "EMAIL INVÁLIDO";
    exit();
  }
  if ($senha1 != $senha2) {
    echo 'As SENHAS não correspondem';
    exit();
  }
  
  // Os dados são válidos, agora devemos verificar se as informações inseridas não pertencem a alguem que já foi cadastrado.
  $sqlCode = "SELECT * FROM pessoa WHERE email = '$email' OR cpf ='$cpf'";
  $query = mysqli_query($conexao, $sqlCode);
  
  // Selecionamos todas as pessoas com o email ou CPF, nossas PKs, se houver uma coluna, significa que alguém com essa 
  // chave primária já foi cadastrada, portanto, devemos impedir o cadastro.
  if (mysqli_num_rows($query) == 1) {
    echo "Esse usuário já existe";
    
    // Verificamos somente as pessoas, mas também devemos verificar se existe alguma empresa com determinado email:
  } else {
    
    // Fazendo a mesma coisa aqui.
    $sqlCode = "SELECT * FROM empresa WHERE email = '$email'";
    $query = mysqli_query($conexao, $sqlCode);
    
    if (mysqli_num_rows($query) == 1) {
      echo "Esse usuário já existe";
      
    // Se não existe ninguém com o email no nosso sistema, vamos inserir a pessoa pelo nosso DAO.
    } else {
      inserirPessoa($conexao, $nome, md5($senha1), $email, $cpf);
      $_SESSION['email'] = $email;
      $_SESSION['senha'] = $senha;
      header("Location:../../index.php?msg=Cadastro de $nome realizado com sucesso.&toast=sucesso");
      
    }
  }
}
?>