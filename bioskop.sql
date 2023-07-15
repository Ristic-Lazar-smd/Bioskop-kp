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
  `filmID` int(16) NOT NULL,
  `nazivFilma` varchar(64) NOT NULL
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
  `rezID` int(16) NOT NULL,
  `filmID` int(16) NOT NULL,
  `sedisteID` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sediste`
--

CREATE TABLE `sediste` (
  `sedisteID` int(16) NOT NULL,
  `brojSedista` int(16) NOT NULL,
  `statusSedista` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sediste`
--

INSERT INTO `sediste` (`sedisteID`, `brojSedista`,`statusSedista`) VALUES
(1, 1, 0),
(2, 2, 0),
(3, 3, 1),
(4, 4, 1),
(5, 5, 0),
(6, 6, 1),
(7, 7, 2),
(8, 8, 1),
(9, 9, 1),
(10, 10, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`filmID`);

--
-- Indexes for table `rezervacija`
--
ALTER TABLE `rezervacija`
  ADD PRIMARY KEY (`rezID`),
  ADD KEY `fk` (`filmID`),
  ADD KEY `fk2` (`sedisteID`);

--
-- Indexes for table `sediste`
--
ALTER TABLE `sediste`
  ADD PRIMARY KEY (`sedisteID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `film`
--
ALTER TABLE `film`
  MODIFY `filmID` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rezervacija`
--
ALTER TABLE `rezervacija`
  MODIFY `rezID` int(16) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sediste`
--
ALTER TABLE `sediste`
  MODIFY `sedisteID` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rezervacija`
--
ALTER TABLE `rezervacija`
  ADD CONSTRAINT `fk` FOREIGN KEY (`filmID`) REFERENCES `film` (`filmID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk2` FOREIGN KEY (`sedisteID`) REFERENCES `sediste` (`sedisteID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
