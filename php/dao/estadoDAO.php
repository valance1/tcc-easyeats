<?php

function carregarComboEstados() {
    
    include_once "../dao/conexaobd.php"; // CONECTAR
    $conexao = conectarBD();

    $sql = "SELECT * FROM Estado";
    $res = mysqli_query($conexao, $sql) or die ( mysqli_error($conexao) );
                            
    $itens = "";
    while ( $registro = mysqli_fetch_assoc($res) ) {
        $sigla = $registro["siglaEstado"];
        $nome = $registro["nomeEstado"];

        $itens = $itens . "<OPTION value= '$sigla' >$nome</OPTION>"; 
    }
    
    return $itens;
}

?>

