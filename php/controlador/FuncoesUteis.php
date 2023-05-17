<?php
require_once '../dao/conexaoBD.php';

function validarCampos($nome, $cpf, $ender, $dtNasc, $senha1, $senha2 ) {
    $msgErro = "";
    if ( empty($nome)  ) {
        $msgErro = $msgErro . "NOME inválido! <BR>";            
    }
    
    if ( validarCPF($cpf) == false ) {
        $msgErro = $msgErro . "CPF inválido! <BR>";  
    }
    
    if ( empty($ender)  ) {
        $msgErro = $msgErro . "ENDEREÇO inválido! <BR>";            
    }
    
    if ( validarData($dtNasc) == false ) {
        $msgErro = $msgErro . "DATA inválida! <BR>";            
    }
    
    if ( strlen($senha1) < 6 ) {
        $msgErro = $msgErro . "A SENHA deve ter mais que 6 caracteres! <BR>"; 
    }
    
    if ( strcmp($senha1, $senha2) != 0 ) {
        $msgErro = $msgErro . "As SENHAS não conferem! <BR>"; 
    }
    
    return $msgErro;
}

function clearInjection($item){
    // $conexao = conectarBD();
    // return $conexao->real_escape_string($item);
    return $item;
}
function validarCPF($cpf) {
    return true;
}

function validarData($data) {
    $dataSep = explode("/", $data);
    
    if ( count($dataSep) != 3 ) {
        return false;
    } else {
        $dia = $dataSep[0];
        $mes = $dataSep[1];
        $ano = $dataSep[2];
        return checkdate($mes, $dia, $ano);            
    }
    
}
?>

