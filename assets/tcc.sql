-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07-Jul-2023 às 14:25
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
-- Estrutura da tabela `empresa`
--

DROP TABLE IF EXISTS `empresa`;
CREATE TABLE IF NOT EXISTS `empresa` (
  `nome` varchar(45) NOT NULL,
  `email` varchar(90) NOT NULL,
  `CNPJ` varchar(14) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `agencia` varchar(45) NOT NULL,
  `conta` varchar(45) NOT NULL,
  `perfil` varchar(150) DEFAULT NULL,
  `cpf` varchar(14) NOT NULL COMMENT 'CPF do dono da empresa',
  `dono` varchar(90) NOT NULL COMMENT 'Nome do proprietário da empresa, são dados que precisamos em caso de responsabilidade legal',
  `lucro` int(11) DEFAULT NULL COMMENT 'Variável que informa o lucro total que a empresa já teve utilizando o site',
  PRIMARY KEY (`CNPJ`),
  UNIQUE KEY `email` (`email`,`conta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `idItem` varchar(10) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `preco` varchar(10) DEFAULT NULL,
  `idProduto` int(11) NOT NULL,
  `donoDoItem` varchar(11) NOT NULL,
  PRIMARY KEY (`idItem`),
  KEY `DonoDoItem` (`donoDoItem`),
  KEY `ProdutoOriginal` (`idProduto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE IF NOT EXISTS `pedidos` (
  `idPedido` varchar(11) NOT NULL,
  `valorTotal` float NOT NULL,
  `qrCode` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`qrCode`)),
  `status` varchar(20) NOT NULL DEFAULT 'aguardando',
  `cliente` varchar(11) NOT NULL,
  `empresa` varchar(14) NOT NULL COMMENT 'CNPJ da empresa',
  PRIMARY KEY (`idPedido`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

DROP TABLE IF EXISTS `pessoa`;
CREATE TABLE IF NOT EXISTS `pessoa` (
  `nome` varchar(45) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `email` varchar(90) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `credito` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`cpf`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

DROP TABLE IF EXISTS `produto`;
CREATE TABLE IF NOT EXISTS `produto` (
  `nome` varchar(45) NOT NULL,
  `descricao` varchar(90) DEFAULT NULL,
  `preco` varchar(4) NOT NULL,
  `idProduto` int(11) NOT NULL AUTO_INCREMENT,
  `CNPJ` varchar(14) NOT NULL,
  `imagem` varchar(120) NOT NULL,
  PRIMARY KEY (`idProduto`),
  KEY `EmpresaDoProduto` (`CNPJ`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `transacaoabate`
--

DROP TABLE IF EXISTS `transacaoabate`;
CREATE TABLE IF NOT EXISTS `transacaoabate` (
  `idAbate` varchar(10) NOT NULL COMMENT 'ID do pedido na época',
  `data` datetime NOT NULL COMMENT 'Data que a transação foi realizada',
  `fichas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '[NomedaFicha, quantidade, valor]',
  `cliente` varchar(11) NOT NULL COMMENT 'CPF do cliente',
  `empresa` varchar(14) NOT NULL COMMENT 'CNPJ da empresa'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `transacaopedido`
--

DROP TABLE IF EXISTS `transacaopedido`;
CREATE TABLE IF NOT EXISTS `transacaopedido` (
  `idPedido` varchar(10) NOT NULL,
  `data` datetime NOT NULL,
  `valor` float NOT NULL,
  `cliente` varchar(11) NOT NULL,
  `empresa` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `DonoDoItem` FOREIGN KEY (`donoDoItem`) REFERENCES `pessoa` (`cpf`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ProdutoOriginal` FOREIGN KEY (`idProduto`) REFERENCES `produto` (`idProduto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `EmpresaDoProduto` FOREIGN KEY (`CNPJ`) REFERENCES `empresa` (`CNPJ`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
