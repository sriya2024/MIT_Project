-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2024 at 08:57 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wcvfeis`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `bookingId` int(11) NOT NULL,
  `bookingDate` date NOT NULL,
  `timeSlot` varchar(200) NOT NULL,
  `bStatus` varchar(200) NOT NULL,
  `bConfirm` varchar(200) NOT NULL,
  `cusId` int(11) NOT NULL,
  `garageId` int(11) NOT NULL,
  `vehiId` int(11) NOT NULL,
  `payId` int(11) NOT NULL,
  `pStatus` varchar(200) NOT NULL,
  `vehiInspection` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`bookingId`, `bookingDate`, `timeSlot`, `bStatus`, `bConfirm`, `cusId`, `garageId`, `vehiId`, `payId`, `pStatus`, `vehiInspection`) VALUES
(1, '2024-03-15', '8:00 AM - 8:30 AM', 'Complete', '0', 1, 1, 1, 1, 'Complete', 'Pass'),
(15, '2024-03-27', '8:00 AM - 8:30 AM', 'Complete', '0', 1, 3, 6, 6, 'Complete', 'Pass'),
(16, '2024-03-28', '11:30 AM - 12:00 PM', 'Complete', '0', 1, 1, 4, 7, 'Complete', 'Pass'),
(17, '2024-03-24', '8:00 AM - 8:30 AM', 'Complete', '0', 8, 1, 5, 8, 'Complete', 'Pass'),
(19, '2024-03-24', '10:30 AM - 11:00 AM', 'Complete', '0', 1, 1, 8, 9, 'Complete', 'Pass');

-- --------------------------------------------------------

--
-- Table structure for table `cancel_booking`
--

CREATE TABLE `cancel_booking` (
  `cancelId` int(11) NOT NULL,
  `bookingId` int(11) NOT NULL,
  `bookingDate` date NOT NULL,
  `timeSlot` time NOT NULL,
  `cusId` int(11) NOT NULL,
  `garageId` int(11) NOT NULL,
  `vehiId` int(11) NOT NULL,
  `payId` int(11) NOT NULL,
  `pStatus` varchar(200) NOT NULL,
  `cancelDate` date NOT NULL,
  `cancelBy` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cancel_booking`
--

INSERT INTO `cancel_booking` (`cancelId`, `bookingId`, `bookingDate`, `timeSlot`, `cusId`, `garageId`, `vehiId`, `payId`, `pStatus`, `cancelDate`, `cancelBy`) VALUES
(1, 2, '2024-03-29', '08:00:00', 1, 1, 4, 0, 'Pending', '2024-03-16', 'customer'),
(2, 2, '2024-03-29', '08:00:00', 1, 1, 4, 0, 'Pending', '2024-03-16', 'customer'),
(3, 3, '2024-03-29', '08:00:00', 1, 1, 4, 0, 'Pending', '2024-03-16', 'customer'),
(4, 4, '2024-03-27', '08:00:00', 1, 1, 4, 2, 'Complete', '2024-03-16', 'customer'),
(5, 5, '2024-03-29', '08:00:00', 1, 1, 4, 3, 'Complete', '2024-03-16', 'Hemasiri'),
(6, 5, '0000-00-00', '00:00:00', 1, 0, 0, 0, '', '2024-03-16', 'customer'),
(7, 6, '2024-03-20', '10:30:00', 1, 1, 4, 4, 'Complete', '2024-03-16', 'customer'),
(8, 7, '2024-03-22', '08:00:00', 1, 1, 4, 0, 'Pending', '2024-03-16', 'customer'),
(9, 8, '2024-03-28', '10:30:00', 1, 1, 4, 5, 'Complete', '2024-03-16', 'customer'),
(10, 9, '2024-03-27', '08:00:00', 1, 1, 4, 0, 'Pending', '2024-03-17', 'customer'),
(11, 10, '2024-03-27', '01:00:00', 1, 1, 4, 0, 'Pending', '2024-03-18', 'customer'),
(12, 11, '2024-03-19', '08:00:00', 1, 1, 6, 0, 'Pending', '2024-03-18', 'customer'),
(13, 12, '2024-03-19', '01:00:00', 1, 1, 4, 0, 'Pending', '2024-03-18', 'customer'),
(14, 13, '2024-03-27', '08:00:00', 1, 1, 6, 0, 'Pending', '2024-03-18', 'customer'),
(15, 14, '2024-03-19', '02:00:00', 1, 1, 4, 0, 'Pending', '2024-03-20', 'customer'),
(16, 18, '2024-03-24', '02:30:00', 1, 1, 8, 0, 'Pending', '2024-03-23', 'customer');

-- --------------------------------------------------------

--
-- Table structure for table `certifying_officer`
--

CREATE TABLE `certifying_officer` (
  `cofficerId` int(11) NOT NULL,
  `cofficerFname` varchar(200) NOT NULL,
  `cofficerLname` varchar(200) NOT NULL,
  `cofficerNic` int(100) NOT NULL,
  `cofficerPno` int(100) NOT NULL,
  `cofficeremail` varchar(200) NOT NULL,
  `garageId` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `certifying_officer`
--

INSERT INTO `certifying_officer` (`cofficerId`, `cofficerFname`, `cofficerLname`, `cofficerNic`, `cofficerPno`, `cofficeremail`, `garageId`) VALUES
(1, 'Hemasiri', 'Perera', 575524821, 771879517, 'hemasiri.kh@gmail.com', 1),
(2, 'Namal ', 'Dodangoda', 544785416, 715896547, 'dodangoda@gmail.com', 1),
(3, 'Kamal', 'Perera', 637120864, 778566112, 'kamal@gmail.com', 2),
(4, 'Harshana ', 'Kumara', 854712358, 775622114, 'harshana@gmail.com', 3);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cusId` int(11) NOT NULL,
  `cusFname` varchar(200) NOT NULL,
  `cusLname` varchar(200) NOT NULL,
  `cusNic` int(200) NOT NULL,
  `cusPno` int(200) NOT NULL,
  `cusEmail` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cusId`, `cusFname`, `cusLname`, `cusNic`, `cusPno`, `cusEmail`) VALUES
(1, 'Thilini', 'Radhika', 907120864, 776155771, 'radhika.trh@gmail.com'),
(2, 'Sriyalatha', 'Perera', 628745895, 776155771, 'sriyaperera2021@gmail.com'),
(3, 'Kamal', 'Perera', 907125847, 775844112, 'kamal@gmail.com'),
(4, 'janika', 'Perera', 896541274, 778744551, 'janika@gmail.com'),
(5, 'jayanika', 'Perera', 907120577, 778744551, 'jaa@gmail.com'),
(6, 'Ishara', 'perera', 888888888, 776455881, 'isha@gmail.com'),
(7, 'Chamara', 'Perera', 666666666, 779588441, 'chamara@gmail.com'),
(8, 'Supun ', 'Silva', 444444444, 775144778, 'supun@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `cus_login`
--

CREATE TABLE `cus_login` (
  `email` varchar(200) NOT NULL,
  `pwd` varchar(200) NOT NULL,
  `cusId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cus_login`
--

INSERT INTO `cus_login` (`email`, `pwd`, `cusId`) VALUES
('radhika.trh@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 1),
('sriyaperera2021@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 2),
('radhika.trh@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 1),
('sriyaperera2021@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 2),
('kamal@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 3),
('janika@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 4),
('jaa@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 5),
('isha@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 6),
('chamara@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 7),
('supun@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 8);

-- --------------------------------------------------------

--
-- Table structure for table `dmt_staff`
--

CREATE TABLE `dmt_staff` (
  `dmtStaffId` int(11) NOT NULL,
  `stfFname` varchar(200) NOT NULL,
  `stflLname` varchar(200) NOT NULL,
  `stfNic` int(200) NOT NULL,
  `stfRole` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dmt_staff`
--

INSERT INTO `dmt_staff` (`dmtStaffId`, `stfFname`, `stflLname`, `stfNic`, `stfRole`) VALUES
(1, 'Thanuja', 'Janika', 884124789, 'Commissioner'),
(2, 'Iresha', 'Wanaguru', 859541574, 'Subject Officer');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `faqId` int(11) NOT NULL,
  `faqQues` varchar(300) NOT NULL,
  `faqAns` varchar(900) NOT NULL,
  `addBy` varchar(100) NOT NULL,
  `addDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`faqId`, `faqQues`, `faqAns`, `addBy`, `addDate`) VALUES
(1, 'What are the Documents for Revenue License????', '   Registration Certificate of Vehicle or The Extract Containing Particulars of the Vehicle Issued by the Commissioner of Motor Traffic (CMT-76 or MTA-11 ) or Certified Photo Copy of C.R. Approved by Finance Organization.\r\nRevenue License of the Previous Year.\r\nValid Vehicle Insurance Policy Certificates.\r\nFitness Certificates for Commercial Vehicles.\r\nPassenger Service permits for Omni Bus.\r\nValid Emission certificate', 'Thanuja', '2024-03-22'),
(2, 'What are the Commercial Vehicles?', 'Motor Lorry\r\nPrivate Couches\r\nOmni Bus\r\nMotor tricycle van\r\nAmbulance\r\nHearse\r\n', 'Thanuja', '2024-02-13'),
(3, 'What are the Requirements for a Grade ‘A’ Motor Garage (Facilities)?', 'A pit 20 feet long, 21/2 feet deep or a ramp or a hoist offering similar facilities for inspection of motor vehicles.\r\nA taply meter or roller brake tester.\r\nEquipment or place together with a board to inspect head lamps.\r\nTesting lamp.\r\nSet of tools required for inspections. (This set should consist of spanners and tools of all standard sizes).\r\nAlignment gauge.\r\nElectrical and gas welding equipment.', 'Thanuja', '2024-02-13'),
(4, 'What are the requirement for Certifying officer and the staff?', 'National Diploma in Technology or junior Technical Officers’ Certificate in Mechanical Engineering ;or\r\nA Certificate in Technology issued by London City and Guilds Institution which is equivalent to (i) above; and Not less than two years practical experience in a recognized motor garage.(Persons with training aboard in motor engineering and those possessing the certificate in motor engineering issued by the Ceylon German Technical Training Institute with over 15 years experience in motor engineering in a government recognized institution will be considered  for exemption from the above requirements depending on their qualifications)\r\nCertifying Officer should hold a valid certificate of competency to drive heavy vehicles.\r\nCertifying officer shall be a permanent employee of the motor garage.\r\nThere shall be at least one manager in charge of the motor garage and such staff as may be requ', 'Thanuja', '2024-02-13'),
(5, 'Whate are Requirements for a Grade ‘B’ Motor Garage (Facilities)?', 'A pit 20 feet long, 21/2 feet wide and 41/2 feet deep or a ramp or a hoist offering similar facilities for inspection of motor vehicle.\r\nTapley instrument to test brakes.\r\nEquipment or place together with a board to inspect head lamps.\r\nSet of tools required for inspections,(This set shall consist of spanners and tools of all standard sizes)', 'Thanuja', '2024-02-13'),
(6, 'What are documents must be furnished with the applications?', 'A rough sketch showing the exact location of the garage and the road access from the city centre.\r\nPhotostat copies of certificates in respect of qualifications of the proposed certifying officers.\r\nPhotostat copy of the driving license.\r\nIn respect of motor garages already registered, the documents referred to in paragraph 1 and 2 above need not be sent unless there are changes in respect of the location of the garage or in respect of certifying officers.A cheque for a sum of Rs.250 drawn in favour of the Provincial Commissioner of Motor Traffic or the receipt issued by this office in proof of payment of that amount to this office, as a non refundable deposit.', 'Thanuja', '2024-02-13');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedbackId` int(11) NOT NULL,
  `description` varchar(500) NOT NULL,
  `feedbackBy` varchar(100) NOT NULL,
  `fdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedbackId`, `description`, `feedbackBy`, `fdate`) VALUES
(2, 'Good Service. ', 'Kumara Perera', '2023-12-15'),
(3, 'Highly Recommende. Great job on handling that customer’s issue quickly and professionally', 'Sadew', '2024-02-13');

-- --------------------------------------------------------

--
-- Table structure for table `fitness_certificate`
--

CREATE TABLE `fitness_certificate` (
  `fitnessId` int(11) NOT NULL,
  `certificateNo` varchar(200) NOT NULL,
  `descriptionVehi` varchar(200) NOT NULL,
  `makeVehi` varchar(200) NOT NULL,
  `tyerfrontSize` varchar(50) NOT NULL,
  `tyerrearSize` int(50) NOT NULL,
  `tyerRequir` varchar(200) NOT NULL,
  `NoAxles` int(50) NOT NULL,
  `typeBody` varchar(200) NOT NULL,
  `validUntill` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fitness_certificate`
--

INSERT INTO `fitness_certificate` (`fitnessId`, `certificateNo`, `descriptionVehi`, `makeVehi`, `tyerfrontSize`, `tyerrearSize`, `tyerRequir`, `NoAxles`, `typeBody`, `validUntill`) VALUES
(1, 'WP0001', 'Omnibus', 'Lorry', '750x15', 750, 'Dual', 4, 'Closed', '2023-03-01'),
(2, 'WP0002', 'Omnibus', 'Lorry', '750x15', 750, 'Dual', 4, 'Closed', '2023-07-25'),
(3, 'WP0003', 'Omnibus', 'Lorry', '20', 12, 'Dual', 4, 'Closed', '2024-05-18'),
(4, 'WP0004', 'Omnibus', 'Lorry', '750x15', 750, 'Dual', 4, 'Closed', '2024-05-16'),
(5, 'WP0005', 'Lorry', 'Lorry', '750x15', 750, 'Dual', 4, 'Closed', '2024-03-22');

-- --------------------------------------------------------

--
-- Table structure for table `garage`
--

CREATE TABLE `garage` (
  `garageId` int(200) NOT NULL,
  `garageName` varchar(200) NOT NULL,
  `gAddress` varchar(200) NOT NULL,
  `gPno` int(200) NOT NULL,
  `gDistrict` varchar(200) NOT NULL,
  `gCity` varchar(200) NOT NULL,
  `gEmail` varchar(200) NOT NULL,
  `regYear` int(200) NOT NULL,
  `registredBy` varchar(200) NOT NULL,
  `registredDate` date NOT NULL,
  `gStatus` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `garage`
--

INSERT INTO `garage` (`garageId`, `garageName`, `gAddress`, `gPno`, `gDistrict`, `gCity`, `gEmail`, `regYear`, `registredBy`, `registredDate`, `gStatus`) VALUES
(1, 'Magintha Mortors', '417, Old Kottawa Road, Udahamulla, Nugegoda', 112844578, 'Colombo', 'Nugegoda', 'magintha@gmail.com', 2024, 'Janika', '2024-03-16', 'Active'),
(2, 'Isuru Traders', '179, Hilevel Road, Galawilawatta, Homagama', 112555921, 'Colombo', 'Homagama', 'isuru@gmail.com', 2023, 'Janika', '2023-01-01', 'Active'),
(3, 'Nawinna Service Station', '68, Watamawatta, Wijwrama, Nugegoda', 11280304, 'Colombo', 'Nugegoda', 'nawinna@gmail.com', 2023, 'Janika', '2023-01-01', 'Active'),
(4, 'Disanayaka Service Center', '172, Dombawala, Udugampola', 33222552, 'Gampaha', 'Udugampola', 'disanayaka@gmail.com', 2023, 'Janika', '2024-03-16', 'Suspend');

-- --------------------------------------------------------

--
-- Table structure for table `garage_login`
--

CREATE TABLE `garage_login` (
  `email` varchar(200) NOT NULL,
  `pwd` varchar(200) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `garage_login`
--

INSERT INTO `garage_login` (`email`, `pwd`, `userId`) VALUES
('magintha@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 1),
('hemasiri.kh@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 2),
('dodangoda@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 3),
('isuru@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 4),
('kumara@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 5),
('', 'fbde62bbcd85d746e2de1695dd7571b5281807fe', 6),
('nawinna@gmail.com', 'fbde62bbcd85d746e2de1695dd7571b5281807fe', 7),
('harshana@gmail.com', '75e993842334cf4db1953cc8495c683ad524668a', 8),
('disanayaka@gmail.com', 'e1011645664d1e244a1d591fb46d1c9fad320b14', 9);

-- --------------------------------------------------------

--
-- Table structure for table `garage_owner`
--

CREATE TABLE `garage_owner` (
  `ownerId` int(11) NOT NULL,
  `ownerFname` varchar(200) NOT NULL,
  `ownerLname` varchar(200) NOT NULL,
  `ownerNic` int(100) NOT NULL,
  `ownerPno` int(100) NOT NULL,
  `garageId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `garage_owner`
--

INSERT INTO `garage_owner` (`ownerId`, `ownerFname`, `ownerLname`, `ownerNic`, `ownerPno`, `garageId`) VALUES
(1, 'Nihal', 'Magintha', 587458741, 778954712, 1),
(2, 'Wimal', 'Perera', 587120862, 778655214, 2),
(3, 'Susantha', 'Silva', 854125478, 756877112, 3),
(4, 'Gimhan', 'Kawshalya', 894125761, 782544113, 4);

-- --------------------------------------------------------

--
-- Table structure for table `garage_renew`
--

CREATE TABLE `garage_renew` (
  `renewId` int(50) NOT NULL,
  `garageId` int(50) NOT NULL,
  `requestYear` int(100) NOT NULL,
  `rStatus` varchar(100) NOT NULL,
  `pStatus` varchar(100) NOT NULL,
  `requstedBy` varchar(100) NOT NULL,
  `requestedDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `garage_renew`
--

INSERT INTO `garage_renew` (`renewId`, `garageId`, `requestYear`, `rStatus`, `pStatus`, `requstedBy`, `requestedDate`) VALUES
(1, 1, 2024, 'Complete', 'Complete', 'Nihal', '2024-03-16');

-- --------------------------------------------------------

--
-- Table structure for table `garage_role`
--

CREATE TABLE `garage_role` (
  `roleId` int(11) NOT NULL,
  `roleName` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `garage_role`
--

INSERT INTO `garage_role` (`roleId`, `roleName`) VALUES
(1, 'Garage Owner'),
(2, 'Certifying Officer');

-- --------------------------------------------------------

--
-- Table structure for table `garage_user`
--

CREATE TABLE `garage_user` (
  `userId` int(11) NOT NULL,
  `garageId` int(11) NOT NULL,
  `roleId` int(11) NOT NULL,
  `userNic` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `garage_user`
--

INSERT INTO `garage_user` (`userId`, `garageId`, `roleId`, `userNic`) VALUES
(1, 1, 1, 587458741),
(2, 1, 2, 575524821),
(3, 1, 2, 544785416),
(4, 2, 1, 587120862),
(5, 2, 2, 637120864),
(7, 3, 1, 854125478),
(8, 3, 2, 854712358),
(9, 4, 1, 894125761);

-- --------------------------------------------------------

--
-- Table structure for table `inspection_report`
--

CREATE TABLE `inspection_report` (
  `inspectionId` int(11) NOT NULL,
  `reportNo` varchar(50) NOT NULL,
  `vehiNo` varchar(50) NOT NULL,
  `engineMake` varchar(50) NOT NULL,
  `wheelBase` varchar(50) NOT NULL,
  `engine` varchar(50) NOT NULL,
  `clutch` varchar(200) NOT NULL,
  `gearBox` varchar(200) NOT NULL,
  `transmission` varchar(200) NOT NULL,
  `backAxle` varchar(200) NOT NULL,
  `frontAxle` varchar(200) NOT NULL,
  `wheelsTyres` varchar(200) NOT NULL,
  `springs` varchar(200) NOT NULL,
  `chassis` varchar(200) NOT NULL,
  `steering` varchar(200) NOT NULL,
  `brakes` varchar(200) NOT NULL,
  `fuelSystem` varchar(200) NOT NULL,
  `exhaustSystem` varchar(200) NOT NULL,
  `electricEquip` varchar(200) NOT NULL,
  `otherEquip` varchar(200) NOT NULL,
  `body` varchar(200) NOT NULL,
  `payLoad` varchar(200) NOT NULL,
  `payLoadCondition` varchar(200) NOT NULL,
  `observation` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inspection_report`
--

INSERT INTO `inspection_report` (`inspectionId`, `reportNo`, `vehiNo`, `engineMake`, `wheelBase`, `engine`, `clutch`, `gearBox`, `transmission`, `backAxle`, `frontAxle`, `wheelsTyres`, `springs`, `chassis`, `steering`, `brakes`, `fuelSystem`, `exhaustSystem`, `electricEquip`, `otherEquip`, `body`, `payLoad`, `payLoadCondition`, `observation`) VALUES
(1, 'WP0001', 'NA9218', '14455', '27.2', 'Good', 'Good', ' Good', 'Good', 'Excellent', 'Excellent', 'Good', 'Good', 'Good', 'Good', 'Good', 'Good', 'Good', 'Good', 'Excellent', 'Good', '2700', 'Good', 'Not relevant'),
(2, 'WP0002', 'LC9749', '14455', '27.2', 'Excellent', 'Excellent', ' Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', '2700', 'Excellent', 'not relevant'),
(3, 'WP0003', 'LK0381', '11455', '12', 'Excellent', 'Excellent', ' Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', '2700', 'Excellent', 'good'),
(4, 'WP0004', 'ND3887', '22T224', '27', 'Excellent', 'Excellent', ' Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', '28000', 'Excellent', 'No'),
(5, 'WP0005', 'FD4785', '11455', '41', 'Fair', 'Good', ' Good', 'Good', 'Good', 'Good', 'Good', 'Good', 'Good', 'Good', 'Good', 'Good', 'Good', 'Good', 'Good', 'Good', '2700', 'Good', 'NO');

-- --------------------------------------------------------

--
-- Table structure for table `issued_certificate`
--

CREATE TABLE `issued_certificate` (
  `issueId` int(11) NOT NULL,
  `fitnessId` int(11) NOT NULL,
  `fStatus` varchar(200) NOT NULL,
  `inspectionId` int(11) NOT NULL,
  `iStatus` varchar(200) NOT NULL,
  `cofficerId` int(11) NOT NULL,
  `bookingId` int(11) NOT NULL,
  `vehiId` int(11) NOT NULL,
  `issueDate` date NOT NULL,
  `issueTime` time NOT NULL,
  `issueby` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `issued_certificate`
--

INSERT INTO `issued_certificate` (`issueId`, `fitnessId`, `fStatus`, `inspectionId`, `iStatus`, `cofficerId`, `bookingId`, `vehiId`, `issueDate`, `issueTime`, `issueby`) VALUES
(1, 1, 'Complete', 1, 'Complete', 1, 1, 1, '2024-03-14', '11:29:53', 'Namal'),
(15, 2, 'Complete', 2, 'Complete', 1, 15, 6, '2024-03-19', '13:37:21', 'Hemasiri'),
(16, 3, 'Complete', 3, 'Complete', 1, 16, 4, '2024-03-20', '17:40:01', 'Hemasiri'),
(17, 4, 'Complete', 4, 'Complete', 2, 17, 5, '2024-03-23', '07:24:01', 'Namal'),
(19, 5, 'Complete', 5, 'Complete', 1, 19, 8, '2024-03-23', '12:42:08', 'Hemasiri');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `newsId` int(11) NOT NULL,
  `newsTitle` varchar(100) NOT NULL,
  `newsDescription` varchar(200) NOT NULL,
  `addBy` varchar(100) NOT NULL,
  `newsDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`newsId`, `newsTitle`, `newsDescription`, `addBy`, `newsDate`) VALUES
(1, 'Updated fee related for Garage since 2024.01.01....', '  Fees for an Application to register a garage for the issue of Certificate of Fitness  Rs:2000/=', 'Thanuja', '2024-03-21'),
(2, 'Updated Fees for Inspection of a Motor Vehicle ', ' Updated Fees for Inspection of a Motor Vehicle Rs:1000/= since 2023.01.01', 'Thanuja', '2024-02-13');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payId` int(11) NOT NULL,
  `bookingId` int(11) NOT NULL,
  `vehiId` int(11) NOT NULL,
  `cusId` int(11) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `payType` varchar(100) NOT NULL,
  `pDate` date NOT NULL,
  `aprovedBy` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payId`, `bookingId`, `vehiId`, `cusId`, `amount`, `payType`, `pDate`, `aprovedBy`) VALUES
(1, 1, 1, 1, '1000', 'on-site', '2024-03-14', 'Hemasiri'),
(2, 4, 4, 1, '1000', 'Card-Online', '2024-03-16', 'customer-online'),
(3, 5, 4, 1, '1000', 'Card-Online', '2024-03-16', 'customer-online'),
(4, 6, 4, 1, '1000', 'Card-Online', '2024-03-16', 'customer-online'),
(5, 8, 4, 1, '1000', 'on-site', '2024-03-16', 'Hemasiri'),
(6, 15, 6, 1, '1000', 'on-site', '2024-03-19', 'Harshana '),
(7, 16, 4, 1, '1000', 'Card-Online', '2024-03-20', 'customer-online'),
(8, 17, 5, 8, '1000', 'on-site', '2024-03-23', 'Hemasiri'),
(9, 19, 8, 1, '1000', 'on-site', '2024-03-23', 'Hemasiri');

-- --------------------------------------------------------

--
-- Table structure for table `payment_dmtwp`
--

CREATE TABLE `payment_dmtwp` (
  `payrId` int(11) NOT NULL,
  `renewId` int(11) NOT NULL,
  `amount` int(100) NOT NULL,
  `payType` varchar(100) NOT NULL,
  `pDate` date NOT NULL,
  `payBy` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_dmtwp`
--

INSERT INTO `payment_dmtwp` (`payrId`, `renewId`, `amount`, `payType`, `pDate`, `payBy`) VALUES
(1, 1, 5000, 'Card-Online', '2024-03-16', 'customer-online');

-- --------------------------------------------------------

--
-- Table structure for table `staff_login`
--

CREATE TABLE `staff_login` (
  `email` varchar(200) NOT NULL,
  `pwd` varchar(200) NOT NULL,
  `dmtStaffId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff_login`
--

INSERT INTO `staff_login` (`email`, `pwd`, `dmtStaffId`) VALUES
('janika@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 1),
('iresha@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 2),
('janika@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 1),
('iresha@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 2),
('admin@gmail.com', 'admin123456789', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `vehiId` int(11) NOT NULL,
  `vehiNo` varchar(200) NOT NULL,
  `vehiClass` varchar(200) NOT NULL,
  `vehiFuelType` varchar(200) NOT NULL,
  `vehiGrossWeight` int(200) NOT NULL,
  `vehiChasisNo` varchar(200) NOT NULL,
  `vehiEngineNo` varchar(200) NOT NULL,
  `vehiOwnerId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`vehiId`, `vehiNo`, `vehiClass`, `vehiFuelType`, `vehiGrossWeight`, `vehiChasisNo`, `vehiEngineNo`, `vehiOwnerId`) VALUES
(1, 'NA9218', 'Motor Coach', 'Desal', 20000, 'JTFSK22P300013423', '5L6173367', 1),
(2, 'LB4788', 'Motor Lorry', 'Desal', 50000, 'KMFXKN7FR1U423552', 'DABEY997374', 2),
(3, 'BY6720', 'Motor Tricycle Van', 'Desal', 40000, 'HBX0000WBVJ520422', '5618643761', 3),
(4, 'LK0381', 'Motor Lorry', 'Desal', 50000, 'XZU5040001309', 'N04CTH110667', 1),
(5, 'ND3887', 'Motor Coach', 'Desal', 40000, 'JTFSK22P300002794', '5L6308674', 4),
(6, 'LC9749', 'Motor Coach', 'Desal', 50000, 'NRR35C47001291', '6HL1320922', 1),
(7, 'CK1212', 'Motor Lorry', 'Desal', 50000, 'YUU22P304552794', '8R7854YY5', 1),
(8, 'FD4785', 'Motor Lorry', 'Desal', 2000, '1452365', '147854254nh', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehi_owner`
--

CREATE TABLE `vehi_owner` (
  `vehiOwnerId` int(11) NOT NULL,
  `vehiOwnerFname` varchar(200) NOT NULL,
  `vehiOwnerLname` varchar(200) NOT NULL,
  `vehiOwnerNic` varchar(200) NOT NULL,
  `vehiOwnerAddress` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehi_owner`
--

INSERT INTO `vehi_owner` (`vehiOwnerId`, `vehiOwnerFname`, `vehiOwnerLname`, `vehiOwnerNic`, `vehiOwnerAddress`) VALUES
(1, 'Thilini', 'Radhika', '907120864', '37 Medamawatha Piliyandala'),
(2, 'Ishara', 'Perera', '888888888', '82 Welmilla Bandaragama'),
(3, 'Chamara ', 'Perera', '666666666', '89 Kesbawa Piliyandala'),
(4, 'Supun', 'Silva', '444444444', '47 TempleRoad Boralasgamuwa');

-- --------------------------------------------------------

--
-- Table structure for table `vehi_revenue_licence`
--

CREATE TABLE `vehi_revenue_licence` (
  `licenceId` int(11) NOT NULL,
  `licenceNo` varchar(200) NOT NULL,
  `licenceFee` int(200) NOT NULL,
  `LicenceValidFrom` date NOT NULL,
  `LicenceValidTo` date NOT NULL,
  `LIssueDay` date NOT NULL,
  `LIssuePerson` varchar(200) NOT NULL,
  `DSecretariat` varchar(200) NOT NULL,
  `District` varchar(200) NOT NULL,
  `vehiId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehi_revenue_licence`
--

INSERT INTO `vehi_revenue_licence` (`licenceId`, `licenceNo`, `licenceFee`, `LicenceValidFrom`, `LicenceValidTo`, `LIssueDay`, `LIssuePerson`, `DSecretariat`, `District`, `vehiId`) VALUES
(1, 'wp21678470', 2000, '2023-03-15', '2024-03-15', '2023-03-16', 'DS Homagama', 'Homagama', 'Colombo', 1),
(2, 'wp21854875', 2000, '2023-02-28', '2024-02-28', '2023-02-25', 'DS Kesbawa', 'Kesbawa', 'Colombo', 2),
(3, 'wp85475167', 2000, '2023-05-16', '2024-05-16', '2023-05-15', 'DS Kesbawa', 'Kesbawa', 'Colombo', 3),
(4, 'wp89541264', 2000, '2023-05-18', '2024-05-18', '2023-05-18', 'DS Kesbawa', 'Kesbawa', 'Colombo', 4),
(5, 'wp98564125', 2000, '2023-05-16', '2024-05-16', '2023-05-15', 'DS Homagama', 'Homagama', 'Colombo', 5),
(6, 'wp89745268', 2000, '2023-04-25', '2024-04-25', '2023-04-26', 'DS Hoagama', 'Homagama', 'Colombo', 6),
(7, '	\nwp89478544', 2000, '2023-03-20', '2024-03-20', '2023-03-21', 'DS Kesbawa', 'Kesbawa', 'Colombo', 7),
(8, 'w145745268', 2000, '2023-03-22', '2024-03-22', '2023-03-21', 'DSHomagama', 'Homagama', 'Colombo', 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`bookingId`);

--
-- Indexes for table `cancel_booking`
--
ALTER TABLE `cancel_booking`
  ADD PRIMARY KEY (`cancelId`);

--
-- Indexes for table `certifying_officer`
--
ALTER TABLE `certifying_officer`
  ADD PRIMARY KEY (`cofficerId`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cusId`);

--
-- Indexes for table `dmt_staff`
--
ALTER TABLE `dmt_staff`
  ADD PRIMARY KEY (`dmtStaffId`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`faqId`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD UNIQUE KEY `feedbackId` (`feedbackId`);

--
-- Indexes for table `fitness_certificate`
--
ALTER TABLE `fitness_certificate`
  ADD PRIMARY KEY (`fitnessId`);

--
-- Indexes for table `garage`
--
ALTER TABLE `garage`
  ADD PRIMARY KEY (`garageId`);

--
-- Indexes for table `garage_owner`
--
ALTER TABLE `garage_owner`
  ADD PRIMARY KEY (`ownerId`);

--
-- Indexes for table `garage_renew`
--
ALTER TABLE `garage_renew`
  ADD PRIMARY KEY (`renewId`);

--
-- Indexes for table `garage_role`
--
ALTER TABLE `garage_role`
  ADD PRIMARY KEY (`roleId`);

--
-- Indexes for table `garage_user`
--
ALTER TABLE `garage_user`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `inspection_report`
--
ALTER TABLE `inspection_report`
  ADD PRIMARY KEY (`inspectionId`);

--
-- Indexes for table `issued_certificate`
--
ALTER TABLE `issued_certificate`
  ADD PRIMARY KEY (`issueId`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`newsId`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payId`);

--
-- Indexes for table `payment_dmtwp`
--
ALTER TABLE `payment_dmtwp`
  ADD PRIMARY KEY (`payrId`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`vehiId`);

--
-- Indexes for table `vehi_owner`
--
ALTER TABLE `vehi_owner`
  ADD PRIMARY KEY (`vehiOwnerId`);

--
-- Indexes for table `vehi_revenue_licence`
--
ALTER TABLE `vehi_revenue_licence`
  ADD UNIQUE KEY `licenceId` (`licenceId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `bookingId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `cancel_booking`
--
ALTER TABLE `cancel_booking`
  MODIFY `cancelId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `certifying_officer`
--
ALTER TABLE `certifying_officer`
  MODIFY `cofficerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cusId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `dmt_staff`
--
ALTER TABLE `dmt_staff`
  MODIFY `dmtStaffId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `faqId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedbackId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fitness_certificate`
--
ALTER TABLE `fitness_certificate`
  MODIFY `fitnessId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `garage`
--
ALTER TABLE `garage`
  MODIFY `garageId` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `garage_owner`
--
ALTER TABLE `garage_owner`
  MODIFY `ownerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `garage_renew`
--
ALTER TABLE `garage_renew`
  MODIFY `renewId` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `garage_role`
--
ALTER TABLE `garage_role`
  MODIFY `roleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `garage_user`
--
ALTER TABLE `garage_user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `inspection_report`
--
ALTER TABLE `inspection_report`
  MODIFY `inspectionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `issued_certificate`
--
ALTER TABLE `issued_certificate`
  MODIFY `issueId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `newsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payment_dmtwp`
--
ALTER TABLE `payment_dmtwp`
  MODIFY `payrId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `vehiId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vehi_owner`
--
ALTER TABLE `vehi_owner`
  MODIFY `vehiOwnerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
