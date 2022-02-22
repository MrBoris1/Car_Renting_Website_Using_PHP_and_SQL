-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2021 at 08:39 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ABIcarrent`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `car_id` int(11) NOT NULL,
  `car_name` varchar(256) NOT NULL,
  `car_type` varchar(256) NOT NULL,
  `car_status` varchar(256) NOT NULL,
  `car_price` int(11) NOT NULL,
  `car_available` int(11) NOT NULL,
  `car_location` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`car_id`, `car_name`, `car_type`, `car_status`, `car_price`, `car_available`, `car_location`) VALUES
(1, 'Tesla Model 3', 'sedan', 'second hand', 54, 0, 'Istanbul Branch'),
(2, 'Land Rover Defender', 'JEEP', 'second hand', 54, 3, 'Ankara Branch'),
(3, 'Land Rover Evoque', 'JEEP', 'second hand', 60, 1, 'Izmir Branch'),
(4, 'Ford Mustang', 'Sedan', 'second hand', 120, 1, 'Ankara Branch'),
(5, 'Audi RS6', 'Sport', 'second hand', 12890, 1, 'Ankara Branch'),
(6, 'Gayis Linea', 'Sedan', 'second hand', 123, 2, 'Istanbul Branch'),
(7, 'Porsche Taycan', 'Sport', 'second hand', 1534, 1, 'Istanbul Branch'),
(8, 'Dogan gorunumlu Sahin', 'Sport', 'second hand', 2147483647, 1, 'Bursa Branch'),
(9, 'Land Rover Defender', 'JEEP', 'second hand', 555555, 2, 'Ankara Branch');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `card_holder_name` varchar(256) NOT NULL,
  `card_number` int(11) NOT NULL,
  `expare_month` int(11) NOT NULL,
  `Expare_year` int(11) NOT NULL,
  `cvs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `user_id`, `card_holder_name`, `card_number`, `expare_month`, `Expare_year`, `cvs`) VALUES
(1, 2, 'ahmet', 2147483647, 12, 2020, 123);

-- --------------------------------------------------------

--
-- Table structure for table `rent`
--

CREATE TABLE `rent` (
  `rent_order` int(11) NOT NULL,
  `cars_id` int(11) DEFAULT NULL,
  `cars_name` varchar(256) DEFAULT NULL,
  `users_id` int(11) NOT NULL,
  `rent_time` date DEFAULT NULL,
  `rent_leght` date DEFAULT NULL,
  `rent_location` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rent`
--

INSERT INTO `rent` (`rent_order`, `cars_id`, `cars_name`, `users_id`, `rent_time`, `rent_leght`, `rent_location`) VALUES
(1, 2, 'Land Rover Defender', 2, '2021-06-08', '2021-06-23', 'Ankara Branch'),
(2, 2, 'Land Rover Defender', 2, '2021-06-09', '2021-06-17', 'Ankara Branch'),
(3, 5, 'Ford Mustang', 2, '2021-06-17', '2021-06-30', 'Ankara Branch'),
(4, 5, 'Ford Mustang', 2, '2021-06-17', '2021-06-30', 'Ankara Branch'),
(5, 5, 'Ford Mustang', 2, '2021-06-14', '2021-06-23', 'Ankara Branch'),
(6, 1, 'Tesla Model 3', 2, '2021-06-30', '2021-07-22', 'Istanbul Branch');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(256) NOT NULL,
  `user_e_mail` varchar(256) NOT NULL,
  `user_password` varchar(256) NOT NULL,
  `admin` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_e_mail`, `user_password`, `admin`) VALUES
(1, 'Baris', 'barisbob@gmail.com', '$2y$10$1fQa8PoXDwkg8gWi0ULLBu7fKB8QXqwqb0cALEDWuViZjAPIBcX0i', 'admin'),
(2, 'ahmet', 'ahmet@gmail.com', '$2y$10$DgYyne/PcJQDzRDRzf43PeQyGk9GwLD88jJlMMCymfaHhtaVZ3xki', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`car_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `rent`
--
ALTER TABLE `rent`
  ADD PRIMARY KEY (`rent_order`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rent`
--
ALTER TABLE `rent`
  MODIFY `rent_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
