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
    <div class="dados-bancarios-wrapper">
    
    <?php
    if($_SESSION['empresa'] == true){
        echo  '
        <form action="php/controlador/logCliente.php" method="POST">
        <div class="dados-bancarios-container">
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
            <button type="submit" class="btn btn-primary">Confirmar</button>
        </div>
        </form>
        ';
    };
    
    ?>
    
    <div class="excluir-container">
        <h1 class="basic-heading">Exclusão de conta</h1>
        <p class="basic-text">Caso queira excluir sua conta no website, aperte o botão abaixo.
        Vale notar que pessoas não terão os itens no inventário reembolsados. Empresas deletadas terão as fichas convertidas em crédito no site.</p>
        <button class="btn btn-primary" action="php/dao/excluir.php" id="excluir-conta">EXCLUIR CONTA</button>
    </div>
    </php> 
</section>

<!-- SE O USUÁRIO FOR EMPRESARIAL, ADICIONAR SESSÃO DE CRIAR PRODUTO -->
<?php
  if($_SESSION['empresa'] == true){
    echo '';
  };
?>

<?php include 'php/components/footer.php' ?>

<!-- SCRIPTS -->
<!--   <script type="text/javascript" src="js/forms.js"></script> -->
<script type="text/javascript" src="js/navbar-footer.js"></script>
</body>

</html>