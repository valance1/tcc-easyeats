<?php

  // Esse código serve simplesmente pra ser a ação do botão "excluir"
  session_start();
  require '../dao/excluirDAO.php';
  require '../dao/conexaoBD.php';
  require 'FuncoesUteis.php';
  
  // Vamos apagar o usuário com o atual email logado;

  // Verificar se não há nenhum pedido pendnete com a empresa
  if(existe(conectarBD(), 'pedidos', 'empresa', retornaVal(conectarBD(), 'empresa', 'email', $_SESSION['email'], 'CNPJ'))){
    $_SESSION['toast'] = 'erro';
    $_SESSION['toastmsg'] = 'Ainda há pedidos pendentes, você só pode excluir sua conta enquanto não houver nenhum pedido.';
    header("Location:../../config.php");
  }
    // Verificar se não há nenhum pedido pendnete com a empresa
  if(existe(conectarBD(), 'item', 'empresa', retornaVal(conectarBD(), 'empresa', 'email', $_SESSION['email'], 'CNPJ'))){
    $_SESSION['toast'] = 'erro';
    $_SESSION['toastmsg'] = 'Você não pode excluir sua conta enquanto há usuários com fichas da sua loja.';
    header("Location:../../config.php");
  }

  deleteUser(conectarBD(), $_SESSION['email']);
  
  // Já apagado do nosso banco de dados, basta limpar do navegador.
  session_destroy();
  header("Location:../../index.php?toast=sucesso&toastmsg=Conta deletada com sucesso");
  
?>