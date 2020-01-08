-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 29, 2019 at 01:41 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `svengine_core`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(20) NOT NULL,
  `admin_email` varchar(25) NOT NULL,
  `admin_pass` varchar(25) NOT NULL,
  `admin_mobile` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categary`
--

CREATE TABLE `categary` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(200) NOT NULL,
  `cat_image` varchar(200) NOT NULL,
  `cat_create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cat_last_modify` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cat_slug` varchar(200) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categary`
--

INSERT INTO `categary` (`cat_id`, `cat_name`, `cat_image`, `cat_create_date`, `cat_last_modify`, `cat_slug`, `status`) VALUES
(1, 'Printing machine', 'balan.jpeg', '2017-10-09 23:19:39', '2019-01-29 04:24:03', 'printing-machine', 1),
(2, 'Folding machine', 'balan.jpeg', '2017-10-09 23:20:12', '2019-01-29 04:24:13', 'folding-machine', 1),
(3, 'values1', 'balan.jpeg', '2018-12-09 20:45:14', '2019-01-29 04:00:30', 'values1', 1),
(4, 'values1', 'balan.jpeg', '2018-12-09 20:45:46', '2019-01-29 04:00:49', 'values2', 1),
(6, 'values1', 'balan.jpeg', '2018-12-09 21:58:08', '2019-01-29 04:00:49', 'values2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_slug` varchar(255) NOT NULL,
  `product_model` varchar(255) NOT NULL,
  `product_brand` varchar(100) NOT NULL,
  `product_spec` text NOT NULL,
  `product_desc` text NOT NULL,
  `product_price` varchar(10) NOT NULL,
  `product_image1` varchar(100) NOT NULL,
  `product_image2` varchar(100) NOT NULL,
  `product_image3` varchar(100) NOT NULL,
  `product_cat` varchar(5) NOT NULL,
  `prod_create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `prod_last_modify` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(2) NOT NULL DEFAULT '1',
  `product_type` varchar(2) NOT NULL,
  `user_id` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_slug`, `product_model`, `product_brand`, `product_spec`, `product_desc`, `product_price`, `product_image1`, `product_image2`, `product_image3`, `product_cat`, `prod_create_date`, `prod_last_modify`, `status`, `product_type`, `user_id`) VALUES
(1, 'Ryopi 2800 cd', 'machine-1', 'test1', 'php', '[{\"key\":\"bala1\",\"value\":\"value1\"},{\"key\":\"bala2\",\"value\":\"value2\"},{\"key\":\"bala3\",\"value\":\"value3\"}]', ' <p>Name: Ryopi 2800 cd</p>\r\n <p>Type: Second hand</p>\r\n <p>Size: 11*17 </p>', '2000', '1.jpg', '', '', '1', '2017-10-09 23:24:49', '2019-01-29 05:18:01', 0, '', '22'),
(2, 'Polar cutting machine', 'machine-2', 'test', 'php', '[{\"key\":\"bala1\",\"value\":\"value1\"},{\"key\":\"bala2\",\"value\":\"value2\"},{\"key\":\"bala3\",\"value\":\"value3\"}]', ' <p>Name: Polar cutting machine</p>\r\n <p>Type: Second hand</p>\r\n <p>Machine type: full auto matic </p>', '2000', '2.jpg', '', '', '1', '2017-10-09 23:24:49', '2019-01-29 05:18:01', 0, '', '22'),
(3, 'Ryopi 3200 cd', 'machine-3', 'test', 'php', '[{\"key\":\"bala1\",\"value\":\"value1\"},{\"key\":\"bala2\",\"value\":\"value2\"},{\"key\":\"bala3\",\"value\":\"value3\"}]', ' <p>Name: Ryopi 3200 cd</p>\r\n <p>Type: Second hand</p>\r\n <p>Size: 13*18 size </p>', '2000', '3.jpg', '', '', '1', '2017-10-09 23:24:49', '2019-01-29 05:18:01', 0, '', '22'),
(4, 'Board to board pasting machine', 'machine-4', 'test', 'php', '[{\"key\":\"bala1\",\"value\":\"value1\"},{\"key\":\"bala2\",\"value\":\"value2\"},{\"key\":\"bala3\",\"value\":\"value3\"}]', ' <p>Name: Board to board pasting machine</p>\r\n <p>Type: Second hand</p>', '2000', '4.jpg', '', '', '1', '2017-10-09 23:24:49', '2019-01-29 05:18:01', 0, '', '22'),
(5, 'bala', '', '', '', '[{\"key\":\"bala1\",\"value\":\"value1\"},{\"key\":\"bala2\",\"value\":\"value2\"},{\"key\":\"bala3\",\"value\":\"value3\"}]', 'product_desc', '2000', 'gg1.png', '', '', '2', '2018-12-29 20:27:02', '2019-01-29 05:13:50', 1, '0', '22'),
(6, 'balan', '', '', '', '[{\"key\":\"bala1\",\"value\":\"value1\"},{\"key\":\"bala2\",\"value\":\"value2\"},{\"key\":\"bala3\",\"value\":\"value3\"}]', 'product_desc', '2000', 'gg1.png', '', '', '2', '2018-12-29 20:29:13', '2019-01-29 05:13:50', 1, '0', '22'),
(14, '1kjq13', '', '', '', '[{\"key\":\"bala1\",\"value\":\"value1\"},{\"key\":\"bala2\",\"value\":\"value2\"},{\"key\":\"bala3\",\"value\":\"value3\"}]', 'product_desc', '2000', 'gg1.png', '', '', '1', '2018-12-30 19:01:05', '2019-01-29 05:18:01', 1, '1', '22'),
(17, 'b', '', '', '', '[{\"key\":\"bala1\",\"value\":\"value1\"},{\"key\":\"bala2\",\"value\":\"value2\"},{\"key\":\"bala3\",\"value\":\"value3\"}]', 'product_desc', '2000', 'b.png', '', '', '1', '2018-12-31 21:27:22', '2019-01-29 05:18:01', 1, '1', '22'),
(18, 'n', '', '', '', '[{\"key\":\"bala1\",\"value\":\"value1\"},{\"key\":\"bala2\",\"value\":\"value2\"},{\"key\":\"bala3\",\"value\":\"value3\"}]', 'product_desc', '2000', 'gg1.png', '', '', '1', '2018-12-31 21:32:05', '2019-01-29 05:18:01', 1, '1', '22'),
(19, 'nnn', '', '', '', '[{\"key\":\"bala1\",\"value\":\"value1\"},{\"key\":\"bala2\",\"value\":\"value2\"},{\"key\":\"bala3\",\"value\":\"value3\"}]', 'product_desc', '2000', 'nnn.png', '', '', '2', '2018-12-31 21:33:30', '2019-01-29 05:18:01', 1, '1', '22'),
(21, 'gg1', '', '', '', '[{\"key\":\"bala1\",\"value\":\"value1\"},{\"key\":\"bala2\",\"value\":\"value2\"},{\"key\":\"bala3\",\"value\":\"value3\"}]', 'product_desc', '2000', 'gg1.png', '', '', '1', '2018-12-31 21:58:11', '2019-01-29 05:18:01', 1, '1', '22'),
(22, 'jbjhbj', '', '', '', '[{\"key\":\"bala1\",\"value\":\"value1\"},{\"key\":\"bala2\",\"value\":\"value2\"},{\"key\":\"bala3\",\"value\":\"value3\"}]', 'product_desc', '2000', 'jbjhbj.jpeg', '', '', 'vhh', '2019-01-20 13:30:38', '2019-01-29 05:18:01', 1, '1', '22');

-- --------------------------------------------------------

--
-- Table structure for table `seo`
--

CREATE TABLE `seo` (
  `id` int(11) NOT NULL,
  `title` text,
  `keyword` text,
  `description` text,
  `page` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seo`
--

INSERT INTO `seo` (`id`, `title`, `keyword`, `description`, `page`) VALUES
(1, 'Printing machine sales and service by S.V Engineering,Tamil nadu', 'offset printing machine, second hand offset printing machine,heidelberg,comori,printing machines,tamil nadu printing service,s.v Engineering,tamil nadu', 'S.V. Engineering - Printing machine repair, sales and Altration from Tirunelveli, Tamil Nadu, India\r\n', '/index.php');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `uname` varchar(40) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pwd` varchar(30) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` datetime NOT NULL,
  `profile_pic` varchar(75) NOT NULL,
  `mobile` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uname`, `email`, `pwd`, `create_at`, `last_login`, `profile_pic`, `mobile`) VALUES
(16, 'bala', 'vvbala1995@gmail.com', 'fdfd', '2018-12-29 15:30:44', '2019-01-20 13:34:10', '', ''),
(17, 'fdfff', 'vvbala1995@gmail.com1', 'sdsdsd', '2018-12-29 15:32:53', '2018-12-29 15:32:53', '', ''),
(18, 'dddd', '', 'fdfdfdf', '2018-12-29 15:34:40', '2018-12-29 15:34:40', '', '1234567890'),
(19, 'balan', 'vvbala1995@gmail.com2', 'hijh', '2018-12-29 16:10:30', '2018-12-29 16:10:30', '', ''),
(20, 'jhgh', 'gjh@hg.jhh', 'ggbjj', '2018-12-29 19:23:07', '2018-12-29 19:23:07', '', ''),
(21, 'ygt', 'hgj@jh.hjgf', 'jhgjk', '2018-12-29 19:33:50', '2018-12-29 19:33:50', '', ''),
(22, 'kj', 'kj@hg.tgr', 'kjhi', '2018-12-29 20:25:43', '2018-12-29 20:25:43', '', ''),
(23, 'kjjb', 'bjkbj', 'jkbnjkn', '2019-01-26 18:48:30', '0000-00-00 00:00:00', '', ''),
(24, 'kjjb', 'bjkbj', 'jkbnjkn', '2019-01-26 19:14:54', '0000-00-00 00:00:00', '', ''),
(25, 'kjjb', 'bjkbj', 'jkbnjkn', '2019-01-26 19:15:20', '0000-00-00 00:00:00', '', ''),
(26, 'kjn', 'jknjkn', 'jknkj', '2019-01-26 19:18:01', '0000-00-00 00:00:00', '', ''),
(27, 'kjn', ' jbjh', 'bhbjhb', '2019-01-26 19:19:18', '0000-00-00 00:00:00', '', ''),
(28, 'kjn', 'knk', 'njkn', '2019-01-26 19:20:38', '0000-00-00 00:00:00', '', ''),
(29, 'kjn', 'jbhj', 'bjbj', '2019-01-26 19:21:42', '0000-00-00 00:00:00', '', ''),
(30, 'kjn', 'n jnkjn', 'jknkjnjk', '2019-01-26 19:26:50', '0000-00-00 00:00:00', '', ''),
(31, 'kjn', 'n jnkjn', 'jknkjnjk', '2019-01-26 19:26:55', '0000-00-00 00:00:00', '', ''),
(32, 'kjn', 'n jnkjn', 'jknkjnjk', '2019-01-26 19:31:04', '0000-00-00 00:00:00', '', ''),
(33, 'hjvbhj', 'bhjbhjbh', 'jbjhbjhb', '2019-01-26 20:23:24', '0000-00-00 00:00:00', '', ''),
(34, 'bjhb', 'hjbjhbjhb', 'hjbjhbjh', '2019-01-26 20:24:14', '0000-00-00 00:00:00', '', ''),
(35, 'bjhb', 'kjn', 'jnjknjkn', '2019-01-26 20:24:38', '0000-00-00 00:00:00', '', ''),
(36, 'bjhb', 'kjnjk', 'njknkjn', '2019-01-26 20:25:45', '0000-00-00 00:00:00', '', ''),
(37, 'bjhb', 'njkn', 'nkjnkj', '2019-01-26 21:10:03', '0000-00-00 00:00:00', '', ''),
(38, 'jhb', 'jhbjhb', 'hjbjh', '2019-01-26 21:35:42', '0000-00-00 00:00:00', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `categary`
--
ALTER TABLE `categary`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `prod_cat` (`product_cat`);

--
-- Indexes for table `seo`
--
ALTER TABLE `seo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categary`
--
ALTER TABLE `categary`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `seo`
--
ALTER TABLE `seo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
