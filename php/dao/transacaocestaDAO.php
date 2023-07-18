<?php
function criarTransacaoCesta($conexao, $idCesta, $data, $fichas, $cpf, $cnpj)
{
    $sql = "INSERT INTO transacaoabate (idAbate, data, fichas, cliente, empresa) VALUES ('$idCesta', '$data', '$fichas', '$cpf', '$cnpj')";
    mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
}
?>