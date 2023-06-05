<?php
    session_start();
    require '../controlador/FuncoesUteis.php';
    deleteUser($_SESSION['email']);
    session_destroy();
?>