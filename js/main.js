toastr.options.closeButton = true;
toastr.options.closeButton = true;

//SCRIPT EXPERIMENTAL! 
// -----------------------------------------------
// Obtém referências para os elementos do modal
const logModal = document.getElementById('loginModal');
const logForm = document.getElementById('loginForm');

// Manipula o evento de envio do formulário (vai ficar esperando caso o submit parta do form: LoginForm)
logForm.addEventListener('submit', function(event) {
    event.preventDefault(); // Impede o envio padrão do formulário
    
    // Coletando os inputs
    const email = document.getElementById('inputLogEmail');
    const senha = document.getElementById('inputLogSenha');

    // Verifica se os campos estão preenchidos
    if ( (email.value.trim() === '' || email.value.trim() === null)) {
        
        // Marcando o campo como inválido
        email.classList.add("is-invalid");
        return;
    }else{
        email.classList.remove("is-invalid");
    }

    if ( senha.value.trim() === '' || senha.value.trim() === null ){

         // Marcando o campo como inválido
         senha.classList.add("is-invalid");
         return;
    }else{
        senha.classList.remove("is-invalid")
    }

    // Cria um objeto FormData para enviar os dados do formulário
    const formData = new FormData();
    formData.append('inputEmail', email.value);
    formData.append('inputSenha', senha.value);

    // Envia os dados para o arquivo PHP usando uma requisição AJAX
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'php/controlador/logCliente.php', true);
    xhr.onload = function() {
        if (xhr.status === 200) {

            // Sucesso: exibe a resposta do arquivo PHP
            // xhr.responseText retorna o todos os echos e locations do arquivo .php em uma string! (pode ser útil)
            alert('Cadastro realizado com sucesso!');
            $('#loginModal').modal('hide');
            // location.reload();

            // Tem que dar um jeito de passar as mensagens?
            window.location.href = "index.php"
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
const regModal = document.getElementById('');
const regForm = document.getElementById('');
