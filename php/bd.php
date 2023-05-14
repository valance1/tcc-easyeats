<?php

$usuario = 'root';
$senha = 'root';
$database = 'easyeats';
$server = 'localhost';

$mysqli = new $mysqli($server, $usuario, $senha, $database);

if($mysqli0->error){
  die('Falha  no banco de dados:' . $mysqli->error);
}
?>