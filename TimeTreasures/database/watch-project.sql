-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2024 at 07:05 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `watch-project`
--

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `watch_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `watch_id`, `quantity`) VALUES
(1, 1, 3, 6),
(2, 1, 2, 4),
(3, 2, 3, 9),
(4, 3, 3, 10);

-- --------------------------------------------------------

--
-- Table structure for table `order_table`
--

CREATE TABLE `order_table` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `total_amount` float DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_table`
--

INSERT INTO `order_table` (`id`, `user_id`, `name`, `email`, `address`, `total_amount`, `status`, `created_at`) VALUES
(1, 2, 'Deepinder Singh', 'Deepinder@gmail.com', '51-d street no 3 ranjit nagar nera\r\n51-d street no 3 ranjit nagar nera\r\nseona chowk', 3600, 0, '2024-03-22 09:40:56'),
(2, 2, 'Deepinder Singh', 'Deepinder@gmail.com', 'hdhdhdhdhdhdh', 4500, 1, '2024-03-22 10:26:19'),
(3, 3, 'Deep', 'deep@gmail.com', '52 d street number 3', 5000, 1, '2024-03-22 10:33:55');

-- --------------------------------------------------------

--
-- Table structure for table `recentlyview`
--

CREATE TABLE `recentlyview` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hammer_id` int(11) NOT NULL,
  `created_dt` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `recentlyview`
--

INSERT INTO `recentlyview` (`id`, `user_id`, `hammer_id`, `created_dt`) VALUES
(115, 2, 2, '2024-03-22 07:47:16'),
(118, 2, 3, '2024-03-22 10:25:50'),
(120, 3, 3, '2024-03-22 10:33:09');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_type` tinyint(4) DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `name`, `email`, `password`, `user_type`) VALUES
(1, 'Admin', 'Admin', 'admin@gmail.com', '$2y$10$znOy9HHmPdlK/OICprj4wOOMashfdKFlVKP4Vq3vkEiJgE.SI9UKy', 1),
(2, 'deepubhasin', 'Deepinder Singh', 'Deepinder@gmail.com', '$2y$10$Q5c4lWoq1I73P1touqyqNuTXg3lJk/ynRLubijJ5FJeeskDn9ALnq', 0),
(3, 'deep', 'Deep', 'deep@gmail.com', '$2y$10$CQAgvvz6UJlf82SCQ04SQun69UnoRgV00On87iCdc92mEgtVwyS4i', 0);

-- --------------------------------------------------------

--
-- Table structure for table `watches`
--

CREATE TABLE `watches` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `category` varchar(150) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `submitted` datetime DEFAULT NULL,
  `viewCount` int(11) DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `watches`
--

INSERT INTO `watches` (`id`, `user_id`, `category`, `name`, `description`, `image`, `price`, `submitted`, `viewCount`) VALUES
(2, 1, 'Omega', 'HD-Long lastic Black 100X', 'very black and very good', '1710785204-photo-1533139502658-0198f920d8e8.jpg.jpg', 150, '2024-03-18 23:36:44', 96),
(3, 1, 'Seiko', 'DELL X 120', 'Very classic and very stylish with gental looks', '1710903942-hd-slide3.jpg.jpg', 500, '2024-03-20 08:35:42', 38);

-- --------------------------------------------------------

--
-- Table structure for table `watch_type`
--

CREATE TABLE `watch_type` (
  `id` int(11) NOT NULL,
  `category` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `watch_type`
--

INSERT INTO `watch_type` (`id`, `category`) VALUES
(1, 'Omega'),
(2, 'Rolex'),
(3, 'Seiko'),
(4, 'TagHeuer'),
(5, 'Cartier'),
(6, 'Panerai'),
(7, 'Casio');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_table`
--
ALTER TABLE `order_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recentlyview`
--
ALTER TABLE `recentlyview`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `watches`
--
ALTER TABLE `watches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `watch_type`
--
ALTER TABLE `watch_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_table`
--
ALTER TABLE `order_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `recentlyview`
--
ALTER TABLE `recentlyview`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `watches`
--
ALTER TABLE `watches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `watch_type`
--
ALTER TABLE `watch_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
