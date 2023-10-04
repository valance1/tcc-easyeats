

function pagarPedido(idPedido, credito) {

    var formData = new FormData();
    formData.append('idPedido', idPedido);
    formData.append('pagarComCred', credito);
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

        success: function (res) {
            response = JSON.parse(res);
            if(response.error){
                alert(response.error);
            }else{
                window.location.href = 'index.php?msg="'  + response.success + ' "';
            }
            // window.location.href = 'index.php?msg="Pagamento feito com sucesso"';
        },

        error: function (res) {
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
        pagarPedido(item.getAttribute("data-num-pedido"), false)
    });
    item2 = document.getElementById('pagarPEDIDOCred');
    item2.addEventListener('click', function () {
        pagarPedido(item2.getAttribute("data-num-pedido"), true)
    });

});