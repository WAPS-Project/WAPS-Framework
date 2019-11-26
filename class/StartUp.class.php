<?php


namespace webapp_php_sample_class;

use webapp_php_sample_obj\pageMap;
use webapp_php_sample_obj\pageObj;

class StartUp
{
    public static function loadDatabase()
    {
        $db_link = mysqli_connect(
            MYSQL_HOST,
            MYSQL_USER,
            MYSQL_KEYWORD,
            MYSQL_DATABASE
        );

        if (!$db_link) {
            die("Connection is dead:" . mysqli_connect_error());
        }

        return $db_link;
    }

    public static function loadPages()
    {
        $files = self::dirCheck("page/open/");

        $fileMap = new pageMap();
        $fileMapExplicit = $fileMap::$PageMap;

        foreach ($files as $file) {
            if ($file != "." && $file != "..") {
                $fileObj = new pageObj();
                $filePart = explode(".", $file);
                $fileObj->Path = "page/open/" . $file;
                $fileLines = file($fileObj->Path);
                $titleCheckLine = $fileLines[4];
                $titleCheckParts = explode(":", $titleCheckLine);
                $titleCheckParts = explode(";", $titleCheckParts[1]);
                $titleCheck = filter_var(
                    str_replace(" ", "", $titleCheckParts[0]),
                    FILTER_VALIDATE_BOOLEAN);
                $fileObj->Name = $filePart[0];
                $fileObj->File = $file;

                if ($titleCheck === true) {
                    $fileObj->IsSet = TRUE;
                } elseif ($titleCheck === false) {
                    $fileObj->IsSet = FALSE;
                }

                if ($filePart[0] != "Home") {
                    array_push($fileMapExplicit, $fileObj);
                } elseif ($filePart[0] === "Home") {
                    array_unshift($fileMapExplicit, $fileObj);
                }
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