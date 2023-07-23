-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23-Jul-2023 às 21:00
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
  MODIFY `idProduto` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único do produto';

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

--
-- Limitadores para a tabela `transacaoabate`
--
ALTER TABLE `transacaoabate`
  ADD CONSTRAINT `clienteAbate` FOREIGN KEY (`cliente`) REFERENCES `pessoa` (`cpf`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `empresaAbate` FOREIGN KEY (`empresa`) REFERENCES `empresa` (`CNPJ`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Limitadores para a tabela `transacaopedido`
--
ALTER TABLE `transacaopedido`
  ADD CONSTRAINT `clienteTransacaoPedido` FOREIGN KEY (`cliente`) REFERENCES `pessoa` (`cpf`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `empresaTransacaoPedido` FOREIGN KEY (`empresa`) REFERENCES `empresa` (`CNPJ`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
