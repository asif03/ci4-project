-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 17, 2025 at 11:47 AM
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
-- Database: `bcpsedu_application`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicant_information_log`
--

CREATE TABLE `applicant_information_log` (
  `id` bigint(20) NOT NULL,
  `applicant_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `father_spouse_name` varchar(200) DEFAULT NULL,
  `mother_name` varchar(200) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `nataionality` varchar(200) DEFAULT NULL,
  `religion` varchar(200) DEFAULT NULL,
  `nid` varchar(50) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `mobile` varchar(200) DEFAULT NULL,
  `telephone` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `permanent_address` varchar(200) DEFAULT NULL,
  `mbbs_bds_year` varchar(4) DEFAULT NULL,
  `mbbs_institute_id` int(11) DEFAULT NULL,
  `mbbs_bds_institute` varchar(200) DEFAULT NULL,
  `bmdc_reg_type` enum('MBBS','BDS') DEFAULT 'MBBS',
  `bmdc_reg_no` varchar(10) DEFAULT NULL,
  `bmdc_validity` date DEFAULT NULL,
  `speciality_id` int(11) DEFAULT NULL,
  `fcps_speciallity` varchar(200) DEFAULT NULL,
  `fcps_roll` varchar(20) DEFAULT NULL,
  `fcps_year` varchar(4) DEFAULT NULL,
  `fcps_month` varchar(20) DEFAULT NULL,
  `fcps_reg_no` varchar(50) DEFAULT NULL,
  `pen_no` varchar(50) DEFAULT NULL,
  `continuing` int(1) DEFAULT NULL,
  `continuing_start_date` date DEFAULT NULL,
  `continuing_end_date` date DEFAULT NULL,
  `continuing_fcps_traning` int(1) DEFAULT NULL,
  `mid_term_session` enum('January','July') DEFAULT NULL,
  `mid_term_year` year(4) DEFAULT NULL,
  `mid_term_result` enum('Pass','Fail') DEFAULT NULL,
  `mid_term_roll` varchar(50) DEFAULT NULL,
  `account_name` varchar(500) DEFAULT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `bank_name` varchar(200) DEFAULT NULL,
  `branch_name` varchar(200) DEFAULT NULL,
  `account_no` varchar(200) DEFAULT NULL,
  `routing_number` varchar(200) DEFAULT NULL,
  `undertaking_confirmation` int(1) DEFAULT NULL,
  `eligible_status` char(1) DEFAULT 'P' COMMENT 'P=Pending, N=Not Eligible, Y=Eligible',
  `eligible_by` varchar(255) DEFAULT NULL,
  `eligiblity_date` datetime DEFAULT NULL,
  `reject_reason` varchar(255) DEFAULT NULL,
  `rejected_by` varchar(255) DEFAULT NULL,
  `reject_date` datetime DEFAULT NULL,
  `status` int(1) DEFAULT 1,
  `created` datetime DEFAULT current_timestamp(),
  `gander` varchar(20) DEFAULT NULL,
  `action_type` enum('UPDATE','DELETE') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicant_information_log`
--
ALTER TABLE `applicant_information_log`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicant_information_log`
--
ALTER TABLE `applicant_information_log`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
