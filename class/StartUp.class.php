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
            die("Connection is dead");
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
            if ($file != "." && $file != ".." && $filePart[0] != "Home") {
                $fileObj->Name = $filePart[0];
                $fileObj->File = $file;
                $fileObj->Path = "page/" . $file;

                if ($fileErrorCheck[0] === "Error") {
                    $fileObj->IsSet = FALSE;
                } else {
                    $fileObj->IsSet = TRUE;
                }

                array_push($fileMapExplicit, $fileObj);
            } elseif ($file != "." && $file != ".." && $filePart[0] === "Home") {
                $fileObj->Name = $filePart[0];
                $fileObj->File = $file;
                $fileObj->Path = "page/" . $file;

                if ($fileErrorCheck[0] === "Error") {
                    $fileObj->IsSet = FALSE;
                } else {
                    $fileObj->IsSet = TRUE;
                }

                array_unshift($fileMapExplicit, $fileObj);
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