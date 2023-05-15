-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2023 at 01:18 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mmm`
--

-- --------------------------------------------------------

--
-- Table structure for table `brosplitcode`
--

CREATE TABLE `brosplitcode` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brosplitcode`
--

INSERT INTO `brosplitcode` (`id`, `userid`, `code`) VALUES
(1, 12345678, '6t3zu5cx');

-- --------------------------------------------------------

--
-- Table structure for table `pplcode`
--

CREATE TABLE `pplcode` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pplcode`
--

INSERT INTO `pplcode` (`id`, `userid`, `code`) VALUES
(50, 12345678, '65kjd7yn'),
(51, 12345678, 'dk3z1z52'),
(52, 12345678, '74y04aub');

-- --------------------------------------------------------

--
-- Table structure for table `uplocode`
--

CREATE TABLE `uplocode` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uplocode`
--

INSERT INTO `uplocode` (`id`, `userid`, `code`) VALUES
(12, 12345678, '71706w8m');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `name`, `password`, `phone`, `date`) VALUES
(123456, 'mohamed', '$2y$10$XwVyimQDhDp1vRd9OkwCLuqTQiQGIRaYIF4fToYYzUb8z99hdCy0a', 1100106132, '2003-06-09'),
(12345677, 'xxx', 'xxx', 1220918504, '2023-05-10'),
(12345678, 'mohamed', '$2y$10$fWIg7xZz1SwPFwxNHjJ8KOBgnMU3QkN5u8NqN2PmIY0XUC5wKumJu', 1100106132, '2003-06-09'),
(123456788, 'ddd', 'ddd', 1220918504, '2023-05-10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brosplitcode`
--
ALTER TABLE `brosplitcode`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c_fff` (`userid`);

--
-- Indexes for table `pplcode`
--
ALTER TABLE `pplcode`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c_f` (`userid`);

--
-- Indexes for table `uplocode`
--
ALTER TABLE `uplocode`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c_ff` (`userid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brosplitcode`
--
ALTER TABLE `brosplitcode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pplcode`
--
ALTER TABLE `pplcode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `uplocode`
--
ALTER TABLE `uplocode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `brosplitcode`
--
ALTER TABLE `brosplitcode`
  ADD CONSTRAINT `c_fff` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`);

--
-- Constraints for table `pplcode`
--
ALTER TABLE `pplcode`
  ADD CONSTRAINT `c_f` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`);

--
-- Constraints for table `uplocode`
--
ALTER TABLE `uplocode`
  ADD CONSTRAINT `c_ff` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
