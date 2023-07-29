-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29-Jul-2023 às 18:28
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `easyeats`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cesta`
--

CREATE TABLE `cesta` (
  `idCesta` varchar(11) NOT NULL COMMENT 'Identificador único da cesta',
  `itens` longtext NOT NULL COMMENT 'Informações sobre os itens presentes na cesta em formato de texto longo',
  `cliente` varchar(11) NOT NULL COMMENT 'CPF do cliente que possui a cesta',
  `empresa` varchar(14) NOT NULL COMMENT 'CNPJ da empresa à qual a cesta está relacionada'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Tabela que armazena as cestas dos clientes';

--
-- Extraindo dados da tabela `cesta`
--

INSERT INTO `cesta` (`idCesta`, `itens`, `cliente`, `empresa`) VALUES
('294bc72069', '[\"3\",\"3\"]', '12345678911', '50818031000122');

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

CREATE TABLE `empresa` (
  `nome` varchar(45) NOT NULL COMMENT 'Nome da empresa',
  `email` varchar(90) NOT NULL COMMENT 'Endereço de e-mail da empresa',
  `CNPJ` varchar(14) NOT NULL COMMENT 'CNPJ da empresa, identificador único',
  `senha` varchar(45) NOT NULL COMMENT 'Senha associada à conta da empresa',
  `agencia` varchar(4) NOT NULL COMMENT 'Número da agência bancária da empresa',
  `conta` varchar(9) NOT NULL COMMENT 'Número da conta bancária da empresa',
  `perfil` varchar(150) DEFAULT NULL COMMENT 'Perfil da empresa em texto com informações adicionais',
  `cpf` varchar(14) NOT NULL COMMENT 'CPF do proprietário da empresa',
  `dono` varchar(90) NOT NULL COMMENT 'Nome do proprietário da empresa',
  `lucro` int(11) DEFAULT NULL COMMENT 'Valor inteiro que informa o lucro total que a empresa já teve utilizando o site'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Tabela que armazena informações sobre as empresas';

--
-- Extraindo dados da tabela `empresa`
--

INSERT INTO `empresa` (`nome`, `email`, `CNPJ`, `senha`, `agencia`, `conta`, `perfil`, `cpf`, `dono`, `lucro`) VALUES
('Hamburgueria', 'empresa1@gmail.com', '45311823000176', '202cb962ac59075b964b07152d234b70', '1111', '11111111', 'images/45311823000176/perfil.png', '97753689010', 'Joao', NULL),
('Sushiteria', 'empresa3@gmail.com', '50818031000122', '202cb962ac59075b964b07152d234b70', '1111', '33333333', 'images/50818031000122/perfil.png', '63388709092', 'Felix', 250),
('Pizzaria', 'empresa2@gmail.com', '54188402000190', '202cb962ac59075b964b07152d234b70', '1234', '22222222', 'images/54188402000190/perfil.png', '89001096000', 'Joao', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `item`
--

CREATE TABLE `item` (
  `idItem` varchar(10) NOT NULL COMMENT 'Identificador único do item',
  `nome` varchar(45) DEFAULT NULL COMMENT 'Nome do item',
  `preco` varchar(10) DEFAULT NULL COMMENT 'Preço do item em formato de texto',
  `idProduto` int(11) NOT NULL COMMENT 'Identificador único do produto associado a este item',
  `donoDoItem` varchar(11) NOT NULL COMMENT 'CPF do dono (cliente) do item',
  `empresa` varchar(14) NOT NULL COMMENT 'CNPJ da empresa à qual o item está associado'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Tabela que armazena os itens dos clientes e suas informações';

--
-- Extraindo dados da tabela `item`
--

INSERT INTO `item` (`idItem`, `nome`, `preco`, `idProduto`, `donoDoItem`, `empresa`) VALUES
('4714619bc1', 'Combo 30 peças', '50', 3, '12345678911', '50818031000122'),
('59ad9d509a', 'Combo 30 peças', '50', 3, '12345678911', '50818031000122'),
('7a095e331e', 'Combo 30 peças', '50', 3, '12345678911', '50818031000122'),
('ed68d1ebca', 'Combo 30 peças', '50', 3, '12345678911', '50818031000122'),
('fd9f826bc5', 'Combo 30 peças', '50', 3, '12345678911', '50818031000122');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `idPedido` varchar(11) NOT NULL COMMENT 'Identificador único do pedido',
  `valorTotal` float NOT NULL COMMENT 'Valor total do pedido (valor em moeda)',
  `qrCode` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'Código QR em formato de texto longo que armazena informações dos itens do pedido',
  `status` varchar(20) NOT NULL DEFAULT 'aguardando' COMMENT 'Status atual do pedido',
  `cliente` varchar(11) NOT NULL COMMENT 'CPF do cliente que fez o pedido',
  `empresa` varchar(14) NOT NULL COMMENT 'CNPJ da empresa responsável pelo atendimento do pedido'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Tabela que armazena os pedidos dos clientes';

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `nome` varchar(45) NOT NULL COMMENT 'Nome da pessoa (cliente ou proprietário de empresa)',
  `cpf` varchar(11) NOT NULL COMMENT 'CPF da pessoa, identificador único',
  `email` varchar(90) NOT NULL COMMENT 'Endereço de e-mail da pessoa',
  `senha` varchar(45) NOT NULL COMMENT 'Senha associada à conta da pessoa (cliente ou proprietário)',
  `credito` varchar(45) DEFAULT NULL COMMENT 'Crédito associado à conta da pessoa (cliente ou proprietário)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Tabela que armazena informações sobre as pessoas (clientes e proprietários)';

--
-- Extraindo dados da tabela `pessoa`
--

INSERT INTO `pessoa` (`nome`, `cpf`, `email`, `senha`, `credito`) VALUES
('Joao', '12345678911', 'usuario1@gmail.com', '202cb962ac59075b964b07152d234b70', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `nome` varchar(45) NOT NULL COMMENT 'Nome do produto',
  `descricao` varchar(90) DEFAULT NULL COMMENT 'Descrição do produto em texto',
  `preco` float NOT NULL COMMENT 'Preço do produto em formato de ponto flutuante',
  `idProduto` int(11) NOT NULL COMMENT 'Identificador único do produto',
  `CNPJ` varchar(14) NOT NULL COMMENT 'CNPJ da empresa à qual o produto está associado',
  `imagem` varchar(120) NOT NULL COMMENT 'Caminho da imagem do produto no sistema'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Tabela que armazena informações sobre os produtos das empresas';

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`nome`, `descricao`, `preco`, `idProduto`, `CNPJ`, `imagem`) VALUES
('Hambúrguer', 'Ingredientes: Queijo, bacon, picanha e pão artesanal', 13.5, 1, '45311823000176', 'images/produtos/45311823000176/d72f3311499aa39e90153e2564a66ce1.png'),
('Pizza', 'Pizza de queijo e calabresa', 30, 2, '54188402000190', 'images/produtos/54188402000190/048a57b8e266ca1f33429d1076b27ed1.png'),
('Combo 30 peças', 'Kit com 30 unidades de aperitivos!', 50, 3, '50818031000122', 'images/produtos/50818031000122/cc86d69c2007517ed3418eb6a824a91d.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `transacaoabate`
--

CREATE TABLE `transacaoabate` (
  `idAbate` varchar(10) NOT NULL COMMENT 'Identificador único da transação de abate',
  `data` datetime NOT NULL COMMENT 'Data em que a transação foi realizada',
  `fichas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'Texto longo em formato de array que armazena informações sobre fichas (nome da ficha, quantidade e valor)',
  `cliente` varchar(11) NOT NULL COMMENT 'CPF do cliente associado à transação de abate',
  `empresa` varchar(14) NOT NULL COMMENT 'CNPJ da empresa associada à transação de abate'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Tabela que armazena informações sobre as transações de abate';

-- --------------------------------------------------------

--
-- Estrutura da tabela `transacaopedido`
--

CREATE TABLE `transacaopedido` (
  `idPedido` varchar(10) NOT NULL COMMENT 'Identificador único do pedido associado à transação',
  `data` datetime NOT NULL COMMENT 'Data em que a transação foi realizada',
  `valor` float NOT NULL COMMENT 'Valor da transação em moeda',
  `cliente` varchar(11) NOT NULL COMMENT 'CPF do cliente associado à transação do pedido',
  `empresa` varchar(14) NOT NULL COMMENT 'CNPJ da empresa associada à transação do pedido'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Tabela que armazena informações sobre as transações dos pedidos';

--
-- Extraindo dados da tabela `transacaopedido`
--

INSERT INTO `transacaopedido` (`idPedido`, `data`, `valor`, `cliente`, `empresa`) VALUES
('fa4d6a76c0', '2023-07-27 14:11:25', 250, '32025382090', '50818031000122');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cesta`
--
ALTER TABLE `cesta`
  ADD PRIMARY KEY (`idCesta`),
  ADD KEY `clienteDaCesta` (`cliente`),
  ADD KEY `empresaDaCesta` (`empresa`);

--
-- Índices para tabela `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`CNPJ`),
  ADD UNIQUE KEY `email` (`email`,`conta`);

--
-- Índices para tabela `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`idItem`),
  ADD KEY `DonoDoItem` (`donoDoItem`),
  ADD KEY `ProdutoOriginal` (`idProduto`),
  ADD KEY `EmpresaDono` (`empresa`);

--
-- Índices para tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idPedido`),
  ADD KEY `clienteDoPedido` (`cliente`),
  ADD KEY `empresaDoPedido` (`empresa`);

--
-- Índices para tabela `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`cpf`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices para tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`idProduto`),
  ADD KEY `EmpresaDoProduto` (`CNPJ`);

--
-- Índices para tabela `transacaoabate`
--
ALTER TABLE `transacaoabate`
  ADD KEY `clienteAbate` (`cliente`),
  ADD KEY `empresaAbate` (`empresa`);

--
-- Índices para tabela `transacaopedido`
--
ALTER TABLE `transacaopedido`
  ADD KEY `clienteTransacaoPedido` (`cliente`),
  ADD KEY `empresaTransacaoPedido` (`empresa`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `idProduto` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único do produto', AUTO_INCREMENT=4;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `cesta`
--
ALTER TABLE `cesta`
  ADD CONSTRAINT `clienteCesta` FOREIGN KEY (`cliente`) REFERENCES `pessoa` (`cpf`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `empresaCesta` FOREIGN KEY (`empresa`) REFERENCES `empresa` (`CNPJ`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `DonoDoItem` FOREIGN KEY (`donoDoItem`) REFERENCES `pessoa` (`cpf`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `EmpresaDono` FOREIGN KEY (`empresa`) REFERENCES `empresa` (`CNPJ`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ProdutoOriginal` FOREIGN KEY (`idProduto`) REFERENCES `produto` (`idProduto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `clienteDoPedido` FOREIGN KEY (`cliente`) REFERENCES `pessoa` (`cpf`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `empresaDoPedido` FOREIGN KEY (`empresa`) REFERENCES `empresa` (`CNPJ`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `EmpresaDoProduto` FOREIGN KEY (`CNPJ`) REFERENCES `empresa` (`CNPJ`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
