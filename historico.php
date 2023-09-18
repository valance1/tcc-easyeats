<?php
session_start();
require "php/dao/conexaoBD.php";
require "php/controlador/FuncoesUteis.php";
// Verifica se o usuário é empresarial ou se há algum usuário.
if ($_SESSION['empresa'] != true || isset($_SESSION['email']) == false) {
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
  <link href='css/historico.css' rel="stylesheet">
  <!-- ICONES -->
  <script src="https://kit.fontawesome.com/2cf2c5048f.js" crossorigin="anonymous"></script>

  <!-- TOASTER -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

  <!-- ANIMATIONS -->
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>

<body>

  <?php include 'php/components/navbar.php' ?>

  <section class="average-section" id="historico-fquantidade">
    <hr class="hr" />
    <div class="section-text-container mb-5">
      <h1 class="h1">Fichas compradas</h1>
      <p class="lead text-secondary">Confira quantas unidades de cada ficha os usuários possuem no inventário</p>
    </div>
    <div class="products-container">

      <?php
      // Para debug!
      // error_reporting(E_ALL);
      
      $conexao = conectarBD();
      $email = $_SESSION['email'];
      $cnpj = retornaVal($conexao, 'empresa', 'email', $email, 'CNPJ');
      $sqlCode = "SELECT * FROM produto WHERE CNPJ = '$cnpj'";
      $query = mysqli_query($conexao, $sqlCode);

      // Primeiro temos que loopar entre cada produto, ao mesmo tempo em que adicionamos ele, aproveitamos para adicionar a quantidade de fichas que cada um possui.
      while ($obj = mysqli_fetch_assoc($query)) {
        $imagemProduto = $obj['imagem'];
        $descProduto = $obj['descricao'];
        $nomeProduto = $obj['nome'];
        $precoProduto = $obj['preco'];
        $idProduto = $obj['idProduto'];

        $sqlCode = "SELECT * FROM item WHERE idProduto = '$idProduto'";
        $query = mysqli_query($conexao, $sqlCode);

        // Quantidade de itens pertencente ao produto
        $quantidade = mysqli_num_rows($query);

        echo '
        <div class="card product-card my-3 d-flex flex-row">
        <div class="product-img-container">
            <img class="float-start" src="' . $imagemProduto . '">
        </div>
        <div class="product-text-container ms-3 d-flex flex-column my-3  w-50 float-start">
            <p class="fs-4 mb-0">' . $nomeProduto . '</p>
            <p class="text-muted fs-6 my-1">' . $descProduto . '</p>
            <p class="fw-bold text-success green mb-0">R$' . $precoProduto . '</p>
        </div>
        <div class="counterGroup">
            <div class="form-control text-muted" id="productCounter">' . $quantidade . '</div>
        </div>
        </div>';
      }
      ;
      ?>
    </div>
  </section>

  <section class="average-section" id="historico-fcompradas">
    <hr class="hr" />
    <div class="section-text-container mb-5">
      <h1 class="h1">Histórico de compras</h1>
      <p class="lead text-secondary">Verifique aqui o histórico de compra de fichas pelos seus usuários</p>
    </div>
    <?php
    
    // 1. Get items
    // 2. Add to array
    // 3. Add to table
    $sqlCode = 
    $query = 
    $itens = json_decode(retornaVal($conexao, 'cesta', 'cliente', $cpf, 'itens'));


    ?>
    <table class="table hover">
      <thead>
        <tr>
          <th scope="col">Cliente</th>
          <th scope="col">Valor</th>
          <th scope="col">Data</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td>Mark</td>
          <td>Otto</td>
          <td>@mdo</td>
        </tr>
        <tr>
          <th scope="row">2</th>
          <td>Jacob</td>
          <td>Thornton</td>
          <td>@fat</td>
        </tr>
        <tr>
          <th scope="row">3</th>
          <td colspan="2">Larry the Bird</td>
          <td>@twitter</td>
        </tr>
      </tbody>
    </table>
  </section>

  <section class="average-section" id="historico-fconsumidas">
    <hr class="hr" />
    <div class="section-text-container mb-5">
      <h1 class="h1">Histórico de fichas consumidas</h1>
      <p class="lead text-secondary">Verifique aqui o histórico de fichas consumidas pelos usuários</p>
    </div>
  </section>

  <?php include 'php/components/footer.php' ?>
  <?php include 'php/components/forms.php' ?>
  <script type="text/javascript" src="js/main.js"></script>
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>

</html>