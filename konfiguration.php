<?php
// die Konstanten auslagern in eigene Datei
// die dann per require_once ('konfiguration.php');
// geladen wird.

// Damit alle Fehler angezeigt werden
error_reporting(E_ALL);

// Zum Aufbau der Verbindung zur Datenbank
// die Daten erhalten Sie von Ihrem Provider
define ( 'MYSQL_HOST',      'localhost' );

// bei XAMPP ist der MYSQL_Benutzer: root
define ( 'MYSQL_BENUTZER',  'root' );
define ( 'MYSQL_KENNWORT',  '' );
// für unser Bsp. nennen wir die DB php_projekt_sample
define ( 'MYSQL_DATENBANK', 'php_projekt_sample' );
?>
