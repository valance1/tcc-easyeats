<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Verifica se todos os campos foram preenchidos
    if (isset($_POST["inputNomeContato"]) && isset($_POST["inputContactEmail"]) && isset($_POST["inputMensagemContato"])) {
        $nome = $_POST["inputNomeContato"];
        $email = $_POST["inputContactEmail"];
        $mensagem = $_POST["inputMensagemContato"];

        $destinatario = "easyeatsenterprise@gmail.com";
        $assunto = "Formulário de Contato";
        $headers = "De: " . $email . "\r\n";

        // Monta o corpo do email
        $corpo_email = "Nome: " . $nome . "\n";
        $corpo_email .= "Email: " . $email . "\n";
        $corpo_email .= "Mensagem:\n" . $mensagem;

        // Envia o email
        if (mail($destinatario, $assunto, $corpo_email, $headers)) {
            echo "Mensagem enviada com sucesso!";
        } else {
            echo "Ocorreu um erro ao enviar a mensagem.";
        }
    } else {
        echo "Todos os campos são obrigatórios.";
    }
}
?>
