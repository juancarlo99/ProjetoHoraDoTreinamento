-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26-Fev-2021 às 19:13
-- Versão do servidor: 10.4.14-MariaDB
-- versão do PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projetoteste`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `alunos`
--

CREATE TABLE `alunos` (
  `id` int(11) NOT NULL,
  `Nome` varchar(22) NOT NULL,
  `Sobrenome` varchar(22) NOT NULL,
  `id_1_etapa` int(11) DEFAULT NULL,
  `id_2_etapa` int(11) DEFAULT NULL,
  `id_cafe1` int(11) DEFAULT NULL,
  `id_cafe2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `salas_curso`
--

CREATE TABLE `salas_curso` (
  `id` int(11) NOT NULL,
  `nome_da_sala` varchar(255) NOT NULL,
  `lotacao` int(11) NOT NULL,
  `tipo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_2_etapa` (`id_2_etapa`),
  ADD KEY `id_cafe1` (`id_cafe1`),
  ADD KEY `id_cafe2` (`id_cafe2`),
  ADD KEY `id_1_etapa` (`id_1_etapa`);

--
-- Índices para tabela `salas_curso`
--
ALTER TABLE `salas_curso`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alunos`
--
ALTER TABLE `alunos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT de tabela `salas_curso`
--
ALTER TABLE `salas_curso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `alunos`
--
ALTER TABLE `alunos`
  ADD CONSTRAINT `alunos_ibfk_1` FOREIGN KEY (`id_2_etapa`) REFERENCES `salas_curso` (`id`),
  ADD CONSTRAINT `alunos_ibfk_2` FOREIGN KEY (`id_cafe1`) REFERENCES `salas_curso` (`id`),
  ADD CONSTRAINT `alunos_ibfk_3` FOREIGN KEY (`id_cafe2`) REFERENCES `salas_curso` (`id`),
  ADD CONSTRAINT `alunos_ibfk_4` FOREIGN KEY (`id_1_etapa`) REFERENCES `salas_curso` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
