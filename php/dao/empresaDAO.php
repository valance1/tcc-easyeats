<?php
function inserirEmpresa($conexao, $nome, $senha, $email, $CNPJ, $agencia, $conta )
{
        // LIMPANDO SQL INJECTION
        
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