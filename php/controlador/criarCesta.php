<?php
require_once "FuncoesUteis.php";
require_once "../dao/conexaoBD.php";
require_once "../dao/cestaDAO.php";

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

// Mesma coisa com empresa
$cnpj = retornaVal($conexao, 'produto', 'idProduto', $data[0], 'CNPJ');
echo $cnpj;

// Variável para verificar se todos os itens têm a mesma empresa
$mesmaEmpresa = true;

// Verificar se todos os itens têm a mesma empresa
foreach ($data as $item) {
    $cnpjTMP = retornaVal($conexao, 'produto', 'idProduto', $item, 'CNPJ');
    if ($cnpjTMP !== $cnpj) {

        // Se encontrarmos algum item com empresa diferente, definimos $mesmaEmpresa como false
        $mesmaEmpresa = false;
        break; // Não precisamos mais continuar a verificação
    }
}

if ($mesmaEmpresa) {
    // Todos os itens têm a mesma empresa
    echo "Todos os itens pertencem à mesma empresa.";
} else {
    // Pelo menos um item tem empresa diferente dos demais, vamos impedir o código de rodar
    echo "Pare de tentar alterar o código.";
    exit(); 
}

// OBS, só pode existir um Cesta no BD com o CPF, vamos dropar o antigo se isso acontecer
$sqlCode = "SELECT * FROM cesta WHERE cliente = '$cpf'";
$query = mysqli_query($conexao, $sqlCode);
if (mysqli_num_rows($query) >= 1) {
  echo 'Cesta já existe, vamos dropar a antiga';
  $idCesta = mysqli_fetch_assoc($query)['idCesta'];
  $caminhoArquivo = "../../images/qrcodes/cesta/" . $idCesta . ".png";
  if (file_exists($caminhoArquivo)) {
      // Exclui o arquivo
      unlink($caminhoArquivo);
      echo 'Arquivo do QR Code excluído com sucesso.';
  } else {
      echo 'O arquivo do QR Code não existe.';
  }
  // Código para dropar o Cesta antigo
  removerCesta($conexao, $cpf);
}

// Encontrando um ID para o Cesta, caso exista, vamos ficar loopando até não existir
$CestaID = bin2hex(random_bytes(5));
while (existe($conexao, 'cesta', 'idCesta', $CestaID)){
    $CestaID = bin2hex(random_bytes(5));
};

criarCesta($conexao, $CestaID, $cpf, json_encode($data, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES), $cnpj);
echo '</br> Cesta Criado com sucesso';

?>