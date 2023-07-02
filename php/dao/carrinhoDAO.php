<?php
function criarPedido($conexao, $idPedido, $preco, $qrCode){
  $sql = "INSERT INTO pedidos (idPedido, valorTotal, qrCode) VALUES ('$idPedido', '$preco', '$qrCode')";
  mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
}
function retornarPreco($conexao, $idProduto){
  $sql = "SELECT * from produto WHERE idProduto='$idProduto'";
  $query = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
  $preco = mysqli_fetch_assoc($query)['preco'];
  return $preco;
}

function removerPedido($conexao, $cpf){
  $code = "DELETE FROM pedidos WHERE idPedido = '$cpf'";
  mysqli_query(conectarBD(), $code) or die(mysqli_error(conectarBD()));
}
?>