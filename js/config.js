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


// EDITAR FOTO DA EMPRESA

window.addEventListener('DOMContentLoaded', function () {

    // Obtendo os objetos inputs
    var avatar = document.getElementById('avatar');
    var image = document.getElementById('avatarPlaceholder');
    var input = document.getElementById('inputGroupFile02');
    var $modal = $('#modalEditFotoEmpresa');
    var cropper;

    input.addEventListener('change', function (e) {
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

    $modal.on('shown.bs.modal', function () {
        cropper = new Cropper(image, {
            aspectRatio: 1,
            viewMode: 1,
        });
    }).on('hidden.bs.modal', function () {
        $modal.modal('hide');

        cropper.destroy();
        cropper = null;
    });

    document.getElementById('crop').addEventListener('click', function () {
        var initialAvatarURL;
        var canvas;

        $modal.modal('hide');

        if (cropper) {
            canvas = cropper.getCroppedCanvas({
              width: 256,
              height: 256,
            });
            initialAvatarURL = avatar.src;
            avatar.src = canvas.toDataURL();
            canvas.toBlob(function (blob) {
              var formData = new FormData();
    
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
                //   $alert.show().addClass('alert-success').text('Upload success');
                },
    
                error: function () {
                //   avatar.src = initialAvatarURL;
                //   $alert.show().addClass('alert-warning').text('Upload error');
                },
    
                complete: function () {
                //   $progress.hide();
                },
              });
            });
          }
    });
});

