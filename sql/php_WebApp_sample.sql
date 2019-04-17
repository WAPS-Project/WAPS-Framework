DROP DATABASE IF EXISTS `php_webapp_sample`;
CREATE DATABASE IF NOT EXISTS `php_webapp_sample` /*!40100 DEFAULT CHARACTER SET utf8*/;
USE `php_webapp_sample`;


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------


--
-- Tabellenstruktur für Tabelle `FSK_Table`
--

CREATE TABLE fsk_table (
	AID int NOT NULL AUTO_INCREMENT,
	FSK int,
	PRIMARY KEY (AID)
);

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE user (
  UID int(11) NOT NULL auto_increment,
  username text CHARACTER SET utf8 NOT NULL,
  firstname text CHARACTER SET utf8 NOT NULL,
  lastname text CHARACTER SET utf8 NOT NULL,
  userrank text CHARACTER SET utf8 NOT NULL,
  AID int(5) NOT NULL,
  PRIMARY KEY (UID),
  CONSTRAINT FK_AID FOREIGN KEY (AID) REFERENCES fsk_table(AID)
);



--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE password (
  PWID int(11) NOT NULL auto_increment,
  UID int(11) NOT NULL,
  password varchar(999) NOT NULL,
  PRIMARY KEY (PWID),
  CONSTRAINT FK_UID FOREIGN KEY (UID) REFERENCES user(UID)
);




-- --------------------------------------------------------

--
-- Einfügen der FSK werte
--

INSERT INTO fsk_table ( FSK)
VALUES
( 0),
( 6),
( 12),
( 16),
( 18)
;


--
-- Einfügen des Admin Acounts
--

INSERT INTO user (UID, username, firstname, lastname, userrank, AID)
VALUES (1, "Admin", "Admin" , "Admin", "Admin", 5);

--
-- Einfügen des Admin Passworts
--

INSERT INTO password (PWID, UID, password)
VALUES (1, 1, "d927z6&&hf239_kc#so9");
