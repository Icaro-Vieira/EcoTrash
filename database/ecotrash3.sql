-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30-Maio-2023 às 21:25
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
-- Banco de dados: `ecotrash3`
--
CREATE DATABASE IF NOT EXISTS `ecotrash3` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ecotrash3`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastro`
--

CREATE TABLE `cadastro` (
  `ID` int(6) NOT NULL,
  `NOME` varchar(200) NOT NULL,
  `SOBRENOME` varchar(120) DEFAULT NULL,
  `DOCUMENTO` varchar(18) NOT NULL,
  `EMAIL` varchar(150) NOT NULL,
  `TELEFONE` varchar(15) NOT NULL,
  `SEGMENTO` varchar(20) DEFAULT NULL,
  `SENHA` varchar(64) NOT NULL,
  `ID_ENDERECO` int(6) NOT NULL,
  `TIPO_CADASTRO` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `cadastro`
--

INSERT INTO `cadastro` (`ID`, `NOME`, `SOBRENOME`, `DOCUMENTO`, `EMAIL`, `TELEFONE`, `SEGMENTO`, `SENHA`, `ID_ENDERECO`, `TIPO_CADASTRO`) VALUES
(6, 'ADM', ' ', '111.111.111-11', 'adm@ecotrash.com', '19981626988', NULL, '$2y$10$c0cGEnfwx.QiGUGZw7soyuyitLHAsUynykwNJG9W7NcsujHLaiigO', 6, 'F'),
(9, 'DLD SOLUCOES EM LOGISTICA REVERSA, GESTAO E RECICLAGEM LTDA', NULL, '37.540.504/0001-04', 'contato@dldlog.com.br', '33515609', 'Comércio atacadista ', '$2y$10$NgySv5nfjes2tyWmldXLq.tA4Zk3DViJmdBJtsGrjrCFqCzdteqja', 9, 'J'),
(12, 'GOOGLE BRASIL INTERNET LTDA.', NULL, '06.990.590/0001-23', 'googlebrasil@google.com', '23958400', 'Portais, provedores ', '$2y$10$B9GV7U.SYJ6b22IhtogyGuPoXW65q4ULqN2RbbyLcmA9AIJxRUPUe', 12, 'J');

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

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`ID`, `LOGRADOURO`, `NUMERO`, `COMPLEMENTO`, `BAIRRO`, `CIDADE`, `ESTADO`, `CEP`) VALUES
(6, 'Rua Ângelo Donadel', 236, 'Casa', 'Vila Sumaré', 'Leme', 'SP', '13615-070'),
(9, 'MELVIN JONES', 2851, '', 'JARDIM TANGARA', 'Araras', 'SP', '13607461'),
(12, 'BRIG FARIA LIMA', 3477, 'ANDAR 17A20 TSUL 2 17A20', 'ITAIM BIBI', 'São paulo', 'SP', '04538133');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pontos_coleta`
--

CREATE TABLE `pontos_coleta` (
  `ID` int(6) NOT NULL,
  `DESCRICAO` varchar(100) DEFAULT NULL,
  `CEP` varchar(14) NOT NULL,
  `LOGRADOURO` varchar(100) NOT NULL,
  `BAIRRO` varchar(100) NOT NULL,
  `NUMERO` varchar(15) NOT NULL,
  `TIPOMATERIAIS` varchar(100) NOT NULL,
  `ID_CADASTRO` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `pontos_coleta`
--

INSERT INTO `pontos_coleta` (`ID`, `DESCRICAO`, `CEP`, `LOGRADOURO`, `BAIRRO`, `NUMERO`, `TIPOMATERIAIS`, `ID_CADASTRO`) VALUES
(23, 'Sucatas Tofolo', '13503-300', 'Rua 19', 'Consolação', '19', 'Eletrodomestico ', 12),
(24, 'Eco Ponto', '13615-070', 'Rua Ângelo Donadel', 'Vila Sumaré', '236', 'Baterias e pilhas ', 12),
(25, 'DLDLOG REVERSA', '13607-461', 'Avenida Melvin Jones', 'Jardim Tangará', '2851', 'Baterias e pilhas ', 9);

-- --------------------------------------------------------

--
-- Estrutura da tabela `solicitacao_ponto`
--

CREATE TABLE `solicitacao_ponto` (
  `ID` int(6) NOT NULL,
  `DESCRICAO` varchar(100) DEFAULT NULL,
  `CEP` varchar(12) NOT NULL,
  `LOGRADOURO` varchar(100) NOT NULL,
  `BAIRRO` varchar(100) NOT NULL,
  `NUMERO` varchar(15) NOT NULL,
  `TIPOMATERIAIS` varchar(100) NOT NULL,
  `ID_CADASTRO` int(6) NOT NULL
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
  ADD KEY `ID_CADASTRO` (`ID_CADASTRO`) USING BTREE;

--
-- Índices para tabela `solicitacao_ponto`
--
ALTER TABLE `solicitacao_ponto`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_CADASTRO` (`ID_CADASTRO`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cadastro`
--
ALTER TABLE `cadastro`
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `pontos_coleta`
--
ALTER TABLE `pontos_coleta`
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `solicitacao_ponto`
--
ALTER TABLE `solicitacao_ponto`
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

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
  ADD CONSTRAINT `pontos_coleta_ibfk_1` FOREIGN KEY (`ID_CADASTRO`) REFERENCES `cadastro` (`ID`);

--
-- Limitadores para a tabela `solicitacao_ponto`
--
ALTER TABLE `solicitacao_ponto`
  ADD CONSTRAINT `solicitacao_ponto_ibfk_1` FOREIGN KEY (`ID_CADASTRO`) REFERENCES `cadastro` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
