<?php
require_once '../dao/conexaoBD.php';

function validaCPF($cpf){

    // Extrai somente os números
    $cpf = preg_replace('/[^0-9]/is', '', $cpf);

    // Verifica se foi informado todos os digitos corretamente
    if (strlen($cpf) != 11) {
        return false;
    }

    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    // Faz o calculo para validar o CPF
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
    return true;
};

function validaCNPJ($cnpj){
    $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);

    // Valida tamanho
    if (strlen($cnpj) != 14)
        return false;

    // Verifica se todos os digitos são iguais
    if (preg_match('/(\d)\1{13}/', $cnpj))
        return false;

    // Valida primeiro dígito verificador
    for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
        $soma += $cnpj[$i] * $j;
        $j = ($j == 2) ? 9 : $j - 1;
    }

    $resto = $soma % 11;

    if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto))
        return false;

    // Valida segundo dígito verificador
    for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++) {
        $soma += $cnpj[$i] * $j;
        $j = ($j == 2) ? 9 : $j - 1;
    }

    $resto = $soma % 11;

    return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
};

function validarData($data){
    $dataSep = explode("/", $data);

    if (count($dataSep) != 3) {
        return false;
    } else {
        $dia = $dataSep[0];
        $mes = $dataSep[1];
        $ano = $dataSep[2];
        return checkdate($mes, $dia, $ano);
    }
};
function mask($val, $mask){
    $maskared = '';
    $k = 0;
    for ($i = 0; $i <= strlen($mask) - 1; $i++) {
        if ($mask[$i] == '#') {
            if (isset($val[$k]))
                $maskared .= $val[$k++];
        } else {
            if (isset($mask[$i]))
                $maskared .= $mask[$i];
        }
    }
    return $maskared;
};
function deleteUser($email){

    $code = "SELECT * FROM empresa WHERE email = '$email'";
    $query = mysqli_query(conectarBD(), $code) or die(mysqli_error(conectarBD()));

    // Se a query de selecionar todas as empresas com o respectivo email não der certo, isso significa que é uma pessoa.
    // Portanto, vamos definir o novo código SQL para deletar a pessoa com o e-mail correspondente.
    if (mysqli_num_rows($query) == 0) {
        $code = "DELETE FROM pessoa WHERE EMAIL = '$email'";
        mysqli_query(conectarBD(), $code) or die(mysqli_error(conectarBD()));
        header("Location:../../index.php?msg=Conta deletada com sucesso.&toast=sucesso");
    
    // Entretanto, se houver algum resultado, isso significa que a conta pertence a uma empresa, portanto:
    }else{
        $code = "DELETE FROM empresa WHERE EMAIL = '$email'";
        mysqli_query(conectarBD(), $code) or die(mysqli_error(conectarBD()));
        header("Location:../../index.php?msg=Conta deletada com sucesso.&toast=sucesso");
    }
};

?>