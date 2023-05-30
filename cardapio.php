<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>EasyEats</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
  <link href='css/main.css' rel="stylesheet">
</head>

<body>

  <?php include 'php/components/navbar.php' ?>

  <section class="average-section" id="restaurantes-preview">

    <!-- ESSA PARTE AQUI VAI TER EM PRATICAMENTE TODA SEÇÃO: -->
    <div class="section-text-container">
      <h1 class="section-heading">(NOME DO RESTAURANTE)</h1>
      <p class="section-detail">Confira os itens disponíveis:</p>
    </div>

    <!-- PARA ALINHAR OS 3 RESTAURANTES  -->
    <div class="menu-container">
      <div class="item-wrapper" id="(ITEMHASH)">
        <image class="item-image"></image>
        <div class="item-text-wrapper">
          <h1 class="item-name">NOME DO ITEM</h1>
          <p class="item-desc">DESCRIÇÃO DO ITEM</p>
        </div>
        <p class="item-price">R$00,00</p>
        <div class="alter-button-container">
          <div class="add">+</div>
          <div class="counter">0</div>
          <div class="remove">-</div>
        </div>
      </div>
    </div>
  </section>


  <!-- SCRIPTS -->
  <script type="text/javascript" src="js/navbar-footer.js"></script>
</body>

</html>