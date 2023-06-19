<?php
session_start();
?>

<!DOCTYPE html>

<html lang="pt-br">

<head>
  <title>EasyEats</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="assets/icon.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
  <!-- ICONES -->
  <script src="https://kit.fontawesome.com/2cf2c5048f.js" crossorigin="anonymous"></script>

  <link href='css/main.css' rel="stylesheet">
  <link href='css/cardapio.css' rel="stylesheet">
</head>

<body>

  <?php include 'php/components/navbar.php' ?>
  <?php require_once 'php/components/alerts.php';
  if ($_GET['toast'] == 'sucesso') {
    createSuccessAlert("Ação realizada com sucesso");
  }
  if ($_GET['toast'] == 'erro') {
    createErrorAlert("Ação realizada com erro");
  }
  if ($_GET['toast' == 'warning']) {
    createWarningAlert("Alguma coisa não está certa");
  }
  ?>

  <section class="average-section" id="restaurantes-preview">

    <div class="section-text-container">
      <?php
      echo '<h1 class="section-heading">' . $_GET['loja'] . '</h1>';
      ?>
      <p class="section-detail">Confira os itens disponíveis:</p>
    </div>


    <?php
    require 'php/dao/conexaoBD.php';

    // Mesma lógica do index.php, porém, diferentemente do for loop
    // Aqui nós temos um while, que vai simplesmente cuspir todas as
    // produtos encontradas no banco de dados.
    
    // Selecionando todas as empresas (temoss que passar uma chave mais segura pra garantir a exclusividade  da empresa, tipo  CNPJ)
    $empresa = $_GET['loja'];
    $code = "SELECT * FROM empresa WHERE nome ='$empresa'";
    $query = mysqli_query(conectarBD(), $code) or die(mysqli_error(conectarBD()));
    $empresa = mysqli_fetch_assoc($query);
    $cnpj = $empresa['CNPJ'];



    $code = "SELECT * FROM produto where CNPJ = '$cnpj'";
    $query = mysqli_query(conectarBD(), $code) or die(mysqli_error(conectarBD()));

    // Se houver algum produto:
    if (mysqli_num_rows($query) != 0) {
      // Pegando as empresas 1 por 1 e exibindo os cartões.
      while ($produto = mysqli_fetch_assoc($query)) {

        echo '
        <div class="card product-card my-3 d-flex flex-row">
          <img class="float-start" src="' . $produto['imagem'] . '">
          
          <div class="ms-3 d-flex flex-column my-3  w-75">
            <p class="fs-4 mb-0">' . $produto['nome'] . '</p>
            <p class="text-muted fs-6 my-1">' . $produto['escricao'] . '</p>
            <p class="fw-bold text-success green mb-0">R$' . $produto['preco'] . '</p>
          </div>
          <button class="btn btn-success btn-buy-product"><i class="fa-solid fa-cart-shopping"></i></button>
    </div>';
      }

      // Se não houver nenhuma, mostre o card de indisponibilidade
    } else {
      echo '
      <div class="card container-xxl text-center" id="noEmpresasFound">
        <div class="card-body">
          <h5 class="card-title">OPS!</h5>
          <img src="images/CAT.gif" alt="N/A" class="my-2"  width="250" />
          <p class="card-text">Desculpe, mas essa loja não possui nenhum produto.</p>
        </div>
      </div>
    ';
    }
    ?>

  </section>

  <!-- Importando componentes -->
  <?php include 'php/components/footer.php' ?>
  <?php include 'php/components/forms.php' ?>
  <script type="text/javascript" src="js/main.js"></script>
</body>

</html>