<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>EasyEats</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="assets/icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
    <link href='css/main.css' rel="stylesheet">
    <!-- ICONES -->
    <script src="https://kit.fontawesome.com/2cf2c5048f.js" crossorigin="anonymous"></script>

    <!-- TOASTER -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

    <!-- ANIMATIONS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>

<body>

    <?php include 'php/components/navbar.php' ?>

    <!-- PREVIEW RESTAURANTS -->
    <section class="average-section" id="session">
        <hr class="hr" />
        <div class="section-text-container mb-5">
            <h1 class="h1">Termos de Serviço do EasyEats</h1>
            <p class="lead text-secondary">Leia antentamente</p>
        </div>

        <h2>1. Aceitação dos Termos</h2>
        <p>Ao acessar ou utilizar o EasyEats, você concorda em cumprir os termos e condições estabelecidos aqui. Se você
            não concordar com algum dos termos, pedimos que você não utilize nosso site.</p>

        <h2>2. Uso Responsável</h2>
        <p>Você concorda em usar o EasyEats de forma responsável e ética. Não é permitido o uso indevido de nossos
            serviços, incluindo atividades ilegais, spam, assédio, ou qualquer comportamento que prejudique a
            experiência de outros usuários.</p>

        <h2>3. Cadastro de Conta</h2>
        <p>Para acessar alguns recursos do EasyEats, você pode ser solicitado a criar uma conta. Você é responsável por
            manter suas informações de login seguras e atualizadas. Não compartilhe suas credenciais de acesso com
            terceiros.</p>

        <h2>4. Privacidade</h2>
        <p>Nós respeitamos a privacidade dos nossos usuários. Suas informações pessoais serão tratadas de acordo com
            nossa Política de Privacidade, que você pode ler em nossa página de Política de Privacidade.</p>

        <h2>5. Conteúdo do Usuário</h2>
        <p>Você pode contribuir com conteúdo para o EasyEats, como avaliações e comentários. Ao fazer isso, você concede
            ao EasyEats uma licença para usar, exibir e distribuir esse conteúdo em nosso site.</p>

        <h2>6. Alterações nos Termos de Serviço</h2>
        <p>O EasyEats se reserva o direito de atualizar ou modificar esses Termos de Serviço a qualquer momento.
            Quaisquer alterações serão publicadas em nosso site, e seu uso continuado do EasyEats após essas mudanças
            constituirá sua aceitação dos termos revisados.</p>

        <h2>7. Encerramento da Conta</h2>
        <p>O EasyEats pode encerrar sua conta a qualquer momento, se considerarmos que você violou esses Termos de
            Serviço.</p>

    </section>

    <?php include 'php/components/footer.php' ?>
    <?php include 'php/components/forms.php' ?>
    <script type="text/javascript" src="js/main.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>