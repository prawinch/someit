-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Host: reitsolution.se.mysql:3306
-- Generation Time: Jul 04, 2017 at 03:05 PM
-- Server version: 10.1.21-MariaDB-1~xenial
-- PHP Version: 5.4.45-0+deb7u8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `reitsolution_se_fixit`
--
CREATE DATABASE `reitsolution_se_fixit` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `reitsolution_se_fixit`;

-- --------------------------------------------------------

--
-- Table structure for table `admin-user`
--

CREATE TABLE IF NOT EXISTS `admin-user` (
  `userid` varchar(10) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `profilepic` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin-user`
--

INSERT INTO `admin-user` (`userid`, `firstname`, `lastname`, `email`, `password`, `profilepic`) VALUES
('admin1024', 'Rockfeller', 'Edward', 'admin@fixit.com', 'admin', 'admin1024.png'),
('MHdrift', 'MH', 'Drift', 'mhdrift@fixit.com', 'mhdrift', '64e1b8d34f425d19e1ee2ea7236d3028.png'),
('admin1025', 'test', 'test', 'pradeep@qa-masters.com', 'pradeep', 'default.png');

-- --------------------------------------------------------

--
-- Table structure for table `bank_details`
--

CREATE TABLE IF NOT EXISTS `bank_details` (
  `c_name` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `ac_num` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `website` varchar(50) NOT NULL,
  `d1` varchar(50) NOT NULL,
  `d2` varchar(50) NOT NULL,
  `d3` varchar(50) NOT NULL,
  `d4` varchar(50) NOT NULL,
  `d5` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank_details`
--

INSERT INTO `bank_details` (`c_name`, `phone`, `ac_num`, `email`, `website`, `d1`, `d2`, `d3`, `d4`, `d5`) VALUES
('MH Drift & Fastighetsservice AB', '08-409 38000', '307-2659', 'info@mhdrift.se', 'mhdrift.se', 'Gustafsvagen 12', 'Godkand for F-skatt', '169 58 SOLNA', 'Upplands Vasby', 'Momsreg/VAT-nr SE556941500201');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `ticket_id` varchar(30) NOT NULL,
  `commented_by` varchar(30) NOT NULL,
  `comments` varchar(300) NOT NULL,
  `commented_on` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`ticket_id`, `commented_by`, `comments`, `commented_on`) VALUES
('TKT59477B6F4A4A9', 'admin2', 'Ticket Updated', '19-06-2017 07:22:27'),
('TKT59477B9705FAE', 'admin2', 'Ticket Updated', '19-06-2017 07:22:37'),
('TKT59467FE4D5566', 'admin2', 'Denna ska tas bort', '19-06-2017 08:23:49'),
('', 'admin2', 'When will do this.???? ', '19-06-2017 10:07:11'),
('TKT59477B6F4A4A9', 'vendor1', 'Ticket Updated', '19-06-2017 10:08:19'),
('TKT59477B6F4A4A9', 'vendor1', 'Ticket Updated', '19-06-2017 10:08:31'),
('TKT59477B6F4A4A9', 'vendor1', 'taken', '19-06-2017 06:58:28'),
('TKT59477B6F4A4A9', 'vendor1', 'Ticket Updated', '19-06-2017 06:59:41'),
('TKT59477B6F4A4A9', 'vendor1', 'rejeskfsfs\r\n', '21-06-2017 02:31:37'),
('', 'admin2', 'Detta är test email.', '21-06-2017 06:46:43'),
('TKT594ABE9992605', 'admin2', 'Stäng caset', '21-06-2017 06:47:13'),
('', 'admin2', 'Detta är test email.', '21-06-2017 06:47:13'),
('TKT594ABE9992605', 'admin2', 'måste öppnas igen', '21-06-2017 06:56:16'),
('TKT594ABE9992605', 'admin2', 'måste öppnas igen', '21-06-2017 06:56:26'),
('TKT594ABE9992605', 'admin2', 'måste öppnas igen', '21-06-2017 06:56:36'),
('TKT594ABE9992605', 'vendor1', 'Jag tar den.', '21-06-2017 07:00:39'),
('', 'admin2', 'vi saknar information', '21-06-2017 07:02:08'),
('TKT594ABE9992605', 'vendor1', 'Ticket Updated', '21-06-2017 07:51:17'),
('TKT594ABE9992605', 'vendor1', 'Ticket Updated', '21-06-2017 07:51:31'),
('', 'admin2', 'Behöver mer info', '24-06-2017 08:04:05'),
('TKT594C14135BC4C', 'admin2', 'Ticket Updated', '24-06-2017 08:10:00'),
('TKT59477B9705FAE', 'vendor1', 'Ticket Updated', '24-06-2017 08:18:32'),
('TKT59477B9705FAE', 'vendor1', 'Ticket Updated', '25-06-2017 07:41:48'),
('TKT59477B9705FAE', 'vendor1', 'Some items are purchased. Work will be done in nex few hours', '25-06-2017 07:42:30'),
('TKT594C14135BC4C', 'vendor1', 'Now updated by Vendor 1', '25-06-2017 07:43:35'),
('TKT594C14135BC4C', 'admin2', 'Ticket Updated', '25-06-2017 07:43:54'),
('TKT594C14135BC4C', 'admin2', 'Ticket Updated', '25-06-2017 07:44:27'),
('TKT59477B9705FAE', 'vendor1', 'This can be done', '25-06-2017 09:01:45'),
('TKT594C14135BC4C', 'admin2', 'Ticket Updated', '26-06-2017 05:26:44'),
('TKT59467FE4D5566', 'admin2', 'Ticket Updated', '26-06-2017 12:55:20'),
('TKT594C14135BC4C', 'admin2', 'Ticket Updated', '26-06-2017 01:01:18'),
('TKT59467FE4D5566', 'admin2', 'Dummy ticket', '26-06-2017 10:15:59'),
('TKT594C14135BC4C', 'admin2', 'Ticket Updated', '28-06-2017 06:36:01'),
('TKT59477B9705FAE', 'admin2', 'Ticket Updated', '28-06-2017 10:04:28'),
('TKT59477B9705FAE', 'admin2', 'We ned to find some ppl ', '28-06-2017 10:05:23'),
('TKT59467FE4D5566', 'test', 'Ticket Updated', '29-06-2017 05:10:10'),
('TKT59467FE4D5566', 'test', 'Ticket Updated', '29-06-2017 05:10:39'),
('TKT59467FE4D5566', 'test', 'testing', '29-06-2017 05:15:43'),
('TKT59551A093D822', 'Rockfeller', 'Ticket Updated', '29-06-2017 07:27:45'),
('TKT59551A093D822', 'Rockfeller', 'Hittar inte kundens information', '29-06-2017 07:30:50'),
('TKT59551A093D822', 'Rockfeller', 'Hittar inte kundens information', '29-06-2017 07:31:07'),
('TKT59551A093D822', 'Rockfeller', 'Ticket Updated', '29-06-2017 07:34:53'),
('TKT59551A093D822', 'Rockfeller', 'Ticket Updated', '29-06-2017 07:35:09'),
('TKT594C14135BC4C', 'Rockfeller', 'Ticket Updated', '29-06-2017 08:35:24'),
('TKT59467FE4D5566', 'test', 'one', '30-06-2017 03:22:52'),
('TKT59467FE4D5566', 'test', 'one', '30-06-2017 03:39:30'),
('TKT59467FE4D5566', 'test', 'one', '30-06-2017 03:41:27'),
('TKT59477B9705FAE', 'vendor1', 'Ticket Updated', '30-06-2017 06:09:03'),
('TKT59477B9705FAE', 'vendor1', 'Ticket Updated', '30-06-2017 06:09:13'),
('TKT5955EC3221FC3', 'Rockfeller', 'Dubletter', '30-06-2017 06:16:30'),
('TKT5955EC3221FC3', 'Rockfeller', 'Dubbletter', '30-06-2017 06:16:55'),
('TKT59577A12304E0', 'Rockfeller', 'Ticket Updated', '01-07-2017 02:28:15'),
('TKT594C14135BC4C', 'Rockfeller', 'Ticket Updated', '01-07-2017 11:03:20'),
('TKT5955EC467BB57', 'Rockfeller', 'Innehåller ingen info', '03-07-2017 09:13:02'),
('TKT59467FE4D5566', 'test', 'Ticket Updated', '04-07-2017 03:35:35'),
('TKT595A2527EF0A4', 'Rockfeller Edward', 'kninijniojnijjnjln', '04-07-2017 06:26:44'),
('TKT595A2527EF0A4', 'Rockfeller Edward', 'uiyhuyhm 277', '04-07-2017 06:26:52');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE IF NOT EXISTS `history` (
  `ticket_id` varchar(30) NOT NULL,
  `time` varchar(20) NOT NULL,
  `comments` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`ticket_id`, `time`, `comments`) VALUES
('TKT59467FE4D5566', '18-06-2017 01:28:04', 'Ticket Created'),
('TKT59467FE4D5566', '18-06-2017 04:50:19', 'Vendor Changed by - admin@fixit.com'),
('TKT59467FE4D5566', '18-06-2017 04:50:36', 'Ticket Closed by Admin - '),
('TKT59467FE4D5566', '18-06-2017 04:50:57', 'Vendor Changed by - admin@fixit.com'),
('TKT59467FE4D5566', '18-06-2017 04:51:10', 'Ticket Closed by Vendor - '),
('TKT59477B6F4A4A9', '19-06-2017 07:21:19', 'Ticket Created'),
('TKT59477B9705FAE', '19-06-2017 07:21:59', 'Ticket Created'),
('TKT59477B6F4A4A9', '19-06-2017 07:22:23', 'Vendor Changed by - admin@fixit.com'),
('TKT59477B6F4A4A9', '19-06-2017 07:22:27', 'Ticket details updated by Admin - admin@fixit.com'),
('TKT59477B9705FAE', '19-06-2017 07:22:33', 'Vendor Changed by - admin@fixit.com'),
('TKT59477B9705FAE', '19-06-2017 07:22:37', 'Ticket details updated by Admin - admin@fixit.com'),
('', '19-06-2017 08:09:25', 'Ticket Closed by Admin - admin@fixit.com'),
('TKT59467FE4D5566', '19-06-2017 08:23:49', 'Ticket Closed by Admin - admin@fixit.com'),
('', '19-06-2017 10:07:11', 'Ticket Closed by Admin - admin@fixit.com'),
('TKT59477B6F4A4A9', '19-06-2017 10:08:16', 'Work Done by Vendor - vendor1'),
('TKT59477B6F4A4A9', '19-06-2017 10:08:19', 'Ticket details updated by Vendor - vendor1@fixit.c'),
('TKT59477B6F4A4A9', '19-06-2017 10:08:28', 'Invoice Requested by - vendor1@fixit.com'),
('TKT59477B6F4A4A9', '19-06-2017 10:08:31', 'Ticket details updated by Vendor - vendor1@fixit.c'),
('TKT59477B6F4A4A9', '19-06-2017 03:28:44', 'Vendor Changed by - admin@fixit.com'),
('TKT59477B6F4A4A9', '19-06-2017 06:58:28', 'Ticket Closed by Vendor - '),
('TKT59477B9705FAE', '19-06-2017 06:58:39', 'Ticket Closed by Vendor - '),
('TKT59477B6F4A4A9', '19-06-2017 06:59:33', 'Invoice Requested by - vendor1@fixit.com'),
('TKT59477B6F4A4A9', '19-06-2017 06:59:41', 'Ticket details updated by Vendor - vendor1@fixit.c'),
('TKT59477B6F4A4A9', '21-06-2017 02:31:37', 'Ticket Closed by Admin - '),
('TKT594ABE9992605', '21-06-2017 06:44:41', 'Ticket Created'),
('', '21-06-2017 06:46:43', 'Ticket Closed by Admin - admin@fixit.com'),
('TKT594ABE9992605', '21-06-2017 06:47:13', 'Ticket Closed by Admin - admin@fixit.com'),
('', '21-06-2017 06:47:13', 'Ticket Closed by Admin - admin@fixit.com'),
('TKT594ABE9992605', '21-06-2017 06:55:34', 'Ticket details Updated'),
('TKT594ABE9992605', '21-06-2017 06:56:16', 'Ticket Closed by Admin - admin@fixit.com'),
('TKT594ABE9992605', '21-06-2017 06:56:26', 'Ticket Closed by Admin - admin@fixit.com'),
('TKT594ABE9992605', '21-06-2017 06:56:36', 'Ticket Closed by Admin - admin@fixit.com'),
('TKT594ABE9992605', '21-06-2017 06:57:55', 'Vendor Changed by - admin@fixit.com'),
('TKT594ABE9992605', '21-06-2017 07:00:39', 'Ticket Closed by Vendor - '),
('', '21-06-2017 07:02:08', 'Ticket Closed by Admin - admin@fixit.com'),
('TKT594ABE9992605', '21-06-2017 07:51:08', 'Work Done by Vendor - vendor1'),
('TKT594ABE9992605', '21-06-2017 07:51:17', 'Ticket details updated by Vendor - vendor1@fixit.c'),
('TKT594ABE9992605', '21-06-2017 07:51:26', 'Invoice Requested by - vendor1@fixit.com'),
('TKT594ABE9992605', '21-06-2017 07:51:31', 'Ticket details updated by Vendor - vendor1@fixit.c'),
('TKT594C14135BC4C', '22-06-2017 07:01:39', 'Ticket Created'),
('TKT59477B6F4A4A9', '23-06-2017 08:21:20', 'Ticket details Updated'),
('TKT594DC6FE7D772', '24-06-2017 01:57:18', 'Ticket Created'),
('TKT594DC7652D980', '24-06-2017 01:59:01', 'Ticket Created'),
('TKT594DC7A968C0B', '24-06-2017 02:00:09', 'Ticket Created'),
('TKT594DC7E254AE6', '24-06-2017 02:01:06', 'Ticket Created'),
('TKT594DC88FC7CCD', '24-06-2017 02:03:59', 'Ticket Created'),
('TKT594DC8FFA470A', '24-06-2017 02:05:51', 'Ticket Created'),
('', '24-06-2017 08:04:05', 'Ticket Closed by Admin - admin@fixit.com'),
('TKT594C14135BC4C', '24-06-2017 08:09:57', 'Vendor Changed by - admin@fixit.com'),
('TKT594C14135BC4C', '24-06-2017 08:10:00', 'Ticket details updated by Admin - admin@fixit.com'),
('TKT59477B9705FAE', '24-06-2017 08:18:27', 'Work Done by Vendor - vendor1'),
('TKT59477B9705FAE', '24-06-2017 08:18:32', 'Ticket details updated by Vendor - vendor1@fixit.c'),
('TKT59477B9705FAE', '25-06-2017 07:41:48', 'Ticket details updated by Vendor - vendor1@fixit.c'),
('TKT59477B9705FAE', '25-06-2017 07:42:30', 'Comment added by Vendor - vendor1@fixit.com'),
('TKT594C14135BC4C', '25-06-2017 07:43:35', 'Comment added by Vendor - vendor1@fixit.com'),
('TKT594C14135BC4C', '25-06-2017 07:43:54', 'Ticket details updated by Admin - admin@fixit.com'),
('TKT594C14135BC4C', '25-06-2017 07:44:27', 'Ticket details updated by Admin - admin@fixit.com'),
('TKT59477B9705FAE', '25-06-2017 09:01:45', 'Ticket Closed by Vendor - '),
('TKT594C14135BC4C', '26-06-2017 05:26:44', 'Ticket details updated by Admin - admin@fixit.com'),
('TKT59467FE4D5566', '26-06-2017 12:55:17', 'Vendor Changed by - admin@fixit.com'),
('TKT59467FE4D5566', '26-06-2017 12:55:20', 'Ticket details updated by Admin - admin@fixit.com'),
('TKT594C14135BC4C', '26-06-2017 01:01:18', 'Ticket details updated by Admin - admin@fixit.com'),
('TKT59467FE4D5566', '26-06-2017 10:15:59', 'Ticket Closed by Admin - admin@fixit.com'),
('TKT594C14135BC4C', '27-06-2017 12:28:14', 'Vendor Changed by - admin@fixit.com'),
('TKT594C14135BC4C', '28-06-2017 06:36:01', 'Ticket details updated by Admin - admin@fixit.com'),
('TKT594C14135BC4C', '28-06-2017 02:21:24', 'Vendor Changed by - admin@fixit.com'),
('TKT59467FE4D5566', '28-06-2017 03:58:52', 'Ticket Closed by Admin - admin@fixit.com'),
('TKT59477B9705FAE', '28-06-2017 10:04:28', 'Ticket details updated by Admin - admin@fixit.com'),
('TKT59477B9705FAE', '28-06-2017 10:05:23', 'Comment added by - admin@fixit.com'),
('TKT595460F533EDF', '29-06-2017 02:07:49', 'Ticket Created'),
('TKT595462E6417E7', '29-06-2017 02:16:06', 'Ticket Created'),
('TKT5954647EC9803', '29-06-2017 02:22:54', 'Ticket Created'),
('TKT5954650470866', '29-06-2017 02:25:08', 'Ticket Created'),
('TKT5954655334239', '29-06-2017 02:26:27', 'Ticket Created'),
('TKT595468D3BBABF', '29-06-2017 02:41:23', 'Ticket Created'),
('TKT595469031CF88', '29-06-2017 02:42:11', 'Ticket Created'),
('TKT59546F8CB58F1', '29-06-2017 03:10:04', 'Ticket Created'),
('TKT59551A093D822', '29-06-2017 03:17:29', 'Ticket Created'),
('TKT59467FE4D5566', '29-06-2017 05:10:10', 'Ticket details updated by Admin - pradeep@qa-maste'),
('TKT59467FE4D5566', '29-06-2017 05:10:39', 'Ticket details updated by Admin - pradeep@qa-maste'),
('', '29-06-2017 05:11:19', 'Ticket Closed by Admin - pradeep@qa-masters.com'),
('', '29-06-2017 05:12:11', 'Ticket Closed by Admin - pradeep@qa-masters.com'),
('TKT59467FE4D5566', '29-06-2017 05:15:43', 'Ticket Closed by Admin - pradeep@qa-masters.com'),
('', '29-06-2017 05:15:44', 'Ticket Closed by Admin - pradeep@qa-masters.com'),
('TKT59467FE4D5566', '29-06-2017 05:16:55', 'Ticket Closed by Admin - pradeep@qa-masters.com'),
('TKT59551A093D822', '29-06-2017 07:27:45', 'Ticket details updated by Admin - admin@fixit.com'),
('TKT59551A093D822', '29-06-2017 07:29:52', 'Vendor Changed by - admin@fixit.com'),
('TKT59551A093D822', '29-06-2017 07:30:50', 'Comment added by - admin@fixit.com'),
('TKT59551A093D822', '29-06-2017 07:31:07', 'Comment added by - admin@fixit.com'),
('TKT59551A093D822', '29-06-2017 07:34:53', 'Ticket details updated by Admin - admin@fixit.com'),
('TKT59551A093D822', '29-06-2017 07:35:09', 'Ticket details updated by Admin - admin@fixit.com'),
('TKT59551A093D822', '29-06-2017 07:36:10', 'Ticket details Updated'),
('TKT594C14135BC4C', '29-06-2017 08:35:24', 'Ticket details updated by Admin - admin@fixit.com'),
('TKT59467FE4D5566', '30-06-2017 03:22:52', 'Comment added by - pradeep@qa-masters.com'),
('TKT59467FE4D5566', '30-06-2017 03:39:30', 'Comment added by - pradeep@qa-masters.com'),
('TKT59467FE4D5566', '30-06-2017 03:41:27', 'Comment added by - pradeep@qa-masters.com'),
('TKT59477B9705FAE', '30-06-2017 06:08:57', 'Work Done by - vendor1'),
('TKT59477B9705FAE', '30-06-2017 06:09:03', 'Ticket details updated by Vendor - vendor1@fixit.c'),
('TKT59477B9705FAE', '30-06-2017 06:09:11', 'Invoice Requested by - vendor1@fixit.com'),
('TKT59477B9705FAE', '30-06-2017 06:09:13', 'Ticket details updated by Vendor - vendor1@fixit.c'),
('TKT5955EC3221FC3', '30-06-2017 06:14:10', 'Ticket Created'),
('TKT5955EC467BB57', '30-06-2017 06:14:30', 'Ticket Created'),
('TKT5955EC3221FC3', '30-06-2017 06:16:30', 'Ticket Closed by Admin - admin@fixit.com'),
('TKT5955EC3221FC3', '30-06-2017 06:16:55', 'Ticket Closed by Admin - admin@fixit.com'),
('TKT59577A12304E0', '01-07-2017 10:31:46', 'Ticket Created'),
('TKT59577A12304E0', '01-07-2017 02:28:13', 'Vendor Changed by - admin@fixit.com'),
('TKT59577A12304E0', '01-07-2017 02:28:15', 'Ticket details updated by Admin - admin@fixit.com'),
('TKT594C14135BC4C', '01-07-2017 05:51:17', 'Work Done by - vendor1'),
('TKT594C14135BC4C', '01-07-2017 05:51:38', 'Invoice Requested by - vendor1@fixit.com'),
('TKT594C14135BC4C', '01-07-2017 11:03:20', 'Ticket details updated by Admin - admin@fixit.com'),
('TKT5955EC467BB57', '03-07-2017 09:13:02', 'Ticket Closed by Admin - admin@fixit.com'),
('TKT595A1EAE59EBC', '03-07-2017 10:38:38', 'Ticket Created'),
('TKT595A2527EF0A4', '03-07-2017 11:06:16', 'Ticket Created'),
('TKT59467FE4D5566', '04-07-2017 03:35:35', 'Ticket details updated by Admin - pradeep@qa-maste'),
('TKT59467FE4D5566', '04-07-2017 03:41:36', 'Vendor Changed by - pradeep@qa-masters.com'),
('TKT59467FE4D5566', '04-07-2017 03:41:44', 'Invoice Requested by - vendor1@fixit.com'),
('TKT595A2527EF0A4', '04-07-2017 05:53:24', 'Vendor Changed by - admin@fixit.com'),
('TKT595A2527EF0A4', '04-07-2017 06:26:44', 'Comment added by - vendor1@fixit.com'),
('TKT595A2527EF0A4', '04-07-2017 06:26:52', 'Comment added by - vendor1@fixit.com');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_audit`
--

CREATE TABLE IF NOT EXISTS `invoice_audit` (
  `version` varchar(10) NOT NULL,
  `ticket_id` varchar(50) NOT NULL,
  `invoice_id` varchar(50) NOT NULL,
  `invoice_date` varchar(20) NOT NULL,
  `bill_due_date` varchar(20) NOT NULL,
  `bill_due` varchar(11) NOT NULL,
  `description` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_audit`
--

INSERT INTO `invoice_audit` (`version`, `ticket_id`, `invoice_id`, `invoice_date`, `bill_due_date`, `bill_due`, `description`) VALUES
('1', '', '', '24-06-2017', '04-07-2017', '10', ''),
('2', 'TKT594ABE9992605', '1025', '24-06-2017', '04-07-2017', '10', ''),
('3', 'TKT594ABE9992605', '1025', '24-06-2017', '04-07-2017', '10', ''),
('4', 'TKT594ABE9992605', '1025', '24-06-2017', '04-07-2017', '10', ''),
('5', 'TKT594ABE9992605', '1025', '24-06-2017', '04-07-2017', '10', ''),
('6', 'TKT594ABE9992605', '1025', '24-06-2017', '04-07-2017', '10', ''),
('7', 'TKT594ABE9992605', '1025', '24-06-2017', '04-07-2017', '10', ''),
('8', 'TKT594ABE9992605', '1025', '24-06-2017', '04-07-2017', '10', ''),
('9', 'TKT594ABE9992605', '1025', '24-06-2017', '04-07-2017', '10', ''),
('10', 'TKT594ABE9992605', '1025', '24-06-2017', '04-07-2017', '10', ''),
('11', 'TKT594ABE9992605', '1025', '24-06-2017', '04-07-2017', '10', 'This is for the description. and only this information should be visible on the faktura. \r\n'),
('12', 'TKT594ABE9992605', '1025', '24-06-2017', '04-07-2017', '10', 'This is for the description. and only this information should be visible on the faktura. \r\n'),
('13', 'TKT594ABE9992605', '1025', '24-06-2017', '04-07-2017', '10', 'This is for the description. and only this information should be visible on the faktura. \r\n'),
('14', 'TKT594ABE9992605', '1025', '24-06-2017', '04-07-2017', '10', 'This is for the description. and only this information should be visible on the faktura. \r\n'),
('15', 'TKT594ABE9992605', '1025', '24-06-2017', '04-07-2017', '10', 'This is for the description. and only this information should be visible on the faktura. \r\n'),
('16', 'TKT594ABE9992605', '1025', '24-06-2017', '04-07-2017', '10', 'This is for the description. and only this information should be visible on the faktura. \r\n'),
('17', 'TKT594ABE9992605', '1025', '24-06-2017', '04-07-2017', '10', 'This is for the description. and only this information should be visible on the faktura. \r\n'),
('18', 'TKT594ABE9992605', '1025', '24-06-2017', '04-07-2017', '10', 'This is for the description. and only this information should be visible on the faktura. \r\n'),
('19', 'TKT594ABE9992605', '1025', '24-06-2017', '04-07-2017', '10', 'This is for the description. and only this information should be visible on the faktura. \r\n'),
('20', 'TKT594ABE9992605', '1025', '24-06-2017', '04-07-2017', '10', 'This is for the description. and only this information should be visible on the faktura. \r\n'),
('21', 'TKT594ABE9992605', '1025', '24-06-2017', '04-07-2017', '10', 'This is for the description. and only this information should be visible on the faktura. \r\n'),
('22', 'TKT594ABE9992605', '1025', '24-06-2017', '04-07-2017', '10', 'This is for the description. and only this information should be visible on the faktura. \r\n'),
('23', 'TKT59477B9705FAE', '1026', '30-06-2017', '10-07-2017', '10', ''),
('24', 'TKT59477B9705FAE', '1026', '30-06-2017', '10-07-2017', '10', ''),
('25', 'TKT59477B9705FAE', '1026', '30-06-2017', '10-07-2017', '10', ''),
('26', 'TKT59477B9705FAE', '1026', '30-06-2017', '10-07-2017', '10', ''),
('27', 'TKT59477B9705FAE', '1026', '30-06-2017', '20-07-2017', '20', ''),
('28', 'TKT59477B9705FAE', '1026', '30-06-2017', '20-07-2017', '20', ''),
('29', 'TKT59477B9705FAE', '1026', '30-06-2017', '20-07-2017', '20', ''),
('30', 'TKT59477B9705FAE', '1026', '30-06-2017', '20-07-2017', '20', ''),
('31', 'TKT59477B9705FAE', '1026', '30-06-2017', '20-07-2017', '20', ''),
('32', 'TKT59477B9705FAE', '1026', '30-06-2017', '20-07-2017', '20', ''),
('33', 'TKT59477B9705FAE', '1026', '30-06-2017', '20-07-2017', '20', ''),
('34', 'TKT59477B9705FAE', '1026', '30-06-2017', '20-07-2017', '20', ''),
('35', 'TKT59477B9705FAE', '1026', '30-06-2017', '20-07-2017', '20', ''),
('36', 'TKT59477B9705FAE', '1026', '30-06-2017', '20-07-2017', '20', ''),
('37', 'TKT59477B9705FAE', '1026', '30-06-2017', '20-07-2017', '20', ''),
('38', 'TKT594ABE9992605', '1025', '24-06-2017', '04-07-2017', '10', 'This is for the description. and only this information should be visible on the faktura. \r\n'),
('39', 'TKT59477B9705FAE', '1026', '30-06-2017', '20-07-2017', '20', ''),
('40', 'TKT594C14135BC4C', '1027', '01-07-2017', '11-07-2017', '10', ''),
('41', 'TKT594C14135BC4C', '1027', '01-07-2017', '11-07-2017', '10', ''),
('42', 'TKT594C14135BC4C', '1027', '01-07-2017', '11-07-2017', '10', ''),
('43', 'TKT594C14135BC4C', '1027', '01-07-2017', '11-07-2017', '10', ''),
('44', 'TKT594C14135BC4C', '1027', '01-07-2017', '11-07-2017', '10', ''),
('45', 'TKT594C14135BC4C', '1027', '01-07-2017', '11-07-2017', '10', ''),
('46', 'TKT594C14135BC4C', '1027', '01-07-2017', '11-07-2017', '10', ''),
('47', 'TKT594C14135BC4C', '1027', '01-07-2017', '11-07-2017', '10', ''),
('48', 'TKT594C14135BC4C', '1027', '01-07-2017', '11-07-2017', '10', ''),
('49', 'TKT594C14135BC4C', '1027', '01-07-2017', '11-07-2017', '10', ''),
('50', 'TKT594ABE9992605', '1025', '24-06-2017', '04-07-2017', '10', 'This is for the description. and only this information should be visible on the faktura. \r\n'),
('51', 'TKT594ABE9992605', '1025', '24-06-2017', '04-07-2017', '10', 'This is for the description. and only this information should be visible on the faktura. \r\n'),
('52', 'TKT594ABE9992605', '1025', '24-06-2017', '04-07-2017', '10', 'This is for the description. and only this information should be visible on the faktura. \r\n'),
('53', 'TKT594ABE9992605', '1025', '24-06-2017', '04-07-2017', '10', 'This is for the description. and only this information should be visible on the faktura. \r\n'),
('54', 'TKT594ABE9992605', '1025', '24-06-2017', '04-07-2017', '10', 'This is for the description. and only this information should be visible on the faktura. \r\n'),
('55', 'TKT594ABE9992605', '1025', '24-06-2017', '04-07-2017', '10', 'This is for the description. and only this information should be visible on the faktura. \r\n'),
('56', 'TKT594ABE9992605', '1025', '24-06-2017', '04-07-2017', '10', 'This is for the description. and only this information should be visible on the faktura. \r\n'),
('57', 'TKT594ABE9992605', '1025', '24-06-2017', '04-07-2017', '10', 'Texten har vi valt. \r\n'),
('58', 'TKT594ABE9992605', '1025', '24-06-2017', '04-07-2017', '10', 'Texten har vi valt. \r\n'),
('59', 'TKT594ABE9992605', '1025', '24-06-2017', '04-07-2017', '10', 'Texten har vi valt. \r\n'),
('60', 'TKT594ABE9992605', '1025', '24-06-2017', '04-07-2017', '10', 'Texten har vi valt. \r\n');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE IF NOT EXISTS `invoice_items` (
  `invoice_id` varchar(20) NOT NULL,
  `ticket_id` varchar(20) NOT NULL,
  `item_name` varchar(20) NOT NULL,
  `quantity` varchar(10) NOT NULL,
  `quantity_type` varchar(10) NOT NULL,
  `price` varchar(10) NOT NULL,
  `discount` varchar(10) NOT NULL,
  `total` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_items`
--

INSERT INTO `invoice_items` (`invoice_id`, `ticket_id`, `item_name`, `quantity`, `quantity_type`, `price`, `discount`, `total`) VALUES
('1024', 'TKT59477B6F4A4A9', 'Spare Part', '1', 'pieces', '100', '0', '100'),
('1024', 'TKT59477B6F4A4A9', '2', '1', 'pieces', '1023', '0', '1023'),
('', '', 'Avlopp fix', '1', 'hours', '450', '0', '450'),
('1026', 'TKT59477B9705FAE', 'bilkostnad', '20', 'pieces', '400', '0', '8000'),
('1026', 'TKT59477B9705FAE', 'frakt', '10', 'pieces', '450', '0', '4500'),
('1027', 'TKT594C14135BC4C', 'frakt', '1', 'pieces', '450', '0', '450'),
('1027', 'TKT594C14135BC4C', 'rot arbete', '10', 'hours', '450', '0', '4500'),
('1025', 'TKT594ABE9992605', 'Rot arbete byte av t', '2', 'hours', '1000', '0', '2000'),
('1025', 'TKT594ABE9992605', 'Frakt', '0', 'pieces', '0', '0', '0'),
('1025', 'TKT594ABE9992605', 'Rot arbete vägg måln', '10', 'hours', '500', '0', '5000'),
('1025', 'TKT594ABE9992605', 'Rot Arbete måla tak', '15', 'hours', '600', '0', '9000');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE IF NOT EXISTS `invoices` (
  `invoice_id` varchar(20) NOT NULL,
  `ticket_id` varchar(30) NOT NULL,
  `admin` varchar(20) NOT NULL,
  `ini_name` varchar(20) NOT NULL,
  `ini_phone` varchar(20) NOT NULL,
  `vendor` varchar(20) NOT NULL,
  `service` varchar(20) NOT NULL,
  `sub_service` varchar(20) NOT NULL,
  `bill_due` varchar(11) NOT NULL,
  `description` varchar(5000) NOT NULL,
  `rot` varchar(10) NOT NULL,
  `inv_status` varchar(10) NOT NULL,
  `bill_due_date` varchar(20) NOT NULL,
  `invoice_date` varchar(20) NOT NULL,
  `shipping` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`invoice_id`, `ticket_id`, `admin`, `ini_name`, `ini_phone`, `vendor`, `service`, `sub_service`, `bill_due`, `description`, `rot`, `inv_status`, `bill_due_date`, `invoice_date`, `shipping`) VALUES
('1024', 'TKT59477B6F4A4A9', 'admin2', 'Rockfeller Edward', '0725083912', 'vendor1', 'Kitchen', 'water leak', '20', 'This is for description', '', 'UnPaid', '10-07-2017', '20-06-2017', ''),
('1025', 'TKT594ABE9992605', 'admin2', 'Rockfeller Edward', '0735907853', 'vendor1', 'Living room', 'woodwork', '10', 'Texten har vi valt. \r\n', 'True', 'Paid', '04-07-2017', '24-06-2017', ''),
('1026', 'TKT59477B9705FAE', 'Rockfeller', 'Rockfeller Edward', '0725083912', 'vendor1', 'Kitchen', 'water leak', '20', '', 'True', 'Cancelled', '20-07-2017', '30-06-2017', ''),
('1027', 'TKT594C14135BC4C', 'Rockfeller', 'Rockfeller Edward', '0725083912', 'vendor1', 'Living room', 'radiator', '10', '', 'True', 'UnPaid', '11-07-2017', '01-07-2017', ''),
('1028', 'TKT59467FE4D5566', 'test', 'test1', '123123', 'Rockfeller Edward', 'Bathroom', 'drain', '10', '', '', 'UnPaid', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `rot`
--

CREATE TABLE IF NOT EXISTS `rot` (
  `ticket_id` varchar(20) NOT NULL,
  `label1` varchar(20) NOT NULL,
  `label2` varchar(20) NOT NULL,
  `label3` varchar(20) NOT NULL,
  `label4` varchar(20) NOT NULL,
  `personal_number` varchar(20) NOT NULL,
  `rot_data` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rot`
--

INSERT INTO `rot` (`ticket_id`, `label1`, `label2`, `label3`, `label4`, `personal_number`, `rot_data`) VALUES
('TKT594ABE9992605', '77373737', '88773783', '', '', '840829234', 'This is static data from database only occurs on ROT enabled'),
('TKT59477B9705FAE', 'null', 'sfsfsf 1245', '', '', '8407140899', 'This is static data from database only occurs on ROT enabled'),
('TKT594C14135BC4C', '2342342432', '324234234', '', '', '8407140899', 'This is static data from database only occurs on ROT enabled');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `service_id` int(5) NOT NULL,
  `service` varchar(50) NOT NULL,
  `sub_service` varchar(30) NOT NULL,
  `price` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `service`, `sub_service`, `price`) VALUES
(1, 'Bathroom', 'drain', '100'),
(2, 'Bathroom', 'Bath', '122'),
(3, 'Bathroom', 'bathroom cabinet', '4'),
(4, 'Bathroom', 'lighting', '42'),
(5, 'Bathroom', 'mixer', '10'),
(6, 'Bathroom', 'door', '2'),
(7, 'Bathroom', 'el', '10'),
(8, 'Bathroom', 'window', '3'),
(9, 'Bathroom', 'towel drying', '3'),
(10, 'Bathroom', 'basin', '2'),
(11, 'Bathroom', 'radiator', '10'),
(12, 'Bathroom', 'joinery', '1'),
(13, 'Bathroom', 'water', '10'),
(14, 'Bathroom', 'water leak', '7'),
(15, 'Bathroom', 'w.c', '7'),
(16, 'Bathroom', 'ventilation', '10'),
(17, 'Bathroom', 'Other', '8'),
(18, 'Hall', 'lighting', '9'),
(19, 'Hall', 'door', '10'),
(20, 'Hall', 'el', '10'),
(21, 'Hall', 'window', '10'),
(22, 'Hall', 'radiator', '3'),
(23, 'Hall', 'woodwork', '10'),
(24, 'Hall', 'water leak', '3'),
(25, 'Hall', 'ventilation', '2'),
(26, 'Hall', 'Other', '10'),
(27, 'Kitchen', 'drain', '2'),
(28, 'Kitchen', 'lighting', '10'),
(29, 'Kitchen', 'mixer', '2'),
(30, 'Kitchen', 'dishwasher', '2'),
(31, 'Kitchen', 'door', '2'),
(32, 'Kitchen', 'el', '10'),
(33, 'Kitchen', 'fan', '10'),
(34, 'Kitchen', 'freezer', '10'),
(35, 'Kitchen', 'window', '10'),
(36, 'Kitchen', 'fridge', '10'),
(37, 'Kitchen', 'Micro', '10'),
(38, 'Kitchen', 'radiator', '10'),
(39, 'Kitchen', 'woodwork', '10'),
(40, 'Kitchen', 'stove', '10'),
(41, 'Kitchen', 'oven', '10'),
(42, 'Kitchen', 'water', '10'),
(43, 'Kitchen', 'water leak', '15'),
(44, 'Kitchen', 'ventilation', '10'),
(45, 'Kitchen', 'Other', '10'),
(46, 'Apartment', 'avflyttningssyn', '10'),
(47, 'Apartment', 'balcony', '10'),
(48, 'Apartment', 'smoke alarms', '10'),
(49, 'Apartment', 'el', '10'),
(50, 'Apartment', 'moisture', '10'),
(51, 'Apartment', 'moisture measurement', '10'),
(52, 'Apartment', 'burglary', '10'),
(53, 'Apartment', 'closet', '10'),
(54, 'Apartment', 'lock', '10'),
(55, 'Apartment', 'l?genhetssyn', '10'),
(56, 'Apartment', 'intercom', '10'),
(57, 'Apartment', 'renovation', '10'),
(58, 'Apartment', 'pipe', '10'),
(59, 'Apartment', 'woodwork', '10'),
(60, 'Apartment', 'stove', '10'),
(61, 'Apartment', 'power failure', '10'),
(62, 'Apartment', 'dryer', '10'),
(63, 'Apartment', 'washing machine', '10'),
(64, 'Apartment', 'water', '10'),
(65, 'Apartment', 'water leak', '10'),
(66, 'Apartment', 'ventilation', '10'),
(67, 'Apartment', 'HEAT', '10'),
(68, 'Apartment', 'front door', '10'),
(69, 'Apartment', 'Other', '10'),
(70, 'Bedroom', 'lighting', '10'),
(71, 'Bedroom', 'door', '10'),
(72, 'Bedroom', 'el', '10'),
(73, 'Bedroom', 'window', '10'),
(74, 'Bedroom', 'radiator', '10'),
(75, 'Bedroom', 'woodwork', '10'),
(76, 'Bedroom', 'water leak', '10'),
(77, 'Bedroom', 'ventilation', '10'),
(78, 'Bedroom', 'Other', '10'),
(79, 'Living room', 'lighting', '10'),
(80, 'Living room', 'door', '10'),
(81, 'Living room', 'el', '10'),
(82, 'Living room', 'window', '10'),
(83, 'Living room', 'radiator', '10'),
(84, 'Living room', 'woodwork', '10'),
(85, 'Living room', 'water leak', '10'),
(86, 'Living room', 'ventilation', '10'),
(87, 'Living room', 'Other', '10'),
(88, 'Other', 'renaming', '10'),
(89, 'Other', 'key ordering', '10'),
(90, 'Other', 'plumbing', '10'),
(91, 'Other', 'woodwork', '10'),
(92, 'Other', 'supervision', '10'),
(93, 'Other', 'set / distributing information', '10'),
(94, 'Other', 'water shutoff', '10'),
(95, 'Other', 'open to artisans', '10'),
(98, 'test', 'test', '1'),
(99, 'Main Road', 'Street Light', '50000'),
(100, 'Hall', 'Vägg', '10');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE IF NOT EXISTS `tickets` (
  `ticket_id` varchar(50) NOT NULL,
  `ini_name` varchar(50) NOT NULL,
  `ini_phone` varchar(30) NOT NULL,
  `ini_email` varchar(50) NOT NULL,
  `ini_address` varchar(100) NOT NULL,
  `ini_doornum` varchar(30) NOT NULL,
  `ini_type` varchar(20) NOT NULL,
  `pref_time` varchar(50) NOT NULL,
  `keys_tube` varchar(10) NOT NULL,
  `pets_home` varchar(10) NOT NULL,
  `pets_data` varchar(500) NOT NULL,
  `service` varchar(30) NOT NULL,
  `sub_service` varchar(30) NOT NULL,
  `description` varchar(5000) NOT NULL,
  `status` varchar(50) NOT NULL,
  `vendor` varchar(30) NOT NULL,
  `created_on` varchar(30) NOT NULL,
  `closed_on` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`ticket_id`, `ini_name`, `ini_phone`, `ini_email`, `ini_address`, `ini_doornum`, `ini_type`, `pref_time`, `keys_tube`, `pets_home`, `pets_data`, `service`, `sub_service`, `description`, `status`, `vendor`, `created_on`, `closed_on`) VALUES
('TKT59467FE4D5566', 'test1', '123123', 'pradeep@qa-masters.com', 'test', 'test', 'BRF Owner', '8:00 - 11:00', 'No', 'No', '', 'Bathroom', 'drain', '', 'Invoice Raised', 'Rockfeller Edward', '18-05-2017 01:28:04', '29-06-2017 05:16:55'),
('TKT59477B6F4A4A9', 'Rockfeller Edward', '0725083912', 'rockfeller.edward@atg.se', 'KRYSSHAMMARVÄGEN', '1231', 'Tenant', '9:00 - 12:00', 'No', 'Yes', 'sfsdf', 'Kitchen', 'water leak', '', 'Rejected by Vendor - vendor1', '', '19-06-2017 07:21:19', ''),
('TKT59477B9705FAE', 'Rockfeller Edward', '0725083912', 'rockfeller.edward@atg.se', 'KRYSSHAMMARVÄGEN', '1231', 'Tenant', '9:00 - 12:00', 'No', 'Yes', 'Dog in the bedroom', 'Kitchen', 'water leak', 'Write now ', 'Invoice Raised', 'vendor1', '19-06-2017 07:21:59', ''),
('TKT594ABE9992605', 'Rockfeller Edward', '0735907853', 'rockfeller.edward@hotmail.com', 'Krysshammarvägen 22, 17157 solna', '1231', 'Tenant', '9:00 - 12:00', 'Yes', 'Yes', 'Inlåst i sovrummet', 'Living room', 'woodwork', '', 'Invoice Raised', 'vendor1', '21-06-2017 06:44:41', '21-06-2017 06:56:36'),
('TKT594C14135BC4C', 'Rockfeller Edward', '0725083912', 'rockfeller.edward@hotmail.com', 'Krysshammarvägen 22, 17157 Solna', '1231', 'Tenant', '10:00 - 13:00', 'Yes', 'No', '', 'Living room', 'radiator', 'testing description', 'Invoice Raised', 'vendor1', '22-06-2017 07:01:39', ''),
('TKT59551A093D822', 'Chandra', '730832879', 'gowthamcp@gmail.com', 'Sibilusgangan ', '22', 'Tenant', '13:00 - 16:00', 'No', 'No', '', 'Apartment', 'avflyttningssyn', 'Testing', 'Assigned to: vendor1', 'vendor1', '29-06-2017 03:17:29', ''),
('TKT5955EC3221FC3', '', '0725083912', 'rockfeller.edward@atg.se', 'KRYSSHAMMARVÄGEN 22, 17157 Solna', '0000', 'BRF Owner', '8:00 - 11:00', 'Yes', 'No', '', 'Apartment', 'renovation', 'Måste rensas.', 'Deleted', '', '30-06-2017 06:14:10', '30-06-2017 06:16:55'),
('TKT5955EC467BB57', 'Rockfeller Edward', '0725083912', 'rockfeller.edward@atg.se', 'KRYSSHAMMARVÄGEN 22, 17157 Solna', '0000', 'BRF Owner', '8:00 - 11:00', 'Yes', 'No', '', 'Apartment', 'renovation', '', 'Closed', '', '30-06-2017 06:14:30', '03-07-2017 09:13:02'),
('TKT59577A12304E0', 'Rockfeller Edward', '725083912', 'rockfeller.edward@hotmail.com', 'Krysshammarvägen 22, 17157 solna', '1231', 'BRF Owner', '10:00 - 13:00', 'Yes', 'Yes', 'bedroom', 'Bedroom', 'radiator', 'problem med ', 'Assigned to: vendor1', 'vendor1', '01-07-2017 10:31:46', ''),
('TKT595A2527EF0A4', 'Praveen Kumar Cherukuri', '767458376', 'praveen@mailinator.com', 'Liljeholmen', '37', 'BRF Owner', '10:00 - 13:00', 'No', 'Yes', '', 'Kitchen', 'el', 'Sample description', 'Assigned to: Rockfeller Edward', 'Rockfeller Edward', '03-07-2017 11:06:16', '');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE IF NOT EXISTS `vendors` (
  `vendor_id` varchar(10) NOT NULL,
  `vendor_name` varchar(20) NOT NULL,
  `vendor_email` varchar(20) NOT NULL,
  `vendor_phone` varchar(20) NOT NULL,
  `vendor_password` varchar(20) NOT NULL,
  `vendor_status` varchar(10) NOT NULL,
  `profilepic` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`vendor_id`, `vendor_name`, `vendor_email`, `vendor_phone`, `vendor_password`, `vendor_status`, `profilepic`) VALUES
('1024', 'Rockfeller Edward', 'vendor1@fixit.com', '0725083912', 'vendor', 'Enabled', '1024.png');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
