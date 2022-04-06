-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 06, 2022 at 10:55 AM
-- Server version: 10.3.27-MariaDB-0+deb10u1
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `MissMatch`
--

-- --------------------------------------------------------

--
-- Table structure for table `mismatch_category`
--

CREATE TABLE `mismatch_category` (
  `category_id` int(11) NOT NULL,
  `name` varchar(48) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mismatch_category`
--

INSERT INTO `mismatch_category` (`category_id`, `name`) VALUES
(1, 'Appearance'),
(2, 'Entertainment'),
(3, 'Food'),
(4, 'People'),
(5, 'Activities');

-- --------------------------------------------------------

--
-- Table structure for table `mismatch_response`
--

CREATE TABLE `mismatch_response` (
  `response_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `topic_id` int(11) DEFAULT NULL,
  `response` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mismatch_response`
--

INSERT INTO `mismatch_response` (`response_id`, `user_id`, `topic_id`, `response`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 2),
(3, 1, 3, 1),
(4, 1, 4, 2),
(5, 1, 5, 1),
(6, 1, 6, 1),
(7, 1, 7, 2),
(8, 1, 8, 1),
(9, 1, 9, 2),
(10, 1, 10, 1),
(11, 1, 11, 1),
(12, 1, 12, 2),
(13, 1, 13, 1),
(14, 1, 14, 2),
(15, 1, 15, 2),
(16, 1, 16, 1),
(17, 1, 17, 2),
(18, 1, 18, 2),
(19, 1, 19, 2),
(20, 1, 20, 1),
(21, 1, 21, 1),
(22, 1, 22, 2),
(23, 1, 23, 1),
(24, 1, 24, 2),
(25, 1, 25, 1),
(26, 9, 1, NULL),
(27, 9, 2, NULL),
(28, 9, 3, NULL),
(29, 9, 4, NULL),
(30, 9, 5, NULL),
(31, 9, 6, NULL),
(32, 9, 7, NULL),
(33, 9, 8, NULL),
(34, 9, 9, NULL),
(35, 9, 10, NULL),
(36, 9, 11, NULL),
(37, 9, 12, NULL),
(38, 9, 13, NULL),
(39, 9, 14, NULL),
(40, 9, 15, NULL),
(41, 9, 16, NULL),
(42, 9, 17, NULL),
(43, 9, 18, NULL),
(44, 9, 19, NULL),
(45, 9, 20, NULL),
(46, 9, 21, NULL),
(47, 9, 22, NULL),
(48, 9, 23, NULL),
(49, 9, 24, NULL),
(50, 9, 25, NULL),
(51, 18, 1, NULL),
(52, 18, 2, NULL),
(53, 18, 3, NULL),
(54, 18, 4, NULL),
(55, 18, 5, NULL),
(56, 18, 6, NULL),
(57, 18, 7, NULL),
(58, 18, 8, NULL),
(59, 18, 9, NULL),
(60, 18, 10, NULL),
(61, 18, 11, NULL),
(62, 18, 12, NULL),
(63, 18, 13, NULL),
(64, 18, 14, NULL),
(65, 18, 15, NULL),
(66, 18, 16, NULL),
(67, 18, 17, NULL),
(68, 18, 18, NULL),
(69, 18, 19, NULL),
(70, 18, 20, NULL),
(71, 18, 21, NULL),
(72, 18, 22, NULL),
(73, 18, 23, NULL),
(74, 18, 24, NULL),
(75, 18, 25, NULL),
(76, 24, 1, 2),
(77, 24, 2, 2),
(78, 24, 3, 2),
(79, 24, 4, 2),
(80, 24, 5, 2),
(81, 24, 6, 2),
(82, 24, 7, 2),
(83, 24, 8, 2),
(84, 24, 9, 2),
(85, 24, 10, 2),
(86, 24, 11, 2),
(87, 24, 12, 2),
(88, 24, 13, 2),
(89, 24, 14, 2),
(90, 24, 15, 2),
(91, 24, 16, 2),
(92, 24, 17, 2),
(93, 24, 18, 2),
(94, 24, 19, 2),
(95, 24, 20, 2),
(96, 24, 21, 2),
(97, 24, 22, 2),
(98, 24, 23, 2),
(99, 24, 24, 2),
(100, 24, 25, 2),
(101, 28, 1, NULL),
(102, 28, 2, NULL),
(103, 28, 3, NULL),
(104, 28, 4, NULL),
(105, 28, 5, NULL),
(106, 28, 6, NULL),
(107, 28, 7, NULL),
(108, 28, 8, NULL),
(109, 28, 9, NULL),
(110, 28, 10, NULL),
(111, 28, 11, NULL),
(112, 28, 12, NULL),
(113, 28, 13, NULL),
(114, 28, 14, NULL),
(115, 28, 15, NULL),
(116, 28, 16, NULL),
(117, 28, 17, NULL),
(118, 28, 18, NULL),
(119, 28, 19, NULL),
(120, 28, 20, NULL),
(121, 28, 21, NULL),
(122, 28, 22, NULL),
(123, 28, 23, NULL),
(124, 28, 24, NULL),
(125, 28, 25, NULL),
(126, 29, 1, 2),
(127, 29, 2, 1),
(128, 29, 3, 2),
(129, 29, 4, 1),
(130, 29, 5, 2),
(131, 29, 6, 1),
(132, 29, 7, 2),
(133, 29, 8, 2),
(134, 29, 9, 1),
(135, 29, 10, 2),
(136, 29, 11, 1),
(137, 29, 12, 2),
(138, 29, 13, 1),
(139, 29, 14, 1),
(140, 29, 15, 2),
(141, 29, 16, 2),
(142, 29, 17, 1),
(143, 29, 18, 2),
(144, 29, 19, 2),
(145, 29, 20, 1),
(146, 29, 21, 2),
(147, 29, 22, 1),
(148, 29, 23, 1),
(149, 29, 24, 2),
(150, 29, 25, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mismatch_topic`
--

CREATE TABLE `mismatch_topic` (
  `topic_id` int(11) NOT NULL,
  `name` varchar(48) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mismatch_topic`
--

INSERT INTO `mismatch_topic` (`topic_id`, `name`, `category_id`) VALUES
(1, 'Tattoos', 1),
(2, 'Gold chains', 1),
(3, 'Body piercings', 1),
(4, 'Cowboy boots', 1),
(5, 'Long hair', 1),
(6, 'Reality TV', 2),
(7, 'Professional wrestling', 2),
(8, 'Horror movies', 2),
(9, 'Easy listening music', 2),
(10, 'The opera', 2),
(11, 'Sushi', 3),
(12, 'Spam', 3),
(13, 'Spicy food', 3),
(14, 'Peanut butter & banana sandwiches', 3),
(15, 'Martinis', 3),
(16, 'Howard Stern', 4),
(17, 'Bill Gates', 4),
(18, 'Barbara Streisand', 4),
(19, 'Hugh Hefner', 4),
(20, 'Martha Stewart', 4),
(21, 'Yoga', 5),
(22, 'Weightlifting', 5),
(23, 'Cube puzzles', 5),
(24, 'Karaoke', 5),
(25, 'Hiking', 5);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `session_id` int(11) NOT NULL,
  `session_token` varchar(40) NOT NULL,
  `session_serial` varchar(40) NOT NULL,
  `session_date` datetime NOT NULL,
  `session_userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`session_id`, `session_token`, `session_serial`, `session_date`, `session_userid`) VALUES
(140, 'QtuwfFBieef2oFoefoREetD35D4dKv', 'QtuwfFBieef2oFoefoREetD35D4dKv', '2022-03-02 00:00:00', 24),
(142, '+7dT2HxF3rpfeeyEukb3sE75To6uT4', '+7dT2HxF3rpfeeyEukb3sE75To6uT4', '2022-03-05 00:00:00', 29),
(159, 'Ep1Key7FpBed1e3Gdif7whdlhTEtdE', 'Ep1Key7FpBed1e3Gdif7whdlhTEtdE', '2022-04-05 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_username` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `user_password` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `user_status` int(1) NOT NULL,
  `user_firstname` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `user_lastname` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `user_gender` int(1) DEFAULT NULL,
  `user_birthdate` datetime DEFAULT NULL,
  `user_city` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `user_state` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `user_picture` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_username`, `user_password`, `user_status`, `user_firstname`, `user_lastname`, `user_gender`, `user_birthdate`, `user_city`, `user_state`, `user_picture`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 'Antonio José', 'García Arias', 1, '2002-12-09 00:00:00', 'Granada', 'ES', 'Brad-Pitt--Mark-Wahlberg.jpeg'),
(22, 'mikiwood', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 0, 'Mike ', 'Rossa', 1, '2001-01-13 00:00:00', 'Brooklyn', 'US', 'descarga.jfif'),
(24, 'pgjavier96', '27306b6520cae541511a9c00c847474a780c6393', 0, 'Javier Pinilla', 'Garrido', 1, '2002-11-09 00:00:00', 'Granada', 'KR', '73525861.jpg'),
(29, 'neomode', '8b625b5e62f043b38a0002c6c93d5d2cc33953ca', 0, 'Mode Pitt', 'Mode', 1, '1991-12-11 00:00:00', 'Grana', 'ES', 'brad-pitt-foto-biografia.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mismatch_category`
--
ALTER TABLE `mismatch_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `mismatch_response`
--
ALTER TABLE `mismatch_response`
  ADD PRIMARY KEY (`response_id`);

--
-- Indexes for table `mismatch_topic`
--
ALTER TABLE `mismatch_topic`
  ADD PRIMARY KEY (`topic_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`session_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mismatch_category`
--
ALTER TABLE `mismatch_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mismatch_response`
--
ALTER TABLE `mismatch_response`
  MODIFY `response_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `mismatch_topic`
--
ALTER TABLE `mismatch_topic`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `session_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
