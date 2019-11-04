<?php

$classList = scandir("class/");
$objList = scandir("obj/");

foreach ($objList as $singleObj){
    if ($singleObj != "." && $singleObj != ".."){
        include "obj/" . $singleObj;
    }

}
foreach ($classList as $singleClass) {
    $classParts = explode(".", $singleClass);
    if ($classParts[1] === "class"){
        include "class/" . $singleClass;
    }
}

use webapp_php_sample_class\ConfigLoader;
use webapp_php_sample_class\ErrorHandler;
use webapp_php_sample_class\Main;
use webapp_php_sample_class\StartUp;

try {
    ConfigLoader::loadConfig("config/");
    StartUp::loadDatabase();
    $pageMap = StartUp::loadPages();
} catch (Exception $e) {
    ErrorHandler::FireError($e->getCode(), $e->getMessage());
}

$pageName = Main::validateHome(Main::getUrlInterpreter());
$pagePath = Main::validatePage($pageName);
$pageList = Main::validateFile("page/open");
$IP = Main::checkPost("ip");

try {
    $db_link = new mysqli(
        MYSQL_HOST,
        MYSQL_BENUTZER,
        MYSQL_KENNWORT
    );
} catch (Exception $e) {
    ErrorHandler::FireError($e->getCode(), $e->getMessage());
}

if ($IP != "NO ENTRY") {
    Main::ipPush($IP, $db_link);
    echo $IP;
}

