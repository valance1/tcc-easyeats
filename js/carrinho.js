// Array para armazenar os produtos selecionados
const carrinho = [];

// Função para adicionar um produto ao carrinho
function adicionarAoCarrinho(produto) {
  carrinho.push(produto);
  atualizarCarrinho();
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


adicionarAoCarrinho(produto1);
adicionarAoCarrinho(produto2);
