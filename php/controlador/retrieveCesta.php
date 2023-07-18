<?php

require_once "FuncoesUteis.php";
require_once "../dao/conexaoBD.php";
require_once "../dao/cestaDAO.php";

session_start();

$conexao = conectarBD();

// Vamos pegar a cesta do indivíduo
$idCesta = $_POST['idCesta'];

// Checar se a cesta existe
$sqlCode = "SELECT * FROM cesta WHERE idCesta = '$idCesta'";
$query = mysqli_query(conectarBD(), $sqlCode);
if(mysqli_num_rows($query) == 0){
    echo '
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        Nenhum pedido com esse ID foi encontrado.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    ';
    exit();
}

// Vamos verificar se a ceste pertence a empresa!
$cnpj = retornaVal($conexao, 'empresa', 'email', $_SESSION['email'], 'CNPJ');
$cnpjCesta = retornaVal($conexao, 'cesta', 'idCesta', $idCesta, 'empresa');
if($cnpj != $cnpjCesta){
    echo '
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        O pedido que você está tentando acessar pertence a outra loja.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    ';
    exit();

}


$itens = json_decode(retornaVal($conexao, 'cesta', 'idCesta', $idCesta, 'itens'));

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
                    <div class="card product-card my-3 d-flex flex-row" data-aos="fade-up">
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

echo '
<div class="mt-5" style="
display: flex;
width: 100%;
align-content: center;
justify-content: center;
">
    <button class="btn btn-outline-dark" id="pagarcesta" onclick=abaterCesta("' . $idCesta . '")>Abater ficha(s)</button>
</div>';

?>