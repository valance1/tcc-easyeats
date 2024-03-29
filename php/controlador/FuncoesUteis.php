<?php

function validaCPF($cpf)
{

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
}
;

function validaCNPJ($cnpj)
{
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
}
;

function validarData($data)
{
    $dataSep = explode("/", $data);

    if (count($dataSep) != 3) {
        return false;
    } else {
        $dia = $dataSep[0];
        $mes = $dataSep[1];
        $ano = $dataSep[2];
        return checkdate($mes, $dia, $ano);
    }
}
;

//Verifica se o algo existe
function existe($conexao, $tabela, $coluna, $valor)
{
    $sql = "SELECT * FROM $tabela WHERE '$coluna' = '$valor'";
    $query = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
    if (mysqli_num_rows($query) >= 1) {
        echo 'Usuário existe';
        return true;
    }else{
        return false;
    }
}

function retornaVal($conexao, $tabela, $coluna, $valor, $attr){
    $sql = "SELECT * FROM $tabela WHERE $coluna = '$valor'";
    $query = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
    if(mysqli_num_rows($query) === 0 || mysqli_num_rows($query) > 1){
        echo "NÃO EXISTE! VALOR: ". mysqli_num_rows($query);
        return false;
    }
    $obj = mysqli_fetch_assoc($query);
    return $obj[$attr];
}
function checkVazio() {
    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            echo "A variável '$key' está vazia.<br>";
            return true;
        }
    }
    return false;
}

function validarAgencia($agencia) {
    // Verificar se a agência possui 4 dígitos
    if (strlen($agencia) !== 4 || is_numeric($agencia) == false) {
        return false;
    }

    // Outras regras de validação específicas da agência (opcional)
    // ...

    return true;
}

function validarConta($conta) {
    // Verificar se a conta possui 8 ou 9 dígitos
    if (strlen($conta) !== 8 && strlen($conta) !== 9 || is_numeric($conta) == false ) {
        return false;
    }

    // Outras regras de validação específicas da conta (opcional)
    // ...

    return true;
}

?>