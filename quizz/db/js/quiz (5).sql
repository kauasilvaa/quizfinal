-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25-Set-2024 às 19:43
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
-- Banco de dados: `quiz`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `perguntas`
--

CREATE TABLE `perguntas` (
  `id_perguntas` int(11) NOT NULL,
  `titulo_pergunta` varchar(255) NOT NULL,
  `opcao1` varchar(255) NOT NULL,
  `opcao2` varchar(255) NOT NULL,
  `opcao3` varchar(255) NOT NULL,
  `opcao4` varchar(255) NOT NULL,
  `resposta_correta` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `perguntas`
--

INSERT INTO `perguntas` (`id_perguntas`, `titulo_pergunta`, `opcao1`, `opcao2`, `opcao3`, `opcao4`, `resposta_correta`) VALUES
(1, 'a', 'a', 'a', 'a', 'a', 1),
(2, 'a', 'a', 'a', 'a', 'a', 1),
(3, 'a', 'a', 'a', 'a', 'a', 1),
(4, 'a', 'a', 'a', 'a', 'a', 1),
(5, 'a', 'a', 'a', 'a', 'a', 1),
(15, 'rere', 'sasas', 'rerer', 'erer', 'asasa', 2),
(16, 'rere', 'sasas', 'rerer', 'erer', 'asasa', 2),
(17, 'Batata', 'aaaaaaaaaa', 'rerer', 'erer', 'aaaaaaaaaa', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `nomedeusuario` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `nivel_acesso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome`, `nomedeusuario`, `email`, `senha`, `nivel_acesso`) VALUES
(1, 'caio', 'cdd', 'jfuyf@fuf', 'khjlçkh', 0),
(2, 'Kauã', 'kaua', 'kaua60033@gmail.com', 'kaua123', 1),
(5, 'dudao', 'dudao', 'mateusoliiveira000@gmail.com', 'duda123', 0),
(7, 'carlao', 'carlao', 'carlaos@gmail.com', 'carlos123', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `perguntas`
--
ALTER TABLE `perguntas`
  ADD PRIMARY KEY (`id_perguntas`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `perguntas`
--
ALTER TABLE `perguntas`
  MODIFY `id_perguntas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
