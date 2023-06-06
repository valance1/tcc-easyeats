<?php
function inserirProduto($conexao, $nome, $descricao, $email, $preço)
{
        // Tem que tirar esse post...
        
        $sql = "INSERT INTO produto (nome, descricao, preço) VALUES ('$nome', '$descricao', '$preço')";
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