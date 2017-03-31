-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2017 at 08:26 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

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

CREATE TABLE `config` (
  `secretPassword` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `apiKey` varchar(20) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `part`
--

CREATE TABLE `part` (
  `partID` int(11) NOT NULL DEFAULT '0',
  `partCode` varchar(2) CHARACTER SET latin1 NOT NULL,
  `certID` int(11) NOT NULL,
  `originPlant` varchar(20) CHARACTER SET latin1 NOT NULL,
  `timeBuilt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `used` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `robot`
--

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
-- Constraints for dumped tables
--

--
-- Constraints for table `robot`
--
ALTER TABLE `robot`
  ADD CONSTRAINT `FK_BOTTOM_PART` FOREIGN KEY (`bottomID`) REFERENCES `part` (`partID`),
  ADD CONSTRAINT `FK_HEAD_PART` FOREIGN KEY (`headID`) REFERENCES `part` (`partID`),
  ADD CONSTRAINT `FK_TORSO_PART` FOREIGN KEY (`torsoID`) REFERENCES `part` (`partID`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `FK_TRANSACTION_ROBOT` FOREIGN KEY (`robot`) REFERENCES `robot` (`robotID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
