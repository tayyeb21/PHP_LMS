-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2020 at 01:56 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_authors`
--

CREATE TABLE `tbl_authors` (
  `auth_id` int(10) NOT NULL,
  `auth_name` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_authors`
--

INSERT INTO `tbl_authors` (`auth_id`, `auth_name`) VALUES
(1, 'E-Balaguru Sami'),
(2, 'Marshall'),
(3, 'Bk Kumawat'),
(4, 'ravi Jain'),
(5, 'dinesh'),
(6, 'Sheetanshu Rajoriya'),
(7, 'Morris Mano');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_books`
--

CREATE TABLE `tbl_books` (
  `book_id` int(10) NOT NULL,
  `book_name` varchar(50) NOT NULL,
  `auth_id` int(10) NOT NULL,
  `pub_id` int(10) NOT NULL,
  `book_price` varchar(10) NOT NULL,
  `book_pages` varchar(10) NOT NULL,
  `book_code` varchar(10) NOT NULL,
  `book_language` varchar(8) NOT NULL,
  `no_of_books` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_books`
--

INSERT INTO `tbl_books` (`book_id`, `book_name`, `auth_id`, `pub_id`, `book_price`, `book_pages`, `book_code`, `book_language`, `no_of_books`) VALUES
(1, 'Programmin with C', 4, 3, '300', '800', 'bkb-1024', 'English', '1'),
(2, 'RDBMS Oracle', 5, 4, '700', '900', 'bkb-2512', 'English', '1'),
(3, 'PHP', 1, 1, '1000', '1500', 'bkb-2124', 'English', '5'),
(4, 'System Analysis And Design', 6, 3, '140', '199', 'bkb-1584', 'English', '1'),
(5, 'Programmin with Java', 1, 11, '500', '350', 'bkb-5617', 'English', '5');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_class`
--

CREATE TABLE `tbl_class` (
  `class_id` int(10) NOT NULL,
  `class_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_class`
--

INSERT INTO `tbl_class` (`class_id`, `class_name`) VALUES
(1, 'Bachelors of Computer Application'),
(2, 'Masters In Computer Application'),
(3, 'Bachelors of Science (Cs).'),
(4, 'Masters of Science'),
(5, 'Bachelors of Commerce (Computer)');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_issue`
--

CREATE TABLE `tbl_issue` (
  `issue_id` int(10) NOT NULL,
  `stud_id` int(10) NOT NULL,
  `book_id` int(10) NOT NULL,
  `issue_date` varchar(14) NOT NULL,
  `issue_return_date` varchar(14) NOT NULL,
  `issue_returned_or_not` int(2) NOT NULL,
  `issue_fine_or_not` int(2) NOT NULL,
  `issue_fine_amount` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_issue`
--

INSERT INTO `tbl_issue` (`issue_id`, `stud_id`, `book_id`, `issue_date`, `issue_return_date`, `issue_returned_or_not`, `issue_fine_or_not`, `issue_fine_amount`) VALUES
(1, 3, 2, '20180528120500', '20180612120600', 1, 0, '0'),
(3, 2, 4, '20180601120600', '20180616120600', 1, 1, '100'),
(5, 1, 3, '20180605120600', '20180620120600', 0, 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pub`
--

CREATE TABLE `tbl_pub` (
  `pub_id` int(10) NOT NULL,
  `pub_name` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pub`
--

INSERT INTO `tbl_pub` (`pub_id`, `pub_name`) VALUES
(1, 'Pearson'),
(3, 'Kamal Prakashan'),
(4, 'Pragya'),
(5, 'Dreamtech Press'),
(6, 'Bpb Publication.'),
(7, 'Vikas Publishing House Pvt. Ltd.'),
(8, 'dreamtech'),
(9, 'TMH Publication'),
(10, 'Gupta Publishing House'),
(11, 'BMP Publication');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student`
--

CREATE TABLE `tbl_student` (
  `stud_id` int(10) NOT NULL,
  `stud_name` varchar(70) NOT NULL,
  `stud_father` varchar(70) NOT NULL,
  `stud_dob` varchar(14) NOT NULL,
  `stud_photo` varchar(150) NOT NULL,
  `stud_lib_card_no` varchar(10) NOT NULL,
  `class_id` int(10) NOT NULL,
  `stud_semester` varchar(14) NOT NULL,
  `stud_year` varchar(12) NOT NULL,
  `stud_gender` varchar(12) NOT NULL,
  `stud_mobile` varchar(10) NOT NULL,
  `stud_fine_amount` varchar(10) NOT NULL,
  `stud_email` varchar(120) DEFAULT NULL,
  `stud_address` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_student`
--

INSERT INTO `tbl_student` (`stud_id`, `stud_name`, `stud_father`, `stud_dob`, `stud_photo`, `stud_lib_card_no`, `class_id`, `stud_semester`, `stud_year`, `stud_gender`, `stud_mobile`, `stud_fine_amount`, `stud_email`, `stud_address`) VALUES
(1, 'abdul tayyeb', 'fakhruddin', '19990302120000', 'StudentsPhotos/7898633445/myimg - Page 1.jpg', 'bu-2249', 1, 'IVth Semester', 'IInd Year', 'Male', '7898633445', '0', 'abc@example.com', 'neemuch '),
(2, 'Mohammed', 'Hussain', '19980904120000', '', 'bu-2250', 2, 'IVth Semester', 'IInd Year', 'Male', '9851845151', '0', 'abc@example.com', 'neemuch'),
(3, ' Navin Mali', 'Hiralal ji mali', '19981205120000', '', 'bu-2280', 3, 'IVth Semester', 'IInd Year', 'Male', '7895544545', '0', 'abc@example.com', 'neemuch'),
(6, 'Gaurav Dhangar', 'Premchandra', '19980325120000', '', 'bu-2250', 1, 'Vth Semester', 'IIIrd Year', 'Male', '8745454544', '0', 'abc@example.com', 'neemuch');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction`
--

CREATE TABLE `tbl_transaction` (
  `tr_id` int(10) NOT NULL,
  `tr_date` varchar(14) NOT NULL,
  `tr_particular` varchar(50) NOT NULL,
  `tr_amount` varchar(10) NOT NULL,
  `tr_type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transaction`
--

INSERT INTO `tbl_transaction` (`tr_id`, `tr_date`, `tr_particular`, `tr_amount`, `tr_type`) VALUES
(1, '20180527120500', 'Fine Received', '150', 1),
(2, '20180527120500', 'Amount Transfered to Account Department', '120', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(10) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_password` varchar(16) NOT NULL,
  `user_full_name` varchar(70) NOT NULL,
  `user_photo` varchar(150) NOT NULL,
  `user_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `user_password`, `user_full_name`, `user_photo`, `user_type`) VALUES
(1, 'admin', 'admin', 'Admin', '', 'administrator'),
(3, 'USER', '123456', 'JUNIOR LIBRARIAN', '', 'USER');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_authors`
--
ALTER TABLE `tbl_authors`
  ADD PRIMARY KEY (`auth_id`);

--
-- Indexes for table `tbl_books`
--
ALTER TABLE `tbl_books`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `auth_id` (`auth_id`),
  ADD KEY `pub_id` (`pub_id`);

--
-- Indexes for table `tbl_class`
--
ALTER TABLE `tbl_class`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `tbl_issue`
--
ALTER TABLE `tbl_issue`
  ADD PRIMARY KEY (`issue_id`),
  ADD KEY `stud_id` (`stud_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `tbl_pub`
--
ALTER TABLE `tbl_pub`
  ADD PRIMARY KEY (`pub_id`);

--
-- Indexes for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD PRIMARY KEY (`stud_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  ADD PRIMARY KEY (`tr_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_authors`
--
ALTER TABLE `tbl_authors`
  MODIFY `auth_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_books`
--
ALTER TABLE `tbl_books`
  MODIFY `book_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_class`
--
ALTER TABLE `tbl_class`
  MODIFY `class_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_issue`
--
ALTER TABLE `tbl_issue`
  MODIFY `issue_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_pub`
--
ALTER TABLE `tbl_pub`
  MODIFY `pub_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_student`
--
ALTER TABLE `tbl_student`
  MODIFY `stud_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  MODIFY `tr_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_books`
--
ALTER TABLE `tbl_books`
  ADD CONSTRAINT `tbl_books_ibfk_1` FOREIGN KEY (`auth_id`) REFERENCES `tbl_authors` (`auth_id`),
  ADD CONSTRAINT `tbl_books_ibfk_2` FOREIGN KEY (`pub_id`) REFERENCES `tbl_pub` (`pub_id`);

--
-- Constraints for table `tbl_issue`
--
ALTER TABLE `tbl_issue`
  ADD CONSTRAINT `tbl_issue_ibfk_1` FOREIGN KEY (`stud_id`) REFERENCES `tbl_student` (`stud_id`),
  ADD CONSTRAINT `tbl_issue_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `tbl_books` (`book_id`),
  ADD CONSTRAINT `tbl_issue_ibfk_3` FOREIGN KEY (`book_id`) REFERENCES `tbl_books` (`book_id`);

--
-- Constraints for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD CONSTRAINT `tbl_student_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `tbl_class` (`class_id`),
  ADD CONSTRAINT `tbl_student_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `tbl_class` (`class_id`),
  ADD CONSTRAINT `tbl_student_ibfk_3` FOREIGN KEY (`class_id`) REFERENCES `tbl_class` (`class_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
