-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2025 at 01:03 PM
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
-- Database: `loan_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `borrowers`
--

CREATE TABLE `borrowers` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `contact_no` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `tax_id` varchar(50) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrowers`
--

INSERT INTO `borrowers` (`id`, `firstname`, `middlename`, `lastname`, `contact_no`, `address`, `email`, `tax_id`, `date_created`) VALUES
(14, 'Kiracı 1', '', '', '05555555555', 'Adatepe Mahallesi Erdem Caddesi No:33/1 Kat:1 Daire:1', 'kiracı1@gmail.com', '00000000001', 0),
(15, 'Kiracı 2', '', '', '05555555555', 'Adatepe Mahallesi Erdem Caddesi No:33/1 Kat:1 Daire:2', 'kiracı2@gmail.com', '00000000002', 0),
(16, 'Kiracı 3', '', '', '05555555555', 'Adatepe Mahallesi Erdem Caddesi No:33/1 Kat:1 Daire:3', 'kiracı3@gmail.com', '00000000003', 0),
(17, 'Kiracı 4', '', '', '05555555555', 'Adatepe Mahallesi Erdem Caddesi No:33/1 Kat:1 Daire:4', 'kiracı4@gmail.com', '00000000004', 0),
(18, 'Kiracı 5', '', '', '05555555555', 'Adatepe Mahallesi Erdem Caddesi No:33/1 Kat:1 Daire:5', 'kiracı5@gmail.com', '00000000005', 0),
(19, 'Kiracı 6', '', '', '05555555555', 'Adatepe Mahallesi Erdem Caddesi No:33/1 Kat:1 Daire:6', 'kiracı6@gmail.com', '00000000006', 0),
(20, 'Kiracı 7', '', '', '05555555555', 'Adatepe Mahallesi Erdem Caddesi No:33/1 Kat:1 Daire:7', 'kiracı7@gmail.com', '00000000007', 0),
(21, 'Kiracı 8', '', '', '05555555555', 'Adatepe Mahallesi Erdem Caddesi No:33/1 Kat:2 Daire:8', 'kiracı8@gmail.com', '00000000008', 0),
(22, 'Kiracı 9 ', '', '', '05555555555', 'Adatepe Mahallesi Erdem Caddesi No:33/1 Kat:2 Daire:9', 'kiracı9@gmail.com', '00000000009', 0),
(23, 'Kiracı 10', '', '', '05555555555', 'Adatepe Mahallesi Erdem Caddesi No:33/1 Kat:2 Daire:10', 'kiracı10@gmail.com', '00000000010', 0),
(24, 'Kiracı 11', '', '', '05555555555', 'Adatepe Mahallesi Erdem Caddesi No:33/1 Kat:2 Daire:11', 'kiracı11@gmail.com', '00000000011', 0),
(25, 'Kiracı 12', '', '', '05555555555', 'Adatepe Mahallesi Erdem Caddesi No:33/1 Kat:2 Daire:12', 'kiracı12@gmail.com', '00000000012', 0),
(26, 'Kiracı 13', '', '', '05555555555', 'Adatepe Mahallesi Erdem Caddesi No:33/1 Kat:2 Daire:13', 'kiracı13@gmail.com', '00000000013', 0),
(27, 'Kiracı 14', '', '', '05555555555', 'Adatepe Mahallesi Erdem Caddesi No:33/1 Kat:2 Daire:14', 'kiracı14@gmail.com', '00000000014', 0),
(28, 'Kiracı 15', '', '', '05555555555', 'Adatepe Mahallesi Erdem Caddesi No:33/1 Kat:3 Daire:15', 'kiracı15@gmail.com', '00000000015', 0),
(29, 'Kiracı 16', '', '', '05555555555', 'Adatepe Mahallesi Erdem Caddesi No:33/1 Kat:3 Daire:16', 'kiracı16@gmail.com', '00000000016', 0),
(30, 'Kiracı 17', '', '', '05555555555', 'Adatepe Mahallesi Erdem Caddesi No:33/1 Kat:3 Daire:17', 'kiracı17@gmail.com', '00000000017', 0),
(31, 'Kiracı 18', '', '', '05555555555', 'Adatepe Mahallesi Erdem Caddesi No:33/1 Kat:3 Daire:18', 'kiracı18@gmail.com', '00000000018', 0),
(32, 'Harun / Kiracı 19', '', '', '05559790631', 'Adatepe Mahallesi Erdem Caddesi No:33/1 Kat:3 Daire:19', 'harunkaya11@yahoo.com', '38482623950', 0),
(33, 'Kiracı 20', '', '', '05555555555', 'Adatepe Mahallesi Erdem Caddesi No:33/1 Kat:3 Daire:20', 'kiracı20@gmail.com', '00000000020', 0),
(34, 'Kiracı 21', '', '', '05555555555', 'Adatepe Mahallesi Erdem Caddesi No:33/1 Kat:3 Daire:21', 'kiracı21@gmail.com', '00000000021', 0),
(35, 'Kiracı 22', '', '', '05555555555', 'Adatepe Mahallesi Erdem Caddesi No:33/1 Kat:4 Daire:22', 'kiracı22@gmail.com', '00000000022', 0),
(36, 'Kiracı 23', '', '', '05555555555', 'Adatepe Mahallesi Erdem Caddesi No:33/1 Kat:4 Daire:23', 'kiracı23@gmail.com', '00000000023', 0),
(37, 'Kiracı 24', '', '', '05555555555', 'Adatepe Mahallesi Erdem Caddesi No:33/1 Kat:4 Daire:24', 'kiracı24@gmail.com', '00000000024', 0),
(38, 'Kiracı 25', '', '', '05555555555', 'Adatepe Mahallesi Erdem Caddesi No:33/1 Kat:4 Daire:25', 'kiracı25@gmail.com', '00000000025', 0),
(39, 'Kiracı 26', '', '', '05555555555', 'Adatepe Mahallesi Erdem Caddesi No:33/1 Kat:4 Daire:26', 'kiracı26@gmail.com', '00000000026', 0),
(40, 'Kiracı 27', '', '', '05555555555', 'Adatepe Mahallesi Erdem Caddesi No:33/1 Kat:4 Daire:27', 'kiracı27@gmail.com', '00000000027', 0),
(41, 'Kiracı 28', '', '', '05555555555', 'Adatepe Mahallesi Erdem Caddesi No:33/1 Kat:4 Daire:28', 'kiracı28@gmail.com', '00000000028', 0);

-- --------------------------------------------------------

--
-- Table structure for table `house`
--

CREATE TABLE `house` (
  `id` int(11) NOT NULL,
  `address` text NOT NULL,
  `owner_name` varchar(100) NOT NULL,
  `price` double NOT NULL,
  `date_listed` datetime NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=available, 0=sold'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `house`
--

INSERT INTO `house` (`id`, `address`, `owner_name`, `price`, `date_listed`, `status`) VALUES
(9, '28/1 sk no 45', 'Ahmet', 12000, '2024-12-24 02:12:04', 0);

-- --------------------------------------------------------

--
-- Table structure for table `loan_list`
--

CREATE TABLE `loan_list` (
  `id` int(11) NOT NULL,
  `ref_no` varchar(50) NOT NULL,
  `loan_type_id` int(11) NOT NULL,
  `borrower_id` int(11) NOT NULL,
  `purpose` text NOT NULL,
  `amount` double NOT NULL,
  `plan_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0= request, 1= confrimed,2=released,3=complteted,4=denied\r\n',
  `date_released` datetime NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loan_list`
--

INSERT INTO `loan_list` (`id`, `ref_no`, `loan_type_id`, `borrower_id`, `purpose`, `amount`, `plan_id`, `status`, `date_released`, `date_created`) VALUES
(17, '48046176', 2, 14, '', 180000, 7, 2, '2025-01-05 10:10:00', '2025-01-05 13:10:39'),
(18, '8022250', 2, 15, '', 198000, 7, 2, '2025-01-05 10:16:00', '2025-01-05 13:16:25'),
(19, '99226581', 1, 16, '', 150000, 7, 2, '2025-01-05 10:16:00', '2025-01-05 13:16:30'),
(20, '64078872', 2, 17, '', 186000, 7, 2, '2025-01-05 10:16:00', '2025-01-05 13:16:36'),
(21, '57423172', 1, 18, '', 121500, 8, 2, '2025-01-05 10:33:00', '2025-01-05 13:33:54'),
(22, '44299747', 2, 19, '', 201000, 7, 2, '2025-01-05 10:34:00', '2025-01-05 13:34:00'),
(23, '97759133', 2, 20, '', 200000, 7, 2, '2025-01-05 10:55:00', '2025-01-05 13:55:59'),
(24, '49774409', 2, 32, '', 192000, 7, 0, '0000-00-00 00:00:00', '2025-01-06 13:44:29');

-- --------------------------------------------------------

--
-- Table structure for table `loan_plan`
--

CREATE TABLE `loan_plan` (
  `id` int(11) NOT NULL,
  `months` int(11) NOT NULL,
  `interest_percentage` float NOT NULL,
  `penalty_rate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loan_plan`
--

INSERT INTO `loan_plan` (`id`, `months`, `interest_percentage`, `penalty_rate`) VALUES
(7, 12, 0, 0),
(8, 9, 0, 0),
(9, 6, 0, 0),
(10, 3, 0, 0),
(11, 24, 0, 0),
(12, 36, 0, 5);

-- --------------------------------------------------------

--
-- Table structure for table `loan_schedules`
--

CREATE TABLE `loan_schedules` (
  `id` int(11) NOT NULL,
  `loan_id` int(11) NOT NULL,
  `date_due` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loan_schedules`
--

INSERT INTO `loan_schedules` (`id`, `loan_id`, `date_due`) VALUES
(2, 3, '2020-10-26'),
(3, 3, '2020-11-26'),
(4, 3, '2020-12-26'),
(5, 3, '2021-01-26'),
(6, 3, '2021-02-26'),
(7, 3, '2021-03-26'),
(8, 3, '2021-04-26'),
(9, 3, '2021-05-26'),
(10, 3, '2021-06-26'),
(11, 3, '2021-07-26'),
(12, 3, '2021-08-26'),
(13, 3, '2021-09-26'),
(14, 3, '2021-10-26'),
(15, 3, '2021-11-26'),
(16, 3, '2021-12-26'),
(17, 3, '2022-01-26'),
(18, 3, '2022-02-26'),
(19, 3, '2022-03-26'),
(20, 3, '2022-04-26'),
(21, 3, '2022-05-26'),
(22, 3, '2022-06-26'),
(23, 3, '2022-07-26'),
(24, 3, '2022-08-26'),
(25, 3, '2022-09-26'),
(26, 3, '2022-10-26'),
(27, 3, '2022-11-26'),
(28, 3, '2022-12-26'),
(29, 3, '2023-01-26'),
(30, 3, '2023-02-26'),
(31, 3, '2023-03-26'),
(32, 3, '2023-04-26'),
(33, 3, '2023-05-26'),
(34, 3, '2023-06-26'),
(35, 3, '2023-07-26'),
(36, 3, '2023-08-26'),
(37, 3, '2023-09-26'),
(38, 5, '2025-01-13'),
(39, 5, '2025-02-13'),
(40, 5, '2025-03-13'),
(41, 5, '2025-04-13'),
(42, 5, '2025-05-13'),
(43, 5, '2025-06-13'),
(44, 5, '2025-07-13'),
(45, 5, '2025-08-13'),
(46, 5, '2025-09-13'),
(47, 6, '2025-01-13'),
(48, 6, '2025-02-13'),
(49, 6, '2025-03-13'),
(50, 6, '2025-04-13'),
(51, 6, '2025-05-13'),
(52, 6, '2025-06-13'),
(53, 6, '2025-07-13'),
(54, 6, '2025-08-13'),
(55, 7, '2025-02-04'),
(56, 7, '2025-03-04'),
(57, 7, '2025-04-04'),
(58, 7, '2025-05-04'),
(59, 7, '2025-06-04'),
(60, 7, '2025-07-04'),
(61, 7, '2025-08-04'),
(62, 7, '2025-09-04'),
(63, 7, '2025-10-04'),
(64, 8, '2025-02-04'),
(65, 8, '2025-03-04'),
(66, 8, '2025-04-04'),
(67, 8, '2025-05-04'),
(68, 8, '2025-06-04'),
(69, 8, '2025-07-04'),
(70, 8, '2025-08-04'),
(71, 8, '2025-09-04'),
(72, 8, '2025-10-04'),
(73, 9, '2025-02-04'),
(74, 9, '2025-03-04'),
(75, 9, '2025-04-04'),
(76, 9, '2025-05-04'),
(77, 9, '2025-06-04'),
(78, 9, '2025-07-04'),
(79, 9, '2025-08-04'),
(80, 9, '2025-09-04'),
(81, 9, '2025-10-04'),
(82, 10, '2025-02-04'),
(83, 10, '2025-03-04'),
(84, 10, '2025-04-04'),
(85, 10, '2025-05-04'),
(86, 10, '2025-06-04'),
(87, 10, '2025-07-04'),
(88, 10, '2025-08-04'),
(89, 10, '2025-09-04'),
(90, 10, '2025-10-04'),
(91, 11, '2025-02-04'),
(92, 11, '2025-03-04'),
(93, 11, '2025-04-04'),
(94, 11, '2025-05-04'),
(95, 11, '2025-06-04'),
(96, 11, '2025-07-04'),
(97, 11, '2025-08-04'),
(98, 11, '2025-09-04'),
(99, 11, '2025-10-04'),
(100, 12, '2025-02-04'),
(101, 12, '2025-03-04'),
(102, 12, '2025-04-04'),
(103, 12, '2025-05-04'),
(104, 12, '2025-06-04'),
(105, 12, '2025-07-04'),
(106, 12, '2025-08-04'),
(107, 12, '2025-09-04'),
(108, 16, '2025-02-04'),
(109, 16, '2025-03-04'),
(110, 16, '2025-04-04'),
(111, 16, '2025-05-04'),
(112, 16, '2025-06-04'),
(113, 16, '2025-07-04'),
(114, 16, '2025-08-04'),
(115, 16, '2025-09-04'),
(116, 16, '2025-10-04'),
(117, 17, '2025-02-05'),
(118, 17, '2025-03-05'),
(119, 17, '2025-04-05'),
(120, 17, '2025-05-05'),
(121, 17, '2025-06-05'),
(122, 17, '2025-07-05'),
(123, 17, '2025-08-05'),
(124, 17, '2025-09-05'),
(125, 17, '2025-10-05'),
(126, 17, '2025-11-05'),
(127, 17, '2025-12-05'),
(128, 17, '2026-01-05'),
(129, 18, '2025-02-05'),
(130, 18, '2025-03-05'),
(131, 18, '2025-04-05'),
(132, 18, '2025-05-05'),
(133, 18, '2025-06-05'),
(134, 18, '2025-07-05'),
(135, 18, '2025-08-05'),
(136, 18, '2025-09-05'),
(137, 18, '2025-10-05'),
(138, 18, '2025-11-05'),
(139, 18, '2025-12-05'),
(140, 18, '2026-01-05'),
(141, 19, '2025-02-05'),
(142, 19, '2025-03-05'),
(143, 19, '2025-04-05'),
(144, 19, '2025-05-05'),
(145, 19, '2025-06-05'),
(146, 19, '2025-07-05'),
(147, 19, '2025-08-05'),
(148, 19, '2025-09-05'),
(149, 19, '2025-10-05'),
(150, 19, '2025-11-05'),
(151, 19, '2025-12-05'),
(152, 19, '2026-01-05'),
(153, 20, '2025-02-05'),
(154, 20, '2025-03-05'),
(155, 20, '2025-04-05'),
(156, 20, '2025-05-05'),
(157, 20, '2025-06-05'),
(158, 20, '2025-07-05'),
(159, 20, '2025-08-05'),
(160, 20, '2025-09-05'),
(161, 20, '2025-10-05'),
(162, 20, '2025-11-05'),
(163, 20, '2025-12-05'),
(164, 20, '2026-01-05'),
(165, 21, '2025-02-05'),
(166, 21, '2025-03-05'),
(167, 21, '2025-04-05'),
(168, 21, '2025-05-05'),
(169, 21, '2025-06-05'),
(170, 21, '2025-07-05'),
(171, 21, '2025-08-05'),
(172, 21, '2025-09-05'),
(173, 21, '2025-10-05'),
(174, 22, '2025-02-05'),
(175, 22, '2025-03-05'),
(176, 22, '2025-04-05'),
(177, 22, '2025-05-05'),
(178, 22, '2025-06-05'),
(179, 22, '2025-07-05'),
(180, 22, '2025-08-05'),
(181, 22, '2025-09-05'),
(182, 22, '2025-10-05'),
(183, 22, '2025-11-05'),
(184, 22, '2025-12-05'),
(185, 22, '2026-01-05'),
(186, 23, '2025-02-05'),
(187, 23, '2025-03-05'),
(188, 23, '2025-04-05'),
(189, 23, '2025-05-05'),
(190, 23, '2025-06-05'),
(191, 23, '2025-07-05'),
(192, 23, '2025-08-05'),
(193, 23, '2025-09-05'),
(194, 23, '2025-10-05'),
(195, 23, '2025-11-05'),
(196, 23, '2025-12-05'),
(197, 23, '2026-01-05');

-- --------------------------------------------------------

--
-- Table structure for table `loan_types`
--

CREATE TABLE `loan_types` (
  `id` int(11) NOT NULL,
  `type_name` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loan_types`
--

INSERT INTO `loan_types` (`id`, `type_name`, `description`) VALUES
(1, 'TİP1', '1+1'),
(2, 'TİP2', '2+1'),
(3, 'TİP3', '3+1'),
(10, 'TİP4', '4 1');

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_requests`
--

CREATE TABLE `maintenance_requests` (
  `id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `borrower_id` int(11) NOT NULL,
  `issue_description` text NOT NULL,
  `priority` enum('low','medium','high','emergency') NOT NULL DEFAULT 'low',
  `status` enum('pending','in_progress','completed','cancelled') NOT NULL DEFAULT 'pending',
  `request_date` datetime DEFAULT current_timestamp(),
  `completion_date` datetime DEFAULT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `maintenance_requests`
--

INSERT INTO `maintenance_requests` (`id`, `property_id`, `borrower_id`, `issue_description`, `priority`, `status`, `request_date`, `completion_date`, `notes`) VALUES
(16, 9, 14, 'elektrik arızası', 'medium', 'pending', '2025-01-05 14:57:08', NULL, NULL),
(17, 9, 40, 'su sızıntısı', 'high', 'in_progress', '2025-01-06 13:45:07', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `loan_id` int(11) NOT NULL,
  `payee` text NOT NULL,
  `amount` float NOT NULL DEFAULT 0,
  `penalty_amount` float NOT NULL DEFAULT 0,
  `overdue` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=no , 1 = yes',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `loan_id`, `payee`, `amount`, `penalty_amount`, `overdue`, `date_created`) VALUES
(17, 17, ', Kiracı 1 ', 15000, 0, 0, '2025-01-05 13:38:53'),
(18, 18, ', Kiracı 2 ', 16500, 0, 0, '2025-01-06 13:54:12');

-- --------------------------------------------------------

--
-- Table structure for table `pdf_files`
--

CREATE TABLE `pdf_files` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `custom_name` varchar(255) NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Dumping data for table `pdf_files`
--

INSERT INTO `pdf_files` (`id`, `file_name`, `file_path`, `custom_name`, `upload_date`) VALUES
(1, 'unique-tower-139460.pdf', 'uploads/677ba6e4baa98_unique-tower-139460.pdf', 'Kira sözleşmesi', '2025-01-06 09:48:20'),
(2, 'unique-tower-139460.pdf', 'uploads/677bb726ba462_unique-tower-139460.pdf', 'dosya', '2025-01-06 10:57:42');

-- --------------------------------------------------------

--
-- Table structure for table `rental_properties`
--

CREATE TABLE `rental_properties` (
  `id` int(11) NOT NULL,
  `address` text NOT NULL,
  `owner_name` varchar(100) NOT NULL,
  `monthly_rent` decimal(10,2) NOT NULL,
  `deposit_amount` decimal(10,2) NOT NULL,
  `property_type` varchar(50) NOT NULL,
  `room_count` int(11) NOT NULL,
  `square_meters` decimal(8,2) NOT NULL,
  `status` enum('available','rented','maintenance') NOT NULL DEFAULT 'available',
  `features` text DEFAULT NULL,
  `date_listed` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `contact` text NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1=admin , 2 = staff'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `doctor_id`, `name`, `address`, `contact`, `username`, `password`, `type`) VALUES
(1, 0, 'Administrator', '', '', 'admin', 'admin123', 1),
(16, 0, 'Safa', '', '', 's', '123', 1),
(17, 0, 'Göktuğ', '', '', 'G', '123', 2),
(18, 0, 'Harun', '', '', 'Harun', '123456', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `borrowers`
--
ALTER TABLE `borrowers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `house`
--
ALTER TABLE `house`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_list`
--
ALTER TABLE `loan_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `borrower_id` (`borrower_id`),
  ADD KEY `loan_type_id` (`loan_type_id`);

--
-- Indexes for table `loan_plan`
--
ALTER TABLE `loan_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_schedules`
--
ALTER TABLE `loan_schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_types`
--
ALTER TABLE `loan_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maintenance_requests`
--
ALTER TABLE `maintenance_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_id` (`property_id`),
  ADD KEY `borrower_id` (`borrower_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdf_files`
--
ALTER TABLE `pdf_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rental_properties`
--
ALTER TABLE `rental_properties`
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
-- AUTO_INCREMENT for table `borrowers`
--
ALTER TABLE `borrowers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `house`
--
ALTER TABLE `house`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `loan_list`
--
ALTER TABLE `loan_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `loan_plan`
--
ALTER TABLE `loan_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `loan_schedules`
--
ALTER TABLE `loan_schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- AUTO_INCREMENT for table `loan_types`
--
ALTER TABLE `loan_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `maintenance_requests`
--
ALTER TABLE `maintenance_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pdf_files`
--
ALTER TABLE `pdf_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rental_properties`
--
ALTER TABLE `rental_properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `loan_list`
--
ALTER TABLE `loan_list`
  ADD CONSTRAINT `loan_list_ibfk_1` FOREIGN KEY (`borrower_id`) REFERENCES `borrowers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `maintenance_requests`
--
ALTER TABLE `maintenance_requests`
  ADD CONSTRAINT `maintenance_requests_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `house` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `maintenance_requests_ibfk_2` FOREIGN KEY (`borrower_id`) REFERENCES `borrowers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
