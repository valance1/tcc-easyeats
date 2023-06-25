//PIPELINE: MODAIS PRECISAM DE VERIFICAÇÕES SEM BD FEITAS POR JS
// OUTRAS LóGICAS DEVEM SER FEITAS EM PHP!


// var form = document.getElementById('EditUserInfosForm')
// form.addEventListener('submit', function () {
//     sessionStorage.setItem("reloading", "true");
//     document.location.reload();
// })

// window.onload = function () {
//     var reloading = sessionStorage.getItem("reloading");
//     if (reloading) {
//         sessionStorage.removeItem("reloading");
//         $('#success-message-modal').modal('show')
//     }
// }


//SCRIPT EXPERIMENTAL! 
// -----------------------------------------------
// Obtém referências para os elementos do modal
const logModal = document.getElementById('loginModal');
const logForm = document.getElementById('loginForm');

// Manipula o evento de envio do formulário (vai ficar esperando caso o submit parta do form: LoginForm)
logForm.addEventListener('submit', function (event) {
    event.preventDefault(); // Impede o envio padrão do formulário

    // Coletando os inputs
    const email = document.getElementById('inputLogEmail');
    const senha = document.getElementById('inputLogSenha');

    // Verifica se os campos estão preenchidos
    if ((email.value.trim() === '' || email.value.trim() === null)) {

        // Marcando o campo como inválido
        email.classList.add("is-invalid");
        return;
    } else {
        email.classList.remove("is-invalid");
    }

    if (senha.value.trim() === '' || senha.value.trim() === null) {

        // Marcando o campo como inválido
        senha.classList.add("is-invalid");
        return;
    } else {
        senha.classList.remove("is-invalid");
    }

    // Cria um objeto FormData para enviar os dados do formulário
    const formData = new FormData();
    formData.append('inputEmail', email.value);
    formData.append('inputSenha', senha.value);

    // Envia os dados para o arquivo PHP usando uma requisição AJAX
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'php/controlador/logCliente.php', true);
    xhr.onload = function () {
        if (xhr.status === 200) {

            // Sucesso: exibe a resposta do arquivo PHP
            // xhr.responseText retorna o todos os echos e locations do arquivo .php em uma string! (pode ser útil)
            alert('Login realizado com sucesso!');
            $('#loginModal').modal('hide');
            // location.reload();

            // Tem que dar um jeito de passar as mensagens?
            window.location.href = "index.php";
            toastr.success("'. $text .'");
        } else {

            // Erro: exibe uma mensagem de erro
            alert('Ocorreu um erro ao enviar os dados para o nosso servidor.');
        }
    };

    // Por algum motivo diabólico isto tem que vir depois do if (?)
    xhr.send(formData);
});

// -----------------------------------------------
//Modal registro
const cadModal = document.getElementById('cadastroModal');
const cadPessoaForm = document.getElementById('cadPessoa');

// Manipula o evento de envio do formulário (vai ficar esperando caso o submit parta do form: LoginForm)
cadPessoaForm.addEventListener('submit', function (event) {
    event.preventDefault(); // Impede o envio padrão do formulário

    // Coletando os inputs
    const email = document.getElementById('inputRegEmailPessoa');
    const nome = document.getElementById('inputRegNomePessoa');
    const cpf = document.getElementById('inputRegCPF');
    const senha1 = document.getElementById('inputRegSenhaPessoa1');
    const senha2 = document.getElementById('inputRegSenhaPessoa2');

    if (nome.value.trim() === '' || nome.value.trim() === null) {
        nome.classList.add("is-invalid");
        return;
    } else { nome.classList.remove("is-invalid"); }

    if (cpf.value.trim() === '' || cpf.value.trim() === null) {
        cpf.classList.add("is-invalid");
        return;
    } else { cpf.classList.remove("is-invalid"); }

    // Verifica se os campos estão preenchidos
    if ((email.value.trim() === '' || email.value.trim() === null)) {
        email.classList.add("is-invalid");
        return;
    } else { email.classList.remove("is-invalid"); }

    if (senha1.value.trim() === '' || senha1.value.trim() === null) {
        senha1.classList.add("is-invalid");
        return;
    } else { senha1.classList.remove("is-invalid") }

    if (senha2.value.trim() === '' || senha2.value.trim() === null) {
        senha2.classList.add("is-invalid");
        return;
    } else { senha2.classList.remove("is-invalid"); }

    // Cria um objeto FormData para enviar os dados do formulário
    const formData = new FormData();
    formData.append('inputNome', nome.value);
    formData.append('inputEmail', email.value);
    formData.append('inputCPF', cpf.value);
    formData.append('inputSenha1', senha1.value);
    formData.append('inputSenha2', senha2.value);

    // Envia os dados para o arquivo PHP usando uma requisição AJAX
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'php/controlador/cadPessoa.php', true);
    xhr.onload = function () {
        if (xhr.status === 200) {

            // Sucesso: exibe a resposta do arquivo PHP
            // xhr.responseText retorna o todos os echos e locations do arquivo .php em uma string! (pode ser útil)

            // Aqui vamos coletar os erros mais sensíveis, relacionados ao SQL ou algo do tipo...

            // EXEMPLOS 
            //<?php
            //   $a = "apple";
            //   $b = "banana";

            //   echo json_encode( array( 'a' => $a, 'b' => $b ) );
            // ?> 
            // EM JS: data.a mostra a variável
            var data = JSON.parse(xhr.responseText);
            console.log(data);

            if (data.msg != "Sucesso no cadastro") {
                // temporário, devemos adicioanr um jquery especificando o erro ao invés de colocar num diabo de um alert.
                alert(data.msg);
            } else {
                alert('Cadastro realizado com sucesso!');
                $('#cadastroModal').modal('hide');
                window.location.href = "index.php";
            }
            // location.reload();

        } else {

            // Erro: exibe uma mensagem de erro
            alert('Ocorreu um erro ao enviar os dados para o nosso servidor.');
        }
    };

    // Por algum motivo diabólico isto tem que vir depois do if (?)
    xhr.send(formData);
});

const cadEmpresaForm = document.getElementById('cadEmpresa');

cadEmpresaForm.addEventListener('submit', function (event) {
    event.preventDefault(); // Impede o envio padrão do formulário

    // Coletando os inputs
    const email = document.getElementById('InputRegEmailEmpresa');
    const dono = document.getElementById('InputRegNomeDonoEmpresa');
    const nome = document.getElementById('InputRegNomeEmpresa');
    const cpf = document.getElementById('inputRegCPFEmpresa');
    const cnpj = document.getElementById('InputRegCNPJ');
    const agencia = document.getElementById('InputNumAgencia');
    const conta = document.getElementById('InputNumConta');
    const senha1 = document.getElementById('InputRegSenhaEmpresa1');
    const senha2 = document.getElementById('InputRegSenhaEmpresa2');

    if (cpf.value.trim() === '' || cpf.value.trim() === null) {
        cpf.classList.add("is-invalid");
        return;
    } else { cpf.classList.remove("is-invalid"); }

    if (dono.value.trim() === '' || dono.value.trim() === null) {
        dono.classList.add("is-invalid");
        return;
    } else {
        dono.classList.remove("is-invalid")
    }

    if (nome.value.trim() === '' || nome.value.trim() === null) {
        nome.classList.add("is-invalid");
        return;
    } else { nome.classList.remove("is-invalid"); }

    if (cnpj.value.trim() === '' || cnpj.value.trim() === null) {
        cnpj.classList.add("is-invalid");
        return;
    } else {
        cnpj.classList.remove("is-invalid")
    }

    if (agencia.value.trim() === '' || agencia.value.trim() === null) {
        agencia.classList.add("is-invalid");
        return;
    } else {
        agencia.classList.remove("is-invalid")
    }
    if (conta.value.trim() === '' || conta.value.trim() === null) {
        conta.classList.add("is-invalid");
        return;
    } else {
        conta.classList.remove("is-invalid")
    }
    if (email.value.trim() === '' || email.value.trim() === null) {
        email.classList.add("is-invalid");
        return;
    } else {
        email.classList.remove("is-invalid")
    }
    if (senha1.value.trim() === '' || senha1.value.trim() === null) {
        senha1.classList.add("is-invalid");
        return;
    } else { senha1.classList.remove("is-invalid") }
    if (senha2.value.trim() === '' || senha2.value.trim() === null) {
        senha2.classList.add("is-invalid");
        return;
    } else { senha2.classList.remove("is-invalid"); }

    // Cria um objeto FormData para enviar os dados do formulário
    const formData = new FormData();
    formData.append('inputNome', nome.value);
    formData.append('inputDono', dono.value);
    formData.append('inputEmail', email.value);
    formData.append('inputCPF', cpf.value);
    formData.append('inputCNPJ', cnpj.value);
    formData.append('inputAgencia', agencia.value);
    formData.append('inputConta', conta.value);
    formData.append('inputSenha1', senha1.value);
    formData.append('inputSenha2', senha2.value);

    // Envia os dados para o arquivo PHP usando uma requisição AJAX
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'php/controlador/cadEmpresa.php', true);
    xhr.onload = function () {
        if (xhr.status === 200) {

            var data = JSON.parse(xhr.responseText);
            console.log(data);

            if (data.msg != "Sucesso no cadastro") {
                // temporário, devemos adicioanr um jquery especificando o erro ao invés de colocar num diabo de um alert.
                alert(data.msg);
            } else {
                alert('Cadastro realizado com sucesso!');
                $('#cadastroModal').modal('hide');
                window.location.href = "index.php";
            }
            // location.reload();

        } else {

            // Erro: exibe uma mensagem de erro
            alert('Ocorreu um erro ao enviar os dados para o nosso servidor.');
        }
    };

    // Por algum motivo diabólico isto tem que vir depois do if (?)
    xhr.send(formData);
});