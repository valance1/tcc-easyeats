//TODO 
// 1 - Quando o cara clicar no botão de carrinho, deve-se trocar o botão por outro que tem um +, -, e a quantidade
// 2 - Deve-se criar um botão de finalizar compra em algum lugar da página.

// Array para armazenar os produtos selecionados
const carrinho = [];

// Função para adicionar um produto ao carrinho
function adicionarAoCarrinho(produto) {
  carrinho.push(produto);
  console.log(carrinho);


  // carrinho.forEach((element) => {
  //     console.log(element)
  // }
  // );
  //TODO
  // Quando o carrinho for fechar, tem que contar as ocorrencias do ID na lista, multiplicar pelo preço para obter o valor.

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
