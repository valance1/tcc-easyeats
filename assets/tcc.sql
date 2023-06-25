-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22-Jun-2023 às 01:07
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
('Empresa 3 ', 'empresa3@gmail.com', '91018981000150', '202cb962ac59075b964b07152d234b70', '000', '123333', NULL, '', '');

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`nome`, `descricao`, `preco`, `idProduto`, `CNPJ`, `imagem`) VALUES
('Salgado Frito', 'Coxinha e derivados', '7,50', 15, '91018981000150', 'images/produtos/91018981000150/8930251f45b5cba00519f165bbd79da1.jpeg'),
('HambÃºrguer', 'Uma explosÃ£o de sabores', '12', 16, '91018981000150', 'images/produtos/91018981000150/94b65e30c3dff504cbb93343f6d961de.jpeg');

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
