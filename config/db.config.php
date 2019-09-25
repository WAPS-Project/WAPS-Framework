<?php
// die Konstanten auslagern in eigene Datei
// die dann per require_once ('konfiguration.php');
// geladen wird.


//Hier wird die Datenbankadresse Eingetragen
$DBHOST = 'localhost';

//Hier wird die Datenbank Eingetragen
$DBNAME = 'php_webapp_sample';

//Hier wird der Datenbank Nutzername Eingetragen
$DBUSER = 'root';

//Hier wird das Nutzerpasswort Eingetragen
$DBPASSWORD = '';


// Damit alle Fehler angezeigt werden
error_reporting(E_ALL);

// Zum Aufbau der Verbindung zur Datenbank
// die Daten erhalten Sie von Ihrem Provider
define('MYSQL_HOST', $DBHOST);

// bei XAMPP ist der MYSQL_Benutzer: root
define('MYSQL_BENUTZER', $DBUSER);
define('MYSQL_KENNWORT', $DBPASSWORD);
// für unser Bsp. nennen wir die DB php_projekt_sample
define('MYSQL_DATENBANK', $DBNAME);
