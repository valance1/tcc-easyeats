<?php
function inserirPessoa($conexao, $nome, $senha, $email, $cpf)
{
        // LIMPANDO SQL INJECTION
        $email = $conexao->real_escape_string($_POST['email']);
        $senha = $conexao->real_escape_string($_POST['senha']);
        
        $sql = "INSERT INTO pessoa (nome, cpf, email, senha) VALUES ( '$nome', '$cpf', '$email', '$senha' ) ";
        mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
}
function alterarPessoa(){

}
function excluirPessoa(){


}
function pesquisarNome(){

}
function pesquisarCPF(){

}
?>