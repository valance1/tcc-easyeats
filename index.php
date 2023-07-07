<?php
// Iniciando sessão
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>EasyEats</title>
  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSS LOCAL -->
  <link rel="icon" type="image/x-icon" href="assets/icon.png">
  <link href="css/main.css" type="text/css" rel="stylesheet">

  <!-- BOOTSTRAP -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>

  <!-- TOASTER -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

  <!-- ICONES -->
  <script src="https://kit.fontawesome.com/2cf2c5048f.js" crossorigin="anonymous"></script>

  <!-- ANIMATIONS -->
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>

<body>
  <!-- Importando componente  -->
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

  if ($_SESSION['toast' == 'warning']) {
    createWarningAlert($_SESSION['toastmsg']);
    unset($_SESSION['toastmsg']);
    unset($_SESSION['toast']);
  }
  ?>
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
              <p>
                Espere menos, viva mais
              </p>
            </div>
          </div>

          <div class="lc-block mb-3">
            <div editable="rich">
              <p class="lead">
                Uma plataforma feita para você adiantar suas compras em lanchonetes
              </p>
            </div>
          </div>

          <div class="lc-block d-grid gap-2 d-md-flex justify-content-md-start">
            <a class="btn btn-outline-light px-4" href="restaurantes.php" role="button">Ver Restaurantes</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- PREVIEW RESTAURANTS -->
  <section class="average-section" id="restaurantes-preview">
    <hr class="hr" />
    <div data-aos="fade-right" class="section-text-container mb-5">
      <h1 class="h1"><a href="restaurantes.php">Restaurantes<i class="fa-solid fa-arrow-right ms-2"></i></a></h1>
      <p class="lead text-secondary">
        Ver restaurantes disponíveis na sua região
      </p>
    </div>

    <!-- PARA ALINHAR OS 3 RESTAURANTES  -->
    <div class="row row-cols-1 justify-content-evenly row-cols-md-3 g-4">
      <!-- CARTAO DO RESTAURANTE -->
      <?php
      require 'php/dao/conexaoBD.php';

      // Selecionando todas as empresas para adicionar os respectivos cards
      $code = "SELECT * FROM empresa";
      $query = mysqli_query(conectarBD(), $code);

      // Se o número for inferior a 3 devemos checar se esse valor é 0 ou simplesmente menor
      // Isso é necessário porque no for loop, se o número for inferior a 3, pode ocorrer um erro
      // Essa é a maneira mais rápida de contornar isso, caso não exista mais de 3 empresas.
      if (mysqli_num_rows($query) <= 3) {

        // Se o número de empresas selecionadas for 0, simplesmente exiba uma tela que avise que nenhuma empresa está cadastrada.
        if (mysqli_num_rows($query) == 0) {
          echo '
          <div data-aos="fade-up" class="card container-xxl text-center" id="noEmpresasFound">
            <div class="card-body">
              <h5 class="card-title">OPS!</h5>
              <img src="images/CAT.gif" alt="Não encontramos nada" class="my-2"  width="250" />
              <p class="card-text">Desculpe, mas não encontramos nenhuma loja em nosso banco de dados.</p>
            </div>
          </div>';
        } else {
          // Esse loop é necessário caso haja 1 ou 2 empresas.
      
          // O fetch row só avança de coluna quando o método é chamado, portanto, precisamos converter ele pra uma array.
          $resultado = array();
          while ($fetch = mysqli_fetch_assoc($query)) {
            $resultado[] = $fetch;
          }
          ;

          for ($i = 0; $i < mysqli_num_rows($query); $i++) {
            // Coletando os dados da empresa selecionada pelo $fetch
            $loja = $resultado[$i];

            // Verificando se a loja já possui imagem
            if (!$loja['perfil']) {

              // Caso não tenha, colocar foto temporária
              $imagem = "images/placeholder/loja.png";
            } else {
              $imagem = $loja['perfil'];
            }
            // Exibindo os resultados, imprimindo a imagem, o nome e a rota dinâmica da respectiva loja.
            echo '
            <div data-aos="fade-up" class="card card-loja px-0 rounded" style="width: 18rem;">
              <img src="' . $imagem . '" class="card-img-top loja-foto" alt="...">
              <div class="card-body loja-details">
                <h5 class="card-title fs-4 fw-bold">' . $loja['nome'] . '</h5>
                <p class="fs-6 fw-light text-muted">Lanchonete</p>
                <a href="cardapio.php?loja=' . $loja['nome'] . '" class="btn btn-outline-dark fw-normal">VER</a>
              </div>
            </div>';
          }
        }
      } else {

        // Esse loop é necessário caso haja 3 ou mais lojas. Dessa forma, não há repetição de cards nem erros.
      
        $resultado = array();
        while ($fetch = mysqli_fetch_assoc($query)) {
          $resultado[] = $fetch;
        }
        for ($i = 0; $i < 3; $i++) {

          // Coletando os dados da empresa selecionada pelo $fetch
          $loja = $resultado[$i];

          // Verificando se a loja já possui imagem
          if (!$loja['perfil']) {

            // Caso não tenha, colocar foto temporária
            $imagem = "images/placeholder/loja.png";
          } else {
            $imagem = $loja['perfil'];
          }
          // Exibindo os resultados, imprimindo a imagem, o nome e a rota dinâmica da respectiva loja.
          echo '
          <div data-aos="fade-up" class="card card-loja px-0 rounded" style="width: 18rem;">
          <img src="' . $imagem . '" class="card-img-top loja-foto" alt="...">
            <div class="card-body loja-details">
              <h5 class="card-title fs-4 fw-bold">' . $loja['nome'] . '</h5>
                <p class="fs-6 fw-light text-muted">Lanchonete</p>
                <a href="cardapio.php?loja=' . $loja['nome'] . '" class="btn btn-outline-dark fw-normal">VER</a>
            </div>
          </div>';
        }
      }
      ;
      ?>
    </div>
  </section>

  <!-- COMO USAR -->
  <section class="average-section" id="help">
    <hr class="hr" />
    <div data-aos="fade-right" class="section-text-container mb-5">
      <h1 class="h1">Perguntas e Respostas</h1>
      <p class="lead text-secondary">
        Como nosso site funciona?
      </p>
    </div>

    <div data-aos="fade-up" class="accordion" id="accordionExample">
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
            aria-expanded="true" aria-controls="collapseOne">
            Informações gerais
          </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <h1 id="tcc-easyeats">TCC EasyEats</h1>
            <p>Este é o repositório do projeto de conclusão de curso &quot;EasyEats&quot;. O EasyEats é um sistema de
              pedidos de alimentos online, desenvolvido como parte do trabalho de conclusão de curso (TCC) do autor. O
              objetivo deste projeto é criar uma plataforma intuitiva e eficiente para facilitar a comunicação entre
              restaurantes e clientes, permitindo que os usuários façam pedidos de alimentos de forma rápida e
              conveniente.</p>
            <h2 id="recursos-do-easyeats">Recursos do EasyEats</h2>
            <p>O EasyEats possui os seguintes recursos principais:</p>
            <ol>
              <li>
                <p><strong>Pedidos online</strong>: Os usuários podem navegar pelos menus dos restaurantes cadastrados,
                  selecionar os itens desejados e fazer pedidos de forma rápida e conveniente.</p>
              </li>
              <li>
                <p><strong>Rastreamento de pedidos</strong>: Os clientes podem acompanhar o status de seus pedidos em
                  tempo real, desde o momento em que são feitos até a entrega.</p>
              </li>
              <li>
                <p><strong>Avaliações e comentários</strong>: Os usuários podem avaliar e deixar comentários sobre os
                  restaurantes e os pratos que experimentaram, compartilhando suas experiências com outros usuários.</p>
              </li>
              <li>
                <p><strong>Pagamento seguro</strong>: O EasyEats oferece opções de pagamento seguras, permitindo que os
                  usuários realizem transações online de forma tranquila.</p>
              </li>
            </ol>
        
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            1. Crie sua conta
          </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
          <div class="accordion-body">
          <p>Para utilizar o EasyEats, é necessário criar uma conta. Siga estes passos para criar sua conta:</p>
        <ol>
          <li>Passo 1: Acesse a página de registro do EasyEats.</li>
          <li>Passo 2: Preencha o formulário de registro com suas informações pessoais, como nome, e-mail e senha.</li>
          <li>Passo 3: Clique no botão "Registrar" para criar sua conta.</li>
          <li>Passo 4: Após criar sua conta, você estará pronto para explorar os recursos do EasyEats.</li>
        </ol>
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            2. Visualize produtos
          </button>
        </h2>
        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
          <div class="accordion-body">
          <p>Com sua conta criada, você pode fazer pedidos no EasyEats seguindo estas etapas:</p>
        <ol>
          <li>Passo 1: Faça login em sua conta no EasyEats.</li>
          <li>Passo 2: Navegue pelos menus dos restaurantes cadastrados.</li>
          <li>Passo 3: Selecione os itens desejados e adicione ao seu carrinho de compras.</li>
          <li>Passo 4: Verifique o seu pedido no carrinho e prossiga para o pagamento.</li>
          <li>Passo 5: Escolha o método de pagamento e conclua a transação.</li>
          <li>Passo 6: Aguarde a confirmação do pedido e o status de entrega em tempo real.</li>
        </ol>
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
            3. Compre fichas
          </button>
        </h2>
        <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            Encontrou o restaurante que você deseja? Ótimo!
            Agora basta você clicar no botão "Ver", você será redirecionado para uma página que contém todos os produtos daquele estabelecimento.
            A partir daí, basta adicionar os itens desejados ao carrinho e fazer o pagamento via pix/cartão!

          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
            4. Acesse seu inventário para utilizar as fichas
          </button>
        </h2>
        <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            Com as fichas compradas, você pode acessar seu inventário clicando no canto superior direito. 
            Dentro do seu inventário, é possível visualizar todas as fichas adquiridas, para utilzá-las, basta clicar no botão ao lado do item para adicioná-lo ao QRCode que será utilizado como ficha.
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- Apresentando os desenvolvedores -->
  <section class="average-section" id="developers">
    <hr class="hr" />
    <div data-aos="fade-right" class="section-text-container mb-5">
      <h1 class="h1">Desenvolvedores</h1>
      <p class="lead text-secondary">
        Conheça nossa equipe
      </p>
    </div>

    <div class="row row-cols-1 justify-content-evenly row-cols-md-3 g-4">
      <!-- -------------------------------------------------- -->
      <div data-aos="fade-up" class="developer-card">
        <div class="developer-header d-flex justify-content-center align-items-center flex-column ">
          <span id="developer-status" class="fa fa-briefcase tt-info hover-tt-bottom"
            data-hover="Open to Opportunities"></span>
          <img class="developer-profile-img" src="images/placeholder/user.jpeg">
        </div>
        <div class="developer-content">
          <h4>Gabriel Gasparoni</h4>
          <p>
            Ideia
          </p>
          <hr>
          <ul>
            <li>País: <span>Brasil</span></li>
          </ul>
          <hr>
          <div class="developer-links">
            <a href="#" class="fa fa-instagram tt-info hover-tt-bottom" data-hover="Instagram"></a>
            <a href="#" class="fa fa-linkedin tt-info hover-tt-bottom" data-hover="LinkedIn"></a>
          </div>
          <hr>

        </div>
      </div>
      <!-- -------------------------------------------------- -->
      <div data-aos="fade-up" class="developer-card">
        <div class="developer-header d-flex justify-content-center align-items-center flex-column">
          <span id="developer-status" class="fa fa-briefcase tt-info hover-tt-bottom"
            data-hover="Open to Opportunities"></span>
          <img class="developer-profile-img" src="images/placeholder/user.jpeg">
        </div>
        <div class="developer-content">
          <h4>Gabriel Pinotti</h4>
          <p>
            FullStack Developer
          </p>

          <hr>
          <ul>
            <li class="tt-info hover-tt-bottom" data-hover="Expert">HTML</li>
            <li class="tt-info hover-tt-bottom" data-hover="Expert">CSS</li>
            <li class="tt-info hover-tt-bottom" data-hover="Expert">PHP</li>
            <li class="tt-info hover-tt-bottom" data-hover="Expert">C++</li>
            <li class="tt-info hover-tt-bottom" data-hover="Expert">Python</li>
            <li class="tt-info hover-tt-bottom" data-hover="Expert">Java</li>
            <li class="tt-info hover-tt-bottom" data-hover="Intermediate">JavaScript</li>
            <li class="tt-info hover-tt-bottom" data-hover="Expert">Photoshop</li>
          </ul>

          <ul>
            <li>Repositórios: <span>17</span></li>
            <li>País: <span>Brasil</span></li>
          </ul>
          <hr>

          <div class="developer-links">
            <a href="#" class="fa fa-instagram tt-info hover-tt-bottom" data-hover="Instagram"></a>
            <a href="https://github.com/valance1" class="fa fa-linkedin tt-info hover-tt-bottom"
              data-hover="LinkedIn"></a>
            <a href="#" class="fa fa-github tt-info hover-tt-bottom" data-hover="Github"></a>
          </div>
          <hr>

        </div>
      </div>
      <!-- -------------------------------------------------- -->
      <div data-aos="fade-up" class="developer-card">
        <div class="developer-header d-flex justify-content-center align-items-center flex-column">
          <span id="developer-status" class="fa fa-briefcase tt-info hover-tt-bottom"
            data-hover="Open to Opportunities"></span>
          <img class="developer-profile-img" src="images/placeholder/user.jpeg">
        </div>
        <div class="developer-content">
          <h4>Aldair Schmitberger</h4>
          <p>
            Backend Dev
          </p>

          <hr>
          <ul>
            <li class="tt-info hover-tt-bottom" data-hover="Intermediate">Python</li>
          </ul>

          <ul>
            <li>Repositórios: <span>1</span></li>
            <li>País: <span>Brasil</span></li>
          </ul>
          <hr>

          <div class="developer-links">
            <a href="#" class="fa fa-instagram tt-info hover-tt-bottom" data-hover="Instagram"></a>
            <a href="#" class="fa fa-linkedin tt-info hover-tt-bottom" data-hover="LinkedIn"></a>
            <a href="#" class="fa fa-github tt-info hover-tt-bottom" data-hover="Github"></a>
          </div>
          <hr>
        </div>
      </div>
      <!-- -------------------------------------------------- -->
    </div>
  </section>

  <!-- COMPONENTES PHP -->
  <?php include 'php/components/footer.php' ?>
  <?php include 'php/components/forms.php' ?>

  <script type="text/javascript" src="js/main.js"></script>
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>

</html>