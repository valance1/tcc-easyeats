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

// Verificando se tudo está preenchido
if(checkVazio()){
  echo json_encode(array('msg' => "Preencha todos os campos!"));
  exit();
}

// Agora, vamos verificar se os dados são, de fato, válidos.
if (validaCPF($cpf) == false) {
  echo json_encode(array('msg' => "CPF Invalido"));
  exit();
}
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
  echo json_encode(array('msg' => "Email Invalido"));
  exit();
}
if ($senha1 != $senha2) {
  echo json_encode(array('msg' => "Senhas nao correspondem"));
  exit();
}
// Os dados são válidos, agora devemos verificar se as informações inseridas não pertencem a alguem que já foi cadastrado.
$sqlCode = "SELECT * FROM pessoa WHERE email = '$email' OR cpf ='$cpf'";
$query = mysqli_query($conexao, $sqlCode);

// Selecionamos todas as pessoas com o email ou CPF, nossas PKs, se houver uma coluna, significa que alguém com essa 
// chave primária já foi cadastrada, portanto, devemos impedir o cadastro.
if (mysqli_num_rows($query) == 1) {
  echo json_encode(array('msg' => "Usuario com esse e-mail ou CPF já existe"));
  exit();
  // Verificamos somente as pessoas, mas também devemos verificar se existe alguma empresa com determinado email:
} else {

  // Fazendo a mesma coisa aqui.
  $sqlCode = "SELECT * FROM empresa WHERE email = '$email'";
  $query = mysqli_query($conexao, $sqlCode);

  if (mysqli_num_rows($query) == 1) {
    echo json_encode(array('msg' => "Usuario com esse e-mail já existe"));
    exit();

    // Se não existe ninguém com o email no nosso sistema, vamos inserir a pessoa pelo nosso DAO.
  } else {
    inserirPessoa($conexao, $nome, md5($senha1), $email, $cpf);
    $_SESSION['email'] = $email;
    // header("Location:../../index.php?msg=Cadastro de $nome realizado com sucesso.&toast=sucesso");
    $_SESSION['toast'] = 'sucesso';
    $_SESSION['toastmsg'] = 'Usuário cadastrado com sucesso';
    echo json_encode(array('msg' => "Sucesso no cadastro"));
  }
}

?>