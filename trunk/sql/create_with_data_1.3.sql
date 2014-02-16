-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 17, 2014 at 12:03 AM
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

--
-- Dumping data for table `ACTIVATION`
--

INSERT INTO `ACTIVATION` (`ID_USER`, `TOKEN`) VALUES
(16, '2qHZqvSJgdeY6ARGkkUa7RwnJyzUBbwt'),
(17, 'HKO9swxfeAdaFSTpsnMG8GfBYpVJ7cxF');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `CLASSE`
--

INSERT INTO `CLASSE` (`ID_CLASSE`, `ID_NIVEAU`, `NOM`, `CODE_ELEVE`, `CODE_ENSEIGNANT`) VALUES
(2, 14, '8emeVerte', '', ''),
(3, 13, 'tezr', '', ''),
(13, 10, 'test10', 'BMKuCg6M', ''),
(15, 10, 'test9', 'pyVhxqFJ', ''),
(19, 10, 'test4', 'aCqfqBEp', ''),
(20, 10, 'jkljkljkjk', 'rORpNdNO', ''),
(21, 10, 'qsdqstezryrtyres', 'pVWfnVhh', ''),
(22, 10, 'erezrzertzer', 'gOWWQRYt', ''),
(23, 11, 'testtete', 'bzZF9Tzd', ''),
(24, 11, 'sdfsdfdfd', '6qjjPjEr', ''),
(25, 10, 'zezeaz', '2c33a4x5', ''),
(26, 10, 'sqdqsd', 'WMhuJMjx', ''),
(27, 11, 'dscdssddsdsdssdd', 'uTrbWO3c', 'SdThcHuz'),
(28, 12, 'classe 1', 'SD2RJmG2', 'vcrfVT4P');

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
(68, 34, 10, 'test', '2014-01-07 22:29:26'),
(69, 56, 5, 'test', '2014-02-05 22:20:21'),
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `NIVEAU`
--

INSERT INTO `NIVEAU` (`ID_NIVEAU`, `ID_ETABLISSEMENT`, `NOM`) VALUES
(8, 2, '1ère'),
(10, 2, '2nd'),
(11, 2, '6eme'),
(12, 2, '11eme'),
(13, 2, 'test'),
(14, 2, '8');

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
(10, 34, 'image/jpeg', '326ec86c303fa367bfad907b7659c056-500x500.jpg'),
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

--
-- Dumping data for table `POST`
--

INSERT INTO `POST` (`ID_POST`, `ID_USER`, `DATE_CREATION`, `DATE_DERNIERE_MODIFICATION`, `CONTENU`, `COMMENTAIRES_ACTIVES`) VALUES
(2, 9, '2013-12-06 07:47:02', NULL, 'Autre test sur classe et sans commentaire', 0),
(3, 9, '2013-12-06 07:49:28', '2013-12-06 07:57:20', '<ul><li>Test sur niveau avec commentaire</li>\r\n<li>Autre ligne</li></ul>', 1),
(15, 10, '2013-12-30 22:42:35', NULL, '<p>qsqsq</p>', 1),
(16, 10, '2013-12-30 22:42:57', NULL, '<p>qsqsq</p>', 1),
(17, 10, '2013-12-30 22:45:50', NULL, '<p>dsqd</p>', 1),
(18, 10, '2013-12-30 22:48:31', NULL, '<p>sqdqsdqs</p>', 1),
(19, 10, '2013-12-30 22:50:41', NULL, '<p>sq</p>', 1),
(20, 10, '2013-12-30 22:51:13', NULL, '<p>sqdqsdsqd</p>', 1),
(21, 10, '2013-12-30 22:51:25', NULL, '<p>sqdqsdsqd</p>', 1),
(22, 10, '2013-12-30 22:51:55', NULL, '<p>sqdsqdsq</p>', 1),
(23, 10, '2013-12-30 22:53:22', NULL, '<p>sdsqd</p>', 1),
(24, 10, '2013-12-30 22:53:52', NULL, '<p>sqdqsdqsd</p>', 1),
(25, 10, '2013-12-30 22:54:38', NULL, '<p>qsQsqsQ</p>', 1),
(26, 10, '2013-12-30 22:55:40', NULL, '<p>azeazezaeaze</p>', 1),
(27, 10, '2013-12-30 22:57:08', NULL, '<p>azeazezaeaze</p>', 1),
(28, 10, '2013-12-30 22:58:21', NULL, '<p>qsez</p>', 1),
(29, 10, '2013-12-30 22:58:42', NULL, '<p>qsezretret</p>', 1),
(32, 10, '2014-01-05 22:30:36', NULL, '<p>ceci est un super post</p>', 1),
(33, 10, '2014-01-05 22:38:25', NULL, '<p>zezqdqdqs</p>', 1),
(34, 10, '2014-01-07 21:40:15', '2014-01-07 22:28:55', '<p><strong>cec est un test</strong></p>', 1),
(48, 5, '2014-02-03 22:42:03', NULL, '<p>1</p>', 1),
(49, 5, '2014-02-03 22:42:10', NULL, '<p>2</p>', 1),
(50, 5, '2014-02-03 22:42:16', NULL, '<p>3</p>', 1),
(51, 5, '2014-02-03 22:42:33', NULL, '<p>4</p>', 1),
(52, 5, '2014-02-03 22:42:43', NULL, '<p>5</p>', 1),
(53, 5, '2014-02-03 22:42:53', NULL, '<p>6</p>', 1),
(54, 5, '2014-02-05 22:15:13', NULL, '<p>test</p>', 1),
(55, 5, '2014-02-05 22:16:51', NULL, '<p>test</p>', 1),
(56, 5, '2014-02-05 22:20:08', NULL, '<p>ghfghgfh</p>', 1),
(57, 9, '2014-02-07 22:36:50', NULL, '<p>super</p>', 1),
(58, 5, '2014-02-07 23:19:40', '2014-02-09 11:11:17', '<p>test</p>', 1),
(60, 5, '2014-02-09 15:22:50', '2014-02-16 18:03:59', '<p>test photo</p>', 1);

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
(32, 3),
(33, 3);

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
(33, 2),
(42, 2),
(43, 2),
(44, 2),
(45, 2),
(46, 2),
(47, 2),
(54, 2),
(55, 2),
(56, 2),
(57, 2),
(58, 2),
(59, 2),
(60, 2);

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
(3, 10),
(29, 10),
(33, 10),
(34, 10),
(48, 12),
(49, 12),
(50, 12),
(51, 12),
(52, 12),
(53, 12);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `UTILISATEUR`
--

INSERT INTO `UTILISATEUR` (`ID_USER`, `ID_ETABLISSEMENT`, `NOM`, `PRENOM`, `LOGIN`, `MOT_DE_PASSE`, `AVATAR`, `active`, `LOGIN_TOKEN`) VALUES
(5, 2, 'SOURDRILLE', 'Guillaume', 'edenyorke', 'fc2789a2f2f3303f7322efa51bb5882fe034a321', 'P1000590.JPG', 1, 'd43ad6656739265566acdee5d843896cbbaf170a'),
(9, 2, 'Enseignant', '1', 'enseignant1', '7e240de74fb1ed08fa08d38063f6a6a91462a815', NULL, 1, ''),
(10, 2, 'Eleve', 'rené', 'eleve1', '7e240de74fb1ed08fa08d38063f6a6a91462a815', 'ouestu_114.png', 0, ''),
(11, 2, 'Eleve2', 'eleve2', 'eleve2', '7e240de74fb1ed08fa08d38063f6a6a91462a815', NULL, 0, ''),
(12, 2, 'Eleve2', 'eleve2', 'eleve@gmail.com', '7e240de74fb1ed08fa08d38063f6a6a91462a815', NULL, 0, ''),
(13, 2, 'AAA', 'AAA', 'qsqS@yahhoo.fr', '606ec6e9bd8a8ff2ad14e5fade3f264471e82251', NULL, 0, ''),
(14, 2, 'aaa', 'aaa', 'gsourdrille2@yopmail.com', '2fdcff54423c2985749282b4ce5fa540b67b9bd1', 'ouestu_114.png', 1, ''),
(15, 2, 'enseignant2', 'enseignant2', 'e2', '7e240de74fb1ed08fa08d38063f6a6a91462a815', NULL, 1, ''),
(16, 2, 'nom', 'prenom', 'gsourdrille8@yopmail.com', '7e240de74fb1ed08fa08d38063f6a6a91462a815', NULL, 0, ''),
(17, 2, 'nom', 'n', 'test8@yahoo.fr', '7e240de74fb1ed08fa08d38063f6a6a91462a815', NULL, 0, '');

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
(28, 5),
(2, 9),
(3, 10),
(27, 11),
(27, 12),
(27, 13),
(20, 14),
(13, 15),
(22, 16),
(27, 16),
(22, 17),
(27, 17),
(20, 18),
(22, 19),
(19, 20),
(19, 21),
(27, 22);

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
(9, 2),
(15, 2),
(10, 3),
(11, 3),
(12, 3),
(13, 3),
(14, 3),
(15, 3),
(16, 3),
(17, 3),
(18, 3),
(19, 3),
(20, 3),
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
  ADD CONSTRAINT `FK_RELATION_2` FOREIGN KEY (`ID_NIVEAU`) REFERENCES `NIVEAU` (`ID_NIVEAU`);

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
