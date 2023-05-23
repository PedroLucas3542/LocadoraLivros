-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23-Maio-2023 às 20:10
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
-- Estrutura da tabela `devolvidos`
--

CREATE TABLE `devolvidos` (
  `id` int(11) NOT NULL,
  `livro_id` int(11) NOT NULL,
  `prazo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `devolvidos`
--

INSERT INTO `devolvidos` (`id`, `livro_id`, `prazo`) VALUES
(34, 75, 's'),
(35, 74, 's'),
(36, 76, 'n'),
(37, 77, 's'),
(38, 78, 'n'),
(39, 79, 's'),
(40, 80, 's'),
(41, 81, 's'),
(42, 82, 's'),
(43, 83, 's'),
(44, 86, 's'),
(45, 85, 's'),
(46, 84, 's'),
(47, 87, 's'),
(48, 87, 's'),
(49, 87, 's'),
(50, 88, 'n'),
(51, 88, 'n'),
(52, 89, 'n'),
(53, 90, 'n'),
(54, 91, 's'),
(55, 92, 's'),
(56, 93, 'n'),
(57, 94, 's'),
(58, 96, 'n');

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
(6, 'Companhia da Letras', 'comp@edi.com', '999999', 'completras.com'),
(7, 'Aleph', 'ale@edi.com', '48654861', 'aleph.com'),
(8, 'Suma', 'suma@edi.com', '514551554', 'suma.com'),
(11, 'Globo Livros', 'globolivros@gmail.com', '75588558', 'globolivros.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `emprestimos`
--

CREATE TABLE `emprestimos` (
  `id` int(11) NOT NULL,
  `livro_id` int(11) DEFAULT NULL,
  `livro_nome` text NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `usuario_nome` text NOT NULL,
  `cpf_usuario` text NOT NULL,
  `data_emprestimo` date NOT NULL,
  `data_devolucao` date NOT NULL,
  `prazo_entrega` date NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `emprestimos`
--

INSERT INTO `emprestimos` (`id`, `livro_id`, `livro_nome`, `usuario_id`, `usuario_nome`, `cpf_usuario`, `data_emprestimo`, `data_devolucao`, `prazo_entrega`, `status`) VALUES
(95, 11, 'Meu Eterno Amigo/Amor', 19, 'Juliana Ramos Lopes', '', '0000-00-00', '0000-00-00', '2023-05-26', ''),
(97, 11, 'Meu Eterno Amigo/Amor', 14, 'Caio Lima', '', '0000-00-00', '2023-05-23', '2023-05-30', 'Devolvido'),
(98, 14, 'a bela e a fera', 20, 'Virginia Portela', '', '0000-00-00', '2023-05-26', '2023-05-25', 'Devolvido'),
(99, 14, 'a bela e a fera', 19, 'Juliana Ramos Lopes', '', '0000-00-00', '2023-05-23', '2023-06-09', 'Devolvido'),
(100, 9, 'A vida secreta do agente', 12, 'Adriano Lemos', '', '0000-00-00', '2023-05-23', '2023-05-27', 'Devolvido'),
(101, 15, 'Percy Jackson', 14, 'Caio Lima', '', '0000-00-00', '0000-00-00', '2023-05-25', '');

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
  `estoque` int(11) DEFAULT NULL,
  `novo_estoque` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `livros`
--

INSERT INTO `livros` (`id`, `nome`, `autor`, `editora`, `data_lancamento`, `estoque`, `novo_estoque`) VALUES
(9, 'A vida secreta do agente', 'Aquele', 'Suma', '2022-03-03', 23, 25),
(10, 'Tanto entre nós', 'Marciano Arruda', 'Globo Livros', '2020-06-04', 23, NULL),
(11, 'Meu Eterno Amigo/Amor', 'Juliana Ramos', 'Aleph', '2022-12-09', 30, NULL),
(12, 'Sobre mim', 'Eu', 'Companhia da Letras', '2023-05-07', 40, 40),
(13, 'CDN', 'Aquele', 'Globo Livros', '2023-05-08', 51, NULL),
(14, 'a bela e a fera', 'disney', 'Globo Livros', '2023-05-11', 19, NULL),
(15, 'Percy Jackson', 'Eu mesmo', 'Suma', '2023-05-02', 0, NULL),
(16, 'Amor e Gelato', 'Jennie', 'Suma', '2023-05-01', 1, NULL);

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
(12, 'Adriano Lemos', 'adriano@gmail.com', '(85) 99999-9999', 'Rua 49, Jereissati 3, Pacatuba, Ceará', '858.888.555-33'),
(13, 'Beatriz Lima', 'bia@gmail.com', '(85) 66548-5255', 'Rua 99, Jereissati 1, Pacatuba, Ceará', '111.118.111-13'),
(14, 'Caio Lima', 'caio@gmail.com', '(85) 99999-9999', 'Rua 115, Jereissati 1, Pacatuba, Ceará', '858.858.858-58'),
(15, 'Daniela Almeida', 'deni@gmail.com', '(25) 15254-8545', 'Rua 49, Recife, Pernambuco', '636.858.555-88'),
(16, 'Eduardo Colenimo', 'dudu@gmail.com', '(56) 48546-3684', 'Rua 115, São Paulo', '116.456.953-30'),
(19, 'Juliana Ramos Lopes', 'juh@gmail.com', '(54) 74798-8545', 'Rua 99, Jereissati 1, Pacatuba, Ceará', '116.089.000-30'),
(20, 'Virginia Portela', 'pot.@gmail.com', '(85) 98989-8989', 'Rua 49, Jereissati 3, Pacatuba, Ceará', '98598598563');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `devolvidos`
--
ALTER TABLE `devolvidos`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT de tabela `devolvidos`
--
ALTER TABLE `devolvidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de tabela `editoras`
--
ALTER TABLE `editoras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `emprestimos`
--
ALTER TABLE `emprestimos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT de tabela `livros`
--
ALTER TABLE `livros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
