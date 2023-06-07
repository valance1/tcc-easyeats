<?php
require_once "FuncoesUteis.php";
require_once "../dao/conexaoBD.php";
require_once "../dao/empresaDAO.php";

// PASSO 1 - Receber os campos
$nome = $_POST["inputNome"];
$CNPJ = $_POST["inputCNPJ"];
$email = $_POST["inputEmail"];
$senha1 = $_POST["inputSenha1"];
$senha2 = $_POST["inputSenha2"];
$agencia = $_POST["inputAgencia"];
$conta = $_POST["inputConta"];

$conexao = conectarBD();

// Me recuso a comentar esse código, ele é mesma  coisa que o cadPessoa,php
if (strlen($email) == 0) {
  echo "Preencha seu email";
} else if (strlen($senha1) == 0 || strlen($senha2) == 0) {
  echo "Preencha sua senha";
} else if (strlen($agencia) == 0 or strlen($conta) == 0) {
  echo "Preencha seus dados bancários";
} else if (strlen($CNPJ) == 0) {
  echo "Preencha seu CNPJ";
} else if (validaCNPJ($CNPJ) == false) {
  echo 'CNPJ Inválido';
} else {
  $email = filter_var($email, FILTER_SANITIZE_EMAIL);
  if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
    echo "EMAIL INVÁLIDO";
    exit();
  }
  if ($senha1 != $senha2) {
    echo 'As SENHAS não correspondem';
    exit();
  }

  $sqlCode = "SELECT * FROM pessoa WHERE email = '$email'";
  $query = mysqli_query($conexao, $sqlCode);

  if (mysqli_num_rows($query) == 1) {
    echo "Já existe um  usuário com esse EMAIL";
    
  } else {

    $sqlCode = "SELECT * FROM empresa WHERE email = '$email' or cnpj = '$CNPJ' or conta='$conta'";
    $query = mysqli_query($conexao, $sqlCode);
    
    if (mysqli_num_rows($query) == 1) {
      echo "Já existe alguem com algum de seus dados.";
      
    } else {
      inserirEmpresa($conexao, $nome, md5($senha1), $email, $CNPJ, $agencia, $conta);
      header("Location:../../index.php?msg=Cadastro de $nome realizado com sucesso.");
    }
  }
}
?>