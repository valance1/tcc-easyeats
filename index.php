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

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
</head>

<body></body>

<nav class="navbar navbar-expand-lg bg-body-tertiary" style="padding-right: 150px; padding-left: 150px">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">EasyEats</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">

      <!-- LEFT SIDE -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.html">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="restaurantes.html">Restaurantes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="">Contato</a>
        </li>
      </ul>

      <!-- RIGHT SIDE -->
      <ul class="navbar-nav me-auto"></ul>
      <?php
      error_reporting(0);
      if (!$_SESSION['email']) {
        echo '
        <li class="nav-item">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" id="loginNavButton" data-bs-target="#loginModal">Login</button>
          </li>
          <li class="nav-item">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cadastroModal">Cadastrar</button>
          </li>';
      } else {
        echo '
            <li class="nav-item dropdown" style="
    display:  flex;
    align-items: center;">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">' . $_SESSION['email'] . '
          </a>
          <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="config.php">Configurações</a></li>
            <li><a class="dropdown-item" href="php/controlador/logout.php">Desconectar</a></li>
          </ul>
        </li>';
      }
      ;
      ?>
      </ul>
    </div>
  </div>
</nav>


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
          <a class="btn btn-outline-secondary px-4" href="restaurantes.html" role="button">Ver Restaurantes</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- PREVIEW RESTAURANTS -->
<section class="average-section" id="restaurantes-preview">

  <!-- ESSA PARTE AQUI VAI TER EM PRATICAMENTE TODA SEÇÃO: -->
  <div class="section-text-container">
    <h1 class="section-heading">RESTAURANTES</h1>
    <p class="section-detail">Ver restaurantes disponíveis na sua região</p>
  </div>

  <!-- PARA ALINHAR OS 3 RESTAURANTES  -->
  <div class="restaurant-wrapper">
    <!-- CARTAO DO RESTAURANTE  -->

    <?php
    error_reporting(0);
    require 'php/dao/conexaoBD.php';
    ?>
    <div class="restaurant-card">
      <image class="restaurant-image" src="images\restaurantes\eliesio.png">
        <div class="restaurant-text-info">
          <h1 class="restaurant-name">ELIESIO</h1>
          <div class="restaurant-wrapper-bottom">
            <p class="restaurant-tag">LANCHONETE</p>
            <p class="restaurant-view"><a href="">VER</a></p>
          </div>
        </div>
    </div>
  </div>
</section>

<!-- developers -->
<section class="average-section" id="developers">

  <div class="section-text-container">
    <h1 class="section-heading">DESENVOLVEDORES</h1>
    <p class="section-detail">Conheça nossa equipe</p>
  </div>

  <div class="dev-container">
    <!-- -------------------------------------------------- -->
    <div class="dev-card">
      <image class="dev-image" src="images/restaurantes/R.jfif"></image>
      <div class="dev-wrapper">
        <h1 class="dev-name">Aldair Schmitberger</h1>
        <p class="dev-role">Programador Back-End</p>
      </div>
    </div>
    <!-- -------------------------------------------------- -->
    <div class="dev-card">
      <image class="dev-image" src="images/restaurantes/R.jfif"></image>
      <div class="dev-wrapper">
        <h1 class="dev-name">Gabriel Pinotti</h1>
        <p class="dev-role">Programador Full-Stack</p>
      </div>
    </div>
    <!-- -------------------------------------------------- -->
    <div class="dev-card">
      <image class="dev-image" src="images/restaurantes/R.jfif"></image>
      <div class="dev-wrapper">
        <h1 class="dev-name">Gabriel Gasparoni</h1>
        <p class="dev-role">Ideia</p>
      </div>
    </div>
    <!-- -------------------------------------------------- -->
  </div>
</section>

<!-- FOOTER -->
<section class="footer" id="footer">

</section>

<!-- SCRIPTS -->
<!--   <script type="text/javascript" src="js/forms.js"></script> -->
<script type="text/javascript" src="js/navbar-footer.js"></script>
</body>

</html>