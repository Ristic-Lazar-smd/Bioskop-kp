-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2023 at 12:50 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bioskop`
--

-- --------------------------------------------------------

--
-- Table structure for table `film`
--

CREATE TABLE `film` (
  `filmID` int(16) NOT NULL AUTO_INCREMENT,
  `nazivFilma` varchar(64) NOT NULL,
  PRIMARY KEY (`filmID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `film`
--

INSERT INTO `film` (`filmID`, `nazivFilma`) VALUES
(1, 'Dune'),
(2, 'Dnd');

-- --------------------------------------------------------

--
-- Table structure for table `rezervacija`
--

CREATE TABLE `rezervacija` (
  `rezID` int(16) NOT NULL AUTO_INCREMENT,
  `filmID` int(16) NOT NULL,
  `sedisteID` int(16) NOT NULL,
  PRIMARY KEY (`rezID`),
  FOREIGN KEY (`filmID`) REFERENCES `film` (`filmID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sediste`
--

CREATE TABLE `sediste` (
  `sedisteID` int(16) NOT NULL AUTO_INCREMENT,
  `brojSedista` int(16) NOT NULL,
  PRIMARY KEY (`sedisteID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sediste`
--

INSERT INTO `sediste` (`brojSedista`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10);



INSERT INTO `rezervacija` (`filmID`, `sedisteID`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 7),
(1, 9),
(2, 4),
(2, 9),
(2, 10),
(2, 2),
(2, 3),
(2, 5);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
