-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Creato il: Mag 03, 2020 alle 17:10
-- Versione del server: 5.7.29-0ubuntu0.18.04.1
-- Versione PHP: 7.2.24-0ubuntu0.18.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pizza`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `ingredients`
--

CREATE TABLE `ingredients` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `price` float DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `ingredients`
--

INSERT INTO `ingredients` (`id`, `name`, `price`) VALUES
(1, 'Sausage', 2),
(2, 'Cheese', 2),
(3, 'Tomatoes', 4),
(4, 'Potatoes', 3),
(5, 'Sweet pepper', 5);

-- --------------------------------------------------------

--
-- Struttura della tabella `pizza`
--

CREATE TABLE `pizza` (
  `id` int(11) NOT NULL,
  `width` int(11) DEFAULT NULL,
  `price` float DEFAULT '0',
  `waiting_time` int(11) DEFAULT '0',
  `user` int(11) DEFAULT NULL,
  `hour_submitted` time DEFAULT NULL,
  `hour_cooked` time DEFAULT NULL,
  `hour_delivered` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `pizza`
--

INSERT INTO `pizza` (`id`, `width`, `price`, `waiting_time`, `user`, `hour_submitted`, `hour_cooked`, `hour_delivered`) VALUES
(27, 3, 25, 30, 29, '20:20:53', '20:50:53', '20:55:53'),
(28, 1, 10, 40, 30, '20:21:15', '21:01:15', '21:06:15'),
(29, 1, 10, 50, 31, '20:23:05', '21:13:05', '21:18:05'),
(30, 1, 10, 60, 34, '20:33:08', '22:03:05', '22:04:52'),
(31, 1, 10, 70, 35, '20:33:25', '22:02:50', '22:04:50'),
(32, 1, 10, 80, 36, '20:34:56', '21:59:22', '22:04:49'),
(33, 2, 13, 90, 37, '20:35:11', '21:58:49', '22:04:39'),
(34, 1, 14, 100, 38, '22:03:52', '22:03:55', '22:04:29'),
(35, 1, 12, 110, 39, '22:07:05', NULL, NULL),
(36, 2, 16, 120, 40, '22:07:12', NULL, NULL),
(37, 3, 29, 130, 41, '22:07:19', NULL, NULL),
(38, 1, 12, 140, 42, '22:08:24', NULL, NULL),
(39, 1, 10, 150, 43, '22:08:30', NULL, NULL),
(40, 1, 10, 160, 44, '22:08:35', NULL, NULL),
(41, 1, 15, 170, 45, '22:08:41', NULL, NULL),
(42, 1, 10, 180, 46, '22:08:49', NULL, NULL),
(43, 2, 14, 190, 47, '22:08:55', NULL, NULL),
(44, 2, 15, 200, 48, '22:09:01', NULL, NULL),
(45, 2, 15, 210, 49, '22:09:09', NULL, NULL),
(46, 2, 16, 220, 50, '22:09:17', NULL, NULL),
(48, 3, 22, 240, 52, '22:09:40', '22:09:56', '22:10:00'),
(49, 2, 15, 250, 59, '16:44:29', '16:47:33', '16:47:33'),
(50, 2, 15, 260, 60, '16:47:55', '16:48:05', '16:48:06');

-- --------------------------------------------------------

--
-- Struttura della tabella `pizza_ingredients`
--

CREATE TABLE `pizza_ingredients` (
  `pizza` int(11) NOT NULL,
  `ingredient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `pizza_ingredients`
--

INSERT INTO `pizza_ingredients` (`pizza`, `ingredient`) VALUES
(5, 1),
(5, 4),
(6, 1),
(6, 4),
(7, 1),
(7, 4),
(8, 1),
(8, 4),
(9, 2),
(9, 4),
(10, 1),
(10, 2),
(11, 1),
(11, 2),
(11, 4),
(12, 1),
(12, 2),
(12, 3),
(12, 4),
(12, 5),
(13, 2),
(13, 4),
(14, 2),
(14, 4),
(15, 2),
(15, 4),
(16, 2),
(16, 4),
(17, 2),
(17, 4),
(18, 2),
(18, 4),
(19, 2),
(19, 4),
(20, 2),
(20, 4),
(21, 2),
(21, 4),
(22, 1),
(22, 2),
(23, 1),
(23, 2),
(24, 1),
(24, 2),
(24, 4),
(25, 1),
(25, 2),
(25, 4),
(26, 4),
(26, 5),
(27, 1),
(27, 4),
(28, 5),
(29, 5),
(30, 1),
(30, 4),
(31, 1),
(31, 4),
(32, 1),
(32, 4),
(33, 4),
(34, 3),
(34, 5),
(35, 1),
(35, 5),
(36, 2),
(36, 3),
(37, 1),
(37, 3),
(37, 4),
(38, 1),
(38, 5),
(39, 2),
(39, 4),
(40, 2),
(40, 4),
(41, 1),
(41, 4),
(41, 5),
(42, 2),
(42, 4),
(43, 3),
(44, 1),
(44, 4),
(45, 1),
(45, 4),
(46, 2),
(46, 3),
(47, 5),
(48, 2),
(49, 1),
(49, 4),
(50, 2),
(50, 4);

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `address` text NOT NULL,
  `city` text NOT NULL,
  `username` text,
  `password` text,
  `admin` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id`, `name`, `address`, `city`, `username`, `password`, `admin`) VALUES
(1, 'Bill', 'Street 1', 'New york', NULL, NULL, 0),
(2, 'Bill', 'Street 1', 'New york', NULL, NULL, 0),
(3, 'dasa', 'dasads', 'das', NULL, NULL, 0),
(4, 'dasa', 'dasads', 'das', NULL, NULL, 0),
(5, 'dasa', 'dasads', 'das', NULL, NULL, 0),
(6, 'dasa', 'dasads', 'das', NULL, NULL, 0),
(7, 'dasa', 'dasads', 'das', NULL, NULL, 0),
(8, 'dasa', 'dasads', 'das', NULL, NULL, 0),
(9, 'dasa', 'dasads', 'das', NULL, NULL, 0),
(10, 'adsads', 'dasdasdas', 'asddas', NULL, NULL, 0),
(11, 'dadsa', 'adsda', 'v', NULL, NULL, 0),
(12, 'af', 'faasasf', 'fasfs', NULL, NULL, 0),
(13, 'Bill', 'Street 3', 'Toronto', NULL, NULL, 0),
(14, 'dasas', 'dasad', 'asdads', NULL, NULL, 0),
(15, 'dasas', 'dasad', 'asdads', NULL, NULL, 0),
(16, 'dasas', 'dasad', 'asdads', NULL, NULL, 0),
(17, 'dasas', 'dasad', 'asdads', NULL, NULL, 0),
(18, 'dasas', 'dasad', 'asdads', NULL, NULL, 0),
(19, 'dasas', 'dasad', 'asdads', NULL, NULL, 0),
(20, 'dasas', 'dasad', 'asdads', NULL, NULL, 0),
(21, 'safs', 'fsasf', 'asffas', NULL, NULL, 0),
(22, 'safs', 'fsasf', 'asffas', NULL, NULL, 0),
(23, 'Bobby lee', 'street 2', 'Torronto', NULL, NULL, 0),
(24, 'Bobby lee', 'street 2', 'Torronto', NULL, NULL, 0),
(25, 'asdasd', 'dasads', 'asdasd', NULL, NULL, 0),
(26, 'John', 'street 1', 'Ockloonas', NULL, NULL, 0),
(27, 'John', 'street 1', 'Ockloonas', NULL, NULL, 0),
(28, 'ewqeqw', 'qweqew', 'qeweqw', NULL, NULL, 0),
(29, 'fasfas', 'faaf', 'fasfas', NULL, NULL, 0),
(30, 'adsdsa', 'dasdas', 'asddas', NULL, NULL, 0),
(31, 'adsdsa', 'dasdas', 'asddas', NULL, NULL, 0),
(32, 'dasasd', 'asddasadsads', 'fsafas', NULL, NULL, 0),
(33, 'sadsa', 'asddsa', 'asddas', NULL, NULL, 0),
(34, 'sadsa', 'asddsa', 'asddas', NULL, NULL, 0),
(35, 'sadsa', 'asddsa', 'asddas', NULL, NULL, 0),
(36, 'sadsa', 'asddsa', 'asddas', NULL, NULL, 0),
(37, 'das', 'dasads', 'adsasd', NULL, NULL, 0),
(38, 'dasd', 'saasd', 'asdasd', NULL, NULL, 0),
(39, 'sgdsgd', 'gsdsgd', 'sdggsd', NULL, NULL, 0),
(40, 'sgd', 'sdgsd', 'gsdsd', NULL, NULL, 0),
(41, 'sdgsgd', 'sdgsdg', 'sdg', NULL, NULL, 0),
(42, 'sdasda', 'sdads', 'asdadas', NULL, NULL, 0),
(43, 'sdadas', 'sdadas', 'adsdas', NULL, NULL, 0),
(44, 'sdadas', 'asdasd', 'asd', NULL, NULL, 0),
(45, 'adssda', 'dasdas', 'dasads', NULL, NULL, 0),
(46, 'saddsa', 'sdasaads', 'dasads', NULL, NULL, 0),
(47, 'dsadas', 'dasasd', 'asdas', NULL, NULL, 0),
(48, 'dsadsa', 'dasdas', 'ads', NULL, NULL, 0),
(49, 'asddas', 'dasads', 'dasdas', NULL, NULL, 0),
(50, 'dsa', 'dsadasdas', 'dassda', NULL, NULL, 0),
(51, 'oppp', 'jiopj', 'opopkop', NULL, NULL, 0),
(59, 'dasas', 'hijioji', 'oijiojioj', NULL, NULL, 0),
(60, 'dasas', 'hijioji', 'oijiojioj', NULL, NULL, 0),
(61, 'Admin name', 'Admin address', 'Admin City', 'admin', '$2y$10$rpoTS8tLIkqVLYuXj3jCa.F0kEup5EhJ8n9oh9gILsNQ4TEF9fFXq', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `width_pizza`
--

CREATE TABLE `width_pizza` (
  `id` int(11) NOT NULL,
  `width` text NOT NULL,
  `price` float DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `width_pizza`
--

INSERT INTO `width_pizza` (`id`, `width`, `price`) VALUES
(1, 'Little', 5),
(2, 'Medium', 10),
(3, 'Big', 20);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `pizza`
--
ALTER TABLE `pizza`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `pizza_ingredients`
--
ALTER TABLE `pizza_ingredients`
  ADD PRIMARY KEY (`pizza`,`ingredient`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `width_pizza`
--
ALTER TABLE `width_pizza`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT per la tabella `pizza`
--
ALTER TABLE `pizza`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT per la tabella `width_pizza`
--
ALTER TABLE `width_pizza`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
