<?php
//TODO
// PASSAR DATA DO Cesta, VALOR TOTAL, CPF, CNPJ, ID do do QRCODE

require_once "FuncoesUteis.php";
require_once "../dao/conexaoBD.php";
require_once "../dao/cestaDAO.php";
require_once "../dao/itemDAO.php";
require_once "../dao/transacaocestaDAO.php";

session_start();
date_default_timezone_set('America/Sao_Paulo');

// Verificando se tá logado
if(!$_SESSION['email']){
    echo "Usuário não está logado";
    exit();
}

// Variáveis
$conexao = conectarBD();
$idCesta = $_POST['idCesta'];
$itens = json_decode(retornaVal($conexao, 'cesta', 'idCesta', $idCesta, 'itens'));
$cpf = retornaVal($conexao, 'cesta', 'idCesta', $idCesta, 'cliente'); // Necessário para identificar o dono dos novos itens

// Verificar se a empresa pagante é a empresa da mesma cesta
$cnpj = retornaVal($conexao, 'empresa', 'email', $_SESSION['email'], 'CNPJ');
$cnpjCesta = retornaVal($conexao, 'cesta', 'idCesta', $idCesta, 'empresa');
if($cnpj != $cnpjCesta){
    echo 'Você não é a empresa correspondente ao Cesta.';
    exit();
}

// Removendo cada item do inventário do usuário e adicionando a uma array de histórico

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

    // Deletar os itens do usuário

    for ($i = 0; $i < $quantidade; $i++) {
        excluirItem($conexao, $produto, $cpf, $cnpj);
    }
}

// 2 - Criar row de abates
$data = date('Y-m-d H:i:s');
criarTransacaoCesta($conexao, $idCesta, $data, json_encode($itensFiltrados), $cpf, $cnpj);

// 3 - Deletar Cesta
$caminhoArquivo = "../../images/qrcodes/cesta/" . $idCesta;
  if (file_exists($caminhoArquivo)) {
      // Exclui o arquivo
      unlink($caminhoArquivo);
      echo 'Arquivo do QR Code excluído com sucesso.';
  } else {
      echo 'O arquivo do QR Code não existe.';
  }
removerCestaPorID($conexao, $idCesta);

?>