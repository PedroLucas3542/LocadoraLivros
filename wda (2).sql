-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08-Maio-2023 às 14:56
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
(6, 'Companhia da Letras', 'comp@edi.com', '4865484', 'completras.com'),
(7, 'Aleph', 'ale@edi.com', '48654861', 'aleph.com'),
(8, 'Suma', 'suma@edi.com', '514551554', 'suma.com'),
(9, 'Globo Livros', 'globolivros@gmail.com', '15214556', 'globolivros.com');

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
(31, 8, 'A volta dos que não foram', 12, 'Adriano Ramos', '858.888.555-33', '2023-05-08', '2023-05-26', '0000-00-00'),
(32, 9, 'A vida secreta do agente', 13, 'Beatriz Lima', '111.118.111-13', '2023-05-08', '2023-05-07', '0000-00-00'),
(33, 10, 'Tanto entre nós', 17, 'Fabio Silva', '777.118.007-77', '2023-05-08', '2023-05-26', '0000-00-00'),
(34, 11, 'Meu Eterno Amigo/Amor', 14, 'Caio Lima', '858.858.858-58', '2023-05-08', '2023-05-12', '0000-00-00');

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
(8, 'A volta dos que não foram', 'Aquele', 'Suma', '2023-03-07', 19),
(9, 'A vida secreta do agente', 'Aquele', 'Suma', '2022-03-03', 19),
(10, 'Tanto entre nós', 'Marciano Arruda', 'Globo Livros', '2020-06-04', 19),
(11, 'Meu Eterno Amigo/Amor', 'Juliana Ramos', 'Aleph', '2022-12-09', 29);

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
(12, 'Adriano Ramos', 'adriano@gmail.com', '(85) 99999-9999', 'Rua 49, Jereissati 3, Pacatuba, Ceará', '858.888.555-33'),
(13, 'Beatriz Lima', 'bia@gmail.com', '(85) 66548-5255', 'Rua 99, Jereissati 1, Pacatuba, Ceará', '111.118.111-13'),
(14, 'Caio Lima', 'caio@gmail.com', '(85) 99999-9999', 'Rua 115, Jereissati 1, Pacatuba, Ceará', '858.858.858-58'),
(15, 'Daniela Almeida', 'deni@gmail.com', '(25) 15254-8545', 'Rua 49, Recife, Pernambuco', '636.858.555-88'),
(16, 'Eduardo Colenimo', 'dudu@gmail.com', '(56) 48546-3684', 'Rua 115, São Paulo', '116.456.953-30'),
(17, 'Fabio Silva', 'fabinhoss@gmail.com', '(45) 68456-8456', 'Rua 49, Jereissati 3, Pacatuba, Ceará', '777.118.007-77');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `emprestimos`
--
ALTER TABLE `emprestimos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de tabela `livros`
--
ALTER TABLE `livros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
