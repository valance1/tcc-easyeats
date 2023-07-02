// window.addEventListener('DOMContentLoaded', function () {
//     var $modal = $('#modalEditFotoEmpresa');
//     var image = document.getElementById('avatarPlaceholder');
//     var cropper;
//     var produtoId; // Variável para armazenar o ID do produto atualmente sendo editado

//     // Função para abrir o modal e iniciar o cropper
//     function openModal() {
//         $modal.modal('show');
//         cropper = new Cropper(image, {
//             aspectRatio: 1,
//             viewMode: 3,
//         });
//     }

//     // Função para fechar o modal e destruir o cropper
//     function closeModal() {
//         $modal.modal('hide');
//         cropper.destroy();
//         cropper = null;
//     }

//     // Evento de clique nos botões de edição de foto
//     $('.inputEditProdutoImagem').on('click', function () {
//         // Obtém o ID do produto a partir do atributo data-produto-id
//         produtoId = $(this).data('produto-id');
//         openModal();
//     });

//     // Evento de clique no botão de recorte
//     document.getElementById('crop').addEventListener('click', function () {
//         var initialAvatarURL;
//         var canvas;

//         closeModal();

//         if (cropper) {
//             canvas = cropper.getCroppedCanvas({
//                 width: 256,
//                 height: 256,
//             });
//             initialAvatarURL = avatar.src;
//             avatar.src = canvas.toDataURL();
//             canvas.toBlob(function (blob) {
//                 var formData = new FormData();
//                 formData.append('imagem', blob, 'avatar.jpg');
//                 formData.append('id', produtoId); // Adiciona o ID do produto ao FormData

//                 // Envie a solicitação para o arquivo PHP correspondente ao produto atual
//                 $.ajax({
//                     method: 'POST',
//                     url: 'php/controlador/editProduto.php',
//                     data: formData,
//                     processData: false,
//                     contentType: false,

//                     xhr: function () {
//                         var xhr = new XMLHttpRequest();
//                         return xhr;
//                     },

//                     success: function () {
//                         console.log("Sucesso");
//                         toastr["success"]("Imagem do produto alterado com sucesso!");
//                     },

//                     error: function () {
//                         // Trate o erro conforme necessário
//                     },

//                     complete: function () {
//                         // Faça algo após a conclusão do envio
//                     },
//                 });
//             });
//         }
//     });
// });
