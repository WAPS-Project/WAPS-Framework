<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$classList = scandir("class/");
$objList = scandir("model/");
$classFiles = array_diff($classList, array('.', '..'));
$objFiles = array_diff($objList, array('.', '..'));

foreach ($objFiles as $singleObj) {
    include "model/" . $singleObj;

}
foreach ($classFiles as $singleClass) {
    $classParts = explode(".", $singleClass);
    if ($classParts[1] === "class") {
        include "class/" . $singleClass;
    }
}

use webapp_php_sample_class\ConfigLoader;
use webapp_php_sample_class\ErrorHandler;
use webapp_php_sample_class\Main;
use webapp_php_sample_class\StartUp;

try {
    ConfigLoader::loadConfig("config/");
    $database_link = StartUp::loadDatabase();
    StartUp::checkDatabaseStatus();
    $pageMap = StartUp::loadPages();
} catch (Exception $e) {
    ErrorHandler::FireError($e->getCode(), $e->getMessage());
}
$pageName = Main::validateHome(Main::getUrlInterpreter());
$pagePath = Main::validatePage($pageName);
$pageList = Main::validateFile("page/open");

Main::ipCheck($database_link);