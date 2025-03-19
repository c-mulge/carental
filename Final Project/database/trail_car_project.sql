-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2025 at 08:53 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trail_car_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ADMIN_ID` varchar(255) NOT NULL,
  `ADMIN_NAME` varchar(255) NOT NULL,
  `ADMIN_EMAIL` varchar(255) NOT NULL,
  `ADMIN_PASSWORD` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ADMIN_ID`, `ADMIN_NAME`, `ADMIN_EMAIL`, `ADMIN_PASSWORD`) VALUES
('ADMIN123', 'Channveer Mulge', 'mulgechannveer@gmail.com', '$2y$10$vOHLFutr7aLFqQH3GMH7teeSrTORgbstRdMf4XHcoEUUynNQjDYG6'),
('Krishna', 'Krishna Mankar', 'krishnamankarpatil@gmail.com', '$2y$10$6dymjs8.c0JySo/nz1KX..v3YxTA6gK2iPp36NQNpELGQVmC7DdCa');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `BOOK_ID` int(11) NOT NULL,
  `CAR_ID` int(11) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `BOOK_PLACE` varchar(255) NOT NULL,
  `BOOK_DATE` date NOT NULL,
  `DURATION` int(11) NOT NULL,
  `PHONE_NUMBER` bigint(20) NOT NULL,
  `DESTINATION` varchar(255) NOT NULL,
  `RETURN_DATE` date NOT NULL,
  `PRICE` int(11) NOT NULL,
  `BOOK_STATUS` varchar(255) NOT NULL DEFAULT 'UNDER PROCESSING',
  `PICK_UP_TIME` time DEFAULT NULL,
  `DROP_TIME` time DEFAULT NULL,
  `STATUS` varchar(20) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`BOOK_ID`, `CAR_ID`, `EMAIL`, `BOOK_PLACE`, `BOOK_DATE`, `DURATION`, `PHONE_NUMBER`, `DESTINATION`, `RETURN_DATE`, `PRICE`, `BOOK_STATUS`, `PICK_UP_TIME`, `DROP_TIME`, `STATUS`) VALUES
(86, 5, 'soham.personal02@gmail.com', 'Pune', '2024-12-01', 3, 9090909090, 'Satara', '2024-12-04', 6000, 'RETURNED', NULL, NULL, 'Pending'),
(87, 6, 'soham.personal02@gmail.com', 'Mumbai', '2024-12-05', 4, 7878787878, 'Kolkata', '2024-12-08', 6000, 'RETURNED', NULL, NULL, 'Pending'),
(90, 6, 'embomber.2022@gmail.com', 'Mumbai', '2024-12-05', 2, 7020841171, 'Banglore', '2024-12-06', 3000, 'RETURNED', NULL, NULL, 'Pending'),
(91, 6, 'soham.personal02@gmail.com', '', '0000-00-00', 0, 0, '', '0000-00-00', 0, 'Rejected', NULL, NULL, 'Pending'),
(92, 4, 'mulgechannveer@gmail.com', 'Pune', '2025-02-11', 3, 7020841171, 'Mumbai', '2025-02-13', 7500, 'RETURNED', NULL, NULL, 'Pending'),
(93, 11, 'soham.personal02@gmail.com', 'Pune', '2025-03-17', 2, 7020841171, 'Chennai', '2025-03-18', 5000, 'RETURNED', NULL, NULL, 'Pending'),
(94, 11, 'soham.personal02@gmail.com', 'Pune', '2025-03-17', 2, 7020841171, 'Chennai', '2025-03-18', 2500, 'RETURNED', NULL, NULL, 'Pending'),
(96, 5, 'soham.personal02@gmail.com', 'Delhi', '2025-03-17', 2, 1234567890, 'Akola', '2025-03-19', 2000, 'Rejected', NULL, NULL, 'Pending'),
(99, 15, 'soham.personal02@gmail.com', 'Bhosari', '2025-03-18', 6, 545453564656, 'Rajasthan ', '2025-03-27', 3500, 'Rejected', '14:21:00', '20:21:00', 'Pending'),
(102, 2, 'soham.personal02@gmail.com', 'Pune', '2025-03-19', 4, 7020841171, 'Amravati', '2025-03-23', 12000, 'UNDER PROCESSING', '03:17:00', '01:16:00', 'Pending'),
(103, 15, 'soham.personal02@gmail.com', 'Pune', '2025-03-19', 2, 7020841171, 'Amravati', '2025-03-21', 3500, 'UNDER PROCESSING', '06:27:00', '03:25:00', 'Pending'),
(106, 12, 'soham.personal02@gmail.com', 'Pune', '2025-03-20', 2, 7020841171, 'Amravati', '2025-03-21', 4000, 'UNDER PROCESSING', '16:16:00', '17:18:00', 'Paid'),
(107, 8, 'soham.personal02@gmail.com', 'Pune', '2025-03-20', 2, 7020841171, 'Chennai', '2025-03-22', 1500, 'UNDER PROCESSING', '16:23:00', '13:24:00', 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `CAR_ID` int(11) NOT NULL,
  `CAR_NAME` varchar(255) NOT NULL,
  `FUEL_TYPE` varchar(255) NOT NULL,
  `CAPACITY` int(11) NOT NULL,
  `PRICE` int(11) NOT NULL,
  `CAR_IMG` varchar(255) NOT NULL,
  `AVAILABLE` varchar(255) NOT NULL,
  `CAR_TYPE` enum('Large','Small','Premium') NOT NULL,
  `TRANSMISSION` enum('Manual','Automatic') NOT NULL,
  `MILEAGE` float DEFAULT NULL,
  `DEPOSITE_SECURITY` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`CAR_ID`, `CAR_NAME`, `FUEL_TYPE`, `CAPACITY`, `PRICE`, `CAR_IMG`, `AVAILABLE`, `CAR_TYPE`, `TRANSMISSION`, `MILEAGE`, `DEPOSITE_SECURITY`) VALUES
(1, 'FERRAI', 'PETROL', 2, 10000, 'ferrari.jpg', 'Y', 'Premium', 'Manual', 8.77, 2500),
(2, 'LAMBORGINI', 'Disel', 2, 12000, 'lamborghini.webp', 'Y', 'Premium', 'Automatic', 8.62, 5000),
(3, 'PORSCHE', 'Petrol', 2, 10000, 'IMG-672f639c26d598.30628388.jpg', 'Y', 'Premium', 'Automatic', 7.4, 2500),
(4, 'BMW', 'Disel', 4, 7500, 'IMG-672f65396d2667.34254433.jpg', 'Y', 'Premium', 'Manual', 10.13, 1300),
(5, 'Suzuki Swift', 'Petrol', 5, 2000, 'IMG-672f6563a5cd41.62835718.jpg', 'Y', 'Small', 'Manual', 24.8, 750),
(6, 'Suzuki Ciaz', 'Petrol', 5, 1500, 'IMG-672f65868c6078.65393954.jpg', 'Y', 'Small', 'Manual', 20.5, 400),
(7, 'BMW 720', 'Petrol', 4, 4000, 'IMG-67b20e26493261.17516385.jpg', 'Y', 'Premium', 'Automatic', 12.61, 850),
(8, 'Alto K10', 'Petrol', 5, 1500, 'IMG-67d2ffd01bc111.00723073.jpg', 'Y', 'Small', 'Manual', 24.39, 450),
(9, 'Ertiga', 'Diesel', 7, 3000, 'IMG-67d3001a5ad005.76427664.jpg', 'Y', 'Large', 'Manual', 20.5, 650),
(10, 'Toyota Fortuner', 'Diesel', 7, 3500, 'IMG-67d3003a022210.78911246.jpg', 'Y', 'Large', 'Manual', 12.61, 700),
(11, 'Hyundai i10', 'Petrol', 4, 2500, 'IMG-67d30071259c89.38091754.jpg', 'Y', 'Small', 'Manual', 20.3, 600),
(12, 'Toyota Innova', 'Diesel', 7, 4000, 'IMG-67d300a16ff365.82746480.jpg', 'Y', 'Large', 'Manual', 13, 750),
(13, 'Range Rover Velar', 'Diesel', 4, 8500, 'IMG-67d300cf4898e6.23174504.jpg', 'Y', 'Premium', 'Manual', 15.8, 1800),
(14, 'Mahindra Scorpio ', 'Diesel', 8, 4500, 'IMG-67d300e9962ca6.96294090.webp', 'Y', 'Large', 'Automatic', 15.4, 7500),
(15, 'Mahindra XUV 700', 'Petrol', 7, 3500, 'IMG-67d3010819fea6.62922718.jpg', 'Y', 'Large', 'Automatic', 13.2, 650),
(37, 'Tata Punch', 'Petrol', 4, 2000, 'IMG-67d84a114f43a7.42074537.jpeg', 'Y', 'Small', 'Manual', 19, 750);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `FED_ID` int(11) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `COMMENT` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`FED_ID`, `EMAIL`, `COMMENT`) VALUES
(11, 'embomber.2022@gmail.com', 'Very Good!    :)'),
(12, 'soham.personal02@gmail.com', 'mast mast ');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `PAY_ID` int(11) NOT NULL,
  `BOOK_ID` int(11) NOT NULL,
  `CARD_NO` varchar(255) NOT NULL,
  `EXP_DATE` varchar(255) NOT NULL,
  `CVV` int(11) NOT NULL,
  `PRICE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`PAY_ID`, `BOOK_ID`, `CARD_NO`, `EXP_DATE`, `CVV`, `PRICE`) VALUES
(27, 86, '1234567898765432', '12/26', 123, 6000),
(28, 87, '1234567898765432', '12/25', 456, 6000),
(31, 90, '9876543212345678', '04/27', 456, 3000),
(32, 92, '', '', 0, 22500),
(33, 94, '', '', 0, 5000),
(41, 106, 'Razorpay', 'N/A', 0, 8000),
(42, 107, 'Razorpay', 'N/A', 0, 3000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `FNAME` varchar(255) NOT NULL,
  `LNAME` varchar(255) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `LIC_NUM` varchar(255) NOT NULL,
  `PHONE_NUMBER` bigint(11) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `GENDER` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`FNAME`, `LNAME`, `EMAIL`, `LIC_NUM`, `PHONE_NUMBER`, `PASSWORD`, `GENDER`) VALUES
('Siddhesh', 'Sapkale', 'embomber.2022@gmail.com', 'MH12FZ9693', 9090909090, '024d9fd79fdeaab91edae1f93df8e2b4', 'male'),
('Channveer', 'Mulge', 'mulgechannveer@gmail.com', 'MH14FZ9695', 7020841171, 'c98c99f5d9050b089e2b8620cef46cae', 'male'),
('Soham', 'Shirke', 'soham.personal02@gmail.com', 'MH12JK1234', 123456789, '49028f5661ec7ccda21928d265fef961', 'male');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ADMIN_ID`),
  ADD UNIQUE KEY `ADMIN_EMAIL` (`ADMIN_EMAIL`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`BOOK_ID`),
  ADD KEY `CAR_ID` (`CAR_ID`),
  ADD KEY `EMAIL` (`EMAIL`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`CAR_ID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`FED_ID`),
  ADD KEY `TEST` (`EMAIL`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`PAY_ID`),
  ADD UNIQUE KEY `BOOK_ID` (`BOOK_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`EMAIL`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `BOOK_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `CAR_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `FED_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `PAY_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`CAR_ID`) REFERENCES `cars` (`CAR_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`EMAIL`) REFERENCES `users` (`EMAIL`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `TEST` FOREIGN KEY (`EMAIL`) REFERENCES `users` (`EMAIL`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`BOOK_ID`) REFERENCES `booking` (`BOOK_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
