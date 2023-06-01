-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3312
-- Tempo de geração: 01-Jun-2023 às 12:05
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- CREATE DATABASE plataform_courses character set='UTF8' collate='UTF8_general_ci';
-- USE plataform_courses;

--
-- Banco de dados: `plataform_courses`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_curso`
--

CREATE TABLE if not exists `tb_curso` (
  `cd_curso` int(11) NOT NULL,
  `nm_curso` varchar(64) NOT NULL,
  `duracao` int(11) NOT NULL,
  `diciplina` int(2) NOT NULL,
  `valor` decimal(5,2) NOT NULL,
  `cd_prof` int(11) NOT NULL,
  `dt_publicacao` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;



-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_diciplina`
--

CREATE TABLE if not exists `tb_diciplina` (
  `cd_diciplina` int(11) NOT NULL,
  `nm_diciplina` varchar(32) NOT NULL,
  `bg_diciplina` varchar(160) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `tb_diciplina`
--

INSERT INTO `tb_diciplina` (`cd_diciplina`, `nm_diciplina`, `bg_diciplina`) VALUES
(1, 'front-end', 'radial-gradient(circle, rgba(207,95,211,1) 0%, rgba(197,34,80,1) 100%)'),
(2, 'back-end', 'radial-gradient(circle, rgba(211,95,95,1) 0%, rgba(238,30,30,1) 100%)'),
(3, 'full-stack', 'radial-gradient(circle, rgba(164,95,211,1) 0%, rgba(94,30,238,1) 100%)'),
(4, 'banco de dados', 'radial-gradient(circle, rgba(95,98,211,1) 0%, rgba(30,236,238,1) 100%)'),
(5, 'data science', 'radial-gradient(circle, rgba(204,211,95,1) 0%, rgba(30,238,111,1) 100%)'),
(6, 'devops', 'radial-gradient(circle, rgba(232,63,79,1) 0%, rgba(238,223,30,1) 100%)'),
(7, 'ux / ui', 'radial-gradient(circle, rgba(232,63,125,1) 0%, rgba(30,180,238,1) 100%)'),
(8, 'mobile', 'radial-gradient(circle, rgba(142,232,63,1) 0%, rgba(238,94,30,1) 100%)'),
(9, 'desenvolvimento de jogos', 'radial-gradient(circle, rgba(63,232,152,1) 0%, rgba(30,57,238,1) 100%)');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_professor`
--

CREATE TABLE if not exists `tb_professor` (
  `cd_prof` int(11) NOT NULL,
  `nm_prof` varchar(60) NOT NULL,
  `senha_prof` varchar(256) NOT NULL,
  `email_prof` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `tb_professor`
--

INSERT INTO `tb_professor` (`cd_prof`, `nm_prof`, `senha_prof`, `email_prof`) VALUES
(1, 'Rômullo Melo', '$2y$10$qsvbZnH2ZfDbtiC7Q4840eUWKGuZ37X4YafVva9brf0jQt2MG1C5m', 'romullo@gg.com'),
(2, 'Nicole', '$2y$10$RvwOGDlRWx/XOke.CZgBUeZcx8q2LbNENu18pmr6HGRc.pktxyMvm', 'nicole@gg.com'),
(3, 'rom013', '$2y$10$GunqSHA7Ckq8IKBCq/SFK.pt5DJpP0/LARAJwgbqIAkJrqfyBwcZq', 'rom013@gg.com'),
(4, 'leticia', '$2y$10$yxI2CHXV6kRl9FLHERP/IuSFsPsLxdsVLQziHGm1kGMymCgdDx6Pm', 'leticia@apollo.com'),
(5, 'Rômullo', '$2y$10$/qatZG0ZncFukjmYd94pIes4xvgTo.b1lne6yBc0maG6X5UU7./22', 'romullo2@gg.com');

--
-- Extraindo dados da tabela `tb_curso`
--

INSERT INTO `tb_curso` (`cd_curso`, `nm_curso`, `duracao`, `diciplina`, `valor`, `cd_prof`, `dt_publicacao`) VALUES
(1, 'Javascript básico', 48, 3, '57.00', 1, '2023-05-28 02:01:45'),
(2, 'Javascript avançado', 40, 1, '79.99', 1, '2023-05-29 04:12:18'),
(3, 'Mobile', 80, 9, '20.22', 3, '2023-05-31 00:00:00'),
(4, 'Curso de HTML e CSS', 32, 1, '32.00', 2, '2023-05-31 00:00:00'),
(5, 'Clonando a NETFLIX', 24, 1, '24.50', 2, '2023-05-31 00:00:00'),
(6, 'Figma', 12, 8, '0.00', 2, '2023-05-31 00:00:00'),
(7, 'Test', 32, 8, '0.00', 4, '2023-06-01 04:42:40'),
(8, 'React e NodeJs', 64, 4, '89.99',  4,'2023-06-01 00:00:00');

--
-- Índices para tabela `tb_curso`
--
ALTER TABLE `tb_curso`
  ADD PRIMARY KEY (`cd_curso`),
  ADD KEY `fk_prof` (`cd_prof`),
  ADD KEY `fk_diciplina` (`diciplina`);

--
-- Índices para tabela `tb_diciplina`
--
ALTER TABLE `tb_diciplina`
  ADD PRIMARY KEY (`cd_diciplina`);

--
-- Índices para tabela `tb_professor`
--
ALTER TABLE `tb_professor`
  ADD PRIMARY KEY (`cd_prof`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_curso`
--
ALTER TABLE `tb_curso`
  MODIFY `cd_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de tabela `tb_diciplina`
--
ALTER TABLE `tb_diciplina`
  MODIFY `cd_diciplina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `tb_professor`
--
ALTER TABLE `tb_professor`
  MODIFY `cd_prof` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tb_curso`
--
ALTER TABLE `tb_curso`
  ADD CONSTRAINT `fk_diciplina` FOREIGN KEY (`diciplina`) REFERENCES `tb_diciplina` (`cd_diciplina`),
  ADD CONSTRAINT `fk_prof` FOREIGN KEY (`cd_prof`) REFERENCES `tb_professor` (`cd_prof`);
COMMIT;