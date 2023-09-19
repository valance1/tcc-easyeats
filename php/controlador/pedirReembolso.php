<?php
require_once "FuncoesUteis.php";
require_once "../dao/conexaoBD.php";
require_once "../dao/pessoaDAO.php";
require_once "../dao/pedidoDAO.php";
require_once "../dao/itemDAO.php";

session_start();

// Verificando se tá logado
if(!$_SESSION['email']){
    echo "Usuário não está logado";
    exit();
}
if(isset($_SESSION['empresa'])){
    echo "Empresa não compra";
    exit();
}

// PASSO 1 - Receber os campos
$data = $_POST['data'];
print_r($data);
$conexao = conectarBD();

// Pegar o CPF da pessoa para fazer o cadastro do ID da compra
$cpf = retornaVal($conexao, 'pessoa', 'email', $_SESSION['email'], 'cpf');
// echo 'cpf: ' . $cpf;

// Mesma coisa com empresa
$cnpj = retornaVal($conexao, 'produto', 'idProduto', $data[0], 'CNPJ');
// echo $cnpj;

// Parte que pega os preços
$precoPedido = 0;
$multiplicarArray = array_unique($data);


foreach ($multiplicarArray as &$produto) {
    $preco = retornarPreco($conexao, $produto);
    $tmp = array_count_values($data);
    $ocorrencias = $tmp[$produto];
    
    $sqlCode = "SELECT * FROM item WHERE idProduto = '$produto' AND donoDoItem='$cpf'";
    $fichasBD = mysqli_num_rows(mysqli_query($conexao, $sqlCode));
    if($ocorrencias > $fichasBD){
        echo "Você está tentando sair com vantagem";
        exit();
    }

    $precoTotal = $ocorrencias * $preco;

    // Atualizando o valor fora da array;
    $precoPedido = $precoPedido + $precoTotal;

    // Removendo a ficha do inventário
    for ($i = 0; $i < $ocorrencias; $i++) {
        excluirItem($conexao, $produto, $cpf, $cnpj);
    }
};
echo 'Preco: ' . $precoPedido;

$credito = retornaVal($conexao, 'pessoa', 'CPF', $cpf, 'credito');
adicionarCredito($conexao, $_SESSION['email'], $precoPedido, $credito);

?>