-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02-Jul-2023 às 19:33
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
  PRIMARY KEY (`CNPJ`),
  UNIQUE KEY `email` (`email`,`conta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `empresa`
--

INSERT INTO `empresa` (`nome`, `email`, `CNPJ`, `senha`, `agencia`, `conta`, `perfil`, `cpf`, `dono`) VALUES
('Empresa 1', 'empresa1@gmail.com', '04797353000115', '202cb962ac59075b964b07152d234b70', '000', '134', NULL, '', ''),
('Empresa 2', 'empresa2@gmail.com', '05470474000110', '202cb962ac59075b964b07152d234b70', '000', '12344', NULL, '', ''),
('Empresa 3 ', 'empresa3@gmail.com', '91018981000150', '202cb962ac59075b964b07152d234b70', '12312', '123333', 'images/91018981000150/perfil.png', '', '');

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
  `idPedido` int(11) NOT NULL,
  `dataPedido` date NOT NULL,
  `valorTotal` float NOT NULL,
  `qrCode` varchar(255) NOT NULL
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

--
-- Extraindo dados da tabela `pessoa`
--

INSERT INTO `pessoa` (`nome`, `cpf`, `email`, `senha`, `credito`) VALUES
('Gabriel', '29640616028', 'usuario@gmail.com', '202cb962ac59075b964b07152d234b70', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`nome`, `descricao`, `preco`, `idProduto`, `CNPJ`, `imagem`) VALUES
('glorpa glurp', '123', '123', 20, '91018981000150', 'images/91018981000150/images'),
('help me', '123', '123', 21, '91018981000150', 'images/91018981000150/91018981000150'),
('Hamburgue', 'cu', '900', 22, '91018981000150', 'images/produtos/91018981000150/15087cfae819c7ceb2e766f387ffa41b.png'),
('ddf', 'fddffd', '1233', 23, '91018981000150', 'images/produtos/91018981000150/862151eea35ce60e7720f7dd8ad2d6ec.png'),
('e', 'e', '123', 24, '91018981000150', 'images/produtos/91018981000150/5835f36c93bbbfcd3c579593f79064f5.png'),
('cate', '23', '23', 25, '91018981000150', 'images/produtos/91018981000150/eb1c16bf6c0eaedf2749db5de3f3846a.png'),
('dssd', 'sdds', '1231', 26, '91018981000150', 'images/produtos/91018981000150/c6ab6b9b7beac83450077a19dd09144b.png'),
('Banana', 'NNNN', '1090', 27, '91018981000150', 'images/produtos/91018981000150/79c90d9df5ab97501eb24975a00fb690.png'),
('masi', 'um', '1231', 28, '91018981000150', 'images/produtos/91018981000150/2fc41a4b79aa11a3ddba03efe5f7b5dd.png');

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
