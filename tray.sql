-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 13-Maio-2019 às 23:38
-- Versão do servidor: 10.1.37-MariaDB
-- versão do PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tray`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendas`
--

CREATE TABLE `vendas` (
  `id` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `nome` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `comissao` float DEFAULT NULL,
  `val_venda` float DEFAULT NULL,
  `data_venda` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `vendas`
--

INSERT INTO `vendas` (`id`, `id_vendedor`, `nome`, `email`, `comissao`, `val_venda`, `data_venda`) VALUES
(47, 18, 'Nayara', 'nayara@fernanda.com', 6.8, 80, '2019-05-13'),
(48, 18, 'Nayara', 'nayara@fernanda.com', 5.1, 60, '2019-05-13'),
(49, 18, 'Nayara', 'nayara@fernanda.com', 8.5, 100, '2019-05-13'),
(50, 19, 'testes', 'testes@testes.com', 6.8, 80, '2019-05-13'),
(51, 20, 'valmir', 'valmir@valmir.com.br', 6.8, 80, '2019-05-13'),
(52, 20, 'valmir', 'valmir@valmir.com.br', 8.5, 100, '2019-05-13'),
(53, 21, 'rosana', 'rosana@rosana.com.br', 34, 400, '2019-05-13');

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendedor`
--

CREATE TABLE `vendedor` (
  `id` int(11) NOT NULL,
  `vend_nome` varchar(50) NOT NULL,
  `vend_email` varchar(50) NOT NULL,
  `total_comissao` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `vendedor`
--

INSERT INTO `vendedor` (`id`, `vend_nome`, `vend_email`, `total_comissao`) VALUES
(18, 'Nayara', 'nayara@fernanda.com', 20.4),
(19, 'testes', 'testes@testes.com', 6.8),
(20, 'valmir', 'valmir@valmir.com.br', 15.3),
(21, 'rosana', 'rosana@rosana.com.br', 34);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_vendedor` (`id_vendedor`);

--
-- Indexes for table `vendedor`
--
ALTER TABLE `vendedor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vendas`
--
ALTER TABLE `vendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `vendedor`
--
ALTER TABLE `vendedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `vendas`
--
ALTER TABLE `vendas`
  ADD CONSTRAINT `vendas_ibfk_1` FOREIGN KEY (`id_vendedor`) REFERENCES `vendedor` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
