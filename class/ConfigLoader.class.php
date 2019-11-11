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
            $pageTitle = $config["metaData"]["pageTitle"];

            $DBHOST = $config["database"]["dbhost"];
            $DBUSER = $config["database"]["dbuser"];
            $DBPASSWORD = $config["database"]["dbpassword"];
            $DBNAME = $config["database"]["dbname"];

            $version = $config["head"]["version"];

            $infoMail = $config["mailConfig"]["infoMail"];
            $autoMail = $config["mailConfig"]["autoMail"];
            $supportMail = $config["mailConfig"]["supportMail"];

            define("CHARSET", $charset);
            define("LANGUAGE", $language);
            define("DESCRIPTION", $description);
            define("KEYWORDS", $keywords);
            define("AUTHOR", $author);
            define("PAGE_TITLE",$pageTitle);
            define('MYSQL_HOST', $DBHOST);
            define('MYSQL_USER', $DBUSER);
            define('MYSQL_KEYWORD', $DBPASSWORD);
            define('MYSQL_DATABASE', $DBNAME);
            define('VERSION', $version);
            define('MAIL_INFO', $infoMail);
            define('MAIL_AUTO', $autoMail);
            define('MAIL_SUPPORT', $supportMail);

            error_reporting(E_ALL);



        }
    }
}