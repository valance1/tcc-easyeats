<?php
function inserirEmpresa($conexao, $nome, $senha, $email, $cnpj, $agencia, $conta ){
  $sql = "INSERT INTO empresa (nome, CNPJ, email, senha, agencia, conta) VALUES ( '$nome', '$cnpj', '$email', '$senha', '$agencia', '$conta')";
  mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
}
function alterarFotoEmpresa($conexao, $path, $cnpj){
  $sql = "UPDATE empresa SET perfil='$path' WHERE cpf='$cnpj'";
  mysqli_query($conexao, $sql) or die(mysqli_error($conexao));

}
function alterarAgenciaEmpresa($conexao, $agencia, $cnpj){

  $sql = "UPDATE empresa SET agencia='$agencia' WHERE cpf='$cnpj'";
  mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
}
function alterarContaEmpresa($conexao, $conta, $cnpj){
  $sql = "UPDATE empresa SET conta='$conta' WHERE cpf='$cnpj'";
  mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
}
function pesquisarNome($nome){

}
function pesquisarCNPJ($cnpj){

}
?>