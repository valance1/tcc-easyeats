<?php

    require_once "FuncoesUteis.php";
    require_once "../dao/conexaoBD.php";
    require_once "../dao/clienteDAO.php";

    // PASSO 1 - Receber os campos
    $nome = $_POST["txtNome"];
    $cpf = $_POST["txtCPF"];
    $ender = $_POST["txtEndereco"];
    $estado = $_POST["listEstados"];
    $dtNasc = $_POST["txtData"];
    $sexo = $_POST["sexo"];
    $senha1 = $_POST["txtSenha1"];
    $senha2 = $_POST["txtSenha2"];
    
    // CheckBox
    $musica = 0;
    $info = 0;
    $cinema = 0;
    if ( isset( $_POST["checkMusica"] )  ) {
        $musica = 1;
    }
    if ( isset( $_POST["checkCinema"] )  ) {
        $cinema = 1;
    }
    if ( isset( $_POST["checkInfo"] )  ) {
        $info = 1;
    }


    // PASSO 2 - Validar os campos
    $msgErro = validarCampos($nome, $cpf, $ender, $dtNasc, $senha1, $senha2 );
    if ( empty($msgErro) ) {
        
        // PASSO 3 - Inserir/Alterar dados no banco
        
        $conexao = conectarBD();
        
        $dataConvertida = converterData($dtNasc);
        
        // INSERIR
        inserirCliente($conexao, $nome, $cpf, $ender, $dataConvertida , $sexo, $senha1, $musica, 
                        $info, $cinema, $estado );
        
        // PASSO 4 - Resposta de SUCESSO       
        header("Location:../visao/formulario.php?msg=Cadastro de $nome realizado com sucesso.");
        

    } else {
        // PASSO 4 - Resposta de ERRO
        
        header("Location:../visao/formulario.php?msg=$msgErro");
        
    }

    

?>

