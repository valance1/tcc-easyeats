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

function editModal(id, nome, descricao, preco){
    let editProdutoModal = document.getElementById('editProdutoModal');
    editProdutoModal.modal('show');
    let editProdutoForm = document.getElementById('editProdutoForm');
    
    editProdutoForm.addEventListener('submit', function (event) {
    
    
    }

};