-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3301
-- Generation Time: Oct 16, 2020 at 06:41 AM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lexlabs`
--

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

DROP TABLE IF EXISTS `devices`;
CREATE TABLE IF NOT EXISTS `devices` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `deviceName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deviceID` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `movementStatus` int(11) DEFAULT NULL,
  `connectionStatus` int(11) DEFAULT NULL,
  `connTimeUpdate` timestamp NULL DEFAULT NULL,
  `mobileNumber` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `initialized` int(11) DEFAULT NULL,
  `alarmRaisedNo` int(11) DEFAULT NULL,
  `alarmActiveNo` int(11) DEFAULT NULL,
  `connectionTime` timestamp NULL DEFAULT NULL,
  `alarmOneTime` timestamp NULL DEFAULT NULL,
  `alarmonetotTime` time DEFAULT '00:00:00',
  `alarmtwototTime` time DEFAULT '00:00:00',
  `alarmonetimeday` int(11) DEFAULT NULL,
  `alarmtwotimeday` int(11) DEFAULT NULL,
  `alarmTwoTime` timestamp NULL DEFAULT NULL,
  `alarmOneRunStatus` int(11) DEFAULT NULL,
  `alarmTwoRunStatus` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id`, `deviceName`, `deviceID`, `movementStatus`, `connectionStatus`, `connTimeUpdate`, `mobileNumber`, `initialized`, `alarmRaisedNo`, `alarmActiveNo`, `connectionTime`, `alarmOneTime`, `alarmonetotTime`, `alarmtwototTime`, `alarmonetimeday`, `alarmtwotimeday`, `alarmTwoTime`, `alarmOneRunStatus`, `alarmTwoRunStatus`, `created_at`, `updated_at`) VALUES
(1, 'one', '1', 2, 0, '2020-09-06 09:48:23', NULL, 1, 32, 0, '2020-09-06 09:48:23', '2020-09-06 09:48:23', '09:41:05', '03:20:47', 0, 0, '2020-09-01 08:21:13', 0, 0, '2020-09-01 08:09:45', '2020-09-06 10:19:00'),
(3, 'test', '2', 2, 0, NULL, NULL, 0, 0, 0, NULL, NULL, '00:00:00', '10:20:00', 0, 0, NULL, 0, 0, '2020-09-01 16:25:05', '2020-09-06 10:20:00'),
(4, 'three', '3', 2, 0, NULL, NULL, 0, 0, 0, NULL, NULL, '00:00:00', '10:20:00', 0, 0, NULL, 0, 0, '2020-09-01 16:26:15', '2020-09-06 10:20:00'),
(5, 'test', '4', 2, 0, NULL, NULL, 0, 0, 0, NULL, NULL, '00:00:00', '10:20:00', 0, 0, NULL, 0, 0, '2020-09-04 13:34:57', '2020-09-06 10:20:00');

-- --------------------------------------------------------

--
-- Table structure for table `devicesetting`
--

DROP TABLE IF EXISTS `devicesetting`;
CREATE TABLE IF NOT EXISTS `devicesetting` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `mobileNumber` bigint(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `devicesetting`
--

INSERT INTO `devicesetting` (`id`, `created_at`, `updated_at`, `mobileNumber`) VALUES
(1, NULL, '2020-09-01 08:08:21', 9786122340),
(2, '2020-09-01 07:48:48', '2020-09-01 08:08:29', 8667547179),
(3, '2020-09-01 13:09:03', '2020-09-04 13:36:07', 9585085879);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_07_31_112614_create_devices_table', 1),
(5, '2020_08_09_082823_create_websockets_statistics_entries_table', 1),
(6, '2020_08_27_144112_create_devicesetting_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `websockets_statistics_entries`
--

DROP TABLE IF EXISTS `websockets_statistics_entries`;
CREATE TABLE IF NOT EXISTS `websockets_statistics_entries` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `app_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peak_connection_count` int(11) NOT NULL,
  `websocket_message_count` int(11) NOT NULL,
  `api_message_count` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
