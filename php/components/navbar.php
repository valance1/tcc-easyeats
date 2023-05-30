<?php
error_reporting(0);

echo '
<nav class="navbar navbar-expand-lg bg-body-tertiary" style="padding-right: 150px; padding-left: 150px">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">EasyEats</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">

      <!-- LEFT SIDE -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="restaurantes.php">Restaurantes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="">Contato</a>
        </li>
      </ul>

      <!-- RIGHT SIDE -->
      <ul class="navbar-nav me-auto"></ul>
';

    if(!$_SESSION['email']){
        echo '
    <li class="nav-item">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
      </li>
      <li class="nav-item">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cadastroModal">Cadastrar</button>
      </li>';
    }else{
        echo '
        <li class="nav-item dropdown" style="
display:  flex;
align-items: center;">
      <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">' . $_SESSION['email']. '
      </a>
      <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="config.php">Configurações</a></li>
        <li><a class="dropdown-item" href="php/controlador/logout.php">Desconectar</a></li>

      </ul>
    </li>';
    };
    
    echo '  </ul>
        </div>
      </div>
    </nav>';
?>