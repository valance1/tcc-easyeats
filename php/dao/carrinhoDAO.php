<?php
function criarPedido($conexao, $idPedido, $cpf, $preco, $qrCode){
  $sql = "INSERT INTO pedidos (idPedido, cliente, valorTotal, qrCode, status) VALUES ('$idPedido', '$cpf', '$preco', '$qrCode', 'aguardando')";
  mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
}
function retornarPreco($conexao, $idProduto){
  $sql = "SELECT * from produto WHERE idProduto='$idProduto'";
  $query = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
  $preco = mysqli_fetch_assoc($query)['preco'];
  return $preco;
}

function removerPedido($conexao, $cpf){
  $code = "DELETE FROM pedidos WHERE cliente = '$cpf'";
  mysqli_query(conectarBD(), $code) or die(mysqli_error(conectarBD()));
}
?>