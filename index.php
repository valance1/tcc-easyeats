<?php
require_once('php/bd.php')
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<title>EasyEats</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
		crossorigin="anonymous"></script>
		<link href='css/main.css' rel="stylesheet">
</head>

<body></body>

  <!-- HERO -->
  <section class="average-section" id="hero">
    <div class="container col-xxl-8 px-4 py-5">
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
      <h1 class="section-heading"></h1>
      <p class="section-detail"></p>
    </div>
    
    <!-- PARA ALINHAR OS 3 RESTAURANTES  -->
    <div class="restaurant-wrapper">
      <!-- CARTAO DO RESTAURANTE  -->
      <div class="restaurant-card">
        <image class="restaurante-image"> FOTO DA CANTINA</image>
        <div class="restaurant-text-info">
          <h1 class="restaurant-name">ELIESIO</h1>
          <p class="restaurant-tag">LANCHONETE</p>
        </div>
      </div>
    </div>
  </section>
  
  <!-- developers -->
  <section class="average-section" id="developers">
    
    <div class="section-text-container">
      <h1 class="section-heading"></h1>
      <p class="section-detail"></p>
    </div>
  <div class="dev-wrapper">
    <!-- -------------------------------------------------- -->
    <div class="dev-card">
      <image>FOTO DO MELIANTE</image>
      <h1 class="dev-name">NOME DO MELIANTE</h1>
      <p class="dev-role">FUNÇÃO DO MELIANTE</p>
    </div>
  <!-- -------------------------------------------------- -->
    <div class="dev-card">
      <image>FOTO DO MELIANTE</image>
      <h1 class="dev-name">NOME DO MELIANTE</h1>
      <p class="dev-role">FUNÇÃO DO MELIANTE</p>
    </div>
    <!-- -------------------------------------------------- -->
    <div class="dev-card">
      <image>FOTO DO MELIANTE</image>
      <h1 class="dev-name">NOME DO MELIANTE</h1>
      <p class="dev-role">FUNÇÃO DO MELIANTE</p>
    </div>
    <!-- -------------------------------------------------- -->
  </div>
  </section>

  <!-- FOOTER -->
  <section class="footer" id="footer">

  </section>

  <!-- SCRIPTS -->
  <script type="text/javascript" src="js/forms.js"></script>
  <script type="text/javascript" src="js/navbar-footer.js"></script>
</body>
</html>