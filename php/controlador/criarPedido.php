<?php
require_once "FuncoesUteis.php";
require_once "../dao/conexaoBD.php";
require_once "../dao/pedidoDAO.php";

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
echo 'cpf: ' . $cpf;

// Mesma coisa com empresa
$cnpj = retornaVal($conexao, 'produto', 'idProduto', $data[0], 'CNPJ');
echo $cnpj;

// OBS, só pode existir um pedido no BD com o CPF, vamos dropar o antigo se isso acontecer
$sqlCode = "SELECT * FROM pedidos WHERE cliente = '$cpf'";
$query = mysqli_query($conexao, $sqlCode);
if (mysqli_num_rows($query) >= 1) {
  echo 'Pedido já existe, vamos dropar o antigo';

  // Código para dropar o pedido antigo
  removerPedido($conexao, $cpf);
}

// Verificar se os pedidos estão disponíveis
$valido = true;
foreach ($data as $item) {
    $dispoTMP = retornaVal($conexao, 'produto', 'idProduto', $item, 'disponivel');
    if ($dispoTMP != 'true') {
        $valido = false;
        break;
    }
}
if ($valido == true) {
    echo "Todos os itens são validos";
} else {
    echo "Pare de tentar alterar o código.";
    exit(); 
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
echo json_encode($data, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);

// Encontrando um ID para o pedido, caso exista, vamos ficar loopando até não existir
$pedidoID = bin2hex(random_bytes(5));
while (existe($conexao, 'pedidos', 'idPedido', $pedidoID)){
    $pedidoID = bin2hex(random_bytes(5));
};

echo $pedidoID;
// Agora podemos inserir o novo pedido

criarPedido($conexao, $pedidoID, $cpf, $precoPedido, json_encode($data), $cnpj);
echo '</br> Pedido Criado com sucesso';

?>