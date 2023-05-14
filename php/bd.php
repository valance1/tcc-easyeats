<?php

$pdo = new PDO('sqlite:easyeats.sqlite');

$pdo->exec('CREATE TABLE IF NOT EXISTS pessoa(
    nome TEXT,
    senha TEXT,
    email TEXT,
    CPF text)');

$pdo->exec('CREATE TABLE IF NOT EXISTS empresa(
    nome TEXT,
    senha TEXT,
    email TEXT,
    CNPJ TEXT,
    agencia TEXT,
    conta TEXT)');


if (!$pdo->query("SELECT * FROM easyeats")>fetch()){
    // $pdo->exec("INSERT INTO easyeats")
};

?>