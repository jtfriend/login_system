-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 25, 2019 at 12:44 AM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

DROP TABLE IF EXISTS `data`;
CREATE TABLE IF NOT EXISTS `data` (
  `d_id` int(20) NOT NULL AUTO_INCREMENT,
  `d_field` varchar(50) NOT NULL,
  `d_value` varchar(50) NOT NULL,
  `d_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`d_id`)
) ENGINE=MyISAM AUTO_INCREMENT=115 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`d_id`, `d_field`, `d_value`, `d_timestamp`) VALUES
(66, 'field1', '41', '2019-01-25 00:21:52'),
(65, 'field1', '41', '2019-01-25 00:21:34'),
(64, 'field1', '41', '2019-01-25 00:21:17'),
(63, 'field1', '41', '2019-01-25 00:20:59'),
(62, 'field1', '41', '2019-01-25 00:20:59'),
(61, 'field1', '41', '2019-01-25 00:20:42'),
(60, 'field1', '41', '2019-01-25 00:20:26'),
(59, 'field1', '41', '2019-01-25 00:20:24'),
(58, 'field1', '41', '2019-01-25 00:20:06'),
(57, 'field1', '41', '2019-01-25 00:20:04'),
(56, 'field1', '41', '2019-01-25 00:19:46'),
(55, 'field1', '41', '2019-01-25 00:19:29'),
(54, 'field1', '41', '2019-01-25 00:19:12'),
(53, 'field1', '41', '2019-01-25 00:18:54'),
(52, 'field1', '41', '2019-01-25 00:18:53'),
(51, 'field1', '41', '2019-01-25 00:18:52'),
(50, 'field1', '41', '2019-01-24 23:10:22'),
(49, 'test', '56', '2019-01-24 22:55:42'),
(48, 'test', '56', '2019-01-24 22:55:23'),
(47, 'test', '56', '2019-01-24 22:55:16'),
(46, 'test', '56', '2019-01-24 22:54:41'),
(45, 'test', '56', '2019-01-24 22:54:40'),
(44, 'test', '56', '2019-01-24 22:54:40'),
(43, 'test', '56', '2019-01-24 22:54:31'),
(41, 'test', '56', '2019-01-24 22:52:44'),
(42, 'test', '56', '2019-01-24 22:53:37'),
(67, 'field1', '41', '2019-01-25 00:21:55'),
(68, 'field1', '41', '2019-01-25 00:21:55'),
(69, 'field1', '41', '2019-01-25 00:21:56'),
(70, 'field1', '41', '2019-01-25 00:22:14'),
(71, 'field1', '41', '2019-01-25 00:22:16'),
(72, 'field1', '41', '2019-01-25 00:22:33'),
(73, 'field1', '41', '2019-01-25 00:22:35'),
(74, 'field1', '41', '2019-01-25 00:22:52'),
(75, 'field1', '41', '2019-01-25 00:22:54'),
(76, 'field1', '41', '2019-01-25 00:23:12'),
(77, 'field1', '41', '2019-01-25 00:23:29'),
(78, 'field1', '41', '2019-01-25 00:23:47'),
(79, 'field1', '41', '2019-01-25 00:23:50'),
(80, 'field1', '41', '2019-01-25 00:24:07'),
(81, 'field1', '41', '2019-01-25 00:24:25'),
(82, 'field1', '41', '2019-01-25 00:24:43'),
(83, 'test', '56', '2019-01-25 00:25:08'),
(84, 'test', '56', '2019-01-25 00:28:04'),
(85, 'test', '56', '2019-01-25 00:28:24'),
(86, 'test', '56', '2019-01-25 00:28:27'),
(87, 'field1', '41', '2019-01-25 00:28:30'),
(88, 'test', '56', '2019-01-25 00:28:31'),
(89, 'field1', '41', '2019-01-25 00:28:47'),
(90, 'field1', '41', '2019-01-25 00:29:04'),
(91, 'field1', '41', '2019-01-25 00:29:06'),
(92, 'field1', '41', '2019-01-25 00:29:23'),
(93, 'field1', '41', '2019-01-25 00:29:41'),
(94, 'field1', '41', '2019-01-25 00:29:59'),
(95, 'field1', '41', '2019-01-25 00:30:02'),
(96, 'field1', '41', '2019-01-25 00:30:04'),
(97, 'field1', '41', '2019-01-25 00:30:06'),
(98, 'field1', '41', '2019-01-25 00:30:09'),
(99, 'field1', '41', '2019-01-25 00:30:26'),
(100, 'field1', '41', '2019-01-25 00:30:44'),
(101, 'field1', '41', '2019-01-25 00:30:47'),
(102, 'field1', '41', '2019-01-25 00:31:05'),
(103, 'field1', '41', '2019-01-25 00:31:23'),
(104, 'field1', '41', '2019-01-25 00:31:25'),
(105, 'field1', '41', '2019-01-25 00:31:28'),
(106, 'field1', '41', '2019-01-25 00:31:45'),
(107, 'field1', '41', '2019-01-25 00:32:04'),
(108, 'field1', '41', '2019-01-25 00:32:22'),
(109, 'field1', '41', '2019-01-25 00:32:40'),
(110, 'field1', '41', '2019-01-25 00:32:57'),
(111, 'field1', '41', '2019-01-25 00:32:59'),
(112, 'field1', '41', '2019-01-25 00:33:01'),
(113, 'field1', '41', '2019-01-25 00:33:19'),
(114, 'field1', '41', '2019-01-25 00:33:21');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `g_id` int(11) NOT NULL AUTO_INCREMENT,
  `g_name` varchar(20) NOT NULL,
  `g_permissions` text NOT NULL,
  PRIMARY KEY (`g_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`g_id`, `g_name`, `g_permissions`) VALUES
(1, 'standard', ''),
(2, 'administrator', '{\"admin\":1}');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_username` varchar(20) DEFAULT '',
  `u_password` varchar(64) NOT NULL DEFAULT '',
  `u_salt` varchar(32) NOT NULL DEFAULT '',
  `u_name` varchar(50) NOT NULL DEFAULT '',
  `u_joined` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `u_group` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`u_id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `u_username`, `u_password`, `u_salt`, `u_name`, `u_joined`, `u_group`) VALUES
(2, 'jp1bloggs', 'password', 'salt', 'Joe Bloggs', '2018-05-15 00:00:00', 1),
(25, 'jtf3', '06056790e0cc1e61ac9ea2f922a2f212583169c511f729abd00dcdb32a8b2668', '“×/Ï»töœI×s-šçòbÝï×ríËª8™Ä‹nO', 'JTF3', '2019-01-24 14:19:57', 1),
(24, 'jtf2', 'fca6e5b0f83c82d08fff401640bd808a0aa3a2457dd020a182294f04cba55cd9', 'ØüÄÂ\'ÞÙ1\"CÅêò¾éVÃ–¦ô«©á±ÍS', 'JTF2', '2019-01-24 13:22:47', 1),
(23, 'jumper', 'ff3595f00e8744f9e08d6d5a4dcc5fedb8603a7272c8d834d06c3b29613c726e', '”åd6YxÚ!’×£„ùŠÁ¢ÌGÕW®+å¡ƒ\'Mä£9ö', 'Jump', '2019-01-09 23:05:24', 1),
(22, 'jtf', '87b5f633ce46d360a2b15f61fdbd63e9424e66275ff4b3200591b40472b3008a', 'Çö€\rÿf‚ÏW±ùWÖºHób:r5ù$ÒâO@q(—d', 'JTF', '2018-09-16 10:29:58', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_session`
--

DROP TABLE IF EXISTS `users_session`;
CREATE TABLE IF NOT EXISTS `users_session` (
  `us_id` int(11) NOT NULL,
  `us_uid` int(11) NOT NULL,
  `us_hash` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
