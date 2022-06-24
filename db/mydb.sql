-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2022 at 10:11 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--
use  mydb;


CREATE TABLE `administrator` (
  `idAdministrator` int(11) NOT NULL,
  `Administrator_username` varchar(45) NOT NULL,
  `Admin_supervisor` tinyint(4) NOT NULL,
  `Admin_password` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `Feedback_ID` int(11) NOT NULL,
  `Feedback_rating` int(11) DEFAULT NULL,
  `User_idUser` int(11) NOT NULL,
  `Feedback_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `idItem` int(11) NOT NULL,
  `Item_name` varchar(45) DEFAULT NULL,
  `Item_description` varchar(45) DEFAULT NULL,
  `Item_price` int(11) DEFAULT NULL,
  `Item_image` mediumtext DEFAULT NULL,
  `Menu_idMenu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`idItem`, `Item_name`, `Item_description`, `Item_price`, `Item_image`, `Menu_idMenu`) VALUES
(1, 'Margherita', 'Tomato sauce, Mozzarella, Basil', 12, 'upload\\images\\margherita.jpeg', 1),
(2, 'Water', 'Water bottle 0.5L', 1, 'upload\\images\\water.jpg', 3),
(3, 'Pepsi', 'Pepsi can 350ml', 2, 'upload\\images\\pepsi.jpg', 3),
(4, 'Miranda', 'Miranda can 350ml', 2, 'upload\\images\\miranda.jpg', 3),
(5, '7up', '7up can 350ml', 2, 'upload\\images\\7up.jpeg', 3),
(6, 'pepperoni', 'pepperoni and cheese', 10, 'upload\\images\\pepperoni.jpeg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `idMenu` int(11) NOT NULL,
  `Menu_name` varchar(45) NOT NULL,
  `menu_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`idMenu`, `Menu_name`, `menu_image`) VALUES
(1, 'Pizza', 'upload\\images\\pizza-cover.jpg'),
(2, 'Snacks', 'upload\\images\\snacks-cover.jpeg'),
(3, 'Drinks', 'upload\\images\\drinks-cover.jpg'),
(4, 'Salads', 'upload\\images\\salads-cover.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `Offer_ID` int(11) NOT NULL,
  `Offer_name` varchar(45) DEFAULT NULL,
  `offer_discount` float DEFAULT NULL,
  `Offer_duration` int(11) DEFAULT NULL,
  `Item_idItem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`Offer_ID`, `Offer_name`, `offer_discount`, `Offer_duration`, `Item_idItem`) VALUES
(1, 'Margherita day', 0.2, 1, 1),
(2, 'Peroni', 0.1, 2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `Reservation_ID` int(11) NOT NULL,
  `Reservation_time` datetime NOT NULL,
  `Reservation_count` int(11) NOT NULL,
  `User_idUser` int(11) NOT NULL,
  `User_username` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `idUser` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`idUser`, `username`, `first_name`, `last_name`, `phone`, `email`) VALUES
(1, 'ahmad33', 'ahmad', 'laees', '70600800', 'xyz@hotmail.com'),
(2, 'weam19', 'weam', 'haleemi', '70601801', 'ttv@hotmail.com'),
(3, 'sainzferrari', 'carlos', 'sainz', '71403500', 'csz@hotmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`idAdministrator`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`Feedback_ID`),
  ADD KEY `fk_Feedbacks_User1` (`User_idUser`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`idItem`),
  ADD KEY `fk_Item_Menu1` (`Menu_idMenu`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`idMenu`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`Offer_ID`),
  ADD KEY `fk_Offers_Item1` (`Item_idItem`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`Reservation_ID`),
  ADD KEY `fk_Reservations_User1` (`User_idUser`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `idAdministrator` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `Feedback_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `idItem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `idMenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `Offer_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `Reservation_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD CONSTRAINT `fk_Feedbacks_User1` FOREIGN KEY (`User_idUser`) REFERENCES `user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `fk_Item_Menu1` FOREIGN KEY (`Menu_idMenu`) REFERENCES `menu` (`idMenu`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `fk_Offers_Item1` FOREIGN KEY (`Item_idItem`) REFERENCES `item` (`idItem`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `fk_Reservations_User1` FOREIGN KEY (`User_idUser`) REFERENCES `user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
