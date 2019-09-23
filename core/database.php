<?php
require_once('config/db.config.php');
$db_link = mysqli_connect(
    MYSQL_HOST,
    MYSQL_BENUTZER,
    MYSQL_KENNWORT,
    MYSQL_DATENBANK
);

mysqli_set_charset($db_link, 'utf8');

if ($db_link) {
    echo "<script> console.log('database connection done') </script>";
} else {
    // hier sollte dann später dem Programmierer eine
    // E-Mail mit dem Problem zukommen gelassen werden
    die('keine Verbindung möglich: ' . mysqli_error());
}

