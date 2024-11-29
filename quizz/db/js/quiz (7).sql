-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29-Nov-2024 às 12:01
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
-- Estrutura da tabela `atividade`
--

CREATE TABLE `atividade` (
  `id_usuario` int(11) NOT NULL,
  `data_realizacao` datetime NOT NULL,
  `pontuacao` int(11) NOT NULL,
  `respostas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`respostas`)),
  `id_quiz` int(11) NOT NULL,
  `id_atividade` int(11) NOT NULL,
  `total_perguntas` int(11) NOT NULL,
  `materia` varchar(255) NOT NULL,
  `perguntas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `atividade`
--

INSERT INTO `atividade` (`id_usuario`, `data_realizacao`, `pontuacao`, `respostas`, `id_quiz`, `id_atividade`, `total_perguntas`, `materia`, `perguntas`) VALUES
(2, '2024-11-28 14:28:27', 4, '\"[2,1,2,2]\"', 0, 35, 5, 'Sociologia', '');

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
  `resposta_correta` tinyint(1) NOT NULL,
  `conclusao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `perguntas`
--

INSERT INTO `perguntas` (`id_perguntas`, `titulo_pergunta`, `opcao1`, `opcao2`, `opcao3`, `opcao4`, `resposta_correta`, `conclusao`) VALUES
(41, 'Qual é o principal fator que causa a mudança climática global?', 'Desmatamento', 'Emissão de gases do efeito estufa', 'Variações naturais do clima', 'Atividades solares', 2, 'Se você escolheu a resposta correta (Emissão de gases do efeito estufa): Ótimo! Os gases como dióxido de carbono e metano são os maiores responsáveis pela intensificação do efeito estufa.'),
(48, 'Qual é o maior planeta do Sistema Solar?', 'Terra', 'Júpiter', 'Saturno', 'Marte', 2, 'Júpiter é o maior planeta do Sistema Solar, com um diâmetro de aproximadamente 142.984 km, o que é cerca de 11 vezes maior que o da Terra. Sua enorme massa e sua composição principalmente gasosa (hidrogênio e hélio) fazem dele o gigante gasoso mais massivo e volumoso, superando até mesmo Saturno, o segundo maior planeta.'),
(49, 'Qual é a capital da França?', 'Madrid', 'Paris', 'Londres', 'Roma', 2, 'Paris é a capital da França e uma das cidades mais famosas do mundo. Conhecida como \"A Cidade Luz\", é um centro global de arte, cultura e história. Além disso, Paris é sede de importantes monumentos como a Torre Eiffel e o Museu do Louvre.'),
(50, 'Quem foi o primeiro presidente dos Estados Unidos?', 'Abraham Lincoln', 'George Washington', 'Thomas Jefferson', 'Franklin D. Roosevelt', 2, 'George Washington foi o primeiro presidente dos Estados Unidos, servindo de 1789 a 1797. Ele é conhecido por liderar o país durante a Revolução Americana e por ser um dos pais fundadores da nação. Washington também foi crucial para estabelecer os precedentes do governo dos EUA.\r\n\r\n'),
(51, 'Qual é o principal componente da água?', 'Oxigênio', 'Nitrogênio', 'Carbono', 'Hidrogênio', 4, 'A água é composta por dois átomos de hidrogênio (H) e um átomo de oxigênio (O), formando a fórmula H?O. O hidrogênio é o elemento mais leve e mais abundante no universo, e sua combinação com o oxigênio cria uma das substâncias mais essenciais para a vida na Terra.');

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
(5, 'tafarel', 'dudao', 'mateusoliiveira000@gmail.com', 'duda123', 0),
(7, 'carlao', 'carlao', 'carlaos@gmail.com', 'carlos123', 0),
(8, 'caio', 'caioo', 'carlaos@gmail.com', 'caio123', 0),
(9, 'Ruan', 'Ruan123', 'juan.juan@portalsesisp.org.br', '12345', 0),
(10, 'angelo', 'angelo ostroski', 'angeloo@portalsesisp.org.br', 'troski6608', 0),
(11, 'Filipe e Anna ', 'FilipeeAnna', 'filipeanna123@gmail.com', 'filipeanna123', 0),
(12, 'filipeanna', 'filipeanna', 'filipeanna@gmail.com', 'filipeanna123', 0),
(13, 'gui da cu', 'gui da cu', 'guidacu@gmail.com', '997754890', 0),
(14, 'karen', 'karen beatriz', 'karenbeatrizrodriguessantana@gmail.com', 'KareN@123', 0),
(23, 'kaua', 'kaua', 'kaua60033@gmail.com', 'kaua123', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `atividade`
--
ALTER TABLE `atividade`
  ADD PRIMARY KEY (`id_atividade`);

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
-- AUTO_INCREMENT de tabela `atividade`
--
ALTER TABLE `atividade`
  MODIFY `id_atividade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de tabela `perguntas`
--
ALTER TABLE `perguntas`
  MODIFY `id_perguntas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
