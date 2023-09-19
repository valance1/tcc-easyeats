<?php
function inserirPessoa($conexao, $nome, $senha, $email, $cpf)
{
        $sql = "INSERT INTO pessoa (nome, cpf, email, senha, credito) VALUES ('$nome', '$cpf', '$email', '$senha', '0')";
        mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
}

function adicionarCredito($conexao, $email, $creditoNovo, $creditoAntigo){
        $credito = floatval($creditoNovo) + floatval($creditoAntigo);
        $sql =  "UPDATE pessoa SET credito='$credito' WHERE email = '$email'";
        mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
}
?>