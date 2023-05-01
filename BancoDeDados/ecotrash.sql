-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01-Maio-2023 às 18:01
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
-- Banco de dados: `ecotrash`
--
CREATE DATABASE IF NOT EXISTS `ecotrash` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ecotrash`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastro`
--

CREATE TABLE `cadastro` (
  `ID` int(6) NOT NULL,
  `NOME` varchar(200) NOT NULL,
  `DATA_NASCIMENTO` date DEFAULT NULL,
  `DOCUMENTO` varchar(18) NOT NULL,
  `EMAIL` varchar(150) NOT NULL,
  `TELEFONE` varchar(15) NOT NULL,
  `SEGMENTO` varchar(20) DEFAULT NULL,
  `SENHA` varchar(64) NOT NULL,
  `ID_ENDERECO` int(6) NOT NULL,
  `TIPO_CADASTRO` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE `endereco` (
  `ID` int(6) NOT NULL,
  `LOGRADOURO` varchar(255) NOT NULL,
  `NUMERO` int(5) NOT NULL,
  `COMPLEMENTO` varchar(50) DEFAULT NULL,
  `BAIRRO` varchar(30) NOT NULL,
  `CIDADE` varchar(30) NOT NULL,
  `ESTADO` varchar(15) NOT NULL,
  `CEP` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pontos_coleta`
--

CREATE TABLE `pontos_coleta` (
  `ID` int(6) NOT NULL,
  `DESCRICAO` varchar(320) NOT NULL,
  `CNPJ` varchar(18) NOT NULL,
  `LATITUDE` varchar(10) NOT NULL,
  `LONGITUDE` varchar(10) NOT NULL,
  `ID_ENDERECO` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cadastro`
--
ALTER TABLE `cadastro`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_ENDERECO` (`ID_ENDERECO`);

--
-- Índices para tabela `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `pontos_coleta`
--
ALTER TABLE `pontos_coleta`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_ENDERECO` (`ID_ENDERECO`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cadastro`
--
ALTER TABLE `cadastro`
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `cadastro`
--
ALTER TABLE `cadastro`
  ADD CONSTRAINT `cadastro_ibfk_1` FOREIGN KEY (`ID_ENDERECO`) REFERENCES `endereco` (`ID`);

--
-- Limitadores para a tabela `pontos_coleta`
--
ALTER TABLE `pontos_coleta`
  ADD CONSTRAINT `pontos_coleta_ibfk_1` FOREIGN KEY (`ID_ENDERECO`) REFERENCES `endereco` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
