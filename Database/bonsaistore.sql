-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Apr 04, 2023 alle 09:58
-- Versione del server: 10.4.27-MariaDB
-- Versione PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bonsaistore`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `acquisti`
--

CREATE TABLE `acquisti` (
  `id` int(11) NOT NULL,
  `usr` text NOT NULL,
  `idprod` int(11) NOT NULL,
  `data` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotti`
--

CREATE TABLE `prodotti` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `prezzo` float NOT NULL,
  `nomeimg` varchar(10) NOT NULL,
  `promo` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `prodotti`
--

INSERT INTO `prodotti` (`id`, `nome`, `prezzo`, `nomeimg`, `promo`) VALUES
(1, 'Olmo Bonsai', 15, 'b1.jpg', 0),
(2, 'Ficus Bonsai', 25, 'b2.jpg', 1),
(3, 'Olivo Bonsai', 35, 'b3.jpg', 1),
(4, 'Quercia Bonsai', 120, 'b4.jpg', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `username` text NOT NULL,
  `password` text NOT NULL,
  `nome` text NOT NULL,
  `cognome` text NOT NULL,
  `datanascita` date NOT NULL,
  `indirizzo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`username`, `password`, `nome`, `cognome`, `datanascita`, `indirizzo`) VALUES
('admin', 'admin', 'amministratore', 'amministratore', '2000-04-29', 'via Campus 1 PR'),
('a', 'a', 'a', 'a', '2013-04-03', 'a'),
('elia2904', 'e', 'elia', 'candida', '2000-04-29', 'via campus 2 PR');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `acquisti`
--
ALTER TABLE `acquisti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreignbonsai` (`idprod`);

--
-- Indici per le tabelle `prodotti`
--
ALTER TABLE `prodotti`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD UNIQUE KEY `username` (`username`) USING HASH;

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `prodotti`
--
ALTER TABLE `prodotti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `acquisti`
--
ALTER TABLE `acquisti`
  ADD CONSTRAINT `foreignbonsai` FOREIGN KEY (`idprod`) REFERENCES `prodotti` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
