<?php

require_once "FuncoesUteis.php";
require_once "../dao/conexaoBD.php";
require_once "../dao/pedidoDAO.php";
require_once "../dao/empresaDAO.php";
require_once "../dao/pessoaDAO.php";
require_once "../dao/itemDAO.php";
require_once "../dao/transacaopedidoDAO.php";

session_start();

date_default_timezone_set('America/Sao_Paulo');

// Verificando se tá logado
if(!$_SESSION['email']){
    // echo "Usuário não está logado";
    exit();
}

if(isset($_SESSION['empresa'])){
    // echo "Empresa não compra";
    exit();
}


// Variáveis
$conexao = conectarBD();
$idPedido = $_POST['idPedido'];
$itens = json_decode(retornaVal($conexao, 'pedidos', 'idPedido', $idPedido, 'qrCode'));
$valorTotal = retornaVal($conexao, 'pedidos', 'idPedido', $idPedido, 'valorTotal');
$cnpj = retornaVal($conexao, 'pedidos', 'idPedido', $idPedido, 'empresa'); // Necessário para adicionar fundos
$cpf = retornaVal($conexao, 'pessoa', 'email', $_SESSION['email'], 'cpf'); // Necessário para identificar o dono dos novos itens
$credito = retornaVal($conexao, 'pessoa', 'email', $_SESSION['email'], 'credito');

if($_POST['pagarComCred'] == 'true'){
    if (floatVal($valorTotal) > floatval($credito)){
        $response = array('error' => 'Você não possui crédito suficiente');
        echo json_encode($response);
        exit; // Por garantia :)
    }else{
        $novoCredito = floatVal($credito) - floatVal($valorTotal);
        removerCredito($conexao, $_SESSION['email'], $novoCredito);
    }
}

// Adicionando cada item ao perfil do usuário
foreach ($itens as &$produto) {
    $nomeProduto = retornaVal($conexao, 'produto', 'idProduto', $produto, 'nome');
    $precoProduto = retornaVal($conexao, 'produto', 'idProduto', $produto, 'preco');
    inserirItem($conexao, $nomeProduto, $precoProduto, $produto, $cpf, $cnpj);
};

// Enviando lucro para a empresa
// Simulando, mas como não temos uma API para pagamento:
adicionarLucro($conexao, $cnpj, $valorTotal);

// 2 - Criar tabela de transações
$itensFiltrados = array();
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
    array_push($itensFiltrados, $nomeProduto, $quantidade, $precoProduto);
}
$data = date('Y-m-d H:i:s');
criarTransacaoPedido($conexao, $idPedido, $data, json_encode($itensFiltrados, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES), $valorTotal, $cpf, $cnpj);

// 3 - Deletar pedido
$caminhoArquivo = "../../images/qrcodes/" . $idPedido . ".png";
  if (file_exists($caminhoArquivo)) {
      // Exclui o arquivo
      unlink($caminhoArquivo);
    //   echo 'Arquivo do QR Code excluído com sucesso.';
  } else {
    //   echo 'O arquivo do QR Code não existe.';
  }
removerPedido($conexao, $cpf);
$response = array('success' => 'Pagamento realizado com sucesso');
echo json_encode($response);
exit; // Por garantia :)
?>