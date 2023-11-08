window.addEventListener('DOMContentLoaded', function () {
    // Botao de visualizar itens 
    searchButton1 = document.getElementById("search-button1")
    searchButton2 = document.getElementById("search-button2");
    
    searchButton1.addEventListener('click', function(){
        textoPesquisa = document.getElementById('search-input').value;
        $.ajax({
            method: 'POST',
            url: 'php/controlador/searchBar.php',
            data: 'texto=' + textoPesquisa,

            xhr: function () {
                var xhr = new XMLHttpRequest();
                return xhr;
            },

            success: function (resultado) {
            },

            error: function () {
                alert("ERRO");
            },

            complete: function (response) {
                codHtml = response.responseText;
                containterAlvo = document.getElementsByClassName('transacaoPedidoTR');
                containterAlvo[0].innerHTML = codHtml;
            },
        });
    });
    document.addEventListener("keyup", function(event) {
        if (event.code === 'Enter') {
            searchButton.click();
        }
    });
});