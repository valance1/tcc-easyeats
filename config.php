<?php
session_start();
if(!$_SESSION['email']){
    header("Location:index.php");
};
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>EasyEats</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="assets/icon.png">
  <link href="css/main.css" type="text/css" rel="stylesheet">
  <link href="css/config.css" type="text/css" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/2cf2c5048f.js" crossorigin="anonymous"></script>

</head>

<body>

  <?php include 'php/components/navbar.php' ?>

  <!-- HERO -->
  <section class="average-section" id="config">
    <hr class="hr" />
    <div class="section-text-container mb-5">
      <h1 class="h1">Configurações</h1>
      <p class="lead">Aqui você pode alterar seus dados ou excluir a sua conta</p>
    </div>

    <?php

    //  SE O USUÁRIO FOR EMPRESARIAL, DEVEMOS PERMITIR QUE ELE MODIFIQUE SEUS DADOS BANCÁRIOS, COMO AGÊNCIA E CONTA.

    if (!$_SESSION['empresa'] == false) {
      echo '<div class="row row-cols-1 row-cols-md-3 g-4">
      <div class="container d-flex justify-content-center align-items-center">
        <form action="php/controlador/logCliente.php" class="w-100" method="POST">
        
        <div class="input-group mb-3">
            <input type="file" class="form-control" id="inputGroupFile02">
        </div>

          <!-- CAMPO AGENCIA -->
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="inputAgencia" name="inputAgencia" placeholder="">
              <label for="inputAgencia" class="form-label">Agencia</label>
            </div>
            <!-- CAMPO  SENHA -->
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="inputConta" name="inputConta" placeholder="">
              <label for="inputConta" class="form-label">Conta</label>
            </div>
            <button type="submit" class="btn btn-success align-self-end">Salvar</button>
        </form>
        </div>
        <div class="container d-flex justify-content-center align-items-center flex-column  border p-3">
      <h1 class="h2">Exclusão de conta</h1>
      <p class="lead text-center">Caso queira excluir sua conta no website, aperte o botão abaixo.
        Vale notar que pessoas não terão os itens no inventário reembolsados. Empresas deletadas terão as fichas
        convertidas em crédito no site.</p>
        <form action="php/dao/excluir.php" method="POST">
            <button class="btn btn-outline-danger" type="submit" id="excluir-conta">EXCLUIR CONTA</button>
        </form>
        </div>
    </div>';
    
    // Caso contrário, se for um usuário comum, devemos exibir SOMENTE o card de exclusão de conta.
    
    } else {
      echo '
      <div class="container d-flex justify-content-center align-items-center flex-column border p-3" id="deleteContainer">
      <h2 class="h2">Exclusão de conta</h2>
      <p class="text-center">Caso queira excluir sua conta no website, aperte o botão abaixo.
        Vale notar que pessoas não terão os itens no inventário reembolsados. Empresas deletadas terão as fichas
        convertidas em crédito no site.
        </p>
        <form action="php/dao/excluir.php" method="POST">
        <button class="btn btn-outline-danger" type="submit" id="excluir-conta">EXCLUIR CONTA</button>
    </form>
    </div>';
    };
    ?>
  </section>

  <!-- SE O USUÁRIO FOR EMPRESARIAL, ADICIONAR SESSÃO DE CRIAR PRODUTO -->
  <?php
  if (!$_SESSION['empresa'] == false) {
    
    echo '
    <section class="average-section" id="config-produtos">
        <hr class="hr" />
        <div class="section-text-container my-5">
            <h1 class="h1">Gerenciamento de produtos</h1>
            <p class="lead">Aqui você pode editar seus produtos</p>
        </div>  
    <div class="container" style="max-width: 1920px;">
    <button type="button" data-bs-toggle="modal" data-bs-target="#cadProdutoModal" class="btn btn-success"><i class="fa-solid fa-plus"></i>  Criar Produto</button>
        <div class="table-wrap">
            <table class="table table-responsive table-borderless">
                <thead>
                    <th>&nbsp;</th>
                    <th>Produto</th>
                    <th>Preço</th>
                </thead>
                <tbody>
                    <tr class="align-middle alert border-bottom" role="alert">
                        <td class="text-center">
                        <!--   FOTO DO PRODUTO  -->
                            <img class="pic placeholder"
                                src="..."
                                alt="">
                        </td>
                        <td>
                          <!-- CONTAINER NOME PRODUTO E DESCRICAO -->
                            <div>
                                <p class="m-0 fw-bold lead">Hambúrguer</p>
                                <p class="m-0 text-muted">Uma refeição deliciosa para qualquer hora</p>
                            </div>
                        </td>
                        <td>
                          <!-- PREÇO DO PRODUTO -->
                            <div class="fw-600">R$7,00</div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="cadProdutoModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="ModalLabel">Cadastrar Produto</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			
		  </div>
		  <form action="php/controlador/cadProduto.php" method="POST">
		  <div class="modal-body">
            <div class="input-group mb-3">
                 <input type="file" class="form-control" id="inputGroupFile02">
            </div>
			<!-- CAMPO EMAIL -->
			  <div class="form-floating mb-3">
				<input type="email" class="form-control" id="inputEmail" name="inputEmail" aria-describedby="emailHelp" placeholder="exemplo@emailcom">
				<label for="inputEmail" class="form-label">Nome</label>
			  </div>
              <div class="form-floating mb-3">
				<input type="email" class="form-control" id="inputEmail" name="inputEmail" aria-describedby="emailHelp" placeholder="exemplo@emailcom">
				<label for="inputEmail" class="form-label">Descrição</label>
			  </div>
			  <!-- CAMPO  SENHA -->
              <div class="form-floating mb-3">
				<input type="text" class="form-control" id="inputPreco" name="inputPreco" aria-describedby="Preco" placeholder="0">
				<label for="inputPreco" class="form-label">R$</label>
			  </div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Fechar</button>
			<button type="submit" class="btn btn-success">Confirmar</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
</section>
';
  }
  ?>

  <?php include 'php/components/footer.php' ?>
  <?php include 'php/components/forms.php' ?>
</body>


<!-- 
<div class="container">
        <div class="table-wrap">
            <table class="table table-responsive table-borderless">
                <thead>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>Produto</th>
                    <th></th>
                    <th>Quantity</th>
                    <th>Preço</th>
                    <th>&nbsp;</th>
                </thead>
                <tbody>
                    <tr class="align-middle alert border-bottom" role="alert">
                        <td>
                            <input type="checkbox" id="check">
                        </td>
                        <td class="text-center">
                            <img class="pic"
                                src="https://www.freepnglogos.com/uploads/shoes-png/dance-shoes-png-transparent-dance-shoes-images-5.png"
                                alt="">
                        </td>
                        <td>
                            <div>
                                <p class="m-0 fw-bold">Sneakers Shoes 2020 For Men</p>
                                <p class="m-0 text-muted">Fugiat Voluptates quasi nemo,ipsa perferencis</p>
                            </div>
                        </td>
                        <td>
                            <div class="fw-600">$44.99</div>
                        </td>
                        <td class="d-">
                            <input class="input" type="text" placeholder="2">
                        </td>
                        <td>
                            $89.98
                        </td>
                        <td>
                            <div class="btn" data-bs-dismiss="alert">
                                <span class="fas fa-times"></span>
                            </div>
                        </td>
                    </tr>
                    <tr class="align-middle alert border-bottom" role="alert">
                        <td>
                            <input type="checkbox" id="check">
                        </td>
                        <td class="text-center">
                            <img class="pic"
                                src="https://www.freepnglogos.com/uploads/shoes-png/download-vector-shoes-image-png-image-pngimg-2.png"
                                alt="">
                        </td>
                        <td>
                            <div>
                                <p class="m-0 fw-bold">Sneakers Shoes 2020 For Men</p>
                                <p class="m-0 text-muted">Fugiat Voluptates quasi nemo,ipsa perferencis</p>
                            </div>
                        </td>
                        <td>
                            <div class="fw-600">$54.99</div>
                        </td>
                        <td class="d-">
                            <input class="input" type="text" placeholder="2">
                        </td>
                        <td>
                            $108.98
                        </td>
                        <td>
                            <div class="btn" data-bs-dismiss="alert">
                                <span class="fas fa-times"></span>
                            </div>
                        </td>
                    </tr>
                    <tr class="align-middle alert border-bottom" role="alert">
                        <td>
                            <input type="checkbox" id="check">
                        </td>
                        <td class="text-center">
                            <img class="pic"
                                src="https://www.freepnglogos.com/uploads/shoes-png/running-shoes-png-transparent-running-shoes-images-6.png"
                                alt="">
                        </td>
                        <td>
                            <div>
                                <p class="m-0 fw-bold">Sneakers Shoes 2020 For Men</p>
                                <p class="m-0 text-muted">Fugiat Voluptates quasi nemo,ipsa perferencis</p>
                            </div>
                        </td>
                        <td>
                            <div class="fw-600">$50.99</div>
                        </td>
                        <td class="d-">
                            <input class="input" type="text" placeholder="2">
                        </td>
                        <td>
                            $100.98
                        </td>
                        <td>
                            <div class="btn" data-bs-dismiss="alert">
                                <span class="fas fa-times"></span>
                            </div>
                        </td>
                    </tr>
                    <tr class="align-middle alert border-bottom" role="alert">
                        <td>
                            <input type="checkbox" id="check">
                        </td>
                        <td class="text-center">
                            <img class="pic"
                                src="https://www.freepnglogos.com/uploads/shoes-png/find-your-perfect-running-shoes-26.png"
                                alt="">
                        </td>
                        <td>
                            <div>
                                <p class="m-0 fw-bold">Sneakers Shoes 2020 For Men</p>
                                <p class="m-0 text-muted">Fugiat Voluptates quasi nemo,ipsa perferencis</p>
                            </div>
                        </td>
                        <td>
                            <div class="fw-600">$74.99</div>
                        </td>
                        <td>
                            <input class="input" type="text" placeholder="2">
                        </td>
                        <td>
                            $148.98
                        </td>
                        <td>
                            <div class="btn" data-bs-dismiss="alert">
                                <span class="fas fa-times"></span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div> -->
</section>

</html>