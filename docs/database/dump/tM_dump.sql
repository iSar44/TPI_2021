CREATE DATABASE  IF NOT EXISTS `tournamentmanager` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `tournamentmanager`;
-- MySQL dump 10.13  Distrib 8.0.24, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: tournamentmanager
-- ------------------------------------------------------
-- Server version	8.0.21

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `equipe`
--

DROP TABLE IF EXISTS `equipe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `equipe` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `NOM_EQUIPE` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `UTILISATEUR_ID` int NOT NULL,
  `MATCHES_ID` int NOT NULL,
  PRIMARY KEY (`ID`,`UTILISATEUR_ID`,`MATCHES_ID`),
  KEY `fk_EQUIPE_UTILISATEUR1_idx` (`UTILISATEUR_ID`),
  KEY `fk_EQUIPE_MATCHES1_idx` (`MATCHES_ID`),
  CONSTRAINT `fk_EQUIPE_MATCHES1` FOREIGN KEY (`MATCHES_ID`) REFERENCES `matches` (`ID`),
  CONSTRAINT `fk_EQUIPE_UTILISATEUR1` FOREIGN KEY (`UTILISATEUR_ID`) REFERENCES `utilisateur` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `matches`
--

DROP TABLE IF EXISTS `matches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `matches` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `VAINQUEUR_ID` int NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_idx` (`VAINQUEUR_ID`),
  CONSTRAINT `ID` FOREIGN KEY (`VAINQUEUR_ID`) REFERENCES `equipe` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ronde`
--

DROP TABLE IF EXISTS `ronde`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ronde` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `ETAPE` int NOT NULL,
  `NB_MATCHES` int NOT NULL,
  `TEMPS_PREPARATION` time NOT NULL,
  `TOURNOIS_ID` int NOT NULL,
  PRIMARY KEY (`ID`,`TOURNOIS_ID`),
  KEY `fk_RONDE_TOURNOIS1_idx` (`TOURNOIS_ID`),
  CONSTRAINT `fk_RONDE_TOURNOIS1` FOREIGN KEY (`TOURNOIS_ID`) REFERENCES `tournois` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ronde_has_matches`
--

DROP TABLE IF EXISTS `ronde_has_matches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ronde_has_matches` (
  `RONDE_ID` int NOT NULL,
  `MATCHES_ID` int NOT NULL,
  PRIMARY KEY (`RONDE_ID`,`MATCHES_ID`),
  KEY `fk_RONDE_has_MATCHES_MATCHES1_idx` (`MATCHES_ID`),
  KEY `fk_RONDE_has_MATCHES_RONDE1_idx` (`RONDE_ID`),
  CONSTRAINT `fk_RONDE_has_MATCHES_MATCHES1` FOREIGN KEY (`MATCHES_ID`) REFERENCES `matches` (`ID`),
  CONSTRAINT `fk_RONDE_has_MATCHES_RONDE1` FOREIGN KEY (`RONDE_ID`) REFERENCES `ronde` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tournois`
--

DROP TABLE IF EXISTS `tournois`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tournois` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `TITRE` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `DESCRIPTION` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `DATE_HEURE_DEMARRAGE` datetime NOT NULL,
  `NB_EQUIPES` int NOT NULL,
  `DATE_HEURE_DEBUT_INSCRIPTION` datetime NOT NULL,
  `DATE_HEURE_FIN_INSCRIPTION` datetime NOT NULL,
  `TEMPS_ENTRE_RONDES` time DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `utilisateur` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `NICKNAME` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `EMAIL` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `MDP` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ADMIN` tinyint NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-05-06 20:18:24
