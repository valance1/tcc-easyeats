<?php
require_once "FuncoesUteis.php";
require_once "../dao/conexaoBD.php";
require_once "../dao/produtoDAO.php";

session_start();

$imagem = $_FILES["inputImagemProduto"];
$nome = $_POST["inputNomeProduto"];
$descricao = $_POST["inputDescProduto"];
$preco = $_POST["inputPreco"];

// Verifica se o usuário inseriu imageme
if (!isset($imagem)) {
  echo "Nenhuma imagem foi inserida";
  exit();
  
// Veriica se o usuário inseriu nome (obrigatório)
}else if(!isset($nome)){
  echo "Nenhum nome foi inserido";
  exit();
  
// A descrição pode ser nula, temos que mudar isso depois.
}else if(!isset($descricao)){
  echo "Nenhuma descricao foi inserida";
  exit();
}else if(!isset($preco)){
  echo "Nenhum preço foi inserido";
  exit();
}

// Tem que adicionar um código que verifica se já existe um produto com o nome, é bem simples

// Consultando quem é o dono da imagem primeiro
$email = $_SESSION ['email'];
$sqlCode = "SELECT * FROM empresa WHERE email = '$email'";
$query = mysqli_query(conectarBD(), $sqlCode);
$fetch = mysqli_fetch_assoc($query);
$cnpj = $fetch['CNPJ'];

$image_type = exif_imagetype($imagem["tmp_name"]);
$image_extension = image_type_to_extension($image_type, true);
$image_name = bin2hex(random_bytes(16)) . $image_extension;

// Inserindo a imagem no BD.

//
$path = '../../images/produtos/' . $cnpj . '/';

// Cria caminho
mkdir($path, 0777, true);

// Move o arquivo até o caminho
move_uploaded_file($imagem['tmp_name'], "../../images/produtos/$cnpj/$image_name");
//$image_file[md5($cnpj)]

// Inserindo o produto no BD
inserirProduto(conectarBD(), $nome, $descricao, $preco, $cnpj, $path);
header("Location:../../config.php?cadProduto=true&msg=Produto cadastrado com sucesso");
?>