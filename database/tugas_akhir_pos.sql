-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2024 at 01:22 PM
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
-- Database: `tugas_akhir_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `no_telp` varchar(191) DEFAULT NULL,
  `level` enum('Admin','Kasir','Customer') NOT NULL,
  `is_ban` tinyint(1) NOT NULL COMMENT '0=not_ban, 1=ban',
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `email`, `password`, `no_telp`, `level`, `is_ban`, `created_at`) VALUES
(15, 'erpan', 'erpan@gmail.com', '$2y$10$Njs1uevijSI6sdppT4dq4uF67WDmWD4ahp97C0QMEBemsyiJtCaZu', '081208010912', 'Admin', 0, '0000-00-00'),
(16, 'TEST', 'testt@gmail.com', '$2y$10$5FSYszWI.BS3ShAkOJWph.EypvHt6mkDkU9b4rCPysrsw/WicQmxC', '081282818382', 'Admin', 0, '0000-00-00'),
(17, 'Rapan', 'rapan@gmail.com', '$2y$10$UzV7vJt4w3FSvOeEawq8j.tTET.y0k7fBewooN.9lxD9IHL8BR88u', '081282818382', 'Customer', 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` mediumtext NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0=visible, 1=hidden'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `status`) VALUES
(8, 'Minuman', 'Penyegar', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `class` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` int(50) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=visible, 1=hidden',
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `class`, `email`, `phone`, `status`, `created_at`) VALUES
(2, 'Rasya', 'XII RPL 1', 'bagay@gmail.com', 114131212, 0, '2024-04-28'),
(5, 'Cahyadi', 'XII RPL 1', 'saputra@gmail.com', 2147483647, 0, '2024-04-28'),
(6, 'erpan', '78 yyu', 'test@gmail.com', 686898980, 0, '2024-04-28');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0=visible, 1=hidden',
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `price`, `quantity`, `image`, `status`, `created_at`) VALUES
(7, 2, 'TEST', 'asdwasd', 1000, 13131212, 'assets/uploads/products/1714270129.png', 0, '2024-04-28'),
(8, 3, 'Ciki aja', 'TEst', 1000000, 100, 'assets/uploads/products/1714271015.png', 0, '2024-04-28'),
(9, 5, 'Kawa Kawa hijau', 'Minuman sehat Indonesia', 85000, 12, 'assets/uploads/products/1714297178.jpg', 0, '2024-04-28'),
(10, 5, 'Anggur Merah', 'Minuman Jamu Orang Tua', 65000, 21, 'assets/uploads/products/1714297295.jpg', 0, '2024-04-28'),
(11, 6, 'Tramadol', 'salah satu obat untuk menghilangkan rasa kesepian', 80000, 8, 'assets/uploads/products/1714297439.jpg', 0, '2024-04-28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
