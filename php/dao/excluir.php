<?php

  // Esse código serve simplesmente pra ser a ação do botão "excluir"
  session_start();
  require '../controlador/FuncoesUteis.php';
  require 'conexaoBD.php';
  
  // Vamos apagar o usuário com o atual email logado;

  // Verificar se não há nenhum pedido pendnete com a empresa
  if(existe(conectarBD(), 'pedidos', 'empresa', retornaVal(conectarBD(), 'empresa', 'email', $_SESSION['email'], 'CNPJ'))){
    $_SESSION['toast'] = 'erro';
    $_SESSION['toastmsg'] = 'Ainda há pedidos pendentes';
    header("Location:../../config.php");
  }

  deleteUser($_SESSION['email']);
  
  // Já apagado do nosso banco de dados, basta limpar do navegador.
  session_destroy();
  session_start();
  $_SESSION['toast'] = 'sucesso';
  $_SESSION['toastmsg'] = 'Conta deletada com sucesso';
  header("Location:../../index.php");
  
?>