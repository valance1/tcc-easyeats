<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>EasyEats</title>
  <meta charset="UTF-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="css/main.css" type="text/css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/2cf2c5048f.js" crossorigin="anonymous"></script>
</head>

<body>

  <?php include 'php/components/navbar.php' ?>

  <!-- HERO -->
  <section class="average-section" id="hero">
    <div id="HERO" class="container col-xxl-8 px-4 py-5">
      <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
        <div class="col-10 col-sm-8 col-lg-6">
          <img src="" class="d-block mx-lg-auto img-fluid" alt="" loading="lazy">
        </div>
        <div class="col-lg-6">
          <div class="lc-block mb-3">
            <div editable="rich">
              <h2 class="fw-bold display-5">EasyEats</h2>
              <p>Espere menos, viva mais</p>
            </div>
          </div>

          <div class="lc-block mb-3">
            <div editable="rich">
              <p class="lead"> Uma plataforma feita para você adiantar suas compras em lanchonetes
              </p>
            </div>
          </div>

          <div class="lc-block d-grid gap-2 d-md-flex justify-content-md-start">
            <a class="btn btn-outline-light px-4" href="restaurantes.php" role="button">Ver Restaurantes</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- PREVIEW RESTAURANTS -->
  <section class="average-section" id="restaurantes-preview">
    <hr class="hr"/>
    <!-- ESSA PARTE AQUI VAI TER EM PRATICAMENTE TODA SEÇÃO: -->
    <div class="section-text-container my-5">
      <h1 class="h1"><a href="restaurantes.php">Restaurantes<i class="fa-solid fa-arrow-right"></i></a></h1>
      <!-- <svg class="bi" aria-hidden="true"><use xlink:href="#arrow-right"></use></svg> -->
      <p class="lead">Ver restaurantes disponíveis na sua região</p>
    </div>

    <!-- PARA ALINHAR OS 3 RESTAURANTES  -->
    <div class="restaurant-wrapper">
      <!--     CARTAO DO RESTAURANTE -->

      <?php
      require 'php/dao/conexaoBD.php';

      $code = "SELECT * FROM empresa";
      $query = mysqli_query(conectarBD(), $code) or die(mysqli_error(conectarBD()));
      $fetch = mysqli_fetch_assoc($query);
      if (mysqli_num_rows($fetch) < 3) {
        if (mysqli_num_rows($fetch) == 0) {
          echo '
        <div class="card container-xxl text-center" id="noEmpresasFound">
      <div class="card-body">
        <h5 class="card-title">OPS!</h5>
        <img src="images/CAT.gif" alt="this slowpoke moves" class="my-2"  width="250" />
        <p class="card-text">Desculpe, mas não encontramos nenhuma loja em nosso banco de dados.</p>
      </div>
    </div>
        ';
        } else {
          for ($i = 0; $i < mysqli_num_rows($fetch); $i++) {

            $loja = $fetch[0];
            $nomeLoja = $loja["nome"];
            $idCardapio = $loja["CNPJ"];

            echo '
          <div class="card" style="width: 18rem;">
  <img src="..." class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">' . $nomeLoja . '</h5>
    <p class="card-text">DESCRIÇÃO</p>
    <a href="' . md5($idCardapio) . '" class="btn btn-primary">VER</a>
  </div>
</div>';
          }
          ;
        }
        ;
      } else {
        for ($i = 0; $i < 2; $i++) {

          $loja = $fetch[0];
          $nomeLoja = $loja["nome"];
          $idCardapio = $loja["CNPJ"];

          echo '
      <div class="card" style="width: 18rem;">
<img src="..." class="card-img-top" alt="...">
<div class="card-body">
<h5 class="card-title">' . $nomeLoja . '</h5>
<p class="card-text">DESCRIÇÃO</p>
<a href="' . md5($idCardapio) . '" class="btn btn-primary">VER</a>
</div>
</div>';
        }
        ;
      }
      ;
      ?>
    </div>
  </section>

  <!-- developers -->
  <section class="average-section" id="developers">
    <hr class="hr" />
    <div class="section-text-container my-5">
      <h1 class="h1">Desenvolvedores</h1>

      <p class="lead">Conheça nossa equipe</p>
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-4">
      <!-- -------------------------------------------------- -->
      <div class="container d-flex justify-content-center align-items-center flex-column h-100" style="width: 300px;">
        <image class="dev-image" src="images/restaurantes/R.jfif"></image>
        <div class="container d-flex justify-content-center align-items-center flex-column mt-3">
          <p class="text-center fw-bold">Aldair Schmitberger</p>
          <p class="text-center">Programador Back-End</p>
        </div>
      </div>
      <!-- -------------------------------------------------- -->
      <div class="container d-flex justify-content-center align-items-center flex-column h-100" style="width: 300px;">
        <image class="dev-image" src="images/restaurantes/R.jfif"></image>
        <div class="container d-flex justify-content-center align-items-center flex-column mt-3">
          <p class="text-center fw-bold">Gabriel Pinotti</p>
          <p class="text-center">Programador Full-Stack e Designer</p>
        </div>
      </div>
      <!-- -------------------------------------------------- -->
      <div class="container d-flex justify-content-center align-items-center flex-column h-100" style="width: 300px;">
        <image class="dev-image" src="images/restaurantes/R.jfif"></image>
        <div class="container d-flex justify-content-center align-items-center flex-column mt-3">
          <p class="text-center fw-bold">Gabriel Gasparoni</p>
          <p class="text-center">Ideia</p>
        </div>
      </div>
      <!-- -------------------------------------------------- -->
    </div>
  </section>

  <?php include 'php/components/footer.php' ?>

  <!-- SCRIPTS -->
  <script type="text/javascript" src="js/navbar-footer.js"></script>
</body>

</html>