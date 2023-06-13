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
  <link href='css/main.css' rel="stylesheet">
</head>

<body>

  <?php include 'php/components/navbar.php' ?>

  <!-- PREVIEW RESTAURANTS -->
  <section class="average-section" id="restaurantes-preview">
    <hr class="hr" />
    <div class="section-text-container mb-5">
      <h1 class="h1">Restaurantes</h1>
      <p class="lead">Confira os restaurantes disponíveis:</p>
    </div>
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
    <?php
    require 'php/dao/conexaoBD.php';

    // Mesma lógica do index.php, porém, diferentemente do for loop
    // Aqui nós temos um while, que vai simplesmente cuspir todas as
    // Empresas encontradas no banco de dados.
    
    // Selecionando todas as empresas
    $code = "SELECT * FROM empresa";
    $query = mysqli_query(conectarBD(), $code) or die(mysqli_error(conectarBD()));

    // Se houver alguma empresa, mostre a search bar e começe o while
    if (mysqli_num_rows($query) != 0) {
      echo '
      <div class="input-group">
            <input class="form-control border-end-0 border" type="search" value="search" id="example-search-input">
            <span class="input-group-append">
                <button class="btn btn-outline-secondary bg-white border-start-0 border-bottom-0 border ms-n5" type="button">
                <i class="fa fa-search"></i>
                </button>
            </span>
        </div>

    <div class="row row-cols-1 justify-content-evenly row-cols-md-3 mt-5 g-4">';

      // Pegando as empresas 1 por 1 e exibindo os cartões.
      while ($loja = mysqli_fetch_assoc($query)) {

        // Verificando se a loja já possui imagem
        if (!$loja['imagem']) {

          // Caso não tenha, colocar foto temporária
          $imagem = "images/placeholder/loja.png";
        } else {
          $imagem = $loja['imagem'];
        }

        // Tive que dar vários "echo" por conta da interpolação de variáveis.
        echo '
        <div class="card" style="width: 18rem;">
        <img src="' . $imagem . '" class="card-img-top" alt="...">
        <div class="card-body">';
        echo '<h5 class="card-title">' . $loja["nome"] . '</h5>';
        echo '<p class="card-text">DESCRIÇÃO</p>';
        echo '<a href="cardapio.php?loja=' . $loja['nome'] . '"class="btn btn-primary">VER</a>';
        echo '</div></div>';
      }

      // Se não houver nenhuma, mostre o card de indisponibilidade
    } else {
      echo '
      <div class="card container-xxl text-center" id="noEmpresasFound">
        <div class="card-body">
          <h5 class="card-title">OPS!</h5>
          <img src="images/CAT.gif" alt="this slowpoke moves" class="my-2"  width="250" />
          <p class="card-text">Desculpe, mas não encontramos nenhuma loja em nosso banco de dados.</p>
        </div>
      </div>
    ';
    }
    ?>
  </section>


  <?php include 'php/components/footer.php' ?>
  <?php include 'php/components/forms.php' ?>
</body>

</html>