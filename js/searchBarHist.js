window.addEventListener('DOMContentLoaded', function () {
    // Botao de visualizar itens 
    const searchButton1 = document.getElementById("search-button1")
    const searchButton2 = document.getElementById("search-button2");
    
    // Botao dos pedidos
    searchButton1.addEventListener('click', function(){
        dados = new FormData();
        dados.append('field', "pedidos");
        dados.append('texto', document.getElementById('search-input').value);
        
        $.ajax({
            method: 'POST',
            url: 'php/controlador/searchBarHist.php',
            data: dados,

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
                containerAlvo = document.getElementById('transacaoPedidoTableCont');
                containerAlvo.innerHTML = codHtml;
            },
        });
    });
    document.addEventListener("keyup", function(event) {
        if (event.code === 'Enter' && searchButton1.hasFocus()) {
            searchButton1.click();
        }
        if(event.code === 'Enter' && searchButton2.hasFocus()){
            searchButton2.click()
        }
    });
});