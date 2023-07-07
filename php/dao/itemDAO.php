<?php
require_once "../controlador/FuncoesUteis.php";
function inserirItem($conexao, $nome, $preco, $idProduto, $donoDoItem)
{
    $idItem = bin2hex(random_bytes(5));
    while (existe($conexao, 'item', 'idItem', $idItem)) {
        $idItem = bin2hex(random_bytes(5));
    };
    $sql = "INSERT INTO item (idItem, nome, preco, idProduto, donoDoItem) VALUES ('$idItem', '$nome', '$preco', '$idProduto', '$donoDoItem')";
    mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
}

function excluirItem($conexao, $idItem)
{
    $code = "DELETE FROM Item WHERE idItem = '$idItem'";
    mysqli_query($conexao, $code) or die(mysqli_error($conexao));
}

?>