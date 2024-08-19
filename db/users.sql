-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2024 at 04:32 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dara`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `usn` int(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `last_name`, `first_name`, `usn`, `password_hash`, `email`, `role`, `last_login`) VALUES
(1, 'Faller', 'Gayle David', 19001, 'password1', 'user@email.com', 'Student', NULL),
(2, 'Alferez', 'Neil', 19002, 'password1', 'user1@email.com', 'Student', NULL),
(3, 'Amistoso', 'Jun-rey', 19003, 'password1', 'user2@email.com', 'Student', NULL),
(4, 'Bautista', 'Trixie', 19004, 'password1', 'user3@email.com', 'Student', NULL),
(5, 'Fransisco', 'Donald', 10001, 'password1', 'teacher1@email.com', 'Teacher', NULL),
(6, 'Rodruigez', 'Christia', 20001, 'password1', 'teacher2@email.com', 'Teacher', NULL),
(7, 'Lehitimas', 'Noel', 10002, 'password1', 'teacher3@email.com', 'Teacher', NULL),
(8, 'Nistrator', 'Ammy', 1, 'password1', 'admin1@email.com', 'Admin', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `last_name` (`last_name`),
  ADD UNIQUE KEY `first_name` (`first_name`),
  ADD UNIQUE KEY `usn` (`usn`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
