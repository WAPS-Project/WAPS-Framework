<?php


namespace webapp_php_sample_class;

use mysqli;
use webapp_php_sample_obj\pageMap;
use webapp_php_sample_obj\pageObj;

class StartUp
{
    public static function loadDatabase()
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

    public static function loadPages()
    {
        $files = self::dirCheck("page/open/");

        $fileMap = new pageMap();
        $fileMapExplicit = $fileMap::$PageMap;

        foreach ($files as $file) {
            $fileObj = new pageObj();
            $filePart = explode(".", $file);
            $fileErrorCheck = explode("_", $file);
            if ($file != "." && $file != "..") {
                $fileObj->Name = $filePart[0];
                $fileObj->File = $file;
                $fileObj->Path = "page/open/" . $file;

                if ($fileErrorCheck[0] === "Error") {
                    $fileObj->IsSet = FALSE;
                }
                else {
                    $fileObj->IsSet = TRUE;
                }

                array_push($fileMapExplicit, $fileObj);
            }
        }

        $fileJSON = json_encode($fileMapExplicit);
        file_put_contents("./config/pagemap.config.json", $fileJSON);
        return $fileJSON;
    }

    static private function dirCheck($dir)
    {
        $dirPath = $dir . "/";
        $files = scandir($dirPath);

        foreach ($files as $file) {

            $nameParts = explode(".", $file);

            if ($nameParts[1] === $dir || $file != "." || $file != "..") {
                continue;
            } else {
                echo "<script>console.log('$file')</script>";
                die("Nicht alle Files im Folder entsprechen dem 'expample." + $dir + ".php' Muster!");
            }
        }
        return $files;
    }

}