-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2025 at 09:13 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `security_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `daily_report`
--

CREATE TABLE `daily_report` (
  `report_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `report_date` date NOT NULL,
  `job_location` varchar(255) NOT NULL,
  `arrival_time` time NOT NULL,
  `leaving_time` time DEFAULT NULL,
  `exact_area` varchar(255) DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `gps_coordinates` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daily_report`
--

INSERT INTO `daily_report` (`report_id`, `user_id`, `report_date`, `job_location`, `arrival_time`, `leaving_time`, `exact_area`, `remark`, `gps_coordinates`, `created_at`, `updated_at`) VALUES
(1, 11, '2025-03-23', 'atc', '02:36:00', '18:30:00', 'chuo', 'asdfghjkkjhgf', '-3.373754, 36.688085', '2025-03-23 09:35:11', '2025-03-24 14:46:28'),
(2, 11, '2025-03-23', 'atc', '01:37:00', '15:38:00', 'chuo', 'dfghg', '-3.3730281, 36.693078', '2025-03-23 09:37:09', '2025-03-24 14:37:06'),
(3, 11, '2025-03-24', 'oysterbay', '00:29:00', '01:29:00', 'chuo', 'halooo niko live', '-3.370484,36.683385n', '2025-03-24 06:30:04', '2025-03-24 15:44:44'),
(4, 9, '2025-03-24', 'oysterbay', '06:27:00', '20:29:00', 'home', '3t425u67jynkbfkhuichuisdhuicyuihvckbirhfyr78f735htihkhcuisicdyerfierygfyugsdugcvefgyufvuerfyugsdcsdcugegfyervgfgvyuugvgerfervyvwduyhfuiefbgfvsdcqrt', '-6.816505, 39.289437', '2025-03-24 14:26:43', '2025-03-24 17:59:21'),
(5, 9, '2025-03-25', 'oysterbay', '10:08:00', '22:06:00', 'here', 'asdfghjklpoiuytrewasdvb', '-6.816505, 39.289437', '2025-03-25 07:06:31', '2025-03-25 07:06:31');

-- --------------------------------------------------------

--
-- Table structure for table `hiring_requests`
--

CREATE TABLE `hiring_requests` (
  `BookingNumber` int(20) NOT NULL,
  `id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `requirement_number` int(11) DEFAULT NULL,
  `shift` varchar(50) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `requested_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `role` varchar(22) NOT NULL DEFAULT 'personnel',
  `registration_date` date DEFAULT NULL,
  `id_type` varchar(50) DEFAULT NULL,
  `id_number` varchar(50) DEFAULT NULL,
  `id_image` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `first_login` tinyint(1) DEFAULT 1,
  `token_display` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hiring_requests`
--

INSERT INTO `hiring_requests` (`BookingNumber`, `id`, `first_name`, `last_name`, `email`, `phone`, `requirement_number`, `shift`, `gender`, `address`, `created_at`, `requested_date`, `status`, `role`, `registration_date`, `id_type`, `id_number`, `id_image`, `password`, `first_login`, `token_display`) VALUES
(123455432, 2, 'Haji', 'Musa', 'hrajabu701@gmail.com', '087654334568', 870875587, 'Night Shift', 'Male', 'Arusha', '2025-03-15 20:24:04', '2025-03-16 18:19:10', 'Approved', 'personnel', '2025-03-27', 'Passport', '2000000987654321234567899999998765', 'uploads/ids/67e58d6a8877e_security.jpg', '$2y$10$IYgvFaTN7Z4Y1rve6qf67.R80kWEupVp4d0xQafWBkRrzaZtMh.dO', 0, 'c74ec5761e8a'),
(529398319, 3, 'haji', 'musa', 'qwe@df', '8765432340987', 4567890, 'Night Shift', 'Male', 'Arusha', '2025-03-15 20:37:19', '2025-03-16 18:19:10', 'Approved', 'personnel', '2025-03-19', 'National ID', '345987654321', 'uploads/ids/67db234beca06_PXL_20250217_105104045~2.jpg', NULL, 1, ''),
(360698595, 5, 'rob', 'musa', 'rama@ally', '693116952', 95678, 'Day Shift', 'Female', 'Arusha', '2025-03-15 21:01:55', '2025-03-16 18:19:10', 'Approved', 'personnel', '2025-03-18', 'Driving License', '12345678909876543', 'uploads/ids/67d9dd8b7b2e4_PXL_20250215_141013803(1).jpg', NULL, 1, ''),
(887652093, 6, 'Emryes', 'Musir', 'emryes@outlook.com', '87654334567', 876, '24/7 Protection', 'Male', 'Chugaa, Ngarnaa', '2025-03-16 10:22:50', '2025-03-16 18:19:10', 'Approved', 'personnel', '2025-03-28', 'National ID', '12345678909876543', 'uploads/ids/67dc62ce06d37_dbdb84bb3eaaefba3b26ad7e4e31e1f8_1734197046559_0.webp.jpg', NULL, 1, ''),
(478575078, 7, 'haji', 'john', 'qwe@df', '693116952', 987654, 'Night Shift', 'Male', 'Arusha', '2025-03-16 18:21:03', '2025-03-16 18:21:03', 'Rejected', 'admin', NULL, NULL, NULL, NULL, NULL, 1, ''),
(680152727, 8, 'musa', 'smith', 'musa@musir.co.tz', 'personnel', 2147483647, 'Day Shift', 'Female', 'Arusha', '2025-03-20 17:49:24', '2025-03-20 17:49:24', 'Approved', 'personnel', '2025-03-11', 'Driving License', '345987654321', 'uploads/ids/67dc60ef5ee1d_haji snet.jpg', NULL, 1, ''),
(935239884, 9, 'Luiz', 'adamu', 'ppastory@simbanet.co.tz', '0693116952', 2147483647, '24/7 Protection', 'Female', 'Arusha', '2025-03-20 18:50:51', '2025-03-20 18:50:51', 'Approved', 'personnel', '2025-03-24', 'National ID', '12345678909876543', 'uploads/ids/67e124a0d4571_dbdb84bb3eaaefba3b26ad7e4e31e1f8_1734197046559_0.webp.jpg', '$2y$10$mv7v6F/2.Qbnp0R.pRmyxeOjqwGPChXLR8Bf48JQehzJLDYv1YfY6', 0, 'd92d0aec3e2c'),
(160803437, 10, 'Kelvin', 'smith', 'chahamamosesmeshack@gmail.com', '693116952', 2147483647, 'Night Shift', 'Male', 'Dares salaam', '2025-03-21 07:41:35', '2025-03-21 07:41:35', 'Approved', 'personnel', '2025-03-21', 'National ID', '8763456789', 'uploads/ids/67dd23097678a_profil.jpg', NULL, 1, ''),
(535346238, 11, 'New', 'Anderson', 'n@underson', '693116952', 765434567, 'Night Shift', 'Male', 'Newyork', '2025-03-21 08:50:31', '2025-03-21 08:50:31', 'Approved', 'admin', '2025-03-18', 'Passport', '0987654345678', 'uploads/ids/67dd2c350f823_PXL_20240610_074651953~2.jpg', '$2y$10$LmdzWFsmjdl.ejr3v2bAJeFXnwFivc24otysvp/HN9Pko/Zo3JMgO', 0, 'b3fe79fbca4e'),
(328245297, 12, 'Emryes', 'Musir', 'emryes@outlook.com', '693116952', 876, 'Night Shift', 'Male', 'm/mairo', '2025-03-21 12:54:51', '2025-03-21 12:54:51', 'Pending', 'personnel', NULL, NULL, NULL, NULL, NULL, 1, ''),
(907196620, 13, 'will', 'smith', 'will@smith', '693116952', 123455432, 'Night Shift', 'Male', 'Arusha', '2025-03-22 09:59:00', '2025-03-22 09:59:00', 'Approved', 'personnel', '2025-03-24', 'Driving License', '12345678909876543', 'uploads/ids/67e0fe35cbbf2_passport.jpg', '$2y$10$JfrZcI.K56D4PS4XV7KX6.bB2QO4p8w.P3.EK8/H6yvhIobpmTMxi', 0, '97d6e29b94b0'),
(855621798, 14, 'Habibat', 'ummy', 'eva@mer', '987654321', 987890, 'Night Shift', 'Female', 'moshi', '2025-03-23 09:27:27', '2025-03-23 09:27:27', 'Pending', 'personnel', NULL, NULL, NULL, NULL, NULL, 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daily_report`
--
ALTER TABLE `daily_report`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `hiring_requests`
--
ALTER TABLE `hiring_requests`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daily_report`
--
ALTER TABLE `daily_report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hiring_requests`
--
ALTER TABLE `hiring_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `daily_report`
--
ALTER TABLE `daily_report`
  ADD CONSTRAINT `daily_report_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `hiring_requests` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
