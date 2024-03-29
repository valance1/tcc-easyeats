<?php
session_start();
if (!$_SESSION['email']) {
  header("Location:index.php");
}
;
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>EasyEats</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="icon" type="image/x-icon" href="assets/icon.png">
  <link href="css/main.css" type="text/css" rel="stylesheet">
  <link href="css/config.css" type="text/css" rel="stylesheet">
  <link href="css/cesta.css" type="text/css" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/2cf2c5048f.js" crossorigin="anonymous"></script>

  <!-- TOASTER -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

  <!-- CROP -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"
    integrity="sha512-6lplKUSl86rUVprDIjiW8DuOniNX8UDoRATqZSds/7t6zCQZfaCe3e5zcGaQwxa8Kpn5RTM9Fvl3X2lLV4grPQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css"
    integrity="sha512-cyzxRvewl+FOKTtpBzYjW6x6IAYUCZy3sGP40hn+DQkqeluGRCax7qztK2ImL64SA+C7kVWdLI6wvdlStawhyw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- ANIMATIONS -->
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

</head>

<body>

  <?php include 'php/components/navbar.php' ?>
  <?php require_once 'php/components/alerts.php';
  echo $_SESSION['DEBUG'];
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


  <!-- Configurações de dados -->
  <section class="average-section" id="config">
    <hr class="hr" />
    <div class="section-text-container mb-5">
      <h1 class="h1">Configurações</h1>
      <p class="lead text-secondary">
        Aqui você pode alterar seus dados ou excluir a sua conta
      </p>
    </div>

    <?php
    require_once "php/dao/conexaoBD.php";

    //  SE O USUÁRIO FOR EMPRESARIAL, DEVEMOS PERMITIR QUE ELE MODIFIQUE SEUS DADOS BANCÁRIOS, COMO AGÊNCIA E CONTA.
    
    // Se a variavel sessão empresa for diferente de false:
    if (!$_SESSION['empresa'] == false) {

      $email = $_SESSION['email'];
      $sqlCode = "SELECT * FROM empresa WHERE email = '$email'";
      $query = mysqli_query(conectarBD(), $sqlCode);
      $fetch = mysqli_fetch_assoc($query);
      $perfil = $fetch['perfil'];

      if (!$perfil) {
        $perfil = "images/placeholder/produto.png";
      }

      echo '
      <!-- Modal cadastro de produto -->
    <div class="modal fade" id="cadProdutoModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="ModalLabel">Cadastrar Produto</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <form action="php/controlador/cadProduto.php" method="POST" id="cadProdutoForm" enctype="multipart/form-data">
		  <div class="modal-body">
            <div class="input-group mb-3">
            <label class="label" style="width:100%;">
                <img class="rounded" id="prodCadPlaceholder" src="images/placeholder/produto.png" alt="avatar">
                <input type="file" id="inputProdutoImagem" data-item-id="cadProdutoImage" class="sr-only" name="inputImagem" id="inputCadImagemProduto">
              </label>
            </div>

			  <div class="form-floating mb-3">
				<input type="text" class="form-control" id="inputNomeProduto" name="inputNomeProduto" aria-describedby="nomeProdutoHelp" placeholder="">
				<label for="inputNomeProduto" class="form-label">Nome do Produto</label>
        <div class="invalid-feedback">Preencha um nome válido</div>
			  </div>
        <div class="form-floating mb-3">
				<input type="text" class="form-control" id="inputDescProduto" name="inputDescProduto" aria-describedby="descProdutoHelp" placeholder="">
				<label for="inputDescProduto" class="form-label">Descrição do Produto</label>
        <div class="invalid-feedback">Preencha uma descrição válida</div>
			  </div>
        <div class="form-floating mb-3">
				<input type="text" class="form-control" id="inputPreco" name="inputPreco" aria-describedby="Preco" placeholder="">
				<label for="inputPreco" class="form-label">Preço</label>
        <div class="invalid-feedback">Preencha um preço válido</div>
        <span
						class="form-text">Digite o preço do seu produto. Para valores quebrados utilize ".", ex. 13.50</span>
			  </div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Fechar</button>
			<button type="submit" class="btn btn-success">Cadastrar</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>

  <div class="modal fade" id="modalEditFoto" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalLabel">Crop the image</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="img-container">
            <img id="avatarPlaceholder" src="">
          </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Fechar</button>
          <button type="button" class="btn btn-success" id="crop">Crop</button>
        </div>
      </div>
    </div>
  </div>


  
      <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-between">
        <div class="container d-flex w-50 mx-0 justify-content-center align-items-center">
          <form action="php/controlador/editEmpresa.php" id="editEmpresaForm" class="w-100" enctype="multipart/form-data" method="POST">
          <div class="input-group mb-3">
          <label class="label" title="">
            <div class="empresaImagem">
              <img class="rounded" id="avatar" src="' . $perfil . '" alt="avatar">
              <input type="file" data-item-id="empresa" class="sr-only" name="inputImagem" id="inputGroupFile02">
            </div>
          </label>
          </div>

          <!-- CAMPO AGENCIA -->
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="inputAgencia" maxlength="4" name="inputAgencia" placeholder="">
            <label for="inputAgencia" class="form-label">Agencia</label>
          </div>
        <!-- CAMPO  SENHA -->
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="inputConta" maxlength="9" name="inputConta" placeholder="">
            <label for="inputConta" class="form-label">Conta</label>
          </div>
          <button type="submit" class="btn btn-success align-self-end">Salvar</button>
        </form>
        </div>
        <div class="deleteContainer container d-flex justify-content-center align-items-center flex-column w-50 mx-0 border p-3 rounded" id="deleteContainer">
      <h1 class="h2">Exclusão de conta</h1>
      <p class="fs-6 fw-light text-secondary text-center">Caso queira excluir sua conta no website, aperte o botão abaixo.
        Vale notar que pessoas não terão os itens no inventário reembolsados. Empresas deletadas terão as fichas
        convertidas em crédito no site.</p>
        <form action="php/controlador/excluir.php" method="POST">
            <button class="btn btn-outline-danger" type="submit" id="excluir-conta">EXCLUIR CONTA</button>
        </form>
        </div>
    </div>';

      // Caso contrário, se for um usuário comum, devemos exibir SOMENTE o card de exclusão de conta.
    
    } else {
      echo '
      <div class="deleteContainer container d-flex justify-content-center align-items-center flex-column border p-3 w-50 rounded" id="deleteContainer">
      <h2 class="h2">Exclusão de conta</h2>
      <p class="fs-6 fw-light text-secondary text-center">Caso queira excluir sua conta no website, aperte o botão abaixo.
        Vale notar que pessoas não terão os itens no inventário reembolsados. Empresas deletadas terão as fichas
        convertidas em crédito no site.
        </p>
        <form action="php/controlador/excluir.php" method="POST">
        <button class="btn btn-outline-danger" type="submit" id="excluir-conta">EXCLUIR CONTA</button>
    </form>
    </div>';
    }
    ;
    ?>
  </section>
  
  <!-- SE O USUÁRIO FOR EMPRESARIAL, ADICIONAR SESSÃO DE CRIAR PRODUTO -->
  <?php
  require_once 'php/dao/conexaoBD.php';
  if (!$_SESSION['empresa'] == false) {

    $email = $_SESSION['email'];
    $sqlCode = "SELECT * FROM empresa WHERE email = '$email'";
    $query = mysqli_query(conectarBD(), $sqlCode);
    $fetch = mysqli_fetch_assoc($query);
    $cnpj = $fetch['CNPJ'];

    $sqlCode = "SELECT * FROM produto where CNPJ = '$cnpj'";
    $query = mysqli_query(conectarBD(), $sqlCode) or die(mysqli_error(conectarBD()));

    echo '
  <section class="average-section" id="config-produtos">
    <hr class="hr" />
    <div class="section-text-container">
      <h1 class="h1">Gerenciamento de produtos</h1>
      <p class="lead text-secondary">Aqui você pode editar seus produtos</p>
    </div>
    <div class="container mx-0 px-0" style="max-width: 1920px;">
      <button type="button" data-bs-toggle="modal" data-bs-target="#cadProdutoModal" class="btn btn-success"><i class="fa-solid fa-plus"></i>Criar Produto</button>

    ';

    // Pegando as empresas 1 por 1 e exibindo os cartões.
    if (mysqli_num_rows($query) != 0) {
      echo '
        <div class="table-wrap">
            <table class="table table-responsive table-borderless">
                <thead>
                    <th>Foto</th>
                    <th>Produto</th>
                    <th>Preço</th>
                    <th>&nbsp;</th>
                </thead>
                <tbody>';
      while ($produto = mysqli_fetch_assoc($query)) {
        $disponivel = $produto['disponivel'];
        if($disponivel == 'false'){
          $classe = 'table-secondary text-body-secondary';
          $classe2 = "product-disabled";
          $info = " (Indisponível)";
          $checked = "";
        }else{
          // Importante resetar, já que estamos no loop
          $classe = "";
          $classe2 = "";
          $info = "";
          $checked = "checked";
        }
        $grandestring = $produto['idProduto'] . ",'" . $produto['nome'] . "', '" . $produto['descricao'] . "'," . $produto['preco'] . "," . $disponivel;
        echo '<tr class="align-middle alert border-bottom '. $classe . '" role="alert">
                        <td class="text-center" style="width: 100px;">
                        <!--   FOTO DO PRODUTO  -->
                        <label class="label" title="">
                          <div class="produtoCRUDFoto">
                              <img class="pic rounded '. $classe2 .' " id="pic' . $produto['idProduto'] . '"
                                  src="' . $produto['imagem'] . '"
                                  alt="">
                                <input type="file" class="sr-only inputEditProdutoImagem" data-item-id="' . $produto['idProduto'] . '" id="inputEditProdutoImagem' . $produto['idProduto'] . '" name="inputImagemProduto">
                          </div>
                        </label>
                        </td>
                        <td>
                          <!-- CONTAINER NOME PRODUTO E DESCRICAO -->
                            <div>
                                <p class="m-0 fw-bold lead nome-produto">' . $produto['nome'] . $info . '</p>
                                <p class="m-0 text-muted desc-produto">' . $produto['descricao'] . '</p>
                            </div>
                        </td>
                        <td>
                          <!-- PREÇO DO PRODUTO -->
                            <div class="fw-600">R$' . $produto['preco'] . '</div>
                        </td>
                        <!-- Ações do produto (EDITAR OU DELETAR)
                        Tem que adicionar um tooltip nos botões, além de adicionar um modal de edição e outro de exclusão.
                        -->
                        <td>
                          <div class="form-switch">
                            <input class="form-check-input" type="checkbox" data-item-id="' . $produto['idProduto']. '"' . $checked . '>
                          </div>

                          <div>
                            <button class="btn btn-success" onclick="editModal(' . $grandestring . ')"><i class="fa-solid fa-pen-to-square"></i></button>
                            
                            <button class="btn btn-danger" onclick=removeModal(' . $produto['idProduto'] . ')><i class="fa-solid fa-trash"></i></button>
                          </div>
                        </td>
                    </tr>';
      }

      echo '
                  </tbody>
            </table>
        </div>
    </div>
</section>


<!-- EDIT PRODUTO MODAL -->

<div class="modal fade" id="editProdutoModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="ModalLabel">Editar Produto</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <form action="php/controlador/editProduto.php" method="POST" id="editProdutoForm" enctype="multipart/form-data">
		  <div class="modal-body">
			  <div class="form-floating mb-3">
				<input type="text" class="form-control" id="inputEditNomeProduto" name="inputNomeProduto" aria-describedby="nomeProdutoHelp" placeholder="">
				<label for="inputNomeProduto" class="form-label">Nome do Produto</label>
			  </div>
        <div class="form-floating mb-3">
				<input type="text" class="form-control" id="inputEditDescProduto" name="inputDescProduto" aria-describedby="descProdutoHelp" placeholder="">
				<label for="inputDescProduto" class="form-label">Descrição do Produto</label>
			  </div>
        <div class="form-floating mb-3">
				<input type="text" class="form-control" id="inputEditPreco" name="inputPreco" aria-describedby="Preco" placeholder="">
				<label for="inputPreco" class="form-label">Preço</label>
			  </div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Fechar</button>
			<button type="submit" class="btn btn-success">Salvar</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>

';

    } else {

      // Criar um container que fala isso:
      echo '</div>
    <div class="container mx-0 mt-3 px-0">Não há nenhum produto cadastrado</div>';
    }
    echo '</section>';
  }
  ?>

  <?php include 'php/components/footer.php' ?>
  <?php include 'php/components/forms.php' ?>

</body>

<!-- // Importante para cortar as imagens -->
<script src="https://unpkg.com/jquery@3/dist/jquery.min.js" crossorigin="anonymous"></script>
<?php 
if(!$_SESSION['empresa'] == false){
  echo '<script type="text/javascript" src="js/config.js"></script>';
}
?>
<script type="text/javascript" src="js/main.js"></script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
  AOS.init();
</script>
</section>

</html>