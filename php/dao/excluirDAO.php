<?php
function deleteUser($conexao, $email)
{
    $code = "SELECT * FROM empresa WHERE email = '$email'";
    $query = mysqli_query($conexao, $code) or die(mysqli_error($conexao));

    // Se a query de selecionar todas as empresas com o respectivo email não der certo, isso significa que é uma pessoa.
    // Portanto, vamos definir o novo código SQL para deletar a pessoa com o e-mail correspondente.
    if (mysqli_num_rows($query) == 0) {
        $code = "DELETE FROM pessoa WHERE EMAIL = '$email'";
        mysqli_query($conexao, $code) or die(mysqli_error($conexao));

        // Entretanto, se houver algum resultado, isso significa que a conta pertence a uma empresa, portanto:
    } else {
        // Deletando a imagem ao excluir o user do server
        $existingImagePath = "../../" . mysqli_fetch_assoc($query)['perfil'];
        if (file_exists($existingImagePath)) {
            unlink($existingImagePath);
        }
        $code = "DELETE FROM empresa WHERE EMAIL = '$email'";
        mysqli_query($conexao, $code) or die(mysqli_error($conexao));
    }
}
;
?>