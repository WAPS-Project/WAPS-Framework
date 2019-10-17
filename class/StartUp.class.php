<?php


namespace webapp_php_sample_class;

use mysqli;

class StartUp
{
    static function loadDatabase()
    {
        require_once('config/db.config.php');

        $db_link = new mysqli(
            MYSQL_HOST,
            MYSQL_BENUTZER,
            MYSQL_KENNWORT
        );

        if ($db_link->connect_error) {
            die("Connection failed: " . $db_link->connect_error);
        }

        return $db_link;

    }

    static function classDirCheck()
    {
        $dirPath = "/class/";
        $files = scandir($dirPath);

        foreach ($files as $file) {

            $nameParts = explode(".", $file);

            if ($nameParts[1] === "class" && $nameParts[2] === "php" || $file === "." || $file === "..") {
                return;
            } else {
                echo "<script>console.log('$file')</script>";
                die("Nicht alle Files im Class Folder entsprechen dem 'expample.class.php' Muster!");
            }
        }

    }

}