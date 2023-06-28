<?php
// require_once "FuncoesUteis.php";
require_once "../dao/conexaoBD.php";
require_once "../dao/produtoDAO.php";
session_start();

$id = $_POST['id'];

// TODO
// Tem que deletar a imagem

excluirProduto(conectarBD(), $id);
$_SESSION['toast'] = 'sucesso';
$_SESSION['toastmsg'] = 'Produto removido com sucesso';


?>