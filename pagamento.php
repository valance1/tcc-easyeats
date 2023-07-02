<?php
session_start();

// Se o usuário não estiver logado, LOL!
if(!$_SESSION['email']){
    header("Location:index.php");
}
if(isset($_SESSION['empresa'])){
    header("Location:index.php");
}
?>