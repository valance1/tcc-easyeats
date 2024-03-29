<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>EasyEats</title>
  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <!-- CSS LOCAL -->
  <link rel="icon" type="image/x-icon" href="assets/icon.png">
  <link href="css/main.css" type="text/css" rel="stylesheet">

  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
  <!-- ICONES -->
  <script src="https://kit.fontawesome.com/2cf2c5048f.js" crossorigin="anonymous"></script>

  <link href='css/main.css' rel="stylesheet">
  <link href='css/cardapio.css' rel="stylesheet">

    <!-- TOASTER -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
</head>

<body>
<?php
    if(isset($_SESSION['empresa']) || !isset($_SESSION['email'])){
      // header("Location:index.php");
      if(isset($_SESSION['empresa'])){
        header("Location:index.php");
      }
    }else{
      echo '<script type="text/javascript" src="js/carrinho.js"></script>';
    }
  ?>

  <?php include 'php/components/navbar.php' ?>
  <?php require_once 'php/components/alerts.php';
  if ($_SESSION['toast'] == 'sucesso') {
    createSuccessAlert($_SESSION['toastmsg']);
    unset($_SESSION['toastmsg']);
    unset($_SESSION['toast']);
  }
  if ($_SESSION['toast'] == 'erro') {
    createErrorAlert($_SESSION['toastmsg']);
    unset($_SESSION['toastmsg']);
    unset($_SESSION['toast']);
  }

  if ($_SESSION['toast'] == 'warning') {
    createWarningAlert($_SESSION['toastmsg']);
    unset($_SESSION['toastmsg']);
    unset($_SESSION['toast']);
  }
?>

  <section class="average-section" id="restaurantes-preview">
  <hr class="hr" />
    <div class="section-text-container mb-5">
      <?php
      echo '<h1 class="h1">' . $_GET['loja'] . '</h1>';
      ?>
      <p class="lead text-secondary">Confira os itens disponíveis:</p>
    </div>


    <?php
    require_once 'php/dao/conexaoBD.php';

    // Mesma lógica do index.php, porém, diferentemente do for loop
    // Aqui nós temos um while, que vai simplesmente cuspir todas as
    // produtos encontradas no banco de dados.
    
    // Selecionando todas as empresas (temoss que passar uma chave mais segura pra garantir a exclusividade  da empresa, tipo  CNPJ)
    $empresa = $_GET['loja'];
    $code = "SELECT * FROM empresa WHERE nome ='$empresa'";
    $query = mysqli_query(conectarBD(), $code) or die(mysqli_error(conectarBD()));
    $empresa = mysqli_fetch_assoc($query);
    $cnpj = $empresa['CNPJ'];

    $code = "SELECT * FROM produto where CNPJ = '$cnpj'";
    $query = mysqli_query(conectarBD(), $code) or die(mysqli_error(conectarBD()));

    $sqlCode2 = "SELECT COUNT(*) AS total FROM produto WHERE CNPJ = '$cnpj' AND disponivel = 'false'";
    $query2 = mysqli_query(conectarBD(), $sqlCode2);
    $result = mysqli_fetch_assoc($query2);
    $totalProdutosFalse = $result['total'];


    // Se houver algum produto:
    if (mysqli_num_rows($query) != 0 && mysqli_num_rows($query) != $totalProdutosFalse) {
      // Pegando as empresas 1 por 1 e exibindo os cartões.
      while ($produto = mysqli_fetch_assoc($query)) {
        // Se o produto não estiver disponível, nem vamos adicionar ele no cardápio
        if($produto['disponivel'] == 'false'){
          continue;
        }

        echo '
            <div class="card product-card my-3 d-flex flex-row">
              <div class="product-img-container">
                <img class="float-start" src="' . $produto['imagem'] . '">
              </div>
              <div class="product-text-container ms-3 d-flex flex-column my-3 w-100 float-start">
                <p class="fs-4 mb-0">' . $produto['nome'] . '</p>
                <p class="text-muted fs-6 my-1">' . $produto['descricao'] . '</p>
                <p class="fw-bold text-success green mb-0">R$' . $produto['preco'] . '</p>
              </div>
              <div class="cartContainer" id="cartContainer'. $produto['idProduto'] .'">
                <button class="btn btn-success btn-buy-product" id="cartBtn' . $produto['idProduto'] . '" onclick="adicionarAoCarrinho('. $produto['idProduto'] .')"><i class="fa-solid fa-cart-shopping"></i></button>
              </div>
        </div>';
      }
      echo '<button class="btn btn-success" onclick="finalizarCompra()">Finalizar Compra</button>';
      // Se não houver nenhuma, mostre o card de indisponibilidade
    } else {
      echo '
      <div class="card container-xxl text-center" id="noEmpresasFound">
        <div class="card-body">
          <h5 class="card-title">OPS!</h5>
          <img src="images/CAT.gif" alt="N/A" class="my-2"  width="250" />
          <p class="card-text">Desculpe, mas essa loja não possui nenhum produto.</p>
        </div>
      </div>
    ';
    }
    ?>
  </section>

  <!-- Importando componentes -->
  <?php include 'php/components/footer.php' ?>
  <?php include 'php/components/forms.php' ?>
  <script type="text/javascript" src="js/main.js"></script>
</body>

</html>