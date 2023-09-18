<?php
session_start();
// Verifica se o usuário é empresarial ou se há algum usuário.
if($_SESSION['empresa'] != true || isset($_SESSION['email']) == false){
  header("Location:index.php");
}
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

  <?php
  if (!$_SESSION['empresa'] == false) {
    echo '<!-- Sessão para abater uma ficha -->
  <section class="average-section" id="abater-fichas-section">
    <hr class="hr" />
    <div class="section-text-container mb-5">
      <h1 class="h1">Abater pedido</h1>
      <p class="lead text-secondary">Aqui você pode abater as fichas do seu cliente</p>
    </div>
  <!--     Form para abater uma ficha -->
    <div class="visualizarPedido">

      <div class="formItens">

        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="inputPedido" name="inputPedido" maxlength="10" value="' . $_GET['idCesta'] . '">
          <label for="inputPedido" class="form-label">Código do pedido</label>
        </div>

        <div class="form-floating mb-3">
          <button class="btn" id="scanQRCodeBtn"><i class="fa-solid fa-camera"></i></button>
        </div>

        <div class="form-floating mb-3">
      <button type="submit" id="viz-pedido"class="btn btn-success align-self-end">Visualizar pedido</button>
      </div>
      <video id="previewQR" style="display: none; width: 100%;"></video>
    </div>

    <div id="viz-cesta-itens" style="display: none;">
    </div>


    </div>
  </div>
  </section>';
  }
  ?>

  <?php include 'php/components/footer.php' ?>
  <?php include 'php/components/forms.php' ?>
  <script type="text/javascript" src="js/main.js"></script>
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>

</html>