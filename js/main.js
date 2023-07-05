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

toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-bottom-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }


// Função pra validar dados
function validateInput(input) {
    if (input.value.trim() === '' || input.value.trim() === null) {
        input.classList.add("is-invalid");
        return false;
    }
    input.classList.remove("is-invalid");
    return true;
}

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
    let fields = [email, senha];
    for (let field of fields) {
        if (!validateInput(field)) {
            return;
        }
    };
    
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
            // alert('Login realizado com sucesso!');
            $('#loginModal').modal('hide');
            location.reload();

            // Tem que dar um jeito de passar as mensagens?
            // window.location.href = "index.php";
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

    // Verificando
    let fields = [nome, cpf, email, senha1, senha2];
    // Apesar disso, é necessário verificar serverside para impedir algum engraçadinho de foder com o BD.
    for (let field of fields) {
        if (!validateInput(field)) {
            return;
        }
    };

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
                toastr["error"](data.msg);
            } else {
                // alert('Cadastro realizado com sucesso!');
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


    // Verificando os campos
    let fields = [cpf, dono, nome, cnpj, agencia, conta, email, senha1, senha2];
    for (let field of fields) {
        if (!validateInput(field)) {
            return;
        }
    };

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
                toastr["error"](data.msg);
            } else {
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