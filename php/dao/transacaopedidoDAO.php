<?php
function criarTransacaoPedido($conexao, $idPedido, $data, $valor, $cpf, $cnpj)
{
    $sql = "INSERT INTO transacaopedido (idPedido, data, valor, cliente, empresa) VALUES ('$idPedido', '$data', '$valor', '$cpf', '$cnpj')";
    mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
}
?>