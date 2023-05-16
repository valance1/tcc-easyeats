<?php
function inserirProduto($conexao, $nome, $descricao, $email, $preço)
{
        // LIMPANDO SQL INJECTION
        $email = $conexao->real_escape_string($_POST['email']);
        $preço = $conexao->real_escape_string($_POST['preço']);
        $descricao = $conexao->real_escape_string($_POST['descricao']);
        $nome = $conexao->real_escape_string($_POST['nome']);
        
        $sql = "INSERT INTO produto (nome, descricao, email, preço, agencia, conta) VALUES ( '$nome', '$descricao', '$email', '$preço') ";
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