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
$dispo = $_POST["disponivel"];

// Consultando quem é o dono da imagem primeiro
$email = $_SESSION['email'];
$sqlCode = "SELECT * FROM empresa WHERE email = '$email'";
$query = mysqli_query(conectarBD(), $sqlCode);
$fetch = mysqli_fetch_assoc($query);
$cnpj = $fetch['CNPJ'];

$sqlCode = "SELECT * FROM produto WHERE idProduto = '$id' and CNPJ = '$cnpj'";
$query = mysqli_query(conectarBD(), $sqlCode);
$fetch = mysqli_fetch_assoc($query);

if ($imagem['size'] != 0) {

    // TODO
    // DELETAR A IMAGEM ANTES DE FAZER TUDO ISSO!


    // Remover a imagem existente, se houver
    $existingImagePath = "../../" . $fetch['imagem'];
    if (file_exists($existingImagePath)) {
        unlink($existingImagePath);
    }


    $image_type = exif_imagetype($imagem["tmp_name"]);
    $image_extension = image_type_to_extension($image_type, true);
    $image_name = basename($fetch['imagem'], pathinfo($fetch['imagem'], PATHINFO_EXTENSION));
    $image_name = $image_name + 'png';
    
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
    // $path = '../../images/' . $cnpj;

    //Relative path
    $path = 'images/produtos/' . $cnpj . '/' . $image_name;

    // Move o arquivo até o caminho
    move_uploaded_file($imagem['tmp_name'], "../../images/produtos/$cnpj/$image_name");
    //$image_file[md5($cnpj)]

    // Inserindo o produto no BD
    alterarFotoProduto(conectarBD(), $path, $id);
}

// O importante é o cara não ter simplesmente deletado todos os caracteres.
if (strlen($nome) != 0) {
    alterarNomeProduto(conectarBD(), $nome, $id);
}else{
    $_SESSION['toast'] = 'erro';
    $_SESSION['toastmsg'] = 'Preencha todos os campos';
    exit();
}

if (strlen($desc) != 0) {
    alterarDescProduto(conectarBD(), $desc, $id);
}else{
    $_SESSION['toast'] = 'erro';
    $_SESSION['toastmsg'] = 'Preencha todos os campos';
    exit();
}

if (strlen($preco) != 0 && is_numeric($preco)) {
    alterarPrecoProduto(conectarBD(), $preco, $id);
}else{
    $_SESSION['toast'] = 'erro';
    $_SESSION['toastmsg'] = 'O preço precisa ser numérico e estar completamente preenchido.';
    exit();
}

// Altera a disponibilidade do produto
alterarDispoProduto(conectarBD(), $id, $dispo);

$_SESSION['toast'] = 'sucesso';
$_SESSION['toastmsg'] = 'Suas modificações foram salvas!';

// header("Location:../../config.php?msg=Produto editado");
?>