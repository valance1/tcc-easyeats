<?php
function inserirEmpresa($conexao, $nome, $senha, $email, $CNPJ, $agencia, $conta ){
  $sql = "INSERT INTO empresa (nome, CNPJ, email, senha, agencia, conta) VALUES ( '$nome', '$CNPJ', '$email', '$senha', '$agencia', '$conta')";
  mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
}
function alterarEmpresa($nome){

}

function pesquisarNome($nome){

}
function pesquisarCNPJ($cnpj){

}
?>