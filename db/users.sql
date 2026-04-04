-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 04, 2026 at 11:33 AM
-- Server version: 10.11.14-MariaDB-0ubuntu0.24.04.1
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `autorent`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` enum('admin','customer') NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `first_name`, `last_name`, `email`, `phone`, `password_hash`, `created_at`) VALUES
(1, 'customer', 'Mati', 'Maasikas', 'mati@example.com', '5551234', 'testhash', '2026-04-04 11:21:55'),
(2, 'customer', 'User1', 'Test1', 'user1@example.com', '5550001', 'hash', '2026-04-04 11:26:55'),
(3, 'customer', 'User2', 'Test2', 'user2@example.com', '5550002', 'hash', '2026-04-04 11:26:55'),
(4, 'customer', 'User3', 'Test3', 'user3@example.com', '5550003', 'hash', '2026-04-04 11:26:55'),
(5, 'customer', 'User4', 'Test4', 'user4@example.com', '5550004', 'hash', '2026-04-04 11:26:55'),
(6, 'customer', 'User5', 'Test5', 'user5@example.com', '5550005', 'hash', '2026-04-04 11:26:55'),
(7, 'customer', 'User6', 'Test6', 'user6@example.com', '5550006', 'hash', '2026-04-04 11:26:55'),
(8, 'customer', 'User7', 'Test7', 'user7@example.com', '5550007', 'hash', '2026-04-04 11:26:55'),
(9, 'customer', 'User8', 'Test8', 'user8@example.com', '5550008', 'hash', '2026-04-04 11:26:55'),
(10, 'customer', 'User9', 'Test9', 'user9@example.com', '5550009', 'hash', '2026-04-04 11:26:55'),
(11, 'customer', 'User10', 'Test10', 'user10@example.com', '5550010', 'hash', '2026-04-04 11:26:55'),
(12, 'customer', 'User11', 'Test11', 'user11@example.com', '5550011', 'hash', '2026-04-04 11:26:55'),
(13, 'customer', 'User12', 'Test12', 'user12@example.com', '5550012', 'hash', '2026-04-04 11:26:55'),
(14, 'customer', 'User13', 'Test13', 'user13@example.com', '5550013', 'hash', '2026-04-04 11:26:55'),
(15, 'customer', 'User14', 'Test14', 'user14@example.com', '5550014', 'hash', '2026-04-04 11:26:55'),
(16, 'customer', 'User15', 'Test15', 'user15@example.com', '5550015', 'hash', '2026-04-04 11:26:55'),
(17, 'customer', 'User16', 'Test16', 'user16@example.com', '5550016', 'hash', '2026-04-04 11:26:55'),
(18, 'customer', 'User17', 'Test17', 'user17@example.com', '5550017', 'hash', '2026-04-04 11:26:55'),
(19, 'customer', 'User18', 'Test18', 'user18@example.com', '5550018', 'hash', '2026-04-04 11:26:55'),
(20, 'customer', 'User19', 'Test19', 'user19@example.com', '5550019', 'hash', '2026-04-04 11:26:55'),
(21, 'customer', 'User20', 'Test20', 'user20@example.com', '5550020', 'hash', '2026-04-04 11:26:55'),
(22, 'customer', 'User21', 'Test21', 'user21@example.com', '5550021', 'hash', '2026-04-04 11:26:55'),
(23, 'customer', 'User22', 'Test22', 'user22@example.com', '5550022', 'hash', '2026-04-04 11:26:55'),
(24, 'customer', 'User23', 'Test23', 'user23@example.com', '5550023', 'hash', '2026-04-04 11:26:55'),
(25, 'customer', 'User24', 'Test24', 'user24@example.com', '5550024', 'hash', '2026-04-04 11:26:55'),
(26, 'customer', 'User25', 'Test25', 'user25@example.com', '5550025', 'hash', '2026-04-04 11:26:55'),
(27, 'customer', 'User26', 'Test26', 'user26@example.com', '5550026', 'hash', '2026-04-04 11:26:55'),
(28, 'customer', 'User27', 'Test27', 'user27@example.com', '5550027', 'hash', '2026-04-04 11:26:55'),
(29, 'customer', 'User28', 'Test28', 'user28@example.com', '5550028', 'hash', '2026-04-04 11:26:55'),
(30, 'customer', 'User29', 'Test29', 'user29@example.com', '5550029', 'hash', '2026-04-04 11:26:55'),
(31, 'customer', 'User30', 'Test30', 'user30@example.com', '5550030', 'hash', '2026-04-04 11:26:55'),
(32, 'customer', 'User31', 'Test31', 'user31@example.com', '5550031', 'hash', '2026-04-04 11:26:55'),
(33, 'customer', 'User32', 'Test32', 'user32@example.com', '5550032', 'hash', '2026-04-04 11:26:55'),
(34, 'customer', 'User33', 'Test33', 'user33@example.com', '5550033', 'hash', '2026-04-04 11:26:55'),
(35, 'customer', 'User34', 'Test34', 'user34@example.com', '5550034', 'hash', '2026-04-04 11:26:55'),
(36, 'customer', 'User35', 'Test35', 'user35@example.com', '5550035', 'hash', '2026-04-04 11:26:55'),
(37, 'customer', 'User36', 'Test36', 'user36@example.com', '5550036', 'hash', '2026-04-04 11:26:55'),
(38, 'customer', 'User37', 'Test37', 'user37@example.com', '5550037', 'hash', '2026-04-04 11:26:55'),
(39, 'customer', 'User38', 'Test38', 'user38@example.com', '5550038', 'hash', '2026-04-04 11:26:55'),
(40, 'customer', 'User39', 'Test39', 'user39@example.com', '5550039', 'hash', '2026-04-04 11:26:55'),
(41, 'customer', 'User40', 'Test40', 'user40@example.com', '5550040', 'hash', '2026-04-04 11:26:55'),
(42, 'customer', 'User41', 'Test41', 'user41@example.com', '5550041', 'hash', '2026-04-04 11:26:55'),
(43, 'customer', 'User42', 'Test42', 'user42@example.com', '5550042', 'hash', '2026-04-04 11:26:55'),
(44, 'customer', 'User43', 'Test43', 'user43@example.com', '5550043', 'hash', '2026-04-04 11:26:55'),
(45, 'customer', 'User44', 'Test44', 'user44@example.com', '5550044', 'hash', '2026-04-04 11:26:55'),
(46, 'customer', 'User45', 'Test45', 'user45@example.com', '5550045', 'hash', '2026-04-04 11:26:55'),
(47, 'customer', 'User46', 'Test46', 'user46@example.com', '5550046', 'hash', '2026-04-04 11:26:55'),
(48, 'customer', 'User47', 'Test47', 'user47@example.com', '5550047', 'hash', '2026-04-04 11:26:55'),
(49, 'customer', 'User48', 'Test48', 'user48@example.com', '5550048', 'hash', '2026-04-04 11:26:55'),
(50, 'customer', 'User49', 'Test49', 'user49@example.com', '5550049', 'hash', '2026-04-04 11:26:55'),
(51, 'customer', 'User50', 'Test50', 'user50@example.com', '5550050', 'hash', '2026-04-04 11:26:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
