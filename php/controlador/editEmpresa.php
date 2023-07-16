<?php

require_once "FuncoesUteis.php";
require_once "../dao/conexaoBD.php";
require_once "../dao/empresaDAO.php";

session_start();

// Recebe os parametros
$imagem = $_FILES["inputImagem"];
$agencia = $_POST["inputAgencia"];
$conta = $_POST["inputConta"];

// Consultando quem é o dono da imagem primeiro
$email = $_SESSION['email'];
$sqlCode = "SELECT * FROM empresa WHERE email = '$email'";
$query = mysqli_query(conectarBD(), $sqlCode);
$fetch = mysqli_fetch_assoc($query);
$cnpj = $fetch['CNPJ'];

// Checando se o usuário inseriu alguma imagem
if ($imagem['size'] != 0) {

    // Se sim, vamos tentar deletar a imagem antiga
    $existingImagePath = "../../" . $fetch['imagem'];
    if (file_exists($existingImagePath)) {
        unlink($existingImagePath);
    }

    // Agora vamos inserir a imagem nova
    $image_type = exif_imagetype($imagem["tmp_name"]);
    $image_extension = image_type_to_extension($image_type, true);
    $image_name = 'perfil' . $image_extension;

    // Verificar o tamanho do arquivo
    $maxFileSize = 10 * 1024 * 1024; // 10MB
    if ($imagem['size'] > $maxFileSize) {
        echo 'A imagem não pode ter mais de 10MB';
        $_SESSION['toast'] = 'erro';
        $_SESSION['toastmsg'] = 'Imagem deve ser igual ou menor a 10MB';
        header("Location:../../config.php?msg=Error");
        exit();
    }

    // Verificar o tipo de arquivo
    $allowedExtensions = array('png', 'jpg', 'jpeg', 'svg');
    $fileExtension = strtolower(image_type_to_extension($image_type, false));

    if (!in_array($fileExtension, $allowedExtensions)) {

        echo 'Formato de imagem não suportado. Apenas PNG, JPG, JPEG e SVG são permitidos';
        $_SESSION['toast'] = 'erro';
        $_SESSION['toastmsg'] = 'Imagem deve ser do tipo PNG, JPG, JPEG ou SVG';
        header("Location:../../config.php?msg=Error");
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
    alterarFotoEmpresa(conectarBD(), $path, $cnpj);
}

if (strlen($agencia) != 0) {
    if (validarAgencia($inputAgencia) != false) {
        // Tem que adicionar as verificações
        alterarAgenciaEmpresa(conectarBD(), $agencia, $cnpj);
    }else{
        $passou = false;
    }
}
if (strlen($conta) != 0) {
    if (validarAgencia($inputConta) != false) {
        alterarContaEmpresa(conectarBD(), $conta, $cnpj);
    }else{
        $passou = false;
    }
}
if($passou == true){
    $_SESSION['toast'] = 'sucesso';
    $_SESSION['toastmsg'] = 'Perfil alterado com sucesso';
    header("Location:../../config.php?msg=Perfil Alterado");

}else{
    $_SESSION['toast'] = 'warning';
    $_SESSION['toastmsg'] = 'Alguns campos estavam inválidos e podem não ter sido alterados.';
    header("Location:../../config.php?msg=Perfil Alterado com falhas");
}
?>