-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2023 at 04:28 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `secret_santa`
--

-- --------------------------------------------------------

--
-- Table structure for table `gifts`
--

CREATE TABLE `gifts` (
  `id` int(11) NOT NULL,
  `code` tinytext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `des` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `gifts`
--

INSERT INTO `gifts` (`id`, `code`, `des`) VALUES
(1, 'r3wr3we', 'wefwef');

-- --------------------------------------------------------

--
-- Table structure for table `link`
--

CREATE TABLE `link` (
  `par_id` int(11) NOT NULL,
  `gift_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `link`
--

INSERT INTO `link` (`par_id`, `gift_id`) VALUES
(2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `user_from` int(11) NOT NULL,
  `user_to` int(11) NOT NULL,
  `type` tinytext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `gift` int(11) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`user_from`, `user_to`, `type`, `gift`, `time`) VALUES
(1, 0, '127.0.0.1', 0, '2023-10-28 16:23:35'),
(3, 0, '127.0.0.1', 0, '2023-10-28 16:24:58'),
(1, 0, '127.0.0.1', 0, '2023-10-28 16:25:42'),
(1, 3, 'stole', 1, '2023-10-28 16:26:20'),
(1, 2, 'gave', 1, '2023-10-28 16:26:25');

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `id` int(11) NOT NULL,
  `naam` tinytext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `passwd` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`id`, `naam`, `passwd`) VALUES
(1, 'admin', '$2y$10$ny8qDNdtlzbx2OF2eijXM.mRuPVL1Sn4Sd3delRyeZ8qzDU7jgbAy'),
(2, 'test', '$2y$10$QxLnBfXlrwv7ANc6Sx/5hOa1CVHlvbtRZ5I28i/VK6AH26Z4B41l2'),
(3, 'test2', '$2y$10$Y/1Cb3hDkzniwvoflDk/MelAK9ZRsRvx1UWpVYpyB3/miYPJxy0NC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gifts`
--
ALTER TABLE `gifts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `link`
--
ALTER TABLE `link`
  ADD UNIQUE KEY `par_id` (`par_id`),
  ADD UNIQUE KEY `gift_id` (`gift_id`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gifts`
--
ALTER TABLE `gifts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `link`
--
ALTER TABLE `link`
  ADD CONSTRAINT `gift_fk` FOREIGN KEY (`gift_id`) REFERENCES `gifts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `par_fk` FOREIGN KEY (`par_id`) REFERENCES `participants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
