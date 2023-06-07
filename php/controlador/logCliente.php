<?php
require_once "FuncoesUteis.php";
require_once "../dao/conexaoBD.php";

session_start();

// PASSO 1 - Receber os campos
$email = $_POST["inputEmail"];
$senha = $_POST["inputSenha"];


// VERIFICANDO INPUTS

if (strlen($email) == 0) {
  echo "Preencha seu email";
} else if (strlen($senha) == 0) {
  echo "Preencha sua senha";
} else {

  // PEGANDO OS USERS
  $senha = md5($senha);
  $sqlCode = "SELECT * FROM pessoa WHERE email = '$email' AND senha ='$senha'";
  $query = mysqli_query(conectarBD(), $sqlCode);

  // VERIFICANDO BUSCAS
  if (mysqli_num_rows($query) == 1) {
    $_SESSION['email'] = $email;
    $_SESSION['senha'] = $senha;
    header("Location:../../index.php?msg=Login sucesso.");
  } else {
    $sqlCode = "SELECT * FROM empresa WHERE email = '$email' AND senha ='$senha'";
    $query = mysqli_query(conectarBD(), $sqlCode);
    if (mysqli_num_rows($query) == 1) {
      $_SESSION['email'] = $email;
      $_SESSION['senha'] = $senha;
      $_SESSION['empresa'] = true;
      header("Location:../../index.php?msg=Login sucesso.");
    } else {
      header("Location:../../index.php?msg=Login incorreto.");
    }
  }
}
?>