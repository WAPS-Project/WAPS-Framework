<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

use webapp_php_sample_class\ConfigLoader;
use webapp_php_sample_class\ErrorHandler;
use webapp_php_sample_class\Main;
use webapp_php_sample_class\PluginLoader;
use webapp_php_sample_class\StartUp;

$objFiles = array_diff(scandir('model/'), array('.', '..'));
$classFiles = array_diff(scandir('class/'), array('.', '..'));

foreach ($objFiles as $singleObj) {
    include "model/" . $singleObj;

}
foreach ($classFiles as $singleClass) {
    $classParts = explode(".", $singleClass);
    if ($classParts[1] === "class") {
        include "class/" . $singleClass;
    }
}

try {
    ConfigLoader::loadConfig("config/");
    $database_link = StartUp::loadDatabase();
    StartUp::checkDatabaseStatus();
    $pageMap = StartUp::loadPages();
    PluginLoader::loadPlugins();
} catch (Exception $e) {
    ErrorHandler::FireError($e->getCode(), $e->getMessage());
}
$pageName = Main::validateHome(Main::getUrlInterpreter());
$pagePath = Main::validatePage($pageName);
$pageList = Main::validateFile("page/open/");

Main::ipCheck($database_link);