-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 28, 2018 at 09:23 PM
-- Server version: 5.7.21
-- PHP Version: 5.6.30

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
  `status` varchar(3) NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categary`
--

INSERT INTO `categary` (`cat_id`, `cat_name`, `cat_image`, `cat_create_date`, `cat_last_modify`, `cat_slug`, `status`) VALUES
(1, 'Printing machine', '', '2017-10-09 23:19:39', '2017-10-09 23:22:12', 'printing-machine', 'Y'),
(2, 'Folding machine', '', '2017-10-09 23:20:12', '2017-10-09 23:22:28', 'folding-machine', 'Y');

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
  `status` varchar(3) NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_slug`, `product_model`, `product_brand`, `product_spec`, `product_desc`, `product_price`, `product_image1`, `product_image2`, `product_image3`, `product_cat`, `prod_create_date`, `prod_last_modify`, `status`) VALUES
(1, 'Ryopi 2800 cd', 'machine-1', 'test', 'php', ' <p>Name: Ryopi 2800 cd</p>\r\n <p>Type: Second hand</p>\r\n <p>Size: 11*17 </p>', ' <p>Name: Ryopi 2800 cd</p>\r\n <p>Type: Second hand</p>\r\n <p>Size: 11*17 </p>', '1000', '1.jpg', '', '', '1', '2017-10-09 23:24:49', '2018-03-18 12:31:16', 'Y'),
(2, 'Polar cutting machine', 'machine-2', 'test', 'php', ' <p>Name: Polar cutting machine</p>\r\n <p>Type: Second hand</p>\r\n <p>Machine type: full auto matic </p>', ' <p>Name: Polar cutting machine</p>\r\n <p>Type: Second hand</p>\r\n <p>Machine type: full auto matic </p>', '1000', '2.jpg', '', '', '1', '2017-10-09 23:24:49', '2018-03-18 12:31:16', 'Y'),
(3, 'Ryopi 3200 cd', 'machine-3', 'test', 'php', ' <p>Name: Ryopi 3200 cd</p>\r\n <p>Type: Second hand</p>\r\n <p>Size: 13*18 size </p>', ' <p>Name: Ryopi 3200 cd</p>\r\n <p>Type: Second hand</p>\r\n <p>Size: 13*18 size </p>', '1000', '3.jpg', '', '', '1', '2017-10-09 23:24:49', '2018-03-18 12:31:16', 'Y'),
(4, 'Board to board pasting machine', 'machine-4', 'test', 'php', ' <p>Name: Board to board pasting machine</p>\r\n <p>Type: Second hand</p>', ' <p>Name: Board to board pasting machine</p>\r\n <p>Type: Second hand</p>', '1000', '4.jpg', '', '', '1', '2017-10-09 23:24:49', '2018-03-18 12:30:19', 'Y');

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
(1, 'Buy or sell printing secondary machines on india', 'secondary printing machine, spare parts on all india,foil secondary printing machine,spare parts on all india,all secondary printing machine ,spare parts on all india', 'Find here secondary Printing Machine , suppliers & exporters in India. Get contact details & address of companies manufacturing and supplying secondary Printing Machine, secondary Printer across India.', '/index.php');

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
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `seo`
--
ALTER TABLE `seo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
