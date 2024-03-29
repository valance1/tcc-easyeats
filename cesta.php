<!DOCTYPE html>
<?php
require_once "php/dao/conexaoBD.php";
require_once "php/controlador/FuncoesUteis.php";

session_start();

// Se o usuário não estiver logado
if (!$_SESSION['email']) {
    header("Location:index.php?msg=Voce nao esta logado");
}
if (isset($_SESSION['empresa'])) {
    header("Location:index.php?msg=Voce nao pode acessar essa pagina");
}

$conexao = conectarBD();

$email = $_SESSION['email'];
$sqlCode = "SELECT * FROM pessoa WHERE email = '$email'";
$query = mysqli_query($conexao, $sqlCode);
$cpf = mysqli_fetch_assoc($query)['cpf'];

$sqlCode = "SELECT * FROM cesta WHERE cliente = '$cpf'";
$query = mysqli_query($conexao, $sqlCode);
if (mysqli_num_rows($query) == 0) {
    header("Location:index.php?msg=Sai Daqui!");
}
?>
<html lang="pt-br">

<head>
    <title>EasyEats</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="icon" type="image/x-icon" href="assets/icon.png">
    <link href="css/main.css" type="text/css" rel="stylesheet">
    <link href="css/cesta.css" type="text/css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/2cf2c5048f.js" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


        <!-- TOASTER -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>


</head>

<body>
    <section class="average-section" id="payment">
        <hr class="hr" />
        <div class="section-text-container mb-5">
            <h1 class="h1 m-auto">Pagamento</h1>
            <p class="lead m-auto text-secondary">
                Mostre o QRCode para o atendente do estabelecimento
            </p>
        </div>

        <div>
            <h1 class="text-center">Você irá utilizar sua ficha!</h1>
            <div>
                <h1 class="text-center">ID da cesta: <?php 
                $cpf = retornaVal(conectarBD(), 'pessoa', 'email', $_SESSION['email'], 'cpf');
                $idCesta = retornaVal(conectarBD(), 'cesta', 'cliente', $cpf, 'idCesta');
                echo $idCesta;
                ?> </h1>
            </div>
            <div class="qr-code rounded py-2 mt-4 text-center">
                <?php
                // Inclua a biblioteca QR Code
                include 'assets/phpqrcode/qrlib.php';

                $conexao = conectarBD();

                $email = $_SESSION['email'];
                $sqlCode = "SELECT * FROM pessoa WHERE email = '$email'";
                $query = mysqli_query($conexao, $sqlCode);
                $cpf = mysqli_fetch_assoc($query)['cpf'];
                $idCesta = retornaVal(conectarBD(), 'cesta', 'cliente', $cpf, 'idCesta');

                // Dados para o QR code

                // No lugar do 'abater.php?idCesta='. $idCesta;, é possível colocar o endereço INTEIRO para permitir que o usuário logue.
                $text = 'https://192.168.0.2/tcc-easyeats/abater.php?idCesta='. $idCesta;
                $filename = 'images/qrcodes/cesta/'. $idCesta .'.png'; // Nome do arquivo de saída
                
                // Configurações do QR code
                $size = 15; // Tamanho do QR code (pixels)
                $margin = 2; // Margem do QR code (pixels)
                
                $directory = 'images/qrcodes/cesta/';
                if (!is_dir($directory)) {
                    mkdir($directory, 0755, true);
                }

                // Gerar o QR code
                QRcode::png($text, $filename, QR_ECLEVEL_L, $size, $margin);

                // Exibir o QR code
                echo '<img style="width:100%; height:100%;" src="' . $filename . '" alt="QR Code">';
                ?>
            </div>
            <div class="detalhes-pagamento">
                <p class="text-center bold lead fs-4 my-3">Conteudo:
                <?php 

                // Vamos pegar a cesta do indivíduo
                $email = $_SESSION['email'];
                $sqlCode = "SELECT * FROM pessoa WHERE email = '$email'";
                $query = mysqli_query($conexao, $sqlCode);
                $cpf = mysqli_fetch_assoc($query)['cpf'];
                $itens = json_decode(retornaVal($conexao, 'cesta', 'cliente', $cpf, 'itens'));

                // Agora vamos exibir o que ele escolheu
                $itemUnique = array_unique($itens);
                foreach ($itemUnique as &$produto) {
                    $imagemProduto = retornaVal($conexao, 'produto', 'idProduto', $produto, 'imagem');;
                    $descProduto = retornaVal($conexao, 'produto', 'idProduto', $produto, 'descricao');;
                    $nomeProduto = retornaVal($conexao, 'produto', 'idProduto', $produto, 'nome');
                    $precoProduto = retornaVal($conexao, 'produto', 'idProduto', $produto, 'preco');
                    $tmp = array_count_values($itens);
                    $quantidade = $tmp[$produto];
            
                    echo '
                    <div class="card product-card my-3 d-flex flex-row">
                    <div class="product-img-container">
                        <img class="float-start" src="' . $imagemProduto . '">
                    </div>
                    <div class="product-text-container ms-3 d-flex flex-column my-3  w-50 float-start">
                        <p class="fs-4 mb-0">' . $nomeProduto . '</p>
                        <p class="text-muted fs-6 my-1">' . $descProduto . '</p>
                        <p class="fw-bold text-success green mb-0">R$' . $precoProduto . '</p>
                    </div>
                    <div class="counterGroup">
                        <div class="form-control text-muted" id="productCounter">'. $quantidade .'</div>
                    </div>
                    </div>';
                }
                ?> 

                </p>
                <p class="text-center bold lead fs-5 my-3">Destinatário:
                    <?php
                    $cpf = retornaVal(conectarBD(), 'pessoa', 'email', $_SESSION['email'], 'cpf');
                    $idCesta = retornaVal(conectarBD(), 'cesta', 'cliente', $cpf, 'idCesta');
                    $cnpj = retornaVal(conectarBD(), 'cesta', 'idCesta', $idCesta, 'empresa');
                    echo retornaVal(conectarBD(), 'empresa', 'CNPJ', $cnpj, 'nome');
                    ?>

                </p>
                <p class="text-center bold lead fs-5 my-3">Cliente:
                    <?php 
                    echo retornaVal(conectarBD(), 'pessoa', 'email', $_SESSION['email'], 'nome');
                    ?>
                </p>
                <p class="text-center bold lead fs-5 my-3">Data: 
                <?php
                date_default_timezone_set('America/Sao_Paulo');
                echo date('d-m-Y');
                ?> 
                </p>
            </div>
        </div>
    </section>
    <script type="text/javascript" src="js/abaterCesta.js"></script>
</body>
</html>