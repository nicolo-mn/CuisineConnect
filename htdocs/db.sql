-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2024 at 09:43 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `socialnetworkdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `FollowerID` int(11) NOT NULL,
  `FollowerUserID` int(11) DEFAULT NULL,
  `FollowingUserID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifiche`
--

CREATE TABLE `notifiche` (
  `NotificationID` int(11) NOT NULL,
  `UserIDUtenteNotificato` int(11) DEFAULT NULL,
  `UserIDUtenteNotificante` int(11) DEFAULT NULL,
  `Testo` text DEFAULT NULL,
  `PostID` int(11) DEFAULT NULL,
  `Tipo` enum('Like','Commento','Segui','Menzione') NOT NULL,
  `DataNotifica` timestamp NOT NULL DEFAULT current_timestamp(),
  `Letta` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `PostID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Titolo` varchar(255) NOT NULL,
  `Descrizione` text DEFAULT NULL,
  `Foto` varchar(255) DEFAULT NULL,
  `RecipeID` int(11) DEFAULT NULL,
  `DataCreazione` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`PostID`, `UserID`, `Titolo`, `Descrizione`, `Foto`, `RecipeID`, `DataCreazione`) VALUES
(1, 1, 'Titolo del Post', 'Ciao sono il direttore di dipartimento', 'pub/media/ff25b63820574d47939e01c9bd54d490dd70e52a2339fde21ec1be8a9aac4071.jpeg', NULL, '2024-01-31 08:38:45');

-- --------------------------------------------------------

--
-- Table structure for table `ricette`
--

CREATE TABLE `ricette` (
  `RecipeID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Nome` varchar(255) NOT NULL,
  `Descrizione` text DEFAULT NULL,
  `Ingredienti` text DEFAULT NULL,
  `Procedimento` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `utenti`
--

CREATE TABLE `utenti` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Nome` varchar(255) NOT NULL,
  `Bio` text DEFAULT NULL,
  `Password` varchar(255) NOT NULL,
  `ImmagineProfilo` varchar(255) DEFAULT NULL,
  `NumeroPost` int(11) DEFAULT 0,
  `NumeroFollower` int(11) DEFAULT 0,
  `NumeroFollowing` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `utenti`
--

INSERT INTO `utenti` (`UserID`, `Username`, `Email`, `Nome`, `Bio`, `Password`, `ImmagineProfilo`, `NumeroPost`, `NumeroFollower`, `NumeroFollowing`) VALUES
(1, 'admin', 'admin@email.com', 'Signor Admin', 'Ciao sono il signor Admin e sono il capo del dipartimento', '$2y$10$lZftLrWf7DjoyUVga25BM.OhZEPFwjsI9lO0alQ4tdHsiklsebbu.', 'pub/media/ff25b63820574d47939e01c9bd54d490dd70e52a2339fde21ec1be8a9aac4071.jpeg', 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`FollowerID`),
  ADD KEY `FollowerUserID` (`FollowerUserID`),
  ADD KEY `FollowingUserID` (`FollowingUserID`);

--
-- Indexes for table `notifiche`
--
ALTER TABLE `notifiche`
  ADD PRIMARY KEY (`NotificationID`),
  ADD KEY `UserIDUtenteNotificato` (`UserIDUtenteNotificato`),
  ADD KEY `UserIDUtenteNotificante` (`UserIDUtenteNotificante`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`PostID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `RecipeID` (`RecipeID`);

--
-- Indexes for table `ricette`
--
ALTER TABLE `ricette`
  ADD PRIMARY KEY (`RecipeID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `FollowerID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifiche`
--
ALTER TABLE `notifiche`
  MODIFY `NotificationID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `PostID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ricette`
--
ALTER TABLE `ricette`
  MODIFY `RecipeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `utenti`
--
ALTER TABLE `utenti`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `followers`
--
ALTER TABLE `followers`
  ADD CONSTRAINT `followers_ibfk_1` FOREIGN KEY (`FollowerUserID`) REFERENCES `utenti` (`UserID`),
  ADD CONSTRAINT `followers_ibfk_2` FOREIGN KEY (`FollowingUserID`) REFERENCES `utenti` (`UserID`);

--
-- Constraints for table `notifiche`
--
ALTER TABLE `notifiche`
  ADD CONSTRAINT `notifiche_ibfk_1` FOREIGN KEY (`UserIDUtenteNotificato`) REFERENCES `utenti` (`UserID`),
  ADD CONSTRAINT `notifiche_ibfk_2` FOREIGN KEY (`UserIDUtenteNotificante`) REFERENCES `utenti` (`UserID`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `utenti` (`UserID`),
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`RecipeID`) REFERENCES `ricette` (`RecipeID`);

--
-- Constraints for table `ricette`
--
ALTER TABLE `ricette`
  ADD CONSTRAINT `ricette_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `utenti` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
