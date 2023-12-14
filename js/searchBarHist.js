window.addEventListener('DOMContentLoaded', function () {
    // Botao de visualizar itens 
    const searchButton1 = document.getElementById("search-button1")
    const searchButton2 = document.getElementById("search-button2");
    
    // Botao dos pedidos
    searchButton1.addEventListener('click', function(){
        var dados = new FormData();
        dados.append('field', "pedidos");
        dados.append('texto', document.getElementById('search-input1').value);
        
        $.ajax({
            method: 'POST',
            url: 'php/controlador/searchBarHist.php',
            data: dados,
            processData: false,
            contentType: false,

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

    // Botão responsável por chamar o arquivo php que irá lidar com a operação de abates.
    searchButton2.addEventListener('click', function(){
        var dados = new FormData();
        dados.append('field', "abate");
        dados.append('texto', document.getElementById('search-input2').value);
        
        $.ajax({
            method: 'POST',
            url: 'php/controlador/searchBarHist.php',
            data: dados,
            processData: false,
            contentType: false,

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
                
                // Exibir a resposta proveniente do arquivo PHP para o container da tabela
                codHtml = response.responseText;
                containerAlvo = document.getElementById('transacaoAbateTableCont');
                containerAlvo.innerHTML = codHtml;
            },
        });
    });
    
    // Simplesmente para fazer com que o usuário possa apertar enter e enviar o texto para o arquivo php, sem precisar apertar na lupinha
    // É um requisito que o campo de input seja o elemento ativo.
    document.addEventListener("keyup", function(event) {
        if (event.code === 'Enter' && document.getElementById("search-input1") == document.activeElement) {
            searchButton1.click();
        }
        if(event.code === 'Enter' && document.getElementById("search-input2") == document.activeElement){
            searchButton2.click()
        }
    });
});