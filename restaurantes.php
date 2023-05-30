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

  <!-- PREVIEW RESTAURANTS -->
  <section class="average-section" id="restaurantes-preview">

    <div class="section-text-container">
      <div class="restaurantes-section-wrapper">
        <p> ICON DA SETA</p>
        <h1 class="section-heading">Restaurantes</h1>
      </div>
    </div>

    <!-- TEM QUE USAR A GRID DO BOOTSTRAP  -->
    <div class="grid">
      <div class="g-col-4">
        <div style="color: red; width: 100px; height: 100px;">
        </div>
      </div>
      <div class="g-col-4">
      <div style="color: red; width: 100px; height: 100px;"></div>
      </div>
      <div class="g-col-4"><div style="color: red; width: 100px; height: 100px;">
      </div>
    </div>
  </section>
  <!-- SCRIPTS -->
  <script type="text/javascript" src="js/navbar-footer.js"></script>
</body>

</html>