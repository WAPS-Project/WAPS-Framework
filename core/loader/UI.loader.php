<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

use webapp_php_sample_class\ErrorHandler;
use webapp_php_sample_class\Main;
use webapp_php_sample_class\StartUp;

include 'basic.loader.php';

try {
    $database_link = StartUp::loadDatabase();
    StartUp::checkDatabaseStatus();
    $pageMap = StartUp::loadPages();
} catch (Exception $e) {
    ErrorHandler::FireError($e->getCode(), $e->getMessage());
}
$pageName = Main::validateHome(Main::getUrlInterpreter());
$pagePath = Main::validatePage($pageName);
$pageList = Main::validateFile('page/open/');

Main::ipCheck($database_link);