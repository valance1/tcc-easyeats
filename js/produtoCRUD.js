function removeModal(id){
        // Cria um objeto FormData para enviar os dados do formulário
        const formData = new FormData();
        formData.append('id', id);

        // Envia os dados para o arquivo PHP usando uma requisição AJAX
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'php/controlador/deleteProduto.php', true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                window.location.href = "config.php";
            } else {
                alert('Ocorreu um erro ao enviar os dados para o nosso servidor.');
            }
        };
        xhr.send(formData);
};

function editModal(id, nomeProd, descricaoProd, precoProd){
    
    // Pegando o objeto dos inputs
    const imagem = document.getElementById('inputEditProdutoImagem');
    const nome = document.getElementById('inputEditNomeProduto');
    const desc = document.getElementById('inputEditDescProduto');
    const preco = document.getElementById('inputEditPreco');

    // Abrindo o modal com os valores antigos
    nome.value = nomeProd;
    desc.value = descricaoProd;
    preco.value = precoProd;

    // Abrindo o modal
    $('#editProdutoModal').modal('show');

    // Selecionando o form pra botar o event listener
    // Será que esse método adiciona um event listener a cada vez que o botão é clicado?

    let editProdutoForm = document.getElementById('editProdutoForm'); 
    editProdutoForm.addEventListener('submit', function (event) {
        // Impedindo o submit padrão
        event.preventDefault();

        // Criando um formulário fantasma e enviando esses dados
        const formData = new FormData();
        formData.append('id', id);
        formData.append('imagem', imagem.files[0]);
        formData.append('nome', nome.value);
        formData.append('desc', desc.value);
        formData.append('preco', preco.value);

        // Cria uma request para enviar os dados pro arquivo php
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'php/controlador/editProduto.php', true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                // alert(xhr.responseText);
                window.location.href = "config.php";
            } else {
                alert('Ocorreu um erro ao enviar os dados para o nosso servidor.');
            }
        };
        xhr.send(formData);
    }
    );
};