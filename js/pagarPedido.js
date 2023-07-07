

function pagarPedido(idPedido) {

    var formData = new FormData();
    formData.append('idPedido', idPedido);
    console.log(idPedido);
    // Vamos criar o pedido no servidor
    $.ajax({
        method: 'POST',
        url: 'php/controlador/pagarPedido.php',
        data: formData,
        processData: false,
        contentType: false,

        xhr: function () {
            var xhr = new XMLHttpRequest();
            return xhr;
        },

        success: function () {
            //Redirect no usuário para a página do QRCode
            //
            alert("Sucesso");
            window.location.href = 'index.php?msg="Pagamento feito com sucesso"';
        },

        error: function () {
            alert("erro");
        },

        complete: function (res) {
            // alert(res.responseText);
            // Limpando a array

        },
    });
}

window.addEventListener('DOMContentLoaded', function () {
    item = document.getElementById('pagarPEDIDO');
    item.addEventListener('click', function () {
        pagarPedido(item.getAttribute("data-num-pedido"))
    });

});