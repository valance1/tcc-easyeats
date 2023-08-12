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
  <link href="css/index.css" type="text/css" rel="stylesheet">

  <!-- BOOTSTRAP -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>

  <!-- TOASTER -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

  <!-- ICONES -->
  <script src="https://kit.fontawesome.com/2cf2c5048f.js" crossorigin="anonymous"></script>

  <!-- ANIMATIONS -->
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>

<body>
  <!-- Importando componente  -->
  <?php
  include 'php/components/navbar.php' ?>
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
        <div class="col-10 col-sm-8 col-lg-6 imgHero">
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
    <div class="custom-shape-divider-bottom-1689380352">
      <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M598.97 114.72L0 0 0 120 1200 120 1200 0 598.97 114.72z" class="shape-fill"></path>
      </svg>
    </div>
    <!-- <div class="custom-shape-divider-bottom-1689036821">
    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
        <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
        <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
    </svg> -->
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

  <section class="average-section darkMode" id="aboutUs">
    <hr class="hr" />
    <div data-aos="fade-right" class="section-text-container mb-5">
      <h1 class="h1">Quem somos nós</h1>
      <p class="lead text-secondary">
        Conheça um pouco sobre o nosso negócio
      </p>
    </div>

    <div class="row gy-4" data-aos="fade-up">
      <div class="col-lg-7 position-relative about-img shadow rounded" style="background-size: cover;background-position: center;background-image: url(images/index/ee.jpg);"></div>

      <div class="col-lg-5 d-flex align-items-end"><p style="color: var(--whiteCool) !important;">Bem-vindo à EasyEats - A solução inteligente para evitar filas e aproveitar ao máximo suas refeições!<br><br>

Somos um aplicativo web criado por três jovens visionários do IFES, movidos por uma ideia que nasceu durante as
férias, ao presenciarmos as longas filas na cantina da escola. Decidimos enfrentar esse desafio e criar uma
plataforma inovadora que tornasse a experiência alimentar mais ágil, prática e saborosa para todos.<br><br>

Com a EasyEats, você pode adquirir fichas de refeição e armazená-las no seu inventário pessoal. Assim, quando a
fome bater ou a correria do dia a dia não permitir uma espera prolongada, é só utilizar nosso QRCode e saborear
sua refeição sem complicações.<br><br>

Acreditamos que o tempo é precioso e deve ser bem aproveitado, e é por isso que nosso aplicativo foi desenvolvido
com o objetivo de tornar suas refeições mais eficientes e satisfatórias.<br><br>

Seja bem-vindo(a) à EasyEats, onde a praticidade encontra o sabor em cada mordida. Junte-se a nós nessa jornada
gastronômica sem filas e desfrute de uma experiência única em alimentação!<br><br>

Estamos ansiosos para transformar suas refeições em momentos ainda mais especiais. Bon appétit!<br><br>
</p></div>

    </div>
  </section>


  <section class="average-section" id="developers">
    <!-- <hr class="hr" /> -->
    <!-- <div data-aos="fade-right" class="section-text-container mb-5">
      <h1 class="h1">Abobrinha</h1>
      <p class="lead text-secondary">
        Tenho qeu decidir oq ue fazer
      </p>
    </div> -->

    <!-- CONTENT -->
    <div data-aos="fade-up" class="container">

      <div class="row gy-4">

      <?php

      require_once 'php/dao/conexaoBD.php';

      $code = "SELECT * FROM empresa";
      $query = mysqli_query(conectarBD(), $code);
      $empresas = mysqli_num_rows($query); 

      $code = "SELECT * FROM pessoa";
      $query = mysqli_query(conectarBD(), $code);
      $clientes = mysqli_num_rows($query); ;

      $code = "SELECT * FROM transacaoabate";
      $query = mysqli_query(conectarBD(), $code);
      $abates = mysqli_num_rows($query); ;

      $code = "SELECT * FROM transacaopedido";
      $query = mysqli_query(conectarBD(), $code);
      $pedidos = mysqli_num_rows($query);


      echo '
      <div class="col-lg-3 col-md-6">
        <div class="stats-item text-center w-100 h-100 shadow rounded bg-body border">
          <span data-purecounter-start="0" data-purecounter-end="'.$clientes.'" data-purecounter-duration="1"
            class="purecounter"></span>
          <p>Clientes cadastrados</p>
        </div>
      </div><!-- End Stats Item -->

      <div class="col-lg-3 col-md-6">
      <div class="stats-item text-center w-100 h-100 shadow rounded bg-body border">
        <span data-purecounter-start="0" data-purecounter-end="'.$empresas.'" data-purecounter-duration="1"
          class="purecounter"></span>
        <p>Empresas cadastradas</p>
      </div>
    </div><!-- End Stats Item -->

    <div class="col-lg-3 col-md-6">
    <div class="stats-item text-center w-100 h-100 shadow rounded bg-body border">
      <span data-purecounter-start="0" data-purecounter-end="'.$pedidos.'" data-purecounter-duration="1"
        class="purecounter"></span>
      <p>Pedidos feitos</p>
    </div>
  </div><!-- End Stats Item -->


  <div class="col-lg-3 col-md-6">
  <div class="stats-item text-center w-100 h-100 shadow rounded bg-body border">
    <span data-purecounter-start="0" data-purecounter-end="'.$abates.'" data-purecounter-duration="1"
      class="purecounter"></span>
    <p>Transações concluídas</p>
  </div>
</div><!-- End Stats Item -->
      ';
?> 
      </div>

    </div>
  </section>


  <!-- COMO USAR -->
  <section class="average-section darkMode" id="help">
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
              <li>Passo 2: Preencha o formulário de registro com suas informações pessoais, como nome, e-mail e senha.
              </li>
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
            Agora basta você clicar no botão "Ver", você será redirecionado para uma página que contém todos os produtos
            daquele estabelecimento.
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
            Dentro do seu inventário, é possível visualizar todas as fichas adquiridas, para utilzá-las, basta clicar no
            botão ao lado do item para adicioná-lo ao QRCode que será utilizado como ficha.
          </div>
        </div>
      </div>

    </div>

    <div data-aos="fade-up" class="tutorialContainer">

      <h1 class="h1 mt-5">1. Guia para usuários comuns</h1>
      <div class="ratio ratio-16x9" style="max-width: 1080px; margin: auto;">
        <iframe src="https://www.youtube.com/watch?v=L3tsYC5OYhQ" title="Tutorial para clientes"
          allowfullscreen></iframe>
      </div>

      <h1 class="h1 mt-5">2. Guia para empresas</h1>
      <div class="ratio ratio-16x9" style="max-width: 1080px; margin: auto;">
        <iframe src="https://www.youtube.com/watch?v=L3tsYC5OYhQ" title="Tutorial para empresas"
          allowfullscreen></iframe>
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
            data-hover="Disponível para propostas!"></span>
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
          <!-- <hr>
          <div class="developer-links">
            <a href="#" class="fa fa-instagram tt-info hover-tt-bottom" data-hover="Instagram"></a>
            <a href="#" class="fa fa-linkedin tt-info hover-tt-bottom" data-hover="LinkedIn"></a>
          </div>
          <hr> -->

        </div>
      </div>
      <!-- -------------------------------------------------- -->
      <div data-aos="fade-up" class="developer-card">
        <div class="developer-header d-flex justify-content-center align-items-center flex-column">
          <span id="developer-status" class="fa fa-briefcase tt-info hover-tt-bottom"
            data-hover="Disponível para propostas!"></span>
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
            <a href="https://www.instagram.com/gabrielpinottibr/" class="fa fa-instagram tt-info hover-tt-bottom"
              data-hover="Instagram"></a>
            <a href="https://www.linkedin.com/in/gabriel-pinotti-a52abb239/"
              class="fa fa-linkedin tt-info hover-tt-bottom" data-hover="LinkedIn"></a>
            <a href="https://github.com/valance1" class="fa fa-github tt-info hover-tt-bottom" data-hover="Github"></a>
          </div>
          <hr>

        </div>
      </div>
      <!-- -------------------------------------------------- -->
      <div data-aos="fade-up" class="developer-card">
        <div class="developer-header d-flex justify-content-center align-items-center flex-column">
          <span id="developer-status" class="fa fa-briefcase tt-info hover-tt-bottom"
            data-hover="Disponível para propostas!"></span>
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
          <!-- <hr>

          <div class="developer-links">
            <a href="#" class="fa fa-instagram tt-info hover-tt-bottom" data-hover="Instagram"></a>
            <a href="#" class="fa fa-linkedin tt-info hover-tt-bottom" data-hover="LinkedIn"></a>
            <a href="#" class="fa fa-github tt-info hover-tt-bottom" data-hover="Github"></a>
          </div>
          <hr> -->
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
  <script src="js/counter.js"></script>
  <script>
    new PureCounter();
    AOS.init();
  </script>
</body>

</html>