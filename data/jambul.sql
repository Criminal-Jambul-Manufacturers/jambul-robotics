-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 02, 2017 at 02:51 PM
-- Server version: 5.6.35
-- PHP Version: 5.6.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jambul`
--

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `configKey` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `configValue` varchar(20) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `part`
--

DROP TABLE IF EXISTS `part`;
CREATE TABLE `part` (
  `partID` int(11) NOT NULL,
  `model` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `piece` tinyint(1) NOT NULL,
  `stamp` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `id` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `plant` varchar(32) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `robot`
--

DROP TABLE IF EXISTS `robot`;
CREATE TABLE `robot` (
  `robotID` int(11) NOT NULL,
  `headID` int(11) NOT NULL,
  `torsoID` int(11) NOT NULL,
  `bottomID` int(11) NOT NULL,
  `model` varchar(20) CHARACTER SET latin1 NOT NULL,
  `sold` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
CREATE TABLE `transaction` (
  `transactionID` int(11) NOT NULL,
  `description` varchar(100) CHARACTER SET latin1 NOT NULL,
  `cost` decimal(10,0) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `transactionType` varchar(10) CHARACTER SET latin1 NOT NULL,
  `robot` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`configKey`) USING BTREE;

--
-- Indexes for table `part`
--
ALTER TABLE `part`
  ADD PRIMARY KEY (`partID`) USING BTREE;

--
-- Indexes for table `robot`
--
ALTER TABLE `robot`
  ADD PRIMARY KEY (`robotID`),
  ADD KEY `FK_HEAD_PART` (`headID`),
  ADD KEY `FK_BOTTOM_PART` (`bottomID`),
  ADD KEY `FK_TORSO_PART` (`torsoID`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transactionID`),
  ADD KEY `FK_TRANSACTION_ROBOT` (`robot`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `part`
--
ALTER TABLE `part`
  MODIFY `partID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `robot`
--
ALTER TABLE `robot`
  MODIFY `robotID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transactionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `robot`
--
ALTER TABLE `robot`
  ADD CONSTRAINT `FK_BOTTOM_PART` FOREIGN KEY (`bottomID`) REFERENCES `part` (`partID`),
  ADD CONSTRAINT `FK_HEAD_PART` FOREIGN KEY (`headID`) REFERENCES `part` (`partID`),
  ADD CONSTRAINT `FK_TORSO_PART` FOREIGN KEY (`torsoID`) REFERENCES `part` (`partID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
