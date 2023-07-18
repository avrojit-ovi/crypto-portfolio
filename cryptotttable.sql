-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2023 at 01:09 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cryptotttable`
--

-- --------------------------------------------------------

--
-- Table structure for table `cryptotable`
--

CREATE TABLE `cryptotable` (
  `id` int(11) NOT NULL,
  `coin_name` varchar(255) DEFAULT NULL,
  `c_symbol` varchar(255) DEFAULT NULL,
  `entry_price` varchar(255) DEFAULT NULL,
  `first_target` varchar(255) DEFAULT NULL,
  `second_target` varchar(255) DEFAULT NULL,
  `stop_loss` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cryptotable`
--

INSERT INTO `cryptotable` (`id`, `coin_name`, `c_symbol`, `entry_price`, `first_target`, `second_target`, `stop_loss`) VALUES
(1, 'FIDA', 'fidausdt', '1234', '2345', '3456', '4567'),
(10, 'PHA', 'phausdt', '1234', '2345', '3456', '4567'),
(12, 'BITCOIN', 'btcusdt', '1234', '2345', '1111', '4567'),
(13, 'ETH', 'ethusdt', '1234', '2345', '3456', '0000'),
(14, 'AUDIO', 'audiousdt', '000', '0000', '0000', '0000');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `phone`, `password`) VALUES
(1, 'Ovi Chowdhury', 'ovi.chy4041@gmail.com', 'ovichy', '01970018651', 'Ovichy@108%'),
(3, 'Avrojit Chowdhury Ovi', 'admin@example.com', 'avrojit', '01970018651', 'Avrojit@108%');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cryptotable`
--
ALTER TABLE `cryptotable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cryptotable`
--
ALTER TABLE `cryptotable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
