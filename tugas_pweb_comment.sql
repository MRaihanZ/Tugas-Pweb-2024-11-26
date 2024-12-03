-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2024 at 08:09 AM
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
-- Database: `tugas_pweb_comment`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `comment` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `comment`) VALUES
(1, 'testing'),
(2, 'test 2'),
(3, 'test 3'),
(4, 'test 4'),
(5, 'test 5'),
(6, 'test 6'),
(7, 'Dolor aut nulla aut quia eius.'),
(8, 'Soluta optio est exercitationem dolorem expedita.'),
(9, 'Eos et non eum.'),
(10, 'Illo qui nam necessitatibus reiciendis non.'),
(11, 'Minus quod eos deleniti qui.'),
(12, 'Dolores minus rerum quae cumque ipsa ipsam.'),
(13, 'Optio hic eius saepe et ut voluptatum sint.'),
(14, 'Ea iste suscipit voluptatem sit nesciunt dolores.'),
(15, 'Sapiente quo vero qui et hic.'),
(16, 'Eos voluptatem qui nemo magni maxime deleniti.'),
(17, 'et'),
(18, 'aut'),
(19, 'quas'),
(20, 'eos'),
(21, 'eum'),
(22, 'eius'),
(23, 'consequatur'),
(24, 'corporis'),
(25, 'eos'),
(26, 'eum'),
(27, 'quis'),
(28, 'illo'),
(29, 'dolore'),
(30, 'placeat'),
(31, 'molestias'),
(32, 'dignissimos'),
(33, 'et'),
(34, 'a'),
(35, 'dolorem'),
(36, 'illo'),
(37, 'testing'),
(38, 'again testing'),
(39, 'Array'),
(40, 'Array'),
(41, 'Array'),
(42, 'Array'),
(43, 'again testing'),
(44, 'Array'),
(45, 'Array'),
(46, 'Array'),
(47, 'test 39'),
(48, 'test'),
(49, 'test'),
(50, 'test'),
(51, 'test'),
(52, 'afds'),
(53, 'adsf'),
(54, 'asdf'),
(55, 'test 55'),
(56, 'sdfa'),
(57, 'sdfa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
