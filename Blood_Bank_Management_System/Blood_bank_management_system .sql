-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 20, 2025 at 05:49 AM
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
-- Database: `Blood bank management system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(20) NOT NULL,
  `username` text NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'manvir', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `blood_donor_registration`
--

CREATE TABLE `blood_donor_registration` (
  `id` int(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blood_donor_registration`
--

INSERT INTO `blood_donor_registration` (`id`, `email`, `username`, `password`) VALUES
(1, 'manvirsinghghatorey104@gmail.com', 'Manvir_Singh', '123'),
(2, 'manvir123@gmail.com', 'manvir', '098765');

-- --------------------------------------------------------

--
-- Table structure for table `blood_seeker_registration`
--

CREATE TABLE `blood_seeker_registration` (
  `id` int(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blood_seeker_registration`
--

INSERT INTO `blood_seeker_registration` (`id`, `email`, `username`, `password`) VALUES
(1, 'manjot243@gmail.com', 'manjot', '123');

-- --------------------------------------------------------

--
-- Table structure for table `camp_registrations`
--

CREATE TABLE `camp_registrations` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `blood_group` varchar(10) NOT NULL,
  `city` varchar(100) NOT NULL,
  `registered_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `camp_registrations`
--

INSERT INTO `camp_registrations` (`id`, `event_id`, `name`, `email`, `phone`, `blood_group`, `city`, `registered_at`) VALUES
(1, 3, 'Manvir singh', 'manvirsinghghatorey104@gmail.com', '9915803830', 'A+', 'ludhiana', '2025-05-20 03:13:41'),
(2, 1, 'jaspreet Singh', 'jaspreet4590@gmail.com', '9823728227', 'B+', 'ludhiana', '2025-05-20 03:14:54'),
(3, 3, 'Manvir singh', 'mani123@gmail.com', '9823728226', 'O-', 'ludhiana', '2025-05-20 03:27:24');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(20) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `message`) VALUES
(1, 'jaspreet Singh', 'jaspreet4590@gmail.com', 'Hi ,I want to know the availability of O+ blood group');

-- --------------------------------------------------------

--
-- Table structure for table `donor_details`
--

CREATE TABLE `donor_details` (
  `id` int(20) NOT NULL,
  `username` text NOT NULL,
  `age` int(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pno` varchar(30) NOT NULL,
  `address` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `state` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `blood_group` varchar(10) NOT NULL,
  `health_issues` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donor_details`
--

INSERT INTO `donor_details` (`id`, `username`, `age`, `email`, `pno`, `address`, `image`, `state`, `city`, `blood_group`, `health_issues`) VALUES
(1, 'Manvir_Singh', 22, 'manvirsinghghatorey104@gmail.com', '9915803830', '#6658,st no:7, new janta nagar,ludhiana', 'boy.jpeg', 'Punjab', 'Ludhiana', 'O+', ''),
(2, 'manvir', 21, 'mani123@gmail.com', '8925273716', '#1356,6/10,golden park ,ludhiana', 'boy.jpeg', 'Punjab', 'Jalandhar', 'O-', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `emergency`
--

CREATE TABLE `emergency` (
  `id` int(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `mapLink` text NOT NULL,
  `phone` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emergency`
--

INSERT INTO `emergency` (`id`, `address`, `mapLink`, `phone`) VALUES
(1, '#6658,st no:-5 ,new janta nagar ,ludhiana', 'https://www.google.com/maps/@30.8707328,75.8644736,14z?entry=ttu&g_ep=EgoyMDI1MDUxNS4wIKXMDSoASAFQAw%3D%3D', '9823728226');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(20) NOT NULL,
  `blood_camp_name` text NOT NULL,
  `location` text NOT NULL,
  `calendar` date NOT NULL,
  `starttime` time NOT NULL,
  `endtime` time NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `blood_camp_name`, `location`, `calendar`, `starttime`, `endtime`, `image`) VALUES
(1, 'Save Lives Initiative', 'ludhiana', '2025-04-05', '12:00:00', '15:00:00', 'bc.jpeg'),
(2, 'become a life saver', 'moga', '2025-04-30', '10:00:00', '13:00:00', 'download (5).jpeg'),
(3, 'Pure Hearts Blood Camp', 'barnala', '2025-04-13', '05:21:00', '06:22:00', 'blood camp.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blood_donor_registration`
--
ALTER TABLE `blood_donor_registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blood_seeker_registration`
--
ALTER TABLE `blood_seeker_registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `camp_registrations`
--
ALTER TABLE `camp_registrations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donor_details`
--
ALTER TABLE `donor_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emergency`
--
ALTER TABLE `emergency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blood_donor_registration`
--
ALTER TABLE `blood_donor_registration`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `blood_seeker_registration`
--
ALTER TABLE `blood_seeker_registration`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `camp_registrations`
--
ALTER TABLE `camp_registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `donor_details`
--
ALTER TABLE `donor_details`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `emergency`
--
ALTER TABLE `emergency`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
