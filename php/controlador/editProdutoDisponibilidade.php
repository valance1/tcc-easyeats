<?php
require_once "FuncoesUteis.php";
require_once "../dao/conexaoBD.php";
require_once "../dao/produtoDAO.php";

session_start();

$dispo = $_POST["disponivel"];
$id = $_POST["id"];

// Altera a disponibilidade do produto
alterarDispoProduto(conectarBD(), $id, $dispo);

?>