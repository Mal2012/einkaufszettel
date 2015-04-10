-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2015 at 01:49 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `einkaufszettel`
--

-- --------------------------------------------------------

--
-- Table structure for table `einkaufszettel`
--

CREATE TABLE IF NOT EXISTS `einkaufszettel` (
`id` int(255) NOT NULL COMMENT 'Eindeutige Einkaufszettel-ID',
  `name` varchar(50) NOT NULL COMMENT 'Einkaufszettel Name',
  `lchange` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Letzte Änderung'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `einkaufszettel`
--

INSERT INTO `einkaufszettel` (`id`, `name`, `lchange`) VALUES
(5, 'test', '2015-04-10 08:13:36'),
(6, 'testtest', '2015-04-01 08:43:48'),
(7, 'testtest', '2015-03-31 14:33:32');

-- --------------------------------------------------------

--
-- Table structure for table `einkaufszettel_items`
--

CREATE TABLE IF NOT EXISTS `einkaufszettel_items` (
`id` int(255) NOT NULL COMMENT 'Eindeutige Item-ID',
  `zettel_id` int(255) NOT NULL COMMENT 'Zettelzuordnung Zettel-ID',
  `name` varchar(100) NOT NULL COMMENT 'Produktname',
  `user_id` int(100) NOT NULL COMMENT 'Hinzugefügt durch User-ID',
  `gekauft` int(2) NOT NULL COMMENT '0=offen 1=gekauft'
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `einkaufszettel_items`
--

INSERT INTO `einkaufszettel_items` (`id`, `zettel_id`, `name`, `user_id`, `gekauft`) VALUES
(13, 6, 'Artikel', 1, 0),
(16, 5, 'Artikel', 1, 1),
(17, 7, 'Artikel', 1, 0),
(18, 7, 'Artikel', 1, 0),
(19, 6, 'Artikel', 1, 0),
(20, 5, 'Penis', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `einkaufszettel_user`
--

CREATE TABLE IF NOT EXISTS `einkaufszettel_user` (
`id` int(255) NOT NULL,
  `user_id` int(100) NOT NULL COMMENT 'Eindeutige User-ID',
  `zettel_id` int(255) NOT NULL COMMENT 'Eindeutige Zettel-ID',
  `berechtigung` varchar(5) NOT NULL COMMENT 'Berechtigungen '
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `einkaufszettel_user`
--

INSERT INTO `einkaufszettel_user` (`id`, `user_id`, `zettel_id`, `berechtigung`) VALUES
(22, 1, 5, 'o'),
(23, 1, 6, 'o'),
(24, 1, 7, 'o'),
(26, 1, 6, 'g');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(50) NOT NULL COMMENT 'Eindeutige Benutzerid',
  `user` varchar(50) NOT NULL COMMENT 'Eindeutiger Benutzername',
  `mail` varchar(100) NOT NULL COMMENT 'E-Mail-Adresse',
  `passwort` varchar(50) NOT NULL COMMENT 'Passwort in MD%',
  `token` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user`, `mail`, `passwort`, `token`) VALUES
(1, 'test', 'test', '900150983cd24fb0d6963f7d28e17f72', 'aj8bpq7b6kmtka6eu65gsu38a2'),
(2, 'testtest', 'testtest', '900150983cd24fb0d6963f7d28e17f72', ''),
(3, 'tast', 'tast', '900150983cd24fb0d6963f7d28e17f72', ''),
(4, 'abc', '2345', '098f6bcd4621d373cade4e832627b4f6', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `einkaufszettel`
--
ALTER TABLE `einkaufszettel`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `einkaufszettel_items`
--
ALTER TABLE `einkaufszettel_items`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `einkaufszettel_user`
--
ALTER TABLE `einkaufszettel_user`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `user` (`user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `einkaufszettel`
--
ALTER TABLE `einkaufszettel`
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT COMMENT 'Eindeutige Einkaufszettel-ID',AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `einkaufszettel_items`
--
ALTER TABLE `einkaufszettel_items`
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT COMMENT 'Eindeutige Item-ID',AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `einkaufszettel_user`
--
ALTER TABLE `einkaufszettel_user`
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(50) NOT NULL AUTO_INCREMENT COMMENT 'Eindeutige Benutzerid',AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
