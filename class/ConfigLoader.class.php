<?php


namespace webapp_php_sample_class;


use RecursiveArrayIterator;
use RecursiveIteratorIterator;

class ConfigLoader
{
    private static function validateConfig($path)
    {
        $files = scandir($path);

        foreach ($files as $file) {
            $fileParts = explode(".", $file);

            if ($fileParts[0] === "config" && $fileParts[1] === "json") {
                $config = file_get_contents($path . $file);
                $configObj = json_decode($config, true);

                if ($configObj["head"]["title"] === "configFile") {
                    return $configObj;
                }
            }
        }
        return false;
    }

    public static function loadConfig($path) {
        $config = self::validateConfig($path);

        if ($config != false) {
            $charset = $config["metaData"]["charset"];
            $language = $config["metaData"]["language"];
            $description = $config["metaData"]["description"];
            $keywords = $config["metaData"]["keywords"];
            $author = $config["metaData"]["author"];

            $DBHOST = $config["database"]["dbhost"];
            $DBUSER = $config["database"]["dbuser"];
            $DBPASSWORD = $config["database"]["dbpassword"];
            $DBNAME = $config["database"]["dbname"];

            $version = $config["head"]["version"];

            define("CHARSET", $charset);
            define("LANGUAGE", $language);
            define("DESCRIPTION", $description);
            define("KEYWORDS", $keywords);
            define("AUTHOR", $author);
            define('MYSQL_HOST', $DBHOST);
            define('MYSQL_BENUTZER', $DBUSER);
            define('MYSQL_KENNWORT', $DBPASSWORD);
            define('MYSQL_DATENBANK', $DBNAME);
            define('VERSION', $version);

            error_reporting(E_ALL);



        }
    }
}