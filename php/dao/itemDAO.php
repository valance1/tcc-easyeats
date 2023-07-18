<?php
require_once "../controlador/FuncoesUteis.php";
function inserirItem($conexao, $nome, $preco, $idProduto, $donoDoItem, $cnpj)
{
    $idItem = bin2hex(random_bytes(5));
    while (existe($conexao, 'item', 'idItem', $idItem)) {
        $idItem = bin2hex(random_bytes(5));
    };
    $sql = "INSERT INTO item (idItem, nome, preco, idProduto, donoDoItem, empresa) VALUES ('$idItem', '$nome', '$preco', '$idProduto', '$donoDoItem', $cnpj)";
    mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
}

function excluirItem($conexao, $idProduto, $cpf, $cnpj)
{
    $code = "DELETE FROM Item WHERE idProduto ='$idProduto' and cliente = '$cpf' and empresa = '$cnpj' ";
    mysqli_query($conexao, $code) or die(mysqli_error($conexao));
}

?>