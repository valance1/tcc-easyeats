<?php

  // Esse código serve simplesmente pra ser a ação do botão "excluir"
  session_start();
  require '../controlador/FuncoesUteis.php';
  
  // Vamos apagar o usuário com o atual email logado;
  deleteUser($_SESSION['email']);
  
  // Já apagado do nosso banco de dados, basta limpar do navegador.
  session_destroy();
  session_start();
  $_SESSION['toast'] = 'sucesso';
  $_SESSION['toastmsg'] = 'Conta deletada com sucesso';
  header("Location:../../index.php");
  
?>