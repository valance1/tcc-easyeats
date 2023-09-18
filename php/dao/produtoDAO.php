<?php
function inserirProduto($conexao, $nome, $descricao, $preco, $cnpj, $path)
{
  $sql = "INSERT INTO produto (nome, descricao, preco, imagem, cnpj) VALUES ('$nome', '$descricao', '$preco', '$path', '$cnpj')";
  mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
}
function alterarDispoProduto($conexao, $id, $dispo){
  $sql =  "UPDATE produto SET disponivel='$dispo' WHERE idProduto='$id'";
  mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
}
function excluirProduto($conexao, $idProduto){
  $code = "DELETE FROM produto WHERE idProduto = '$idProduto'";
  mysqli_query($conexao, $code) or die(mysqli_error($conexao));
}

function alterarFotoProduto($conexao, $imagem, $id){
  $sql = "UPDATE produto SET imagem='$imagem' WHERE idProduto='$id'";
  mysqli_query($conexao, $sql) or die(mysqli_error($conexao));

}
function alterarNomeProduto($conexao, $nome, $id){
  $sql = "UPDATE produto SET nome='$nome' WHERE idProduto='$id'";
  mysqli_query($conexao, $sql) or die(mysqli_error($conexao));

}
function alterarDescProduto($conexao, $desc, $id){
  $sql = "UPDATE produto SET descricao='$desc' WHERE idProduto='$id'";
  mysqli_query($conexao, $sql) or die(mysqli_error($conexao));

}
function alterarPrecoProduto($conexao, $preco, $id){
  $sql = "UPDATE produto SET preco='$preco' WHERE idProduto='$id'";
  mysqli_query($conexao, $sql) or die(mysqli_error($conexao));

}
function pesquisarNome(){

}
function pesquisardescricao(){

}
?>