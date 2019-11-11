<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$classList = scandir("class/");
$objList = scandir("obj/");

foreach ($objList as $singleObj) {
    if ($singleObj != "." && $singleObj != "..") {
        include "obj/" . $singleObj;
    }

}
foreach ($classList as $singleClass) {
    $classParts = explode(".", $singleClass);
    if ($classParts[1] === "class") {
        include "class/" . $singleClass;
    }
}

use webapp_php_sample_class\ConfigLoader;
use webapp_php_sample_class\ErrorHandler;
use webapp_php_sample_class\Main;
use webapp_php_sample_class\StartUp;

ConfigLoader::loadConfig("config/");
$database_link = StartUp::loadDatabase();
$pageMap = StartUp::loadPages();

$pageName = Main::validateHome(Main::getUrlInterpreter());
$pagePath = Main::validatePage($pageName);
$pageList = Main::validateFile("page/open");

Main::ipCheck($database_link);


