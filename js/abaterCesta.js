window.addEventListener('DOMContentLoaded', function () {
    // Botao de visualizar itens 
    vizitem = document.getElementById("viz-pedido")
    vizitem.addEventListener('click', function () {
        idCesta = document.getElementById('inputPedido').value;
        $.ajax({
            method: 'POST',
            url: 'php/controlador/retrieveCesta.php',
            data: 'idCesta=' + idCesta,

            xhr: function () {
                var xhr = new XMLHttpRequest();
                return xhr;
            },

            success: function (resultado) {
                // codHtml = resultado.responseText;
                // document.getElementById('viz-cesta-itens').innerHTML = codHtml;
            },

            error: function () {
                alert("ERRO");
            },

            complete: function (response) {
                codHtml = response.responseText;
                containterAlvo = document.getElementById('viz-cesta-itens');
                if (containterAlvo.style.display === "none" || containterAlvo.innerHTML.trim() == "") {
                    containterAlvo.style.display = "block";
                    containterAlvo.innerHTML = codHtml;
                } else {
                    containterAlvo.style.display = "none";
                    containterAlvo.innerHTML = "";
                }
            },
        });
    });
    if(document.getElementById('inputPedido').value !== ""){
        vizitem.scrollIntoView();
        vizitem.click();
    }
});





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
            // Limpando a array
        },
    });
}