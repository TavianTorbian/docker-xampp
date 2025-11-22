-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Creato il: Nov 22, 2025 alle 11:29
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
-- Database: `Fabbrica`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Dipendenti`
--

CREATE TABLE `Dipendenti` (
  `Matricola` int(11) NOT NULL,
  `CF` varchar(16) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Cognome` varchar(50) NOT NULL,
  `Indirizzo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Dipendenti`
--

INSERT INTO `Dipendenti` (`Matricola`, `CF`, `Nome`, `Cognome`, `Indirizzo`) VALUES
(1, 'RSSMRA80A01F205X', 'Mario', 'Rossi', 'Via Roma 12, Milano'),
(2, 'BNCLGU85B22H501Z', 'Luigi', 'Bianchi', 'Corso Italia 45, Torino'),
(3, 'VRDPLA90C15L219Y', 'Paola', 'Verdi', 'Via Dante 99, Firenze'),
(4, 'SLLFNC75D10H224A', 'Franco', 'Sala', 'Via Verdi 7, Roma'),
(5, 'NGLPLA82C15A662K', 'Anna', 'Neri', 'Via Milano 4, Napoli');

-- --------------------------------------------------------

--
-- Struttura della tabella `Magazzini`
--

CREATE TABLE `Magazzini` (
  `Codice` int(11) NOT NULL,
  `Capienza` int(11) NOT NULL,
  `Indirizzo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Magazzini`
--

INSERT INTO `Magazzini` (`Codice`, `Capienza`, `Indirizzo`) VALUES
(10, 8000, 'Via dei Magazzini 1, Milano'),
(11, 3000, 'Via Torino 22, Torino'),
(12, 4000, 'Via Firenze 33, Firenze');

-- --------------------------------------------------------

--
-- Struttura della tabella `MateriePrime`
--

CREATE TABLE `MateriePrime` (
  `Tipologia` varchar(50) NOT NULL,
  `CostoUnitario` decimal(10,2) NOT NULL,
  `PesoUnitario` decimal(10,2) DEFAULT NULL,
  `Codice` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `MateriePrime`
--

INSERT INTO `MateriePrime` (`Tipologia`, `CostoUnitario`, `PesoUnitario`, `Codice`) VALUES
('Additivo X', 10.00, 0.20, NULL),
('Cacao', 3.50, 0.50, 11),
('Gocce di Cioccolato', 10.00, 0.20, 11),
('Latte Intero', 1.20, 1.00, 10),
('Panna Fresca', 2.50, 1.00, 10),
('Vaniglia', 5.00, 0.10, 12),
('Zucchero', 0.80, 1.00, 11);

-- --------------------------------------------------------

--
-- Struttura della tabella `Prodotti`
--

CREATE TABLE `Prodotti` (
  `Id` int(11) NOT NULL,
  `Codice` int(11) DEFAULT NULL,
  `Matricola` int(11) DEFAULT NULL,
  `Descrizione` varchar(255) DEFAULT NULL,
  `Nome` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Prodotti`
--

INSERT INTO `Prodotti` (`Id`, `Codice`, `Matricola`, `Descrizione`, `Nome`) VALUES
(1, 10, 1, 'Gelato alla vaniglia', 'Gelato Vaniglia'),
(2, 10, 2, 'Gelato al cioccolato', 'Gelato Cioccolato'),
(3, 11, 3, 'Panna montata', 'Panna Montata'),
(100, 10, 1, 'Prodotto extra', 'Prodotto 100'),
(101, 10, 1, 'Prodotto extra', 'Prodotto 101'),
(102, 10, 1, 'Prodotto extra', 'Prodotto 102'),
(103, 10, 1, 'Prodotto extra', 'Prodotto 103'),
(104, 10, 1, 'Prodotto extra', 'Prodotto 104'),
(105, 10, 1, 'Prodotto extra', 'Prodotto 105'),
(106, 10, 1, 'Prodotto extra', 'Prodotto 106'),
(107, 10, 1, 'Prodotto extra', 'Prodotto 107'),
(108, 10, 1, 'Prodotto extra', 'Prodotto 108'),
(109, 10, 1, 'Prodotto extra', 'Prodotto 109'),
(110, 10, 1, 'Prodotto extra', 'Prodotto 110'),
(111, 10, 1, 'Prodotto extra', 'Prodotto 111'),
(112, 10, 1, 'Prodotto extra', 'Prodotto 112'),
(113, 10, 1, 'Prodotto extra', 'Prodotto 113'),
(114, 10, 1, 'Prodotto extra', 'Prodotto 114'),
(115, 10, 1, 'Prodotto extra', 'Prodotto 115'),
(116, 10, 1, 'Prodotto extra', 'Prodotto 116'),
(117, 10, 1, 'Prodotto extra', 'Prodotto 117'),
(118, 10, 1, 'Prodotto extra', 'Prodotto 118'),
(119, 10, 1, 'Prodotto extra', 'Prodotto 119'),
(120, 10, 1, 'Prodotto extra', 'Prodotto 120'),
(121, 10, 1, 'Prodotto extra', 'Prodotto 121'),
(122, 10, 1, 'Prodotto extra', 'Prodotto 122'),
(123, 10, 1, 'Prodotto extra', 'Prodotto 123'),
(124, 10, 1, 'Prodotto extra', 'Prodotto 124'),
(125, 10, 1, 'Prodotto extra', 'Prodotto 125'),
(126, 10, 1, 'Prodotto extra', 'Prodotto 126'),
(127, 10, 1, 'Prodotto extra', 'Prodotto 127'),
(128, 10, 1, 'Prodotto extra', 'Prodotto 128'),
(129, 10, 1, 'Prodotto extra', 'Prodotto 129'),
(130, 10, 1, 'Prodotto extra', 'Prodotto 130'),
(131, 10, 1, 'Prodotto extra', 'Prodotto 131'),
(132, 10, 1, 'Prodotto extra', 'Prodotto 132'),
(133, 10, 1, 'Prodotto extra', 'Prodotto 133'),
(134, 10, 1, 'Prodotto extra', 'Prodotto 134'),
(135, 10, 1, 'Prodotto extra', 'Prodotto 135'),
(136, 10, 1, 'Prodotto extra', 'Prodotto 136'),
(137, 10, 1, 'Prodotto extra', 'Prodotto 137'),
(138, 10, 1, 'Prodotto extra', 'Prodotto 138'),
(139, 10, 1, 'Prodotto extra', 'Prodotto 139'),
(140, 10, 1, 'Prodotto extra', 'Prodotto 140'),
(141, 10, 1, 'Prodotto extra', 'Prodotto 141'),
(142, 10, 1, 'Prodotto extra', 'Prodotto 142'),
(143, 10, 1, 'Prodotto extra', 'Prodotto 143'),
(144, 10, 1, 'Prodotto extra', 'Prodotto 144'),
(145, 10, 1, 'Prodotto extra', 'Prodotto 145'),
(146, 10, 1, 'Prodotto extra', 'Prodotto 146'),
(147, 10, 1, 'Prodotto extra', 'Prodotto 147'),
(148, 10, 1, 'Prodotto extra', 'Prodotto 148'),
(149, 10, 1, 'Prodotto extra', 'Prodotto 149'),
(150, 10, 1, 'Prodotto extra', 'Prodotto 150'),
(151, 10, 1, 'Prodotto extra', 'Prodotto 151'),
(152, 10, 1, 'Prodotto extra', 'Prodotto 152'),
(153, 10, 1, 'Prodotto extra', 'Prodotto 153'),
(154, 10, 1, 'Prodotto extra', 'Prodotto 154'),
(155, 10, 1, 'Prodotto extra', 'Prodotto 155'),
(156, 10, 1, 'Prodotto extra', 'Prodotto 156'),
(157, 10, 1, 'Prodotto extra', 'Prodotto 157'),
(158, 10, 1, 'Prodotto extra', 'Prodotto 158'),
(159, 10, 1, 'Prodotto extra', 'Prodotto 159');

-- --------------------------------------------------------

--
-- Struttura della tabella `Ricette`
--

CREATE TABLE `Ricette` (
  `Tipologia` varchar(50) NOT NULL,
  `Id` int(11) NOT NULL,
  `Qta` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Ricette`
--

INSERT INTO `Ricette` (`Tipologia`, `Id`, `Qta`) VALUES
('Additivo X', 1, 0.10),
('Cacao', 2, 0.30),
('Latte Intero', 1, 2.00),
('Latte Intero', 2, 2.00),
('Panna Fresca', 1, 0.80),
('Panna Fresca', 2, 0.70),
('Panna Fresca', 3, 1.00),
('Vaniglia', 1, 0.05),
('Zucchero', 1, 0.50),
('Zucchero', 2, 0.50),
('Zucchero', 3, 0.10);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `Dipendenti`
--
ALTER TABLE `Dipendenti`
  ADD PRIMARY KEY (`Matricola`),
  ADD UNIQUE KEY `CF` (`CF`);

--
-- Indici per le tabelle `Magazzini`
--
ALTER TABLE `Magazzini`
  ADD PRIMARY KEY (`Codice`);

--
-- Indici per le tabelle `MateriePrime`
--
ALTER TABLE `MateriePrime`
  ADD PRIMARY KEY (`Tipologia`),
  ADD KEY `Codice` (`Codice`);

--
-- Indici per le tabelle `Prodotti`
--
ALTER TABLE `Prodotti`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Codice` (`Codice`),
  ADD KEY `Matricola` (`Matricola`);

--
-- Indici per le tabelle `Ricette`
--
ALTER TABLE `Ricette`
  ADD PRIMARY KEY (`Tipologia`,`Id`),
  ADD KEY `Id` (`Id`);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `MateriePrime`
--
ALTER TABLE `MateriePrime`
  ADD CONSTRAINT `MateriePrime_ibfk_1` FOREIGN KEY (`Codice`) REFERENCES `Magazzini` (`Codice`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limiti per la tabella `Prodotti`
--
ALTER TABLE `Prodotti`
  ADD CONSTRAINT `Prodotti_ibfk_1` FOREIGN KEY (`Codice`) REFERENCES `Magazzini` (`Codice`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `Prodotti_ibfk_2` FOREIGN KEY (`Matricola`) REFERENCES `Dipendenti` (`Matricola`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limiti per la tabella `Ricette`
--
ALTER TABLE `Ricette`
  ADD CONSTRAINT `Ricette_ibfk_1` FOREIGN KEY (`Tipologia`) REFERENCES `MateriePrime` (`Tipologia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Ricette_ibfk_2` FOREIGN KEY (`Id`) REFERENCES `Prodotti` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
