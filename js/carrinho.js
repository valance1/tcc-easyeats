//TODO 
// 1 - Quando o cara clicar no botão de carrinho, deve-se trocar o botão por outro que tem um +, -, e a quantidade
// 2 - Deve-se criar um botão de finalizar compra em algum lugar da página.
// 3 - Quando o carrinho for fechar, tem que contar as ocorrencias do ID na lista, multiplicar pelo preço para obter o valor.

// Array para armazenar os produtos selecionados
const carrinho = [];

// Função para adicionar um produto ao carrinho
function adicionarAoCarrinho(produto) {
  // Adiciona o item ao carrinho final
  carrinho.push(produto);
  
  console.log(carrinho);

  //Mudanças necessárias na UI:
  substituirPorQuantidade('cartContainer' + produto, produto);
  // atualizarCarrinho();
}

// Função para remover um produto do carrinho
function removerDoCarrinho(index) {
  carrinho.splice(index, 1);
  atualizarCarrinho();
}

// Função para atualizar o carrinho na interface
function atualizarCarrinho() {
  const carrinhoContainer = document.getElementById('carrinho-container');
  carrinhoContainer.innerHTML = '';
}

function substituirPorQuantidade(containerId, idProduto) {
  var container = document.getElementById(containerId);
  container.innerHTML = `
  <div class="btn-group counterGroup">
    <button class="btn btn-danger subtrairBtn" onclick="subtrairProduto(` + idProduto + `)"> - </button>
    <div class="form-control text-muted" id="productCounter` + idProduto + `">1</div>
    <button class="btn btn-success somarBtn" onclick="incrementarProduto(` + idProduto + `)"> + </button>
  </div>

  `;
}

function substituirPorCartButton(idProduto) {
  var container = document.getElementById('cartContainer' + idProduto);
  container.innerHTML = `
  <button class="btn btn-success btn-buy-product" id="cartBtn` + idProduto + `" onclick="adicionarAoCarrinho(` + idProduto + `)"><i class="fa-solid fa-cart-shopping"></i></button>

  `;
}


function subtrairProduto(idProduto){
  const index = carrinho.indexOf(idProduto);

  // Se o produto existir, vamos remove-lo da lista
  if (index !== -1) {
    carrinho.splice(index, 1);
    var container = document.getElementById('productCounter' + idProduto);
    container.innerHTML = parseInt(container.innerHTML) - 1;
    // Caso ele já tenha sido removido por completo, vamos adicionar o botão do carrinho de novo.
    if(carrinho.indexOf(idProduto) === -1){
      substituirPorCartButton(idProduto);
    }
  }
  //Debug reasons
  console.log("PRODUTO REMOVIDO: ");
  console.log(carrinho);
}

function incrementarProduto(idProduto){
  // Adicionando na array oficial! (serverside)
  carrinho.push(idProduto);

  // Atualizando o valor do contador
  var container = document.getElementById('productCounter' + idProduto);
  container.innerHTML = parseInt(container.innerHTML) + 1;
  
  //Debug reasons
  console.log("PRODUTO ADCIIONADO: ");
  console.log(carrinho);

}
