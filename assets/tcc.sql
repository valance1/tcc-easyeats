-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18-Set-2023 às 21:10
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
CREATE DATABASE IF NOT EXISTS `easyeats` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `easyeats`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cesta`
--

DROP TABLE IF EXISTS `cesta`;
CREATE TABLE IF NOT EXISTS `cesta` (
  `idCesta` varchar(11) NOT NULL COMMENT 'Identificador único da cesta',
  `itens` longtext NOT NULL COMMENT 'Informações sobre os itens presentes na cesta em formato de texto longo',
  `cliente` varchar(11) NOT NULL COMMENT 'CPF do cliente que possui a cesta',
  `empresa` varchar(14) NOT NULL COMMENT 'CNPJ da empresa à qual a cesta está relacionada',
  PRIMARY KEY (`idCesta`),
  KEY `clienteDaCesta` (`cliente`),
  KEY `empresaDaCesta` (`empresa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Tabela que armazena as cestas dos clientes';

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

DROP TABLE IF EXISTS `empresa`;
CREATE TABLE IF NOT EXISTS `empresa` (
  `nome` varchar(45) NOT NULL COMMENT 'Nome da empresa',
  `email` varchar(90) NOT NULL COMMENT 'Endereço de e-mail da empresa',
  `CNPJ` varchar(14) NOT NULL COMMENT 'CNPJ da empresa, identificador único',
  `senha` varchar(45) NOT NULL COMMENT 'Senha associada à conta da empresa',
  `agencia` varchar(4) NOT NULL COMMENT 'Número da agência bancária da empresa',
  `conta` varchar(9) NOT NULL COMMENT 'Número da conta bancária da empresa',
  `perfil` varchar(150) DEFAULT NULL COMMENT 'Perfil da empresa em texto com informações adicionais',
  `cpf` varchar(14) NOT NULL COMMENT 'CPF do proprietário da empresa',
  `dono` varchar(90) NOT NULL COMMENT 'Nome do proprietário da empresa',
  `lucro` int(11) DEFAULT NULL COMMENT 'Valor inteiro que informa o lucro total que a empresa já teve utilizando o site',
  PRIMARY KEY (`CNPJ`),
  UNIQUE KEY `email` (`email`,`conta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Tabela que armazena informações sobre as empresas';

--
-- Extraindo dados da tabela `empresa`
--

INSERT INTO `empresa` (`nome`, `email`, `CNPJ`, `senha`, `agencia`, `conta`, `perfil`, `cpf`, `dono`, `lucro`) VALUES
('Hamburgueria', 'empresa1@gmail.com', '45311823000176', '202cb962ac59075b964b07152d234b70', '1111', '11111111', 'images/45311823000176/perfil.png', '97753689010', 'Joao', NULL),
('Sushiteria', 'empresa3@gmail.com', '50818031000122', '202cb962ac59075b964b07152d234b70', '1111', '33333333', 'images/50818031000122/perfil.png', '63388709092', 'Felix', NULL),
('Pizzaria', 'empresa2@gmail.com', '54188402000190', '202cb962ac59075b964b07152d234b70', '1234', '22222222', 'images/54188402000190/perfil.png', '89001096000', 'Joao', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `idItem` varchar(10) NOT NULL COMMENT 'Identificador único do item',
  `nome` varchar(45) DEFAULT NULL COMMENT 'Nome do item',
  `preco` varchar(10) DEFAULT NULL COMMENT 'Preço do item em formato de texto',
  `idProduto` int(11) NOT NULL COMMENT 'Identificador único do produto associado a este item',
  `donoDoItem` varchar(11) NOT NULL COMMENT 'CPF do dono (cliente) do item',
  `empresa` varchar(14) NOT NULL COMMENT 'CNPJ da empresa à qual o item está associado',
  PRIMARY KEY (`idItem`),
  KEY `DonoDoItem` (`donoDoItem`),
  KEY `ProdutoOriginal` (`idProduto`),
  KEY `EmpresaDono` (`empresa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Tabela que armazena os itens dos clientes e suas informações';

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE IF NOT EXISTS `pedidos` (
  `idPedido` varchar(11) NOT NULL COMMENT 'Identificador único do pedido',
  `valorTotal` float NOT NULL COMMENT 'Valor total do pedido (valor em moeda)',
  `qrCode` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'Código QR em formato de texto longo que armazena informações dos itens do pedido',
  `status` varchar(20) NOT NULL DEFAULT 'aguardando' COMMENT 'Status atual do pedido',
  `cliente` varchar(11) NOT NULL COMMENT 'CPF do cliente que fez o pedido',
  `empresa` varchar(14) NOT NULL COMMENT 'CNPJ da empresa responsável pelo atendimento do pedido',
  PRIMARY KEY (`idPedido`),
  KEY `clienteDoPedido` (`cliente`),
  KEY `empresaDoPedido` (`empresa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Tabela que armazena os pedidos dos clientes';

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

DROP TABLE IF EXISTS `pessoa`;
CREATE TABLE IF NOT EXISTS `pessoa` (
  `nome` varchar(45) NOT NULL COMMENT 'Nome da pessoa (cliente ou proprietário de empresa)',
  `cpf` varchar(11) NOT NULL COMMENT 'CPF da pessoa, identificador único',
  `email` varchar(90) NOT NULL COMMENT 'Endereço de e-mail da pessoa',
  `senha` varchar(45) NOT NULL COMMENT 'Senha associada à conta da pessoa (cliente ou proprietário)',
  `credito` varchar(45) DEFAULT NULL COMMENT 'Crédito associado à conta da pessoa (cliente ou proprietário)',
  PRIMARY KEY (`cpf`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Tabela que armazena informações sobre as pessoas (clientes e proprietários)';

--
-- Extraindo dados da tabela `pessoa`
--

INSERT INTO `pessoa` (`nome`, `cpf`, `email`, `senha`, `credito`) VALUES
('usuario teste', '18210790005', 'usuario1@gmail.com', '202cb962ac59075b964b07152d234b70', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

DROP TABLE IF EXISTS `produto`;
CREATE TABLE IF NOT EXISTS `produto` (
  `nome` varchar(45) NOT NULL COMMENT 'Nome do produto',
  `descricao` varchar(90) DEFAULT NULL COMMENT 'Descrição do produto em texto',
  `preco` float NOT NULL COMMENT 'Preço do produto em formato de ponto flutuante',
  `idProduto` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único do produto',
  `CNPJ` varchar(14) NOT NULL COMMENT 'CNPJ da empresa à qual o produto está associado',
  `imagem` varchar(120) NOT NULL COMMENT 'Caminho da imagem do produto no sistema',
  `disponivel` text NOT NULL DEFAULT 'true' COMMENT 'true = disponivel para venda\r\nfalse = indisponivel',
  PRIMARY KEY (`idProduto`),
  KEY `EmpresaDoProduto` (`CNPJ`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Tabela que armazena informações sobre os produtos das empresas';

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`nome`, `descricao`, `preco`, `idProduto`, `CNPJ`, `imagem`, `disponivel`) VALUES
('Hambúrguer', 'Ingredientes: Queijo, bacon, picanha e pão artesanal', 13.5, 1, '45311823000176', 'images/produtos/45311823000176/d72f3311499aa39e90153e2564a66ce1.png', 'true'),
('Pizza', 'Pizza de queijo e calabresa', 30, 2, '54188402000190', 'images/produtos/54188402000190/048a57b8e266ca1f33429d1076b27ed1.png', 'true'),
('Combo 30 peças', 'Kit com 30 unidades de aperitivos!', 50, 3, '50818031000122', 'images/produtos/50818031000122/cc86d69c2007517ed3418eb6a824a91d.png', 'true');

-- --------------------------------------------------------

--
-- Estrutura da tabela `transacaoabate`
--

DROP TABLE IF EXISTS `transacaoabate`;
CREATE TABLE IF NOT EXISTS `transacaoabate` (
  `idAbate` varchar(10) NOT NULL COMMENT 'Identificador único da transação de abate',
  `data` datetime NOT NULL COMMENT 'Data em que a transação foi realizada',
  `fichas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'Texto longo em formato de array que armazena informações sobre fichas (nome da ficha, quantidade e valor)',
  `cliente` varchar(11) NOT NULL COMMENT 'CPF do cliente associado à transação de abate',
  `empresa` varchar(14) NOT NULL COMMENT 'CNPJ da empresa associada à transação de abate',
  KEY `clienteAbate` (`cliente`),
  KEY `empresaAbate` (`empresa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Tabela que armazena informações sobre as transações de abate';

-- --------------------------------------------------------

--
-- Estrutura da tabela `transacaopedido`
--

DROP TABLE IF EXISTS `transacaopedido`;
CREATE TABLE IF NOT EXISTS `transacaopedido` (
  `idPedido` varchar(10) NOT NULL COMMENT 'Identificador único do pedido associado à transação',
  `data` datetime NOT NULL COMMENT 'Data em que a transação foi realizada',
  `valor` float NOT NULL COMMENT 'Valor da transação em moeda',
  `cliente` varchar(11) NOT NULL COMMENT 'CPF do cliente associado à transação do pedido',
  `empresa` varchar(14) NOT NULL COMMENT 'CNPJ da empresa associada à transação do pedido',
  `produtos` longtext NOT NULL COMMENT '(nomeproduto, quantidade, valor)',
  KEY `clienteTransacaoPedido` (`cliente`),
  KEY `empresaTransacaoPedido` (`empresa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Tabela que armazena informações sobre as transações dos pedidos';

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
