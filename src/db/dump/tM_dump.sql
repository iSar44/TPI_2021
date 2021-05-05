-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 05, 2021 at 02:07 PM
-- Server version: 10.3.27-MariaDB-0+deb10u1
-- PHP Version: 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tournamentManager`
--
DROP DATABASE IF EXISTS `tournamentManager`;
CREATE DATABASE IF NOT EXISTS `tournamentManager` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `tournamentManager`;

-- --------------------------------------------------------

--
-- Table structure for table `EQUIPE`
--

CREATE TABLE `EQUIPE` (
  `ID` int(11) NOT NULL,
  `NOM_EQUIPE` varchar(50) NOT NULL,
  `UTILISATEUR_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `RESULTAT`
--

CREATE TABLE `RESULTAT` (
  `ID` int(11) NOT NULL,
  `NB_POINTS` int(11) NOT NULL,
  `EQUIPE_ID` int(11) NOT NULL,
  `RONDE_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `RONDE`
--

CREATE TABLE `RONDE` (
  `ID` int(11) NOT NULL,
  `ETAPE` int(11) NOT NULL,
  `NB_MATCH` int(11) NOT NULL,
  `TEMPS_PREPARATION` int(11) NOT NULL,
  `TOURNOI_ID` int(11) NOT NULL,
  `VAINQUEUR_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `TOURNOIS`
--

CREATE TABLE `TOURNOIS` (
  `ID` int(11) NOT NULL,
  `TITRE` varchar(50) NOT NULL,
  `DESCRIPTION` varchar(100) NOT NULL,
  `DATE_HEURE_DEMARRAGE` datetime NOT NULL,
  `NB_EQUIPES` int(2) NOT NULL,
  `DATE_HEURE_DEBUT_INSCRIPTION` datetime NOT NULL,
  `DATE_HEURE_FIN_INSCRIPTION` datetime NOT NULL,
  `TEMPS_ENTRE_RONDES` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `UTILISATEUR`
--

CREATE TABLE `UTILISATEUR` (
  `ID` int(11) NOT NULL,
  `NICKNAME` varchar(30) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `MDP` varchar(255) NOT NULL,
  `ADMIN` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `EQUIPE`
--
ALTER TABLE `EQUIPE`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `UTILISATEUR_ID` (`UTILISATEUR_ID`);

--
-- Indexes for table `RESULTAT`
--
ALTER TABLE `RESULTAT`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `EQUIPE_ID` (`EQUIPE_ID`),
  ADD UNIQUE KEY `RONDE_ID` (`RONDE_ID`);

--
-- Indexes for table `RONDE`
--
ALTER TABLE `RONDE`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `TOURNOI_ID` (`TOURNOI_ID`),
  ADD UNIQUE KEY `VAINQUEUR_ID` (`VAINQUEUR_ID`);

--
-- Indexes for table `TOURNOIS`
--
ALTER TABLE `TOURNOIS`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `UTILISATEUR`
--
ALTER TABLE `UTILISATEUR`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `EQUIPE`
--
ALTER TABLE `EQUIPE`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `RESULTAT`
--
ALTER TABLE `RESULTAT`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `RONDE`
--
ALTER TABLE `RONDE`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `TOURNOIS`
--
ALTER TABLE `TOURNOIS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `UTILISATEUR`
--
ALTER TABLE `UTILISATEUR`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `EQUIPE`
--
ALTER TABLE `EQUIPE`
  ADD CONSTRAINT `EQUIPE_ibfk_1` FOREIGN KEY (`UTILISATEUR_ID`) REFERENCES `UTILISATEUR` (`ID`);

--
-- Constraints for table `RESULTAT`
--
ALTER TABLE `RESULTAT`
  ADD CONSTRAINT `RESULTAT_ibfk_1` FOREIGN KEY (`EQUIPE_ID`) REFERENCES `EQUIPE` (`ID`),
  ADD CONSTRAINT `RESULTAT_ibfk_2` FOREIGN KEY (`RONDE_ID`) REFERENCES `RONDE` (`ID`);

--
-- Constraints for table `RONDE`
--
ALTER TABLE `RONDE`
  ADD CONSTRAINT `RONDE_ibfk_1` FOREIGN KEY (`TOURNOI_ID`) REFERENCES `TOURNOIS` (`ID`),
  ADD CONSTRAINT `RONDE_ibfk_2` FOREIGN KEY (`VAINQUEUR_ID`) REFERENCES `EQUIPE` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
