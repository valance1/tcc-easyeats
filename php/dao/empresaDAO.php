<?php
function inserirEmpresa($conexao, $nome, $senha, $email, $cnpj, $agencia, $conta, $dono, $cpf){
  $sql = "INSERT INTO empresa (nome, CNPJ, email, senha, agencia, conta, dono, cpf) VALUES ( '$nome', '$cnpj', '$email', '$senha', '$agencia', '$conta', '$dono', '$cpf')";
  mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
}
function alterarFotoEmpresa($conexao, $path, $cnpj){
  $sql = "UPDATE empresa SET perfil='$path' WHERE cnpj='$cnpj'";
  mysqli_query($conexao, $sql) or die(mysqli_error($conexao));

}
function alterarAgenciaEmpresa($conexao, $agencia, $cnpj){

  $sql = "UPDATE empresa SET agencia='$agencia' WHERE cnpj='$cnpj'";
  mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
}
function alterarContaEmpresa($conexao, $conta, $cnpj){
  $sql = "UPDATE empresa SET conta='$conta' WHERE cnpj='$cnpj'";
  mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
}
function pesquisarNome($nome){

}
function pesquisarCNPJ($cnpj){

}
?>