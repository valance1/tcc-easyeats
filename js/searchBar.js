window.addEventListener('DOMContentLoaded', function () {
    // Botao de visualizar itens 
    searchButton = document.getElementById("search-button")
    
    searchButton.addEventListener('click', function(){
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
                containerAlvo = document.getElementsByClassName('result-container');
                containerAlvo[0].innerHTML = codHtml;
            },
        });
    });
    document.addEventListener("keyup", function(event) {
        if (event.code === 'Enter') {
            searchButton.click();
        }
    });
});