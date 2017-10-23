-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Oct 13, 2017 at 05:37 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stocks`
--

-- --------------------------------------------------------

--
-- Table structure for table `stock_general`
--

CREATE TABLE `stock_general` (
  `date` int(11) NOT NULL,
  `series` tinytext NOT NULL,
  `open_price` float NOT NULL,
  `high_price` float NOT NULL,
  `low_price` float NOT NULL,
  `last_price` float NOT NULL,
  `close_price` float NOT NULL,
  `avg_price` float NOT NULL,
  `total_traded_qty` bigint(20) NOT NULL,
  `turnover` double NOT NULL,
  `no_of_trades` bigint(20) NOT NULL,
  `deliverable_qty` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `stock_general`
--
ALTER TABLE `stock_general`
  ADD PRIMARY KEY (`date`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
