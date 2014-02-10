-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 10 Février 2014 à 22:44
-- Version du serveur: 5.5.33
-- Version de PHP: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `myschool`
--

-- --------------------------------------------------------

--
-- Structure de la table `ETABLISSEMENT`
--

CREATE TABLE `ETABLISSEMENT` (
  `ID_ETABLISSEMENT` int(11) NOT NULL AUTO_INCREMENT,
  `NOM` text CHARACTER SET latin1 NOT NULL,
  `ADRESSE` text CHARACTER SET latin1 NOT NULL,
  `CODE_POSTAL` text CHARACTER SET latin1 NOT NULL,
  `VILLE` text CHARACTER SET latin1 NOT NULL,
  `TELEPHONE_1` text CHARACTER SET latin1,
  `TELEPHONE_2` text CHARACTER SET latin1,
  `FAX` text CHARACTER SET latin1,
  `IMAGE_PRINCIPALE` text CHARACTER SET utf8,
  `IMAGE_FOND` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`ID_ETABLISSEMENT`),
  KEY `ID_ETABLISSEMENT` (`ID_ETABLISSEMENT`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Contenu de la table `ETABLISSEMENT`
--

INSERT INTO `ETABLISSEMENT` (`ID_ETABLISSEMENT`, `NOM`, `ADRESSE`, `CODE_POSTAL`, `VILLE`, `TELEPHONE_1`, `TELEPHONE_2`, `FAX`, `IMAGE_PRINCIPALE`, `IMAGE_FOND`) VALUES
(2, 'Lycée saint Martin 2', '29 rue d''entrain 2', '35000', 'Rennes', '02.99.01.02.03', '02.99.00.00.00', '02.99.01.02.05', 'Alesk.JPG', 'P1010346.JPG');
