-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 17, 2014 at 11:45 PM
-- Server version: 5.5.33
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `myschool`
--

-- --------------------------------------------------------

--
-- Table structure for table `ACTIVATION`
--

CREATE TABLE `ACTIVATION` (
  `ID_USER` int(11) NOT NULL,
  `TOKEN` text NOT NULL,
  KEY `ID_USER_ACTIVATION` (`ID_USER`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `CLASSE`
--

CREATE TABLE `CLASSE` (
  `ID_CLASSE` int(11) NOT NULL AUTO_INCREMENT,
  `ID_NIVEAU` int(11) DEFAULT NULL,
  `NOM` text,
  `CODE_ELEVE` varchar(8) NOT NULL,
  `CODE_ENSEIGNANT` varchar(8) NOT NULL,
  PRIMARY KEY (`ID_CLASSE`),
  KEY `FK_RELATION_2` (`ID_NIVEAU`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `CLASSE`
--

INSERT INTO `CLASSE` (`ID_CLASSE`, `ID_NIVEAU`, `NOM`, `CODE_ELEVE`, `CODE_ENSEIGNANT`) VALUES
(31, 15, 'Seconde 1', 'HOMwFdMk', 'uwGpxVAO'),
(32, 15, 'Seconde 2', 'OFcevxCD', 'VRZeQpcK'),
(33, 19, 'Premiere 1', 'MnkjK46a', '2WSOwDcy'),
(34, 19, 'Premiere 2', 'WuJUEAcg', 'eBvXGgfh');

-- --------------------------------------------------------

--
-- Table structure for table `COMMENTAIRE`
--

CREATE TABLE `COMMENTAIRE` (
  `ID_COMMENTAIRE` int(11) NOT NULL AUTO_INCREMENT,
  `ID_POST` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `CONTENU` text NOT NULL,
  `DATE_CREATION` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID_COMMENTAIRE`),
  KEY `INDEX_COMMENTAIRE_POST` (`ID_POST`),
  KEY `INDEX_COMMENTAIRE_USER` (`ID_USER`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=71 ;

--
-- Dumping data for table `COMMENTAIRE`
--

INSERT INTO `COMMENTAIRE` (`ID_COMMENTAIRE`, `ID_POST`, `ID_USER`, `CONTENU`, `DATE_CREATION`) VALUES
(70, 60, 5, 'test', '2014-02-15 22:46:14');

-- --------------------------------------------------------

--
-- Table structure for table `ETABLISSEMENT`
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
-- Dumping data for table `ETABLISSEMENT`
--

INSERT INTO `ETABLISSEMENT` (`ID_ETABLISSEMENT`, `NOM`, `ADRESSE`, `CODE_POSTAL`, `VILLE`, `TELEPHONE_1`, `TELEPHONE_2`, `FAX`, `IMAGE_PRINCIPALE`, `IMAGE_FOND`) VALUES
(2, 'Lycée saint Martin 2', '29 rue d''entrain 2', '35000', 'Rennes', '02.99.01.02.03', '02.99.00.00.00', '02.99.01.02.05', 'Alesk.JPG', 'P1000603.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `NIVEAU`
--

CREATE TABLE `NIVEAU` (
  `ID_NIVEAU` int(11) NOT NULL AUTO_INCREMENT,
  `ID_ETABLISSEMENT` int(11) DEFAULT NULL,
  `NOM` text NOT NULL,
  PRIMARY KEY (`ID_NIVEAU`),
  KEY `ID_ETABLISSEMENT` (`ID_ETABLISSEMENT`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `NIVEAU`
--

INSERT INTO `NIVEAU` (`ID_NIVEAU`, `ID_ETABLISSEMENT`, `NOM`) VALUES
(15, 2, 'Seconde'),
(19, 2, 'Premiere');

-- --------------------------------------------------------

--
-- Table structure for table `PIECE_JOINTE`
--

CREATE TABLE `PIECE_JOINTE` (
  `ID_PJ` int(11) NOT NULL AUTO_INCREMENT,
  `ID_POST` int(11) NOT NULL,
  `CONTENT_TYPE` varchar(52) NOT NULL,
  `PATH` text NOT NULL,
  PRIMARY KEY (`ID_PJ`),
  KEY `ID_POST` (`ID_POST`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `PIECE_JOINTE`
--

INSERT INTO `PIECE_JOINTE` (`ID_PJ`, `ID_POST`, `CONTENT_TYPE`, `PATH`) VALUES
(11, 58, 'image/png', 'ouestu_114.png'),
(12, 58, 'image/png', 'tourdegarde_retina.png'),
(13, 58, 'image/jpeg', 'Carte identite Guillaume.jpeg'),
(14, 58, 'application/pdf', 'Panier - IKEA.pdf'),
(24, 60, 'image/jpeg', 'P1050146.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `POST`
--

CREATE TABLE `POST` (
  `ID_POST` int(11) NOT NULL AUTO_INCREMENT,
  `ID_USER` int(11) DEFAULT NULL,
  `DATE_CREATION` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DATE_DERNIERE_MODIFICATION` timestamp NULL DEFAULT NULL,
  `CONTENU` text NOT NULL,
  `COMMENTAIRES_ACTIVES` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID_POST`),
  KEY `FK_CREATEUR` (`ID_USER`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=88 ;

--
-- Dumping data for table `POST`
--

INSERT INTO `POST` (`ID_POST`, `ID_USER`, `DATE_CREATION`, `DATE_DERNIERE_MODIFICATION`, `CONTENU`, `COMMENTAIRES_ACTIVES`) VALUES
(58, 5, '2014-02-07 23:19:40', '2014-02-09 11:11:17', '<p>test</p>', 1),
(60, 5, '2014-02-09 15:22:50', '2014-02-16 18:03:59', '<p>test photo</p>', 1),
(77, 5, '2014-02-17 22:30:18', NULL, '<p>sdqsdqsdqs</p>', 1),
(78, 5, '2014-02-17 22:32:17', NULL, '<p>yalahhhhh</p>', 1),
(79, 19, '2014-02-17 22:33:52', NULL, '<p>super !!!!!</p>', 1),
(80, 19, '2014-02-17 22:34:42', NULL, '<p>message pour tous les Premiere</p>', 1),
(81, 19, '2014-02-17 22:35:28', NULL, '<p>message pour tous les Premiere et l''etalissement</p>', 1),
(82, 19, '2014-02-17 22:36:27', NULL, '<p>message pour tous l''etalissement</p>', 1),
(83, 19, '2014-02-17 22:37:14', NULL, '<p>message pour tous l''etalissement et les premiere</p>', 1),
(84, 19, '2014-02-17 22:38:58', NULL, '<p>message etalissement et premiere</p>', 1),
(85, 19, '2014-02-17 22:41:13', NULL, '<p>re test</p>', 1),
(86, 19, '2014-02-17 22:43:01', NULL, '<p>super test</p>', 1),
(87, 19, '2014-02-17 22:43:50', NULL, '<p>super test premiere 1</p>', 1);

--
-- Triggers `POST`
--
DROP TRIGGER IF EXISTS `UPDATE_POST_TIMESTAMP`;
DELIMITER //
CREATE TRIGGER `UPDATE_POST_TIMESTAMP` BEFORE UPDATE ON `POST`
 FOR EACH ROW SET NEW.DATE_DERNIERE_MODIFICATION = NOW()
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `POST_CLASSE`
--

CREATE TABLE `POST_CLASSE` (
  `ID_POST` int(11) NOT NULL,
  `ID_CLASSE` int(11) NOT NULL,
  PRIMARY KEY (`ID_POST`,`ID_CLASSE`),
  KEY `FK_POST_CLASSE2` (`ID_CLASSE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `POST_CLASSE`
--

INSERT INTO `POST_CLASSE` (`ID_POST`, `ID_CLASSE`) VALUES
(87, 34);

-- --------------------------------------------------------

--
-- Table structure for table `POST_ETABLISSEMENT`
--

CREATE TABLE `POST_ETABLISSEMENT` (
  `ID_POST` int(11) NOT NULL,
  `ID_ETABLISSEMENT` int(11) NOT NULL,
  PRIMARY KEY (`ID_POST`,`ID_ETABLISSEMENT`),
  KEY `FK_POST_ETABLISSEMENT2` (`ID_ETABLISSEMENT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `POST_ETABLISSEMENT`
--

INSERT INTO `POST_ETABLISSEMENT` (`ID_POST`, `ID_ETABLISSEMENT`) VALUES
(77, 2),
(78, 2),
(79, 2),
(81, 2),
(82, 2),
(83, 2),
(84, 2),
(85, 2),
(86, 2);

-- --------------------------------------------------------

--
-- Table structure for table `POST_NIVEAU`
--

CREATE TABLE `POST_NIVEAU` (
  `ID_POST` int(11) NOT NULL,
  `ID_NIVEAU` int(11) NOT NULL,
  PRIMARY KEY (`ID_POST`,`ID_NIVEAU`),
  KEY `FK_POST_NIVEAU2` (`ID_NIVEAU`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `POST_NIVEAU`
--

INSERT INTO `POST_NIVEAU` (`ID_POST`, `ID_NIVEAU`) VALUES
(80, 19),
(81, 19),
(83, 19),
(84, 19),
(85, 19),
(86, 19);

-- --------------------------------------------------------

--
-- Table structure for table `TYPE_UTILISATEUR`
--

CREATE TABLE `TYPE_UTILISATEUR` (
  `ID_TYPE_UTILISATEUR` int(11) NOT NULL,
  `VALEUR` text NOT NULL,
  `LIBELLE` text NOT NULL,
  PRIMARY KEY (`ID_TYPE_UTILISATEUR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TYPE_UTILISATEUR`
--

INSERT INTO `TYPE_UTILISATEUR` (`ID_TYPE_UTILISATEUR`, `VALEUR`, `LIBELLE`) VALUES
(1, 'DIRECTION', 'Direction'),
(2, 'ENSEIGNANT', 'Enseignant'),
(3, 'ELEVE', 'Elève'),
(4, 'PARENT_ELEVE', 'Parent');

-- --------------------------------------------------------

--
-- Table structure for table `UTILISATEUR`
--

CREATE TABLE `UTILISATEUR` (
  `ID_USER` int(11) NOT NULL AUTO_INCREMENT,
  `ID_ETABLISSEMENT` int(11) DEFAULT NULL,
  `NOM` text NOT NULL,
  `PRENOM` text NOT NULL,
  `LOGIN` text NOT NULL,
  `MOT_DE_PASSE` text,
  `AVATAR` text,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `LOGIN_TOKEN` text NOT NULL,
  PRIMARY KEY (`ID_USER`),
  KEY `ID_ETABLISSEMENT` (`ID_ETABLISSEMENT`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `UTILISATEUR`
--

INSERT INTO `UTILISATEUR` (`ID_USER`, `ID_ETABLISSEMENT`, `NOM`, `PRENOM`, `LOGIN`, `MOT_DE_PASSE`, `AVATAR`, `active`, `LOGIN_TOKEN`) VALUES
(5, 2, 'SOURDRILLE', 'Guillaume', 'gsourdrille@gmail.com', 'fc2789a2f2f3303f7322efa51bb5882fe034a321', 'P1000590.JPG', 1, 'd43ad6656739265566acdee5d843896cbbaf170a'),
(19, 2, 'Enseignant', 'Premiere', 'enseignant1@yopmail.com', '7e240de74fb1ed08fa08d38063f6a6a91462a815', NULL, 1, ''),
(20, 2, 'Enseignant', 'Seconde', 'enseignant2@yopmail.com', '7e240de74fb1ed08fa08d38063f6a6a91462a815', NULL, 1, ''),
(21, 2, 'Eleve', 'Seconde1', 'eleve1@yopmail.com', '7e240de74fb1ed08fa08d38063f6a6a91462a815', NULL, 1, ''),
(22, 2, 'Eleve', 'Premiere2', 'eleve2@yopmail.com', '7e240de74fb1ed08fa08d38063f6a6a91462a815', NULL, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `UTILISATEUR_CLASSE`
--

CREATE TABLE `UTILISATEUR_CLASSE` (
  `ID_CLASSE` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  PRIMARY KEY (`ID_CLASSE`,`ID_USER`),
  KEY `FK_UTILISATEUR_CLASSE2` (`ID_USER`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `UTILISATEUR_CLASSE`
--

INSERT INTO `UTILISATEUR_CLASSE` (`ID_CLASSE`, `ID_USER`) VALUES
(33, 19),
(34, 19),
(31, 20),
(32, 20),
(31, 21),
(34, 22);

-- --------------------------------------------------------

--
-- Table structure for table `UTILISATEUR_NIVEAU`
--

CREATE TABLE `UTILISATEUR_NIVEAU` (
  `ID_NIVEAU` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  PRIMARY KEY (`ID_NIVEAU`,`ID_USER`),
  KEY `FK_UTILISATEUR_NIVEAU2` (`ID_USER`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `UTILISATEUR_TYPE_UTILISATEUR`
--

CREATE TABLE `UTILISATEUR_TYPE_UTILISATEUR` (
  `ID_USER` int(11) NOT NULL,
  `ID_TYPE_UTILISATEUR` int(11) NOT NULL,
  PRIMARY KEY (`ID_USER`,`ID_TYPE_UTILISATEUR`),
  KEY `FK_UTILISATEUR_TYPE_UTILISATE2` (`ID_TYPE_UTILISATEUR`),
  KEY `ID_USER` (`ID_USER`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `UTILISATEUR_TYPE_UTILISATEUR`
--

INSERT INTO `UTILISATEUR_TYPE_UTILISATEUR` (`ID_USER`, `ID_TYPE_UTILISATEUR`) VALUES
(5, 1),
(19, 2),
(20, 2),
(21, 3),
(22, 3);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ACTIVATION`
--
ALTER TABLE `ACTIVATION`
  ADD CONSTRAINT `activation_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `UTILISATEUR` (`ID_USER`) ON DELETE CASCADE;

--
-- Constraints for table `CLASSE`
--
ALTER TABLE `CLASSE`
  ADD CONSTRAINT `FK_RELATION_2` FOREIGN KEY (`ID_NIVEAU`) REFERENCES `NIVEAU` (`ID_NIVEAU`) ON DELETE CASCADE;

--
-- Constraints for table `COMMENTAIRE`
--
ALTER TABLE `COMMENTAIRE`
  ADD CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`ID_POST`) REFERENCES `POST` (`ID_POST`) ON DELETE CASCADE,
  ADD CONSTRAINT `commentaire_ibfk_2` FOREIGN KEY (`ID_USER`) REFERENCES `UTILISATEUR` (`ID_USER`) ON DELETE CASCADE;

--
-- Constraints for table `NIVEAU`
--
ALTER TABLE `NIVEAU`
  ADD CONSTRAINT `niveau_ibfk_1` FOREIGN KEY (`ID_ETABLISSEMENT`) REFERENCES `ETABLISSEMENT` (`ID_ETABLISSEMENT`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `PIECE_JOINTE`
--
ALTER TABLE `PIECE_JOINTE`
  ADD CONSTRAINT `piece_jointe_ibfk_1` FOREIGN KEY (`ID_POST`) REFERENCES `POST` (`ID_POST`) ON DELETE CASCADE;

--
-- Constraints for table `POST`
--
ALTER TABLE `POST`
  ADD CONSTRAINT `FK_CREATEUR` FOREIGN KEY (`ID_USER`) REFERENCES `UTILISATEUR` (`ID_USER`);

--
-- Constraints for table `POST_CLASSE`
--
ALTER TABLE `POST_CLASSE`
  ADD CONSTRAINT `FK_POST_CLASSE` FOREIGN KEY (`ID_POST`) REFERENCES `POST` (`ID_POST`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_POST_CLASSE2` FOREIGN KEY (`ID_CLASSE`) REFERENCES `CLASSE` (`ID_CLASSE`) ON DELETE CASCADE;

--
-- Constraints for table `POST_ETABLISSEMENT`
--
ALTER TABLE `POST_ETABLISSEMENT`
  ADD CONSTRAINT `post_etablissement_ibfk_2` FOREIGN KEY (`ID_POST`) REFERENCES `POST` (`ID_POST`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_etablissement_ibfk_1` FOREIGN KEY (`ID_ETABLISSEMENT`) REFERENCES `ETABLISSEMENT` (`ID_ETABLISSEMENT`) ON DELETE CASCADE;

--
-- Constraints for table `POST_NIVEAU`
--
ALTER TABLE `POST_NIVEAU`
  ADD CONSTRAINT `post_niveau_ibfk_2` FOREIGN KEY (`ID_NIVEAU`) REFERENCES `NIVEAU` (`ID_NIVEAU`),
  ADD CONSTRAINT `post_niveau_ibfk_1` FOREIGN KEY (`ID_POST`) REFERENCES `POST` (`ID_POST`);

--
-- Constraints for table `UTILISATEUR_CLASSE`
--
ALTER TABLE `UTILISATEUR_CLASSE`
  ADD CONSTRAINT `utilisateur_classe_ibfk_2` FOREIGN KEY (`ID_CLASSE`) REFERENCES `CLASSE` (`ID_CLASSE`) ON DELETE CASCADE,
  ADD CONSTRAINT `utilisateur_classe_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `UTILISATEUR` (`ID_USER`) ON DELETE CASCADE;

--
-- Constraints for table `UTILISATEUR_TYPE_UTILISATEUR`
--
ALTER TABLE `UTILISATEUR_TYPE_UTILISATEUR`
  ADD CONSTRAINT `utilisateur_type_utilisateur_ibfk_2` FOREIGN KEY (`ID_USER`) REFERENCES `UTILISATEUR` (`ID_USER`) ON DELETE CASCADE,
  ADD CONSTRAINT `utilisateur_type_utilisateur_ibfk_1` FOREIGN KEY (`ID_TYPE_UTILISATEUR`) REFERENCES `TYPE_UTILISATEUR` (`ID_TYPE_UTILISATEUR`);
