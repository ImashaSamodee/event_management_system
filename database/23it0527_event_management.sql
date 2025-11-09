-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 09, 2025 at 11:16 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `23it0527_event_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int NOT NULL AUTO_INCREMENT,
  `event_id` varchar(10) NOT NULL,
  `title` varchar(250) NOT NULL,
  `date` date NOT NULL,
  `location` varchar(250) NOT NULL,
  `status` varchar(50) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Event ID` (`event_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_id`, `title`, `date`, `location`, `status`, `description`) VALUES
(2, 'E001', 'AI & Machine Learning Workshop', '2025-11-20', 'Computer Lab 2', 'Upcoming', 'Hands-on workshop to explore AI and ML applications.'),
(3, 'E002', 'Cybersecurity Awareness Seminar', '2025-11-25', 'Main Auditorium', 'Upcoming', 'Educating students about staying safe online.'),
(4, 'E003', 'Creative Arts Festival 2025', '2025-12-02', 'Open Grounds', 'Upcoming', 'Campus-wide celebration of music, dance, and creativity.'),
(5, 'E004', 'Web Design Hackathon 2025', '2025-12-10', 'Smart Classroom 1', 'Upcoming', 'Competitive coding and web design event.'),
(6, 'E005', 'Leadership & Personality Development Workshop', '2026-01-05', 'Seminar Hall', 'Upcoming', 'Personality growth and leadership training.'),
(7, 'E006', 'Environmental Awareness Campaign', '2024-01-20', 'ITUM Garden Area', 'Completed', 'A campus cleanup and tree-planting drive promoting sustainability.'),
(8, 'E007', 'Software Development Bootcamp', '2025-08-05', 'Lab 1', 'Completed', 'A 3-day training session on system development life cycle and coding skills.'),
(9, 'E008', 'Sports Fiesta 2025', '2025-07-11', 'Sports Complex', 'Completed', 'Inter-departmental sports and recreational competitions promoting teamwork.'),
(10, 'E009', 'Asani', '2025-11-20', 'ITUM Main Hall', 'Upcoming', 'A fusion of music and dance to entertain and inspire ITUM students.');

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

DROP TABLE IF EXISTS `registrations`;
CREATE TABLE IF NOT EXISTS `registrations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `student_id` varchar(250) NOT NULL,
  `event_id` varchar(250) NOT NULL,
  `registered_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`id`, `student_id`, `event_id`, `registered_at`) VALUES
(1, '23IT0470', 'E001', '2025-11-09 07:48:33'),
(2, '23IT0527', 'E002', '2025-11-09 07:50:10'),
(3, '23IT0470', 'E007', '2025-11-09 08:13:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `student_id` varchar(250) NOT NULL,
  `full_name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `contact_no` int NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `Student ID` (`student_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `student_id`, `full_name`, `email`, `contact_no`, `password`, `role`) VALUES
(1, '23IT0470', 'Umindu Dinal', 'umindudinal@gmail.com', 779648818, '123456', 'student'),
(4, '24IT0470', 'Samaranayake', 'samaranayake@gmail.com', 54257238, '$2y$10$TOEpyCq1j8GsXYb9ML.pA.FXQZ3AAs2TyiFHMnQj0pqR0FugQuCau', 'student'),
(3, '23IT0527', 'J.B.A. Imasha Samodee', 'imashasamodee@gmail.com', 779143351, 'Imasha@123', 'admin');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
