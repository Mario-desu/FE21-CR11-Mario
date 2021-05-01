-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 01. Mai 2021 um 17:15
-- Server-Version: 10.4.18-MariaDB
-- PHP-Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `cr11_petadoption_mario`
--
CREATE DATABASE IF NOT EXISTS `cr11_petadoption_mario` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cr11_petadoption_mario`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `animals`
--

CREATE TABLE `animals` (
  `animalId` int(11) NOT NULL,
  `anName` varchar(255) NOT NULL,
  `breed` varchar(55) NOT NULL,
  `anLocation` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `hobbies` varchar(255) NOT NULL,
  `anAge` int(11) NOT NULL,
  `anImage` varchar(255) DEFAULT NULL,
  `fk_sizeId` int(11) NOT NULL,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `animals`
--

INSERT INTO `animals` (`animalId`, `anName`, `breed`, `anLocation`, `description`, `hobbies`, `anAge`, `anImage`, `fk_sizeId`, `status`) VALUES
(5, 'Leo', 'Balinese', 'Wagramer Straße 34, 1220 Wien', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', 'adopted', 4, '608c649a0bbc8.jpg', 1, 'available'),
(8, 'Sheila', 'Bengal ', 'Stephansplatz 5, 1010 Wien', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam', 'Climbing on trees, hunting cats', 9, '608c65fc73540.jpg', 2, 'adopted'),
(11, 'Lucy', 'Maine Coon', 'Hauptplatz 5, 3100 St. Pölten', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam', 'adopted', 12, '608c66f7301dc.jpg', 2, 'adopted'),
(12, 'Buddy', 'Chihuahua', 'Oberlaaer Straße 10, 1100 Wien', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam', 'Climbing on trees, hunting cats', 2, '608c676a14a7e.jpg', 1, 'adopted'),
(13, 'Luna', 'Husky ', 'Hauptplatz 20, 3910 Zwettl', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam', 'walking, playing with a stick', 14, '608c68341c589.jpg', 2, 'available'),
(14, 'Oscar', 'Labrador Retriever', 'Prager Straße 135, 1210 Wien', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam', 'walking, playing with a stick', 4, '608c68d5ad625.jpg', 2, 'available'),
(15, 'Medusa', 'Green Mamba', 'Stadionstraße 20, 2700 Wiener Neustadt', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam', 'Climbing on trees, hunting cats', 28, '608c694842d0e.jpg', 1, 'adopted'),
(17, 'Pat', 'Parrot', 'Margaretenstraße 120, 1050 Wien', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam', 'Climbing on trees, hunting cats', 9, '608c6b8776b72.png', 1, 'adopted');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `petadoption`
--

CREATE TABLE `petadoption` (
  `adoptId` int(11) NOT NULL,
  `fk_userId` int(11) NOT NULL,
  `fk_animalId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `petadoption`
--

INSERT INTO `petadoption` (`adoptId`, `fk_userId`, `fk_animalId`) VALUES
(9, 1, 5),
(18, 8, 12),
(31, 1, 15),
(35, 1, 11),
(38, 1, 17);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `size`
--

CREATE TABLE `size` (
  `sizeId` int(11) NOT NULL,
  `size` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `size`
--

INSERT INTO `size` (`sizeId`, `size`) VALUES
(1, 'small'),
(2, 'large');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` varchar(4) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `f_name`, `l_name`, `pass`, `date_of_birth`, `email`, `image`, `status`) VALUES
(1, 'Mario', 'Hartleb', '1ad4ab0a74a2483318322183d0807282f01f2d8ba6779fd6bd28d871f06885b0', '1985-04-17', 'mario@gmail.com', 'avatar.png', 'adm'),
(7, 'John', 'Jackson', '68482803aaba8275b96565b25ecabcdc475b21b08b7ff09e018f9e798a5b9bda', '1978-03-03', 'john@mail.com', '608c6cfdac5d6.png', 'user'),
(8, 'Angela', 'Christensen', '2cfd778443b2b012024c6edadd6d6fcab8bc09ff47297ed213530f5c3d5bccb4', '1989-03-25', 'angela@mail.com', '608c6e62f035b.jpg', 'user'),
(9, 'Michael', 'Smith', '2be07a0aeb50d4f397bf7e11dadd6a05c9523076939ada85ee372f3b97e48381', '1989-07-06', 'michael@mail.com', '608c700289e04.jpg', 'user');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`animalId`),
  ADD KEY `fk_sizeId` (`fk_sizeId`);

--
-- Indizes für die Tabelle `petadoption`
--
ALTER TABLE `petadoption`
  ADD PRIMARY KEY (`adoptId`),
  ADD KEY `fk_userId` (`fk_userId`),
  ADD KEY `fk_animalId` (`fk_animalId`);

--
-- Indizes für die Tabelle `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`sizeId`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `animals`
--
ALTER TABLE `animals`
  MODIFY `animalId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT für Tabelle `petadoption`
--
ALTER TABLE `petadoption`
  MODIFY `adoptId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT für Tabelle `size`
--
ALTER TABLE `size`
  MODIFY `sizeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `animals`
--
ALTER TABLE `animals`
  ADD CONSTRAINT `animals_ibfk_1` FOREIGN KEY (`fk_sizeId`) REFERENCES `size` (`sizeId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `petadoption`
--
ALTER TABLE `petadoption`
  ADD CONSTRAINT `petadoption_ibfk_1` FOREIGN KEY (`fk_userId`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `petadoption_ibfk_2` FOREIGN KEY (`fk_animalId`) REFERENCES `animals` (`animalId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
