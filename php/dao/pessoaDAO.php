<?php
function inserirPessoa($conexao, $nome, $senha, $email, $cpf)
{
        $sql = "INSERT INTO pessoa (nome, cpf, email, senha) VALUES ('$nome', '$cpf', '$email', '$senha')";
        mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
}
function excluirPessoa()
{

}
function pesquisarNome()
{

}
function pesquisarCPF()
{

}
?>