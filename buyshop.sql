-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2023 at 02:35 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `buyshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_code_rewards`
--

CREATE TABLE `tbl_code_rewards` (
  `id` int(11) NOT NULL,
  `reward_id` int(11) NOT NULL,
  `code` varchar(64) NOT NULL,
  `timeadd` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_game`
--

CREATE TABLE `tbl_game` (
  `id` int(11) NOT NULL,
  `typegame` varchar(32) NOT NULL,
  `name` varchar(64) NOT NULL,
  `img` varchar(255) NOT NULL,
  `platform` varchar(32) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_game`
--

INSERT INTO `tbl_game` (`id`, `typegame`, `name`, `img`, `platform`, `status`) VALUES
(1, 'idgame', 'ROV', 'rov.png', 'Mobile', 1),
(2, 'idgame', 'PUBG Mobile', 'channels4_profile.jpg', 'Mobile', 1),
(3, 'idgame', 'VOLORANT', 'volorant.png', 'Steam', 1),
(4, 'account', 'Netflix', 'Netflix_icon.png', 'Netflix', 1),
(5, 'account', 'YouTube', '3938037.png', 'YouTube', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_history_api`
--

CREATE TABLE `tbl_history_api` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `info` varchar(9999) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `timeadd` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_history_rewards`
--

CREATE TABLE `tbl_history_rewards` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `game` varchar(32) NOT NULL,
  `value` varchar(32) NOT NULL,
  `timeadd` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `username` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_history_rewards`
--

INSERT INTO `tbl_history_rewards` (`id`, `name`, `game`, `value`, `timeadd`, `status`, `username`) VALUES
(10, 'บัตร Truemoney 50 บาท', 'spin', '123123123123', 1687430127, 1, 'admin'),
(11, 'บัตร Truemoney 50 บาท', 'spin', 'Gif Code หมดติดต่อ แอดมิน!!', 1687430138, 1, 'admin'),
(12, '5 - 10 เครดิต', 'spin', '8 เครดิต', 1687430182, 1, 'admin'),
(13, 'ไม่ได้รับรางวัล', 'spin', 'ไม่ได้รับรางวัล', 1687430218, 1, 'admin'),
(22, 'ไม่ได้รับรางวัล', 'roller', 'ไม่ได้รับรางวัล', 1687443846, 1, 'admin'),
(23, 'Steam Wallet 1,000 บาท', 'roller', 'testesstse', 1687443998, 1, 'admin'),
(24, 'Steam Wallet 1,000 บาท', 'roller', 'Gif Code หมดติดต่อ แอดมิน!!', 1687444015, 1, 'admin'),
(25, '5-10 เครดิต', 'roller', '10 เครดิต', 1687444050, 1, 'admin'),
(26, '5-10 เครดิต', 'roller', '10 เครดิต', 1687444066, 1, 'admin'),
(27, '5-10 เครดิต', 'roller', '5 เครดิต', 1687444079, 1, 'admin'),
(28, '5-10 เครดิต', 'roller', '5 เครดิต', 1687454157, 1, 'admin'),
(29, '5-10 เครดิต', 'roller', '7 เครดิต', 1687454168, 1, 'admin'),
(37, 'ไม่ได้รับรางวัล', 'slot', 'ไม่ได้รับรางวัล', 1687457170, 1, 'admin'),
(38, 'ไม่ได้รับรางวัล', 'slot', 'ไม่ได้รับรางวัล', 1687457249, 1, 'admin'),
(39, 'บัตร Truemoney 1,000 บาท', 'slot', 'aaabbbccc', 1687457259, 1, 'admin'),
(40, '5-10 เครดิต', 'roller', '10 เครดิต', 1687457852, 1, 'admin'),
(41, '5-10 เครดิต', 'roller', '9 เครดิต', 1687457862, 1, 'admin'),
(42, 'บัตร Truemoney 1,000 บาท', 'spin', 'aaaaabbbbbcccccc', 1687457895, 1, 'admin'),
(43, '5-10 เครดิต', 'roller', '7 เครดิต', 1687457912, 1, 'admin'),
(44, 'บัตร Truemoney 1,000 บาท', 'slot', 'Gif Code หมดติดต่อ แอดมิน!!', 1687457929, 1, 'admin'),
(45, 'ไม่ได้รับรางวัล', 'slot', 'ไม่ได้รับรางวัล', 1687457999, 1, 'admin'),
(46, 'ไม่ได้รับรางวัล', 'slot', 'ไม่ได้รับรางวัล', 1687458060, 1, 'admin'),
(47, 'ไม่ได้รับรางวัล', 'slot', 'ไม่ได้รับรางวัล', 1687458068, 1, 'admin'),
(48, 'ไม่ได้รับรางวัล', 'slot', 'ไม่ได้รับรางวัล', 1687458078, 1, 'admin'),
(49, 'บัตร Truemoney 50 บาท', 'spin', 'truecode50', 1687464275, 1, 'user2'),
(50, 'ไม่ได้รับรางวัล', 'roller', 'ไม่ได้รับรางวัล', 1687464294, 1, 'user2'),
(51, 'ไม่ได้รับรางวัล', 'slot', 'ไม่ได้รับรางวัล', 1687464306, 1, 'user2'),
(52, 'ไม่ได้รับรางวัล', 'slot', 'ไม่ได้รับรางวัล', 1687464403, 1, 'user2'),
(53, 'บัตร Truemoney 50 บาท', 'spin', 'Gif Code หมดติดต่อ แอดมิน!!', 1688977789, 1, 'kuy99'),
(54, 'บัตร Truemoney 50 บาท', 'spin', 'Gif Code หมดติดต่อ แอดมิน!!', 1688977810, 1, 'admin'),
(55, 'ไม่ได้รับรางวัล', 'roller', 'ไม่ได้รับรางวัล', 1688977829, 1, 'kuy99'),
(56, 'ไม่ได้รับรางวัล', 'roller', 'ไม่ได้รับรางวัล', 1688977839, 1, 'kuy99'),
(57, 'ไม่ได้รับรางวัล', 'roller', 'ไม่ได้รับรางวัล', 1688977860, 1, 'kuy99'),
(58, 'ไม่ได้รับรางวัล', 'slot', 'ไม่ได้รับรางวัล', 1688977886, 1, 'kuy99'),
(59, 'ไม่ได้รับรางวัล', 'slot', 'ไม่ได้รับรางวัล', 1688977893, 1, 'kuy99'),
(60, '5 - 10 เครดิต', 'slot', '6 เครดิต', 1688977900, 1, 'kuy99'),
(61, '5 - 10 เครดิต', 'slot', '7 เครดิต', 1688977907, 1, 'kuy99'),
(62, 'ไม่ได้รับรางวัล', 'slot', 'ไม่ได้รับรางวัล', 1688977935, 1, 'kuy99'),
(63, 'บัตร Truemoney 50 บาท', 'spin', 'Gif Code หมดติดต่อ แอดมิน!!', 1689383326, 1, 'admin'),
(64, 'ไม่ได้รับรางวัล', 'roller', 'ไม่ได้รับรางวัล', 1689383349, 1, 'admin'),
(65, 'ไม่ได้รับรางวัล', 'slot', 'ไม่ได้รับรางวัล', 1689383373, 1, 'admin'),
(66, 'บัตร Truemoney 50 บาท', 'spin', 'Gif Code หมดติดต่อ แอดมิน!!', 1689383427, 1, 'admin'),
(67, 'บัตร Truemoney 50 บาท', 'spin', 'Gif Code หมดติดต่อ แอดมิน!!', 1689383438, 1, 'admin'),
(68, 'บัตร Truemoney 50 บาท', 'spin', 'Gif Code หมดติดต่อ แอดมิน!!', 1689840228, 1, 'admin'),
(69, 'ไม่ได้รับรางวัล', 'roller', 'ไม่ได้รับรางวัล', 1689840250, 1, 'admin'),
(70, 'ไม่ได้รับรางวัล', 'roller', 'ไม่ได้รับรางวัล', 1689840262, 1, 'admin'),
(71, 'ไม่ได้รับรางวัล', 'slot', 'ไม่ได้รับรางวัล', 1689840291, 1, 'admin'),
(72, 'ไม่ได้รับรางวัล', 'slot', 'ไม่ได้รับรางวัล', 1689840298, 1, 'admin'),
(73, '5 - 10 เครดิต', 'slot', '7 เครดิต', 1689840305, 1, 'admin'),
(74, 'ไม่ได้รับรางวัล', 'roller', 'ไม่ได้รับรางวัล', 1698844720, 1, 'patiphan'),
(75, 'ไม่ได้รับรางวัล', 'roller', 'ไม่ได้รับรางวัล', 1698844733, 1, 'patiphan'),
(76, 'ไม่ได้รับรางวัล', 'roller', 'ไม่ได้รับรางวัล', 1698844747, 1, 'patiphan'),
(77, 'ไม่ได้รับรางวัล', 'roller', 'ไม่ได้รับรางวัล', 1698844761, 1, 'patiphan'),
(78, 'ไม่ได้รับรางวัล', 'roller', 'ไม่ได้รับรางวัล', 1698844776, 1, 'patiphan'),
(79, 'ไม่ได้รับรางวัล', 'roller', 'ไม่ได้รับรางวัล', 1698844839, 1, 'patiphan'),
(80, 'ไม่ได้รับรางวัล', 'slot', 'ไม่ได้รับรางวัล', 1698844882, 1, 'patiphan'),
(81, 'ไม่ได้รับรางวัล', 'slot', 'ไม่ได้รับรางวัล', 1698844906, 1, 'patiphan'),
(82, 'ไม่ได้รับรางวัล', 'slot', 'ไม่ได้รับรางวัล', 1698844921, 1, 'patiphan'),
(83, 'ไม่ได้รับรางวัล', 'slot', 'ไม่ได้รับรางวัล', 1698844961, 1, 'patiphan'),
(84, 'ไม่ได้รับรางวัล', 'slot', 'ไม่ได้รับรางวัล', 1698844971, 1, 'patiphan'),
(85, 'ไม่ได้รับรางวัล', 'slot', 'ไม่ได้รับรางวัล', 1698844980, 1, 'patiphan'),
(86, '5 - 10 เครดิต', 'slot', '6 เครดิต', 1698844986, 1, 'patiphan'),
(87, 'ไม่ได้รับรางวัล', 'slot', 'ไม่ได้รับรางวัล', 1698845015, 1, 'patiphan'),
(88, 'ไม่ได้รับรางวัล', 'slot', 'ไม่ได้รับรางวัล', 1698845023, 1, 'patiphan'),
(89, 'ไม่ได้รับรางวัล', 'slot', 'ไม่ได้รับรางวัล', 1698845054, 1, 'patiphan'),
(90, 'ไม่ได้รับรางวัล', 'slot', 'ไม่ได้รับรางวัล', 1698845062, 1, 'patiphan'),
(91, 'ไม่ได้รับรางวัล', 'slot', 'ไม่ได้รับรางวัล', 1698845069, 1, 'patiphan'),
(92, '5 - 10 เครดิต', 'slot', '10 เครดิต', 1698845823, 1, 'patiphan'),
(93, 'ไม่ได้รับรางวัล', 'slot', 'ไม่ได้รับรางวัล', 1698845831, 1, 'patiphan'),
(94, 'ไม่ได้รับรางวัล', 'slot', 'ไม่ได้รับรางวัล', 1698845837, 1, 'patiphan'),
(95, 'ไม่ได้รับรางวัล', 'slot', 'ไม่ได้รับรางวัล', 1698845873, 1, 'patiphan'),
(96, 'ไม่ได้รับรางวัล', 'slot', 'ไม่ได้รับรางวัล', 1698845886, 1, 'patiphan'),
(97, 'ไม่ได้รับรางวัล', 'slot', 'ไม่ได้รับรางวัล', 1698845890, 1, 'patiphan'),
(98, 'บัตร Truemoney 50 บาท', 'spin', 'Gif Code หมดติดต่อ แอดมิน!!', 1698845908, 1, 'patiphan'),
(99, 'บัตร Truemoney 50 บาท', 'spin', 'Gif Code หมดติดต่อ แอดมิน!!', 1698845922, 1, 'patiphan'),
(100, 'บัตร Truemoney 50 บาท', 'spin', 'Gif Code หมดติดต่อ แอดมิน!!', 1698845933, 1, 'patiphan'),
(101, 'บัตร Truemoney 50 บาท', 'spin', 'Gif Code หมดติดต่อ แอดมิน!!', 1698845945, 1, 'patiphan'),
(102, 'บัตร Truemoney 50 บาท', 'spin', 'Gif Code หมดติดต่อ แอดมิน!!', 1698845956, 1, 'patiphan'),
(103, 'บัตร Truemoney 50 บาท', 'spin', 'Gif Code หมดติดต่อ แอดมิน!!', 1698845970, 1, 'patiphan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item_rewards`
--

CREATE TABLE `tbl_item_rewards` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `game` varchar(10) NOT NULL,
  `name` varchar(64) NOT NULL,
  `value` varchar(32) NOT NULL,
  `img` varchar(64) NOT NULL,
  `percent` int(11) NOT NULL,
  `color` varchar(10) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_item_rewards`
--

INSERT INTO `tbl_item_rewards` (`id`, `type`, `game`, `name`, `value`, `img`, `percent`, `color`, `status`) VALUES
(1, 2, 'spin', '10 - 20 เครดิต', '10|20', 'assets/img/rewards_icon/10-20.png', 0, '#2d8791', 1),
(2, 3, 'spin', 'บัตร Truemoney 50 บาท', '', 'assets/img/rewards_icon/true50.png', 100, '#2d8791', 1),
(3, 3, 'spin', 'บัตร Truemoney 1,000 บาท', '', 'assets/img/rewards_icon/true1000.png', 0, '#2d8791', 1),
(4, 1, 'spin', 'ไม่ได้รับรางวัล', '', 'assets/img/rewards_icon/noc-1.png', 0, '#546e7a', 1),
(5, 3, 'spin', 'บัตร Truemoney 90 บาท', '', 'assets/img/rewards_icon/true90.png', 0, '#2d8791', 1),
(6, 2, 'spin', '5 - 10 เครดิต', '5|10', 'assets/img/rewards_icon/5-10c.png', 0, '#2d8791', 1),
(7, 1, 'spin', 'ไม่ได้รับรางวัล', '', 'assets/img/rewards_icon/noc-1.png', 0, '#546e7a', 1),
(8, 3, 'slot', 'Steam Wallet 50 บาท', '', 'assets/img/rewards_icon/s50.png', 0, '#808080', 1),
(26, 1, 'roller', 'ไม่ได้รับรางวัล', '', 'assets/img/rewards_icon/noc-1.png', 100, '#2d8791', 1),
(27, 3, 'roller', 'Steam Wallet 1,000 บาท', '', 'assets/img/rewards_icon/s1000.png', 0, '#fe3939', 1),
(28, 2, 'roller', '5-10 เครดิต', '5|10', 'assets/img/rewards_icon/5-10c.png', 0, '#332c90', 1),
(29, 3, 'slot', 'Steam Wallet 100 บาท', '', 'assets/img/rewards_icon/s100.png', 0, '#8f8f8f', 1),
(30, 3, 'slot', 'Steam Wallet 1,000 บาท', '', 'assets/img/rewards_icon/s1000.png', 0, '#9c1111', 1),
(31, 3, 'slot', 'บัตร Truemoney 50 บาท', '', 'assets/img/rewards_icon/true50.png', 0, '#3e8a38', 1),
(32, 3, 'slot', 'บัตร Truemoney 90 บาท', '', 'assets/img/rewards_icon/true90.png', 0, '#d19329', 1),
(33, 1, 'slot', 'ไม่ได้รับรางวัล', '', 'assets/img/rewards_icon/noc-1.png', 50, '#5e5e5e', 1),
(34, 2, 'slot', '5 - 10 เครดิต', '5|10', 'assets/img/rewards_icon/5-10c.png', 97, '#cc286a', 1),
(35, 3, 'slot', 'บัตร Truemoney 300 บาท', '', 'assets/img/rewards_icon/true300.png', 0, '#f38a35', 1),
(36, 3, 'slot', 'บัตร Truemoney 1,000 บาท', '', 'assets/img/rewards_icon/true1000.png', 0, '#ff2929', 1),
(37, 1, 'slot', 'ไม่ได้รับรางวัล', '', 'assets/img/rewards_icon/noc-1.png', 53, '#363636', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_setting`
--

CREATE TABLE `tbl_setting` (
  `id` int(11) NOT NULL,
  `web_img` varchar(255) NOT NULL,
  `web_name` varchar(32) NOT NULL,
  `web_version` varchar(10) NOT NULL,
  `web_wallet` varchar(10) NOT NULL,
  `web_fb` varchar(255) NOT NULL,
  `web_discord` varchar(255) NOT NULL,
  `web_youtube` varchar(255) NOT NULL,
  `web_status` int(11) NOT NULL,
  `point_spin` varchar(7) NOT NULL,
  `point_roller` varchar(7) NOT NULL,
  `point_slot` varchar(7) NOT NULL,
  `web_color` varchar(255) NOT NULL,
  `menu_color` varchar(255) NOT NULL,
  `web_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_setting`
--

INSERT INTO `tbl_setting` (`id`, `web_img`, `web_name`, `web_version`, `web_wallet`, `web_fb`, `web_discord`, `web_youtube`, `web_status`, `point_spin`, `point_roller`, `point_slot`, `web_color`, `menu_color`, `web_title`) VALUES
(1, 'assets/img/Cyborg Logo Web1.png', 'CYBORG SHOP', '1.0.0', '0925728232', 'https://web.facebook.com/tptp.nw', 'https://web.facebook.com/tptp.nw', 'https://web.facebook.com/tptp.nw', 1, '10', '10', '10', '#000000', '#000000', 'CYBORG SHOP | จำหน่ายไอดีเกมส์ ยูทูปพรีเมี่ยม เน็ตฟิก');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shop_history`
--

CREATE TABLE `tbl_shop_history` (
  `id` int(11) NOT NULL,
  `secret_info` longtext NOT NULL,
  `timeadd` int(11) NOT NULL,
  `point` varchar(7) NOT NULL,
  `username` varchar(32) NOT NULL,
  `gameid` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shop_id`
--

CREATE TABLE `tbl_shop_id` (
  `id` int(11) NOT NULL,
  `gameid` int(11) NOT NULL,
  `shoptype` varchar(10) NOT NULL,
  `name` longtext NOT NULL,
  `img` longtext NOT NULL,
  `point` varchar(7) NOT NULL,
  `pointv` varchar(7) NOT NULL,
  `timeadd` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `count` int(11) NOT NULL,
  `top` int(11) NOT NULL,
  `secret_info` longtext NOT NULL,
  `publish_info` longtext NOT NULL,
  `owner` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_shop_id`
--

INSERT INTO `tbl_shop_id` (`id`, `gameid`, `shoptype`, `name`, `img`, `point`, `pointv`, `timeadd`, `status`, `username`, `count`, `top`, `secret_info`, `publish_info`, `owner`) VALUES
(1, 4, 'account', 'Netflix 4K 1 วัน / จอส่วนตัว', 'assets/img/shop/bg_netflix.gif', '19', '10', 1698850478, 1, 'patiphan', 0, 1, '1ahJSOZmfS47Jg64QjFEBXJtx8ACPD1kN6q7AxACjhr2upAROZU=', '&lt;p&gt;▶️ Netflix แอปดูหนังภาพยนตร์/ซีรีย์/การ์ตูน&lt;/p&gt;&lt;p&gt;▶️ Soundเสียง&amp;nbsp; พากย์ไทย/ซับไทย&lt;/p&gt;&lt;p&gt;▶️ ความชัดระดับ UltraHD 4K&lt;/p&gt;&lt;p&gt;▶️ สามารถรับชมจำนวน 1จอ&amp;nbsp;&lt;/p&gt;&lt;p&gt;▶️ แอคเคาท์ไทยแท้100%&lt;/p&gt;&lt;p&gt;▶️ จะได้รับเป็น Email/Password เข้าใช้งานได้ทันที&lt;/p&gt;&lt;p&gt;▶️ รองรับทุกอุปกรณ์ (TV,Com, Ipad ,มือถือ)&lt;/p&gt;&lt;p&gt;▶️ Netflixแพ็กเกจ UltraHD 4K รายเดือน&lt;/p&gt;&lt;p&gt;website https://www.netflix.com/&lt;/p&gt;', ''),
(2, 4, 'account', 'Netflix 4K 1 วัน / จอแชร์', 'assets/img/shop/bg_netflix.gif', '19', '15', 1698851004, 1, 'patiphan', 0, 0, '1ahJSOZmfS47Jg64MQVVE3U3iswAXDoeJri7BwgfmF7soIESOJIZ', '<p>▶️ Netflix แอปดูหนังภาพยนตร์/ซีรีย์/การ์ตูน</p><p>▶️ Soundเสียง&nbsp; พากย์ไทย/ซับไทย</p><p>▶️ ความชัดระดับ UltraHD 4K</p><p>▶️ สามารถรับชมจำนวน 1จอ&nbsp;</p><p>▶️ แอคเคาท์ไทยแท้100%</p><p>▶️ จะได้รับเป็น Email/Password เข้าใช้งานได้ทันที</p><p>▶️ รองรับทุกอุปกรณ์ (TV,Com, Ipad ,มือถือ)</p><p>▶️ Netflixแพ็กเกจ UltraHD 4K รายเดือน</p><p>website https://www.netflix.com/</p>', ''),
(3, 5, 'account', 'Youtube Premium / 30 วัน', 'assets/img/shop/ytx2.jpg', '159', '39', 1698850650, 1, 'patiphan', 0, 1, '1ahJSOZmfS47Jg64MAVVE3U3iswAXDoeJri7BwgfmF7soIESOJIZ', '&lt;p&gt;▶️ รับชม Youtube แบบไม่มีโฆษณาคั่น&lt;/p&gt;&lt;p&gt;▶️ ฟังเพลง Youtube Music แบบปิดหน้าจอได้&lt;/p&gt;&lt;p&gt;▶️ ดาวน์โหลดเพลงหรือบันทึกวิดีโอเล่นแบบออฟไลน์&lt;/p&gt;&lt;p&gt;▶️ จะได้รับเป็น Email/Password | ลิ้งคำเชิญ family เข้าใช้งานได้ทันที&lt;/p&gt;&lt;p&gt;▶️ รองรับทุกอุปกรณ์ (TV,Com, Ipad ,มือถือ)&lt;/p&gt;&lt;p&gt;▶️ Youtube Premiumแพ็กเกจ รายเดือน&lt;/p&gt;&lt;p&gt;website https://www.youtube.com/&lt;/p&gt;', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shop_stock`
--

CREATE TABLE `tbl_shop_stock` (
  `id` int(11) NOT NULL,
  `shopid` int(11) NOT NULL,
  `account` longtext NOT NULL,
  `time` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shop_stock_api`
--

CREATE TABLE `tbl_shop_stock_api` (
  `id` int(11) NOT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `price_web` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `stock` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `up` varchar(255) DEFAULT NULL,
  `showitem` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_shop_stock_api`
--

INSERT INTO `tbl_shop_stock_api` (`id`, `product_id`, `name`, `price`, `price_web`, `img`, `stock`, `status`, `up`, `showitem`) VALUES
(1, '1', 'Netflix 4K /30วัน (จอส่วนตัว)', '90.00', '120.00', 'https://byshop.me/api/img/app/netflix.png', '0', 'สินค้าหมด', '', 1),
(2, '2', 'Netflix 4K /7วัน (จอส่วนตัว)', '25.00', '35.00', 'https://byshop.me/api/img/app/netflix.png', '0', 'สินค้าหมด', '', 1),
(3, '3', 'Netflix 4K /30วัน (จอแชร์)', '69.00', '89.00', 'https://byshop.me/api/img/app/netflix.png', '13', 'พร้อมส่ง', '', 1),
(4, '4', 'Netflix 4K /7วัน (จอแชร์)', '15.00', '25.00', 'https://byshop.me/api/img/app/netflix.png', '0', 'สินค้าหมด', '', 1),
(5, '5', 'Disney+ /30วัน (จอส่วนตัว)', '79.00', '89.00', 'https://byshop.me/api/img/app/Disney.png', '0', 'สินค้าหมด', '', 1),
(6, '6', 'Youtube Premium/30วัน (เมลร้าน)', '10.00', '20.00', 'https://byshop.me/api/img/app/yt.png', '0', 'สินค้าหมด', '', 1),
(7, '7', 'Youtube Premium/30วัน (เมลตัวเอง)', '10.00', '29.00', 'https://byshop.me/api/img/app/yt.png', '0', 'สินค้าหมด', '', 1),
(8, '8', 'Youtube Premium/1ปี (เมลตัวเอง)', '450.00', '590.00', 'https://byshop.me/api/img/app/yt.png', '0', 'สินค้าหมด', '', 1),
(9, '9', 'MONOMAX/30วัน (จอส่วนตัว)', '35.00', '49.00', 'https://byshop.me/api/img/app/monomax.png', '8', 'พร้อมส่ง', '', 1),
(10, '10', 'MONOMAX/30วัน (จอแชร์)', '25.00', '39.00', 'https://byshop.me/api/img/app/monomax.png', '10', 'พร้อมส่ง', '', 1),
(11, '11', 'HBO GO/30วัน', '45.00', '59.00', 'https://byshop.me/api/img/app/hbo.png', '0', 'สินค้าหมด', '', 1),
(12, '12', 'VIU Premium/30วัน (หาร3)', '10.00', '29.00', 'https://byshop.me/api/img/app/viu.png', '30', 'พร้อมส่ง', '', 1),
(13, '13', 'iQIYI GOLD /30วัน', '22.00', '29.00', 'https://byshop.me/api/img/app/iq.png', '8', 'พร้อมส่ง', '', 1),
(14, '14', 'WeTV VIP /30วัน', '20.00', '29.00', 'https://byshop.me/api/img/app/wetv.png', '12', 'พร้อมส่ง', '', 1),
(15, '15', 'Amazon Prime Video/30วัน', '45.00', '59.00', 'https://byshop.me/api/img/app/pv.png', '0', 'สินค้าหมด', '', 1),
(16, '16', 'Amazon Prime Video/7วัน', '10.00', '19.00', 'https://byshop.me/api/img/app/pv.png', '15', 'พร้อมส่ง', '', 1),
(17, '17', 'Spotify Premium/30วัน(เมลร้าน)', '10.00', '29.00', 'https://byshop.me/api/img/app/sf.png', '0', 'สินค้าหมด', '', 1),
(18, '18', 'TrueID+ /30วัน', '25.00', '29.00', 'https://byshop.me/api/img/app/trueid+.png', '0', 'สินค้าหมด', '', 1),
(19, '19', 'AIS Play Premium /30วัน', '10.00', '29.00', 'https://byshop.me/api/img/app/ais.png', '0', 'สินค้าหมด', '', 1),
(20, '20', 'Bilibili /30วัน', '25.00', '29.00', 'https://byshop.me/api/img/app/bb.png', '12', 'พร้อมส่ง', '', 1),
(21, '21', 'Netflix 4K /1วัน (จอส่วนตัว)', '7.00', '10.00', 'https://byshop.me/api/img/app/netflix.png', '0', 'สินค้าหมด', '', 1),
(22, '22', 'Netflix 4K /1วัน (จอแชร์)', '5.00', '7.00', 'https://byshop.me/api/img/app/netflix.png', '0', 'สินค้าหมด', '', 1),
(23, '23', 'Netflix 4K /30วัน (TV) (จอส่วนตัว)', '159.00', '179.00', 'https://byshop.me/api/img/app/netflix.png', '0', 'สินค้าหมด', '', 1),
(24, '24', 'VIU Premium/30วัน (หาร4)', '29.00', '29.00', 'https://byshop.me/api/img/app/viu.png', '0', 'สินค้าหมด', '', 1),
(25, '25', 'BeinSports /30วัน', '49.00', '29.00', 'https://byshop.me/api/img/app/bs.png', '0', 'สินค้าหมด', '', 1),
(26, '26', 'CH3 Plus /30วัน', '39.00', '29.00', 'https://byshop.me/api/img/app/ch3.png', '0', 'สินค้าหมด', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slide`
--

CREATE TABLE `tbl_slide` (
  `id` int(11) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `height` varchar(255) DEFAULT NULL,
  `id_img` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_slide`
--

INSERT INTO `tbl_slide` (`id`, `img`, `height`, `id_img`) VALUES
(11, 'brandner.jpg', '300px', '1'),
(12, '01.jpg', '300px', '0'),
(13, '02.jpg', '300px', '0'),
(14, '03.jpg', '300px', '0'),
(15, '0001.png', '300px', '0'),
(16, 'v1.png', '300px', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_topup`
--

CREATE TABLE `tbl_topup` (
  `id` int(11) NOT NULL,
  `topupby` varchar(32) NOT NULL,
  `topuptime` int(11) NOT NULL,
  `point` varchar(7) NOT NULL,
  `status` int(11) NOT NULL,
  `username` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `point` varchar(7) NOT NULL,
  `ip` varchar(32) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `img`, `username`, `password`, `email`, `point`, `ip`, `status`) VALUES
(1, 'https://lh3.googleusercontent.com/a/ACg8ocKxXIh5RhQ-08TVdKcPD9CvtZK6wT8PnXp6L33oyO5HPA=s96-c', 'patiphan', '108658380967055078189', 'patiphan.dev@gmail.com', '736', '::1', 7),
(2, 'https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=6840360772746850&height=50&width=50&ext=1701432785&hash=AeSCUx0sqwfpPVotMSc', 'Patiphan Nw', '6840360772746850', 'patiphan1998.fb@gmail.com', '1000', '::1', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_code_rewards`
--
ALTER TABLE `tbl_code_rewards`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_game`
--
ALTER TABLE `tbl_game`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_history_api`
--
ALTER TABLE `tbl_history_api`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_history_rewards`
--
ALTER TABLE `tbl_history_rewards`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_item_rewards`
--
ALTER TABLE `tbl_item_rewards`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_shop_history`
--
ALTER TABLE `tbl_shop_history`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_shop_id`
--
ALTER TABLE `tbl_shop_id`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_shop_stock`
--
ALTER TABLE `tbl_shop_stock`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_shop_stock_api`
--
ALTER TABLE `tbl_shop_stock_api`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_slide`
--
ALTER TABLE `tbl_slide`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_topup`
--
ALTER TABLE `tbl_topup`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_code_rewards`
--
ALTER TABLE `tbl_code_rewards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_game`
--
ALTER TABLE `tbl_game`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_history_api`
--
ALTER TABLE `tbl_history_api`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_history_rewards`
--
ALTER TABLE `tbl_history_rewards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `tbl_item_rewards`
--
ALTER TABLE `tbl_item_rewards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_shop_history`
--
ALTER TABLE `tbl_shop_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_shop_id`
--
ALTER TABLE `tbl_shop_id`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_shop_stock`
--
ALTER TABLE `tbl_shop_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_shop_stock_api`
--
ALTER TABLE `tbl_shop_stock_api`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_slide`
--
ALTER TABLE `tbl_slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_topup`
--
ALTER TABLE `tbl_topup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
