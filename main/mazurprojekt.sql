-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Czas generowania: 05 Gru 2017, 18:12
-- Wersja serwera: 5.7.19
-- Wersja PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `mazurprojekt`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dzialy`
--

DROP TABLE IF EXISTS `dzialy`;
CREATE TABLE IF NOT EXISTS `dzialy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE cp1250_polish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=cp1250 COLLATE=cp1250_polish_ci;

--
-- Zrzut danych tabeli `dzialy`
--

INSERT INTO `dzialy` (`id`, `name`) VALUES
(1, 'Calki'),
(2, 'Naleśnki'),
(3, 'Jakieś coś');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kolokwia`
--

DROP TABLE IF EXISTS `kolokwia`;
CREATE TABLE IF NOT EXISTS `kolokwia` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_dzialy` int(11) NOT NULL,
  `name` varchar(30) COLLATE cp1250_polish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=cp1250 COLLATE=cp1250_polish_ci;

--
-- Zrzut danych tabeli `kolokwia`
--

INSERT INTO `kolokwia` (`id`, `id_dzialy`, `name`) VALUES
(1, 1, 'Całki'),
(2, 1, 'Połówki'),
(3, 1, 'Dla studentów'),
(4, 2, 'Lubie placki'),
(5, 2, 'Lubie placki 2');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user` varchar(25) COLLATE cp1250_polish_ci NOT NULL,
  `password` varchar(25) COLLATE cp1250_polish_ci DEFAULT NULL,
  `name` varchar(35) COLLATE cp1250_polish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=cp1250 COLLATE=cp1250_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `user`, `password`, `name`) VALUES
(1, 'pt22555', 'qwerty5', 'Paweł Tomasiak'),
(3, 'ko2877', 'qwerty5', 'Kamil Orzechowski'),
(5, 'aaa', 'aaa', 'aaa aaa');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
