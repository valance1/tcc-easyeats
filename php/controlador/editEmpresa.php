<?php

require_once "FuncoesUteis.php";
require_once "../dao/conexaoBD.php";
require_once "../dao/empresaDAO.php";

session_start();

$imagem = $_FILES["inputImagem"];
$agencia = $_POST["inputAgencia"];
$conta = $_POST["inputConta"];

// Consultando quem é o dono da imagem primeiro
$email = $_SESSION['email'];
$sqlCode = "SELECT * FROM empresa WHERE email = '$email'";
$query = mysqli_query(conectarBD(), $sqlCode);
$fetch = mysqli_fetch_assoc($query);
$cnpj = $fetch['CNPJ'];

if (isset($imagem)) {
    $image_type = exif_imagetype($imagem["tmp_name"]);
    $image_extension = image_type_to_extension($image_type, true);
    $image_name = 'perfil' . $image_extension;

    // Inserindo a imagem no BD.
    $path = '../../images/' . $cnpj;

    // Cria caminho
    mkdir($path, 0777, true);

    $path = 'images/' . $cnpj . '/' . $image_name;

    // Move o arquivo até o caminho
    move_uploaded_file($imagem['tmp_name'], "../../images/$cnpj/$image_name");
    //$image_file[md5($cnpj)]

    // Inserindo o produto no BD
    alterarFotoEmpresa(conectarBD(), $path, $cnpj);
}
if (strlen($agencia) != 0) {
    // Tem que adicionar as verificações
    alterarAgenciaEmpresa(conectarBD(), $agencia, $cnpj);
}
if (strlen($conta) != 0) {
    alterarContaEmpresa(conectarBD(), $conta, $cnpj);
}
header("Location:../../config.php?msg=Perfil Alterado&toast=sucesso");
    ?>