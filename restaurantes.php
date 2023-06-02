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
        <h1 class="section-heading">Restaurantes</h1>
      </div>
    </div>

<div class="row row-cols-1 row-cols-md-3 g-4">
  <?php
  require 'php/dao/conexaoBD.php';
  
  $code = "SELECT * FROM empresa";
  $query = mysqli_query(conectarBD(), $code) or die (mysqli_error(conectarBD()));

  if(mysqli_num_rows(mysqli_fetch_assoc($query)) != 0){
    while ($lanchonetes = mysqli_fetch_assoc($query)) {
      echo '
          <div class="card" style="width: 18rem;">
  <img src="..." class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">' . $loja["nome"] . '</h5>
    <p class="card-text">DESCRIÇÃO</p>
    <a href="'. md5($loja["CNPJ"])) . '" class="btn btn-primary">VER</a>
  </div>
</div>';
  }
  }else{
    echo '
    <div class="card text-center">
  <div class="card-body">
    <h5 class="card-title">ERRO!</h5>
    <p class="card-text">Desculpe, mas não encontramos nenhuma loja em nosso banco de dados.</p>
  </div>
  <div class="card-footer text-body-secondary">
    Agora
  </div>
</div>
    '
  };
?>
</div>


</section>
  <!-- SCRIPTS -->
  <script type="text/javascript" src="js/navbar-footer.js"></script>
</body>

</html>