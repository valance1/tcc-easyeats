<?php
// Vamos pegar a cesta do indivíduo
$email = $_SESSION['email'];
$sqlCode = "SELECT * FROM pessoa WHERE email = '$email'";
$query = mysqli_query($conexao, $sqlCode);
$cpf = mysqli_fetch_assoc($query)['cpf'];
$itens = json_decode(retornaVal($conexao, 'cesta', 'cliente', $cpf, 'itens'));

// ADICIONAR UM BOTÃO QUE FECHA
// Agora vamos exibir o que ele escolheu
$itemUnique = array_unique($itens);
foreach ($itemUnique as &$produto) {
    $imagemProduto = retornaVal($conexao, 'produto', 'idProduto', $produto, 'imagem');
    ;
    $descProduto = retornaVal($conexao, 'produto', 'idProduto', $produto, 'descricao');
    ;
    $nomeProduto = retornaVal($conexao, 'produto', 'idProduto', $produto, 'nome');
    $precoProduto = retornaVal($conexao, 'produto', 'idProduto', $produto, 'preco');
    $tmp = array_count_values($itens);
    $quantidade = $tmp[$produto];

    echo '
                    <div class="card product-card my-3 d-flex flex-row">
                    <div class="product-img-container">
                        <img class="float-start" src="' . $imagemProduto . '">
                    </div>
                    <div class="product-text-container ms-3 d-flex flex-column my-3  w-50 float-start">
                        <p class="fs-4 mb-0">' . $nomeProduto . '</p>
                        <p class="text-muted fs-6 my-1">' . $descProduto . '</p>
                        <p class="fw-bold text-success green mb-0">R$' . $precoProduto . '</p>
                    </div>
                    <div class="counterGroup">
                        <div class="form-control text-muted" id="productCounter">' . $quantidade . '</div>
                    </div>
                    </div>';
}

?>