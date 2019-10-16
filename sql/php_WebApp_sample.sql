DROP DATABASE IF EXISTS `php_webapp_sample`;
CREATE DATABASE IF NOT EXISTS `php_webapp_sample` /*!40100 DEFAULT CHARACTER SET utf8*/;
USE `php_webapp_sample`;



-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `iplogg`
--

CREATE TABLE iplogg
(
    IPID     int NOT NULL AUTO_INCREMENT,
    info     text,
    clientIP VARCHAR(999),
    publicIP VARCHAR(999),
    TS       TIME,
    DT       DATE,
    PRIMARY KEY (IPID)
);

--
-- Tabellenstruktur für Tabelle `FSK_Table`
--

CREATE TABLE fsk_table
(
    AID int NOT NULL AUTO_INCREMENT,
    FSK int,
    PRIMARY KEY (AID)
);

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE usr
(
    UID       int(11)                 NOT NULL auto_increment,
    username  text CHARACTER SET utf8 NOT NULL,
    firstname text CHARACTER SET utf8 NOT NULL,
    lastname  text CHARACTER SET utf8 NOT NULL,
    email     text CHARACTER SET utf8 NOT NULL,
    userrank  text CHARACTER SET utf8 NOT NULL,
    AID       int(5)                  NOT NULL,
    PRIMARY KEY (UID),
    CONSTRAINT FK_AID FOREIGN KEY (AID) REFERENCES fsk_table (AID)
);



--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE passwd
(
    PWID     int(11)   NOT NULL auto_increment,
    UID      int(11)   NOT NULL,
    passwort text(256) NOT NULL,
    PRIMARY KEY (PWID),
    CONSTRAINT FK_UID FOREIGN KEY (UID) REFERENCES usr (UID)
);



-- --------------------------------------------------------

--
-- Einfügen der FSK werte
--

INSERT INTO fsk_table (FSK)
VALUES (0),
       (6),
       (12),
       (16),
       (18)
;


--
-- Einfügen des Admin Acounts
--

INSERT INTO usr (UID, username, firstname, lastname, email, userrank, AID)
VALUES (1, "Admin", "Admin", "Admin", 'admin@email.de', "Admin", 5),
       (2, "Tester1", "Tester1", "Tester1", 'test1@email.de', "User", 1)
;

--
-- Einfügen des Admin Passworts
--

INSERT INTO passwd (PWID, UID, passwort)
VALUES (1, 1, "$2y$10$BtaQ1/t3pcDlT1kRb8j79eeSGpW0QINqG6vEtwvvKk17o1ASn7vaq"),
       (2, 2, "$2y$10$BFL5Qd.ETHD9KvADTQ3o8OHbXBvLJJJSzmvFkS8P76.bPrYz4mrQ6")
;
