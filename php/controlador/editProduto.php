<?php

require_once "FuncoesUteis.php";
require_once "../dao/conexaoBD.php";
require_once "../dao/produtoDAO.php";

session_start();

$id = $_POST["id"];
$imagem = $_FILES["imagem"];
$nome = $_POST["nome"];
$desc = $_POST["desc"];
$preco = $_POST["preco"];

// Consultando quem é o dono da imagem primeiro
$email = $_SESSION['email'];
$sqlCode = "SELECT * FROM produto WHERE idProduto = '$id'";
$query = mysqli_query(conectarBD(), $sqlCode);
$fetch = mysqli_fetch_assoc($query);
$cnpj = $fetch['CNPJ'];

if ($imagem['size'] != 0) {

    // TODO
    // DELETAR A IMAGEM ANTES DE FAZER TUDO ISSO!


    $image_type = exif_imagetype($imagem["tmp_name"]);
    $image_extension = image_type_to_extension($image_type, true);
    $image_name = bin2hex(random_bytes(16)) . $image_extension;
    
    // Verificar o tamanho do arquivo
    $maxFileSize = 10 * 1024 * 1024; // 10MB
    if ($imagem['size'] > $maxFileSize) {
        echo 'A imagem não pode ter mais de 10MB';
        exit();
    }

    // Verificar o tipo de arquivo
    $allowedExtensions = array('png', 'jpg', 'jpeg', 'svg');
    $fileExtension = strtolower(image_type_to_extension($image_type, false));

    if (!in_array($fileExtension, $allowedExtensions)) {
        echo 'Formato de imagem não suportado. Apenas PNG, JPG, JPEG e SVG são permitidos';
        exit();
    }

    // Inserindo a imagem no BD.
    $path = '../../images/' . $cnpj;

    // Cria caminho
    mkdir($path, 0777, true);

    $path = 'images/' . $cnpj . '/' . $image_name;

    // Move o arquivo até o caminho
    move_uploaded_file($imagem['tmp_name'], "../../images/$cnpj/$image_name");
    //$image_file[md5($cnpj)]

    // Inserindo o produto no BD
    alterarFotoProduto(conectarBD(), $path, $id);
}
if (strlen($nome) != 0) {
    // Tem que adicionar as verificações
    alterarNomeProduto(conectarBD(), $nome, $id);
}
if (strlen($desc) != 0) {
    alterarDescProduto(conectarBD(), $desc, $id);
}
if (strlen($preco) != 0) {
    alterarPrecoProduto(conectarBD(), $preco, $id);
}

$_SESSION['toast'] = 'sucesso';
$_SESSION['toastmsg'] = 'Suas modificações foram salvas!';

header("Location:../../config.php?msg=Produto editado");
?>