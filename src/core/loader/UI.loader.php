<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

use Waps\Framework\Controller\ErrorHandler;
use Waps\Framework\Controller\Main;
use Waps\Framework\Controller\StartUp;

include 'core.loader.php';

$_ErrorHandler = new ErrorHandler("basic");

try {
    $database_link = StartUp::loadDatabase();
    StartUp::checkDatabaseStatus();
    $pageMap = StartUp::loadPages();
} catch (Exception $e) {
    ErrorHandler::FireError($e->getCode(), $e->getMessage());
}
$pagePath = Main::validateHome(Main::getUrlInterpreter());
$pageList = Main::validateFile('page/open/');
$pageName = Main::getPageNameFromPath($pagePath);

Main::ipCheck($database_link);
