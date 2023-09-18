<?php
function criarTransacaoPedido($conexao, $idPedido, $data, $produtos, $valor, $cpf, $cnpj)
{
    $sql = "INSERT INTO transacaopedido (idPedido, data, produtos, valor, cliente, empresa) VALUES ('$idPedido', '$data', '$produtos', '$valor', '$cpf', '$cnpj')";
    mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
}
?>