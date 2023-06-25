<?php
require_once "FuncoesUteis.php";
require_once "../dao/conexaoBD.php";
require_once "../dao/empresaDAO.php";

session_start();

// PASSO 1 - Receber os campos
$dono = $_POST["inputDono"];
$cpf = $_POST["inputCPF"];
$nome = $_POST["inputNome"];
$CNPJ = $_POST["inputCNPJ"];
$email = $_POST["inputEmail"];
$senha1 = $_POST["inputSenha1"];
$senha2 = $_POST["inputSenha2"];
$agencia = $_POST["inputAgencia"];
$conta = $_POST["inputConta"];

$conexao = conectarBD();

// TODO:
// Escrever uma array que vai adicionando os erros, depois ir adicionando uma resposta 1por 1 via js.
// $myObj->name = "John";
// $myObj->age = 30;
// $myObj->city = "New York";


// Me recuso a comentar esse código, ele é mesma  coisa que o cadPessoa,php
if (validaCNPJ($CNPJ) == false) {
  echo json_encode(array('msg' => "CNPJ Invalido"));
    exit();
}
if (validaCPF($cpf) == false){
  echo json_encode(array('msg' => "CPF Invalido"));
    exit();
}

else {
  $email = filter_var($email, FILTER_SANITIZE_EMAIL);
  if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
    echo json_encode(array('msg' => "Email invalido"));
    exit();
  }
  if ($senha1 != $senha2) {
    echo json_encode(array('msg' => "As senhas nao correspondem"));
    exit();
  }

  // Empresas nunca podem ter o email de uma pessoa
  $sqlCode = "SELECT * FROM pessoa WHERE email = '$email'";
  $query = mysqli_query($conexao, $sqlCode);

  if (mysqli_num_rows($query) >= 1) {
    echo json_encode(array('msg' => "Usuario com esse e-mail ja existe"));
    exit();
  } else {

    $sqlCode = "SELECT * FROM empresa WHERE email = '$email' or cnpj = '$CNPJ' or conta='$conta'";
    $query = mysqli_query($conexao, $sqlCode);
    
    if (mysqli_num_rows($query) >= 1) {
      echo json_encode(array('msg' => "Usuario ja existe"));
      exit();

    } else {
      inserirEmpresa($conexao, $nome, md5($senha1), $email, $CNPJ, $agencia, $conta, $dono, $cpf);
      // header("Location:../../index.php?msg=Cadastro de $nome realizado com sucesso.&toast=sucesso");
      $_SESSION['email'] = $email;
      $_SESSION['empresa'] = true;

      echo json_encode(array('msg' => "Sucesso no cadastro"));
    }
  }
}
?>