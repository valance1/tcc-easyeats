<?php
require_once "FuncoesUteis.php";
require_once "../dao/conexaoBD.php";
require_once "../dao/empresaDAO.php";

session_start();

// PASSO 1 - Receber os campos
$campos = $_POST;
$campos = array_map("trim", $campos);

extract($campos);

$conexao = conectarBD();

// Validação de CNPJ
if (!validaCNPJ($inputCNPJ)) {
  echo json_encode(array('msg' => "CNPJ Inválido"));
  exit();
}

// Validação de CPF
if (!validaCPF($inputCPF)) {
  echo json_encode(array('msg' => "CPF Inválido"));
  exit();
}

// Validação de Email
$inputEmail = filter_var($inputEmail, FILTER_SANITIZE_EMAIL);
if (!filter_var($inputEmail, FILTER_VALIDATE_EMAIL)) {
  echo json_encode(array('msg' => "Email inválido"));
  exit();
}

// Verificação de senhas correspondentes
if ($inputSenha1 != $inputSenha2) {
  echo json_encode(array('msg' => "As senhas não correspondem"));
  exit();
}

// Verificação de existência de email em tabela pessoa
$sqlCode = "SELECT * FROM pessoa WHERE email = '$inputEmail'";
$query = mysqli_query($conexao, $sqlCode);
if (mysqli_num_rows($query) >= 1) {
  echo json_encode(array('msg' => "Usuário com esse e-mail já existe"));
  exit();
}

// Verificação de existência de email, CNPJ ou conta em tabela empresa
$sqlCode = "SELECT * FROM empresa WHERE email = '$inputEmail' or cnpj = '$inputCNPJ' or conta='$inputConta'";
$query = mysqli_query($conexao, $sqlCode);
if (mysqli_num_rows($query) >= 1) {
  echo json_encode(array('msg' => "Usuário já existe"));
  exit();
}

// Inserção de dados na tabela empresa
inserirEmpresa($conexao, $inputNome, md5($inputSenha1), $inputEmail, $inputCNPJ, $inputAgencia, $inputConta, $inputDono, $inputCPF);
$_SESSION['email'] = $inputEmail;
$_SESSION['empresa'] = true;

echo json_encode(array('msg' => "Sucesso no cadastro"));
?>