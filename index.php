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
<section class="average-section" id="hero">
  <div id="HERO" class="container col-xxl-8 px-4 py-5">
    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
      <div class="col-10 col-sm-8 col-lg-6">
        <img src="" class="d-block mx-lg-auto img-fluid" alt="" loading="lazy">
      </div>
      <div class="col-lg-6">
        <div class="lc-block mb-3">
          <div editable="rich">
            <h2 class="fw-bold display-5">EasyEats</h2>
            <p>Espere menos, viva mais</p>
          </div>
        </div>

        <div class="lc-block mb-3">
          <div editable="rich">
            <p class="lead"> Uma plataforma feita para você adiantar suas compras em lanchonetes
            </p>
          </div>
        </div>

        <div class="lc-block d-grid gap-2 d-md-flex justify-content-md-start">
          <a class="btn btn-outline-secondary px-4" href="restaurantes.html" role="button">Ver Restaurantes</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- PREVIEW RESTAURANTS -->
<section class="average-section" id="restaurantes-preview">

  <!-- ESSA PARTE AQUI VAI TER EM PRATICAMENTE TODA SEÇÃO: -->
  <div class="section-text-container">
    <h1 class="section-heading">RESTAURANTES</h1>
    <p class="section-detail">Ver restaurantes disponíveis na sua região</p>
  </div>

  <!-- PARA ALINHAR OS 3 RESTAURANTES  -->
  <div class="restaurant-wrapper">
<!--     CARTAO DO RESTAURANTE -->

    <?php
    require 'php/dao/conexaoBD.php';
    
    $code = "SELECT * FROM empresa";
    $query = mysqli_query(conectarBD(), $code) or die (mysqli_error(conectarBD()));
    $fetch = mysqli_fetch_assoc($query);
    if(mysqli_num_rows($fetch) < 3 ){
      if(mysqli_num_rows($fetch) == 0){
        echo '';
      }else{
        for ($i = 0 ; $i < mysqli_num_rows($fetch); $i++){
        
          $loja = $fetch[0];
          $nomeLoja = $loja["nome"];
          $idCardapio = $loja["CNPJ"];
          
          echo '
          <div class="restaurant-card">
            <image class="restaurant-image" src="images\restaurantes\eliesio.png">
              <div class="restaurant-text-info">
                <h1 class="restaurant-name">'.  $nomeLoja . '</h1>
                <div class="restaurant-wrapper-bottom">
                  <p class="restaurant-tag">Lanchonete</p>
                  <p class="restaurant-view"><a href="' . $idCardapio . '">VER</a></p>
                </div>
              </div>
          </div> ';
        };
      };
    }else{
      for ($i = 0 ; $i < 2; $i++){
      
      $loja = $fetch[0];
      $nomeLoja = $loja["nome"];
      $idCardapio = $loja["CNPJ"];
      
      echo '
      <div class="restaurant-card">
        <image class="restaurant-image" src="images\restaurantes\eliesio.png">
          <div class="restaurant-text-info">
            <h1 class="restaurant-name">'.  $nomeLoja . '</h1>
            <div class="restaurant-wrapper-bottom">
              <p class="restaurant-tag">Lanchonete</p>
              <p class="restaurant-view"><a href="cardapio.php">VER</a></p>
            </div>
          </div>
      </div> ';
      };
    };
    ?>
  </div>
</section>

<!-- developers -->
<section class="average-section" id="developers">

  <div class="section-text-container">
    <h1 class="section-heading">DESENVOLVEDORES</h1>
    <p class="section-detail">Conheça nossa equipe</p>
  </div>

  <div class="dev-container">
    <!-- -------------------------------------------------- -->
    <div class="dev-card">
      <image class="dev-image" src="images/restaurantes/R.jfif"></image>
      <div class="dev-wrapper">
        <h1 class="dev-name">Aldair Schmitberger</h1>
        <p class="dev-role">Programador Back-End</p>
      </div>
    </div>
    <!-- -------------------------------------------------- -->
    <div class="dev-card">
      <image class="dev-image" src="images/restaurantes/R.jfif"></image>
      <div class="dev-wrapper">
        <h1 class="dev-name">Gabriel Pinotti</h1>
        <p class="dev-role">Programador Full-Stack</p>
      </div>
    </div>
    <!-- -------------------------------------------------- -->
    <div class="dev-card">
      <image class="dev-image" src="images/restaurantes/R.jfif"></image>
      <div class="dev-wrapper">
        <h1 class="dev-name">Gabriel Gasparoni</h1>
        <p class="dev-role">Ideia</p>
      </div>
    </div>
    <!-- -------------------------------------------------- -->
  </div>
</section>

<?php include 'php/components/footer.php' ?>

<!-- LOGIN Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        
        <div class="modal-header">
          
          <h5 class="modal-title" id="ModalLabel">Login</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          
        </div>
        <form action="php/controlador/logCliente.php" method="POST">
        <div class="modal-body">
          <!-- CAMPO EMAIL -->
            <div class="form-floating mb-3">
              <input type="email" class="form-control" id="inputEmail" name="inputEmail" aria-describedby="emailHelp" placeholder="exemplo@emailcom">
              <label for="inputEmail" class="form-label">Endereço de e-mail</label>
            </div>
            <!-- CAMPO  SENHA -->
            <div class="form-floating mb-3">
              <input type="password" class="form-control" id="inputSenha" name="inputSenha" placeholder="******">
              <label for="inputSenha" class="form-label">Senha</label>
              <!-- TEM QUE BOTAR UM BOTÃO DE "ESQUECI MINHA  SENHA" -->
            </div>
            
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-primary">Confirmar</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  
  <!--CADASTRO Modal -->
  <div class="modal fade" id="cadastroModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <nav>
          <div class="nav nav-tabs" id="nav-tab" role="tablist">

            <button class="nav-link active" id="nav-pessoa-tab" data-bs-toggle="tab" data-bs-target="#nav-pessoa" type="button" role="tab" aria-controls="nav-pessoa" aria-selected="true">Pessoa</button>

            <button class="nav-link" id="nav-empresa-tab" data-bs-toggle="tab" data-bs-target="#nav-empresa" type="button" role="tab" aria-controls="nav-empresa" aria-selected="false">Empresa</button>

          </div>
        </nav>
          <div class="tab-content" id="nav-tabContent">
            <!-- MODAL DE CLIENTE -->
            <div class="tab-pane fade show active" id="nav-pessoa" role="tabpanel" aria-labelledby="nav-pessoa-tab">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cadastro de Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="php/controlador/cadPessoa.php" method="POST">
              <div class="modal-body">
                
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="InputNome1" aria-describedby="nomeHelp" name="inputNome" placeholder="Nome Completo">
                    <label for="InputNome1" class="form-label">Nome Completo</label>
                  </div>
                  
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="InputCPF1" aria-describedby="CPFHelp" name="inputCPF" placeholder="">
                    <label for="InputCPF1" class="form-label">CPF</label>
                  </div>
                  
                  
                  <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="InputEmail1" aria-describedby="emailHelp" name="inputEmail" placeholder="exemplo@emailcom">
                    <label for="InputEmail1" class="form-label">Endereço de e-mail</label>
                  </div>
                  
                  <!-- CAMPO  SENHA -->
                  <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="InputSenha1" name="inputSenha1" placeholder="******">
                    <label for="InputSenha1" class="form-label">Senha</label>
                  </div>
                  
                  <!-- CONFIRMAR SENHA -->
                  <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="InputSenha2" name="inputSenha2" placeholder="******">
                    <label for="InputSenha2" class="form-label">Confirmar Senha</label>
                  </div>
          
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary">Confirmar</button>
              </div>
              </form>
            </div>

            <!-- MODAL DA EMPRESA -->
            <div class="tab-pane fade" id="nav-empresa" role="tabpanel" aria-labelledby="nav-empresa-tab">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cadastro de Empresa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="php/controlador/cadEmpresa.php" method="POST">
              <div class="modal-body">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="InputNome2" name="inputNome" aria-describedby="nomeHelp" placeholder="Nome Completo">
                  <label for="InputNome2" class="form-label">Nome Completo</label>
                </div>
                
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="InputCNPJ1" name="inputCNPJ" aria-describedby="CNPJHelp" placeholder="CNPJ">
                  <label for="InputCNPJ1" class="form-label">CNPJ</label>
                </div>
                
                <div class="row g-2">
                  <div class="col-md">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="InputNumAgencia" name="inputAgencia" aria-describedby="numAgenciaHelp" placeholder="Agência">
                      <label for="numAgencia" class="form-label">Agência</label>
                    </div>    
                  </div>
                  <div class="col-md">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="InputNumConta" name="inputConta" aria-describedby="numContaHelp" placeholder="Número da Conta">
                      <label for="inputNumConta" class="form-label">Número da Conta</label>
                    </div>    
                  </div>
                </div>

                <div class="form-floating mb-3">
                  <input type="email" class="form-control" id="InputEmail1" name="inputEmail" aria-describedby="emailHelp" placeholder="exemplo@emailcom">
                  <label for="InputEmail1" class="form-label">Endereço de e-mail</label>
                </div>
                
                <!-- CAMPO  SENHA -->
                <div class="form-floating mb-3">
                  <input type="password" class="form-control" id="InputSenha1" name="inputSenha1" placeholder="******">
                  <label for="InputSenha1" class="form-label">Senha</label>
                </div>
                
                <!-- CONFIRMAR SENHA -->
                <div class="form-floating mb-3">
                  <input type="password" class="form-control" id="InputSenha2" name="inputSenha2" placeholder="******">
                  <label for="InputSenha2" class="form-label">Confirmar Senha</label>
                </div>
    
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary">Confirmar</button>
              </div>
              </form>
            </div>
          </div>
      </div>
    </div>
  </div>


<!-- SCRIPTS -->
<script type="text/javascript" src="js/navbar-footer.js"></script>
<script type="text/javascript" src="js/jquery-1.2.6.pack.js"></script>
<script type="text/javascript" src="js/jquery.maskedinput-1.1.4.pack.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#InputCPF1").mask("999.999.999-99");
	});
</script>
</body>

</html>