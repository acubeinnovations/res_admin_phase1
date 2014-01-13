-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 13, 2014 at 12:29 PM
-- Server version: 5.5.34
-- PHP Version: 5.3.10-1ubuntu3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `restaurant_admin`
--

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`id`, `username`, `password`, `emailid`, `registrationdate`, `lastlogin`, `image`, `securityquestion_id`, `answer`, `created`, `updated`, `record_user_id`) VALUES
(1, 'admin', '39bb37cf36d3b29a9280d8a70a0eed42', NULL, NULL, '2013-12-17 19:15:25', NULL, NULL, NULL, '2013-04-22 00:00:00', NULL, NULL);

--
-- Dumping data for table `bill_item_statuses`
--

INSERT INTO `bill_item_statuses` (`id`, `name`) VALUES
(1, 'Active'),
(2, 'Cancelled'),
(3, 'Rejected by Customer');

--
-- Dumping data for table `bill_kitchen_statuses`
--

INSERT INTO `bill_kitchen_statuses` (`id`, `name`) VALUES
(1, 'To Kitchen'),
(2, 'Accept'),
(3, 'Reject'),
(4, 'Finished');

--
-- Dumping data for table `bill_statuses`
--

INSERT INTO `bill_statuses` (`id`, `name`) VALUES
(1, 'Billed'),
(2, 'Paid'),
(3, 'Cancelled'),
(4, 'Booked'),
(5, 'Hold');

--
-- Dumping data for table `contenttypes`
--

INSERT INTO `contenttypes` (`id`, `name`, `description`) VALUES
(1, 'HTML', 'Html Editor'),
(2, 'TEXT', 'No Html Editor');

--
-- Dumping data for table `counters`
--

INSERT INTO `counters` (`id`, `username`, `password`, `name`, `image`, `securityquestion_id`, `answer`, `lastlogin`, `last_bill_number`, `status_id`, `created`, `updated`) VALUES
(1, 'counter', '39bb37cf36d3b29a9280d8a70a0eed42', 'Counter 1', NULL, NULL, NULL, '2013-12-17 19:14:43', 0, 0, '2013-12-02 00:00:00', '0000-00-00 00:00:00');

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `item_category_id`, `rate`, `tax`, `status_id`, `from_master_kitchen`, `packing_id`) VALUES
(1, 'Tea', 1, 25, 2, 1, 0, 0),
(2, 'Coffee', 1, 30, 5, 1, 0, 0),
(3, 'Fried Rice  (veg)', 3, 150, 25, 1, 0, 0),
(4, 'Fried Rice  (Chicken)', 3, 200, 30, 1, 0, 0),
(5, 'Fried Rice  (Mixed)', 3, 190, 25, 1, 0, 0),
(6, 'Fresh Lime', 1, 25, 5, 1, 0, 0);

--
-- Dumping data for table `item_categories`
--

INSERT INTO `item_categories` (`id`, `name`, `status_id`, `parent_id`) VALUES
(1, 'Beverages', 1, -1),
(2, 'European', 1, -1),
(3, 'Chinese', 1, -1);

--
-- Dumping data for table `kitchen`
--

INSERT INTO `kitchen` (`id`, `counter_id`, `username`, `password`, `name`, `image`, `securityquestion_id`, `answer`, `lastlogin`, `last_bill_number`, `status_id`, `created`, `updated`) VALUES
(1, NULL, 'master', '39bb37cf36d3b29a9280d8a70a0eed42', 'Master Kitchen', NULL, NULL, NULL, '2014-01-13 12:19:31', 0, 0, '2013-12-02 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 'kitchen', '39bb37cf36d3b29a9280d8a70a0eed42', 'Master Kitchen', NULL, NULL, NULL, '2014-01-13 12:16:29', 0, 0, '2013-12-02 00:00:00', '0000-00-00 00:00:00');

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `publish`) VALUES
(1, 'English', 1);

--
-- Dumping data for table `packing`
--

INSERT INTO `packing` (`id`, `name`, `rate`) VALUES
(1, 'Small Container', 5),
(2, 'Large Container', 10),
(3, 'Juice Container', 3);

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `name`) VALUES
(1, 'Active'),
(2, 'Inactive');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
