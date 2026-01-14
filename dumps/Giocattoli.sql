-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Creato il: Gen 14, 2026 alle 10:59
-- Versione del server: 11.3.2-MariaDB-1:11.3.2+maria~ubu2204
-- Versione PHP: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `root_db`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Giocattoli`
--

CREATE TABLE `Giocattoli` (
  `nome_elfo` varchar(50) NOT NULL,
  `nome_gioco` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Giocattoli`
--

INSERT INTO `Giocattoli` (`nome_elfo`, `nome_gioco`) VALUES
('pippo', 'pluto'),
('pippo', 'pluto'),
('pippo', 'pluto'),
('pippo', 'pluto');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
