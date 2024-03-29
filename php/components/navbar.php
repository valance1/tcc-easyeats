<?php
error_reporting(0);
require_once 'php/controlador/FuncoesUteis.php';
require_once 'php/dao/conexaoBD.php';

echo '
<nav class="navbar navbar-dark navbar-expand-lg bg-body-tertiary" style="padding-right: 150px; padding-left: 150px">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php"><img src="assets/brand.png" style="
    height: 50px;
    width: 50px;
"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon">
      </span>
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
        <a type="button" class="nav-link" id="contactModalOpenButton" data-bs-toggle="modal" data-bs-target="#contactModal" style="color: #fff !important;">Contato</a>
        </li>
      </ul>

      <!-- RIGHT SIDE -->
      <ul class="navbar-nav me-auto"></ul>
';

    if(!$_SESSION['email']){
        echo '
    <li class="nav-item">
        <button type="button" class="btn btn-outline-light" id="loginBUTTON" data-bs-toggle="modal" data-bs-target="#loginModal" style="margin-right: 16px;">Login</button>
      </li>
      <li class="nav-item">
        <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#cadastroModal">Cadastrar</button>
      </li>';
    }else{
      if(isset($_SESSION['empresa'])){
        echo '
        <li class="nav-item dropdown"  style="
        display:  flex;
        align-items: center;">
          <a class="nav-link dropdown-toggle" id="emailNav"  href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">' . $_SESSION['email']. '</a>
        <ul class="dropdown-menu">
      ';

      }else{
        
        $credito = retornaVal(conectarBD(), 'pessoa', 'email', $_SESSION['email'], 'credito');
        $credito = 0 + floatval($credito);
        echo '<li class="nav-item nav-credito">R$' . $credito .  '</li>';
        echo '
        <li class="nav-item dropdown"  style="
        display:  flex;
        align-items: center;">
          <a class="nav-link dropdown-toggle" id="emailNav" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">' . $_SESSION['email']. '</a>
        <ul class="dropdown-menu">
      ';
      }

      // De qualquer jeito, vamos abrir um dropdown
      if(isset($_SESSION['empresa']) == false){
        echo '<li><a class="dropdown-item" href="inventario.php">Inventário</a></li>';
      };
      if(isset($_SESSION['empresa'])){
        echo '<li><a class="dropdown-item" href="abater.php">Abater fichas</a></li>';
        echo '<li><a class="dropdown-item" href="historico.php">Pedidos</a></li>';
      };
      
      echo '
      <li><a class="dropdown-item" href="config.php"><i class="fa-solid fa-gear me-2"></i>Configurações</a></li>
        <li><a class="dropdown-item text-danger" href="php/controlador/logout.php"><i class="fa-solid fa-right-from-bracket me-2"></i>Desconectar</a></li>
      </ul>
    </li>';
    };
    
    echo '  </ul>
        </div>
      </div>
    </nav>';
?>