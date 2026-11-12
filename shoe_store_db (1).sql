-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2026 at 05:53 AM
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
-- Database: `shoe_store_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `quantity`, `price`, `created_at`, `created_by`, `updated_at`) VALUES
(2, 'sunsilk', 'shampoo', 30, 7, '2026-11-12 04:35:41', 1, '2026-11-12 04:35:41'),
(3, 'cream-o', 'biscuit', 4, 8, '2026-11-12 04:36:03', 1, '2026-11-12 04:36:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(250) NOT NULL,
  `status` enum('pending','approved') NOT NULL DEFAULT 'pending',
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--
/*username: admin, password: admin123*/
/*username: lena, password: lali*/

INSERT INTO `users` (`id`, `username`, `password`, `status`, `role`, `created_at`) VALUES
(1, 'admin', '$2y$10$bUZNeFv73H5iIogdKZUuo.Jc2VVZgZpUO1ET5mHPlX6q.o3IBX3I.', 'approved', 'admin', '2026-11-02 10:48:45'),
(2, 'erica', '$2y$10$JSJuqt30P3/P053krZ9eQeCjtIuKM9Q6SyX6rmBfqhPGPZz9wjoXS', 'pending', 'user', '2026-11-02 14:12:47'),
(3, 'ash', '$2y$10$ZucSLRya7r31XwKxaGv/RO4gsVITG6uLPAu1U1lhKNYcQW6bD3wnu', 'approved', 'user', '2026-11-02 14:16:22'),
(4, 'jasper', '$2y$10$q8XZ9Oz7B7g2UrqyaIKJQ.6aYpY6Ugz21HeoU59Mfbk5C/30NbSve', 'approved', 'user', '2026-11-02 15:50:58'),
(5, 'rylle', '$2y$10$fm41w7CpwLsZCBDFP56KRO0E3DJQPx2etVsfZkLGc0Pz5dhINGD.i', 'pending', 'user', '2026-11-02 15:57:22'),
(6, 'miah', '$2y$10$9r39P1OKA0cWVYjxA6Tlnepw5V7OJr9l319RKg1KYfE13YZiYW3M.', 'approved', 'user', '2026-11-03 09:27:32'),
(7, 'ndsjdsj', '$2y$10$sly1FUwX2M/1AfU.NK8UNeNFIyOxuYmRjQ9cyIgF64V0KCUqr9AYi', 'pending', 'user', '2026-11-03 09:28:30'),
(8, 'wer', '$2y$10$nNgdGLykrcZjIwYnHKPNg.1Qsbqzu7o2X84Wf55.rzyhIrpZ3xiXO', 'approved', 'user', '2026-11-03 09:29:10'),
(9, 'lena', '$2y$10$4LXM1fFSFWzvRQM7Z/wNVeIX/1WeI1GO3YjkKqaP1bPwofrGTdBMe', 'approved', 'user', '2026-11-12 04:02:40'),
(10, 'miu', '$2y$10$VOkDb1qVyctqVnksPfa8BOOjLhdt7kQyhHDBlUbxc8Kxw5y58XObi', 'pending', 'user', '2026-11-12 04:43:00'),
(11, 'lali', '$2y$10$BBviY7w194FzNGHXIOkIL.UpEHht3xTKO8x4eQa8YaGVHAQU0hu.2', 'pending', 'user', '2026-11-12 04:44:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
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
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
