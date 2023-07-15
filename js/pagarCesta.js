

function usarCesta(idCesta) {

    var formData = new FormData();
    formData.append('idCesta', idCesta);
    console.log(idCesta);
    // Vamos criar o Cesta no servidor
    $.ajax({
        method: 'POST',
        url: 'php/controlador/usarCesta.php',
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
    item = document.getElementById('usarCesta');
    item.addEventListener('click', function () {
        usarCesta(item.getAttribute("data-num-Cesta"))
    });

});