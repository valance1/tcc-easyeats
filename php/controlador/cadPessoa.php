<?php
require_once "FuncoesUteis.php";
require_once "../dao/conexaoBD.php";
require_once "../dao/pessoaDAO.php";

// PASSO 1 - Receber os campos
$nome = $_POST["inputNome"];
$cpf = $_POST["inputCPF"];
$email = $_POST["inputEmail"];
$senha1 = $_POST["inputSenha1"];
$senha2 = $_POST["inputSenha2"];
// PASSO 3 - Inserir/Alterar dados no banco
$conexao = conectarBD();
// INSERIR
inserirPessoa($conexao, $nome, $senha1, $email, $cpf);
// PASSO 4 - Resposta de SUCESSO       
// header("Location:../visao/formulario.php?msg=Cadastro de $nome realizado com sucesso.");

?>