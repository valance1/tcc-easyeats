const imagens = [];

function validateInput(input) {
    if (input.value.trim() === '' || input.value.trim() === null) {
        input.classList.add("is-invalid");
        return false;
    }
    input.classList.remove("is-invalid");
    return true;
}

// Form para criar produto
const cadProdutoForm = document.getElementById('cadProdutoForm');

cadProdutoForm.addEventListener('submit', function (event) {
    event.preventDefault(); // Impede o envio padrão do formulário

    // Coletando os inputs
    const nomeProd = document.getElementById('inputNomeProduto');
    const descProd = document.getElementById('inputDescProduto');
    const precoProd = document.getElementById('inputPreco');


    // Verificando os campos
    let fields = [nomeProd, descProd, precoProd];
    for (let field of fields) {
        if (!validateInput(field)) {
            return;
        }
    };

    // Cria um objeto FormData para enviar os dados do formulário
    const formData = new FormData();
    console.log(imagens[0]);
    formData.append('inputImagemProduto', imagens[0]);
    formData.append('inputNomeProduto', nomeProd.value);
    formData.append('inputDescProduto', descProd.value);
    formData.append('inputPreco', precoProd.value);

    // Envia os dados para o arquivo PHP usando uma requisição AJAX
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'php/controlador/cadProduto.php', true);
    xhr.onload = function () {
        if (xhr.status === 200) {

            var data = JSON.parse(xhr.responseText);
            console.log(data);

            if (data.msg != "Sucesso no cadastro") {
                // temporário, devemos adicioanr um jquery especificando o erro ao invés de colocar num diabo de um alert.
                toastr["error"](data.msg);
            } else {
                $('#cadProdutoModal').modal('hide');
                window.location.href = "config.php";
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

//Form para deletar produto
function removeModal(id) {
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

//Form para editar um produto
function editModal(id, nomeProd, descricaoProd, precoProd) {

    // Pegando o objeto dos inputs
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

// EDITAR FOTO DA EMPRESA

window.addEventListener('DOMContentLoaded', function () {
    let elements = document.querySelectorAll('.sr-only');
    
    elements.forEach((item) => {
        item.addEventListener('click', function(){
            editarFoto(item);
        });
    });
    
        // Criar o modal uma vez, fora do loop
        var $modal = $('#modalEditFoto');
        var cropper;
        var image = document.getElementById('avatarPlaceholder');
        
        // Configurar eventos do modal
        
        $modal.on('shown.bs.modal', function () {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 3,
            });
        }).on('hidden.bs.modal', function () {
            $modal.modal('hide');
    
            cropper.destroy();
            cropper = null;
        });
    
    // Vou utilizar o mesmo modal, cada vez que o botão é clicado, ele vai carregar consigo um data attriute
    function editarFoto(input) {
    
        // Devemos verificar a origem do input
        if (input.getAttribute("data-item-id") == 'empresa') {
            var avatar = document.getElementById('avatar');
        }else if(input.getAttribute("data-item-id") == 'cadProdutoImage' ){
            var avatar = document.getElementById('prodCadPlaceholder');
        } else {
            var avatar = document.getElementById('pic' + input.getAttribute("data-item-id"));
        }
        console.log("AVATAR:" + avatar.getAttribute('id'));
        console.log("AVATAR SRC:" + avatar.getAttribute('src'));
        // Placeholder dentro do modal
        image.setAttribute("src", avatar.getAttribute("src"));;
    
        input.addEventListener('change', function (e) {
            // Editar valor do botão crop!
            document.getElementById('crop').setAttribute("data-item-id", input.getAttribute("data-item-id"));
            var files = e.target.files;
            var done = function (url) {
                input.value = '';
                image.src = url;
                $modal.modal('show');
            };
            var reader;
            var file;
            var url;
    
            if (files && files.length > 0) {
                file = files[0];
    
                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function (e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });
    };
    
    document.getElementById('crop').addEventListener('click', function () {
        var initialAvatarURL;
        var canvas;
    
        var cropBtn = document.getElementById('crop');
        if (cropBtn.getAttribute("data-item-id") == 'empresa') {
            var avatar = document.getElementById('avatar');
        }else if(cropBtn.getAttribute("data-item-id") == 'cadProdutoImage'){
            var avatar = document.getElementById('prodCadPlaceholder');
        } else {
            var avatar = document.getElementById('pic' + cropBtn.getAttribute("data-item-id"));
        }
    
        $modal.modal('hide');
    
        if (cropper) {
            canvas = cropper.getCroppedCanvas({
                width: 256,
                height: 256,
            });
            initialAvatarURL = avatar.src;
            
            // Debug reasons
            console.log("DATA DO INPUT: " + cropBtn.getAttribute("data-item-id"));
            console.log("Condição if(): " + cropBtn.getAttribute("data-item-id") == 'empresa');
            console.log("avatar.src:  " + avatar.src);
            console.log("BLOB: " + canvas.toDataURL());
    
            avatar.src = canvas.toDataURL();
            canvas.toBlob(function (blob) {
                var formData = new FormData();
                
                // Vantagem do AJAX: posso obter a resposta do arquivo php e retornar um warning e etc.
                if (cropBtn.getAttribute("data-item-id") == 'empresa') {
                    formData.append('inputImagem', blob, 'avatar.jpg');
                    $.ajax({
                        method: 'POST',
                        url: 'php/controlador/editEmpresa.php',
                        data: formData,
                        processData: false,
                        contentType: false,
    
                        xhr: function () {
                            var xhr = new XMLHttpRequest();
                            return xhr;
                        },
    
                        success: function () {
                            console.log("Sucesso");
                            toastr["success"]("Imagem da empresa alterada com sucesso!");
                            // window.location.href = "config.php";
                            //   $alert.show().addClass('alert-success').text('Upload success');
                        },
    
                        error: function () {
                              avatar.src = initialAvatarURL;
                            //   $alert.show().addClass('alert-warning').text('Upload error');
                        },
    
                        complete: function () {
                            //   $progress.hide();
                        },
                    });
                }else if(cropBtn.getAttribute("data-item-id") == 'cadProdutoImage'){
                    imagens.push(blob);
                } else {
                    formData.append('id', cropBtn.getAttribute("data-item-id"));
                    formData.append('imagem', blob, 'prod.jpg');
                    $.ajax({
                        method: 'POST',
                        url: 'php/controlador/editProduto.php',
                        data: formData,
                        processData: false,
                        contentType: false,
    
                        xhr: function () {
                            var xhr = new XMLHttpRequest();
                            return xhr;
                        },
    
                        success: function () {
                            console.log("Sucesso no cad Produto");
                            toastr["success"]("Imagem do produto alterada com sucesso!");
                            // window.location.href = "config.php";
                            //   $alert.show().addClass('alert-success').text('Upload success');
                        },
    
                        error: function () {
                            avatar.src = initialAvatarURL;
                            //   $alert.show().addClass('alert-warning').text('Upload error');
                        },
    
                        complete: function (response) {
                            // var data = JSON.parse(response.responseText);
                            // alert(response.responseText);
                            // alert.log(data);
                        },
                    });
                };
            });
        }
    });
    });

