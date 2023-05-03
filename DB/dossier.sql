-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 08, 2021 at 04:54 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dossier`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `ID_CAT` int(11) NOT NULL,
  `NOM_CAT` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`ID_CAT`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`ID_CAT`, `NOM_CAT`) VALUES
(1, 'إشعار بدون صائر'),
(2, 'إنذار'),
(3, 'الحجز'),
(4, 'البيع'),
(5, 'إكراه بدني'),
(6, 'التنفيذ بالأداء'),
(7, 'إشعار للغير الحائز'),
(8, 'تنفيذ عقوبة حبسية');

-- --------------------------------------------------------

--
-- Table structure for table `correspondant`
--

DROP TABLE IF EXISTS `correspondant`;
CREATE TABLE IF NOT EXISTS `correspondant` (
  `ID_DOS` int(11) NOT NULL,
  `ID_CAT` int(11) NOT NULL,
  `ID_SOUSCAT` int(11) NOT NULL,
  `DATE_CAT` date DEFAULT NULL,
  PRIMARY KEY (`ID_DOS`,`ID_CAT`,`ID_SOUSCAT`),
  KEY `FK_ASSOCIATION_12` (`ID_CAT`),
  KEY `FK_CORRESPONDANT3` (`ID_SOUSCAT`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `correspondant`
--

INSERT INTO `correspondant` (`ID_DOS`, `ID_CAT`, `ID_SOUSCAT`, `DATE_CAT`) VALUES
(7, 4, 0, '2021-06-22'),
(7, 3, 1, '2021-06-22'),
(7, 2, 0, '2021-06-22'),
(5, 6, 3, '2021-06-22'),
(5, 5, 0, '2021-06-22'),
(5, 4, 0, '2021-06-22'),
(5, 3, 1, '2021-06-22'),
(5, 2, 0, '2021-06-22'),
(6, 6, 4, '2021-06-22'),
(6, 5, 0, '2021-06-22'),
(6, 4, 0, '2021-06-22'),
(6, 3, 1, '2021-06-22'),
(6, 2, 0, '2021-06-22'),
(8, 6, 3, '2021-06-22'),
(8, 5, 0, '2021-06-22'),
(8, 4, 0, '2021-06-22'),
(8, 3, 2, '2021-06-22'),
(8, 2, 0, '2021-06-22'),
(10, 2, 0, '2021-06-29'),
(10, 1, 0, '2021-06-28'),
(6, 8, 0, '2021-06-22'),
(6, 7, 0, '2021-06-22'),
(7, 6, 4, '2021-06-22'),
(7, 5, 0, '2021-06-22'),
(7, 1, 0, '2021-06-22'),
(5, 1, 0, '2021-06-22'),
(6, 1, 0, '2021-06-22'),
(8, 1, 0, '2021-06-22'),
(10, 3, 2, '2021-06-29'),
(10, 4, 0, '2021-06-29'),
(10, 5, 0, '2021-06-29'),
(10, 6, 3, '2021-06-29'),
(10, 7, 0, '2021-06-29'),
(10, 8, 0, '2021-06-29'),
(9, 1, 0, '2021-06-29'),
(9, 2, 0, '2021-06-29'),
(9, 3, 1, '2021-06-29'),
(9, 4, 0, '2021-06-29'),
(9, 5, 0, '2021-06-29'),
(9, 6, 4, '2021-06-29');

-- --------------------------------------------------------

--
-- Table structure for table `demande_information`
--

DROP TABLE IF EXISTS `demande_information`;
CREATE TABLE IF NOT EXISTS `demande_information` (
  `ID_D` int(11) NOT NULL AUTO_INCREMENT,
  `ID_DOS` int(11) NOT NULL,
  `TYPE_D` varchar(250) NOT NULL,
  PRIMARY KEY (`ID_D`),
  KEY `FK_ASSOCIATION_6` (`ID_DOS`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `demande_information`
--

INSERT INTO `demande_information` (`ID_D`, `ID_DOS`, `TYPE_D`) VALUES
(28, 5, 'العقارات المحفظة'),
(27, 5, 'رقم الحساب البنكي'),
(26, 5, 'رقم لوحة السيارة'),
(25, 6, 'رقم الحساب البنكي'),
(24, 8, 'رقم الحساب البنكي'),
(23, 8, 'رقم لوحة السيارة'),
(29, 7, 'العقارات المحفظة'),
(30, 10, 'رقم لوحة السيارة'),
(31, 10, 'رقم الحساب البنكي');

-- --------------------------------------------------------

--
-- Table structure for table `dossier`
--

DROP TABLE IF EXISTS `dossier`;
CREATE TABLE IF NOT EXISTS `dossier` (
  `ID_DOS` int(11) NOT NULL AUTO_INCREMENT,
  `CIN` varchar(250) NOT NULL,
  `MATRICULE` varchar(250) NOT NULL,
  `NUM_DOS__TRIBUNAL` varchar(250) DEFAULT NULL,
  `NOM_DOS` varchar(250) NOT NULL,
  `NUM_DOS_SUJET` varchar(250) DEFAULT NULL,
  `NUM_DOS_NB` varchar(250) DEFAULT NULL,
  `NUM_JUGE` varchar(250) DEFAULT NULL,
  `DATE_JUGE` date DEFAULT NULL,
  `TYPE` varchar(250) DEFAULT NULL,
  `DATE_NOTIF` date DEFAULT NULL,
  `PERIODE_CONTRAINTE` varchar(250) DEFAULT NULL,
  `SOMME_TOTAL` decimal(8,0) DEFAULT NULL,
  PRIMARY KEY (`ID_DOS`),
  KEY `FK_ASSOCIATION_4` (`MATRICULE`),
  KEY `FK_ASSOCIATION_9` (`CIN`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dossier`
--

INSERT INTO `dossier` (`ID_DOS`, `CIN`, `MATRICULE`, `NUM_DOS__TRIBUNAL`, `NOM_DOS`, `NUM_DOS_SUJET`, `NUM_DOS_NB`, `NUM_JUGE`, `DATE_JUGE`, `TYPE`, `DATE_NOTIF`, `PERIODE_CONTRAINTE`, `SOMME_TOTAL`) VALUES
(6, 'H1111', '1234', '2021/1322', 'مريم بلعرشي', '2222', '2222', '800', '2021-06-03', 'حضوري', '2021-06-04', 'الأدنى', '3500'),
(5, 'H22222', '1234', '2020/669', 'محمد الهلالي', '1111', '1111', '875', '2021-06-01', 'غيابي', '2021-06-02', 'الأدنى', '2150'),
(7, 'H9999', '1234', '2019/85', 'منصف البحري', '3333', '3333', '85', '2019-03-23', 'غيابي', '2019-03-24', 'الأدنى', '5000'),
(8, 'H4444', '1234', '2021/554', 'هند بلقاسم', '4444', '4444', '554', '2021-06-10', 'حضوري', '2021-06-12', 'الأدنى', '3100'),
(9, 'H5555', '1234', '2021/199', 'عبد الرحيم مبرور', '5555', '5555', '123', '2021-06-10', 'حضوري', '2021-06-11', 'الأدنى', '5555'),
(10, 'H8989', '1234', '2021/222', 'محمد بلقاسم', '6666', '6666', '456', '2021-06-15', 'غيابي', '2021-06-16', 'الأدنى', '3900');

-- --------------------------------------------------------

--
-- Table structure for table `paiement`
--

DROP TABLE IF EXISTS `paiement`;
CREATE TABLE IF NOT EXISTS `paiement` (
  `ID_PAIEMENT` varchar(11) NOT NULL,
  `ID_SOUSCAT` int(11) NOT NULL,
  `ID_DOS` int(11) NOT NULL,
  `DATE_P` date DEFAULT NULL,
  `SOMME` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`ID_PAIEMENT`),
  KEY `FK_ASSOCIATION_7` (`ID_DOS`),
  KEY `FK_ASSOCIATION_8` (`ID_SOUSCAT`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `paiement`
--

INSERT INTO `paiement` (`ID_PAIEMENT`, `ID_SOUSCAT`, `ID_DOS`, `DATE_P`, `SOMME`) VALUES
('hhh', 3, 10, '2021-06-09', '3000'),
('nnn', 3, 10, '2021-06-02', '900'),
('v55555', 4, 7, '2019-02-03', '5000'),
('3333', 3, 5, '2020-03-20', '550'),
('22222', 3, 5, '2020-03-04', '1500'),
('11111', 3, 5, '2020-03-03', '100'),
('k9999', 4, 6, '2021-04-12', '3500'),
('9999', 3, 8, '2021-06-09', '1100'),
('77777', 3, 8, '2021-06-03', '2000'),
('hh', 4, 9, '2021-06-10', '5555');

-- --------------------------------------------------------

--
-- Table structure for table `personne`
--

DROP TABLE IF EXISTS `personne`;
CREATE TABLE IF NOT EXISTS `personne` (
  `CIN` varchar(250) NOT NULL,
  `NOM` varchar(250) DEFAULT NULL,
  `PRENOM` varchar(250) DEFAULT NULL,
  `PERE` varchar(250) DEFAULT NULL,
  `MERE` varchar(250) DEFAULT NULL,
  `DATE_NAISSANCE` date DEFAULT NULL,
  `LIEU_NAISSANCE` varchar(250) DEFAULT NULL,
  `LIEU_RESIDENCE` varchar(250) DEFAULT NULL,
  `CHARGE` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`CIN`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `personne`
--

INSERT INTO `personne` (`CIN`, `NOM`, `PRENOM`, `PERE`, `MERE`, `DATE_NAISSANCE`, `LIEU_NAISSANCE`, `LIEU_RESIDENCE`, `CHARGE`) VALUES
('H22222', 'الهلالي', 'محمد', 'صالح بن محمد', 'حياة بنت عبد الرزاق', '1979-01-01', 'آسفي', 'زنقة 1 سيدي بوزيد آسفي', 'بناء بدون ترخيص'),
('H1111', 'بلعرشي', 'مريم', 'عبد الرحيم بن عبد الجليل', 'خديجة بنت عبد الجليل', '1980-02-02', 'آسفي', 'زنقة 4 جنان مستاري آسفي', 'ضريبة'),
('H9999', 'البحري', 'منصف', 'عبدالله بن محمد', 'سامية بنت يوسف', '1990-11-19', 'آسفي', 'زنقة 6 حي أنس آسفي', 'حادثة'),
('H4444', 'بلقاسم', 'هند', 'سعيد بن أحمد', 'خديجة بنت أحمد', '1987-05-11', 'آسفي', 'زنقة 10 حي الجريفات آسفي', 'ضريبة'),
('H5555', 'مبرور', 'عبد الرحيم ', 'محمد بن محمد', 'خديجة بن محمد', '1987-01-01', 'اسفي ', 'حي البيار اسفي ', 'بناء بدون ترخيص'),
('H8989', 'بلقاسم', 'محمد', 'عبد الرحيم بن ', 'سامية بنت يوسف', '1970-03-20', 'آسفي', 'زنقة 10 جنان مستاري آسفي', 'حادثة');

-- --------------------------------------------------------

--
-- Table structure for table `programme__transfert`
--

DROP TABLE IF EXISTS `programme__transfert`;
CREATE TABLE IF NOT EXISTS `programme__transfert` (
  `ID_P` int(11) NOT NULL AUTO_INCREMENT,
  `ID_DOS` int(11) NOT NULL,
  `DATE_P` date DEFAULT NULL,
  `DAY_P` varchar(255) DEFAULT NULL,
  `DESTINATION` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`ID_P`),
  KEY `FK_ASSOCIATION_5` (`ID_DOS`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `programme__transfert`
--

INSERT INTO `programme__transfert` (`ID_P`, `ID_DOS`, `DATE_P`, `DAY_P`, `DESTINATION`) VALUES
(36, 10, '2021-06-17', 'الخميس', 'fdffff'),
(35, 7, '2021-05-17', 'الإثنين', 'قيادة نكة'),
(34, 7, '2021-05-10', 'الإثنين', 'قيادة العمامرة'),
(33, 5, '2021-04-05', 'الإثنين', 'قيادة خط ازكان'),
(32, 5, '2021-04-07', 'الأربعاء', 'باشوية سبت جزولة'),
(31, 6, '2021-06-08', 'الثلاثاء', 'الملحقة الإدارية 11'),
(30, 6, '2021-06-04', 'الجمعة', 'الملحقة الإدارية الثالثة'),
(29, 6, '2021-06-10', 'الخميس', 'الملحقة الإدارية التانية'),
(28, 8, '2021-06-03', 'الخميس', 'قيادة الكرعاني'),
(27, 8, '2021-06-02', 'الأربعاء', 'قيادة الغياث');

-- --------------------------------------------------------

--
-- Table structure for table `prog_transfert_global`
--

DROP TABLE IF EXISTS `prog_transfert_global`;
CREATE TABLE IF NOT EXISTS `prog_transfert_global` (
  `ID_PROG` int(11) NOT NULL AUTO_INCREMENT,
  `DATE_T` date NOT NULL,
  `DAY_T` varchar(250) NOT NULL,
  `DESTINATION` varchar(250) NOT NULL,
  PRIMARY KEY (`ID_PROG`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prog_transfert_global`
--

INSERT INTO `prog_transfert_global` (`ID_PROG`, `DATE_T`, `DAY_T`, `DESTINATION`) VALUES
(1, '2021-07-14', 'الأربعاء', 'aaa'),
(2, '2021-07-14', 'الأربعاء', 'b'),
(3, '2021-07-22', 'الخميس', 'g'),
(4, '2021-07-05', 'الإثنين', 'n');

-- --------------------------------------------------------

--
-- Table structure for table `sous_categorie`
--

DROP TABLE IF EXISTS `sous_categorie`;
CREATE TABLE IF NOT EXISTS `sous_categorie` (
  `ID_SOUSCAT` int(11) NOT NULL,
  `ID_CAT` int(11) NOT NULL,
  `NOM_SOUSCAT` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`ID_SOUSCAT`),
  KEY `FK_CONTIENT` (`ID_CAT`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sous_categorie`
--

INSERT INTO `sous_categorie` (`ID_SOUSCAT`, `ID_CAT`, `NOM_SOUSCAT`) VALUES
(1, 3, 'حجز تحفضي'),
(2, 3, 'حجز تنفيذي'),
(3, 6, 'تنفيذ جزئي'),
(4, 6, 'تنفيذ كلي');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `MATRICULE` varchar(250) NOT NULL,
  `NOM` varchar(250) DEFAULT NULL,
  `PRENOM` varchar(250) DEFAULT NULL,
  `IMAGE` varchar(250) NOT NULL,
  `PROFIL` varchar(250) NOT NULL,
  `PASSWORD` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`MATRICULE`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`MATRICULE`, `NOM`, `PRENOM`, `IMAGE`, `PROFIL`, `PASSWORD`) VALUES
('4545', 'fatam', 'narjis', 'image_user/3.png', 'admin', '$2y$10$V2qV53v8kFWvNJk5QqSGIuwdPv1qpVOC7tTreEUElfr48r2vUdJm6'),
('1234', 'noukta', 'ibtissam', 'image_user/1.jpg', 'personnel', '$2y$10$sFV63A4y39tH8Wr.ybJGaejIABC8EnGlbqk1KafqJPW2cEbIoCr0O');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
