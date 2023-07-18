

function abaterCesta(idCesta) {
    // Vamos criar o Cesta no servidor
    $.ajax({
        method: 'POST',
        url: 'php/controlador/abaterCesta.php',
        data: 'idCesta=' + idCesta,

        xhr: function () {
            var xhr = new XMLHttpRequest();
            return xhr;
        },

        success: function (res) {
            //Redirect no usuário para a página do QRCode
            //
            toastr["success"]('Pedido abatido com sucesso!');
            document.getElementById('viz-cesta-itens').innerHTML = "";
        },

        error: function (res) {
            toastr["error"]('Erro no sistema! ' + res.responseText);
        },

        complete: function (res) {
            alert(res.responseText);
            // Limpando a array

        },
    });
}