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
function adicionarLucro($conexao, $cnpj, $valor){

  // Atualizando o lucro com o que ja tinha
  $sqlCode = "SELECT * FROM empresa WHERE CNPJ = '$cnpj'";
  $query = mysqli_query($conexao, $sqlCode);
  $lucroAtual = mysqli_fetch_assoc($query)['lucro'];
  $valorTotal = $lucroAtual + $valor;

  $sql = "UPDATE empresa SET lucro='$valorTotal' WHERE cnpj='$cnpj'";
  mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
}
function pesquisarCNPJ($cnpj){

}
?>