// Array para armazenar os produtos selecionados
const cesta = [];
const quantidadesOriginais = {}; // Armazena as quantidades originais dos produtos
const produtos = {};

// Função para contar a quantidade de um determinado produto na cesta
function contarQuantidade(produto) {
  let quantidade = 0;

  for (let i = 0; i < cesta.length; i++) {
    if (cesta[i] === produto) {
      quantidade++;
    }
  }

  return quantidade;
}

function subtrairProduto(botao, idProduto){
    var botaoAdd = botao.nextElementSibling.nextElementSibling;
    if(botaoAdd.disabled){
        botaoAdd.removeAttribute('disabled');
    };
  const index = cesta.indexOf(idProduto);

  // Se o produto existir, vamos removê-lo da lista
  if (index !== -1) {
    cesta.splice(index, 1);
    var container = document.getElementById('productCounter' + idProduto);
    container.innerHTML = Math.max(parseInt(container.innerHTML) - 1, 0);

    // Caso ele já tenha sido removido por completo.
    if (contarQuantidade(idProduto) === 0){
    }
  }
  //Debug reasons
  console.log("PRODUTO REMOVIDO: ");
  console.log(cesta);
}

function incrementarProduto(botao, idProduto){
  const quantidadeMaxima = quantidadesOriginais[idProduto]; // Obtém a quantidade máxima do produto
  console.log(quantidadeMaxima);
  console.log(quantidadesOriginais);

  // Verifica se a quantidade máxima foi definida
  if (quantidadeMaxima !== undefined) {
    // Verifica se a quantidade atual excede a quantidade máxima
    if (contarQuantidade(idProduto) >= quantidadeMaxima) {
      botao.setAttribute("disabled", "");
      alert("Quantidade máxima atingida!");
      return; // Sai da função se a quantidade máxima foi atingida
    }
  }

  // Adicionando na array oficial! (serverside)
  cesta.push(idProduto);

  // Atualizando o valor do contador
  var container = document.getElementById('productCounter' + idProduto);
  container.innerHTML = parseInt(container.innerHTML) + 1;
  
  //Debug reasons
  console.log("PRODUTO ADCIIONADO: ");
  console.log(cesta);
  if (contarQuantidade(idProduto) >= quantidadeMaxima) {
    botao.setAttribute("disabled", "");
  }
}

function finalizarCompra(){
  if(cesta.length == 0){
    alert("Cesta vazio, operação cancelada");
  }else{
    // Vamos criar o pedido no servidor
    $.ajax({
      method: 'POST',
      url: 'php/controlador/criarCesta.php',
      data: {data:cesta},
      xhr: function () {
          var xhr = new XMLHttpRequest();
          return xhr;
      },

      success: function () {
        //Redirect no usuário para a página do QRCode
        //
        alert("Sucesso");
        window.location.href = 'pagamento.php';
      },

      error: function () {
        alert("erro");
      },

      complete: function (res) {
        // alert(res.responseText);
        console.log(res.responseText);
        // Limpando a array
      
      },
    });
  }
}

// Função para inicializar as quantidades originais dos produtos
function inicializar() {
  // Percorre todos os elementos com a classe "quantidade-original"
  const elementos = document.getElementsByClassName("quantidade-original");

  for (let i = 0; i < elementos.length; i++) {
    const elemento = elementos[i];
    const quantidade = elemento.getAttribute("data-quantidade");
    const idProduto = elemento.getAttribute("data-id");

    // Armazena a quantidade original do produto
    quantidadesOriginais[idProduto] = parseInt(quantidade);
  }

//   Vamos fazer a mesma coisa para os produtos

    // for (let i = 0; i < elementos.length; i++) {
    //     const elemento = elementos[i];
    //     const quantidade = elemento.getAttribute("data-quantidade");
    //     const idProduto = elemento.getAttribute("data-id");

    //     // Armazena a quantidade original do produto
    //     quantidadesOriginais[idProduto] = Array();
    // }


}

// Inicializa as quantidades originais dos produtos ao carregar a página
inicializar();
