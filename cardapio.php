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

  <section class="average-section" id="restaurantes-preview">

    ESSA PARTE AQUI VAI TER EM PRATICAMENTE TODA SEÇÃO:
    <div class="section-text-container">
      <?php
      echo '<h1 class="section-heading">'. $_GET['loja'] .'</h1>';
      ?>
      <p class="section-detail">Confira os itens disponíveis:</p>
    </div>
  </section>
  
  <!-- Importando componentes -->
  <?php include 'php/components/footer.php' ?>
  <?php include 'php/components/forms.php' ?>
</body>

</html>