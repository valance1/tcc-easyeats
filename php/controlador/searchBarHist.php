<?php 
require '../dao/conexaoBD.php';
require_once "FuncoesUteis.php";
session_start();

// qual botao
$field = $_POST['field'];

// texto alvo
$texto = $_POST['texto'];

// qual empresa
$cnpj = retornaVal($conexao, 'empresa', 'email', $_SESSION['email'], 'cnpj');

// Verificando se o usuário digitou alguma coisa
// Se estiver VAZIO: resetar a query, popular a tabela com um search * 
// Caso contrário, vamos popular com um select contendo restrições
if(empty($texto)){

  // Se for pedidos, vamos fazer uma query para a lista de pedidos concluidos
  if($field == "pedidos"){
    $code = "SELECT * FROM transacaopedido WHERE empresa = '$cnpj' ORDER BY data DESC";
  }else{
    $code = "SELECT * FROM transacaoabate WHERE empresa = '$cnpj' ORDER BY data DESC";
  }
}else{
  if($field == "pedidos"){
    $code = "SELECT * FROM transacaopedido WHERE LOWER(nome) LIKE LOWER('%{$texto}%')";
  }else{

  }
}
$query = mysqli_query(conectarBD(), $code) or die(mysqli_error(conectarBD()));

// Se houver algum resultado
if (mysqli_num_rows($query) != 0) {
  $j = 0;
  while($obj = mysqli_fetch_assoc($query)){
    $nomes = array();
    $quantidades = array();
    $valores = array();

    $j += 1;
    echo '<tr><th scope="row">' . $j . '</th>';
    echo '<td>' . md5($obj['cliente']) . '</td>'; 

    // Tenho que tratar a lista de cada transacao.
    $obj_arr = json_decode($obj['produtos']);
    for ($i = 0; $i < count($obj_arr); $i += 3) {
      array_push($nomes, $obj_arr[$i]);
      array_push($quantidades, $obj_arr[$i + 1]);
      array_push($valores, $obj_arr[$i + 2]);
    }
    echo '<td>' . implode(",", $nomes) . '</td>';
    echo '<td>' . implode(",", $quantidades) . '</td>';
    echo '<td>' . implode(",", $valores) . '</td>';

    echo '<td>' . $obj['valor'] . '</td>';
    echo '<td>' . $obj['data'] . '</td>';
    echo '</tr>';
  };

  // Se não houver nenhuma, mostre o card de indisponibilidade
} else {
  echo '<div class="card py-4 px-4 text-center container m-auto">Ninguém comprou nenhuma ficha da sua empresa.</div>';
}
?>