<?php

function conectarBD()
{

    $usuario = 'root';
    $senha = 'root';
    $database = 'easyeats';
    $server = 'localhost';

    $conexao = mysqli_connect($server, $usuario, $senha, $database) or die("Erro ao conectar com o banco de dados.");

    // PARA RESOLVER PROBLEMAS DE ACENTUAÇÃO 
    // Converte CODIFICAÇÃO para UTF-8
    mysqli_query($conexao, "SET NAMES 'utf8'");
    mysqli_query($conexao, "SET character_set_connection=utf8");
    mysqli_query($conexao, "SET character_set_client=utf8");
    mysqli_query($conexao, "SET character_set_results=utf8");

    return $conexao;

}



?>