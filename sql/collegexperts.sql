-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2016 at 11:19 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `collegexperts`
--
CREATE DATABASE IF NOT EXISTS `collegexperts` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `collegexperts`;

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `from_type` varchar(20) NOT NULL,
  `to_ids` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `state_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `name`, `state_id`, `country_id`) VALUES
(1, 'Stanford', 1, 1),
(2, 'Mumbai', 3, 4),
(3, 'Cambridge', 4, 1),
(4, 'Los Angeles', 1, 1),
(5, 'San Fransisco', 1, 1),
(6, 'San Diego', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `name`) VALUES
(1, 'United States'),
(2, 'Canada'),
(3, 'Great Britain'),
(4, 'India'),
(5, 'China'),
(6, 'Singapore'),
(7, 'Australia');

-- --------------------------------------------------------

--
-- Table structure for table `degree`
--

CREATE TABLE IF NOT EXISTS `degree` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `duration` int(2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `degree`
--

INSERT INTO `degree` (`id`, `name`, `type`, `duration`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Bachelor of Arts (B.A.)', 2, 3, 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00'),
(2, 'Bachelors in Aeronautics', 2, 4, 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `degree_level`
--

CREATE TABLE IF NOT EXISTS `degree_level` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `degree_level`
--

INSERT INTO `degree_level` (`id`, `name`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Under Graduate', 1, '2016-09-24 06:23:18', 1, '2016-09-24 06:23:45'),
(2, 'Post Graduate', 1, '2016-09-24 06:23:35', 1, '2016-09-24 06:23:35'),
(3, 'Diploma', 1, '2016-09-24 06:23:52', 1, '2016-09-24 06:23:52'),
(4, 'Doctoral', 1, '2016-09-24 06:24:01', 1, '2016-09-24 06:24:01');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` int(11) NOT NULL,
  `country` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `first_name`, `last_name`, `date_of_birth`, `gender`, `address`, `street`, `city`, `state`, `country`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'admin', 'admin', '2016-08-01', 'M', 'address', 'street', 'Mumbai', 1, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(2, 'editor', 'editor', '2016-08-24', 'M', 'address', 'street', 'California', 3, 4, 0, '0000-00-00 00:00:00', 1, '2016-09-24 06:14:31'),
(3, 'srm', 'srm', '2016-08-24', 'F', 'address', 'street', 'Mumbai', 1, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `employee_login`
--

CREATE TABLE IF NOT EXISTS `employee_login` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `auth_key` varchar(255) NOT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `status` smallint(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `role_id` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_login`
--

INSERT INTO `employee_login` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`, `employee_id`, `role_id`) VALUES
(1, 'admin', '5hWkWLknpa58_h-d3joZauQbAIXChgWO', '$2y$13$Otq0KVyzAC.B1H5HNJdus./5nusVxAy9.TXVWj3c0WNWfL9AYNvrC', '', 'admin@gmail.com', 10, '2016-08-24 11:10:37', '2016-08-24 11:10:37', 1, 1, 1, 1),
(2, 'editor', 'nHKJB130i3BAbyOnf9qOojDx3TWzoLSf', '$2y$13$TwTmQJ0cOtUdKVLNYFy4R.sVWJu5LNBV8RCjnGh2V9ZiDo7ROfgz2', NULL, 'editor@gmail.com', 10, '2016-08-24 11:25:19', '2016-08-24 11:25:19', 2, 2, 2, 2),
(3, 'srm', '_yrFIhkbjiDiMuU12tzxd1mIrhKLyweZ', '$2y$13$L7z3UO0mCffhXNknNKCWAuXCNEywOcFSzva5U8z7T3b5NwrUbA4fq', NULL, '', 10, '2016-08-24 11:27:08', '2016-08-24 11:27:08', 3, 3, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `majors`
--

CREATE TABLE IF NOT EXISTS `majors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `majors`
--

INSERT INTO `majors` (`id`, `name`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Anthropology Honors', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00'),
(2, 'Art History', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00'),
(3, 'Asian Studies', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00'),
(4, 'Aeronautics and Astronautics', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1471935561),
('m130524_201442_init', 1471935631);

-- --------------------------------------------------------

--
-- Table structure for table `others`
--

CREATE TABLE IF NOT EXISTS `others` (
  `name` varchar(50) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `others`
--

INSERT INTO `others` (`name`, `value`) VALUES
('course_type', 'Full Time, Part Time, Offline'),
('establishment', 'Public,Private'),
('institution_type', 'University,College');

-- --------------------------------------------------------

--
-- Table structure for table `partner`
--

CREATE TABLE IF NOT EXISTS `partner` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `city` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `country` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `partner`
--

INSERT INTO `partner` (`id`, `first_name`, `last_name`, `date_of_birth`, `gender`, `address`, `street`, `city`, `state`, `country`) VALUES
(1, 'university', 'university', '2016-08-11', 'M', 'address', 'street', 1, 1, 1),
(2, 'partner', 'partner', '2016-08-03', 'F', 'address', 'street', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `partner_login`
--

CREATE TABLE IF NOT EXISTS `partner_login` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `auth_key` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `status` smallint(6) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `partner_id` int(11) NOT NULL,
  `role_id` smallint(6) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `partner_login`
--

INSERT INTO `partner_login` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`, `partner_id`, `role_id`) VALUES
(1, 'university', 'Gp1GZ1WSp5idoXkvMRFxEgRgRW1VmwBm', '$2y$13$EgrnQmI2YepoIaNWlXgNuuo3uRlpOJgV9eFqS.MugIJIXTMGIW4EK', NULL, 'university@gmail.com', 10, '2016-08-24 11:33:31', '2016-08-24 11:33:31', 1, 1, 1, 5),
(2, 'partner', 'RtRKT7tBBob_z9tDtPHd1sh5_tJZU1Cn', '$2y$13$/fjoAazH/J9ygw6uKlU3PeWH9iv3vMR3Qc2WJy8JsdDEY.02kAvWm', NULL, 'partner@gmail.com', 10, '2016-08-24 11:34:33', '2016-08-24 11:34:33', 2, 2, 2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE IF NOT EXISTS `state` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `country_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `name`, `country_id`) VALUES
(1, 'California', 1),
(2, 'Maryland', 1),
(3, 'Maharashtra', 4),
(4, 'Massachusetts', 1),
(5, 'Hawaii', 1),
(6, 'Florida', 1),
(7, 'Texas', 1),
(8, 'Pennsylvania', 1),
(9, 'Alaska', 1),
(10, 'Minnesota', 1),
(11, 'Georgia', 1),
(12, 'New Jersey', 1),
(13, 'Louisiana', 1),
(14, 'North Carolina', 1),
(15, 'Alabama', 1),
(16, 'Arizona', 1),
(17, 'Illinois', 1),
(18, 'Virginia', 1),
(19, 'Colorado', 1),
(20, 'Michigan', 1),
(21, 'Tennessee', 1),
(22, 'Ohio', 1),
(23, 'Kentucky', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `parent_email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `parent_phone` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `first_name`, `last_name`, `nationality`, `date_of_birth`, `gender`, `address`, `street`, `city`, `state`, `country`, `pincode`, `email`, `parent_email`, `phone`, `parent_phone`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'student', 'student', 'Indian', '2016-08-11', 'F', 'address', 'street', 'mumbai', 'maharashtra', 'India', '400089', 'student@gmail.com', 'student_parent@gmail.com', '4565656', '5454646', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `student_college_detail`
--

CREATE TABLE IF NOT EXISTS `student_college_detail` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `from_date` year(4) NOT NULL,
  `to_date` year(4) NOT NULL,
  `curriculum` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_college_detail`
--

INSERT INTO `student_college_detail` (`id`, `student_id`, `name`, `from_date`, `to_date`, `curriculum`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(3, 1, 'College ABC', 2008, 2012, 'BE Computer Science', 1, 1, '2016-09-11 08:15:45', '2016-09-11 08:15:45'),
(4, 1, 'College DE', 2013, 2015, 'MS Computer Science', 1, 1, '2016-09-11 08:15:45', '2016-09-11 08:15:45');

-- --------------------------------------------------------

--
-- Table structure for table `student_english_language_proficiencey_details`
--

CREATE TABLE IF NOT EXISTS `student_english_language_proficiencey_details` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `test_name` varchar(255) NOT NULL,
  `reading_score` int(11) NOT NULL,
  `writing_score` int(11) NOT NULL,
  `listening_score` int(11) NOT NULL,
  `speaking_score` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `created_by` datetime NOT NULL,
  `updated_by` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_english_language_proficiencey_details`
--

INSERT INTO `student_english_language_proficiencey_details` (`id`, `student_id`, `test_name`, `reading_score`, `writing_score`, `listening_score`, `speaking_score`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 1, 'IELTS', 10, 10, 10, 10, 2016, 2016, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `student_school_detail`
--

CREATE TABLE IF NOT EXISTS `student_school_detail` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `from_date` year(4) NOT NULL,
  `to_date` year(4) NOT NULL,
  `curriculum` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_school_detail`
--

INSERT INTO `student_school_detail` (`id`, `student_id`, `name`, `from_date`, `to_date`, `curriculum`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'School ABC', 1995, 2006, 'SSC', 1, 1, '2016-09-11 08:15:45', '2016-09-11 08:15:45'),
(2, 1, 'High School ABC', 2006, 2008, 'HSC', 1, 1, '2016-09-11 08:15:45', '2016-09-11 08:15:45');

-- --------------------------------------------------------

--
-- Table structure for table `student_standard_test_detail`
--

CREATE TABLE IF NOT EXISTS `student_standard_test_detail` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `test_name` varchar(255) NOT NULL,
  `verbal_score` int(11) NOT NULL,
  `quantitative_score` int(11) NOT NULL,
  `integrated_reasoning_score` int(11) NOT NULL,
  `data_interpretation_score` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_standard_test_detail`
--

INSERT INTO `student_standard_test_detail` (`id`, `student_id`, `test_name`, `verbal_score`, `quantitative_score`, `integrated_reasoning_score`, `data_interpretation_score`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'GMAT', 200, 200, 200, 200, 1, 1, '2016-09-11 08:15:45', '2016-09-11 08:15:45');

-- --------------------------------------------------------

--
-- Table structure for table `student_subject_detail`
--

CREATE TABLE IF NOT EXISTS `student_subject_detail` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `maximum_marks` int(11) NOT NULL,
  `marks_obtained` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_subject_detail`
--

INSERT INTO `student_subject_detail` (`id`, `student_id`, `name`, `maximum_marks`, `marks_obtained`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'Physics', 100, 78, 1, 1, '2016-09-11 08:15:45', '2016-09-11 08:15:45'),
(2, 1, 'Chemistry', 100, 68, 1, 1, '2016-09-11 08:15:45', '2016-09-11 08:15:45'),
(3, 1, 'Maths', 100, 88, 1, 1, '2016-09-11 08:15:45', '2016-09-11 08:15:45');

-- --------------------------------------------------------

--
-- Table structure for table `university`
--

CREATE TABLE IF NOT EXISTS `university` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `establishment_date` date DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `city_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `pincode` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `phone_1` varchar(20) NOT NULL,
  `phone_2` varchar(20) DEFAULT NULL,
  `contact_person` varchar(255) NOT NULL,
  `contact_person_designation` varchar(50) NOT NULL,
  `contact_mobile` varchar(15) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `location` point DEFAULT NULL,
  `institution_type` int(11) DEFAULT NULL,
  `establishment` int(11) DEFAULT NULL,
  `no_of_students` int(11) DEFAULT NULL,
  `no_of_undergraduate_students` int(11) DEFAULT NULL,
  `no_of_post_graduate_students` int(11) DEFAULT NULL,
  `no_of_international_students` int(11) DEFAULT NULL,
  `no_faculties` int(11) DEFAULT NULL,
  `no_of_international_faculty` int(11) DEFAULT NULL,
  `cost_of_living` int(11) DEFAULT NULL,
  `undergarduate_fees` int(11) DEFAULT NULL,
  `undergraduate_fees_international_students` int(11) DEFAULT NULL,
  `post_graduate_fees` int(11) DEFAULT NULL,
  `post_graduate_fees_international_students` int(11) DEFAULT NULL,
  `accomodation_available` bit(1) NOT NULL DEFAULT b'0',
  `hostel_strength` int(11) DEFAULT NULL,
  `institution_ranking` text,
  `video` varchar(500) DEFAULT NULL,
  `virtual_tour` varchar(500) DEFAULT NULL,
  `avg_rating` int(11) DEFAULT NULL,
  `standard_tests_required` bit(1) DEFAULT b'0',
  `standard_test_list` varchar(500) DEFAULT NULL,
  `achievements` text,
  `comments` text,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `reviewed_by` int(11) DEFAULT NULL,
  `reviewed_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `university`
--

INSERT INTO `university` (`id`, `name`, `establishment_date`, `address`, `city_id`, `state_id`, `country_id`, `pincode`, `email`, `website`, `description`, `fax`, `phone_1`, `phone_2`, `contact_person`, `contact_person_designation`, `contact_mobile`, `contact_email`, `location`, `institution_type`, `establishment`, `no_of_students`, `no_of_undergraduate_students`, `no_of_post_graduate_students`, `no_of_international_students`, `no_faculties`, `no_of_international_faculty`, `cost_of_living`, `undergarduate_fees`, `undergraduate_fees_international_students`, `post_graduate_fees`, `post_graduate_fees_international_students`, `accomodation_available`, `hostel_strength`, `institution_ranking`, `video`, `virtual_tour`, `avg_rating`, `standard_tests_required`, `standard_test_list`, `achievements`, `comments`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`, `reviewed_by`, `reviewed_at`) VALUES
(1, 'Stanford University', '1885-11-11', ' 450 Serra Mall', 1, 1, 1, 94305, 'gradadmissions@stanford.edu', 'https://www.stanford.edu', '<p>Stanford University, located between San Francisco and San Jose in the heart of California&#39;s Silicon Valley, is one of the world&#39;s leading teaching and research universities. Since its opening in 1891, Stanford has been dedicated to finding solutions to big challenges and to preparing students for leadership in a complex world.</p>\r\n', '650-723-8371', '+1-866-432-7472', '', 'Graduate Admissions', 'Graduate Admissions', '+1-866-432-7472', 'gradadmissions@stanford.edu', '\0\0\0\0\0\0\0�\nC��B@����^�', 0, 0, 16112, NULL, NULL, 6994, 528, NULL, 106502, NULL, NULL, NULL, NULL, b'1', 1500, '[{"rank":"3","source":"www.webometrics.info/en/world"},{"rank":"2","source":"http://www.topuniversities.com/universities/stanford-university"}]', '', '', NULL, b'1', '0', '', '', 10, 1, '2016-09-09 09:19:38', 1, '2016-09-26 06:01:21', NULL, NULL),
(5, 'Massachusetts Institute of Technology', '1861-04-10', ' 77 Massachusetts Ave', 3, 4, 1, 2139, 'web-query@mit.edu', 'http://web.mit.edu/', 'The mission of the Massachusetts Institute of Technology is to advance knowledge and educate students in science, technology, and other areas of scholarship that will best serve the nation and the world in the 21st century. We are also driven to bring knowledge to bear on the world’s great challenges.\r\n\r\nThe Institute is an independent, coeducational, privately endowed university, organized into five Schools (architecture and planning; engineering; humanities, arts, and social sciences; management; and science). It has some 1,000 faculty members, more than 11,000 undergraduate and graduate students, and more than 130,000 living alumni.\r\n\r\nAt its founding in 1861, MIT was an educational innovation, a community of hands-on problem solvers in love with fundamental science and eager to make the world a better place. Today, that spirit still guides how we educate students on campus and how we shape new digital learning technologies to make MIT teaching accessible to millions of learners around the world.\r\n\r\nMIT’s spirit of interdisciplinary exploration has fueled many scientific breakthroughs and technological advances. A few examples: the first chemical synthesis of penicillin and vitamin A. The development of radar and creation of inertial guidance systems. The invention of magnetic core memory, which enabled the development of digital computers. Major contributions to the Human Genome Project. The discovery of quarks. The invention of the electronic spreadsheet and of encryption systems that enable e-commerce. The creation of GPS. Pioneering 3D printing. The concept of the expanding universe.\r\n\r\nCurrent research and education areas include digital learning; nanotechnology; sustainable energy, the environment, climate adaptation, and global water and food security; Big Data, cybersecurity, robotics, and artificial intelligence; human health, including cancer, HIV, autism, Alzheimer’s, and dyslexia; biological engineering and CRISPR technology; poverty alleviation; advanced manufacturing; and innovation and entrepreneurship.\r\n\r\nMIT’s impact also includes the work of our alumni. One way MIT graduates drive progress is by starting companies that deliver new ideas to the world. A recent study estimates that as of 2014, living MIT alumni have launched more than 30,000 active companies, creating 4.6 million jobs and generating roughly $1.9 trillion in annual revenue. Taken together, this "MIT Nation" is equivalent to the 10th-largest economy in the world!', '617.253.3400', '617.253.3400', '617.253.3400', 'MIT Admin', 'Admin', '617.253.3400', 'web-query@mit.edu', '\0\0\0\0\0\0\0��U�5E@\0\0\0W�Q�', 1, 1, 11319, NULL, NULL, 5400, 500, NULL, 100000, NULL, NULL, NULL, NULL, b'1', NULL, NULL, '', '', NULL, b'0', NULL, NULL, '', 10, 1, '2016-09-10 06:52:54', 1, '2016-09-10 07:23:50', NULL, NULL),
(40, 'dscdcd', '2016-09-28', 'vfvf', 2, 3, 4, 1005646, 'cdvfdv@asa.cpm', 'vfvgfbgf.com', '<p>ngnfgn</p>\r\n', '45645645', '654565', '545645', 'vfjbjkfgbj', 'jnvjkfnbjkng', '4545645', 'nbjkgnbng@jvfj.com', '\0\0\0\0\0\0\0q��s3@\r馃+8R@', 0, 0, 1000, NULL, NULL, 100, 100, 25, 250000, NULL, NULL, NULL, NULL, b'1', 700, '3', '', '', NULL, b'1', '0', '', NULL, 0, 1, '2016-09-20 13:42:33', 1, '2016-09-20 13:42:33', NULL, NULL),
(41, 'dscdcd', '2016-09-29', 'vfvf', 2, 3, 4, 1005646, 'cdvfdv@asa.cpm', 'vfvgfbgf.com', '<p>bggfngfnh</p>\r\n', '45645645', '654565', '545645', 'vfjbjkfgbj', 'jnvjkfnbjkng', '4545645', 'nbjkgnbng@jvfj.com', '\0\0\0\0\0\0\0q��s3@\r馃+8R@', 0, 0, 1000, NULL, NULL, 100, 100, 25, 250000, NULL, NULL, NULL, NULL, b'1', 700, '3', '', '', NULL, b'1', '0', '', NULL, 0, 1, '2016-09-20 14:52:45', 1, '2016-09-20 14:52:45', NULL, NULL),
(42, 'gfnbgn', '2016-09-29', 'gnngng', 2, 3, 4, 145252, 'nhnhn@nhjn.con', 'fbfgbgf.vghhj.com', '<p>fbfdgdbg<span style="color:#00FF00">bfbfbgfngfn</span><span style="color:#FF0000">nhgmnghmhm</span></p>\r\n', '3538396', '25235353', '35365365', 'dfcdsvdfv', 'gvfgbdfbgfh', '2553663', 'nhnhn@nhjn.con', '\0\0\0\0\0\0\0q��s3@\r馃+8R@', 0, 0, 10000, NULL, NULL, 1200, 1450, 120, 15000, NULL, NULL, NULL, NULL, b'1', 1200, '78', '', '', NULL, b'0', '0,1,2,3,4', '', NULL, 0, 1, '2016-09-21 01:27:14', 1, '2016-09-24 06:48:52', NULL, NULL),
(43, 'gfnbgn', '2016-09-28', 'gnngng', 2, 3, 4, 145252, 'nhnhn@nhjn.con', 'fbfgbgf.vghhj.com', '<p>cvdsvsd</p>\r\n', '3538396', '25235353', '35365365', 'dfcdsvdfv', 'gvfgbdfbgfh', '2553663', 'nhnhn@nhjn.con', '\0\0\0\0\0\0\0q��s3@\r馃+8R@', 0, 0, 10000, NULL, NULL, 1200, 1450, 120, 15000, NULL, NULL, NULL, NULL, b'1', 1200, '78', '', '', NULL, b'0', '0,1,2,3,4', '', NULL, 0, 1, '2016-09-21 02:11:58', 1, '2016-09-23 18:41:45', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `university_admission`
--

CREATE TABLE IF NOT EXISTS `university_admission` (
  `id` int(11) NOT NULL,
  `university_id` int(11) NOT NULL,
  `degree_level_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `admission_link` varchar(500) NOT NULL,
  `eligibility_criteria` text NOT NULL,
  `admission_fees` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `university_admission`
--

INSERT INTO `university_admission` (`id`, `university_id`, `degree_level_id`, `start_date`, `end_date`, `admission_link`, `eligibility_criteria`, `admission_fees`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 42, 1, '2016-08-31', '2016-10-29', 'bgfngfn', 'gvbngf', 1000, 1, '2016-09-24 06:48:52', 1, '2016-09-24 06:48:52'),
(2, 42, 2, '2016-09-09', '2016-09-30', 'hkjhkjhy', 'cxscdc', 1500, 1, '2016-09-24 06:48:52', 1, '2016-09-24 06:48:52'),
(3, 1, 1, '2016-09-07', '2016-09-11', 'bvbv', 'vvsd', 1000, 1, '2016-09-26 06:01:21', 1, '2016-09-26 06:01:21');

-- --------------------------------------------------------

--
-- Table structure for table `university_course_list`
--

CREATE TABLE IF NOT EXISTS `university_course_list` (
  `id` int(11) NOT NULL,
  `university_id` int(11) NOT NULL,
  `degree_id` int(11) NOT NULL,
  `major_id` int(11) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `intake` int(11) NOT NULL,
  `fees` int(11) NOT NULL,
  `duration` decimal(2,1) NOT NULL,
  `type` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=185 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `university_course_list`
--

INSERT INTO `university_course_list` (`id`, `university_id`, `degree_id`, `major_id`, `department_id`, `name`, `intake`, `fees`, `duration`, `type`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 'Bachelor of Arts (B.A.) Anthropology Honors', 60, 80000, '3.0', 1, 1, '2016-09-11 09:32:03', 1, '2016-09-26 06:01:21'),
(55, 40, 1, 1, 59, 'Bachelor of Arts (B.A.) Anthropology Honors', 60, 80000, '3.0', 0, 1, '2016-09-20 13:42:33', 1, '2016-09-20 13:42:33'),
(94, 41, 1, 1, 60, 'Bachelor of Arts (B.A.) Anthropology Honors', 60, 80000, '3.0', 0, 1, '2016-09-20 14:52:45', 1, '2016-09-20 14:52:45'),
(129, 42, 1, 1, 61, 'Bachelor of Arts (B.A.) Anthropology Honors', 100, 15200, '3.0', 0, 1, '2016-09-21 03:44:47', 1, '2016-09-24 06:48:52'),
(172, 43, 2, 4, 62, 'Bachelors in Aeronautics Aeronautics and Astronautics', 150, 152000, '5.0', 0, 1, '2016-09-22 23:02:58', 1, '2016-09-23 18:41:45'),
(181, 43, 1, 3, 62, 'Bachelor of Arts (B.A.) Asian Studies', 150, 152000, '5.0', 0, 1, '2016-09-22 23:05:44', 1, '2016-09-23 18:41:45'),
(182, 43, 1, 2, 80, 'Bachelor of Arts (B.A.) Art History', 540, 7000, '4.0', 0, 1, '2016-09-22 23:07:03', 1, '2016-09-23 18:41:45'),
(183, 43, 2, 4, 80, 'Bachelors in Aeronautics Aeronautics and Astronautics', 150, 152000, '5.0', 0, 1, '2016-09-22 23:07:03', 1, '2016-09-23 18:41:45'),
(184, 1, 1, 1, 2, 'Bachelor of Arts (B.A.) Anthropology Honors', 100, 1000, '3.0', 0, 1, '2016-09-26 06:01:21', 1, '2016-09-26 06:01:21');

-- --------------------------------------------------------

--
-- Table structure for table `university_departments`
--

CREATE TABLE IF NOT EXISTS `university_departments` (
  `id` int(11) NOT NULL,
  `university_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_of_faculty` int(11) DEFAULT NULL,
  `website_link` text,
  `description` text,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `university_departments`
--

INSERT INTO `university_departments` (`id`, `university_id`, `name`, `email`, `no_of_faculty`, `website_link`, `description`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 1, 'Aeronautics & Astronautics', 'aa@stanford.com', 100, 'https://aa.stanford.edu/', 'Aeronautics & Astronautics', 1, '2016-09-26 06:01:21', 1, '2016-09-26 06:01:21'),
(2, 1, 'Anthropology', 'aa@stanford.com', 20, 'https://anthropology.stanford.edu/', 'The Department of Anthropology offers a wide range of approaches to the topics and area studies within the field, including archaeology, ecology, environmental anthropology, evolution, linguistics, medical anthropology, political economy, science and technology studies, and sociocultural anthropology. Methodologies for the study of micro- and macro-social processes are taught through the use of qualitative and quantitative approaches. The department provides students with excellent training in theory and methods to enable them to pursue graduate study in any of the above mentioned subfields of Anthropology.', 1, '2016-09-26 06:01:21', 1, '2016-09-26 06:01:21'),
(5, 5, 'Architecture', '', 50, 'http://architecture.mit.edu/', 'Architecture was one of the four original departments at MIT, and it was the first signal that MIT would not be narrowly defined in science and technology. Through recognition of architecture as a liberal discipline, the Department has long contributed to learning in the arts and humanities at MIT.\r\n\r\nThe Department conceives of architecture as a discipline as well as a profession. It is structured in five semi-autonomous discipline groups: Architectural Design; Building Technology; Computation; History, Theory and Criticism of Architecture and Art; and Art, Culture, and Technology. Each provides an architectural education that is as complex as the field itself, and all five contribute to a mutual enterprise. The department also has specialized graduate programs such as the Aga Khan Program for Islamic Architecture and the SMArchS Program Architecture and Urbanism.\r\n\r\nThe several disciplines of the Department house a substantial body of research activity. Moreover, the Department''s setting within MIT permits greater depth in such technical areas as computation, new modes of design and production, materials, structure, and energy, as well as in the arts and humanities. The Department is committed to a concern for human values and for finding appropriate roles for architecture in society. It is a place where individual creativity is cultivated and nurtured in a framework of values that are humanistically, socially, and environmentally responsible.', 1, '2016-09-10 07:23:50', 1, '2016-09-10 07:23:50'),
(59, 40, 'Anthropology', 'aa@bvf.com', 10, '1vfnbjgfbgf', ' bngfngfn', 1, '2016-09-20 13:42:33', 1, '2016-09-20 13:42:33'),
(60, 41, 'Anthropology', 'aa@bvf.com', 10, '1vfnbjgfbgf', 'ghgfh', 1, '2016-09-20 14:52:45', 1, '2016-09-20 14:52:45'),
(61, 42, 'bbfgb', 'nhnhn@nhjn.con', 110, 'gnfbnfgnfgnhg', 'vdsvsdvs', 1, '2016-09-24 06:48:52', 1, '2016-09-24 06:48:52'),
(62, 43, 'bbfgb', 'nhnhn@nhjn.con', 110, 'gnfbnfgnfgnhg', 'sacsac', 1, '2016-09-23 18:41:45', 1, '2016-09-23 18:41:45'),
(80, 43, 'test', 'nhnhn@nhjn.con', 110, 'gnfbnfgnfgnhg', 'vbvb', 1, '2016-09-23 18:41:45', 1, '2016-09-23 18:41:45');

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE IF NOT EXISTS `user_login` (
  `id` int(11) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`, `user_id`, `role_id`) VALUES
(1, 'student', 'uugfBINmOthA3TDn5cj9LG7wiCu92wjY', '$2y$13$EiRUbUpNdwO6sfJvQMq0y.TSd7d7DHmwgrqDtVMbhL6wZci/qx8QG', NULL, 'student@gmail.com', 10, '2016-09-10 00:00:00', '2016-09-10 00:00:00', 1, 1, 1, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`), ADD KEY `student` (`form_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`), ADD KEY `country_id` (`country_id`), ADD KEY `state_id` (`state_id`), ADD KEY `id` (`id`), ADD KEY `id_2` (`id`), ADD KEY `id_3` (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`), ADD KEY `id` (`id`);

--
-- Indexes for table `degree`
--
ALTER TABLE `degree`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`), ADD UNIQUE KEY `name_2` (`name`,`type`);

--
-- Indexes for table `degree_level`
--
ALTER TABLE `degree_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`), ADD KEY `state` (`state`), ADD KEY `country` (`country`);

--
-- Indexes for table `employee_login`
--
ALTER TABLE `employee_login`
  ADD PRIMARY KEY (`id`), ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `majors`
--
ALTER TABLE `majors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `others`
--
ALTER TABLE `others`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `partner`
--
ALTER TABLE `partner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partner_login`
--
ALTER TABLE `partner_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`), ADD KEY `country_id` (`country_id`), ADD KEY `id` (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`), ADD KEY `city` (`city`);

--
-- Indexes for table `student_college_detail`
--
ALTER TABLE `student_college_detail`
  ADD PRIMARY KEY (`id`), ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `student_english_language_proficiencey_details`
--
ALTER TABLE `student_english_language_proficiencey_details`
  ADD PRIMARY KEY (`id`), ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `student_school_detail`
--
ALTER TABLE `student_school_detail`
  ADD PRIMARY KEY (`id`), ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `student_standard_test_detail`
--
ALTER TABLE `student_standard_test_detail`
  ADD PRIMARY KEY (`id`), ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `student_subject_detail`
--
ALTER TABLE `student_subject_detail`
  ADD PRIMARY KEY (`id`), ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `university`
--
ALTER TABLE `university`
  ADD PRIMARY KEY (`id`), ADD KEY `city_id` (`city_id`), ADD KEY `state_id` (`state_id`), ADD KEY `country_id` (`country_id`), ADD KEY `city_id_2` (`city_id`), ADD KEY `city_id_3` (`city_id`), ADD KEY `city_id_4` (`city_id`), ADD KEY `state_id_2` (`state_id`), ADD KEY `country_id_2` (`country_id`);

--
-- Indexes for table `university_admission`
--
ALTER TABLE `university_admission`
  ADD PRIMARY KEY (`id`), ADD KEY `university_index` (`university_id`), ADD KEY `degree_level_index` (`degree_level_id`);

--
-- Indexes for table `university_course_list`
--
ALTER TABLE `university_course_list`
  ADD PRIMARY KEY (`id`), ADD KEY `university_id_2` (`university_id`), ADD KEY `degree_id_2` (`degree_id`), ADD KEY `major_id_2` (`major_id`), ADD KEY `major_id_3` (`major_id`), ADD KEY `department_id_2` (`department_id`);

--
-- Indexes for table `university_departments`
--
ALTER TABLE `university_departments`
  ADD PRIMARY KEY (`id`), ADD KEY `university_id` (`university_id`), ADD KEY `university_id_2` (`university_id`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`), ADD UNIQUE KEY `email` (`email`), ADD UNIQUE KEY `password_reset_token` (`password_reset_token`), ADD KEY `user_id` (`user_id`), ADD KEY `user_id_2` (`user_id`), ADD KEY `user_id_3` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `degree`
--
ALTER TABLE `degree`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `degree_level`
--
ALTER TABLE `degree_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `employee_login`
--
ALTER TABLE `employee_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `majors`
--
ALTER TABLE `majors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `partner`
--
ALTER TABLE `partner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `partner_login`
--
ALTER TABLE `partner_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `student_college_detail`
--
ALTER TABLE `student_college_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `student_english_language_proficiencey_details`
--
ALTER TABLE `student_english_language_proficiencey_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `student_school_detail`
--
ALTER TABLE `student_school_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `student_standard_test_detail`
--
ALTER TABLE `student_standard_test_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `student_subject_detail`
--
ALTER TABLE `student_subject_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `university`
--
ALTER TABLE `university`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `university_admission`
--
ALTER TABLE `university_admission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `university_course_list`
--
ALTER TABLE `university_course_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=185;
--
-- AUTO_INCREMENT for table `university_departments`
--
ALTER TABLE `university_departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `city`
--
ALTER TABLE `city`
ADD CONSTRAINT `add country foreign key` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`),
ADD CONSTRAINT `add state foreign key` FOREIGN KEY (`state_id`) REFERENCES `state` (`id`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
ADD CONSTRAINT `country foreign key` FOREIGN KEY (`country`) REFERENCES `country` (`id`),
ADD CONSTRAINT `state foreign key` FOREIGN KEY (`state`) REFERENCES `state` (`id`);

--
-- Constraints for table `employee_login`
--
ALTER TABLE `employee_login`
ADD CONSTRAINT `foreign key` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`);

--
-- Constraints for table `state`
--
ALTER TABLE `state`
ADD CONSTRAINT `foreign key constraint` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`);

--
-- Constraints for table `student_college_detail`
--
ALTER TABLE `student_college_detail`
ADD CONSTRAINT `student` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`);

--
-- Constraints for table `student_english_language_proficiencey_details`
--
ALTER TABLE `student_english_language_proficiencey_details`
ADD CONSTRAINT `student_foreign_key` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`);

--
-- Constraints for table `student_school_detail`
--
ALTER TABLE `student_school_detail`
ADD CONSTRAINT `student_foreign_key_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`);

--
-- Constraints for table `student_standard_test_detail`
--
ALTER TABLE `student_standard_test_detail`
ADD CONSTRAINT `student_foreign_key_2` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`);

--
-- Constraints for table `student_subject_detail`
--
ALTER TABLE `student_subject_detail`
ADD CONSTRAINT `student_foreign_key_3` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`);

--
-- Constraints for table `university`
--
ALTER TABLE `university`
ADD CONSTRAINT `city fk` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`),
ADD CONSTRAINT `country fk` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`),
ADD CONSTRAINT `state fk` FOREIGN KEY (`state_id`) REFERENCES `state` (`id`);

--
-- Constraints for table `university_admission`
--
ALTER TABLE `university_admission`
ADD CONSTRAINT `degree` FOREIGN KEY (`degree_level_id`) REFERENCES `degree_level` (`id`),
ADD CONSTRAINT `university` FOREIGN KEY (`university_id`) REFERENCES `university` (`id`);

--
-- Constraints for table `university_course_list`
--
ALTER TABLE `university_course_list`
ADD CONSTRAINT `degree foreign key` FOREIGN KEY (`degree_id`) REFERENCES `degree` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `department_foreign_key` FOREIGN KEY (`department_id`) REFERENCES `university_departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `major foreign key` FOREIGN KEY (`major_id`) REFERENCES `majors` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `university foreign key` FOREIGN KEY (`university_id`) REFERENCES `university` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `university_departments`
--
ALTER TABLE `university_departments`
ADD CONSTRAINT `university_foreign_key` FOREIGN KEY (`university_id`) REFERENCES `university` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_login`
--
ALTER TABLE `user_login`
ADD CONSTRAINT `fk` FOREIGN KEY (`user_id`) REFERENCES `student` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
