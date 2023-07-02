<!DOCTYPE html>
<?php
require "php/dao/conexaoBD.php";

session_start();

// Se o usuário não estiver logado, LOL!
if (!$_SESSION['email']) {
    header("Location:index.php");
}
if (isset($_SESSION['empresa'])) {
    header("Location:index.php");
}

$conexao = conectarBD();

$email = $_SESSION['email'];
$sqlCode = "SELECT * FROM pessoa WHERE email = '$email'";
$query = mysqli_query($conexao, $sqlCode);
$cpf = mysqli_fetch_assoc($query)['cpf'];

$sqlCode = "SELECT * FROM pedidos WHERE cliente = '$cpf'";
$query = mysqli_query($conexao, $sqlCode);
if (mysqli_num_rows($query) == 0) {
    header("Location:index.php?msg=Sai Daqui!");
}
?>
<html lang="pt-br">

<head>
    <title>EasyEats</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="assets/icon.png">
    <link href="css/main.css" type="text/css" rel="stylesheet">
    <link href="css/pagamento.css" type="text/css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/2cf2c5048f.js" crossorigin="anonymous"></script>


</head>

<body>
    <section class="average-section" id="payment">
        <hr class="hr" />
        <div class="section-text-container mb-5">
            <h1 class="h1 m-auto">Pagamento</h1>
            <p class="lead m-auto text-secondary">
                Realize o pagamento pelo código pix!
            </p>
        </div>

        <div>
            <h1 class="text-center">Você irá realizar uma compra de<b style="color:green;">
                <?php
                echo 'R$' . mysqli_fetch_assoc($query)['valorTotal'];
                ?></b>
            </h1>
            <button class="btn btn-dark">Copiar QRCode</button>
            <div class="qr-code rounded py-2 mt-4 text-center">
                <?php
                // Inclua a biblioteca QR Code
                include 'assets/phpqrcode/qrlib.php';

                $conexao = conectarBD();

                $email = $_SESSION['email'];
                $sqlCode = "SELECT * FROM pessoa WHERE email = '$email'";
                $query = mysqli_query($conexao, $sqlCode);
                $cpf = mysqli_fetch_assoc($query)['cpf'];

                $sqlCode = "SELECT * FROM pedidos WHERE cliente = '$cpf'";
                $query = mysqli_query($conexao, $sqlCode);

                // Dados para o QR code
                $text = 'Olá, Mundo!';
                $filename = 'images/qrcodes/'. mysqli_fetch_assoc($query)['idPedido'] .'.png'; // Nome do arquivo de saída
                
                // Configurações do QR code
                $size = 15; // Tamanho do QR code (pixels)
                $margin = 2; // Margem do QR code (pixels)
                
                // Gerar o QR code
                QRcode::png($text, $filename, QR_ECLEVEL_L, $size, $margin);

                // Exibir o QR code
                echo '<img style="width:100%; height:100%;" src="' . $filename . '" alt="QR Code">';
                ?>
            </div>
            <div class="detalhes-pagamento">
                <p class="text-center bold lead fs-4 my-3">Detalhes da transação</p>
                <p class="text-center bold lead fs-5 my-3">Destinatário:</p>
                <p class="text-center bold lead fs-5 my-3">Cliente:</p>
                <p class="text-center bold lead fs-5 my-3">Data: </p>

                <button class="btn btn-outline-success">Simular Pagamento</button>
            </div>
        </div>
    </section>
</body>

</html>