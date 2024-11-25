-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2024 at 04:13 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
-- Table structure for table `document_repository`
--

CREATE TABLE `document_repository` (
  `document_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `student_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `authors` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`authors`)),
  `citations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`citations`)),
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata`)),
  `file` longblob NOT NULL,
  `status` varchar(50) NOT NULL,
  `date_submitted` datetime NOT NULL,
  `date_reviewed` datetime DEFAULT NULL,
  `study_type` varchar(50) NOT NULL,
  `abandoned_date` datetime DEFAULT NULL,
  `recovered_date` datetime DEFAULT NULL,
  `lost_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `last_login` datetime DEFAULT NULL,
  `status` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `last_name`, `first_name`, `usn`, `password_hash`, `email`, `role`, `last_login`, `status`) VALUES
(17, 'Gelicame', 'Analyn', 10004, '$2y$10$yJXx2qlXIu5B/9p7La.RKuxudvl3flQIO.z8c560iBCnv3mXRy..S', 'teacher4@gmail.com', 'Teacher', '2024-11-25 10:24:43', 'Active'),
(18, 'Malubay', 'Race', 19005, '$2y$10$kWbRPZpch9rOEH5tmnM7puIo5lqzyIs2x3bCwJK.IWVLlDG08WcfW', 'student5@gmail.com', 'Student', NULL, 'Deleted'),
(19, 'Survilla', 'Justin Jay', 19006, '$2y$10$h53Bd5zVeI5PCR4HSXANV.J3sTWEMHCAp0PxqdSpPmpJ7byDQZqJW', 'student6@gmail.com', 'Student', '2024-11-25 10:18:11', 'Active'),
(20, 'Virtudazo', 'Kc Mae', 19007, '$2y$10$d067u9OL5pM6HgvuD3V7GO1gZgnhzWLwgEePQ4th51iJSWP4XOieK', 'student7@gmail.com', 'Student', NULL, 'Active'),
(21, 'Tajanlangit', 'Ken Ashley', 19008, '$2y$10$j1BeDSV0aHGqtM5EgFbJbuuzNWQXWAjkUq7DFjh2Y/WSNmvQfUU1m', 'student8@gmail.com', 'Student', NULL, 'Active'),
(22, 'Ruela', 'Debrah', 19009, '$2y$10$SSvdry50L.9BiDyBZNwz1.qQNr3JzqiJkNNBhBpcWpIZF19htKlja', 'student9@gmail.com', 'Student', '2024-11-25 11:05:02', 'Active'),
(23, 'Jumamoy', 'Aaron James', 10005, '$2y$10$TynGZIzNfyS1jbF1JFchtuA82CkXE1Kfp.9DAlBF2Hk5SfgpDE3a.', 'teacherMath@gmail.com', 'Teacher', NULL, 'Active'),
(24, 'Imperial', 'Roy', 0, '$2y$10$S13.3Yuqi8yTucD3XV/EmeZpMfovDb2QtyRdZJmTepT3gXZZpEGei', 'admin@email.com', 'Admin', NULL, 'Active'),
(25, 'Prudenciado', 'Ryan', 10006, '$2y$10$wsQiNOy0KGCORGQOvVG6l.sUvoEuOGu6PZ2faAs.27mgQ1bDtFQke', 'POS@email.com', 'Teacher', NULL, 'Active'),
(27, 'B', 'HockRock', 101010, '$2y$10$aaUxJi4QL11J.6SIjiBzQeHEBSskoKsZleSWYTkfpWZ225RJxhQ6e', 'adminHockR@email.com', 'Admin', '2024-11-25 11:13:22', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `document_repository`
--
ALTER TABLE `document_repository`
  ADD PRIMARY KEY (`document_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `teacher_id` (`teacher_id`);

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
-- AUTO_INCREMENT for table `document_repository`
--
ALTER TABLE `document_repository`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `document_repository`
--
ALTER TABLE `document_repository`
  ADD CONSTRAINT `document_repository_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `document_repository_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
