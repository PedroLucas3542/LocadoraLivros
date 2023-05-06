-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06-Maio-2023 às 21:23
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `wda`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `editoras`
--

CREATE TABLE `editoras` (
  `id` int(11) NOT NULL,
  `nome` text NOT NULL,
  `email` text NOT NULL,
  `telefone` text NOT NULL,
  `site` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `editoras`
--

INSERT INTO `editoras` (`id`, `nome`, `email`, `telefone`, `site`) VALUES
(4, 'Arqueiro', 'arqueiro@edi.com', '75588558', ''),
(5, 'Record', 'record@edi.com', '75588558', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `emprestimos`
--

CREATE TABLE `emprestimos` (
  `id` int(11) NOT NULL,
  `livro_id` int(11) NOT NULL,
  `livro_nome` text NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `usuario_nome` text NOT NULL,
  `cpf_usuario` text NOT NULL,
  `data_emprestimo` date NOT NULL,
  `prazo_entrega` date NOT NULL,
  `data_devolucao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `emprestimos`
--

INSERT INTO `emprestimos` (`id`, `livro_id`, `livro_nome`, `usuario_id`, `usuario_nome`, `cpf_usuario`, `data_emprestimo`, `prazo_entrega`, `data_devolucao`) VALUES
(21, 5, 'Não sei', 10, 'Gisele Albuquerque', '123456789', '2023-05-06', '2023-05-25', '0000-00-00'),
(23, 6, 'Mais teste', 1, 'Pedro Lucas', '147258369', '2023-05-06', '2023-05-18', '0000-00-00'),
(25, 5, 'Não sei', 1, 'Pedro Lucas', '147258369', '2023-05-06', '2023-05-18', '0000-00-00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `livros`
--

CREATE TABLE `livros` (
  `id` int(11) NOT NULL,
  `nome` text DEFAULT NULL,
  `autor` text DEFAULT NULL,
  `editora` text DEFAULT NULL,
  `data_lancamento` date DEFAULT NULL,
  `estoque` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `livros`
--

INSERT INTO `livros` (`id`, `nome`, `autor`, `editora`, `data_lancamento`, `estoque`) VALUES
(1, 'O Pequeno Princeso', 'Raul Seixas', 'Uiii', '2013-04-04', 1),
(3, 'Meu Eterno Amigo/Amor', 'Juliana Ramos', 'Record', '2027-09-14', 16),
(5, 'Não sei', 'TEste', 'Arqueiro', '2023-05-18', 15),
(6, 'Mais teste', 'Teste', 'Record', '2023-05-26', 19),
(7, 'Juninho do Grau', 'Eu mesmo', 'Record', '2023-05-17', 22);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(35) DEFAULT NULL,
  `email` varchar(35) DEFAULT NULL,
  `celular` text DEFAULT NULL,
  `endereco` text DEFAULT NULL,
  `cpf` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `celular`, `endereco`, `cpf`) VALUES
(1, 'Pedro Lucas', 'portelacarlosp@gmail.com', '235234242', 'efegdgrefewefwfewefwfew', '147258369'),
(4, 'Pedro Caio', 'portelacarlosp@gmail.com', '235234242', 'efegdgrefewefwfewefwfew', '321654987'),
(10, 'Gisele Albuquerque', 'nn@gmail.com', '34243234', 'ergrgdrgdrhg rdg zardg', '123456789');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `editoras`
--
ALTER TABLE `editoras`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `emprestimos`
--
ALTER TABLE `emprestimos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `livros`
--
ALTER TABLE `livros`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `editoras`
--
ALTER TABLE `editoras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `emprestimos`
--
ALTER TABLE `emprestimos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `livros`
--
ALTER TABLE `livros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
