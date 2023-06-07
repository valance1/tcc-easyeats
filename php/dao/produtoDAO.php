<?php
function inserirProduto($conexao, $nome, $descricao, $preco, $cnpj, $path)
{
  $sql = "INSERT INTO produto (nome, descricao, preco, imagem, cnpj) VALUES ('$nome', '$descricao', '$preco', '$path', '$cnpj')";
  mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
}
function alterarProduto(){

}
function excluirProduto(){


}
function pesquisarNome(){

}
function pesquisardescricao(){

}
?>