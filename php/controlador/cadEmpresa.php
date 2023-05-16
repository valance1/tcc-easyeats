<?php
    require_once "FuncoesUteis.php";
    require_once "../dao/conexaoBD.php";
    require_once "../dao/pessoaDAO.php";

    // PASSO 1 - Receber os campos
    $nome = $_POST["inputNome"];
    $CNPJ = $_POST["inputCNPJ"];
    $email = $_POST["inputEmail"];
    $senha1 = $_POST["inputSenha1"];
    $senha2 = $_POST["inputSenha2"];
    $agencia = $_POST["inputAgencia"];
    $conta = $_POST["inputConta"];

    $conexao = conectarBD();
    // INSERIR
    inserirEmpresa($conexao, $nome, $senha1, $email, $CNPJ, $agencia, $conta);
?>

