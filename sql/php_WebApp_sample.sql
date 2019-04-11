DROP DATABASE IF EXISTS `php_webapp_sample`;
CREATE DATABASE IF NOT EXISTS `php_webapp_sample` /*!40100 DEFAULT CHARACTER SET utf8*/;
USE `php_webapp_sample`;


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------


--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE user (
  UID int(11) NOT NULL auto_increment,
  username text CHARACTER SET utf8 NOT NULL,
  userrank text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (UID)
);



--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE password (
  PWID int(11) NOT NULL auto_increment,
  UID int(11) NOT NULL,
  passwordhash varchar(999) NOT NULL,
  PRIMARY KEY (PWID),
  CONSTRAINT FK_UID FOREIGN KEY (UID) REFERENCES user(UID)
);

-- --------------------------------------------------------

--
-- Einfügen des Admin Acounts
--

INSERT INTO user (UID, username, userrank)
VALUES (1, "Admin", "Admin");

--
-- Einfügen des Admin Passworts
--

INSERT INTO password (PWID, UID, passwordhash)
VALUES (1, 1, "d927z6&&hf239_kc#so9");

