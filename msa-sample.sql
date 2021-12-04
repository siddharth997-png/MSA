-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 04, 2020 at 11:28 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `msa-sample`
--

CREATE DATABASE `msa-sample`;
USE `msa-sample`;

-- --------------------------------------------------------

--
-- Table structure for table `msa-admins`
--

CREATE TABLE `msa-admins` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `state` varchar(200) NOT NULL,
  `city` varchar(200) NOT NULL,
  `password` varchar(400) NOT NULL,
  `dob` date NOT NULL,
  `address` text NOT NULL,
  `image` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `msa-admins`
--

INSERT INTO `msa-admins` (`id`, `name`, `email`, `state`, `city`, `password`, `dob`, `address`, `image`) VALUES
(5, 'Admin', 'admin@gmail.com', 'Maharashtra', 'Pune', '$2y$10$bkqRN63PDp5EaSDJYlR38uTP5YrtwFCK9FNFRJc7UU4X6U.641CUq', '1111-11-11', '-', 'admin.png'),
(6, '', '', '', '', '$2y$10$AWfPXIk8zShgmu1ID800Ve12wAKw/cIFQfY5DfihRsr.6OcBh7o8m', '0000-00-00', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `msa-gauge-r&r-study`
--

CREATE TABLE `msa-gauge-r&r-study` (
  `id` int(11) NOT NULL,
  `part-number` varchar(200) NOT NULL,
  `part-name` varchar(200) NOT NULL,
  `instrument-number` varchar(200) NOT NULL,
  `instrument-name` varchar(200) NOT NULL,
  `characteristic` varchar(80) NOT NULL,
  `gauge-type` varchar(80) NOT NULL,
  `specification` varchar(80) NOT NULL,
  `upper` double NOT NULL,
  `lower` double NOT NULL,
  `trials` int(11) NOT NULL DEFAULT 10,
  `parts` int(11) NOT NULL DEFAULT 3,
  `numappraisers` int(11) NOT NULL DEFAULT 3,
  `appraisers` text NOT NULL,
  `performer` varchar(200) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `msa-inspectors`
--

CREATE TABLE `msa-inspectors` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `state` varchar(200) NOT NULL,
  `city` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `dob` date NOT NULL,
  `address` text NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `msa-inspectors`
--

INSERT INTO `msa-inspectors` (`id`, `name`, `email`, `state`, `city`, `password`, `dob`, `address`, `image`) VALUES
(4, 'Inspector 1', 'insp1@gmail.com', 'Andhra Pradesh', '-', '$2y$10$suQbFQq8ljGnJuPacg4B4uLfcsyeoeDHh8MHVALuVRQuIBTs3UROC', '1111-11-11', '-', 'admin.png'),
(5, 'Inspector 2', 'insp2@gmail.com', 'Andhra Pradesh', '-', '$2y$10$nv9kHsrcdOCZoUOnRF.Oo.gzf2jjmq/FWC99oGtWXroFCzMDkRP6.', '1111-11-11', '-', 'admin.png'),
(6, 'Inspector 3', 'insp3@gmail.com', 'Andhra Pradesh', '-', '$2y$10$SZyeI0UIfS0k5PeKQ6AoEOlt5HWzwKhdMsGz/gyZNhV.6mHTmB.7.', '1111-11-11', '-', 'admin.png');

-- --------------------------------------------------------

--
-- Table structure for table `msa-procedure-results`
--

CREATE TABLE `msa-procedure-results` (
  `id` int(11) NOT NULL,
  `tablename` varchar(200) NOT NULL,
  `Xdoublebar` double NOT NULL,
  `Rdoublebar` double NOT NULL,
  `Xbardiff` double NOT NULL,
  `Rp` double NOT NULL,
  `UCLr` double NOT NULL,
  `LCLr` double NOT NULL,
  `EV` double NOT NULL,
  `AV` double NOT NULL,
  `RR` double NOT NULL,
  `PV` double NOT NULL,
  `PercentEV` double NOT NULL,
  `PercentAV` double NOT NULL,
  `PercentRR` double NOT NULL,
  `PercentPV` double NOT NULL,
  `ndc` double NOT NULL,
  `Conclusion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `msa-admins`
--
ALTER TABLE `msa-admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `msa-gauge-r&r-study`
--
ALTER TABLE `msa-gauge-r&r-study`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `msa-inspectors`
--
ALTER TABLE `msa-inspectors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `msa-procedure-results`
--
ALTER TABLE `msa-procedure-results`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `msa-admins`
--
ALTER TABLE `msa-admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `msa-gauge-r&r-study`
--
ALTER TABLE `msa-gauge-r&r-study`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `msa-inspectors`
--
ALTER TABLE `msa-inspectors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `msa-procedure-results`
--
ALTER TABLE `msa-procedure-results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
