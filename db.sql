-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2017 at 06:37 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `infohowt_apx`
--

-- --------------------------------------------------------

--
-- Table structure for table `apx_admin`
--

CREATE TABLE `apx_admin` (
  `id` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `detail` text NOT NULL,
  `role_id` int(11) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(4) NOT NULL,
  `isActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apx_admin`
--

INSERT INTO `apx_admin` (`id`, `first_name`, `last_name`, `user_name`, `email`, `phone`, `password`, `detail`, `role_id`, `picture`, `created_date`, `created_by`, `modified_date`, `modified_by`, `status`, `isActive`) VALUES
(5, 'abc', 'def', 'abcd', 'zohra@smxoft.com', '3335324908', '81dc9bdb52d04dc20036dbd8313ed055', '                                                                                                                                                                                                                                                                                                                                          \r\n       asdsfdgsfhgf dfghfgh                                                                                                       \r\n                                                                                                              \r\n                                                                                                              \r\n                                                                                                              \r\n                                                       ', 1, '', '2016-09-24 00:28:33', 0, '2016-11-08 05:43:50', 6, 1, 0),
(6, '', '', 'smehsoud', '', '', 'd81f9c1be2e08964bf9f24b15f0e4900', '', 1, '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(8, 'saeed', 'Ullah', 'saeed', 'smehsoud@yahoo.com', '1234123', '202cb962ac59075b964b07152d234b70', 'saeed ullah is a soft ware engineer.', 1, '', '2016-10-02 06:28:41', 0, '2016-10-02 21:11:43', 6, 1, 0),
(9, 'Zack', 'Fiturber', 'zack', 'zack@info-howto.com', '00442081237919', '6c36bbf61664629c5ad59598121c6197', 'This is Admin', 2, '', '2016-10-02 18:32:49', 0, '0000-00-00 00:00:00', 0, 1, 0),
(10, 'Arhab', 'Zaidi', 'arhab', 'arhab@apxintl.com', '00442081237919', 'e10adc3949ba59abbe56e057f20f883e', 'Test Member', 3, '', '2016-11-10 20:20:50', 6, '2017-02-27 22:53:00', 5, 1, 0),
(11, 'admin', 'admin', 'admin', 'admin@gmail.com', '123456', '21232f297a57a5a743894a0e4a801fc3', 'test admin', 2, '', '2017-02-27 22:49:45', 5, '0000-00-00 00:00:00', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `apx_balance_tbl`
--

CREATE TABLE `apx_balance_tbl` (
  `blc_id` int(11) NOT NULL,
  `accountNumber` varchar(30) NOT NULL,
  `balanceAmount` float(10,2) NOT NULL,
  `deposit_date` date NOT NULL,
  `description` text NOT NULL,
  `balanceType` enum('Credit','Payment','Open') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apx_balance_tbl`
--

INSERT INTO `apx_balance_tbl` (`blc_id`, `accountNumber`, `balanceAmount`, `deposit_date`, `description`, `balanceType`) VALUES
(1, '4001', 1000.00, '2017-02-01', 'Account open balance', 'Open'),
(2, '4001', 500.00, '2017-03-04', '', 'Credit'),
(3, '4001', 400.00, '2017-03-08', 'post payment', 'Payment');

-- --------------------------------------------------------

--
-- Table structure for table `apx_branches`
--

CREATE TABLE `apx_branches` (
  `branch_id` int(11) NOT NULL,
  `code` varchar(15) NOT NULL,
  `name` varchar(25) NOT NULL,
  `manager` varchar(25) NOT NULL,
  `contactNu1` varchar(15) NOT NULL,
  `contactNu2` varchar(15) NOT NULL,
  `contactNu3` varchar(15) NOT NULL,
  `mangerContactNu` varchar(15) NOT NULL,
  `addressLine1` varchar(100) NOT NULL,
  `addressLine2` varchar(100) NOT NULL,
  `countryCode` varchar(10) NOT NULL,
  `state` varchar(25) NOT NULL,
  `city` varchar(25) NOT NULL,
  `zipCode` varchar(15) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(4) NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_by` int(4) NOT NULL DEFAULT '0',
  `status` int(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apx_branches`
--

INSERT INTO `apx_branches` (`branch_id`, `code`, `name`, `manager`, `contactNu1`, `contactNu2`, `contactNu3`, `mangerContactNu`, `addressLine1`, `addressLine2`, `countryCode`, `state`, `city`, `zipCode`, `created_date`, `created_by`, `modified_date`, `modified_by`, `status`) VALUES
(1, '2312', 'Information technology', 'saeed', '923874987', '3289127398', '398127398712983', '', 'jkchkjc dcdsjkhcfk dsdfs', 'ashdhaskj dasd asdhash d', 'PK', 'ICT', 'Islamabad', '44000', '2016-10-05 10:30:00', 6, '2016-10-05 22:00:12', 6, -1),
(5, '0044', 'Head Office', 'Zack', '00442081237919', '00442081237919', '00442081237919', '00447991237919', '28 sheraton busness Centre', 'Essex', 'PK', 'London', 'London', 'UB2 4JR', '2016-10-06 06:40:00', 6, '2016-10-06 15:08:56', 6, -1),
(6, '44123', 'APX UK', 'Zack Fiturber', '00442081237919', '00442081237919', '00442081237919', '00447991237919', '28 sheraton busness Centre', 'Essex', 'GB', 'London', 'London', 'UB2 4JR', '2016-10-17 15:53:04', 6, '0000-00-00 00:00:00', 0, -1),
(7, '92123', 'APX PK', 'Irfan Khan', '0511234567', '0511234567', '0511234567', '03210000000', '1293 strre 5 sect4', 'Islamabad', 'PK', 'Islamabad', 'Islamabad', '44000', '2016-10-17 15:54:42', 6, '0000-00-00 00:00:00', 0, -1),
(8, '0051', 'APX ISLAMABAD', 'ABDULLAH KHAWAJA', '0515956608', '0515956607', '05159566', '03219889887', 'HOUSE # 271 MAIN JINNAH ROAD ', 'AIRPORT HOUSING SOCIETY ', 'PK', 'PUNJAB', 'ISLAMABAD', '44000', '2016-10-21 14:30:12', 6, '2016-10-28 09:28:47', 6, 1),
(9, '0432', 'APX SIALKOT', 'FAIZAN KHAN', '0524601603', '0524601602', '0524601602', '03212422565', 'MAIN PARIS ROAD ', 'OPISTE DHL ', 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-21 14:34:51', 6, '2016-10-22 05:06:24', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `apx_countries`
--

CREATE TABLE `apx_countries` (
  `country_id` int(5) NOT NULL,
  `countryCode` char(2) NOT NULL DEFAULT '',
  `countryName` varchar(45) NOT NULL DEFAULT '',
  `continentName` varchar(15) DEFAULT NULL,
  `lock` int(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `apx_countries`
--

INSERT INTO `apx_countries` (`country_id`, `countryCode`, `countryName`, `continentName`, `lock`) VALUES
(1, 'AD', 'Andorra', 'Europe', 1),
(2, 'AE', 'United Arab Emirates', 'Asia', 1),
(3, 'AF', 'Afghanistan', 'Asia', 1),
(4, 'AG', 'Antigua and Barbuda', 'North America', 1),
(5, 'AI', 'Anguilla', 'North America', 1),
(6, 'AL', 'Albania', 'Europe', 1),
(7, 'AM', 'Armenia', 'Asia', 1),
(8, 'AO', 'Angola', 'Africa', 1),
(9, 'AQ', 'Antarctica', 'Antarctica', 1),
(10, 'AR', 'Argentina', 'South America', 1),
(11, 'AS', 'American Samoa', 'Oceania', 1),
(12, 'AT', 'Austria', 'Europe', 1),
(13, 'AU', 'Australia', 'Oceania', 1),
(14, 'AW', 'Aruba', 'North America', 1),
(15, 'AX', 'Åland', 'Europe', 1),
(16, 'AZ', 'Azerbaijan', 'Asia', 1),
(17, 'BA', 'Bosnia and Herzegovina', 'Europe', 1),
(18, 'BB', 'Barbados', 'North America', 1),
(19, 'BD', 'Bangladesh', 'Asia', 1),
(20, 'BE', 'Belgium', 'Europe', 1),
(21, 'BF', 'Burkina Faso', 'Africa', 1),
(22, 'BG', 'Bulgaria', 'Europe', 1),
(23, 'BH', 'Bahrain', 'Asia', 1),
(24, 'BI', 'Burundi', 'Africa', 1),
(25, 'BJ', 'Benin', 'Africa', 1),
(26, 'BL', 'Saint Barthélemy', 'North America', 1),
(27, 'BM', 'Bermuda', 'North America', 1),
(28, 'BN', 'Brunei', 'Asia', 1),
(29, 'BO', 'Bolivia', 'South America', 1),
(30, 'BQ', 'Bonaire', 'North America', 1),
(31, 'BR', 'Brazil', 'South America', 1),
(32, 'BS', 'Bahamas', 'North America', 1),
(33, 'BT', 'Bhutan', 'Asia', 1),
(34, 'BV', 'Bouvet Island', 'Antarctica', 1),
(35, 'BW', 'Botswana', 'Africa', 1),
(36, 'BY', 'Belarus', 'Europe', 1),
(37, 'BZ', 'Belize', 'North America', 1),
(38, 'CA', 'Canada', 'North America', 1),
(39, 'CC', 'Cocos [Keeling] Islands', 'Asia', 1),
(40, 'CD', 'Democratic Republic of the Congo', 'Africa', 1),
(41, 'CF', 'Central African Republic', 'Africa', 1),
(42, 'CG', 'Republic of the Congo', 'Africa', 1),
(43, 'CH', 'Switzerland', 'Europe', 1),
(44, 'CI', 'Ivory Coast', 'Africa', 1),
(45, 'CK', 'Cook Islands', 'Oceania', 1),
(46, 'CL', 'Chile', 'South America', 1),
(47, 'CM', 'Cameroon', 'Africa', 1),
(48, 'CN', 'China', 'Asia', 1),
(49, 'CO', 'Colombia', 'South America', 1),
(50, 'CR', 'Costa Rica', 'North America', 1),
(51, 'CU', 'Cuba', 'North America', 1),
(52, 'CV', 'Cape Verde', 'Africa', 1),
(53, 'CW', 'Curacao', 'North America', 1),
(54, 'CX', 'Christmas Island', 'Asia', 1),
(55, 'CY', 'Cyprus', 'Europe', 1),
(56, 'CZ', 'Czechia', 'Europe', 1),
(57, 'DE', 'Germany', 'Europe', 1),
(58, 'DJ', 'Djibouti', 'Africa', 1),
(59, 'DK', 'Denmark', 'Europe', 1),
(60, 'DM', 'Dominica', 'North America', 1),
(61, 'DO', 'Dominican Republic', 'North America', 1),
(62, 'DZ', 'Algeria', 'Africa', 1),
(63, 'EC', 'Ecuador', 'South America', 1),
(64, 'EE', 'Estonia', 'Europe', 1),
(65, 'EG', 'Egypt', 'Africa', 1),
(66, 'EH', 'Western Sahara', 'Africa', 1),
(67, 'ER', 'Eritrea', 'Africa', 1),
(68, 'ES', 'Spain', 'Europe', 1),
(69, 'ET', 'Ethiopia', 'Africa', 1),
(70, 'FI', 'Finland', 'Europe', 1),
(71, 'FJ', 'Fiji', 'Oceania', 1),
(72, 'FK', 'Falkland Islands', 'South America', 1),
(73, 'FM', 'Micronesia', 'Oceania', 1),
(74, 'FO', 'Faroe Islands', 'Europe', 1),
(75, 'FR', 'France', 'Europe', 1),
(76, 'GA', 'Gabon', 'Africa', 1),
(77, 'GB', 'United Kingdom', 'Europe', 1),
(78, 'GD', 'Grenada', 'North America', 1),
(79, 'GE', 'Georgia', 'Asia', 1),
(80, 'GF', 'French Guiana', 'South America', 1),
(81, 'GG', 'Guernsey', 'Europe', 1),
(82, 'GH', 'Ghana', 'Africa', 1),
(83, 'GI', 'Gibraltar', 'Europe', 1),
(84, 'GL', 'Greenland', 'North America', 1),
(85, 'GM', 'Gambia', 'Africa', 1),
(86, 'GN', 'Guinea', 'Africa', 1),
(87, 'GP', 'Guadeloupe', 'North America', 1),
(88, 'GQ', 'Equatorial Guinea', 'Africa', 1),
(89, 'GR', 'Greece', 'Europe', 1),
(90, 'GS', 'South Georgia and the South Sandwich Islands', 'Antarctica', 1),
(91, 'GT', 'Guatemala', 'North America', 1),
(92, 'GU', 'Guam', 'Oceania', 1),
(93, 'GW', 'Guinea-Bissau', 'Africa', 1),
(94, 'GY', 'Guyana', 'South America', 1),
(95, 'HK', 'Hong Kong', 'Asia', 1),
(96, 'HM', 'Heard Island and McDonald Islands', 'Antarctica', 1),
(97, 'HN', 'Honduras', 'North America', 1),
(98, 'HR', 'Croatia', 'Europe', 1),
(99, 'HT', 'Haiti', 'North America', 1),
(100, 'HU', 'Hungary', 'Europe', 1),
(101, 'ID', 'Indonesia', 'Asia', 1),
(102, 'IE', 'Ireland', 'Europe', 1),
(103, 'IL', 'Israel', 'Asia', 1),
(104, 'IM', 'Isle of Man', 'Europe', 1),
(105, 'IN', 'India', 'Asia', 1),
(106, 'IO', 'British Indian Ocean Territory', 'Asia', 1),
(107, 'IQ', 'Iraq', 'Asia', 1),
(108, 'IR', 'Iran', 'Asia', 1),
(109, 'IS', 'Iceland', 'Europe', 1),
(110, 'IT', 'Italy', 'Europe', 1),
(111, 'JE', 'Jersey', 'Europe', 1),
(112, 'JM', 'Jamaica', 'North America', 1),
(113, 'JO', 'Jordan', 'Asia', 1),
(114, 'JP', 'Japan', 'Asia', 1),
(115, 'KE', 'Kenya', 'Africa', 1),
(116, 'KG', 'Kyrgyzstan', 'Asia', 1),
(117, 'KH', 'Cambodia', 'Asia', 1),
(118, 'KI', 'Kiribati', 'Oceania', 1),
(119, 'KM', 'Comoros', 'Africa', 1),
(120, 'KN', 'Saint Kitts and Nevis', 'North America', 1),
(121, 'KP', 'North Korea', 'Asia', 1),
(122, 'KR', 'South Korea', 'Asia', 1),
(123, 'KW', 'Kuwait', 'Asia', 1),
(124, 'KY', 'Cayman Islands', 'North America', 1),
(125, 'KZ', 'Kazakhstan', 'Asia', 1),
(126, 'LA', 'Laos', 'Asia', 1),
(127, 'LB', 'Lebanon', 'Asia', 1),
(128, 'LC', 'Saint Lucia', 'North America', 1),
(129, 'LI', 'Liechtenstein', 'Europe', 1),
(130, 'LK', 'Sri Lanka', 'Asia', 1),
(131, 'LR', 'Liberia', 'Africa', 1),
(132, 'LS', 'Lesotho', 'Africa', 1),
(133, 'LT', 'Lithuania', 'Europe', 1),
(134, 'LU', 'Luxembourg', 'Europe', 1),
(135, 'LV', 'Latvia', 'Europe', 1),
(136, 'LY', 'Libya', 'Africa', 1),
(137, 'MA', 'Morocco', 'Africa', 1),
(138, 'MC', 'Monaco', 'Europe', 1),
(139, 'MD', 'Moldova', 'Europe', 1),
(140, 'ME', 'Montenegro', 'Europe', 1),
(141, 'MF', 'Saint Martin', 'North America', 1),
(142, 'MG', 'Madagascar', 'Africa', 1),
(143, 'MH', 'Marshall Islands', 'Oceania', 1),
(144, 'MK', 'Macedonia', 'Europe', 1),
(145, 'ML', 'Mali', 'Africa', 1),
(146, 'MM', 'Myanmar [Burma]', 'Asia', 1),
(147, 'MN', 'Mongolia', 'Asia', 1),
(148, 'MO', 'Macao', 'Asia', 1),
(149, 'MP', 'Northern Mariana Islands', 'Oceania', 1),
(150, 'MQ', 'Martinique', 'North America', 1),
(151, 'MR', 'Mauritania', 'Africa', 1),
(152, 'MS', 'Montserrat', 'North America', 1),
(153, 'MT', 'Malta', 'Europe', 1),
(154, 'MU', 'Mauritius', 'Africa', 1),
(155, 'MV', 'Maldives', 'Asia', 1),
(156, 'MW', 'Malawi', 'Africa', 1),
(157, 'MX', 'Mexico', 'North America', 1),
(158, 'MY', 'Malaysia', 'Asia', 1),
(159, 'MZ', 'Mozambique', 'Africa', 1),
(160, 'NA', 'Namibia', 'Africa', 1),
(161, 'NC', 'New Caledonia', 'Oceania', 1),
(162, 'NE', 'Niger', 'Africa', 1),
(163, 'NF', 'Norfolk Island', 'Oceania', 1),
(164, 'NG', 'Nigeria', 'Africa', 1),
(165, 'NI', 'Nicaragua', 'North America', 1),
(166, 'NL', 'Netherlands', 'Europe', 1),
(167, 'NO', 'Norway', 'Europe', 1),
(168, 'NP', 'Nepal', 'Asia', 1),
(169, 'NR', 'Nauru', 'Oceania', 1),
(170, 'NU', 'Niue', 'Oceania', 1),
(171, 'NZ', 'New Zealand', 'Oceania', 1),
(172, 'OM', 'Oman', 'Asia', 1),
(173, 'PA', 'Panama', 'North America', 1),
(174, 'PE', 'Peru', 'South America', 1),
(175, 'PF', 'French Polynesia', 'Oceania', 1),
(176, 'PG', 'Papua New Guinea', 'Oceania', 1),
(177, 'PH', 'Philippines', 'Asia', 1),
(178, 'PK', 'Pakistan', 'Asia', 1),
(179, 'PL', 'Poland', 'Europe', 1),
(180, 'PM', 'Saint Pierre and Miquelon', 'North America', 1),
(181, 'PN', 'Pitcairn Islands', 'Oceania', 1),
(182, 'PR', 'Puerto Rico', 'North America', 1),
(183, 'PS', 'Palestine', 'Asia', 1),
(184, 'PT', 'Portugal', 'Europe', 1),
(185, 'PW', 'Palau', 'Oceania', 1),
(186, 'PY', 'Paraguay', 'South America', 1),
(187, 'QA', 'Qatar', 'Asia', 1),
(188, 'RE', 'Réunion', 'Africa', 1),
(189, 'RO', 'Romania', 'Europe', 1),
(190, 'RS', 'Serbia', 'Europe', 1),
(191, 'RU', 'Russia', 'Europe', 1),
(192, 'RW', 'Rwanda', 'Africa', 1),
(193, 'SA', 'Saudi Arabia', 'Asia', 1),
(194, 'SB', 'Solomon Islands', 'Oceania', 1),
(195, 'SC', 'Seychelles', 'Africa', 1),
(196, 'SD', 'Sudan', 'Africa', 1),
(197, 'SE', 'Sweden', 'Europe', 1),
(198, 'SG', 'Singapore', 'Asia', 1),
(199, 'SH', 'Saint Helena', 'Africa', 1),
(200, 'SI', 'Slovenia', 'Europe', 1),
(201, 'SJ', 'Svalbard and Jan Mayen', 'Europe', 1),
(202, 'SK', 'Slovakia', 'Europe', 1),
(203, 'SL', 'Sierra Leone', 'Africa', 1),
(204, 'SM', 'San Marino', 'Europe', 1),
(205, 'SN', 'Senegal', 'Africa', 1),
(206, 'SO', 'Somalia', 'Africa', 1),
(207, 'SR', 'Suriname', 'South America', 1),
(208, 'SS', 'South Sudan', 'Africa', 1),
(209, 'ST', 'São Tomé and Príncipe', 'Africa', 1),
(210, 'SV', 'El Salvador', 'North America', 1),
(211, 'SX', 'Sint Maarten', 'North America', 1),
(212, 'SY', 'Syria', 'Asia', 1),
(213, 'SZ', 'Swaziland', 'Africa', 1),
(214, 'TC', 'Turks and Caicos Islands', 'North America', 1),
(215, 'TD', 'Chad', 'Africa', 1),
(216, 'TF', 'French Southern Territories', 'Antarctica', 1),
(217, 'TG', 'Togo', 'Africa', 1),
(218, 'TH', 'Thailand', 'Asia', 1),
(219, 'TJ', 'Tajikistan', 'Asia', 1),
(220, 'TK', 'Tokelau', 'Oceania', 1),
(221, 'TL', 'East Timor', 'Oceania', 1),
(222, 'TM', 'Turkmenistan', 'Asia', 1),
(223, 'TN', 'Tunisia', 'Africa', 1),
(224, 'TO', 'Tonga', 'Oceania', 1),
(225, 'TR', 'Turkey', 'Asia', 1),
(226, 'TT', 'Trinidad and Tobago', 'North America', 1),
(227, 'TV', 'Tuvalu', 'Oceania', 1),
(228, 'TW', 'Taiwan', 'Asia', 1),
(229, 'TZ', 'Tanzania', 'Africa', 1),
(230, 'UA', 'Ukraine', 'Europe', 1),
(231, 'UG', 'Uganda', 'Africa', 1),
(232, 'UM', 'U.S. Minor Outlying Islands', 'Oceania', 1),
(233, 'US', 'United States', 'North America', 1),
(234, 'UY', 'Uruguay', 'South America', 1),
(235, 'UZ', 'Uzbekistan', 'Asia', 1),
(236, 'VA', 'Vatican City', 'Europe', 1),
(237, 'VC', 'Saint Vincent and the Grenadines', 'North America', 1),
(238, 'VE', 'Venezuela', 'South America', 1),
(239, 'VG', 'British Virgin Islands', 'North America', 1),
(240, 'VI', 'U.S. Virgin Islands', 'North America', 1),
(241, 'VN', 'Vietnam', 'Asia', 1),
(242, 'VU', 'Vanuatu', 'Oceania', 1),
(243, 'WF', 'Wallis and Futuna', 'Oceania', 1),
(244, 'WS', 'Samoa', 'Oceania', 1),
(245, 'XK', 'Kosovo', 'Europe', 1),
(246, 'YE', 'Yemen', 'Asia', 1),
(247, 'YT', 'Mayotte', 'Africa', 1),
(248, 'ZA', 'South Africa', 'Africa', 1),
(249, 'ZM', 'Zambia', 'Africa', 1),
(250, 'ZW', 'Zimbabwe', 'Africa', 1),
(253, 'CH', 'Channel Islands', 'Europe', 0),
(254, 'la', 'lance', 'Europe', 0),
(255, 'sa', 'Saeed', 'Asia', 0),
(256, 'AN', 'Antigua', 'North America', 0),
(257, 'CA', 'Canary Islands, The', 'Europe', 0),
(258, 'CO', 'Congo', 'Africa', 0),
(259, 'CO', 'Cote d''Ivoire', 'Africa', 0),
(260, 'CZ', 'Czech Republic, The', 'Europe', 0),
(261, 'DO', 'Dominican Republic', 'North America', 0),
(262, 'FG', 'French Guyana', 'South America', 0),
(263, 'GU', 'Guinea Republic', 'Africa', 0),
(264, 'GE', 'Guinea  Equatorial', 'Africa', 0),
(265, 'KD', 'Korea, The D.P.R of', 'Asia', 0),
(266, 'GU', 'Guinea-Equatorial', 'Africa', 0),
(267, 'KR', 'Korea, Republic Of', 'Asia', 0),
(268, 'KT', 'Korea, The D.P.R of', 'Asia', 0),
(269, 'LP', 'Lao People''s Democratic Republic', 'Asia', 0),
(270, 'KA', 'Macau', 'Asia', 0),
(271, 'NV', 'Nevis', 'North America', 0),
(272, 'RI', 'Reunion, Island', 'Africa', 0),
(273, 'SA', 'Saipan', 'North America', 0),
(274, 'ST', 'Sao Tome and Principe', 'Africa', 0),
(275, 'SR', 'Somaliland, Rep (North Somalia)', 'Africa', 0),
(276, 'SB', 'St. Barthelemy', 'North America', 0);

-- --------------------------------------------------------

--
-- Table structure for table `apx_customer`
--

CREATE TABLE `apx_customer` (
  `customer_id` int(11) NOT NULL,
  `accountNumber` int(11) NOT NULL,
  `accountType` enum('Cash','Credit') NOT NULL,
  `companyName` varchar(50) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(15) NOT NULL,
  `user_name` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `email2` varchar(25) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL,
  `mobileNumber1` varchar(15) NOT NULL,
  `mobileNumber2` varchar(15) NOT NULL,
  `contactPerson` varchar(30) NOT NULL,
  `addressLine1` varchar(100) NOT NULL,
  `addressLine2` varchar(100) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `countryCode` varchar(10) NOT NULL,
  `state` varchar(25) NOT NULL,
  `city` varchar(25) NOT NULL,
  `zipCode` varchar(15) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(4) NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_by` int(4) NOT NULL,
  `status` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apx_customer`
--

INSERT INTO `apx_customer` (`customer_id`, `accountNumber`, `accountType`, `companyName`, `firstName`, `lastName`, `user_name`, `email`, `email2`, `phone`, `password`, `mobileNumber1`, `mobileNumber2`, `contactPerson`, `addressLine1`, `addressLine2`, `branch_id`, `countryCode`, `state`, `city`, `zipCode`, `created_date`, `created_by`, `modified_date`, `modified_by`, `status`) VALUES
(2, 441234, 'Cash', 'Courier Company 1', 'ABC', 'XYZ', 'abcxyz', 'xyz@apxintl.co.uk', 'xyz2@gmail.com', '00442081237919', 'e10adc3949ba59abbe56e057f20f883e', '00442081237919', '', 'Zack Fiturber', '1293 strre 5 sect4', '', 6, 'GB', 'London', 'London', 'UB2 4JR', '2016-10-17 15:59:26', 6, '0000-00-00 00:00:00', 0, -1),
(3, 4412342, 'Credit', 'Natural Herbs', 'APX', 'Ops', 'abcxyz', 'hsdh@apxintl.co.uk', 'zackds@apxintl.co.uk', '354301069508559', 'e10adc3949ba59abbe56e057f20f883e', '00442081237919', '', 'Zack Fiturber', '28 sheraton busness Centre', 'Essex', 6, 'GB', 'London', 'London', 'UB2 4JR', '2016-10-17 16:11:11', 6, '2016-10-20 10:35:45', 6, -1),
(4, 4001, 'Credit', 'TANGO TRADING', 'XYZ', 'ABC ', 'TANGO', 'tangotrading@gmail.com', 'tangotrading@gmail.com', '03338636704', 'e10adc3949ba59abbe56e057f20f883e', '03338636704', '03338636704', 'ABCXYZ', 'SIALKOT', 'MAIN SIALKOT ', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-21 14:43:05', 6, '2016-10-21 14:48:00', 6, 1),
(5, 4002, 'Credit', 'SELECT COURIER', 'ABC', 'XYZ', 'SELECT COURIER', 'mir333888@hotmail.com', 'INFO@sclectcourier.net', '03217132243', 'e10adc3949ba59abbe56e057f20f883e', '03217132243', '0524592243', 'ABCXYZ', 'SIALKOT ', 'MAIN SIALKOT ', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-21 14:55:12', 6, '2016-10-21 14:55:35', 6, 1),
(6, 4003, 'Credit', 'COURIER LINE', 'MUREED HUSSAIN', 'HUSSAIN ', 'COURIER LINE', 'clxskt@gmail.com', 'clxskt@gmail.com', '0524580626', 'e10adc3949ba59abbe56e057f20f883e', '03216147710', '0524591420', 'MUREED HUSSAIN ', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-21 14:57:25', 6, '2016-10-21 14:58:46', 6, 1),
(7, 4004, 'Credit', 'EXCELLENT COURIER', 'MUHAMMAD RASHEED', 'MUHAMMAD ', 'RASHEED', 'rasheed@excellent.com.pk', 'rasheed@excellent.com.pk', ' 03216123433', 'e10adc3949ba59abbe56e057f20f883e', '03006123433 ', '0523563432', 'RASHEED ', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-21 15:01:23', 6, '0000-00-00 00:00:00', 0, 1),
(8, 4005, 'Credit', 'AIRMAX', 'ZAHID', 'AIRMAX', 'ZAHID', 'airmaxcourier@gmail.com', 'airmaxcourier@gmail.com', '0300-6109948', 'e10adc3949ba59abbe56e057f20f883e', '0300-6109948', '0300-6109948', 'ZAHID', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-21 15:03:38', 6, '0000-00-00 00:00:00', 0, 1),
(9, 4006, 'Credit', 'SWIFT COURIER', 'HAMAD', 'FAHAD ', 'SWIFT COURIER', 'superswiftcourier@gmail.c', 'superswiftcourier@gmail.c', '03338780671', 'e10adc3949ba59abbe56e057f20f883e', '03338780671', '03338780671', 'HAMAD ', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-21 15:06:34', 6, '0000-00-00 00:00:00', 0, 1),
(10, 4007, 'Credit', 'FAST & FINE', 'NAEEM', 'NAEEM ', 'FAST & FINE', 'scadept@fastandfinecargao', 'scadept@fastandfinecargao', '0343-6792221', 'e10adc3949ba59abbe56e057f20f883e', '0343-6792221', '0343-6792221', 'NAEEM', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-21 15:10:55', 6, '2016-10-21 15:11:14', 6, 1),
(11, 4008, 'Credit', 'PDHS', 'FAROOQ BUT', 'FAROOQ BUT ', 'PDHS', 'shahzad_butt32@yahoo.com ', 'shahzad_butt32@yahoo.com ', '0300-9617929', 'e10adc3949ba59abbe56e057f20f883e', '0300-9617929', '0300-9617929', 'FAROOQ BUT ', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-21 15:15:06', 6, '0000-00-00 00:00:00', 0, 1),
(12, 4009, 'Credit', 'RKF', 'MUHAMMA FAIZ', 'FAIZ', 'RKF', 'rkfexpress@gmail.com', 'rkfexpress@gmail.com', '312 9617929', 'e10adc3949ba59abbe56e057f20f883e', ' 03059617929', '03009617929', 'FAIZ', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-21 15:17:39', 6, '0000-00-00 00:00:00', 0, 1),
(13, 4010, 'Credit', 'TRACHTEN GARMENTS', 'TRACHTEN GARMENTS', 'TRACHTEN GARMEN', 'TRACHTEN GARMENTS', 'info@trachtengarments.com', 'info@trachtengarments.com', '033448006081', 'e10adc3949ba59abbe56e057f20f883e', '033448006081', '033448006081', 'TRACHTEN GARMENTS', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-21 15:31:59', 6, '0000-00-00 00:00:00', 0, 1),
(14, 4011, 'Credit', 'HOPE COURIER', 'HOPE COURIER', 'HOPE COURIER', 'HOPE COURIER', 'adreeskhan456@gmail.com', 'adreeskhan456@gmail.com', '0321-6115323', 'e10adc3949ba59abbe56e057f20f883e', '03216115323', '03216115323', 'HOPE COURIER ', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-21 15:35:41', 6, '0000-00-00 00:00:00', 0, 1),
(15, 4012, 'Credit', 'MEC', 'MEC', 'MEC ', 'MEC', 'mecskt@gmail.com', 'mecskt@gmail.com', '03006102462', 'e10adc3949ba59abbe56e057f20f883e', '03006102462', '03006102462', 'MEC', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-21 15:37:46', 6, '0000-00-00 00:00:00', 0, 1),
(16, 4013, 'Credit', 'AMEER HAMZA', 'AMEER HAMZA', 'AMEER HAMZA ', 'AMEER HAMZA', 'ameer.hamzzaa@gmail.com', 'ameer.hamzzaa@gmail.com', '03218710608', 'e10adc3949ba59abbe56e057f20f883e', '03218710608', '03218710608', 'AMEER HAMZA ', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-21 15:39:29', 6, '0000-00-00 00:00:00', 0, 1),
(17, 4014, 'Credit', 'ACS', 'MIAN IRFAN', 'MIAN IRFAN', 'ACS', 'acs.intl221@gmail.com', 'acs.intl221@gmail.com', '0321-6101207', 'e10adc3949ba59abbe56e057f20f883e', '0321-6101207', '0321-6101207', 'MAIN IRFAN', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-24 12:37:05', 6, '0000-00-00 00:00:00', 0, 1),
(18, 4016, 'Credit', 'GULBERG FASHION', 'GULBERG FASHION', 'GULBERG FASHION', 'GULBERG FASHION', 'gulbergfashion@yahoo.com', 'gulbergfashion@yahoo.com', '0524590828', 'e10adc3949ba59abbe56e057f20f883e', '0524586348', '0524586348', 'GULBERG FASHION', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-24 13:07:10', 6, '0000-00-00 00:00:00', 0, 1),
(19, 4017, 'Credit', 'KALEEM', 'KALEEM', 'KALEEM', 'KALEEM', 'FASTHAWK4@gmail.com', 'FASTHAWK4@gmail.com', '3007125100', 'e10adc3949ba59abbe56e057f20f883e', '3007125100', '3007125100', 'KALEEM', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-24 13:22:10', 6, '0000-00-00 00:00:00', 0, 1),
(20, 4018, 'Credit', 'UNIQUE GYM', 'UNIQUE GYM', 'UNIQUE GYM', 'UNIQUE GYM', 'uniquegymwear@gmail.com', 'uniquegymwear@gmail.com', '3063227149', 'e10adc3949ba59abbe56e057f20f883e', '3063227149', '3063227149', 'UNIQUE GYM', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-24 13:25:47', 6, '0000-00-00 00:00:00', 0, 1),
(21, 4019, 'Credit', 'SPEED WELL', 'SPEED WELL', 'SPEED WELL', 'SPEED WELL', 'speedwell.skt@gmail.com', 'speedwell.skt@gmail.com', '0300-7541635', 'e10adc3949ba59abbe56e057f20f883e', '0300-7541635', '0300-7541635', 'SPEED WELL ', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-24 13:28:08', 6, '0000-00-00 00:00:00', 0, 1),
(22, 4020, 'Credit', 'AYMAN IMPEX', 'AYMAN IMPEX', 'AYMAN IMPEX ', 'AYMAN IMPEX', 'aymansoccer@gmail.com', 'aymansoccer@gmail.com', '3086156799', 'e10adc3949ba59abbe56e057f20f883e', '3086156799', '3086156799', 'AYMAN IMPEX ', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-24 13:29:48', 6, '0000-00-00 00:00:00', 0, 1),
(23, 4021, 'Credit', 'BILAL', 'BILAL', 'BILAL ', 'BILAL', 'sales.apx@outlook.com', 'hafizmuhammadbilal@msn.co', '', 'e10adc3949ba59abbe56e057f20f883e', '3008404421', '3008404421', 'BILAL', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-24 13:32:09', 6, '0000-00-00 00:00:00', 0, 1),
(24, 4022, 'Credit', 'WINNERS INTL', 'WINNERS INTL', 'WINNERS INTL', 'WINNERS INTL', 'info@winnersin.com', 'info@winnersin.com', '3009619253', 'e10adc3949ba59abbe56e057f20f883e', '3009619253', '3009619253', 'WINNERS INTL ', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-24 13:33:49', 6, '0000-00-00 00:00:00', 0, 1),
(25, 4023, 'Credit', 'MOTO SPORTS', 'MOTO SPORTS', 'MOTO SPORTS ', 'MOTO SPORTS', 'ceoduma@gmail.com', 'ceoduma@gmail.com', '3348101985', 'e10adc3949ba59abbe56e057f20f883e', '3348101985', '3348101985', 'MOTO SPORTS ', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-24 13:35:16', 6, '0000-00-00 00:00:00', 0, 1),
(26, 4024, 'Credit', 'NAVEED ISHAQ', 'NAVEED ISHAQ', 'NAVEED ISHAQ ', 'NAVEED ISHAQ', 'hamsteadintl@gmail.com', 'hamsteadintl@gmail.com', '3006136259', 'e10adc3949ba59abbe56e057f20f883e', '3006136259', '3006136259', 'NAVEED ISHAQ ', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-25 13:20:49', 6, '0000-00-00 00:00:00', 0, 1),
(27, 4025, 'Credit', 'MIAN IRFAN', 'MIAN IRFAN', 'MIAN IRFAN', 'MIAN IRFAN', 'mirfanapxintl.skt@gmail.c', 'mirfanapxintl.skt@gmail.c', '0307-6147473', 'e10adc3949ba59abbe56e057f20f883e', '0322-7344868', '0322-7344868', 'MIAN IRFAN', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-25 13:25:14', 6, '0000-00-00 00:00:00', 0, 1),
(28, 4026, 'Credit', 'MEHBOOB ACS', 'MEHBOOB ACS', 'MEHBOOB ACS', 'MEHBOOB ACS', 'caredeliverycompany@gmail', 'caredeliverycompany@gmail', '03008515888', 'e10adc3949ba59abbe56e057f20f883e', '03008515888', '03008515888', 'MEHBOOB ACS ', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-25 13:27:43', 6, '0000-00-00 00:00:00', 0, 1),
(29, 4027, 'Credit', 'IMRAN DASKA', 'IMRAN DASKA', 'IMRAN DASKA', 'IMRAN DASKA', 'imranvesco@gmail.com', 'imranvesco@gmail.com', '03006464270', 'e10adc3949ba59abbe56e057f20f883e', '03006464270', '03006464270', 'IMRAN DASKA ', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-25 13:29:35', 6, '0000-00-00 00:00:00', 0, 1),
(30, 4028, 'Credit', 'ALI QUALITY', 'ALI QUALITY', 'ALI QUALITY', 'ALI QUALITY', 'aliqualityind@gmail.com', 'aliqualityind@gmail.com', '03466553340', 'e10adc3949ba59abbe56e057f20f883e', '03466553340', '03466553340', 'ALI QUALITY ', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-25 13:30:53', 6, '0000-00-00 00:00:00', 0, 1),
(31, 4029, 'Credit', 'BOBBIN', 'BOBBIN', 'BOBBIN ', 'BOBBIN', ' afzalapx@gmail.com', ' afzalapx@gmail.com', '03016363363', 'e10adc3949ba59abbe56e057f20f883e', '03016363363', '03016363363', 'BOBBIN', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-25 13:32:38', 6, '0000-00-00 00:00:00', 0, 1),
(32, 4030, 'Credit', 'HAMMAD SHAH', 'HAMMAD SHAH', 'HAMMAD SHAH', 'HAMMAD SHAH', '000', '0000', '03317591212', 'e10adc3949ba59abbe56e057f20f883e', '03216179730', '03216179730', 'HAMMAD SHAH', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-25 13:34:14', 6, '0000-00-00 00:00:00', 0, 1),
(33, 4031, 'Credit', 'ARMOUR ARENA', 'ARMOUR ARENA', 'ARMOUR ARENA', 'ARMOUR ARENA', 'armorarena@gmail.com', 'armorarena@gmail.com', '03216161715', 'e10adc3949ba59abbe56e057f20f883e', '03447111444', '03447111444', 'ARMOUR AREANA', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-25 13:35:35', 6, '0000-00-00 00:00:00', 0, 1),
(34, 4032, 'Credit', 'MIAN IRFAN', 'MIAN IRFAN', 'MIAN IRFAN ', 'MIAN IRFAN', 'mirfanapxintl.skt@gmail.c', 'mirfanapxintl.skt@gmail.c', '0307-6147473', 'e10adc3949ba59abbe56e057f20f883e', '0322-7344868', '0322-7344868', 'MIAN IRFAN ', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-25 13:37:06', 6, '0000-00-00 00:00:00', 0, 1),
(35, 4033, 'Credit', 'MEGA SPORTS', 'MEGA SPORTS', 'MEGA SPORTS', 'MEGA SPORTS', 'megapaintballintl@gmail.c', 'megapaintballintl@gmail.c', '03216143887', 'e10adc3949ba59abbe56e057f20f883e', '03216143887', '03216143887', 'MEGA SPORTS', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-25 13:38:55', 6, '0000-00-00 00:00:00', 0, 1),
(36, 4034, 'Credit', 'MEX WORLD WIDE', 'MEX WORLD WIDE', 'MEX WORLD WIDE', 'MEX WORLD WIDE', 'mubashir@mexworldwide.pk', 'mubashir@mexworldwide.pk', '03004615408', 'e10adc3949ba59abbe56e057f20f883e', '03004615408', '03004615408', 'MEX WORLD WIDE', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-25 13:41:59', 6, '0000-00-00 00:00:00', 0, 1),
(37, 4035, 'Credit', 'MARAFIE UNITED', 'MARAFIE UNITED', 'MARAFIE UNITED ', 'MARAFIE UNITED', 'marfie.united@gmail.com', 'marfie.united@gmail.com', '03367121947', 'e10adc3949ba59abbe56e057f20f883e', '03367121947', '03367121947', 'MARAFIE UNITED', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-26 05:53:25', 6, '0000-00-00 00:00:00', 0, 1),
(38, 4036, 'Credit', 'PACK& SHIP', 'PACK& SHIP', 'PACK& SHIP', 'PACK& SHIP', 'packnship7@gmail.com', 'packnship7@gmail.com', '03338686890', 'e10adc3949ba59abbe56e057f20f883e', '03338686890', '03338686890', 'PACK & SHIP', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-26 05:57:41', 6, '0000-00-00 00:00:00', 0, 1),
(39, 4037, 'Credit', 'NEW USMAN CHEEMA FED & DHL', 'NEW USMAN CHEEMA FED & DHL', 'NEW USMAN CHEEM', 'NEW USMAN CHEEMA FED & DH', ' manager.tpu@hotmail.com', 'courier.xpert@gmail.com', '03446458881', 'e10adc3949ba59abbe56e057f20f883e', '03446458881', '03446458881', 'NEW USMAN CHEEMA FED & DHL', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-26 11:38:46', 6, '0000-00-00 00:00:00', 0, 1),
(40, 4038, 'Credit', 'SPIKY INT', 'SPIKY INT', 'SPIKY INT ', 'SPIKY INT', ' info@spikysport.com', 'spikysports@gmail.com', '03009619097', 'e10adc3949ba59abbe56e057f20f883e', '03009619097', '03009619097', 'SPIKY INT ', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-26 11:40:30', 6, '0000-00-00 00:00:00', 0, 1),
(41, 4039, 'Credit', 'HAFIZ NASIR', 'HAFIZ NASIR', 'HAFIZ NASIR ', 'HAFIZ NASIR', 'hafiznasirali91@gmail.com', 'hafiznasirali91@gmail.com', '03476085136', 'e10adc3949ba59abbe56e057f20f883e', '03476085136', '03476085136', 'HAFIZ NASIR ', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-26 11:41:50', 6, '0000-00-00 00:00:00', 0, 1),
(42, 4041, 'Credit', 'GROTTO INTL', 'GROTTO INTL', 'GROTTO INTL', 'GROTTO INTL', '000', '0000', '0092-334-170777', 'e10adc3949ba59abbe56e057f20f883e', '0092-3551516', '0092-3551516', 'GROTTO INTL', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-26 11:45:42', 6, '0000-00-00 00:00:00', 0, 1),
(43, 4042, 'Credit', 'WELL STUFF', 'WELL STUFF', 'WELL STUFF', 'WELL STUFF', ' afzalapx@gmail.com', ' afzalapx@gmail.com', ' 0301-6363363', 'e10adc3949ba59abbe56e057f20f883e', ' 0301-6363363', ' 0301-6363363', 'WELL STUFF', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-26 11:47:08', 6, '0000-00-00 00:00:00', 0, 1),
(44, 4043, 'Credit', 'WAQAS CHEEMA', 'WAQAS CHEEMA', 'WAQAS CHEEMA', 'WAQAS CHEEMA', 'waqashassan265@gmail.com', 'waqashassan265@gmail.com', '0300-6420162', 'e10adc3949ba59abbe56e057f20f883e', '0300-6420162', '0300-6420162', 'WAQAS CHEEMA', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-26 11:48:50', 6, '0000-00-00 00:00:00', 0, 1),
(45, 4040, 'Credit', 'QN ENTERPRISES', 'QN ENTERPRISES', 'QN ENTERPRISES', 'QN ENTERPRISES', 'smackboxing@yahoo.com', 'smackboxing@yahoo.com', '0333-3253379', 'e10adc3949ba59abbe56e057f20f883e', '0333-3253379', '0333-3253379', 'QN ENTERPRISES', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-26 11:50:44', 6, '0000-00-00 00:00:00', 0, 1),
(46, 4044, 'Credit', 'RABEEL RRS', 'RABEEL RRS', ' RABEEL RRS', 'RABEEL RRS', '000', '000', '0345-9265551', 'c6f057b86584942e415435ffb1fa93d4', '0345-9265551', '0345-9265551', 'RABEEL RRS', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-26 11:52:31', 6, '0000-00-00 00:00:00', 0, 1),
(47, 4045, 'Credit', 'SWIFT SPORTS', 'SWIFT SPORTS', 'SWIFT SPORTS ', 'SWIFT SPORTS', '  yasir@swiftsports.com.p', '  yasir@swiftsports.com.p', '0313 3363737', 'e10adc3949ba59abbe56e057f20f883e', '0092524592303', ' 0092524598034', 'SWIFT SPORTS ', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-26 11:54:14', 6, '0000-00-00 00:00:00', 0, 1),
(48, 4046, 'Credit', 'Shaheen - E - Millat', 'Shaheen - E - Millat', 'Shaheen - E - M', 'Shaheen - E - Millat', ' afzalapx@gmail.com', ' afzalapx@gmail.com', ' 0301-6363363', 'e10adc3949ba59abbe56e057f20f883e', '03016363363', '03016363363', 'SHAHEEN E MILLAT', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-26 11:56:58', 6, '0000-00-00 00:00:00', 0, 1),
(49, 4047, 'Credit', 'MRS SALEH SADDIQUE', 'MRS SALEH SADDIQUE', 'MRS SALEH SADDI', 'MRS SALEH SADDIQUE', 'salehasiddiqui97@gmail.co', 'salehasiddiqui97@gmail.co', '001-15125861947', 'e10adc3949ba59abbe56e057f20f883e', '001-1525861947', '001-1525861947', 'MRS SALEH SADDIQUE ', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-26 11:58:33', 6, '0000-00-00 00:00:00', 0, 1),
(50, 4048, 'Credit', 'ASR LOGISTIC', 'ASR LOGISTIC', 'ASR LOGISTIC', 'ASR LOGISTIC', 'arqureshi30@yahoo.com', 'info@asrlogistics.com', '052-3247711', 'e10adc3949ba59abbe56e057f20f883e', ' 052-3572072', ' 052-3572072', 'ASR LOGISTIC', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-26 12:00:10', 6, '0000-00-00 00:00:00', 0, 1),
(51, 4050, 'Credit', 'FAWAD SKT', 'FAWAD SKT', 'FAWAD SKT', 'FAWAD SKT', '000', '000', '0331-6698782', 'c6f057b86584942e415435ffb1fa93d4', '0331-6698782', '0331-6698782', ' FAWAD SKT ', '0331-6698782', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-26 12:03:41', 6, '0000-00-00 00:00:00', 0, 1),
(52, 4051, 'Credit', 'EURO CLUB', 'EURO CLUB', 'EURO CLUB', 'EURO CLUB', '000', '000', '0345-5313100', 'c6f057b86584942e415435ffb1fa93d4', '0345-5313100', '0345-5313100', 'EURO CLUB ', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-27 10:06:34', 6, '0000-00-00 00:00:00', 0, 1),
(53, 4052, 'Credit', 'HASSAN ASKRI BANK', 'HASSAN ASKRI BANK', 'HASSAN ASKRI BA', 'HASSAN ASKRI BANK', '000', '000', '000', 'c6f057b86584942e415435ffb1fa93d4', '000', '000', 'HASSAN ASKRI BANK ', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-27 10:07:44', 6, '0000-00-00 00:00:00', 0, 1),
(54, 4053, 'Credit', 'TARIQ MEHMOD', 'TARIQ MEHMOD', 'TARIQ MEHMOD', 'TARIQ MEHMOD', '000', '000', '0303-4693924', 'c6f057b86584942e415435ffb1fa93d4', '0303-4693924', '0303-4693924', 'TARIQ MEHMOOD', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-27 10:09:14', 6, '0000-00-00 00:00:00', 0, 1),
(55, 4054, 'Credit', 'ALI IMRAN BUTT', 'ALI IMRAN BUTT', 'ALI IMRAN BUTT', 'ALI IMRAN BUTT', 'citi.express1@gmail.com', 'citi.express1@gmail.com', '03066669634', 'e10adc3949ba59abbe56e057f20f883e', '03317166773', '03317166773', 'ALI IMRAN BUTT', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-27 10:10:35', 6, '0000-00-00 00:00:00', 0, 1),
(56, 4055, 'Credit', 'SHILLS INT NEW ACCOUNT', 'SHILLS INT NEW ACCOUNT', 'SHILLS INT NEW ', 'SHILLS INT NEW ACCOUNT', '000', '000', '0300-6107384', 'c6f057b86584942e415435ffb1fa93d4', '0300-6107384', '0300-6107384', 'SHILLS INT NEW ACCOUNT', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-27 10:12:11', 6, '0000-00-00 00:00:00', 0, 1),
(57, 4056, 'Credit', 'ARDOUR CRAFTS', 'ARDOUR CRAFTS', 'ARDOUR CRAFTS', 'ARDOUR CRAFTS', '000', '000', '052-3577377', 'c6f057b86584942e415435ffb1fa93d4', '052-3577377', '0344-444406', 'ARDOUR CARAFTS ', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-27 10:13:45', 6, '0000-00-00 00:00:00', 0, 1),
(58, 4057, 'Credit', 'LAS VEGAS', 'LAS VEGASQ', 'LAS VEGAS', 'LAS VEGAS', '000', '000', '0300-6191080', 'c6f057b86584942e415435ffb1fa93d4', '0300-3776199', '0300-3776199', 'LAS VEGAS ', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-27 10:15:16', 6, '0000-00-00 00:00:00', 0, 1),
(59, 4058, 'Credit', 'GOLD TOUCH', 'GOLD TOUCH', 'GOLD TOUCH', 'GOLD TOUCH', '000', '000', '0334-8058082', 'c6f057b86584942e415435ffb1fa93d4', '0334-8058082', '0334-8058082', 'GOLD TOUCH', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-27 10:16:40', 6, '0000-00-00 00:00:00', 0, 1),
(60, 4059, 'Credit', 'AL ZERQI INTERNATIONAL', 'AL ZERQI INTERNATIONAL', 'AL ZERQI INTERN', 'AL ZERQI INTERNATIONAL', '000', '000', '0321-6184134', 'c6f057b86584942e415435ffb1fa93d4', '0321-6184134', '0321-6184134', 'AL ZERQI INTERNATIONAL', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-27 10:17:45', 6, '0000-00-00 00:00:00', 0, 1),
(61, 4060, 'Credit', 'B4U IMPEX', 'B4U IMPEX', 'B4U IMPEX', 'B4U IMPEX', '000', '000', '0300-6169106', 'c6f057b86584942e415435ffb1fa93d4', '0300-6169106', '0300-6169106', 'B4U IMPEX', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-27 10:20:43', 6, '0000-00-00 00:00:00', 0, 1),
(62, 4061, 'Credit', 'MICRO INT', 'MICRO INT', 'MICRO INT', 'MICRO INT', '000', '000', '052-3250455', 'c6f057b86584942e415435ffb1fa93d4', '0300-6156941', '0300-6156941', 'MICRO INT ', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-27 10:22:38', 6, '0000-00-00 00:00:00', 0, 1),
(63, 4062, 'Credit', 'EAGLE VEW NEW ACCOUNT', 'EAGLE VEW NEW ACCOUNT', 'EAGLE VEW NEW A', 'EAGLE VEW NEW ACCOUNT', '000', '000', '0321-610030', 'c6f057b86584942e415435ffb1fa93d4', '0321-610030', '0321-610030', 'EAGLE VEW NEW ACCOUNT', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-27 10:25:43', 6, '0000-00-00 00:00:00', 0, 1),
(64, 4063, 'Credit', 'KUKET SURGICAL', 'KUKET SURGICAL', 'KUKET SURGICAL', 'KUKET SURGICAL', '000', '000', '0321-6151850', 'c6f057b86584942e415435ffb1fa93d4', '0321-6151850', '0321-6151850', 'KUKET SURGICAL ', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-27 10:27:39', 6, '0000-00-00 00:00:00', 0, 1),
(65, 4064, 'Credit', 'SKINER SPORTS', 'SKINER SPORTS', 'SKINER SPORTS', 'SKINER SPORTS', '000', '000', '0305-8611316', 'c6f057b86584942e415435ffb1fa93d4', '0305-8611316', '0305-8611316', 'SKINER SPORTS ', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-27 11:16:48', 6, '0000-00-00 00:00:00', 0, 1),
(66, 4066, 'Credit', 'LIEM IND', 'LIEM IND', 'LIEM IND', 'LIEM IND', '000', '000', '0333-8615196', 'c6f057b86584942e415435ffb1fa93d4', '0333-8615196', '0333-8615196', 'LIEM IND', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-27 11:18:31', 6, '0000-00-00 00:00:00', 0, 1),
(67, 4067, 'Credit', 'SUBMISSION ENTP', 'SUBMISSION ENTP', 'SUBMISSION ENTP', 'SUBMISSION ENTP', '000', '00000', ' 0324-6104002', 'c6f057b86584942e415435ffb1fa93d4', ' 0324-6104002', ' 0324-6104002', 'SUBMISSION ENTP', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-27 11:20:29', 6, '0000-00-00 00:00:00', 0, 1),
(68, 4068, 'Credit', 'SINGLE STAR', 'SINGLE STAR', 'SINGLE STAR', 'SINGLE STAR', ' INFO@SS-TRADER.COM', 'UMAIR@SS-TRADER.COM', '0321-6154265', 'e10adc3949ba59abbe56e057f20f883e', '052-4591208', '052-4591208', 'SINGLE STAR ', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-27 11:24:19', 6, '0000-00-00 00:00:00', 0, 1),
(69, 4069, 'Credit', 'RIZWAN SALMAN', 'RIZWAN SALMAN', 'RIZWAN SALMAN', 'RIZWAN SALMAN', '000', '000', ' 0334-4559105', 'c6f057b86584942e415435ffb1fa93d4', ' 0334-4559105', ' 0334-4559105', 'RIZWAN SALMAN', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-27 12:26:52', 6, '0000-00-00 00:00:00', 0, 1),
(70, 4070, 'Credit', 'OMAX INTL', 'OMAX INTL', 'OMAX INTL', 'OMAX INTL', '000', '000', ' 0346-6673705', 'c6f057b86584942e415435ffb1fa93d4', ' 0346-6673705', ' 0346-6673705', 'OMAX INTL', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-27 12:28:12', 6, '0000-00-00 00:00:00', 0, 1),
(71, 4071, 'Credit', 'SH EAGLET', 'SH EAGLET', 'SH EAGLET', 'SH EAGLET', '000', '000', ' 0333-8648541', 'c6f057b86584942e415435ffb1fa93d4', ' 0333-8648541', ' 0333-8648541', 'SH EAGLET', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-27 12:29:31', 6, '0000-00-00 00:00:00', 0, 1),
(72, 4072, 'Credit', 'PINE IMPEX', 'PINE IMPEX', 'PINE IMPEX', 'PINE IMPEX', '000', '000', '0525567415', 'c6f057b86584942e415435ffb1fa93d4', ' 052-4595233', ' 052-4595233', 'PINE IMPEX ', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-27 12:31:01', 6, '0000-00-00 00:00:00', 0, 1),
(73, 4073, 'Credit', 'RUHMA IMPEX', 'RUHMA IMPEX', 'RUHMA IMPEX', 'RUHMA IMPEX', '000', '000', '0321-7126427', 'c6f057b86584942e415435ffb1fa93d4', '0321-7126427', '0321-7126427', 'RUHMA IMPEX ', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-27 12:32:51', 6, '0000-00-00 00:00:00', 0, 1),
(74, 4074, 'Credit', 'GOLF & SPORTS', 'GOLF & SPORTS', 'GOLF & SPORTS', 'GOLF & SPORTS', '000', '000', '000', 'c6f057b86584942e415435ffb1fa93d4', '0333-8663977', '0333-8663977', 'GOLG & SPORTS ', 'SIALKOT', 'MAIN SIALKOT', 8, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-27 12:34:29', 6, '0000-00-00 00:00:00', 0, 1),
(75, 4075, 'Credit', ' Rafay Industries', ' Rafay Industries', ' Rafay Industri', ' Rafay Industries', '000', '000', '0321-6183333.', 'c6f057b86584942e415435ffb1fa93d4', '0321-6183333.', '0321-6183333.', 'RAFAY INDUSTRIES ', '', '', 9, 'PK', '', '', '', '2016-10-27 12:37:36', 6, '0000-00-00 00:00:00', 0, 1),
(76, 4076, 'Credit', 'NAUROZ SPORTS', 'NAUROZ SPORTS', 'NAUROZ SPORTS', 'NAUROZ SPORTS', '000', '000', '0331-6120342', 'c6f057b86584942e415435ffb1fa93d4', '0331-6120342', '0331-6120342', 'NAUROZ SPORTS ', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-28 08:25:42', 6, '0000-00-00 00:00:00', 0, 1),
(77, 4077, 'Credit', 'PAK ASIA MANUFACTURING', 'PAK ASIA MANUFACTURING', 'PAK ASIA MANUFA', 'PAK ASIA MANUFACTURING', '000', '000', '0523300250', 'c6f057b86584942e415435ffb1fa93d4', '0524588896', '0524588896', 'PAK ASIA MANUFACTURING', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-28 08:27:32', 6, '0000-00-00 00:00:00', 0, 1),
(78, 4079, 'Credit', 'OMER NASIR', 'OMER NASIR', 'OMER NASIR', 'OMER NASIR', '000', '000', '0300-6143460', 'c6f057b86584942e415435ffb1fa93d4', '0300-6143460', '0300-6143460', 'OMER NASIR', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-28 08:42:34', 6, '0000-00-00 00:00:00', 0, 1),
(79, 4080, 'Credit', 'DFN GROUP', 'DFN GROUP', 'DFN GROUP', 'DFN GROUP', '000', '000', '03338657622', 'c6f057b86584942e415435ffb1fa93d4', '03338657622', '03338657622', 'DFN GROUP', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-28 09:21:28', 6, '0000-00-00 00:00:00', 0, 1),
(80, 4081, 'Credit', 'SIMAC LEATHER', 'SIMAC LEATHER', 'SIMAC LEATHER', 'SIMAC LEATHER', '000', '000', '0300-8611392', 'c6f057b86584942e415435ffb1fa93d4', '0300-8611392', '0300-8611392', 'SIMAC LEATHER', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-28 09:22:38', 6, '0000-00-00 00:00:00', 0, 1),
(81, 4082, 'Credit', 'SAEED GUJRANWALA', 'SAEED GUJRANWALA', 'SAEED GUJRANWAL', 'SAEED GUJRANWALA', '000', '000', ' 0321-9368166', 'c6f057b86584942e415435ffb1fa93d4', ' 0321-9368166', ' 0321-9368166', 'SAEED GUJRANWALA', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-28 09:24:37', 6, '0000-00-00 00:00:00', 0, 1),
(82, 4083, 'Credit', 'SWAZ INT', 'SWAZ INT', 'SWAZ INT', 'SWAZ INT', '000', '000', '0321-6696726', 'c6f057b86584942e415435ffb1fa93d4', '0321-6696726', '0321-6696726', 'SWAZ INT', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-28 09:26:33', 6, '0000-00-00 00:00:00', 0, 1),
(83, 4084, 'Credit', 'STRIVE SPORTS', 'STRIVE SPORTS', 'STRIVE SPORTS', 'STRIVE SPORTS', '000', '000', '0300-0650103', 'c6f057b86584942e415435ffb1fa93d4', '0345-6691033', '0345-6691033', 'STRIVE SPORTS ', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-28 11:53:04', 6, '2016-10-28 11:57:06', 6, 1),
(84, 4085, 'Credit', 'APX WZD', 'APX WZD', 'APX WZD', 'APX WZD', 'apxintl.wzd@gmail.com', 'apxintl.wzd@gmail.com', '000', 'e10adc3949ba59abbe56e057f20f883e', '000', '000', 'APX WZD', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-28 11:54:42', 6, '2016-10-28 11:57:21', 6, 1),
(85, 4086, 'Credit', 'HUGO SPORTS', 'HUGO SPORTS', 'HUGO SPORTS', 'HUGO SPORTS', '000', '000', '0345-6759223', 'c6f057b86584942e415435ffb1fa93d4', '0345-6759223', '0345-6759223', 'HUGO SPORTS ', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-28 11:56:06', 6, '2016-10-28 11:57:38', 6, 1),
(86, 4087, 'Credit', 'SEEMAB', 'SEEMAB', 'SEEMAB ', 'SEEMAB', '000', '000', '0333-9615608', 'c6f057b86584942e415435ffb1fa93d4', '0333-9615608', '0333-9615608', 'SEEMAB', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-28 11:58:55', 6, '0000-00-00 00:00:00', 0, 1),
(87, 4089, 'Credit', 'GULBERG FABRICS', 'GULBERG FABRICS', 'GULBERG FABRICS', 'GULBERG FABRICS', '000', '000', '03218614416', 'c6f057b86584942e415435ffb1fa93d4', '03218614416', '03218614416', 'GULBERG FABRICS', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-28 12:02:05', 6, '0000-00-00 00:00:00', 0, 1),
(88, 4090, 'Credit', 'BIKER WEARS', 'BIKER WEARS', 'BIKER WEARS ', 'BIKER WEARS', '000', '000', '0300-8714186 ', 'c6f057b86584942e415435ffb1fa93d4', '0300-8714186 ', '0300-8714186 ', 'BIKER WEARS ', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-28 12:03:50', 6, '0000-00-00 00:00:00', 0, 1),
(89, 4091, 'Credit', 'AZEEM KAMRAH', 'AZEEM KAMRAH', 'AZEEM KAMRAH', 'AZEEM KAMRAH', 'Azeem Bhatti <dreamco.kam', '000', '0321-5248077', 'e10adc3949ba59abbe56e057f20f883e', '0321-5248077', '0321-5248077', 'AZEEM KAMRA', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-29 08:23:19', 6, '0000-00-00 00:00:00', 0, 1),
(90, 4092, 'Credit', 'COURIER POINT', 'COURIER POINT', 'COURIER POINT ', 'COURIER POINT', '000', '000', '052-6524788', '202cb962ac59075b964b07152d234b70', '0347-6775522', '0347-6775522', 'COURIER POINT', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-29 08:25:35', 6, '0000-00-00 00:00:00', 0, 1),
(91, 4093, 'Credit', 'WASEEM PACE WELL', 'WASEEM PACE WELL', 'WASEEM PACE WEL', 'WASEEM PACE WELL', 'info@pacewell.com.pk', 'info@pacewell.com.pk', '0300 8611691', 'e10adc3949ba59abbe56e057f20f883e', '03008611691', '03008611691', 'WASEEM PACE WELL ', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-29 09:10:39', 6, '0000-00-00 00:00:00', 0, 1),
(92, 4094, 'Credit', 'BEAUTY TRACK', 'BEAUTY TRACK', 'BEAUTY TRACK', 'BEAUTY TRACK', '000', '000', '0332-7568995', 'c6f057b86584942e415435ffb1fa93d4', '0332-7568995', '0332-7568995', 'BEAUTY TRACK', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-29 09:12:53', 6, '0000-00-00 00:00:00', 0, 1),
(93, 4095, 'Credit', 'ABID HUSSAIN', 'ABID HUSSAIN', 'ABID HUSSAIN ', 'ABID HUSSAIN', 'abid hussain <afghanrugs@', '000', '000', 'e10adc3949ba59abbe56e057f20f883e', '000', '03006102462', 'ABID HUSSAIN', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-29 09:14:44', 6, '0000-00-00 00:00:00', 0, 1),
(94, 4096, 'Credit', 'SPORTIKA IMPEX', 'SPORTIKA IMPEX', 'SPORTIKA IMPEX', 'SPORTIKA IMPEX', '000', '000', '0332-8158017', 'c6f057b86584942e415435ffb1fa93d4', '0332-8158017', '0332-8158017', 'SPORTIKA IMPEX ', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-29 09:17:06', 6, '0000-00-00 00:00:00', 0, 1),
(95, 4097, 'Credit', 'NZ COURIER', 'NZ COURIER', 'NZ COURIER ', 'NZ COURIER', '000', '000', '0300-6149058', 'c6f057b86584942e415435ffb1fa93d4', '0300-6149058', '0300-6149058', 'NZ COURIER ', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-29 09:18:36', 6, '0000-00-00 00:00:00', 0, 1),
(96, 4098, 'Credit', 'NEW USMAN CHEEMA APX LEDGER', 'NEW USMAN CHEEMA APX LEDGER', 'NEW USMAN CHEEM', 'NEW USMAN CHEEMA APX LEDG', '000', '000', '0344-6458881', 'c6f057b86584942e415435ffb1fa93d4', '0344-6458881', '0344-6458881', 'USMAN CHEEMA', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-29 09:20:01', 6, '0000-00-00 00:00:00', 0, 1),
(97, 4099, 'Credit', 'SUPER SWIFT APX LEDGER', 'SUPER SWIFT APX LEDGER', 'SUPER SWIFT APX', 'SUPER SWIFT APX LEDGER', '000', '000', ' 0333-8780671', 'c6f057b86584942e415435ffb1fa93d4', ' 0333-8780671', '0333-8780671', 'SUPER SWIFT', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-29 09:21:23', 6, '0000-00-00 00:00:00', 0, 1),
(98, 5000, 'Credit', 'RAVINE INT NEW APX LEDGER', 'RAVINE INT NEW APX LEDGER', 'RAVINE INT NEW ', 'RAVINE INT NEW APX LEDGER', '000', '000', '052-3563004', 'c6f057b86584942e415435ffb1fa93d4', '052-3563004', '0523563004', 'RAVINE INT NEW ', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-29 09:28:33', 6, '2016-10-29 09:29:34', 6, 1),
(99, 5001, 'Credit', 'HIT WELL BOXING', 'HIT WELL BOXING', 'HIT WELL BOXING', 'HIT WELL BOXING', '000', '000', '0320-5913939', 'c6f057b86584942e415435ffb1fa93d4', '0320-5913939', '03205913939', 'HIT WELL BOXING ', 'SIALKOT', 'MAIN SIALKOT', 9, 'PK', 'PUNJAB', 'SIALKOT', '050000', '2016-10-29 09:46:37', 6, '2016-10-29 09:47:02', 6, 1),
(100, 22, 'Cash', 'Cash customers', '000', '000', '000', '000', '000', '00', 'c6f057b86584942e415435ffb1fa93d4', '000', '', '000', '', '', 9, 'PK', '', '', '', '2016-11-09 06:53:02', 6, '2016-11-09 13:41:32', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `apx_fuel_surcharge`
--

CREATE TABLE `apx_fuel_surcharge` (
  `fs_id` int(11) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `fs_percentage` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(4) NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_by` int(4) NOT NULL DEFAULT '0',
  `status` int(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apx_fuel_surcharge`
--

INSERT INTO `apx_fuel_surcharge` (`fs_id`, `from_date`, `to_date`, `fs_percentage`, `created_date`, `created_by`, `modified_date`, `modified_by`, `status`) VALUES
(2, '2016-11-01', '2016-11-30', 24, '2016-10-12 21:03:14', 6, '2016-10-12 21:03:54', 6, 0),
(3, '2016-10-13', '2017-04-01', 34, '2016-10-12 23:26:20', 6, '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `apx_gst`
--

CREATE TABLE `apx_gst` (
  `gst_id` int(11) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `gst_percentage` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(4) NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_by` int(4) NOT NULL DEFAULT '0',
  `status` int(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apx_gst`
--

INSERT INTO `apx_gst` (`gst_id`, `from_date`, `to_date`, `gst_percentage`, `created_date`, `created_by`, `modified_date`, `modified_by`, `status`) VALUES
(2, '2016-10-14', '2017-04-01', 22, '2016-10-09 23:14:16', 6, '2016-10-09 23:14:28', 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `apx_internal_notes`
--

CREATE TABLE `apx_internal_notes` (
  `id` int(100) NOT NULL,
  `note` text NOT NULL,
  `admin_id` int(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `apx_internal_notes`
--

INSERT INTO `apx_internal_notes` (`id`, `note`, `admin_id`, `created_at`, `user_name`) VALUES
(1, 'Test note', 5, '2017-02-26 18:26:27', 'abcd'),
(2, 'this shipment has been lost ', 5, '2017-02-26 23:06:16', 'abcd'),
(3, 'ok', 5, '2017-02-26 23:06:52', 'abcd'),
(4, 'no repeat note', 5, '2017-02-26 23:07:18', 'abcd');

-- --------------------------------------------------------

--
-- Table structure for table `apx_invoice`
--

CREATE TABLE `apx_invoice` (
  `id` int(100) NOT NULL,
  `invoice_no` int(100) NOT NULL,
  `date` date NOT NULL,
  `dhl_no` int(100) NOT NULL,
  `weight` double NOT NULL,
  `freight` double NOT NULL,
  `sales_tax` double NOT NULL,
  `gross_total` double NOT NULL,
  `total_fright` double NOT NULL,
  `pcs` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `apx_invoice`
--

INSERT INTO `apx_invoice` (`id`, `invoice_no`, `date`, `dhl_no`, `weight`, `freight`, `sales_tax`, `gross_total`, `total_fright`, `pcs`) VALUES
(1, 10, '2017-05-13', 10, 10, 10, 10, 10, 10, 10),
(2, 20, '2017-05-14', 24, 20, 20, 20, 20, 20, 20),
(3, 30, '2017-05-15', 23, 30, 30, 30, 30, 30, 30),
(4, 40, '2017-05-16', 40, 40, 40, 40, 40, 40, 40),
(5, 50, '2017-05-17', 50, 50, 50, 50, 50, 50, 50),
(6, 60, '2017-05-18', 60, 60, 60, 60, 60, 60, 60),
(7, 70, '2017-05-19', 70, 70, 70, 70, 70, 70, 70),
(8, 80, '2017-05-20', 80, 80, 80, 80, 80, 80, 80),
(9, 90, '2017-05-21', 90, 90, 90, 90, 90, 90, 90),
(10, 100, '2017-05-22', 100, 100, 100, 100, 100, 100, 100),
(11, 110, '2017-05-23', 110, 110, 110, 110, 110, 110, 110);

-- --------------------------------------------------------

--
-- Table structure for table `apx_messages`
--

CREATE TABLE `apx_messages` (
  `msg_id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL DEFAULT '0',
  `to_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `file` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `status` int(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apx_messages`
--

INSERT INTO `apx_messages` (`msg_id`, `from_id`, `to_id`, `message`, `file`, `created_date`, `status`) VALUES
(1, 0, 6, 'The attached data cannot be uploaded due to some error or duplicat airway number or invalid data.Please click the below link to view the file.<br/><a href="http://info-howto.com/apx-admin/uploads/temp/shipment_smehsoud_2016-11-03.csv">View file</a>', 'shipment_smehsoud_2016-11-03.csv', '2016-11-03 01:40:28', 0),
(2, 0, 6, 'The attached data cannot be uploaded due to some error or duplicat airway number or invalid data.Please click the below link to view the file.<br/><a href="http://info-howto.com/apx-admin/uploads/temp/shipment_smehsoud_2016-11-031.csv">View file</a>', 'shipment_smehsoud_2016-11-031.csv', '2016-11-03 01:44:58', 0),
(3, 0, 6, 'The attached data cannot be uploaded due to some error or duplicat airway number or invalid data.Please click the below link to view the file.<br/><a href="http://info-howto.com/apx-admin/uploads/temp/shipment_smehsoud_2016-11-033.csv">View file</a>', 'shipment_smehsoud_2016-11-033.csv', '2016-11-03 01:53:34', 0),
(4, 0, 6, 'The attached data cannot be uploaded due to some error or duplicat airway number or invalid data.Please click the below link to view the file.<br/><a href="http://info-howto.com/apx-admin/uploads/temp/shipment_smehsoud_2016-11-034.csv">View file</a>', 'shipment_smehsoud_2016-11-034.csv', '2016-11-03 01:56:10', 0),
(5, 0, 6, 'The attached data cannot be uploaded due to some error or duplicat airway number or invalid data.Please click the below link to view the file.<br/><a href="http://info-howto.com/apx-admin/uploads/temp/shipment_smehsoud_2016-11-035.csv">View file</a>', 'shipment_smehsoud_2016-11-035.csv', '2016-11-03 01:58:15', 0),
(6, 0, 5, 'The attached data cannot be uploaded due to some error or duplicat airway number or invalid data.Please click the below link to view the file.<br/><a href="http://localhost/apx-admin/uploads/temp/invoice_abcd_2017-02-271.csv">View file</a>', 'invoice_abcd_2017-02-271.csv', '2017-02-27 19:34:24', 0),
(7, 0, 5, 'The attached data cannot be uploaded due to some error or duplicate DHL NO  or Invoice No.Please click the below link to view the file.<br/><a href="http://localhost/apx-admin/uploads/temp/invoice_abcd_2017-02-277.csv">View file</a>', 'invoice_abcd_2017-02-277.csv', '2017-02-27 19:45:47', 0),
(8, 0, 5, 'The attached data cannot be uploaded due to some error or duplicate DHL NO  or Invoice No.Please click the below link to view the file.<br/><a href="http://localhost/apx-admin/uploads/temp/invoice_abcd_2017-02-278.csv">View file</a>', 'invoice_abcd_2017-02-278.csv', '2017-02-27 19:46:10', 0),
(9, 0, 5, 'The attached data cannot be uploaded due to some error or duplicate DHL NO  or Invoice No.Please click the below link to view the file.<br/><a href="http://localhost/apx-admin/uploads/temp/invoice_abcd_2017-02-279.csv">View file</a>', 'invoice_abcd_2017-02-279.csv', '2017-02-27 19:47:12', 0),
(10, 0, 5, 'The attached data cannot be uploaded due to some error or duplicate DHL NO  or Invoice No.Please click the below link to view the file.<br/><a href="http://localhost/apx-admin/uploads/temp/invoice_abcd_2017-02-2710.csv">View file</a>', 'invoice_abcd_2017-02-2710.csv', '2017-02-27 19:48:17', 0),
(11, 0, 5, 'The attached data cannot be uploaded due to some error or duplicate DHL NO  or Invoice No.Please click the below link to view the file.<br/><a href="http://localhost/apx-admin/uploads/temp/invoice_abcd_2017-02-2711.csv">View file</a>', 'invoice_abcd_2017-02-2711.csv', '2017-02-27 19:50:02', 0),
(12, 0, 5, 'The attached data cannot be uploaded due to some error or duplicate DHL NO  or Invoice No.Please click the below link to view the file.<br/><a href="http://localhost/apx-admin/uploads/temp/invoice_abcd_2017-02-2712.csv">View file</a>', 'invoice_abcd_2017-02-2712.csv', '2017-02-27 19:50:40', 0),
(13, 0, 5, 'The attached data cannot be uploaded due to some error or duplicate DHL NO  or Invoice No.Please click the below link to view the file.<br/><a href="http://localhost/apx-admin/uploads/temp/invoice_abcd_2017-02-28.csv">View file</a>', 'invoice_abcd_2017-02-28.csv', '2017-02-28 00:31:52', 0),
(14, 0, 5, 'The attached data cannot be uploaded due to some error or duplicate DHL NO  or Invoice No.Please click the below link to view the file.<br/><a href="http://localhost/apx-admin/uploads/temp/invoice_abcd_2017-02-281.csv">View file</a>', 'invoice_abcd_2017-02-281.csv', '2017-02-28 00:35:34', 0),
(15, 0, 5, 'The attached data cannot be uploaded due to some error or duplicat airway number or invalid data.Please click the below link to view the file.<br/><a href="http://localhost/apx-admin/uploads/temp/shipment_abcd_2017-02-284.csv">View file</a>', 'shipment_abcd_2017-02-284.csv', '2017-02-28 13:44:17', 0),
(16, 0, 5, 'The attached data cannot be uploaded due to some error or duplicat airway number or invalid data.Please click the below link to view the file.<br/><a href="http://localhost/apx-admin/uploads/temp/shipment_abcd_2017-02-285.csv">View file</a>', 'shipment_abcd_2017-02-285.csv', '2017-02-28 13:45:33', 0),
(17, 0, 5, 'The attached data cannot be uploaded due to some error or duplicat airway number or invalid data.Please click the below link to view the file.<br/><a href="http://localhost/apx-admin/uploads/temp/shipment_abcd_2017-02-28.csv">View file</a>', 'shipment_abcd_2017-02-28.csv', '2017-02-28 13:46:08', 0),
(18, 0, 5, 'The attached data cannot be uploaded due to some error or duplicat airway number or invalid data.Please click the below link to view the file.<br/><a href="http://localhost/apx-admin/uploads/temp/shipment_abcd_2017-02-281.csv">View file</a>', 'shipment_abcd_2017-02-281.csv', '2017-02-28 13:47:34', 0),
(19, 0, 5, 'The attached data cannot be uploaded due to some error or duplicat airway number or invalid data.Please click the below link to view the file.<br/><a href="http://localhost/apx-admin/uploads/temp/shipment_abcd_2017-02-282.csv">View file</a>', 'shipment_abcd_2017-02-282.csv', '2017-02-28 13:48:43', 0),
(20, 0, 5, 'The attached data cannot be uploaded due to some error or duplicat airway number or invalid data.Please click the below link to view the file.<br/><a href="http://localhost/apx-admin/uploads/temp/shipment_abcd_2017-02-284.csv">View file</a>', 'shipment_abcd_2017-02-284.csv', '2017-02-28 13:50:50', 0),
(21, 0, 5, 'The attached data cannot be uploaded due to some error or duplicat airway number or invalid data.Please click the below link to view the file.<br/><a href="http://localhost/apx-admin/uploads/temp/shipment_abcd_2017-02-285.csv">View file</a>', 'shipment_abcd_2017-02-285.csv', '2017-02-28 13:51:09', 0),
(22, 0, 5, 'The attached data cannot be uploaded due to some error or duplicat airway number or invalid data.Please click the below link to view the file.<br/><a href="http://localhost/apx-admin/uploads/temp/shipment_abcd_2017-02-2811.csv">View file</a>', 'shipment_abcd_2017-02-2811.csv', '2017-02-28 14:04:38', 0),
(23, 0, 5, 'The attached data cannot be uploaded due to some error or duplicat airway number or invalid data.Please click the below link to view the file.<br/><a href="http://localhost/apx-admin/uploads/temp/shipment_abcd_2017-02-2819.csv">View file</a>', 'shipment_abcd_2017-02-2819.csv', '2017-02-28 14:34:57', 0),
(24, 0, 5, 'The attached data cannot be uploaded due to some error or duplicat airway number or invalid data.Please click the below link to view the file.<br/><a href="http://localhost/apx-admin/uploads/temp/shipment_abcd_2017-02-2824.csv">View file</a>', 'shipment_abcd_2017-02-2824.csv', '2017-02-28 14:51:36', 0),
(25, 0, 5, 'The attached data cannot be uploaded due to some error or duplicat airway number or invalid data.Please click the below link to view the file.<br/><a href="http://localhost/apx-admin/uploads/temp/shipment_abcd_2017-02-2825.csv">View file</a>', 'shipment_abcd_2017-02-2825.csv', '2017-02-28 15:59:20', 0),
(26, 0, 5, 'The attached data cannot be uploaded due to some error or duplicat airway number or invalid data.Please click the below link to view the file.<br/><a href="http://localhost/apx-admin/uploads/temp/shipment_abcd_2017-02-2826.csv">View file</a>', 'shipment_abcd_2017-02-2826.csv', '2017-02-28 15:59:58', 0),
(27, 0, 5, 'The attached data cannot be uploaded due to some error or duplicat airway number or invalid data.Please click the below link to view the file.<br/><a href="http://localhost/apx-admin/uploads/temp/shipment_abcd_2017-02-2829.csv">View file</a>', 'shipment_abcd_2017-02-2829.csv', '2017-02-28 16:12:43', 0),
(28, 0, 5, 'The attached data cannot be uploaded due to some error or duplicat airway number or invalid data.Please click the below link to view the file.<br/><a href="http://localhost/apx-admin/uploads/temp/shipment_abcd_2017-02-2831.csv">View file</a>', 'shipment_abcd_2017-02-2831.csv', '2017-02-28 16:28:17', 0),
(29, 0, 5, 'The attached data cannot be uploaded due to some error or duplicat airway number or invalid data.Please click the below link to view the file.<br/><a href="http://localhost/apx-admin/uploads/temp/shipment_abcd_2017-02-2832.csv">View file</a>', 'shipment_abcd_2017-02-2832.csv', '2017-02-28 16:28:59', 0);

-- --------------------------------------------------------

--
-- Table structure for table `apx_price_list`
--

CREATE TABLE `apx_price_list` (
  `list_id` int(11) NOT NULL,
  `listName` varchar(15) NOT NULL,
  `listCode` varchar(15) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(4) NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_by` int(4) NOT NULL DEFAULT '0',
  `status` int(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apx_price_list`
--

INSERT INTO `apx_price_list` (`list_id`, `listName`, `listCode`, `created_date`, `created_by`, `modified_date`, `modified_by`, `status`) VALUES
(1, 'DHL BD', 'DHLBD', '2017-03-04 08:09:05', 5, '0000-00-00 00:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `apx_price_list_f`
--

CREATE TABLE `apx_price_list_f` (
  `list_id` int(11) NOT NULL,
  `listName` varchar(15) NOT NULL,
  `listCode` varchar(15) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(4) NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_by` int(4) NOT NULL DEFAULT '0',
  `status` int(4) NOT NULL DEFAULT '0',
  `type` enum('N-Dox','Dox','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apx_price_list_f`
--

INSERT INTO `apx_price_list_f` (`list_id`, `listName`, `listCode`, `created_date`, `created_by`, `modified_date`, `modified_by`, `status`, `type`) VALUES
(1, 'DHL BD', 'DHLBD', '2017-03-04 08:10:00', 5, '0000-00-00 00:00:00', 0, 1, 'Dox');

-- --------------------------------------------------------

--
-- Table structure for table `apx_role`
--

CREATE TABLE `apx_role` (
  `r_id` int(11) NOT NULL,
  `r_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apx_role`
--

INSERT INTO `apx_role` (`r_id`, `r_name`) VALUES
(1, 'Super Admin'),
(2, 'Admin'),
(3, 'Accounts'),
(4, 'Oprations'),
(5, 'Customer Service');

-- --------------------------------------------------------

--
-- Table structure for table `apx_shipment`
--

CREATE TABLE `apx_shipment` (
  `ship_id` int(11) NOT NULL,
  `air_way_number` varchar(15) NOT NULL,
  `tracking_number` varchar(15) NOT NULL,
  `accountNumber` int(11) NOT NULL,
  `companyName` varchar(50) NOT NULL,
  `shiperName` varchar(30) NOT NULL,
  `address1` varchar(100) NOT NULL,
  `address2` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `zipCode` varchar(25) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `userName` varchar(25) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `shiper_ref` varchar(25) NOT NULL,
  `shiper_content` text NOT NULL,
  `shiper_value` varchar(15) NOT NULL,
  `sample_invoice` varchar(50) NOT NULL,
  `receiverCompany` varchar(50) NOT NULL,
  `receiverName` varchar(25) NOT NULL,
  `receiverAddress1` varchar(100) NOT NULL,
  `receiverAddress2` varchar(100) NOT NULL,
  `receiverCity` varchar(50) NOT NULL,
  `receiverState` varchar(30) NOT NULL,
  `receiverCountry` varchar(10) NOT NULL,
  `receiverZipcode` varchar(25) NOT NULL,
  `receiverPhone` varchar(25) NOT NULL,
  `receiverMobile` varchar(25) NOT NULL,
  `shipType` enum('Dox','N-DOX') NOT NULL,
  `shipWeight` varchar(10) NOT NULL,
  `shipPcs` varchar(15) NOT NULL,
  `shipPriceList` int(11) NOT NULL,
  `shipPayment` float(12,2) NOT NULL,
  `shipPaid` float(12,2) NOT NULL,
  `shipBalance` float(12,2) NOT NULL,
  `shipInstruction` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  `csdStatus` enum('Intransit','Partial','Delivered','Problem','Lost') NOT NULL DEFAULT 'Intransit',
  `oprStatus` enum('Unmanifest','Manifested') NOT NULL DEFAULT 'Unmanifest',
  `actStatus` enum('UnBilled','Billed') NOT NULL DEFAULT 'UnBilled',
  `admStatus` enum('Unchecked','Checked') NOT NULL DEFAULT 'Unchecked',
  `trash` int(4) NOT NULL,
  `status` enum('Billed','Checked','Delivered','Intransit','Lost','Problem','Partial','UnBilled','Unchecked','Manifested','Unmanifest') NOT NULL DEFAULT 'Intransit'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apx_shipment`
--

INSERT INTO `apx_shipment` (`ship_id`, `air_way_number`, `tracking_number`, `accountNumber`, `companyName`, `shiperName`, `address1`, `address2`, `city`, `state`, `country`, `zipCode`, `phone`, `userName`, `date`, `time`, `shiper_ref`, `shiper_content`, `shiper_value`, `sample_invoice`, `receiverCompany`, `receiverName`, `receiverAddress1`, `receiverAddress2`, `receiverCity`, `receiverState`, `receiverCountry`, `receiverZipcode`, `receiverPhone`, `receiverMobile`, `shipType`, `shipWeight`, `shipPcs`, `shipPriceList`, `shipPayment`, `shipPaid`, `shipBalance`, `shipInstruction`, `created_by`, `created_date`, `modified_by`, `modified_date`, `csdStatus`, `oprStatus`, `actStatus`, `admStatus`, `trash`, `status`) VALUES
(1, '12345', '1234', 4001, 'TANGO TRADING', 'XYZ ABC', '', 'MAIN SIALKOT ', 'SIALKOT', 'PUNJAB', 'Pakistan', '050000', '03338636704', 'abcd', '2017-03-04', '16:25:37', '', '', '', '', 'test', 'test', 'test', 'test', 'test', 'test', 'IN', '', '', '', 'Dox', '5', '3', 1, 500.00, 200.00, 300.00, '', 5, '2017-03-04 16:25:47', 0, '0000-00-00 00:00:00', 'Intransit', 'Unmanifest', 'UnBilled', 'Unchecked', 0, 'Intransit'),
(2, 'dgd', 'dgdgd', 4001, 'TANGO TRADING', 'XYZ ABC', '', 'MAIN SIALKOT ', 'SIALKOT', 'PUNJAB', 'Pakistan', '050000', '03338636704', 'abcd', '2017-03-04', '17:21:14', '', '', '', '', 'dd', 'dg', 'dgd', 'dgd', 'dgd', '', 'IN', '', '', '', 'Dox', '5', '', 1, 500.00, 0.00, 500.00, '', 5, '2017-03-04 17:21:20', 0, '0000-00-00 00:00:00', 'Intransit', 'Unmanifest', 'UnBilled', 'Unchecked', 0, 'Intransit');

-- --------------------------------------------------------

--
-- Table structure for table `apx_weight_prices`
--

CREATE TABLE `apx_weight_prices` (
  `wp_id` int(11) NOT NULL,
  `zone_id` int(11) NOT NULL,
  `list_id` int(11) NOT NULL,
  `weight_from` varchar(15) NOT NULL,
  `weight_to` varchar(15) NOT NULL,
  `wprice` float(12,2) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(4) NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_by` int(4) NOT NULL DEFAULT '0',
  `status` int(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apx_weight_prices`
--

INSERT INTO `apx_weight_prices` (`wp_id`, `zone_id`, `list_id`, `weight_from`, `weight_to`, `wprice`, `created_date`, `created_by`, `modified_date`, `modified_by`, `status`) VALUES
(1, 1, 1, '1', '20', 500.00, '2017-03-04 08:09:45', 5, '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `apx_weight_prices_f`
--

CREATE TABLE `apx_weight_prices_f` (
  `wp_id` int(11) NOT NULL,
  `zone_id` int(11) NOT NULL,
  `list_id` int(11) NOT NULL,
  `weight_from` varchar(15) NOT NULL,
  `weight_to` varchar(15) NOT NULL,
  `wprice` float(12,2) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(4) NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_by` int(4) NOT NULL DEFAULT '0',
  `status` int(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apx_weight_prices_f`
--

INSERT INTO `apx_weight_prices_f` (`wp_id`, `zone_id`, `list_id`, `weight_from`, `weight_to`, `wprice`, `created_date`, `created_by`, `modified_date`, `modified_by`, `status`) VALUES
(1, 49, 1, '1.00', '10.00', 300.00, '2017-03-04 08:10:47', 5, '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `apx_zone`
--

CREATE TABLE `apx_zone` (
  `zone_id` int(11) NOT NULL,
  `list_id` int(11) NOT NULL,
  `zoneName` varchar(15) NOT NULL,
  `zoneLink` varchar(25) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(4) NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_by` int(4) NOT NULL DEFAULT '0',
  `status` int(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apx_zone`
--

INSERT INTO `apx_zone` (`zone_id`, `list_id`, `zoneName`, `zoneLink`, `created_date`, `created_by`, `modified_date`, `modified_by`, `status`) VALUES
(1, 1, 'SOUTH', 'SOUTH_1', '2017-03-04 08:09:18', 5, '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `apx_zone_countries`
--

CREATE TABLE `apx_zone_countries` (
  `zc_id` int(11) NOT NULL,
  `zone_id` int(11) NOT NULL,
  `list_id` int(11) NOT NULL,
  `countryCode` varchar(15) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apx_zone_countries`
--

INSERT INTO `apx_zone_countries` (`zc_id`, `zone_id`, `list_id`, `countryCode`, `created_date`, `created_by`, `status`) VALUES
(1, 1, 1, 'IN', '2017-03-04 08:09:29', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `apx_zone_countries_f`
--

CREATE TABLE `apx_zone_countries_f` (
  `zc_id` int(11) NOT NULL,
  `zone_id` int(11) NOT NULL,
  `list_id` int(11) NOT NULL,
  `countryCode` varchar(15) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apx_zone_countries_f`
--

INSERT INTO `apx_zone_countries_f` (`zc_id`, `zone_id`, `list_id`, `countryCode`, `created_date`, `created_by`, `status`) VALUES
(491, 49, 1, 'IN', '2017-03-04 08:10:30', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `apx_zone_f`
--

CREATE TABLE `apx_zone_f` (
  `zone_id` int(11) NOT NULL,
  `list_id` int(11) NOT NULL,
  `zoneName` varchar(15) NOT NULL,
  `zoneLink` varchar(25) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(4) NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_by` int(4) NOT NULL DEFAULT '0',
  `status` int(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apx_zone_f`
--

INSERT INTO `apx_zone_f` (`zone_id`, `list_id`, `zoneName`, `zoneLink`, `created_date`, `created_by`, `modified_date`, `modified_by`, `status`) VALUES
(49, 1, 'SOUTH', 'SOUTH_1', '2017-03-04 08:10:19', 5, '0000-00-00 00:00:00', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apx_admin`
--
ALTER TABLE `apx_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apx_balance_tbl`
--
ALTER TABLE `apx_balance_tbl`
  ADD PRIMARY KEY (`blc_id`);

--
-- Indexes for table `apx_branches`
--
ALTER TABLE `apx_branches`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `apx_countries`
--
ALTER TABLE `apx_countries`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `apx_customer`
--
ALTER TABLE `apx_customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `apx_fuel_surcharge`
--
ALTER TABLE `apx_fuel_surcharge`
  ADD PRIMARY KEY (`fs_id`);

--
-- Indexes for table `apx_gst`
--
ALTER TABLE `apx_gst`
  ADD PRIMARY KEY (`gst_id`);

--
-- Indexes for table `apx_internal_notes`
--
ALTER TABLE `apx_internal_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apx_invoice`
--
ALTER TABLE `apx_invoice`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dhl_no` (`dhl_no`),
  ADD UNIQUE KEY `invoice_no` (`invoice_no`);

--
-- Indexes for table `apx_messages`
--
ALTER TABLE `apx_messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `apx_price_list`
--
ALTER TABLE `apx_price_list`
  ADD PRIMARY KEY (`list_id`);

--
-- Indexes for table `apx_price_list_f`
--
ALTER TABLE `apx_price_list_f`
  ADD PRIMARY KEY (`list_id`);

--
-- Indexes for table `apx_role`
--
ALTER TABLE `apx_role`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `apx_shipment`
--
ALTER TABLE `apx_shipment`
  ADD PRIMARY KEY (`ship_id`),
  ADD UNIQUE KEY `air_way_number` (`air_way_number`);

--
-- Indexes for table `apx_weight_prices`
--
ALTER TABLE `apx_weight_prices`
  ADD PRIMARY KEY (`wp_id`);

--
-- Indexes for table `apx_weight_prices_f`
--
ALTER TABLE `apx_weight_prices_f`
  ADD PRIMARY KEY (`wp_id`);

--
-- Indexes for table `apx_zone`
--
ALTER TABLE `apx_zone`
  ADD PRIMARY KEY (`zone_id`);

--
-- Indexes for table `apx_zone_countries`
--
ALTER TABLE `apx_zone_countries`
  ADD PRIMARY KEY (`zc_id`);

--
-- Indexes for table `apx_zone_countries_f`
--
ALTER TABLE `apx_zone_countries_f`
  ADD PRIMARY KEY (`zc_id`);

--
-- Indexes for table `apx_zone_f`
--
ALTER TABLE `apx_zone_f`
  ADD PRIMARY KEY (`zone_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apx_admin`
--
ALTER TABLE `apx_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `apx_balance_tbl`
--
ALTER TABLE `apx_balance_tbl`
  MODIFY `blc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `apx_branches`
--
ALTER TABLE `apx_branches`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `apx_countries`
--
ALTER TABLE `apx_countries`
  MODIFY `country_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=277;
--
-- AUTO_INCREMENT for table `apx_customer`
--
ALTER TABLE `apx_customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
--
-- AUTO_INCREMENT for table `apx_fuel_surcharge`
--
ALTER TABLE `apx_fuel_surcharge`
  MODIFY `fs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `apx_gst`
--
ALTER TABLE `apx_gst`
  MODIFY `gst_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `apx_internal_notes`
--
ALTER TABLE `apx_internal_notes`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `apx_invoice`
--
ALTER TABLE `apx_invoice`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `apx_messages`
--
ALTER TABLE `apx_messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `apx_price_list`
--
ALTER TABLE `apx_price_list`
  MODIFY `list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `apx_price_list_f`
--
ALTER TABLE `apx_price_list_f`
  MODIFY `list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `apx_role`
--
ALTER TABLE `apx_role`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `apx_shipment`
--
ALTER TABLE `apx_shipment`
  MODIFY `ship_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `apx_weight_prices`
--
ALTER TABLE `apx_weight_prices`
  MODIFY `wp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `apx_weight_prices_f`
--
ALTER TABLE `apx_weight_prices_f`
  MODIFY `wp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `apx_zone`
--
ALTER TABLE `apx_zone`
  MODIFY `zone_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `apx_zone_countries`
--
ALTER TABLE `apx_zone_countries`
  MODIFY `zc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `apx_zone_countries_f`
--
ALTER TABLE `apx_zone_countries_f`
  MODIFY `zc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=492;
--
-- AUTO_INCREMENT for table `apx_zone_f`
--
ALTER TABLE `apx_zone_f`
  MODIFY `zone_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
