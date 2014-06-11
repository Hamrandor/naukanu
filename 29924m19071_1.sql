-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 11. Jun 2014 um 22:04
-- Server Version: 5.6.16
-- PHP-Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `29924m19071_1`
--

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
  `boatID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `boatTypeID` int(11) DEFAULT NULL,
  `conditionID` int(11) DEFAULT NULL,
  PRIMARY KEY (`boatID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Daten für Tabelle `boat`
--

INSERT INTO `boat` (`boatID`, `name`, `boatTypeID`, `conditionID`) VALUES
(1, 'Optimist 1', 1, 1),
(2, 'Surfbrett 1', 4, 2),
(3, 'Surfbrett 2', 4, 5),
(4, 'Optimist 2', 1, 3),
(5, 'Bobbie-Hobie', 3, 4);

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

--
-- Daten für Tabelle `boattype`
--

INSERT INTO `boattype` (`boatTypeID`, `typename`, `seatCount`) VALUES
(1, 'Optimist', 1),
(2, '470er', 2),
(3, 'Hobie-Cat', 2),
(4, 'Surfbrett', 1),
(5, 'Kite-Surfbrett', 1);

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
-- Tabellenstruktur für Tabelle `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(50) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('0172f0a8bbad00d748e1f959e11dc56f', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082425, ''),
('02584f751c5df53922f58dfbdda5a399', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082444, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('025a3357b1a1e3dfe0e77381965ea287', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082427, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('031afae90f7685c4c5dd429e39b80251', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082441, ''),
('03ac49eb87e509258d9550aa12649120', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082876, ''),
('044b1304a1d68a612a28ebb935fadac4', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082688, ''),
('04b2bb38f67ecd0aaf4e5786dabd52b7', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402081236, ''),
('078d8ed6161fe63fe88b00c1b85f0c72', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082432, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('08fc4408560d7a23d980782549c7bb74', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082458, ''),
('09470989222cc34ebfca7b5cc21ae77a', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402081235, ''),
('0a0ed7781e71d44eb14c2bb37da671ae', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082441, ''),
('0a2e80e0887bc4c411440b6a6d8cd6d0', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082444, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('0a52309785f108fe22e9d618805b0466', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082869, ''),
('0f224ba67a3ff21e59de89865ad51a8f', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082441, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('0ffba46046e27a7e8e8bd64b7d956ae8', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082433, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('11af2a7f620e1ea6bac8652fda75462e', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082456, ''),
('1343e5ad329901d34dd70b200996d05d', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082443, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('141a7b5c7ac8b63938613dacded2899b', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402081976, ''),
('14b8a29b15375260ed0c492a6cf27c2a', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082433, ''),
('157c8f1c61e495dc6a6237fb99350c3b', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082427, ''),
('179df8f0c0b7023d4db42c7fde90d80b', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082342, ''),
('1ba20ada9d8c52d8915cb34ca3b07937', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082457, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('1cb7ec41f495a89fc69434e3e245872f', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082441, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('1dcbf04941312ec6b0a0cf1fe229cbe7', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082294, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('2046486a7b791852faa8fa2eda22b417', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082828, ''),
('24be114a7f42b7a36277fa2096a64e1a', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082441, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('25876eefc980d765a9bc569e1e2d18db', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082456, ''),
('266518e0069c509fceef09ae34dbf254', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082429, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('2695e31e6779fe115610b590be0dbbf3', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082456, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('26ec70d663d384dca615f904ee76e726', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082433, ''),
('2a1920cc5a5345c8845ef277cdd950a2', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082458, ''),
('2c7e8265f9edf2981ebefb21c459c7d1', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082441, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('2ccbeb75263071bd517af3cc7fb21813', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082445, ''),
('2d21cc192ae510ee7e66d8465568dc6e', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082428, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('2fc0973a27f2c44dc06157d819b6aecd', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082295, ''),
('31ea513dc299ec4163f582aa676501ce', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402081235, ''),
('3314a30bf4fe04bc103cd8e22960d646', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082433, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('3544d6cf62ff0ae8d72a4b490c45ddf4', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402081609, ''),
('355a3baadd62ebff7ab668cdecfe1d86', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082763, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('363d905a94b61553fe577137b1d4b1d1', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402080981, ''),
('36cc89ba54d9b4e39a5f3c441046ca87', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082440, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('3714c44edce1c84d536fb8b08df4049a', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082427, ''),
('38481b9c4e7825a54e1f4512a438280f', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082440, ''),
('3a43a256d0a5a801407843b3385a28bd', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082929, ''),
('3c7910c7be017561f573b63e9c843b82', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082428, ''),
('3ce0c13e3737ad911b8b368ee3ca5d55', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402081234, ''),
('3d6575f8c964feaf4e3e867514c098ff', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402081618, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('3dd571d5041d9ce47cabfc2f62ffb655', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402081773, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('3fc442dc222f64ec1529c2de6d9d4e5b', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082444, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('404a5d728768a3c14305d358e9af4f5b', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402081432, ''),
('424f2af8fc72f71f7d20ba2806003611', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082433, ''),
('42856e92b298b574770ccc09fc91246c', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082427, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('43b266ac618955ddb37117f7e7847d07', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082433, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('43f1739f92a834e6fbf9c4c1110ead5d', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402080987, ''),
('46acb8aa18b8b2ff1e592f17e3eeb742', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082429, ''),
('47f95b8cb142b0554563c6c846210f11', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082456, ''),
('48a18cd9806fa56205d18586fa0f6638', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402080973, ''),
('4a666df5ab2aa0d51b7ad446512b803b', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082865, ''),
('4c1c0c7059d4ada9942eb1b63134aee2', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402081485, ''),
('4de26f5b013619dafbb1a5f0a3eb7fda', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082758, ''),
('52aea2a80df7340838d4053e19662811', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082457, ''),
('53b3692b4fd0bd8487267ed09e4e28c9', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402081773, ''),
('546bbf3b9d277bbf7ad974cdf885ea99', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082442, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('5492e2c83b425914de0fee76be1406fc', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082342, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('5597b75ed6a6487fdf73abf425199128', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082457, ''),
('57d5d9f038efea8325e6e94de503e630', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082432, ''),
('59adbb714f5d805547ea1594e3e8197a', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082425, ''),
('59c7c52e74a6365fe550d760e5954ac8', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402081609, ''),
('5b5d292f3b40460883d761be5b7e443b', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082457, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('5ced0389655e14fc98721f36e001ac5c', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082933, ''),
('5d0a7ac95a43b6db83eee140c3ea61ec', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082432, ''),
('61630f85d05b4f2d759561006fb3c904', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402081398, ''),
('637492d0b33833c3e7282b7d95df9a3b', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082343, ''),
('64999c95b75f891245a2b134dd47aba6', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082443, ''),
('65cc0b103d380fc2ff6a849b4723566e', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082445, ''),
('65eafedbc502add690dc60d135fc5971', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082442, ''),
('6660de0d42166b4e4597a7234a5e9257', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082331, ''),
('68db8ff05ed7995a35853475c7b3406c', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082444, ''),
('6b9cffe7af2bfe6fa0072eb9c6582414', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082867, ''),
('6cdb8b526a92d4fed2204acd57233018', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082537, ''),
('6f013c11f21e42d59c63412eadc1e674', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402081432, ''),
('6fafa7e7e5865cb50637af3c34f43882', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082434, ''),
('71a8d8363b8bcd438d87a761b6b1f2b8', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082456, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('72656bdbfb7978cf134a4342c2a39445', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082445, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('734a651aa7662f94d7a6c29c5bf84a1c', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082427, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('7699160715588fcaefbada206cdaca80', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082456, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('772cd0d25efea413b67f8a4082456887', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082763, ''),
('786e83c9a82b7f96ccd52fd061a5cb1a', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082432, ''),
('7ac1f8481f91d17ee620f4b813551c22', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082428, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('7c357ce6e4c89d60c231f5c316c30ecf', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402080987, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('7ebab5270113e2fde30bedc5b532e77f', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402081247, ''),
('7f1d01e3338f31e0890fe4c077b4d655', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402081526, ''),
('7fa15eab4a61271fd848aab7d88edb09', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082537, ''),
('7fc23efeff5bfaff2cd430401f029538', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402081440, ''),
('7fdacca62e7a42cef425324d081e010c', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082929, ''),
('8118a60d5487c8a0df7119eeee208d91', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082433, ''),
('817653fd3bdcb22e7819d0f151eaef12', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402081247, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('83517dcc29a45b7c49218602a35b46fb', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082295, ''),
('886cba4a0933b64323124afeb70785f4', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082425, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('8a6e9f58907ca5eeb97c2f520a8e590f', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082433, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('8a7bf9ab342cc6151548021c0dce097a', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082537, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('8dcc7531429fa637177be7b8cdc607b5', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082433, ''),
('906cbb9339c53a9cae642099fc69529e', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082457, ''),
('91bed7d1f996f838c57840a4104ce673', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082444, ''),
('92a53be078cfa109ce305de9ebb6ce31', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082427, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('94adf852527eda9013fab5df0141da73', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082441, ''),
('9656901c9a5548477213ee35dbb01742', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402081236, ''),
('96b8f69b080de4ea05436333f9c01b33', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082428, ''),
('97c399615ee2fc49f6984fdd48472e4c', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082763, ''),
('97fe45102bd92ce0cc7b87ede365a617', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082457, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('9905f784e619f044b5e37a2066f7a0d0', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082870, ''),
('9a4663492159c72fa3b119ccd51b1d92', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082432, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('9a747937568c287316e05aef76fe4e2f', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082457, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('9ae0b914161051a763f003a01b68764a', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082444, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('9c1daa873668714f46f4394fe40851c8', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082441, ''),
('9c69c9ea3afc7ea943eacbb43cf40fa4', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402081618, ''),
('9ca3cb67d892ead2b7fe7004a1ef0b8e', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082426, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('9da732b32619845db19142dba5841c04', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082429, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('9e82163aa99becb91866e13ac382beea', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082227, ''),
('a06c39e44d6a20f322b9a9012ac85162', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082425, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('a31d038efaaedf004e63959b14c8a87a', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402081773, ''),
('a376d5f7fc12a3e1fc2b7816dedc2191', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082443, ''),
('a4a5f21bf85c2fafd4985f5f7efdd900', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082440, ''),
('a584d30a5b079e59679231d559d34778', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082443, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('acd4c1669d916fcb24502efbabb64e23', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402081526, ''),
('ad17ba4e6cfa05139d12bb0bb171a26d', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082445, ''),
('aec0b355177e832d520c1bf0ccb8990c', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082444, ''),
('af7f46f0fca8928f622d8d664a3004f5', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082429, ''),
('b00331bd1aa243a80d6fe051ed516a70', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082490, ''),
('b3c03f6b6e67149cf671bad7e570d885', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082440, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('b6bfb6313beec4486aa6e75f7f052d5d', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082444, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('b903d5531feeac494641f8d486bed001', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402081440, ''),
('b9fcf7dde81966a5d2cbeacf5a8dea32', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082441, ''),
('bacefe76175b2c15e1aa18fb8340c260', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082433, ''),
('bb1c21cffa54b3d07043da83b971d717', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082433, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('bbdcb847f23277f5228a9ebdcec2b00c', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082757, ''),
('bbeb0d3ea8060ed320ff9b297cb9183d', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082457, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('bc60abd8967c2f501afa2a2e9c57ecad', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082441, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('bcdd1c284c472fb6918f6fb94fe59710', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402081234, ''),
('c004c822f22fc1434a7958d9cb68acf8', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082441, ''),
('c148f40ca2b0a622ccff8cec2165caab', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082490, ''),
('c64db42ab1059b4a5f378914c6e44c98', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082444, ''),
('c73a8762e1f353b45fd53aa821cb033d', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402081398, ''),
('c96d277747f25660ae6654b22702eff3', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082530, ''),
('cc50080e153d11b0d2c00b6a3558c252', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082445, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('cd7055fe0e275320e9d64ba35fdefb9b', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082444, ''),
('cfd2dcecd32deb2491189fd1a65a5c3b', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402080973, ''),
('d2384579dad4eaddc19bc60cd6cf457c', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082433, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('d3085d42b9d368531e906abcbd9968c0', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402081711, ''),
('d358ceacf9513ac6de02e440687bfe0c', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082457, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('d3f12fead635ddadfc1c0dff9804d7e8', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082428, ''),
('d6a44fd12334f8e414c40077e2272dc6', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402081247, ''),
('d8d6e645d1ae0a41ede1a0006b14abec', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082865, ''),
('d9cd41de3d037ec4fdb7c144a5bebe7f', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082441, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('dc53e6e7f0feee43e08773050b220582', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082428, ''),
('df8c57c5c66412f18e15dc1d1a0af4cb', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402080987, ''),
('e0d991bd5b05b1513b5990918b8897a2', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082429, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('e36bf8535b60f86d0ab5a22ff60c9505', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082688, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('e50af05b8dc616b6ae2a5218becb3442', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082425, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('e5bd0d2ac5b6f2fc19c72c7ab8e9a41b', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082442, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('e8a9bede7c43a9a4c3ebb2ee5ba12cd0', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082441, ''),
('e8c58353768c95d38e3a550f1b2b743a', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082432, ''),
('e9b3d858bd909c13779f7cfa20f66e39', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082458, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('e9dd805384f87e02043ee697713f339c', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402081498, ''),
('eb5804f267a56ecfd1a6ada0ceaa6ba9', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402081618, ''),
('eccec7b2180544b1ea237e65fa2abb48', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402081440, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('ed373d1f534b71277dbcf7447eb2324c', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402080981, ''),
('ee1eb8006aa92c74e74637b35880e55c', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082444, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('ef89408d714e816e47064a8cd18b4c4f', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402080981, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('efb794351e01c780cce20cede6c0d7e8', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082425, ''),
('efc9191b6561eda9a0cc1475a37239e3', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082433, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('f2e51ab7008ebf7a98c2e693f5e5ac9a', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082227, ''),
('f45d3b84bdc02cc5b6b19331ff4e3b73', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082677, ''),
('f494b9b7f7e821ccad756884dd062821', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402081498, ''),
('f50a1bc795300029ea2c75a6bb8411ed', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402081764, ''),
('f574b83af9485f027b23fe5caedc8550', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082427, ''),
('f6f332f162f602c3657731816905d4f5', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082457, ''),
('f74f9b89dbeff8368089a18395fb4fda', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082457, ''),
('f7b1507a52812411dde40264a1f7acb7', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402081764, ''),
('f835c911551272917a8aef3bad45a9fd', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402081976, ''),
('f8393f6ab8f510910ee366ed6a9023a2', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082444, ''),
('f9253fa79559a7ff386b82f07b724e6b', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082440, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('f9b397819e86afcc9857b5a542fbdadd', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082429, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('fa34f12edd9facb6639685370a84e124', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082457, ''),
('fd1834524fbc5f6a4adeba4fbe344775', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082432, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('fd2b0c2a1a6881072cce2a2dd73f345e', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082428, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:4:"jens";s:11:"login_state";b:1;}'),
('fe77bf40e58984ac57e32c32087b55d8', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082688, ''),
('ffd0012250213c4a256e51664a7739b0', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082682, ''),
('fff9c0379db5011a6eb03a7145548249', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1402082429, '');

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

--
-- Daten für Tabelle `condition`
--

INSERT INTO `condition` (`conditionID`, `grade`, `Description`) VALUES
(1, 1, 'Neuzustand'),
(2, 2, 'kleine Mängel, aber einsetzbar'),
(3, 3, 'mangelhaft, nicht einsetzbar'),
(4, 4, 'zur Aussonderung vorgesehen'),
(5, 5, 'Defekt');

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

--
-- Daten für Tabelle `jtboatmast`
--

INSERT INTO `jtboatmast` (`boatTypeID`, `mastTypeID`) VALUES
(1, 1),
(2, 2),
(2, 3),
(3, 2),
(3, 3),
(4, 4),
(4, 5),
(5, 1),
(5, 2),
(5, 3),
(5, 4),
(5, 5);

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
  `mastID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `mastTypeID` int(11) DEFAULT NULL,
  `conditionID` int(11) DEFAULT NULL,
  `boatID` int(11) DEFAULT NULL,
  PRIMARY KEY (`mastID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Daten für Tabelle `mast`
--

INSERT INTO `mast` (`mastID`, `name`, `mastTypeID`, `conditionID`, `boatID`) VALUES
(1, 'optimast1', 1, 1, 1),
(2, 'Surfmast 1', 4, 2, 3),
(3, 'Surfmast 3', 4, 1, 2),
(4, 'Optimast 2', 1, 1, 1),
(5, 'Testmast1 ', 3, 2, 5),
(6, 'Testmast2', 2, 2, 4);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `masttype`
--

CREATE TABLE IF NOT EXISTS `masttype` (
  `mastTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `typename` varchar(100) DEFAULT NULL,
  `heigth` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`mastTypeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Daten für Tabelle `masttype`
--

INSERT INTO `masttype` (`mastTypeID`, `typename`, `heigth`) VALUES
(1, 'Optimast', '2.00'),
(2, 'Alumast', '3.00'),
(3, 'Holzmast', '3.00'),
(4, 'Surfmast', '2.00'),
(5, 'irgend ein Mast', '3.00');

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

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`userID`, `login`, `password`, `personID`) VALUES
(1, 'jens', 'jens', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
