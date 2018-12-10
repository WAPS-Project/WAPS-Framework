DROP DATABASE IF EXISTS `php_projekt_sample`;
CREATE DATABASE IF NOT EXISTS `php_projekt_sample` /*!40100 DEFAULT CHARACTER SET utf8*/;
USE `php_projekt_sample`;


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `produkte`
--


CREATE TABLE produkte (
  PRID int(11) NOT NULL,
  name text COLLATE utf8_german2_ci NOT NULL,
  preis double DEFAULT NULL,
  PRIMARY KEY (PRID)
);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  UID int(11) NOT NULL,
  user text CHARACTER SET utf8 NOT NULL,
  rank text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (UID)
);
