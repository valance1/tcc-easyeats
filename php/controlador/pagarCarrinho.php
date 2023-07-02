<?php
require_once "FuncoesUteis.php";
require_once "../dao/conexaoBD.php";
require_once "../dao/carrinhoDAO.php";

session_start();

// Verificando se tá logado
if(!$_SESSION['email']){
    echo "Usuário não está logado";
    exit();
}

if(isset($_SESSION['empresa'])){
    echo "Empresa não comrpa";
    exit();
}


// PASSO 1 - Receber os campos
$data = $_POST['data'];
print_r($data);
$conexao = conectarBD();

// Pegar o CPF da pessoa para fazer o cadastro do ID da compra
$email = $_SESSION['email'];
$sqlCode = "SELECT * FROM pessoa WHERE email = '$email'";
$query = mysqli_query($conexao, $sqlCode);
$cpf = mysqli_fetch_assoc($query)['cpf'];
echo 'cpf: ' . $cpf;

// OBS, só pode existir um pedido no BD com o CPF, vamos dropar o antigo se isso acontecer
$sqlCode = "SELECT * FROM pedidos WHERE cliente = '$cpf'";
$query = mysqli_query($conexao, $sqlCode);
if (mysqli_num_rows($query) >= 1) {
  echo 'Pedido já existe, vamos dropar o antigo';

  // Código para dropar o pedido antigo
  removerPedido($conexao, $cpf);
}

// Parte que pega os preços
$precoPedido = 0;
$multiplicarArray = array_unique($data);

foreach ($multiplicarArray as &$produto) {
    $preco = retornarPreco($conexao, $produto);
    $tmp = array_count_values($data);
    $ocorrencias = $tmp[$produto];
    $precoTotal = $ocorrencias * $preco;

    // Atualizando o valor fora da array;
    $precoPedido = $precoPedido + $precoTotal;
};
echo 'Preco: ' . $precoPedido;
// Essa Array é responsável por determinar os itens que serão criados
echo json_encode($data);

$pedidoID = bin2hex(random_bytes(5));
echo $pedidoID;
// Agora podemos inserir o novo pedido
criarPedido($conexao, $pedidoID, $cpf, $preco, json_encode($data));
echo '</br> Pedido Criado com sucesso';

?>