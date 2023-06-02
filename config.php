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

<?php include 'php/components/navbar.php' ?>

<!-- HERO -->
<section class="average-section" id="config">

<div class="section-text-container">
    <h1 class="h1">Configurações</h1>
    <p class="lead">Aqui você pode alterar seus dados ou excluir a sua conta</p>
  </div>

    <?php
    if ($_SESSION['empresa'] != true) {
      echo  '<div class="row row-cols-1 row-cols-md-3 g-4">
      <div class="container d-flex justify-content-center align-items-center">
        <form action="php/controlador/logCliente.php" class="w-100" method="POST">

          <!-- CAMPO AGENCIA -->
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="inputAgencia" name="inputAgencia" placeholder="">
              <label for="inputAgencia" class="form-label">Endereço de e-mail</label>
            </div>
            <!-- CAMPO  SENHA -->
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="inputConta" name="inputConta" placeholder="">
              <label for="inputConta" class="form-label">Senha</label>
            </div>
            <button type="submit" class="btn btn-success">Confirmar</button>
        </form>
  
        </div>



        <div class="container d-flex justify-content-center align-items-center flex-column">
      <h1 class="h2">Exclusão de conta</h1>
      <p class="lead text-center">Caso queira excluir sua conta no website, aperte o botão abaixo.
        Vale notar que pessoas não terão os itens no inventário reembolsados. Empresas deletadas terão as fichas
        convertidas em crédito no site.</p>
      <button class="btn btn-outline-danger" action="php/dao/excluir.php" id="excluir-conta">EXCLUIR CONTA</button>
    </div>
    </div>
        ';
    }else{
      echo'<div class="container">
      <h1 class="h2">Exclusão de conta</h1>
      <p class="lead">Caso queira excluir sua conta no website, aperte o botão abaixo.
        Vale notar que pessoas não terão os itens no inventário reembolsados. Empresas deletadas terão as fichas
        convertidas em crédito no site.</p>
      <button class="btn btn-outline-danger" action="php/dao/excluir.php" id="excluir-conta">EXCLUIR CONTA</button>
    </div>';
    };
    ?>
</section>

<!-- SE O USUÁRIO FOR EMPRESARIAL, ADICIONAR SESSÃO DE CRIAR PRODUTO -->
<?php
if ($_SESSION['empresa'] == true) {
  echo '';
}
;
?>

<?php include 'php/components/footer.php' ?>

<!-- SCRIPTS -->
<!--   <script type="text/javascript" src="js/forms.js"></script> -->
<script type="text/javascript" src="js/navbar-footer.js"></script>
</body>

</html>