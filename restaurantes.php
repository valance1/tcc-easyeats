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
  <!-- ICONES -->
  <script src="https://kit.fontawesome.com/2cf2c5048f.js" crossorigin="anonymous"></script>

  <!-- TOASTER -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

  <!-- ANIMATIONS -->
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>

<body>

  <?php include 'php/components/navbar.php' ?>

  <!-- PREVIEW RESTAURANTS -->
  <section class="average-section" id="restaurantes-preview">
    <hr class="hr" />
    <div class="section-text-container mb-5">
      <h1 class="h1">Restaurantes</h1>
      <p class="lead text-secondary">Confira os restaurantes disponíveis:</p>
    </div>
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
            <input class="form-control border-end-0 border" type="search" value="" id="search-input">
            <span class="input-group-append">
                <button class="btn border" id="search-button" type="button">
                <i class="fa fa-search"></i>
                </button>
            </span>
        </div>

    <div class="row row-cols-1 justify-content-evenly row-cols-md-3 mt-5 g-4 result-container">';

      // Pegando as empresas 1 por 1 e exibindo os cartões.
      while ($loja = mysqli_fetch_assoc($query)) {

        // Verificando se a loja já possui imagem
        if (!$loja['perfil']) {

          // Caso não tenha, colocar foto temporária
          $imagem = "images/placeholder/loja.png";
        } else {
          $imagem = $loja['perfil'];
        }

        // Tive que dar vários "echo" por conta da interpolação de variáveis.
        echo '
        <div data-aos="fade-up" class="card card-loja px-0 rounded" style="width: 18rem;">
        <img src="' . $imagem . '" class="card-img-top loja-foto" alt="...">
        <div class="card-body loja-details">';
        echo '<h5 class="card-title fs-4 fw-bold">' . $loja["nome"] . '</h5>';
        echo '<p class="fs-6 fw-light text-muted">Lanchonete</p>';
        echo '<a href="cardapio.php?loja=' . $loja['nome'] . '"class="btn btn-outline-dark fw-normal">VER</a>';
        echo '</div></div></div>';
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
  <script type="text/javascript" src="js/main.js"></script>
  <script type="text/javascript" src="js/searchBar.js"></script>
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>

</html>