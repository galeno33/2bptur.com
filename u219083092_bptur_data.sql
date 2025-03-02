-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 10/04/2024 às 11:45
-- Versão do servidor: 10.11.7-MariaDB-cll-lve
-- Versão do PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `u219083092_bptur_data`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `agenda_permuta`
--

CREATE TABLE `agenda_permuta` (
  `id_agenda` int(10) NOT NULL,
  `matr_permutante` int(10) DEFAULT NULL,
  `dia_agenda` date DEFAULT NULL,
  `aceito_permuta` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `permutas`
--

CREATE TABLE `permutas` (
  `id_permuta` int(10) NOT NULL,
  `matr_permutante` int(10) DEFAULT NULL,
  `matr_permutado` int(10) DEFAULT NULL,
  `dia_permuta` date DEFAULT NULL,
  `aceito_permuta` varchar(3) DEFAULT NULL,
  `autorizacao_permuta` varchar(3) DEFAULT NULL,
  `justificativa` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pontos`
--

CREATE TABLE `pontos` (
  `id_pontos` int(10) NOT NULL,
  `matricula` int(10) NOT NULL,
  `ponto_ranking` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pontos`
--

INSERT INTO `pontos` (`id_pontos`, `matricula`, `ponto_ranking`) VALUES
(6, 417602, 80),
(7, 846264, 80),
(10, 822662, 175),
(14, 870039, 25),
(25, 870229, 25),
(26, 822663, 25),
(27, 870039, 25),
(28, 822663, 25),
(29, 875865, 25),
(36, 821523, 55),
(37, 869974, 55),
(38, 870927, 55),
(44, 858959, 110),
(45, 871676, 155),
(46, 416697, 100),
(47, 869703, 100),
(48, 870672, 55),
(49, 870672, 115),
(50, 846084, 115),
(51, 821523, 115),
(52, 846084, 125),
(53, 870269, 125),
(54, 870927, 125),
(55, 869974, 25),
(56, 869703, 25),
(57, 822665, 25),
(58, 871676, 25),
(59, 869481, 25),
(60, 870672, 25),
(61, 870672, 25),
(62, 822665, 25),
(63, 822661, 125),
(64, 869139, 125),
(65, 870996, 125),
(66, 870858, 125),
(67, 869139, 125),
(68, 822661, 125),
(69, 822665, 80),
(70, 871676, 80),
(71, 869481, 80),
(72, 870672, 80),
(73, 870672, 25),
(74, 822665, 25),
(75, 846084, 100),
(76, 870269, 100),
(77, 870927, 100),
(78, 849228, 160),
(79, 870672, 160),
(80, 871676, 160),
(81, 822665, 160),
(82, 822665, 125),
(83, 822665, 125),
(84, 871676, 125),
(85, 871676, 125),
(86, 870672, 125),
(87, 870672, 125),
(88, 822666, 25),
(89, 846099, 25),
(90, 869280, 25),
(91, 869120, 25),
(92, 846221, 25),
(93, 846099, 25),
(94, 822664, 25),
(95, 417962, 100),
(96, 846221, 175),
(97, 870365, 175),
(98, 868946, 175),
(99, 846221, 100),
(100, 822660, 25),
(101, 822845, 25),
(102, 822660, 100),
(103, 822845, 100),
(104, 871867, 100),
(105, 822666, 50),
(106, 870505, 50),
(107, 850150, 50),
(108, 869120, 50),
(109, 846221, 175),
(110, 822664, 175),
(111, 870505, 175),
(112, 871867, 175),
(113, 822660, 125),
(114, 822845, 125),
(115, 868946, 125),
(116, 870365, 125),
(117, 417962, 125),
(118, 846099, 125),
(119, 870365, 125),
(120, 870540, 125),
(121, 871450, 125),
(122, 822661, 125),
(123, 870858, 125),
(124, 869974, 55),
(125, 869703, 55),
(126, 870672, 125),
(127, 871676, 125),
(128, 822665, 125),
(129, 417962, 50),
(130, 871450, 50),
(131, 846099, 50),
(132, 870365, 50),
(133, 870540, 50),
(134, 417962, 25),
(135, 846099, 25),
(136, 870365, 25),
(137, 870540, 25),
(138, 871450, 25),
(139, 822666, 50),
(140, 846099, 50),
(141, 869717, 50),
(142, 871450, 50),
(143, 869120, 50),
(144, 822666, 25),
(145, 846099, 25),
(146, 869120, 25),
(147, 846221, 115),
(148, 822664, 115),
(149, 846099, 115),
(150, 417962, 25),
(151, 869722, 25),
(152, 850008, 25),
(153, 846221, 50),
(154, 869120, 50),
(155, 869722, 50),
(156, 822664, 125),
(157, 822666, 125),
(158, 871867, 125),
(159, 869722, 125),
(160, 417207, 100),
(161, 822666, 100),
(162, 846099, 100),
(163, 869120, 100),
(164, 822665, 125),
(165, 871676, 125),
(166, 858959, 125),
(167, 417207, 100),
(168, 870672, 125),
(169, 822666, 100),
(170, 870672, 125),
(171, 869120, 100),
(172, 871676, 125),
(173, 858959, 125),
(174, 822665, 125),
(175, 822665, 125),
(176, 858959, 125),
(177, 871676, 125),
(178, 870672, 125),
(179, 870672, 125),
(180, 871676, 125),
(181, 858959, 125),
(182, 822665, 125),
(183, 822665, 125),
(184, 871867, 55),
(185, 869722, 55),
(186, 417207, 55),
(187, 846221, 55),
(188, 822660, 55),
(189, 822666, 55),
(190, 870672, 125),
(191, 871676, 125),
(192, 858959, 125),
(193, 822665, 125),
(194, 822665, 160),
(195, 858959, 160),
(196, 871676, 160),
(197, 870672, 160),
(198, 870672, 25),
(199, 871676, 25),
(200, 858959, 25),
(201, 822665, 25),
(202, 849228, 125),
(203, 871676, 125),
(204, 870672, 125),
(205, 822661, 100),
(206, 869139, 100),
(207, 870858, 100),
(208, 846221, 100),
(209, 822666, 100),
(210, 869120, 100),
(211, 846221, 25),
(212, 822666, 25),
(213, 869120, 25),
(214, 822660, 100),
(215, 822845, 100),
(216, 870365, 100),
(217, 846221, 100),
(218, 869269, 125),
(219, 869818, 125),
(220, 869974, 125),
(221, 870494, 125),
(222, 417207, 100),
(223, 822666, 100),
(224, 869120, 100),
(225, 846221, 50),
(226, 849655, 50),
(227, 871867, 50),
(228, 846099, 50),
(229, 870505, 50),
(230, 869120, 50),
(231, 849228, 160),
(232, 871676, 160),
(233, 858959, 160),
(234, 858959, 160),
(235, 871676, 160),
(236, 849228, 160),
(237, 870672, 160),
(238, 870672, 125),
(239, 870858, 125),
(240, 871676, 125),
(241, 417207, 100),
(242, 869120, 100),
(243, 869722, 100),
(244, 822664, 25),
(245, 850008, 25),
(246, 870505, 25);

-- --------------------------------------------------------

--
-- Estrutura para tabela `ranking`
--

CREATE TABLE `ranking` (
  `id_ranking` int(10) NOT NULL,
  `matricula` int(10) NOT NULL,
  `miker_Bo` bigint(20) DEFAULT NULL,
  `sigo_ocorrencia` int(30) DEFAULT NULL,
  `tipificacao_crime` varchar(30) DEFAULT NULL,
  `dia_mes` date DEFAULT NULL,
  `endereco_ocorrencia` varchar(30) DEFAULT NULL,
  `bairro_ocorrencia` varchar(30) DEFAULT NULL,
  `cidade_ocorrencia` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ranking`
--

INSERT INTO `ranking` (`id_ranking`, `matricula`, `miker_Bo`, `sigo_ocorrencia`, `tipificacao_crime`, `dia_mes`, `endereco_ocorrencia`, `bairro_ocorrencia`, `cidade_ocorrencia`) VALUES
(1, 846264, 101, 12024, '1', '2024-01-03', NULL, NULL, NULL),
(2, 417602, 1012024, 12024, '1', '2024-01-03', NULL, NULL, NULL),
(3, 822662, 501, 2024, '4', '2024-01-03', NULL, NULL, NULL),
(4, 870039, 504, 504, '10', '2024-01-04', 'Avenida principal', 'Carioca', 'Água Doce '),
(5, 870229, 504, 504, '10', '2024-01-04', 'Avenida principal ', 'Carioca ', 'Água Doce '),
(6, 822663, 604, 604, '10', '2024-01-05', 'Rua do cemitério ', 'Carioca ', ''),
(7, 870039, 604, 604, '10', '2024-01-05', 'Rua do cemitério ', 'Carioca ', 'Água Doce '),
(8, 822663, 804, 804, '10', '2024-01-11', 'Povoado Canabrava ', 'Água Doce ', ''),
(9, 875865, 804, 804, '10', '2024-01-11', 'Povoado Canabrava ', 'Povoado Canabrava ', 'Água Doce '),
(10, 821523, 102, 0, '10', '2024-01-08', 'rua principal, sn ', 'fazenda velha', 'tutoia'),
(11, 869974, 102, 0, '10', '2024-01-09', 'rua principal, sn ', 'fazenda velha', 'tutoia'),
(12, 870927, 102, 0, '10', '2024-01-09', 'rua principal, sn ', 'fazenda velha', 'tutoia'),
(13, 858959, 702, 0, '9', '2024-01-11', 'porto', 'Centro', 'Tutoia'),
(14, 871676, 702, 0, '9', '2024-01-11', 'porto', 'Centro', 'Tutoia'),
(15, 416697, 1102, 0, '10', '2024-01-18', 'porto de areia', 'santa rita', 'Tutoia'),
(16, 869703, 1102, 0, '10', '2024-01-18', 'porto de areia', 'santa rita', 'Tutoia'),
(17, 870672, 1102, 0, '10', '2024-01-18', 'porto de areia', 'santa rita', 'Tutoia'),
(18, 870672, 902, 0, '6', '2024-01-17', 'rua principal, sn ', 'porto de areia', 'Tutoia'),
(19, 846084, 902, 0, '6', '2024-01-17', 'rua principal, sn ', 'porto de areia', 'Tutoia'),
(20, 821523, 902, 0, '6', '2024-01-17', 'rua principal, sn ', 'porto de areia', 'Tutoia'),
(21, 846084, 1902, 0, '7', '2024-01-29', 'MA 034', 'POSTO BRASIL', 'TUTOIA'),
(22, 870269, 1902, 0, '7', '2024-01-29', 'MA 034', 'POSTO BRASIL', 'TUTOIA'),
(23, 870927, 1902, 0, '7', '2024-01-29', 'MA 034', 'POSTO BRASIL', 'TUTOIA'),
(24, 869974, 2002, 0, '10', '2024-01-31', 'RUA SENADOR LEITE ', 'CENTRO', 'TUTÓIA'),
(25, 869703, 2002, 0, '10', '2024-01-31', 'RUA SENADOR LEITE ', 'Centro', 'TUTOIA'),
(26, 822665, 1302, 0, '10', '2024-01-21', 'PRAIA', 'SÃO JOSÉ', 'TUTÓIA'),
(27, 871676, 1302, 0, '10', '2024-01-21', 'PRAIA', 'SÃO JOSÉ', 'TUTÓIA'),
(28, 869481, 1302, 0, '10', '2024-01-21', 'PRAIA', 'SÃO JOSÉ', 'TUTÓIA'),
(29, 870672, 1302, 0, '10', '2024-01-21', 'PRAIA', 'SÃO JOSÉ', 'TUTÓIA'),
(30, 870672, 1202, 0, '10', '2024-01-21', 'MA 034', 'SERIEMA', 'TUTOIA'),
(31, 822665, 1202, 0, '10', '2024-01-21', 'MA 034', 'SERIEMA', 'TUTÓIA'),
(32, 822661, 1602, 0, '1', '2024-01-25', '', 'NOVA TERRA', 'TUTOIA'),
(33, 869139, 1602, 0, '1', '2024-01-25', '', 'NOVA TERRA', 'TUTÓIA'),
(34, 870996, 1602, 0, '1', '2024-01-25', '', 'NOVA TERRA', 'TUTÓIA'),
(35, 870858, 2302, 0, '1', '2024-02-06', 'av principal', 'PAXICÁ', 'TUTÓIA'),
(36, 869139, 2302, 0, '1', '2024-02-06', 'av principal', 'PAXICÁ', 'TUTÓIA'),
(37, 822661, 2302, 0, '1', '2024-02-06', 'av principal', 'PAXICÁ', 'TUTÓIA'),
(38, 822665, 2102, 0, '7', '2024-02-03', '', 'BELAGUA', 'TUTÓIA'),
(39, 871676, 2102, 0, '7', '2024-02-03', '', 'BELAGUA', 'TUTÓIA'),
(40, 869481, 2102, 0, '7', '2024-02-03', '', 'BELAGUA', 'TUTÓIA'),
(41, 870672, 2102, 0, '7', '2024-02-03', '', 'BELAGUA', 'TUTÓIA'),
(42, 870672, 2202, 0, '10', '2024-02-04', '', 'Centro', 'TUTÓIA'),
(43, 822665, 2202, 0, '10', '2024-02-04', '', 'Centro', 'TUTÓIA'),
(44, 846084, 2602, 0, '10', '2024-02-10', 'AV PAULINO NEVES ', 'CENTRO', 'TUTÓIA'),
(45, 870269, 2602, 0, '10', '2024-02-10', 'AV PAULINO NEVES ', 'Centro', 'TUTÓIA'),
(46, 870927, 2602, 0, '10', '2024-02-10', 'AV PAULINO NEVES ', 'Centro', 'TUTÓIA'),
(47, 849228, 3002, 0, '6', '2024-02-16', '', 'BOM GOSTO', 'TUTÓIA'),
(48, 870672, 3002, 0, '6', '2024-02-16', '', 'BOM GOSTO', 'TUTÓIA'),
(49, 871676, 3002, 0, '6', '2024-02-16', '', 'BOM GOSTO', 'TUTÓIA'),
(50, 822665, 3002, 0, '6', '2024-02-16', '', 'BOM GOSTO', 'TUTÓIA'),
(51, 822665, 2902, 0, '7', '2024-02-14', '', 'Centro', 'TUTÓIA'),
(52, 822665, 2802, 0, '7', '2024-02-16', '', 'Centro', 'TUTÓIA'),
(53, 871676, 2902, 0, '7', '2024-02-14', '', 'Centro', 'TUTÓIA'),
(54, 871676, 2802, 0, '7', '2024-02-16', '', 'Centro', 'TUTÓIA'),
(55, 870672, 2802, 0, '7', '2024-02-14', '', 'Centro', 'TUTÓIA'),
(56, 870672, 2902, 0, '7', '2024-02-16', '', 'Centro', 'TUTÓIA'),
(57, 822666, 104, 0, '10', '2024-01-03', 'Povoado São Paulo ', '', 'Araioses '),
(58, 846099, 104, 0, '10', '2024-01-03', 'Povoado São Paulo ', '', 'Araioses '),
(59, 869280, 104, 0, '10', '2024-01-03', 'Povoado São Paulo ', '', 'Araioses '),
(60, 869120, 104, 0, '10', '2024-01-03', 'Povoado São Paulo ', '', 'Araioses '),
(61, 846221, 304, 0, '10', '2024-01-04', 'Povoado João Peres ', '', 'Araioses '),
(62, 846099, 304, 0, '10', '2024-01-04', 'Povoado João Peres ', '', 'Araioses '),
(63, 822664, 304, 0, '10', '2024-01-04', 'Povoado João Peres ', '', 'Araioses '),
(64, 417962, 704, 0, '10', '2024-01-09', 'Povoado João Peres ', '', 'Araioses '),
(65, 846221, 704, 0, '4', '2024-01-09', 'Entrada do Goiabal', '', 'Araioses '),
(66, 870365, 704, 0, '4', '0000-00-00', '', '', ''),
(67, 868946, 704, 0, '4', '2024-01-09', 'Entrada do Goiabal', '', 'Araioses '),
(68, 846221, 904, 0, '4', '2024-01-14', 'Rua Dom Pedro II ', 'Botafogo ', 'Araioses '),
(69, 822660, 904, 0, '10', '2024-01-14', 'Rua Dom Pedro II ', 'Botafogo ', 'Araioses '),
(70, 822845, 904, 0, '10', '2024-01-14', 'Rua Dom Pedro II ', 'Botafogo ', 'Araioses '),
(71, 822660, 1004, 0, '10', '2024-01-15', 'Povoado João Peres ', '', 'Araioses '),
(72, 822845, 1004, 0, '10', '2024-01-15', 'Povoado João Peres ', '', 'Araioses '),
(73, 871867, 1004, 0, '10', '2024-01-15', 'Povoado João Peres ', '', 'Araioses '),
(74, 822666, 1104, 0, '7', '2024-01-18', 'Povoado João Peres ', '', 'Araioses '),
(75, 870505, 1104, 0, '7', '2024-01-18', 'Povoado João Peres ', '', 'Araioses '),
(76, 850150, 1104, 0, '7', '0000-00-00', 'Povoado João Peres ', '', 'Araioses '),
(77, 869120, 1104, 0, '7', '2024-01-18', 'Povoado João Peres ', '', 'Araioses '),
(78, 846221, 1204, 0, '4', '2024-01-21', 'Rua Mugumbeira 2', 'Comprida', 'Araioses '),
(79, 822664, 1204, 0, '4', '2024-01-21', 'Rua Mugumbeira 2', 'Comprida', 'Araioses '),
(80, 870505, 1204, 0, '4', '2024-01-21', 'Rua Mugumbeira 2', 'Comprida', 'Araioses '),
(81, 871867, 1204, 0, '4', '2024-01-21', 'Rua Mugumbeira 2', 'Comprida', 'Araioses '),
(82, 822660, 1304, 0, '1', '2024-01-22', 'Travessa Mariana Cardoso ', 'Nova Conceição ', 'Araioses '),
(83, 822845, 1304, 0, '1', '2024-01-22', 'Travessa Mariana Cardoso ', 'Nova Conceição ', 'Araioses '),
(84, 868946, 1304, 0, '1', '2024-01-22', 'Travessa Mariana Cardoso ', 'Nova Conceição ', 'Araioses '),
(85, 870365, 1304, 0, '1', '2024-01-22', 'Travessa Mariana Cardoso ', 'Nova Conceição ', 'Araioses '),
(86, 417962, 1404, 0, '1', '2024-01-24', 'Travessa José Neves', 'Nova Conceição ', 'Araioses '),
(87, 846099, 1404, 0, '1', '2024-01-24', 'Travessa José Neves', 'Nova Conceição ', 'Araioses '),
(88, 870365, 1404, 0, '1', '2024-01-24', 'Travessa José Neves', 'Nova Conceição ', 'Araioses '),
(89, 870540, 1404, 0, '1', '2024-01-24', 'Travessa José Neves', 'Nova Conceição ', 'Araioses '),
(90, 871450, 1404, 0, '1', '2024-01-24', 'Travessa José Neves', 'Nova Conceição ', 'Araioses '),
(91, 822661, 2402, 0, '1', '2024-02-07', 'PRAÇA TREMEMBÉS', 'CENTRO', 'TUTÓIA'),
(92, 870858, 2402, 0, '1', '2024-02-07', 'PRAÇA TREMEMBÉS', 'Centro', 'TUTÓIA'),
(93, 869974, 2702, 0, '10', '2024-02-13', 'AV PAULINO NEVES ', 'Centro', 'TUTÓIA'),
(94, 869703, 2702, 0, '10', '2024-02-13', 'AV PAULINO NEVES ', 'Centro', 'TUTÓIA'),
(95, 870672, 3002, 0, '7', '2024-02-16', '', 'Centro', 'TUTÓIA'),
(96, 871676, 3002, 0, '7', '2024-02-16', '', 'Centro', 'TUTÓIA'),
(97, 822665, 3002, 0, '7', '2024-02-16', '', 'Centro', 'TUTÓIA'),
(98, 417962, 1504, 0, '2', '2024-01-24', 'Avenida Dr Paulo Ramos ', '', 'Araioses '),
(99, 871450, 1504, 0, '2', '2024-01-24', 'Avenida Dr Paulo Ramos ', '', 'Araioses '),
(100, 846099, 1504, 0, '2', '2024-01-24', 'Avenida Dr Paulo Ramos ', '', 'Araioses '),
(101, 870365, 1504, 0, '2', '2024-01-24', 'Avenida Dr Paulo Ramos ', '', 'Araioses '),
(102, 870540, 1504, 0, '2', '2024-01-24', 'Avenida Dr Paulo Ramos ', '', 'Araioses '),
(103, 417962, 1604, 0, '10', '2024-01-24', 'Lagoa das Cafusas', '', 'Araioses '),
(104, 846099, 1604, 0, '10', '2024-01-24', 'Lagoa das Cafusas', '', 'Araioses '),
(105, 870365, 1604, 0, '10', '2024-01-24', 'Lagoa das Cafusas', '', 'Araioses '),
(106, 870540, 1604, 0, '10', '2024-01-24', 'Lagoa das Cafusas', '', 'Araioses '),
(107, 871450, 1604, 0, '10', '2024-01-24', 'Lagoa das Cafusas', '', 'Araioses '),
(108, 822666, 1704, 0, '2', '2024-01-26', 'Carnaubeiras', '', 'Araioses '),
(109, 846099, 1704, 0, '2', '2024-01-26', 'Carnaubeiras', '', 'Araioses '),
(110, 869717, 1704, 0, '2', '2024-01-26', 'Carnaubeiras', '', 'Araioses '),
(111, 871450, 1704, 0, '2', '2024-01-26', 'Carnaubeiras', '', 'Araioses '),
(112, 869120, 1704, 0, '2', '2024-01-26', 'Carnaubeiras', '', 'Araioses '),
(113, 822666, 1804, 0, '10', '2024-01-27', 'Rua Benjamin Constant ', 'Conceição ', 'Araioses '),
(114, 846099, 1804, 0, '10', '2024-01-27', 'Rua Benjamin Constant ', 'Conceição ', 'Araioses '),
(115, 869120, 1804, 0, '10', '2024-01-27', 'Rua Benjamin Constant ', 'Conceição ', 'Araioses '),
(116, 846221, 1904, 0, '6', '2024-01-29', 'Próximo ao IFMA', '', 'Araioses '),
(117, 822664, 1904, 0, '6', '2024-01-29', 'Próximo ao IFMA', '', 'Araioses '),
(118, 846099, 1904, 0, '6', '2024-01-29', 'Próximo ao IFMA', '', 'Araioses '),
(119, 417962, 2104, 0, '10', '2024-02-01', 'Povoado João Peres ', '', 'Araioses '),
(120, 869722, 2104, 0, '10', '2024-02-01', 'Povoado João Peres ', '', 'Araioses '),
(121, 850008, 2104, 0, '10', '2024-02-01', 'Povoado João Peres ', '', 'Araioses '),
(122, 846221, 2204, 0, '2', '2024-02-04', 'Conjunto João Machado ', '', 'Araioses '),
(123, 869120, 2204, 0, '2', '2024-02-04', 'Conjunto João Machado ', '', 'Araioses '),
(124, 869722, 2204, 0, '2', '2024-02-04', 'Conjunto João Machado ', '', 'Araioses '),
(125, 822664, 2304, 0, '3', '2024-02-05', 'Povoado João Peres ', '', 'Araioses '),
(126, 822666, 2304, 0, '3', '2024-02-05', 'Povoado João Peres ', '', 'Araioses '),
(127, 871867, 2304, 0, '3', '2024-02-05', 'Povoado João Peres ', '', 'Araioses '),
(128, 869722, 2304, 0, '3', '2024-02-05', 'Povoado João Peres ', '', 'Araioses '),
(129, 417207, 2404, 0, '10', '2024-02-11', 'Beira Rio', '', 'Araioses '),
(130, 822666, 2404, 0, '10', '2024-02-11', 'Beira Rio', '', 'Araioses '),
(131, 846099, 2404, 0, '10', '2024-02-11', 'Beira Rio', '', 'Araioses '),
(132, 869120, 2404, 0, '10', '2024-02-11', 'Beira Rio', '', 'Araioses '),
(133, 822665, 3402, 0, '7', '2024-02-26', 'INSS', 'Centro', 'TUTÓIA'),
(134, 871676, 3402, 0, '7', '2024-02-26', 'INSS', 'Centro', 'TUTÓIA'),
(135, 858959, 3402, 0, '7', '2024-02-26', 'INSS', 'Centro', 'TUTÓIA'),
(136, 417207, 2504, 0, '10', '2024-02-11', 'Ilha Barreiras ', '', 'Araioses '),
(137, 870672, 3402, 0, '7', '2024-02-26', 'INSS', 'Centro', 'TUTÓIA'),
(138, 822666, 2504, 0, '10', '2024-02-11', 'Ilha Barreiras ', '', 'Araioses '),
(139, 870672, 3502, 0, '7', '2024-02-26', 'BANCO BRASIL', 'Centro', 'TUTÓIA'),
(140, 869120, 2504, 0, '10', '2024-02-11', 'Ilha Barreiras ', '', 'Araioses '),
(141, 871676, 3502, 0, '7', '2024-02-26', 'BANCO BRASIL', 'Centro', 'TUTÓIA'),
(142, 858959, 3502, 0, '7', '2024-02-26', 'BANCO BRASIL', 'Centro', 'TUTÓIA'),
(143, 822665, 3502, 0, '7', '2024-02-26', 'BANCO BRASIL', 'Centro', 'TUTÓIA'),
(144, 822665, 3702, 0, '7', '2024-02-26', 'RUA DR PAULO RAMOS', 'Centro', 'TUTÓIA'),
(145, 858959, 3702, 0, '7', '2024-02-26', 'RUA DR PAULO RAMOS', 'Centro', 'TUTÓIA'),
(146, 871676, 3702, 0, '7', '2024-02-26', 'RUA DR PAULO RAMOS', 'Centro', 'TUTÓIA'),
(147, 870672, 3702, 0, '7', '2024-02-26', 'RUA DR PAULO RAMOS', 'Centro', 'TUTÓIA'),
(148, 870672, 3802, 0, '7', '2024-02-28', 'MA 034', 'BOM GOSTO', 'TUTÓIA'),
(149, 871676, 3802, 0, '7', '2024-02-28', 'MA 034', 'BOM GOSTO', 'TUTÓIA'),
(150, 858959, 3802, 0, '7', '2024-02-28', 'MA 034', 'BOM GOSTO', 'TUTÓIA'),
(151, 822665, 3802, 0, '7', '2024-02-28', 'MA 034', 'BOM GOSTO', 'TUTÓIA'),
(152, 822665, 3102, 0, '7', '2024-02-17', 'rua principal, sn ', 'BELAGUA', 'TUTÓIA'),
(153, 871867, 2604, 0, '10', '2024-02-13', 'Praça Viva', '', 'Araioses '),
(154, 869722, 2604, 0, '10', '2024-02-13', 'Praça Viva', '', 'Araioses '),
(155, 417207, 2604, 0, '10', '2024-02-13', 'Praça Viva', '', 'Araioses '),
(156, 846221, 2604, 0, '10', '2024-02-13', 'Praça Viva', '', 'Araioses '),
(157, 822660, 2604, 0, '10', '2024-02-13', 'Praça Viva', '', 'Araioses '),
(158, 822666, 2604, 0, '10', '2024-02-13', 'Praça Viva', '', 'Araioses '),
(159, 870672, 3902, 0, '7', '2024-02-28', 'MA 034', 'ALTO ALEGRE', 'TUTÓIA'),
(160, 871676, 3902, 0, '7', '2024-02-28', 'MA 034', 'ALTO ALEGRE', 'TUTÓIA'),
(161, 858959, 3902, 0, '7', '2024-02-28', 'MA 034', 'ALTO ALEGRE', 'TUTÓIA'),
(162, 822665, 3902, 0, '7', '2024-02-28', 'MA 034', 'ALTO ALEGRE', 'TUTÓIA'),
(163, 822665, 4002, 0, '6', '2024-02-28', 'JOSE PAULINO', 'BARRA', 'TUTÓIA'),
(164, 858959, 4002, 0, '6', '2024-02-28', 'JOSE PAULINO', 'BARRA', 'TUTÓIA'),
(165, 871676, 4002, 0, '6', '2024-02-28', 'JOSE PAULINO', 'BARRA', 'TUTÓIA'),
(166, 870672, 4002, 0, '6', '2024-02-28', 'JOSE PAULINO', 'BARRA', 'TUTÓIA'),
(167, 870672, 4102, 0, '10', '2024-02-29', 'CAPITÃO DEMETRIO', 'BARRA', 'TUTÓIA'),
(168, 871676, 4102, 0, '10', '2024-02-29', 'CAPITÃO DEMETRIO', 'BARRA', 'TUTÓIA'),
(169, 858959, 4102, 0, '10', '2024-02-29', 'CAPITÃO DEMETRIO', 'BARRA', 'TUTÓIA'),
(170, 822665, 4102, 0, '10', '2024-02-29', 'CAPITÃO DEMETRIO', 'BARRA', 'TUTÓIA'),
(171, 849228, 4302, 0, '7', '2024-03-11', '', 'porto de areia', 'TUTÓIA'),
(172, 871676, 4302, 0, '7', '2024-03-11', '', 'porto de areia', 'TUTÓIA'),
(173, 870672, 4302, 0, '7', '2024-03-11', '', 'porto de areia', 'TUTÓIA'),
(174, 822661, 4502, 0, '10', '2024-03-13', '', 'BARRO DURO', 'TUTÓIA'),
(175, 869139, 4502, 0, '10', '2024-03-13', '', 'BARRO DURO', 'TUTÓIA'),
(176, 870858, 4502, 0, '10', '2024-03-13', '', 'BARRO DURO', 'TUTÓIA'),
(177, 846221, 3004, 0, '10', '2024-03-06', 'Rua Benjamin Constant ', '', 'Araioses '),
(178, 822666, 3004, 0, '10', '2024-03-06', 'Rua Benjamin Constant ', '', 'Araioses '),
(179, 869120, 3004, 0, '10', '2024-03-06', 'Rua Benjamin Constant ', '', 'Araioses '),
(180, 846221, 3204, 0, '10', '2024-03-07', 'Rua do mercado velho', '', 'Araioses '),
(181, 822666, 3204, 0, '10', '2024-03-07', 'Rua do mercado velho', '', 'Araioses '),
(182, 869120, 3204, 0, '10', '2024-03-07', 'Rua do mercado velho', '', 'Araioses '),
(183, 822660, 3404, 0, '10', '2024-03-10', 'Praça Raimundo Nonato ', '', 'Araioses '),
(184, 822845, 3404, 0, '10', '2024-03-10', 'Praça Raimundo Nonato ', '', 'Araioses '),
(185, 870365, 3404, 0, '10', '2024-03-10', 'Praça Raimundo Nonato ', '', 'Araioses '),
(186, 846221, 3404, 0, '10', '2024-03-10', 'Praça Raimundo Nonato ', '', 'Araioses '),
(187, 869269, 4802, 0, '7', '2024-03-18', '', 'BOM GOSTO', 'TUTÓIA'),
(188, 869818, 4802, 0, '7', '2024-03-18', '', 'BOM GOSTO', 'TUTÓIA'),
(189, 869974, 4802, 0, '7', '2024-03-18', '', 'BOM GOSTO', 'TUTÓIA'),
(190, 870494, 4802, 0, '7', '2024-03-18', '', 'BOM GOSTO', 'TUTÓIA'),
(191, 417207, 3604, 0, '10', '2024-03-15', 'Travessa Dr Paulo Ramos', '', 'Araioses '),
(192, 822666, 3604, 0, '10', '2024-03-15', 'Travessa Dr Paulo Ramos', '', 'Araioses '),
(193, 869120, 3604, 0, '10', '2024-03-15', 'Travessa Dr Paulo Ramos', '', 'Araioses '),
(194, 846221, 3704, 0, '1', '2024-03-16', 'Colégio Gonçalves Dias', 'Bairro Conceição ', 'Araioses '),
(195, 849655, 3704, 0, '1', '2024-03-16', 'Colégio Gonçalves Dias', 'Conceição ', 'Araioses '),
(196, 871867, 3704, 0, '1', '2024-03-16', 'Colégio Gonçalves Dias', 'Conceição ', 'Araioses '),
(197, 846099, 4004, 0, '2', '2024-03-22', 'Porto da Caeira ', 'Povoado Carnaubeiras ', 'Araioses '),
(198, 870505, 4004, 0, '2', '2024-03-22', 'Porto da Caeira ', 'Povoado Carnaubeiras ', 'Araioses '),
(199, 869120, 4004, 0, '2', '2024-03-22', 'Porto da Caeira ', 'Povoado Carnaubeiras ', 'Araioses '),
(200, 849228, 5102, 0, '6', '2024-03-21', 'GUAJIRU', 'BARRA', 'TUTÓIA'),
(201, 871676, 5102, 0, '6', '2024-03-21', 'GUAJIRU', 'BARRA', 'TUTÓIA'),
(202, 858959, 5102, 0, '6', '2024-03-21', 'GUAJIRU', 'BARRA', 'TUTÓIA'),
(203, 858959, 5202, 0, '6', '2024-03-22', 'ZONA RURAL', 'CAJAZEIRAS ', 'TUTÓIA'),
(204, 871676, 5202, 0, '6', '2024-03-22', 'ZONA RURAL', 'CAJAZEIRAS ', 'TUTÓIA'),
(205, 849228, 5202, 0, '6', '2024-03-22', 'ZONA RURAL', 'CAJAZEIRAS ', 'TUTÓIA'),
(206, 870672, 5202, 0, '6', '2024-03-22', 'ZONA RURAL', 'CAJAZEIRAS ', 'TUTÓIA'),
(207, 870672, 5302, 0, '7', '2024-03-23', 'MA 034', 'PAXICÁ', 'TUTÓIA'),
(208, 870858, 5302, 0, '7', '2024-03-23', 'MA 034', 'PAXICÁ', 'TUTÓIA'),
(209, 871676, 5302, 0, '7', '2024-03-23', 'MA 034', 'PAXICÁ', 'TUTÓIA'),
(210, 417207, 4104, 0, '10', '2024-03-30', 'Beira Rio', 'Centro ', 'Araioses '),
(211, 869120, 4104, 0, '10', '2024-03-30', 'Beira Rio', 'Centro ', 'Araioses '),
(212, 869722, 4104, 0, '10', '2024-03-30', 'Beira Rio', 'Centro ', 'Araioses '),
(213, 822664, 4204, 0, '10', '2024-04-05', 'Rua Santa Bárbara ', 'João Peres', 'Araioses '),
(214, 850008, 4204, 0, '10', '2024-04-05', 'Rua Santa Bárbara ', 'João Peres', 'Araioses '),
(215, 870505, 4204, 0, '10', '2024-04-05', 'Rua Santa Bárbara ', 'João Peres ', 'Araioses ');

-- --------------------------------------------------------

--
-- Estrutura para tabela `registrosbo`
--

CREATE TABLE `registrosbo` (
  `id_miker` int(255) NOT NULL,
  `mtr1` int(10) DEFAULT NULL,
  `mtr2` int(10) DEFAULT NULL,
  `mtr3` int(10) DEFAULT NULL,
  `mtr4` int(10) DEFAULT NULL,
  `mtr5` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(10) NOT NULL,
  `nome_completo` varchar(40) NOT NULL,
  `nome_de_guerra` varchar(15) NOT NULL,
  `posto_usuario` varchar(20) DEFAULT NULL,
  `classe_usuario` varchar(8) DEFAULT NULL,
  `funcao_usuario` varchar(30) DEFAULT NULL,
  `telefone_usuario` bigint(15) DEFAULT NULL,
  `senha_usuario` varchar(255) NOT NULL,
  `cia` int(3) NOT NULL,
  `situacao` enum('HABILITADO','DESABILITADO') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome_completo`, `nome_de_guerra`, `posto_usuario`, `classe_usuario`, `funcao_usuario`, `telefone_usuario`, `senha_usuario`, `cia`, `situacao`) VALUES
(410787, 'MARIVALDO PEREIRA LEONARDO FILHO', 'MARIVALDO', '2', NULL, NULL, 0, '$2y$10$xla8sJ1gcBq7b1BO.LM0GOryCD/UkhXESK.jRALrkADVXt7uYnydu', 2, 'DESABILITADO'),
(411544, 'ROBERT PEREIRA DOS SANTOS', 'ROBERT', 'cap', 'oficial', NULL, 0, '$2y$10$MbSJYNuJI5WdM5Sf1O/j3.1J7jkwzQHYZ1IyyUZlOFrRWK2aw6Dgq', 2, 'HABILITADO'),
(414651, 'MARCONE PEREIRA DIAS', 'MARCONE', '1', NULL, NULL, 0, '$2y$10$1FsFgqzZ9SrnTCcHUeyB1OIPLXy0sYbFgu2yXKcgLmCY.GQ9hMzfW', 2, 'DESABILITADO'),
(414657, 'FRANCISCO BARROS BEZERRA FILHO', 'BARROS', '3', NULL, NULL, 0, '$2y$10$pcuwJX3war3l.7vHtwPR3.XyjpdN4GfN0DqjQXt/0sHqZHMe1KeDu', 3, 'DESABILITADO'),
(414672, 'DANIEL ARAUJO SILVA', 'DANIEL', '2', NULL, NULL, 0, '$2y$10$TxdYztPVqiWLPHaLdgiKyeRZp/27IlITTDbuUp/3kgVC8DP11mqw6', 4, 'DESABILITADO'),
(414680, 'VILSOMAR PEREIRA DOS RAMOS', 'RAMOS', '2', NULL, NULL, 0, '$2y$10$ZVXq/hg.ItRyEzOtLQ6WFeT2oKNQZgYlN437ixbHLsleUxFBU5hAW', 2, 'DESABILITADO'),
(414706, 'EVERALDO SANTOS DE CARVALHO', 'EVERALDO', '2', NULL, NULL, 0, '$2y$10$Quh7ZpSMtJBTUvFrLDmv7eermdhYuI78YbmxsC7wNbwHJqFvLjbC2', 4, 'DESABILITADO'),
(414707, 'FRANCISCO DEAN SILVA SOARES', 'DEAN', '1', NULL, NULL, 0, '$2y$10$s785UNuTDskDz3XCL/hVTONxVXMZOnJWtILoO6Gys6XBkxz8ygFTC', 4, 'DESABILITADO'),
(414805, 'JORGE FEITOSA MACIEL', 'MACIEL', '3', NULL, NULL, 0, '$2y$10$s9T/oyNFx6kbYVYfrkOKouETYr25.Ttr0ffYTb2QtKJ5a86B4Pyem', 2, 'DESABILITADO'),
(415311, 'CARLOS IVAN MACHADO SILVA', 'IVAN', '1', NULL, NULL, 0, '$2y$10$PP5DURnbbkDRXxueZeAtdueRWGsB.6zSYKW1eEPCcg/Tb4PdS3thu', 3, 'DESABILITADO'),
(415398, 'JARBAS DOS SANTOS MARQUES', 'MARQUES', '0', NULL, NULL, 0, '$2y$10$WwdyQaSEc.C1Mg79dIH3b.sBIYiII9Fla.Rdlf2KjKXm.JfMQPOpK', 1, 'HABILITADO'),
(415933, 'SEBARTIÃO EXPEDITO DE JESUS OLIVEIRA', 'OLIVEIRA', '3', NULL, NULL, 0, '$2y$10$THWMH5fCJ8rboj8tC/caKeYGl2b0S.biGb0eH3xR6ngJwkTzwcgO.', 2, 'DESABILITADO'),
(415976, 'DARLAN CARLOS FRANÇA DOS SANTOS', 'DARLAN', '3', NULL, NULL, 0, '$2y$10$KB9Hnt51rr2Zt.GryRhCy.US6Niv785jXlrOzwXEBCEw0A27Orax.', 1, 'DESABILITADO'),
(416171, 'ÉRICO FERNANDO MEDEIROS DA SILVA', 'ÉRICO', '3', NULL, NULL, 0, '$2y$10$a4yetAxqYZQ1fmkBezjTjex4gS3HnRL5Z7LhdUz3idgEByYvIsYUy', 3, 'DESABILITADO'),
(416277, 'LEONARDO RAMOS SOUTO MAIOR', 'SOUTO MAIOR', '3', NULL, NULL, 0, '$2y$10$P5u56cZVh/WnLoGhhnH0rO5c9dIX5UR9.mcWF19ft78Awfr1wLmBW', 1, 'DESABILITADO'),
(416440, 'CONRADO ELERES LOPES', 'CONRADO', '3', NULL, NULL, 0, '$2y$10$XhiEq8M/waILmeTivFzjdOGi8hNGSQ5OLgY9LEiXzrT2Ihvvs2EEe', 3, 'DESABILITADO'),
(416697, 'ÁTILA HAWDNES MATOS COSTA', 'ÁTILA HAWDNES', '3', NULL, NULL, 0, '$2y$10$DFMBg5UQQgcCSFTUa74yTefRXHo6vP7X4K/RryLtFYJUy80R4P7Qa', 1, 'DESABILITADO'),
(417207, 'FRANCISCO HERBERT SOUSA RAMOS', 'HERBERT', '3', NULL, NULL, 0, '$2y$10$A/G5DY.XlCqC834Jn.2XyOxrqabuXu2fCwPcU3ojATR/L90/8ggUm', 4, 'DESABILITADO'),
(417421, 'MANOEL MACHADO COELHO NETO', 'NETO', '3', NULL, NULL, 0, '$2y$10$7eSoH9BmCgcxj.iqQLUq1OgX6eUhRRUbRAcTeDCMChXIC8bZqf9nq', 1, 'DESABILITADO'),
(417426, 'MAX SAMUEL RAMALHO GONÇALVES', 'SAMUEL', '3', NULL, NULL, 0, '$2y$10$zvZQbXK3DbAPh/.gQF74w.KTenFkvjdQt5MLh0AdYUcm1SrSIQnn6', 2, 'DESABILITADO'),
(417439, 'PAULO EDUARDO PEREIRA', 'PEREIRA', 'CAPITÃO', 'OFICIAL', NULL, 98981797420, '$2y$10$HrcS93SajbeqhzOE0TE5a.xYLwRvEwvKHl/fCRAYVkYKqNyFmsWJO', 3, 'HABILITADO'),
(417589, 'FERNANDO NELSON MARREIROS ATAIDE', 'ATAIDE', '3', NULL, NULL, 0, '$2y$10$WbIaRF1RT4hr1B/l328mn.BVa.1Uvpp7znJ39tI21T.Dr0bWINRS6', 1, 'HABILITADO'),
(417591, 'GENIVALDO ABREU DIAS JUNIOR', 'GENIVALDO', '0', NULL, NULL, 0, '$2y$10$jUWaCi2JQKaHVgBj0FL0oevlLBaMCUBnyPe.TQSYeU4iDm3RGz15u', 3, 'DESABILITADO'),
(417602, 'MOISÉS PRAZERES DOS SANTOS', 'P. SANTOS', '0', NULL, NULL, 0, '$2y$10$tEUPx7xcLX0muIQMgB7hiu9.IQK/9R6whk/ySiQca9QZOxDsEfR7a', 1, 'DESABILITADO'),
(417793, 'FABRICIO SILVA DUARTE', 'F. SILVA', '3', NULL, NULL, 0, '$2y$10$fe5gXjs3tiUxPCyynnY9H.ygZ/XRI5drdyUW4XOUvFxdDrSD2wT0G', 4, 'DESABILITADO'),
(417962, 'WALLACE MAYKEL CORREA SILVA', 'SILVA', '0', NULL, NULL, 0, '$2y$10$NH1vWplhupHP8AI6JM5F3.3qUYvwPGiRmeZUKajRxFkIgJpVU0VGi', 4, 'DESABILITADO'),
(803919, 'MARCELO DA SILVA PEREIRA', 'PEREIRA', '0', NULL, NULL, 0, '$2y$10$nRTlB6w0nTxA8o5CTDG6IOhsKbKwgZ8Ox35jdJMs7VP/1PhY5q4eC', 3, 'DESABILITADO'),
(804067, 'DIEGO BEZERRA DOS SANTOS LIMA', 'DIEGO', '3', NULL, NULL, 0, '$2y$10$GowJf/ofSbsGMy88Gga8BODCb6Jq8VXoh2wpMEYA/pMxQ/XhBPoq2', 1, 'DESABILITADO'),
(804126, 'PAULO MOREIRA SANTOS AMARAL', 'MOREIRA', '3', NULL, NULL, 0, '$2y$10$OKaYDaME4PVacfwOLivmGertiHVXiun3BkX8akXY.wqYqiDPzQvUO', 3, 'DESABILITADO'),
(806410, 'ALBATÊNIO DE BRITO RAMOS', 'ALBATÊNIO', 'cap', 'oficial', NULL, 0, '$2y$10$JCzqESSSQ2ttg8Nir8ms1.pOVu0KOJ/kZ4BJ3bl0tEyyPvY88Isji', 1, 'HABILITADO'),
(814471, 'LENILSON ADRIANO MARINHO NERIS', 'NERIS', '0', 'oficial', NULL, 0, '$2y$10$XCrhQdkhlMmbbczaeVxEyeUD/I2T7HT5NJGTgRmHvjEa9.UhV9FfC', 1, 'HABILITADO'),
(821406, 'ANTONIO FILHO SOUSA MORAES', 'ANTONIO FILHO', '3', NULL, NULL, 0, '$2y$10$5L6Kq.jCl3adNHl/033NceAhg/y6x3uQhfZef.uTIJ2r7HBT773Qu', 1, 'HABILITADO'),
(821478, 'PEDRO HENRIQUE MORAES ATAIDE', 'PEDRO HENRIQUE', '0', NULL, NULL, 0, '$2y$10$CaB53HMBJd/Gz0PUts6RoeZ2AxfyNWBB/I7n.6SLcHeh5NnR9mYBK', 1, 'HABILITADO'),
(821523, 'FARNHAIT MAALLALEL DA SILVA AGUIAR', 'FARNHAIT', '0', NULL, NULL, 0, '$2y$10$hFZQq1G.pOQjrJKTOuUHIeakRMbzezDVRdYRa5Qhv4OIsaftipTIi', 2, 'DESABILITADO'),
(821754, 'FRANCISCO MARCIO DE CARVALHO', 'MARCIO', '0', NULL, NULL, 0, '$2y$10$AHlZ1IBxeZG5YVhShPWy3OSXTsyaLcav/o21/grGVwGPgxYTb/lR2', 3, 'DESABILITADO'),
(821903, 'LUCAS VIEIRA CASTELO BRANCO', 'CASTELO BRANCO', '0', NULL, NULL, 0, '$2y$10$lI.Ttzvffq3kZod/J4tr/.THFpvYSwbhP1nGHuhhC/YNSMt/2vKxK', 1, 'DESABILITADO'),
(821904, 'ADRIANO NOLETO LIRA DIAS', 'NOLETO', '3º sgt', 'praça', NULL, 0, '$2y$10$ZhNfjsDSvguMBsEanej3k.A5IHmTCa96wF/jKmg6Gt76FpPKkwH8u', 1, 'DESABILITADO'),
(822026, 'RAFAEL SILVA FERREIRA', 'SILVA FERREIRA', '0', NULL, NULL, 0, '$2y$10$U0yL9JcW5L0sfV321o8KwOuOBRImoiJ2W4Z6Hrn4wCW7jJUaAseJC', 3, 'DESABILITADO'),
(822127, 'WELTON AMARAL CORREA', 'WELTON', '0', NULL, NULL, 0, '$2y$10$JwBJ4/28lHMAZFLCrHw.aeMjKEDUFSTLF3o5oFlwwJCKhEP4UeCvW', 3, 'DESABILITADO'),
(822174, 'DANILO JOSÉ SALAZAR SERRA', 'SERRA', '1º ten', 'oficial', NULL, 0, '$2y$10$O1wnJ/PSmh6HcRCyfeVgd.LqsFsQ0sJru.nQV3HRS90dJLb6Dqp0K', 1, 'HABILITADO'),
(822175, 'ALEX FEITOSA SILVA JUNIOR', 'FEITOSA', '1º ten', 'oficial', NULL, 0, '$2y$10$8vLw8xjeB5gQZrsGqX1/gOf/GqE9lUAURHvBX1PC/2iHaLFaW4JPi', 1, 'HABILITADO'),
(822286, 'JOÃO GABRIEL TEIXEIRA PAZ', 'PAZ', '0', NULL, NULL, 0, '$2y$10$bXQNAcu58j/WGLuenj8Nv.wX4c9JQebzWuIeYOH4YJEPGtkqgEIh6', 1, 'DESABILITADO'),
(822495, 'FABRICIO DA LUZ ARAÚJO', 'F. ARAÚJO', '0', NULL, NULL, 0, '$2y$10$bY1lNteh/..glvoPGLUm1Ow.29iJU27qp41UTv34vrL/9h8oqwmn6', 3, 'DESABILITADO'),
(822660, 'JOSÉ DEODATO PEIXINHO NETO', 'NETO', '0', NULL, NULL, 0, '$2y$10$kne2r1zDzXfZ6IiDZPUJse266WOTUU0lcnsfp/D5qGhbE20tnzcjS', 4, 'DESABILITADO'),
(822661, 'MARCELO DO NASCIMENTO ALBUQUERQUE', 'ALBUQUERQUE', '0', NULL, NULL, 0, '$2y$10$Z5rn7KQuqpf7zJ/Qlk5lOev0cuNu1.gZMUtJME.bNt4aGB861UHru', 2, 'DESABILITADO'),
(822662, 'ADRIANO SILVA DE SOUSA', 'ADRIANO SOUSA', '0', NULL, NULL, 0, '$2y$10$.NefNMJkQrS/5U6UWT1EreHt731I3.HfSDU/uvBhq54Y7stWq8AI2', 1, 'DESABILITADO'),
(822663, 'RAFAEL GUILHERME LOPES PEREIRA', 'LOPES', '0', NULL, NULL, 0, '$2y$10$S1WV5GfWlI6NULpOTpiT8ei5cXJRhUfE84Wy8DonRHGiD8OK.D5Zu', 4, 'DESABILITADO'),
(822664, 'JOSÉ MARCY SANTOS SILVA', 'J. SANTOS', '0', NULL, NULL, 0, '$2y$10$vUP3GYneDgyASDnkyBJmQehkT5uWT8ufqKUlDsnWw8OExbEqpi3Ci', 4, 'DESABILITADO'),
(822665, 'BRUNO OLIVEIRA SANTOS', 'BRUNO', '0', NULL, NULL, 0, '$2y$10$GKaeefCfqM4.INDfg9UuteWQsj4iGwFNdnfua1u0rWg9mGq9i5Uqa', 2, 'DESABILITADO'),
(822666, 'RODRIGO CARDOSO DOS SANTOS', 'R. CARDOSO', '0', NULL, NULL, 0, '$2y$10$TGdG6swfToBNp8WYQaR2UuhxhwZE/RxRI6SfHPq0PFealW1p/iFve', 4, 'DESABILITADO'),
(822845, 'DAVYLA PAMELA MARQUES GINO', 'PAMELA', '0', '', NULL, 0, '$2y$10$RkjHNBWjQ6czFqMD7O4.5.y9yVrXR3ZYkKRN21ZLFH9Ak/3Kf3FnW', 2, 'DESABILITADO'),
(822892, 'ANTONIO DA SILVA BRITO', 'BRITO', '0', NULL, NULL, 0, '$2y$10$iJ0V12exMq1kElfYfor8mODfwn1V1fbsRjNcxMwDSDWBozcrQo/fG', 3, 'DESABILITADO'),
(825423, 'RAFAEL DA SILVA RAYOL', 'RAYOL', '0', NULL, NULL, 0, '$2y$10$Ps/RPLTZMdlMl4sFLQp4EeLvyDCzyCcebSL/KPw9ESwH.2pv/MrIm', 3, 'DESABILITADO'),
(826880, 'BENJAMIN LISBOA AMORIM', 'LISBOA', '0', NULL, NULL, 0, '$2y$10$n7GMyEnDmF7EwxppV3LdJukbD1rw5FoniIHLfEFzAVHMGklmKYttW', 1, 'DESABILITADO'),
(827066, 'THIAGO MARTINS MARQUES', 'MARQUES', '0', NULL, NULL, 0, '$2y$10$ws41gFx0sc5n9SEfva15BOEtarYlsGebuuifPN4eJesb8sFubewwK', 1, 'DESABILITADO'),
(834360, 'MARCOS ADRIANO PORTUGAL SAMENEZES', 'PORTUGAL', '0', NULL, NULL, 0, '$2y$10$ZkgxmfalgzPv92ggf121cOHGmUnh8x2GcKfziJ7VmTy7kL2b65E92', 3, 'DESABILITADO'),
(842170, 'John Silva Sousa', 'Sousa', 'Soldado', NULL, NULL, 98985324521, '$2y$10$NzO90HSYFfdtvZL4xIltP.cFDNrkllONpV.DPvKikmxFwp58jpVIS', 2, 'DESABILITADO'),
(846025, 'fabio viana assis galeno', 'galeno', 'Soldado', 'oficial', 'Cmd de Cia', 98986249653, '$2y$10$sBqcFUp4z0dT6uR2BzbDqOZft1WUBjVJmuUehnZsS0WVmiYiseuMa', 1, 'HABILITADO'),
(846084, 'RODRIGO LOIOLA DE MENESES', 'LOIOLA', '0', NULL, NULL, 0, '$2y$10$iyU.Ilnx5zPFxH4XVDsdhuFiqz/NtbOMUXyfNyobyOmjQW3m84oTS', 2, 'DESABILITADO'),
(846099, 'ARIEL DA SILVA COSTA', 'DA SILVA', '0', NULL, NULL, 0, '$2y$10$sfX9TccocsJyuziELLgqxOvOqD.YgtgTUTeqenE00oEm4U1YqWHZu', 4, 'DESABILITADO'),
(846221, 'MARCIO MYCHAEL SANTOS DA SILVA', 'MYCHAEL', '0', NULL, NULL, 0, '$2y$10$XGei03j/Aupvw4/hx6GAzul0T64KhCENMB5Uiv5SkZXvXPH21usMe', 4, 'DESABILITADO'),
(846264, 'MONIQUE CANTANHEDE MARTINS', 'MONIQUE', '0', NULL, NULL, 0, '$2y$10$JscAWFE0MNqnajmnojAB8ebMKo0lXMVuzXt.EZtvX2vkmKVtxZjC6', 1, 'HABILITADO'),
(849221, 'EDINES PEREIRA DOS SANTOS JÚNIOR', 'EDINES', '0', NULL, NULL, 0, '$2y$10$HZtPHlVEnjCQiHyep8gw3uFQojpfnPmwPwivSRDB07m3QMmsZGwde', 3, 'DESABILITADO'),
(849228, 'ISAIAS COSTA DA SILVA', 'ISAIAS', '0', NULL, NULL, 0, '$2y$10$4ve/uPU7IqhCFfFYw298SO.2OCE5q5.3IpO0Znh5S6gn8bXzzDtwW', 2, 'HABILITADO'),
(849292, 'JOSE ROMUALDO FERNANDES DE SOUSA', 'J. FERNANDES', '0', NULL, NULL, 0, '$2y$10$y0upeAnKpd8i33wQUIy/b.xA7bGRBsQCV8aF8xnD3DIKxo8ZbcE96', 1, 'DESABILITADO'),
(849360, 'KASSIO LIRA DIAS', 'KASSIO', '0', NULL, NULL, 0, '$2y$10$.K3IdOIhlviPUZ10YFbqs.SymCQcLXFr/y55Yhlg2RWEDcjrWXuNm', 1, 'DESABILITADO'),
(849655, 'NEMUEL AMARAL COSTA', 'NEMUEL', '0', NULL, NULL, 0, '$2y$10$8ut2GvYBbtMVCYMKizngaOel3CejFuDLtwsaJ0wiuoEBq5ibeVCHa', 4, 'DESABILITADO'),
(849659, 'SAVIO SILVA COSTA', 'SAVIO', '0', NULL, NULL, 0, '$2y$10$HhZZ18F2oPzN1eM06.mb2eXLWqxVyIijosF3t4Ih3JV3wFpQ811Ia', 1, 'DESABILITADO'),
(849671, 'CAMILO VIEIRA MACHADO', 'MACHADO', '0', NULL, NULL, 0, '$2y$10$f4mWHs6AJyL0kIGOkBCoheKbaVfIUcwCHtWY8dH9Ak.oWO8Lb3dHa', 2, 'DESABILITADO'),
(849714, 'RONALDO JOSÉ DE MORAIS DOMINGUES', 'MORAIS', '0', NULL, NULL, 0, '$2y$10$.2m2kxFNlxJDnZCcm2k/C.BuydoTi3nEkN6pMck1TBjnXvsNwQm3G', 4, 'DESABILITADO'),
(849812, 'LUCAS FELIPPI DA SILVA MAIA', 'MAIA', '0', NULL, NULL, 0, '$2y$10$JLFooW20r5IJyZzYR7PV1egWZb7jap2wt.ikvLTti4oWCz80fYhOO', 1, 'DESABILITADO'),
(849815, 'MAYARA SILVA OLIVEIRA', 'MAYARA', '1º ten', 'oficial', NULL, 0, '$2y$10$aN4IEAuJCsThg47TMuQfEOzhVMzbJ71sz9G38RmEGjBU.vrSuNcuu', 1, 'HABILITADO'),
(850008, 'UBIRATAN PINHEIRO MENDES JUNIOR', 'MENDES JUNIOR', '0', NULL, NULL, 0, '$2y$10$3ukNolfVFRAt/Vt4S2zkc.YOZDCVMifpdhGymFxDXweICT6IVimeS', 4, 'DESABILITADO'),
(850150, 'TIAGO MESQUITA DA CUNHA', 'MESQUITA', '0', NULL, NULL, 0, '$2y$10$Rv8.tbv.zDjVX/R3ViOeO.keZ.DhBiNgtyXVUNN32DgASxwyeYDya', 4, 'DESABILITADO'),
(851446, 'PAULO VINICIUS FARIAS PIRES', 'PAULO VINICIUS', '0', NULL, NULL, 0, '$2y$10$MsGMN4jwW4thYotVhDzSmu4cpSwRK3XgZGjoiG2rhe3YvUHw2uLFS', 3, 'DESABILITADO'),
(857166, 'THIAGO COSTA GARCÊS', 'GARCÊS', '0', NULL, NULL, 0, '$2y$10$vWj3NTPTO881I7hoeZlp0uZA5wubehTAlLWFgsLO/RoFL4KCWK5WK', 1, 'DESABILITADO'),
(857243, 'ALISSON FERNANDO OLIVEIRA RIBEIRO', 'FERNANDO', '0', NULL, NULL, 0, '$2y$10$GrjVSTGtm6sZwiJsHS816eAt1AJUWA29FMwxYK3VNx3L5kx3A/Etm', 1, 'DESABILITADO'),
(857273, 'FILIPE DE SOUSA SENA', 'SENA', '0', NULL, NULL, 0, '$2y$10$cg/guVc41lO7.Nm2lhgKC.v/mjlxMRUjINCVfgdl5Gw5LarSbs6r.', 2, 'DESABILITADO'),
(857283, 'WELLINGTON LISBOA DOS SANTOS', 'W. LISBOA', '0', NULL, NULL, 0, '$2y$10$E3jYyNHo8S3daLmcEkgjsuoqqM.O6/R1vR8FDEZ8nWcBkTwESFoIW', 1, 'DESABILITADO'),
(857318, 'DAMIRES DE OLIVEIRA SANTOS MENDES', 'DAMIRES', '0', NULL, NULL, 0, '$2y$10$AKjIdPF7Z/15oZ8bGhO.M.cTwKBOZvC2DhHLPdRuAcQzIvy7XCgSy', 1, 'DESABILITADO'),
(857498, 'HANNA RAYANE RIBEIRO DA SILVA', 'HANNA', '0', NULL, NULL, 0, '$2y$10$MrJ2.UBpuxTkk7UnJc8Hlup8jcxDraShIoFR09/sETCwS6JFW1UXS', 2, 'DESABILITADO'),
(858718, 'MARCOS ANTÔNIO FIDELES DIAS SOUSA', 'FIDELES', '0', NULL, NULL, 0, '$2y$10$TBmSUpuzKDqlKOIcpwd8X.QdoCs/ai.33JcUbKDTLgNgKGmLlx0Te', 1, 'DESABILITADO'),
(858959, 'NICHOLAS MELO DE ALMEIDA', 'MELO', '0', NULL, NULL, 0, '$2y$10$eZsS.GAS.P/QIjwApNBhI.78h6KFuTulUEP7zQSEoBiFxPoQzWama', 2, 'DESABILITADO'),
(859185, 'DARLAN CHRISTIAN PESAVENTO', 'PESAVENTO', '0', NULL, NULL, 0, '$2y$10$qOCaNjVsnZb4oPm/QpIFhOgne2jC9UTelgkrqMXbFLYP2/os3ee0W', 4, 'DESABILITADO'),
(859187, 'DOUGLAS RAMOS DA SILVA', 'RAMOS', '0', NULL, NULL, 0, '$2y$10$NjOrRVGux9LfmkKcqyw4IuKn/gMuVULfmYyV9pcNJ7tTaspw7TCtS', 1, 'DESABILITADO'),
(865107, 'DIMAS GOMES DO CARMO NETO', 'DIMAS', '1º ten', 'oficial', NULL, 0, '$2y$10$ZedPw88gEOKKICyuwAlAj.Yai9I1W0Fu/OxR.53AB9fnc2zbWnnQe', 1, 'HABILITADO'),
(868946, 'PEDRO CARVALHO VERAS', 'P. VERAS', '0', NULL, NULL, 0, '$2y$10$C4otFXMpQzUtkZQjE/UGMO6Cur2UImNfxGGi6J/n1gJCmw8XKqJnK', 4, 'HABILITADO'),
(869120, 'SAMARA RICARTE TEIXEIRA', 'SAMARA', '0', NULL, NULL, 0, '$2y$10$xzYTb07PixBHvALefLA7Bu2d4Z8w5/4c9lBnPc1kJp7ekAYPI90ay', 4, 'HABILITADO'),
(869130, 'TALYSON RODRIGO GOMES ESTRELA', 'T. GOMES', '0', NULL, NULL, 0, '$2y$10$gXP.GIAXynMFPkfADIFYO.eNGeam4URABb6uibqd8wuGnZmnRZ1C6', 1, 'DESABILITADO'),
(869134, 'THALES GIOVANNI SILVA MEDEIROS', 'GIOVANNI', '0', NULL, NULL, 0, '$2y$10$kbawPVfIlmgfP4jmFfPWHunz66xx3G073Hanpm37dQASQQMyptUgi', 4, 'DESABILITADO'),
(869139, 'ANTONIO LUIZ ALENCAR MOURA', 'ALENCAR', '0', NULL, NULL, 0, '$2y$10$wqMUcjaxjLXgsEBtV13s0OMx1l/I/XR8YFmNT9OEBJzXhziTVCv56', 2, 'DESABILITADO'),
(869142, 'DANIEL MELO LIMA', 'DANIEL', '0', NULL, NULL, 0, '$2y$10$7u1r6/D7w6X4HQJIoWTrWO.KtJ9JWOkKw1M.DvEmmQL8XfLGV1HvG', 1, 'DESABILITADO'),
(869180, 'LEIANNY DANIELLY DA SILVA REIS', 'LEIANNY', '0', NULL, NULL, 0, '$2y$10$GZD6T.Ttkkh8ZaboZg9Y7.HavQ158BavDrKuhe0tk6JsUS3rrA9SG', 1, 'DESABILITADO'),
(869269, 'JOSE DA PAIXÃO FERREIRA DA SIVA', 'FERREIRA SILVA', '0', NULL, NULL, 0, '$2y$10$Q59EpaNZm/IhwjDVaJby7eOIkNunaewcu8a7I7xE/xQvxFxgjtX3G', 2, 'DESABILITADO'),
(869280, 'JOSÉ EUFRASIO DE OLIVEIRA', 'EUFRASIO', '0', NULL, NULL, 0, '$2y$10$9p8mrPUkUBQhZoOS8wtHfuIUASBdV/U/KteGEJXkJrgMhkgCj/7Eq', 4, 'DESABILITADO'),
(869331, 'JOSE RUBENS SILVA REIS', 'RUBENS', '0', NULL, NULL, 0, '$2y$10$chZmgvn8radJWYw/CWUNle0jMHta7sXpvb8OKOKnyNNYiRY6aLR/G', 1, 'HABILITADO'),
(869481, 'DAYVID ARAUJO DE AGUIAR', 'AGUIAR', '0', NULL, NULL, 0, '$2y$10$zLeEpKX3ZTiJlmVinLLH/.HPuBSnypaANxdqZ5JVkBLSfeKMtlWr2', 2, 'DESABILITADO'),
(869591, 'MAILSON DE CARVALHO ARAÚJO', 'DE CARVALHO', '0', NULL, NULL, 0, '$2y$10$PW.bMK53x6Fef/r8KpxS6eC3Zy8S6wQrEvt3e05Va3Koa2aXUnr46', 1, 'DESABILITADO'),
(869642, 'DIEGO DE CARVALHO ROCHA', 'ROCHA', '0', NULL, NULL, 0, '$2y$10$1zUqwMGyVNLplpGIRCnxMeXOAutJTg8I8PkJEEvQ7ghvisDL1zpHC', 4, 'DESABILITADO'),
(869703, 'JACKSON DIAS DA SILVA', 'JACKSON', '0', NULL, NULL, 0, '$2y$10$8Q/v6cMfc36/40RucOv0OOTEaGGdbM5FyCzNRQpyejrIGu0zsnRnu', 2, 'DESABILITADO'),
(869717, 'ANTÔNIO CARLOS DELMIRO', 'DELMIRO', '0', NULL, NULL, 0, '$2y$10$RkY/CNhinL0rU816wVZ7XeUnL8CQAZRPCiJ8yW6IP8a30dGiUDmja', 4, 'DESABILITADO'),
(869722, 'ANTÔNIO JOÃO DO NASCIMENTO', 'DO NASCIMENTO', '0', NULL, NULL, 0, '$2y$10$Nnd9ZGuGpg4gxh0ErH7UMuAVg8d9ACSqC4.jCmgZ//voudL45leFS', 4, 'DESABILITADO'),
(869818, 'FRANCISCO DIONAS LIMA', 'F. LIMA', '0', NULL, NULL, 0, '$2y$10$ylK2FugprtBuJu.zAZeMeO.DLd5X.Mq7LxZIGeqzHDgcw9TSs.p6W', 2, 'DESABILITADO'),
(869824, 'HERBERT MARCIEL DE ARAUJO', 'MARCIEL', '0', NULL, NULL, 0, '$2y$10$vjervWFzE/f48dvK9FFb1u7nAtruDinb3ylgIhmVqF9Fa6fGJFYiK', 3, 'DESABILITADO'),
(869974, 'CAIO FERREIRA ROCHA', 'C. FERREIRA', '0', NULL, NULL, 0, '$2y$10$fT6BMC2G49oYu6dO0GzQJuoJZnlo9ZarRVcHJOrbDhANtDAShDFeu', 2, 'DESABILITADO'),
(869983, 'EDUARDO JOSÉ SOEIRO CARNEIRO', 'EDUARDO CARNEIR', '0', NULL, NULL, 0, '$2y$10$BP5aAHQxgQlevQfrRrSlLuImEIVrXoeua/ULcR5vq0df1sPSMKWT6', 3, 'DESABILITADO'),
(870039, 'JONNATHAN FERREIRA RAMOS', 'JONNATHAN', '0', NULL, NULL, 0, '$2y$10$Rz4T9CasKPjYNtN.OiYQ7evWwRvyHlUy74cIIQqNf4TuRPCzIebPC', 4, 'DESABILITADO'),
(870082, 'EMANUEL FELIPE FERREIRA SANTOS', 'EMANUEL', '0', NULL, NULL, 0, '$2y$10$3s0TYOztRIUVEzR6RAGkoes7A/Wotp/F8RukRw/8IDMkda/7uiohy', 2, 'DESABILITADO'),
(870092, 'TIAGO DE SANTANA CARVALHO', 'TIAGO SANTANA', '0', NULL, NULL, 0, '$2y$10$vyk9BCW/LpB1bl2df7jhFeuV2rleP4ya/e2KXDySH3gtfcP8W3puK', 1, 'DESABILITADO'),
(870156, 'GIAN LUCA MELO BARBOSA LIMA', 'GIAN LUCA', '0', NULL, NULL, 0, '$2y$10$9QR49wYRsccqvokxBkpxluBIqepds0AytwWgrQyNeF01OBC9k.wYy', 4, 'DESABILITADO'),
(870170, 'EXPEDITO AVELINO DE SOUSA FILHO', 'AVELINO', '0', NULL, NULL, 0, '$2y$10$k3K8lkqlizaMeM3kMF.E4uFMxZo1SgFpzxVA0Mc7LHOva8Cx9dmv2', 4, 'DESABILITADO'),
(870229, 'ANDERSON CARVALHO DIAS', 'ANDERSON', '0', NULL, NULL, 0, '$2y$10$q5Xs2dDCf2PEc0QYDiI.R.XdeXRhgBWnPzwf0XQH7A7XkGOCobKtK', 4, 'DESABILITADO'),
(870233, 'MARCOS JOSÉ AMORIM DA SILVA', 'MARCOS', '0', NULL, NULL, 0, '$2y$10$gMpjpOBHrMyjhEaEjLqaW.1WGKBNFvK2PP092E/6u5Y/R3puC63yu', 3, 'DESABILITADO'),
(870269, 'SAMILA SOUSA CATARINO', 'SAMILA', '0', NULL, NULL, 0, '$2y$10$KHLcPeGJTZ.1qrin0Tca6OUYUlaTx41wVR5jTEaRZ7phJKZak9qgS', 2, 'DESABILITADO'),
(870333, 'PAULO VITOR DOS SANTOS MARQUES', 'PAULO', '0', NULL, NULL, 0, '$2y$10$74ohg/l0Fvrm9wgNylsuSuRKIMKYxGNCe7NiX/ADcETAKkzqGnVlq', 1, 'DESABILITADO'),
(870365, 'ANDREZA SOUSA OLIVEIRA', 'ANDREZA', '0', NULL, NULL, 0, '$2y$10$55gqryNOA/3B5Yjy6.dbou9deH7zRfxuWVaQVxH43xgSUBAOrE8La', 4, 'DESABILITADO'),
(870424, 'PEDRO IGOR COSTA MOREIRA', 'MOREIRA', '0', NULL, NULL, 0, '$2y$10$ddFZM2l29zkQkJmYQvnave6Q.YIfhCYvh0GyAhoC7gEOgz9XXRg9e', 1, 'DESABILITADO'),
(870446, 'CLEILSON SILVA ALMEIDA', 'ALMEIDA', '0', NULL, NULL, 0, '$2y$10$a5zdwvHCOCIMHX0jC.91bOkDQ2x.DVXrDGoRXc1sBh0Kr7ix59WQK', 4, 'DESABILITADO'),
(870454, 'VALDINAR DA SILVA CARVALHO JUNIOR', 'VALDINAR', '0', NULL, NULL, 0, '$2y$10$p62ph2g8WYKtAd1ksQPW7OKDuFlLq193wCsmsanq9mWKwUhooR.Z.', 3, 'DESABILITADO'),
(870464, 'TUNAS ÁDAMO BARBOSA DOS SANTOS', 'ÁDAMO', '0', NULL, NULL, 0, '$2y$10$.bQa/gRUqiykU7PXChjnJ.JgVnoVnOV4MP/uKfczj.KNqqdrT81N6', 1, 'DESABILITADO'),
(870494, 'LEONARDO PEREIRA DE SOUSA', 'L. PEREIRA', '0', NULL, NULL, 0, '$2y$10$BUDJhUZPvYKN4BrwDS6LaeuQFkuphjQJuAm8S3Uj/sDRolMCm6nya', 2, 'DESABILITADO'),
(870505, 'GERFERSON TAIRONE DIAS CAMPOS', 'CAMPOS', '0', NULL, NULL, 0, '$2y$10$Xda4xG3asngw9.TFOqjP/.1wOt6/V4b9AY4UXOmFOD23TbYfddKmS', 4, 'DESABILITADO'),
(870540, 'FRANCISCO ANTÔNIO DE ASSIS GOMES DA SILV', 'F. ASSIS', '0', NULL, NULL, 0, '$2y$10$DXaNX55EYaMUc8g.j1xaTO4j3PqEVfJMNaWrHKXPwWNA8xnsJOdNS', 4, 'DESABILITADO'),
(870584, 'FLÁVIA SABRYNNE DE AGUIAR FREITAS', 'SABRYNNE', '0', NULL, NULL, 0, '$2y$10$aSZ35hkPVl2g1Z1ASgEWyuft2uYVWqUFzHn7UrRA1ZbVx/VNc3ofW', 4, 'DESABILITADO'),
(870672, 'ISMAEL PEREIRA DOS SANTOS', 'ISMAEL', '0', NULL, NULL, 0, '$2y$10$a.Pdvui3ja05BS2fpppUme5oliw5wuwC09c856gSyG62cwuZ0pfrW', 1, 'DESABILITADO'),
(870749, 'RICARDO JHON RODRIGUES DE SOUSA', 'J. RODRIGUES', '0', NULL, NULL, 0, '$2y$10$SKbyvWBjiWHuXihRh59X7uqMyNh4HQj3XabkLpWF3I4FqNzAwXEum', 1, 'DESABILITADO'),
(870785, 'Florivaldo Lopes Rabelo', 'RABELO', '0', NULL, NULL, 86981247321, '$2y$10$J.bGKIuQ2aMztiM77YCiV.cHM0vqWIB01zvFrv7aeZvg4RR.5NlPq', 2, 'HABILITADO'),
(870858, 'LUCAS PEREIRA GOMES', 'GOMES', '0', NULL, NULL, 0, '$2y$10$9IPdKhUI18PpoM3t4.hcqe/H/iIu7ykxhc2rLj3hW8nMC75Njv2mm', 3, 'DESABILITADO'),
(870866, 'MATHEUS DAS CHAGAS VERAS VIEIRA', 'CHAGAS', '0', NULL, NULL, 0, '$2y$10$I5Wago6XTMxNIgJNQIe9uuSuGV48a/vEk1OsEFwQNbhl/UmftroxG', 3, 'DESABILITADO'),
(870927, 'GUILHERME ALMEIDA SANTANA', 'SANTANA', '0', '', NULL, 0, '$2y$10$LBpFxZYmW9vHU8y9Rpgn3OwNeWSW9T4vOMSMYwzkrNA6WXOqQVuGq', 2, 'DESABILITADO'),
(870951, 'PAULO VITOR SANTOS GUEDES', 'GUEDES', '0', NULL, NULL, 0, '$2y$10$LRzfeGkx3Ty.FZ6HeaMJ3.fvJ.kAOlgWibLe.0i8FhsDPJYeECjkS', 1, 'DESABILITADO'),
(870954, 'GUSTAVO ANDRÉ TEIXEIRA DA SILVA', 'TEIXEIRA', '0', NULL, NULL, 0, '$2y$10$JinGov6QKoc3pf7V4IMqVuOEbilFRe7GNSpVlAFDMXITsHMc4TDTC', 1, 'DESABILITADO'),
(870965, 'GUSTAVO SILVA DE SOUSA JUNIOR', 'GUSTAVO', '0', NULL, NULL, 0, '$2y$10$m9fO6SAPcfLg2S2suIH5E.Yo3SI4NU/cmoaein3XxKVECfZzSD7d2', 2, 'DESABILITADO'),
(870996, 'HECTOR NATÉRCIO MENDES DOS SANTOS', 'HECTOR', '0', NULL, NULL, 0, '$2y$10$VpocJdlkoAfYbd6/oUo0s.B0Fq6tK3U.7VlQtuDjx38jYdpaPgweu', 1, 'DESABILITADO'),
(871067, 'WELLINGTON DIEGO DOS SANTOS', 'DIEGO', '0', NULL, NULL, 0, '$2y$10$8vEyhG0AcVZMBF/5QEO1hO.BKtXVvrTTP7nC3aJXDd9Y7/VnHKfUK', 3, 'DESABILITADO'),
(871087, 'IGOR VANDERLEI DO VALE', 'DO VALE', '0', NULL, NULL, 0, '$2y$10$GWtAPex/OR/rDhRx4hxWBOrxobcxYeomYk6e.uqt9hnb0NfzPxdXG', 3, 'DESABILITADO'),
(871112, 'WENDELL JORDANY BANDEIRA DA SILVA', 'BANDEIRA', '0', NULL, NULL, 0, '$2y$10$i12TPOpi8N0eZNU1AS5c3ejPLVS.2JKjEGmGJICV0znYfEjnsQcTK', 1, 'DESABILITADO'),
(871194, 'WESLLEY JOSÉ DA SILVA CARVALHO', 'WESLLEY', '0', NULL, NULL, 0, '$2y$10$xgRH4O.T60KK0gKiWj3XIOY4g6eUvidfgDZbJLbRyLYiYWaSl8nSS', 2, 'DESABILITADO'),
(871255, 'LEONARDO LOUZEIRO OLIVEIRA', 'LOUZEIRO', '0', NULL, NULL, 0, '$2y$10$PKY9eLwd0pqBwtRtWxlRAuBb45D7ivsxuS1.o7Xufm4DUgTIY9.bK', 1, 'DESABILITADO'),
(871363, 'VALDEMIR SILVA DOS SANTOS', 'VALDEMIR', '0', NULL, NULL, 0, '$2y$10$lFhGKd8AULIVx9pCS9ecT.Whk54t9vX8CGOikBRxYdJp10LzCBYne', 1, 'DESABILITADO'),
(871450, 'FRANCISCO DAS CHAGAS DA SILVA JUNIOR', 'S. JUNIOR', '0', NULL, NULL, 0, '$2y$10$MOVdOk7rukm/xzdIYXRCFemFhup0pOqM1zYkEp5qGuDoRMQIM9Rmu', 1, 'DESABILITADO'),
(871627, 'KAIO FERNANDO ALVES DOS REIS', 'FERNANDO', '0', NULL, NULL, 0, '$2y$10$ooEVvSqgTGg9KcN1EMEQU.VLIPOTnM9RRg1xSiyUSKdYlCJ7dP2p2', 1, 'DESABILITADO'),
(871666, 'MÁRIO NUNES COSTA', 'MÁRIO', '0', NULL, NULL, 0, '$2y$10$XEpeg44A0ZgsfimnISTwK.NQhA6SswBICBMoa95SYszlasi7eestq', 1, 'HABILITADO'),
(871676, 'WILLIAM DE SOUSA ARAÚJO', 'WILLIAM', '0', NULL, NULL, 0, '$2y$10$VsyMCY9yLuLB3uIXdhJ/Ret/a862dQu1ofHJ5gh4LGfkcGrs6FQT.', 2, 'DESABILITADO'),
(871713, 'ZAYRON BRENNER BRASIL RAMOS', 'BRASIL', '0', NULL, NULL, 0, '$2y$10$/Tw1wgKA1PTT6lWOUGso9OcPeWNP.icD.hVuIqssUHmVqUviskP6S', 4, 'DESABILITADO'),
(871783, 'JOÃO MARIANO DA SILVA NETO', 'SILVA NETO', '0', NULL, NULL, 0, '$2y$10$Yy9wx3GqMwRlafK.q/rz8e.coUFmOzO7m34aB7ynOzVLmZvRQVJ.m', 4, 'DESABILITADO'),
(871867, 'WANESSA DOS SANTOS LUSTOSA', 'LUSTOSA', '0', NULL, NULL, 0, '$2y$10$qB0aEQucPoOHjn//h1Ed9urQEFirsq0Q8g5d6EmiYMvYeQwvOCc46', 4, 'DESABILITADO'),
(872547, 'LAÍS SILVA MENDES', 'LAÍS', '0', NULL, NULL, 0, '$2y$10$LKaR4mNnT1p0sZ/Rf3Lj4OYqkaso8ncMnduVO.F3FWGff3M6DIkxe', 1, 'DESABILITADO'),
(872557, 'RAFAEL DE CARVALHO CORRÊIA', 'R. CARVALHO', '0', NULL, NULL, 0, '$2y$10$Y9c2Yr540wFrJiOlyEb0yuNYOs460NjSMtzpJ2XFEM1cn9wuVW2dy', 1, 'DESABILITADO'),
(872842, 'LUÍS FERNANDO GARCES PARGAS JÚNIOR', 'PARGAS', '0', NULL, NULL, 0, '$2y$10$nvPOJ47VqckDKLK6kjmCG.3vQ.aC8Ts6k9EEDxwqPoXZIQLL5xDM6', 3, 'DESABILITADO'),
(872844, 'RAFAEL NASCIMENTO DA MATA', 'DA MATA', '0', NULL, NULL, 0, '$2y$10$XldeOT1VdkaR0ImeVf4CXOdEJ9XK6bOiPbSzVc3T3hANnCGhZ3bpO', 3, 'DESABILITADO'),
(874273, 'DANIEL FERREIRA COQUEIRO', 'COQUEIRO', '0', NULL, NULL, 0, '$2y$10$2HhflKOp7034TSGOL28n0OXFgCiD1sWhkuC.gIGZDCCS.22SSiKWK', 1, 'DESABILITADO'),
(875668, 'ROBERTO NEVES TEBALDI', 'TEBALDI', '0', NULL, NULL, 0, '$2y$10$BeUP72unMyrbagfKcMyB/eso8Yj8WzfTS3wAqywbvc3XzohDpcY6W', 3, 'DESABILITADO'),
(875806, 'JEFERSON MATEUS CORDEIRO DA SILVA', 'CORDEIRO', '0', NULL, NULL, 0, '$2y$10$a2nvfeZdbYGhKYyJv9q9vOB4IjeH7CSPg34hBPpoihga0CdDpGOs2', 3, 'DESABILITADO'),
(875865, 'RANDERSON VIANA UCHOA', 'RANDERSON', '0', NULL, NULL, 0, '$2y$10$9GeVufugfosHaCU028jUyekYwAsX1NdOtfZgDGOflZsbqyUFk3R7u', 4, 'DESABILITADO'),
(875870, 'YASSER COSTA OLIVEIRA LIMA', 'YASSER', '0', NULL, NULL, 0, '$2y$10$0GsOxiwtMC0uMLJmOBQbh.yFXPX/zMJmFm4uUgMF1GC0xUUV/jpTK', 3, 'DESABILITADO'),
(875872, 'ROBERTO SILVA SOUZA JUNIOR', 'SILVA JUNIOR', '0', NULL, NULL, 0, '$2y$10$zBRuVPoMswysjTVXu86EhuYRb28apG5RC4p/vilz.Pyf.E8OsUWYi', 3, 'DESABILITADO'),
(875891, 'THIAGO GOMES DE BRITO', 'BRITO', '0', NULL, NULL, 0, '$2y$10$TQMrgIkJuODvhK.IlbAllOf97uYiz58ZcgXdiKofdEG0daI5kexka', 4, 'DESABILITADO'),
(875900, 'VICTOR HUGO MORAES JANSEN', 'MORAES', '0', NULL, NULL, 0, '$2y$10$ZETb0KeyCbPgDe8Fhu7WUumVsCDVgrcmk6PsMcRXQmcpksB8Bb7Qa', 3, 'DESABILITADO'),
(877137, 'JAKELINE SOUSA ARAÚJO', 'JAKELINE', '2', NULL, NULL, 0, '$2y$10$yahbHlOzQKzibb5M1/c1d.jvRat9E4EgLcU5vqu5KridNCpkI6f66', 1, 'HABILITADO');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `agenda_permuta`
--
ALTER TABLE `agenda_permuta`
  ADD PRIMARY KEY (`id_agenda`),
  ADD KEY `matr_permutante` (`matr_permutante`);

--
-- Índices de tabela `permutas`
--
ALTER TABLE `permutas`
  ADD PRIMARY KEY (`id_permuta`),
  ADD KEY `matr_permutante` (`matr_permutante`),
  ADD KEY `matr_permutado` (`matr_permutado`);

--
-- Índices de tabela `pontos`
--
ALTER TABLE `pontos`
  ADD PRIMARY KEY (`id_pontos`),
  ADD KEY `matricula` (`matricula`);

--
-- Índices de tabela `ranking`
--
ALTER TABLE `ranking`
  ADD PRIMARY KEY (`id_ranking`),
  ADD KEY `matricula` (`matricula`);

--
-- Índices de tabela `registrosbo`
--
ALTER TABLE `registrosbo`
  ADD PRIMARY KEY (`id_miker`),
  ADD KEY `matricula` (`mtr1`),
  ADD KEY `fk_mtr2` (`mtr2`),
  ADD KEY `fk_mtr3` (`mtr3`),
  ADD KEY `fk_mtr4` (`mtr4`),
  ADD KEY `fk_mtr5` (`mtr5`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agenda_permuta`
--
ALTER TABLE `agenda_permuta`
  MODIFY `id_agenda` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `permutas`
--
ALTER TABLE `permutas`
  MODIFY `id_permuta` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pontos`
--
ALTER TABLE `pontos`
  MODIFY `id_pontos` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT de tabela `ranking`
--
ALTER TABLE `ranking`
  MODIFY `id_ranking` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;

--
-- AUTO_INCREMENT de tabela `registrosbo`
--
ALTER TABLE `registrosbo`
  MODIFY `id_miker` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=877138;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `agenda_permuta`
--
ALTER TABLE `agenda_permuta`
  ADD CONSTRAINT `agenda_permuta_ibfk_1` FOREIGN KEY (`matr_permutante`) REFERENCES `usuario` (`id`);

--
-- Restrições para tabelas `permutas`
--
ALTER TABLE `permutas`
  ADD CONSTRAINT `permutas_ibfk_1` FOREIGN KEY (`matr_permutante`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `permutas_ibfk_2` FOREIGN KEY (`matr_permutado`) REFERENCES `usuario` (`id`);

--
-- Restrições para tabelas `pontos`
--
ALTER TABLE `pontos`
  ADD CONSTRAINT `pontos_ibfk_1` FOREIGN KEY (`matricula`) REFERENCES `usuario` (`id`);

--
-- Restrições para tabelas `ranking`
--
ALTER TABLE `ranking`
  ADD CONSTRAINT `ranking_ibfk_1` FOREIGN KEY (`matricula`) REFERENCES `usuario` (`id`);

--
-- Restrições para tabelas `registrosbo`
--
ALTER TABLE `registrosbo`
  ADD CONSTRAINT `fk_mtr2` FOREIGN KEY (`mtr2`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `fk_mtr3` FOREIGN KEY (`mtr3`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `fk_mtr4` FOREIGN KEY (`mtr4`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `fk_mtr5` FOREIGN KEY (`mtr5`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `registrosbo_ibfk_1` FOREIGN KEY (`mtr1`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
