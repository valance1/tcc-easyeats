<?php
function criarCesta($conexao, $idCesta, $cpf, $itens, $cnpj){
  $sql = "INSERT INTO cesta (idCesta, cliente, itens, empresa) VALUES ('$idCesta', '$cpf', '$itens', '$cnpj')";
  mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
}

function removerCesta($conexao, $cpf){
  $code = "DELETE FROM cesta WHERE cliente = '$cpf'";
  mysqli_query(conectarBD(), $code) or die(mysqli_error(conectarBD()));
}

function removerCestaPorID($conexao, $id){
    $code = "DELETE FROM cesta WHERE idProduto = '$id'";
    mysqli_query(conectarBD(), $code) or die(mysqli_error(conectarBD()));
  }
?>