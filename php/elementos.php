<?php

function criarNavbar(){
    error_reporting(0);
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
            <li><a class="dropdown-item" href="php/controlador/logout.php">Desconectar</a></li>
          </ul>
        </li>';
        };
};
?>