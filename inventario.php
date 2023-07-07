<?php
session_start();

// REVER ESSA Lógica
if (!$_SESSION['email'] || isset($_SESSION['empresa'])) {
    header("Location:index.php?msg=Voce nao pode acessar essa pagina");
}
;
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>EasyEats</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="assets/icon.png">
    <link href="css/main.css" type="text/css" rel="stylesheet">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
    <!-- ICONES -->
    <script src="https://kit.fontawesome.com/2cf2c5048f.js" crossorigin="anonymous"></script>

    <link href='css/main.css' rel="stylesheet">
    <link href='css/cardapio.css' rel="stylesheet">

    <!-- TOASTER -->
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

</head>

<body>

    <?php include 'php/components/navbar.php' ?>
    <?php require_once 'php/components/alerts.php';
    if ($_SESSION['toast'] == 'sucesso') {
        createSuccessAlert($_SESSION['toastmsg']);
        unset($_SESSION['toastmsg']);
        unset($_SESSION['toast']);
    }
    if ($_SESSION['toast'] == 'erro') {
        createErrorAlert($_SESSION['toastmsg']);
        unset($_SESSION['toastmsg']);
        unset($_SESSION['toast']);
    }

    if ($_SESSION['toast' == 'warning']) {
        createWarningAlert($_SESSION['toastmsg']);
        unset($_SESSION['toastmsg']);
        unset($_SESSION['toast']);
    }
    ?>

    <section class="average-section" id="inventario">
        <hr class="hr" />
        <div class="section-text-container mb-5">
            <h1 class="h1">Inventário</h1>
            <p class="lead text-secondary">Aqui você visualizar suas fichas</p>
        </div>

        <?php
        require_once('php/dao/conexaoBD.php');
        require_once('php/controlador/FuncoesUteis.php');
        $conexao = conectarBD();
        $cpf = retornaVal($conexao, 'pessoa', 'email', $_SESSION['email'], 'cpf');
        $code = "SELECT * FROM item where donoDoItem = '$cpf'";
        $query = mysqli_query($conexao, $code) or die(mysqli_error($conexao));
        // Se houver algum produto:
        if (mysqli_num_rows($query) != 0) {
            $i =0 ;
            while ($item = mysqli_fetch_assoc($query)) {
                $itemIdProd = $item['idProduto'];

                // Changing query
                $code = "SELECT * FROM produto where idProduto = '$itemIdProd' ORDER BY CNPJ";
                $queryProd = mysqli_query($conexao, $code) or die(mysqli_error($conexao));
                $produto = mysqli_fetch_assoc($queryProd);
                $cnpj = retornaVal($conexao, 'produto', 'idProduto', $produto['idProduto'], 'CNPJ');

                echo '
                <div class="card product-card my-3 d-flex flex-row">
                <div class="product-img-container">
                    <img class="float-start" src="' . $produto['imagem'] . '">
                </div>
                <div class="product-text-container ms-3 d-flex flex-column my-3  w-50 float-start">
                    <p class="fs-4 mb-0">' . $produto['nome'] . '</p>
                    <p class="text-muted fs-6 my-1">' . $produto['descricao'] . '</p>
                    <p class="fw-bold text-success green mb-0">R$' . $produto['preco'] . '</p>
                </div>
                <div class="cartContainer" id="cartContainer' . $produto['idProduto'] . '">
                    <button class="btn btn-success btn-buy-product"></button>
                </div>
                </div>';

            }
        }else{
            echo 'nenhum item';
        }
        ?>

    </section>


    <?php include 'php/components/footer.php' ?>
    <?php include 'php/components/forms.php' ?>
    <script type="text/javascript" src="js/main.js"></script>
</body>

</html>