-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 13. Mai 2014 um 20:12
-- Server Version: 5.6.16
-- PHP-Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Datenbank: `naukanu`
--
CREATE DATABASE IF NOT EXISTS `naukanu` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `naukanu`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `address`
--

CREATE TABLE IF NOT EXISTS `address` (
  `addressID` int(11) NOT NULL,
  `street` varchar(50) DEFAULT NULL,
  `streetNo` varchar(10) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`addressID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `answer`
--

CREATE TABLE IF NOT EXISTS `answer` (
  `answerID` int(11) NOT NULL,
  `answer` int(11) DEFAULT NULL,
  `appraisalQuestionID` int(11) DEFAULT NULL,
  `appraisalID` int(11) DEFAULT NULL,
  PRIMARY KEY (`answerID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `appraisal`
--

CREATE TABLE IF NOT EXISTS `appraisal` (
  `appraisalID` int(11) NOT NULL,
  `courseID` int(11) DEFAULT NULL,
  `employeeID` int(11) DEFAULT NULL,
  PRIMARY KEY (`appraisalID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `appraisalquestion`
--

CREATE TABLE IF NOT EXISTS `appraisalquestion` (
  `appraisalQuestionID` int(11) NOT NULL,
  `question` varchar(1024) NOT NULL,
  PRIMARY KEY (`appraisalQuestionID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bankdata`
--

CREATE TABLE IF NOT EXISTS `bankdata` (
  `bankDataID` int(11) NOT NULL,
  `iban` varchar(50) NOT NULL,
  `ibic` varchar(50) NOT NULL,
  PRIMARY KEY (`bankDataID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `boat`
--

CREATE TABLE IF NOT EXISTS `boat` (
  `boatID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `boatTypeID` int(11) DEFAULT NULL,
  `conditionID` int(11) DEFAULT NULL,
  PRIMARY KEY (`boatID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `boattype`
--

CREATE TABLE IF NOT EXISTS `boattype` (
  `boatTypeID` int(11) NOT NULL,
  `typename` varchar(100) NOT NULL,
  `seatCount` int(11) NOT NULL,
  PRIMARY KEY (`boatTypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `booking`
--

CREATE TABLE IF NOT EXISTS `booking` (
  `bookingID` int(11) NOT NULL,
  `courseID` int(11) DEFAULT NULL,
  `customerID` int(11) DEFAULT NULL,
  `boatID` int(11) DEFAULT NULL,
  `courseTypeID` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `personID` int(11) DEFAULT NULL,
  `invoiceID` int(11) DEFAULT NULL,
  `examID` int(11) DEFAULT NULL,
  PRIMARY KEY (`bookingID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `calendarentry`
--

CREATE TABLE IF NOT EXISTS `calendarentry` (
  `calendarEntryID` int(11) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `description` varchar(50) NOT NULL,
  `courseID` int(11) DEFAULT NULL,
  `employeeID` int(11) DEFAULT NULL,
  PRIMARY KEY (`calendarEntryID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `canvas`
--

CREATE TABLE IF NOT EXISTS `canvas` (
  `canvasID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `canvasTypeID` int(11) DEFAULT NULL,
  `conditionID` int(11) DEFAULT NULL,
  `mastID` int(11) DEFAULT NULL,
  PRIMARY KEY (`canvasID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `canvastype`
--

CREATE TABLE IF NOT EXISTS `canvastype` (
  `canvasTypeID` int(11) NOT NULL,
  `typename` varchar(100) DEFAULT NULL,
  `size` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`canvasTypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `clearing`
--

CREATE TABLE IF NOT EXISTS `clearing` (
  `clearingID` int(11) NOT NULL,
  `date` datetime DEFAULT NULL,
  `isPaid` tinyint(1) DEFAULT NULL,
  `employeeID` int(11) DEFAULT NULL,
  PRIMARY KEY (`clearingID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `companyID` int(11) NOT NULL,
  `companyName` varchar(50) DEFAULT NULL,
  `legalForm` char(10) DEFAULT NULL,
  `addressID` int(11) DEFAULT NULL,
  `bankDataID` int(11) DEFAULT NULL,
  PRIMARY KEY (`companyID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `condition`
--

CREATE TABLE IF NOT EXISTS `condition` (
  `conditionID` int(11) NOT NULL,
  `grade` int(11) NOT NULL,
  `Description` varchar(100) NOT NULL,
  PRIMARY KEY (`conditionID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `constraint`
--

CREATE TABLE IF NOT EXISTS `constraint` (
  `constraintID` int(11) NOT NULL,
  `sqlAddition` varchar(1024) DEFAULT NULL,
  `predecessorTaskID` int(11) DEFAULT NULL,
  `taskID` int(11) DEFAULT NULL,
  PRIMARY KEY (`constraintID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `courseID` int(11) NOT NULL,
  `courseTypeID` int(11) DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  PRIMARY KEY (`courseID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `coursetype`
--

CREATE TABLE IF NOT EXISTS `coursetype` (
  `courseTypeID` int(11) NOT NULL,
  `typename` varchar(50) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `numberOfCourseLeaders` int(11) DEFAULT NULL,
  `durationHours` int(11) DEFAULT NULL,
  `durationDays` int(11) DEFAULT NULL,
  `maxParticipants` int(11) DEFAULT NULL,
  `minParticipants` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `boatTypeID` int(11) DEFAULT NULL,
  `salary` int(11) DEFAULT NULL,
  `licenseID` int(11) DEFAULT NULL,
  `priceExam` double DEFAULT NULL,
  PRIMARY KEY (`courseTypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `customerID` int(11) NOT NULL,
  `addressID` int(11) DEFAULT NULL,
  `bankDataID` int(11) DEFAULT NULL,
  PRIMARY KEY (`customerID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `editvalue`
--

CREATE TABLE IF NOT EXISTS `editvalue` (
  `editValueID` int(11) NOT NULL,
  `objectID` int(11) DEFAULT NULL,
  `classname` varchar(50) DEFAULT NULL,
  `ticketID` int(11) DEFAULT NULL,
  PRIMARY KEY (`editValueID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `employeeID` int(11) NOT NULL,
  `roleID` int(11) DEFAULT NULL,
  PRIMARY KEY (`employeeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `employeerole`
--

CREATE TABLE IF NOT EXISTS `employeerole` (
  `roleID` int(11) NOT NULL,
  `rolename` varchar(100) DEFAULT NULL,
  `Description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`roleID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `exam`
--

CREATE TABLE IF NOT EXISTS `exam` (
  `examID` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`examID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
  `invoiceID` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `dueDate` datetime DEFAULT NULL,
  `isPaid` tinyint(1) DEFAULT NULL,
  `customerID` int(11) DEFAULT NULL,
  `reminder1` datetime DEFAULT NULL,
  `reminder2` datetime DEFAULT NULL,
  PRIMARY KEY (`invoiceID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `jtboatmast`
--

CREATE TABLE IF NOT EXISTS `jtboatmast` (
  `boatTypeID` int(11) NOT NULL,
  `mastTypeID` int(11) NOT NULL,
  PRIMARY KEY (`boatTypeID`,`mastTypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `jtemployeelicense`
--

CREATE TABLE IF NOT EXISTS `jtemployeelicense` (
  `employeeID` int(11) NOT NULL,
  `licenseID` int(11) NOT NULL,
  PRIMARY KEY (`employeeID`,`licenseID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `jtexamlicense`
--

CREATE TABLE IF NOT EXISTS `jtexamlicense` (
  `licenseID` int(11) NOT NULL,
  `examID` int(11) NOT NULL,
  PRIMARY KEY (`licenseID`,`examID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `jtmastcanvas`
--

CREATE TABLE IF NOT EXISTS `jtmastcanvas` (
  `mastTypeID` int(11) NOT NULL,
  `canvasID` int(11) NOT NULL,
  PRIMARY KEY (`mastTypeID`,`canvasID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `license`
--

CREATE TABLE IF NOT EXISTS `license` (
  `licenseID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `includedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`licenseID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mast`
--

CREATE TABLE IF NOT EXISTS `mast` (
  `mastID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mastTypeID` int(11) DEFAULT NULL,
  `conditionID` int(11) DEFAULT NULL,
  `boatID` int(11) DEFAULT NULL,
  PRIMARY KEY (`mastID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `masttype`
--

CREATE TABLE IF NOT EXISTS `masttype` (
  `mastTypeID` int(11) NOT NULL,
  `typename` varchar(100) DEFAULT NULL,
  `heigth` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`mastTypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `payroll`
--

CREATE TABLE IF NOT EXISTS `payroll` (
  `courseID` int(11) NOT NULL,
  `employeeID` int(11) NOT NULL,
  `clearingID` int(11) DEFAULT NULL,
  PRIMARY KEY (`courseID`,`employeeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `person`
--

CREATE TABLE IF NOT EXISTS `person` (
  `personID` int(11) NOT NULL,
  `salutation` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `firstName` varchar(50) DEFAULT NULL,
  `dateOfBirth` datetime DEFAULT NULL,
  `addressID` int(11) DEFAULT NULL,
  `companyID` int(11) DEFAULT NULL,
  `bankDataID` int(11) DEFAULT NULL,
  `employeeID` int(11) DEFAULT NULL,
  `examID` int(11) DEFAULT NULL,
  PRIMARY KEY (`personID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `taskID` int(11) NOT NULL,
  `description` varchar(1024) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `page` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`taskID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ticket`
--

CREATE TABLE IF NOT EXISTS `ticket` (
  `ticketID` int(11) NOT NULL,
  `comment` varchar(1024) DEFAULT NULL,
  `dueDate` datetime DEFAULT NULL,
  `taskID` int(11) DEFAULT NULL,
  `boatID` int(11) DEFAULT NULL,
  `mastID` int(11) DEFAULT NULL,
  `canvasID` int(11) DEFAULT NULL,
  `ticketStatusID` int(11) DEFAULT NULL,
  `performerID` int(11) DEFAULT NULL,
  `initiatorID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ticketID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ticketstatus`
--

CREATE TABLE IF NOT EXISTS `ticketstatus` (
  `ticketStatusID` int(11) NOT NULL,
  `status` varchar(30) NOT NULL,
  PRIMARY KEY (`ticketStatusID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userID` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `personID` int(11) DEFAULT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
