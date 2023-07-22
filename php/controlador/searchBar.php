<?php 
    require '../dao/conexaoBD.php';
    require_once "FuncoesUteis.php";
    
    $texto = $_POST['texto'];

    // Selecionando todas as empresas
    if(empty($texto)){
        $code = "SELECT * FROM empresa";
    }else{
        $code = "SELECT * FROM empresa WHERE LOWER(nome) LIKE LOWER('%{$texto}%')";
    }
    $query = mysqli_query(conectarBD(), $code) or die(mysqli_error(conectarBD()));

    // Se houver alguma empresa, mostre a search bar e começe o while
    if (mysqli_num_rows($query) != 0) {

      // Pegando as empresas 1 por 1 e exibindo os cartões.
      while ($loja = mysqli_fetch_assoc($query)) {

        // Verificando se a loja já possui imagem
        if (!$loja['perfil']) {

          // Caso não tenha, colocar foto temporária
          $imagem = "images/placeholder/loja.png";
        } else {
          $imagem = $loja['perfil'];
        }

        // Tive que dar vários "echo" por conta da interpolação de variáveis.
        echo '
        <div data-aos="fade-up" class="card card-loja px-0 rounded" style="width: 18rem;">
        <img src="' . $imagem . '" class="card-img-top loja-foto" alt="...">
        <div class="card-body loja-details">';
        echo '<h5 class="card-title fs-4 fw-bold">' . $loja["nome"] . '</h5>';
        echo '<p class="fs-6 fw-light text-muted">Lanchonete</p>';
        echo '<a href="cardapio.php?loja=' . $loja['nome'] . '"class="btn btn-outline-dark fw-normal">VER</a>';
        echo '</div></div>';
      }

      // Se não houver nenhuma, mostre o card de indisponibilidade
    } else {
      echo '
      <div class="card container-xxl text-center" id="noEmpresasFound">
        <div class="card-body">
          <h5 class="card-title">OPS!</h5>
          <img src="images/CAT.gif" alt="this slowpoke moves" class="my-2"  width="250" />
          <p class="card-text">Desculpe, mas não encontramos nenhuma loja em nosso banco de dados.</p>
        </div>
      </div>
    ';
    }
?>