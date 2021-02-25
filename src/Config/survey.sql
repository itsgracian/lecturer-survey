-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 25, 2021 at 04:08 PM
-- Server version: 8.0.23-0ubuntu0.20.04.1
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `survey`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `name`, `createdAt`, `updatedAt`) VALUES
(1, 'Javascript', '2021-02-21 12:32:31', '2021-02-21 12:32:31'),
(2, 'php', '2021-02-25 09:58:27', '2021-02-25 09:58:27');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

CREATE TABLE `lecturer` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `lecturer`
--

INSERT INTO `lecturer` (`id`, `name`, `photo`, `createdAt`, `updatedAt`) VALUES
(1, 'Jane doe', 'Short-Dread-Styles-For-Men.jpg', '2021-02-21 12:34:57', '2021-02-21 12:34:57'),
(2, 'john doe', 'istockphoto-451333971-612x612.jpg', '2021-02-21 12:35:46', '2021-02-21 12:35:46'),
(3, 'gratien', 'pkw-3385499_960_720.jpg', '2021-02-25 09:30:14', '2021-02-25 09:30:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `regNumber` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `userType` varchar(255) NOT NULL DEFAULT 'student',
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `regNumber`, `name`, `password`, `userType`, `createdAt`, `updatedAt`) VALUES
(1, 'RT/454/ULK', 'gratien', '$2y$10$7YHi7kqU.L.16Nad.vCAn.4aHnC4DSKqt2UZMb6UAIAnM1fBXMSJu', 'student', '2021-02-24 16:55:26', '2021-02-24 16:55:26'),
(2, 'ADMIN', 'admin', '$2y$10$pRSU.F9.R1v9lgdEDy2jve.pH.PVmI91T/rxsWTF4M9VNKY4A5KV2', 'admin', '2021-02-24 16:56:41', '2021-02-24 16:56:41'),
(3, 'ULK/100', 'prince', '$2y$10$z6QE7WtUNoQhMO0yrDZmMufCiQEWQLeDUM/5zg/.mzy6InaHeQ/4y', 'student', '2021-02-25 08:58:37', '2021-02-25 08:58:37'),
(4, 'ULK/101', 'mukama', '$2y$10$UdAEDuPLauZrt48X5uxXKu8MBAxOBOJZSpb2fW6xnZyf6onh4ddV2', 'student', '2021-02-25 09:28:49', '2021-02-25 09:28:49'),
(5, 'ULK/102', 'paul', '$2y$10$SqGeVu.RjsBiMGiBjy85duWkKyqsbH8nFxtWhJiZBiIjeaz8k7jGW', 'student', '2021-02-25 10:17:12', '2021-02-25 10:17:12');

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE `vote` (
  `id` int NOT NULL,
  `userId` int NOT NULL,
  `lecturerId` int NOT NULL,
  `courseId` int NOT NULL,
  `marks` int NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vote`
--

INSERT INTO `vote` (`id`, `userId`, `lecturerId`, `courseId`, `marks`, `createdAt`, `updatedAt`) VALUES
(1, 1, 2, 1, 1, '2021-02-25 08:39:23', '2021-02-25 08:39:23'),
(2, 3, 2, 1, 16, '2021-02-25 08:59:30', '2021-02-25 08:59:30'),
(3, 3, 1, 1, 9, '2021-02-25 09:25:26', '2021-02-25 09:25:26'),
(4, 4, 1, 1, 16, '2021-02-25 09:57:10', '2021-02-25 09:57:10'),
(5, 3, 1, 2, 15, '2021-02-25 09:59:48', '2021-02-25 09:59:48'),
(6, 4, 1, 2, 15, '2021-02-25 10:03:10', '2021-02-25 10:03:10'),
(7, 5, 1, 2, 38, '2021-02-25 10:18:17', '2021-02-25 10:18:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lecturer`
--
ALTER TABLE `lecturer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `regNumber` (`regNumber`);

--
-- Indexes for table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lecturer`
--
ALTER TABLE `lecturer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vote`
--
ALTER TABLE `vote`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
