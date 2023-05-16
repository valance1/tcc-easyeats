<?php
    require_once "FuncoesUteis.php";
    require_once "../dao/conexaoBD.php";
    require_once "../dao/pessoaDAO.php";

    // PASSO 1 - Receber os campos
    $nome = $_POST["txtNome"];
    $cpf = $_POST["txtCPF"];
    $email = $_POST["email"];
    $senha1 = $_POST["txtSenha1"];
    $senha2 = $_POST["txtSenha2"];

    // PASSO 2 - Validar os campos
    $msgErro = validarCampos($nome, $cpf, $ender, $dtNasc, $senha1, $senha2 );
    if ( empty($msgErro) ) {
        // PASSO 3 - Inserir/Alterar dados no banco
        $conexao = conectarBD();
        // INSERIR
        inserirPessoa($conexao, $nome, $senha1, $email, $cpf);
        // PASSO 4 - Resposta de SUCESSO       
        // header("Location:../visao/formulario.php?msg=Cadastro de $nome realizado com sucesso.");
        

    } else {
        // PASSO 4 - Resposta de ERRO
        // header("Location:../visao/formulario.php?msg=$msgErro");   
    }
?>

