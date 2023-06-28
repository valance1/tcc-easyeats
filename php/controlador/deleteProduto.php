<?php
// require_once "FuncoesUteis.php";
require_once "../dao/conexaoBD.php";
require_once "../dao/produtoDAO.php";
session_start();

$id = $_POST['id'];

$sqlCode = "SELECT * FROM produto WHERE idProduto = '$id'";
$query = mysqli_query(conectarBD(), $sqlCode);
$fetch = mysqli_fetch_assoc($query);

$existingImagePath = "../../" . $fetch['imagem'];
if (file_exists($existingImagePath)) {
    unlink($existingImagePath);
}

excluirProduto(conectarBD(), $id);
$_SESSION['toast'] = 'sucesso';
$_SESSION['toastmsg'] = 'Produto removido com sucesso';


?>