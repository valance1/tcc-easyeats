<?php
//TODO
// PASSAR DATA DO PEDIDO, VALOR TOTAL, CPF, CNPJ, ID do do QRCODE

require_once "FuncoesUteis.php";
require_once "../dao/conexaoBD.php";
require_once "../dao/pedidoDAO.php";
require_once "../dao/empresaDAO.php";
require_once "../dao/itemDAO.php";
require_once "../dao/transacaopedidoDAO.php";

session_start();

date_default_timezone_set('America/Sao_Paulo');

// Verificando se tá logado
if(!$_SESSION['email']){
    echo "Usuário não está logado";
    exit();
}

if(isset($_SESSION['empresa'])){
    echo "Empresa não compra";
    exit();
}


// Variáveis
$conexao = conectarBD();
$idPedido = $_POST['idPedido'];
$itens = json_decode(retornaVal($conexao, 'pedidos', 'idPedido', $idPedido, 'qrCode'));
$valorTotal = retornaVal($conexao, 'pedidos', 'idPedido', $idPedido, 'valorTotal');
$cnpj = retornaVal($conexao, 'pedidos', 'idPedido', $idPedido, 'empresa'); // Necessário para adicionar fundos
$cpf = retornaVal($conexao, 'pessoa', 'email', $_SESSION['email'], 'cpf'); // Necessário para identificar o dono dos novos itens

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
$data = date('Y-m-d H:i:s');
criarTransacaoPedido($conexao, $idPedido, $data, $valorTotal, $cpf, $cnpj);

// 3 - Deletar pedido
$caminhoArquivo = "../../images/qrcodes/" . $idPedido . ".png";
  if (file_exists($caminhoArquivo)) {
      // Exclui o arquivo
      unlink($caminhoArquivo);
      echo 'Arquivo do QR Code excluído com sucesso.';
  } else {
      echo 'O arquivo do QR Code não existe.';
  }
removerPedido($conexao, $cpf);

?>