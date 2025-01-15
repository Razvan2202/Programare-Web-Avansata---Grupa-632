-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2025 at 11:37 PM
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
-- Database: `bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_admin` tinyint(1) DEFAULT 0,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `is_admin`, `first_name`, `last_name`) VALUES
(1, 'Razvan2202', 'razvanangheli2202@yahoo.com', '$2y$10$h5CkIdVazd2vx5kxZU8GSOcj/5q975N.8pjJIkIEi0is1YoCLgnwi', '2025-01-05 20:11:41', 1, 'Razvan', 'Angheli'),
(2, 'Iarina11', 'iarinaamalinei@yahoo.com', '$2y$10$z4Cu3aayOvkgFEHDoicy/.kCnpNFBgLpktq2R3XqqRHqntwZVS76q', '2025-01-05 20:46:18', 0, 'Iarina', 'Amalinei'),
(3, 'Georgel69', 'georgelsplinaru@gmail.com', '$2y$10$r3oI/37b.T.QglhBtXZkzed0zoJPtOw0LG12BQlPgUP51jNXEA7Cu', '2025-01-05 21:51:56', 0, 'George', 'Splinaru'),
(4, 'Tudorache456', 'tudorghiu@gmail.com', '$2y$10$.Uoh.te2UNFgAFo.7TEh/OvKOy3gqPBRCLKqHYmKAuKp8sZCm5cci', '2025-01-15 22:07:05', 0, 'Tudor', 'Gheorghiu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
