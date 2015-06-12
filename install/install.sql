-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 08, 2015 at 09:19 AM
-- Server version: 5.5.40-MariaDB-cll-lve
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cloudbase`
--

-- --------------------------------------------------------

--
-- Table structure for table `aerotow`
--

CREATE TABLE IF NOT EXISTS `aerotow` (
  `svc_id` int(15) NOT NULL,
  `aerotow_miles` float NOT NULL,
  `aerotow_pickup` varchar(32) NOT NULL,
  PRIMARY KEY (`svc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `business_rule`
--

CREATE TABLE IF NOT EXISTS `business_rule` (
  `br_svctype` varchar(32) NOT NULL,
  `br_rule` varchar(32) NOT NULL,
  `br_value` int(15) NOT NULL,
  PRIMARY KEY (`br_svctype`,`br_rule`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `business_rule`
--

INSERT INTO `business_rule` (`br_svctype`, `br_rule`, `br_value`) VALUES
('aerotow', 'cost_mile', 200),
('aerotow', 'min_cost', 3700),
('ropebreak', 'cost', 1000),
('soar', 'basetow_cost', 1700),
('soar', 'basetow_ft', 1000),
('soar', 'cost_100ft', 100);

-- --------------------------------------------------------

--
-- Table structure for table `engined_rental`
--

CREATE TABLE IF NOT EXISTS `engined_rental` (
  `plane_id` int(15) NOT NULL,
  `er_employeecost` decimal(15,0) NOT NULL,
  `er_customercost` decimal(15,0) NOT NULL,
  PRIMARY KEY (`plane_id`),
  KEY `plane_id` (`plane_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `flight`
--

CREATE TABLE IF NOT EXISTS `flight` (
  `flight_id` int(15) NOT NULL AUTO_INCREMENT,
  `plane_id` int(15) NOT NULL,
  `svc_id` int(15) NOT NULL,
  `flight_takeoff` time NOT NULL,
  `flight_landing` time NOT NULL,
  `flight_type` varchar(15) NOT NULL,
  PRIMARY KEY (`flight_id`),
  KEY `plane_id` (`plane_id`),
  KEY `svc_id` (`svc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=92 ;

-- --------------------------------------------------------

--
-- Table structure for table `flight_role`
--

CREATE TABLE IF NOT EXISTS `flight_role` (
  `flight_id` int(15) NOT NULL,
  `role_id` int(15) NOT NULL,
  `role_type` varchar(32) NOT NULL,
  PRIMARY KEY (`flight_id`,`role_id`,`role_type`),
  KEY `role_id` (`role_id`),
  KEY `role_type` (`role_type`),
  KEY `role_id_2` (`role_id`),
  KEY `role_type_2` (`role_type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `glider`
--

CREATE TABLE IF NOT EXISTS `glider` (
  `plane_id` int(15) NOT NULL,
  `glider_hourcost` decimal(15,0) NOT NULL,
  `glider_minutecost` decimal(15,0) NOT NULL,
  `glider_seats` int(1) NOT NULL,
  PRIMARY KEY (`plane_id`),
  KEY `plane_id` (`plane_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `pay_id` int(15) NOT NULL AUTO_INCREMENT,
  `person_id` int(15) NOT NULL,
  `svc_id` int(15) NOT NULL,
  `pay_method` varchar(32) NOT NULL,
  `pay_amount` float NOT NULL,
  `pay_date` date NOT NULL,
  PRIMARY KEY (`pay_id`,`svc_id`),
  KEY `svc_id` (`svc_id`),
  KEY `person_id` (`person_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE IF NOT EXISTS `person` (
  `person_id` int(15) NOT NULL AUTO_INCREMENT,
  `person_fname` varchar(32) NOT NULL,
  `person_mname` varchar(32) NOT NULL,
  `person_lname` varchar(32) NOT NULL,
  PRIMARY KEY (`person_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `plane`
--

CREATE TABLE IF NOT EXISTS `plane` (
  `plane_id` int(15) NOT NULL AUTO_INCREMENT,
  `plane_model` varchar(32) NOT NULL,
  `plane_name` varchar(32) NOT NULL,
  `plane_active` tinyint(1) NOT NULL,
  `plane_owner` varchar(32) NOT NULL,
  `plane_type` varchar(32) NOT NULL,
  `plane_serial` varchar(16) NOT NULL,
  PRIMARY KEY (`plane_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Table structure for table `plane_rental`
--

CREATE TABLE IF NOT EXISTS `plane_rental` (
  `svc_id` int(15) NOT NULL,
  `pr_tach_hours` decimal(10,2) NOT NULL,
  `pr_member` tinyint(1) NOT NULL,
  PRIMARY KEY (`svc_id`),
  KEY `svc_id` (`svc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `person_id` int(15) NOT NULL,
  `role_type` varchar(32) NOT NULL,
  `role_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`person_id`,`role_type`),
  KEY `person_id` (`person_id`),
  KEY `role_type` (`role_type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rope_break`
--

CREATE TABLE IF NOT EXISTS `rope_break` (
  `svc_id` int(15) NOT NULL,
  `rb_sim` int(15) NOT NULL,
  PRIMARY KEY (`svc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE IF NOT EXISTS `service` (
  `svc_id` int(15) NOT NULL AUTO_INCREMENT,
  `svc_date` date NOT NULL,
  `svc_cost` int(15) NOT NULL,
  `svc_comment` text NOT NULL,
  `svc_type` varchar(32) NOT NULL,
  `svc_od` int(15) NOT NULL,
  `svc_altitude` int(15) NOT NULL,
  `svc_serial` varchar(32) NOT NULL,
  PRIMARY KEY (`svc_id`),
  KEY `svc_od` (`svc_od`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;

-- --------------------------------------------------------

--
-- Table structure for table `soar`
--

CREATE TABLE IF NOT EXISTS `soar` (
  `svc_id` int(15) NOT NULL,
  `soar_altitude` int(15) NOT NULL,
  `soar_penalty` float NOT NULL,
  `soar_passenger` int(15) NOT NULL,
  PRIMARY KEY (`svc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(15) NOT NULL AUTO_INCREMENT,
  `user_uname` varchar(32) NOT NULL,
  `user_fname` varchar(32) NOT NULL,
  `user_mname` varchar(32) NOT NULL,
  `user_lname` varchar(32) NOT NULL,
  `user_hashedpwd` varchar(32) NOT NULL,
  `user_salt` int(32) NOT NULL,
  `user_admin` tinyint(1) NOT NULL,
  `user_email` varchar(32) NOT NULL,
  `user_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_uname`, `user_fname`, `user_mname`, `user_lname`, `user_hashedpwd`, `user_salt`, `user_admin`, `user_email`, `user_active`) VALUES
(4, 'admin', 'Admin', 'A', 'Admin', 'd8cbf48d119ff771bb4aa1778c5d7e52', 235003918, 1, 'test@test.com', 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_flights`
--
CREATE TABLE IF NOT EXISTS `view_flights` (
`flight_id` int(15)
,`svc_date` date
,`plane_serial` varchar(16)
,`plane_type` varchar(32)
,`flight_takeoff` time
,`flight_landing` time
,`duration` time
,`svc_cost` bigint(15)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `view_flightsheets`
--
CREATE TABLE IF NOT EXISTS `view_flightsheets` (
`svc_date` date
,`flight_takeoff` time
,`flight_landing` time
,`duration` time
,`plane_serial` varchar(16)
,`pilot` varchar(66)
,`svc_cost` varchar(67)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `view_pilots`
--
CREATE TABLE IF NOT EXISTS `view_pilots` (
`flight_id` int(15)
,`pilot` varchar(66)
);
-- --------------------------------------------------------

--
-- Structure for view `view_flights`
--
DROP TABLE IF EXISTS `view_flights`;

CREATE ALGORITHM=UNDEFINED DEFINER=`camba063`@`localhost` SQL SECURITY DEFINER VIEW `view_flights` AS select `flight`.`flight_id` AS `flight_id`,`service`.`svc_date` AS `svc_date`,`plane`.`plane_serial` AS `plane_serial`,`plane`.`plane_type` AS `plane_type`,`flight`.`flight_takeoff` AS `flight_takeoff`,`flight`.`flight_landing` AS `flight_landing`,(select timediff(`flight`.`flight_landing`,`flight`.`flight_takeoff`)) AS `duration`,(select if((`plane`.`plane_type` = 'tow'),(`service`.`svc_cost` = NULL),`service`.`svc_cost`)) AS `svc_cost` from ((`service` join `flight`) join `plane`) where ((`service`.`svc_id` = `flight`.`svc_id`) and (`flight`.`plane_id` = `plane`.`plane_id`) and (`flight`.`flight_landing` <> '00:00:00'));

-- --------------------------------------------------------

--
-- Structure for view `view_flightsheets`
--
DROP TABLE IF EXISTS `view_flightsheets`;

CREATE ALGORITHM=UNDEFINED DEFINER=`camba063`@`localhost` SQL SECURITY DEFINER VIEW `view_flightsheets` AS select `view_flights`.`svc_date` AS `svc_date`,`view_flights`.`flight_takeoff` AS `flight_takeoff`,`view_flights`.`flight_landing` AS `flight_landing`,`view_flights`.`duration` AS `duration`,`view_flights`.`plane_serial` AS `plane_serial`,`view_pilots`.`pilot` AS `pilot`,concat('$',format((`view_flights`.`svc_cost` / 100),2)) AS `svc_cost` from (`view_flights` left join `view_pilots` on((`view_flights`.`flight_id` = `view_pilots`.`flight_id`)));

-- --------------------------------------------------------

--
-- Structure for view `view_pilots`
--
DROP TABLE IF EXISTS `view_pilots`;

CREATE ALGORITHM=UNDEFINED DEFINER=`camba063`@`localhost` SQL SECURITY DEFINER VIEW `view_pilots` AS select `flight_role`.`flight_id` AS `flight_id`,concat_ws(', ',`person`.`person_lname`,`person`.`person_fname`) AS `pilot` from (`person` join `flight_role`) where (`person`.`person_id` = `flight_role`.`role_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aerotow`
--
ALTER TABLE `aerotow`
  ADD CONSTRAINT `aerotow_svc_id` FOREIGN KEY (`svc_id`) REFERENCES `service` (`svc_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `engined_rental`
--
ALTER TABLE `engined_rental`
  ADD CONSTRAINT `er_plane_id` FOREIGN KEY (`plane_id`) REFERENCES `plane` (`plane_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `flight`
--
ALTER TABLE `flight`
  ADD CONSTRAINT `flight_plane_id` FOREIGN KEY (`plane_id`) REFERENCES `plane` (`plane_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `flight_svc_id` FOREIGN KEY (`svc_id`) REFERENCES `service` (`svc_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `flight_role`
--
ALTER TABLE `flight_role`
  ADD CONSTRAINT `fr_role_id` FOREIGN KEY (`role_id`) REFERENCES `role` (`person_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `glider`
--
ALTER TABLE `glider`
  ADD CONSTRAINT `glider_plane_id` FOREIGN KEY (`plane_id`) REFERENCES `plane` (`plane_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `plane_rental`
--
ALTER TABLE `plane_rental`
  ADD CONSTRAINT `pr_svc_id` FOREIGN KEY (`svc_id`) REFERENCES `service` (`svc_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `role`
--
ALTER TABLE `role`
  ADD CONSTRAINT `role_person_id` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `rope_break`
--
ALTER TABLE `rope_break`
  ADD CONSTRAINT `rb_svc_id` FOREIGN KEY (`svc_id`) REFERENCES `service` (`svc_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `svc_person_id` FOREIGN KEY (`svc_od`) REFERENCES `person` (`person_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `soar`
--
ALTER TABLE `soar`
  ADD CONSTRAINT `soar_svc_id` FOREIGN KEY (`svc_id`) REFERENCES `service` (`svc_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
