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

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
</head>

<body></body>

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
          <a class="btn btn-outline-secondary px-4" href="restaurantes.php" role="button">Ver Restaurantes
            
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- PREVIEW RESTAURANTS -->
<section class="average-section" id="restaurantes-preview">

  <!-- ESSA PARTE AQUI VAI TER EM PRATICAMENTE TODA SEÇÃO: -->
  <div class="section-text-container">
    <h1 class="h1">RESTAURANTES</h1>
    <!-- <svg class="bi" aria-hidden="true"><use xlink:href="#arrow-right"></use></svg> -->
    <p class="lead">Ver restaurantes disponíveis na sua região</p>
  </div>

  <!-- PARA ALINHAR OS 3 RESTAURANTES  -->
  <div class="restaurant-wrapper">
<!--     CARTAO DO RESTAURANTE -->

    <?php
    require 'php/dao/conexaoBD.php';
    
    $code = "SELECT * FROM empresa";
    $query = mysqli_query(conectarBD(), $code) or die (mysqli_error(conectarBD()));
    $fetch = mysqli_fetch_assoc($query);
    if(mysqli_num_rows($fetch) < 3 ){
      if(mysqli_num_rows($fetch) == 0){
        echo '
        <div class="card container-xxl text-center" id="noEmpresasFound">
      <div class="card-body">
        <h5 class="card-title">ERRO!</h5>
        <p class="card-text">Desculpe, mas não encontramos nenhuma loja em nosso banco de dados.</p>
      </div>
      <div class="card-footer text-body-secondary">
        Agora
      </div>
    </div>
        ';
      }else{
        for ($i = 0 ; $i < mysqli_num_rows($fetch); $i++){
        
          $loja = $fetch[0];
          $nomeLoja = $loja["nome"];
          $idCardapio = $loja["CNPJ"];
          
          echo '
          <div class="card" style="width: 18rem;">
  <img src="..." class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">' . $nomeLoja . '</h5>
    <p class="card-text">DESCRIÇÃO</p>
    <a href="'. md5($idCardapio) . '" class="btn btn-primary">VER</a>
  </div>
</div>';
        };
      };
    }else{
      for ($i = 0 ; $i < 2; $i++){
      
      $loja = $fetch[0];
      $nomeLoja = $loja["nome"];
      $idCardapio = $loja["CNPJ"];
      
      echo '
      <div class="card" style="width: 18rem;">
<img src="..." class="card-img-top" alt="...">
<div class="card-body">
<h5 class="card-title">' . $nomeLoja . '</h5>
<p class="card-text">DESCRIÇÃO</p>
<a href="'. md5($idCardapio) . '" class="btn btn-primary">VER</a>
</div>
</div>';
      };
    };
    ?>
  </div>
</section>

<!-- developers -->
<section class="average-section" id="developers">

  <div class="section-text-container">
    <h1 class="h1">DESENVOLVEDORES</h1>
    <p class="lead">Conheça nossa equipe</p>
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

<?php include 'php/components/footer.php' ?>

<!-- SCRIPTS -->
<script type="text/javascript" src="js/navbar-footer.js"></script>
<script type="text/javascript" src="js/jquery-1.2.6.pack.js"></script>
</body>

</html>