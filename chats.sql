-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 06. Feb 2021 um 13:12
-- Server-Version: 10.4.17-MariaDB
-- PHP-Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `messenger`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `chats`
--

CREATE TABLE `chats` (
  `ChatID` varchar(80) NOT NULL,
  `message` blob DEFAULT NULL,
  `randNum` tinytext DEFAULT NULL,
  `Stat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `chats`
--

INSERT INTO `chats` (`ChatID`, `message`, `randNum`, `Stat`) VALUES
('5ed31b985b6d1d524fccdeb4ec7b86675e5d56f4', NULL, '6128cbf7181a97c407dd920d57b64a2e59904ca9', '1');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`ChatID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
