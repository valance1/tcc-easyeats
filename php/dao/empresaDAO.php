<?php
function inserirEmpresa($conexao, $nome, $CNPJ, $email, $senha, $agencia, $conta )
{
        // LIMPANDO SQL INJECTION
        $email = $conexao->real_escape_string($_POST['email']);
        $senha = $conexao->real_escape_string($_POST['senha']);
        $CNPJ = $conexao->real_escape_string($_POST['CNPJ']);
        $nome = $conexao->real_escape_string($_POST['nome']);
        $agencia = $conexao->real_escape_string($_POST['agencia']);
        $conta = $conexao->real_escape_string($_POST['conta']);
        
        $sql = "INSERT INTO empresa (nome, CNPJ, email, senha, agencia, conta) VALUES ( '$nome', '$CNPJ', '$email', '$senha', '$agencia', '$conta' ) ";
        mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
}
function alterarEmpresa(){

}
function excluirEmpresa(){


}
function pesquisarNome(){

}
function pesquisarCNPJ(){

}
?>