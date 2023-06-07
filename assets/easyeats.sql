-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 07-Jun-2023 às 19:30
-- Versão do servidor: 10.4.6-MariaDB
-- versão do PHP: 7.3.10

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
  PRIMARY KEY (`CNPJ`),
  UNIQUE KEY `email` (`email`,`conta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `empresa`
--

INSERT INTO `empresa` (`nome`, `email`, `CNPJ`, `senha`, `agencia`, `conta`, `perfil`) VALUES
('banana', '4142112', '1231421', '41241', '2412412', '241421', NULL),
('paulin programa', 'paulo@gmail.com', '1234566', '123', '123', '123', NULL),
('Pinotti', 'gabrielpinotti1@gmail.com', '46901303000186', '202cb962ac59075b964b07152d234b70', '100', '100', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `idItem` varchar(10) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `preco` varchar(10) DEFAULT NULL,
  `idProduto` int NOT NULL,
  `donoDoItem` varchar(11) NOT NULL,
  PRIMARY KEY (`idItem`),
  KEY `DonoDoItem` (`donoDoItem`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pessoa`
--

INSERT INTO `pessoa` (`nome`, `cpf`, `email`, `senha`, `credito`) VALUES
('superuser', '11122233344', 'superuser@gmail.com', 'admin', NULL),
('gabriel', '20295039752', 'gabriel@gmail.com', '202cb962ac59075b964b07152d234b70', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

DROP TABLE IF EXISTS `produto`;
CREATE TABLE IF NOT EXISTS `produto` (
  `nome` varchar(45) NOT NULL,
  `descricao` varchar(90) DEFAULT NULL,
  `preco` varchar(4) NOT NULL,
  `idProduto` int NOT NULL,
  `CNPJ` varchar(14) NOT NULL,
  `imagem` varchar(120) NOT NULL,
  PRIMARY KEY (`idProduto`),
  KEY `EmpresaDoProduto` (`CNPJ`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`nome`, `descricao`, `preco`, `idProduto`, `CNPJ`, `imagem`) VALUES
('teste', 'tset', '123', '1', '46901303000186', 'images/produtos/46901303000186/77a52a30147f44f6f86111ed3274c11e.jpeg');

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `ClasseDoItem` FOREIGN KEY (`idProduto`) REFERENCES `produto` (`idProduto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `DonoDoItem` FOREIGN KEY (`donoDoItem`) REFERENCES `pessoa` (`cpf`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `EmpresaDoProduto` FOREIGN KEY (`CNPJ`) REFERENCES `empresa` (`CNPJ`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
