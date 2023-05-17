<?php
function inserirProduto($conexao, $nome, $descricao, $email, $preço)
{
        // LIMPANDO SQL INJECTION
        $email = $conexao->real_escape_string($email);
        $preço = $conexao->real_escape_string($preço);
        $descricao = $conexao->real_escape_string($descricao);
        $nome = $conexao->real_escape_string($nome);
        
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